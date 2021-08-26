<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Core\Pager;
use Source\Models\Auth;
use Source\Models\Dentist;
use Source\Models\DentistSpecialty;
use Source\Models\Specialty;


/**
 * Class Admin
 * @package Source\App
 */
class Admin
{
    /**
     * @var Engine
     */
    protected $view;

    /**
     * Admin constructor.
     */
    public function __construct()
    {
        $this->view = Engine::create(__DIR__ . "/../../theme/", "php");

        if (!Auth::user()){
            redirect("/login");
        }
    }

    public function adminArea(?array $data): void
    {
        $dentistsAll = (new DentistSpecialty())->find();

        $specialityAll = (new Specialty())->find()->fetch(true);

        $pager = new Pager(url("/admin/dash/"));
        $pager->pager($dentistsAll->count(), 3, ($data['page'] ?? 1), 2);

        echo $this->view->render("dash", [
            "title" => "LISTA DE DENTISTAS | PROCESSO DENTAL UNI",
            "user" => Auth::user()->first_name ." ". Auth::user()->last_name,
            "dentistsAll" => $dentistsAll->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "specialityAll" => $specialityAll,
            "paginator" => $pager->render()
        ]);

    }

    public function specialityArea(): void
    {
        $specialityAll = (new Specialty())->find()->fetch(true);

        echo $this->view->render("speciality", [
            "title" => "LISTA DE ESPECIALIDADES | PROCESSO DENTAL UNI",
            "user" => Auth::user()->first_name ." ". Auth::user()->last_name,
            "specialityAll" => $specialityAll
        ]);
    }

    public function specialityDelete(array $data)
    {
        //** VALIDAÇÃO DE ID */

        $idSpecility = filter_var($data['id'], FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$idSpecility || $idSpecility == '' || !is_numeric($idSpecility)) {
            redirect("/admin/dash");
            return;
        }

        $specility = (new Specialty())->findById($idSpecility);

        if (!$specility){
            redirect("/admin/especialidades");
            return;
        }

        if ($specility->destroy()){
            redirect("/admin/especialidades");
            return;
        }
        redirect("/admin/especialidades");
    }

    public function specialityCreate(){

        $specialityPost = (object)filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($specialityPost->name)){
            redirect("./");
        }

        $speciality = (new Specialty())->bootstrap(
            $specialityPost->name,
        );

        if ($speciality->save()){
            redirect("/admin/especialidades");
        }

        //implemantar erro aqui
    }

    /**
     * MÉTODO PARA EXCLUIR DENTISTA E ESPECIALIDADES
     * @param array $data
     */
    public function dentistDelete(array $data): void
    {
        //** VALIDAÇÃO DE ID */

        $idDentist = filter_var($data['id'], FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$idDentist || $idDentist == '' || !is_numeric($idDentist)) {
            redirect("/admin/dash");
            return;
        }

        /* REFATORAR :: IMPLEMENTAR A CLASSE ->  MESSAGE */
        $dentistById = (new Dentist())->findById($idDentist);
        $specialistdentist = (new DentistSpecialty())
            ->find("dentista_id=:dentista_id", "dentista_id={$idDentist}")->fetch();

        if (!$dentistById || !$specialistdentist){
            redirect("/admin/dash");
        }

        if ($dentistById->destroy()){
            $specialistdentist->destroy();
        } else {
            redirect("/admin/dash");
        }

        redirect("/admin/dash");
    }

    public function dentistCreate(): void
    {

        $dentistPost = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$dentistPost){
            redirect("./");
        }

        if (in_array("", $dentistPost)){
            redirect("./");
            return;
        }

        $dentistPost = (object)$dentistPost;

        if (!is_email($dentistPost->email)){
            redirect("./");
            return;
        }

        if (!is_cro($dentistPost->cro)){
            redirect("./");
            return;
        }

        $dentist = (new Dentist())->bootstrap(
            $dentistPost->name,
            $dentistPost->email,
            $dentistPost->cro,
            $dentistPost->cro_uf
        );

        if ($dentist->save()){
            $dentist->saveTrue($dentistPost->especialidade, $dentist->id);
            redirect("./");
        }
    }

    public function dentistUpdate(array $data): void
    {
        if (!$data['id'] || !is_numeric($data['id'])) {
            redirect("./");
            return;
        }

        $dentistPost = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if ($dentistPost){

            if (in_array("", $dentistPost)){
                redirect("./");
                return;
            }

            $dentistPost = (object)$dentistPost;

            if (!is_email($dentistPost->email)){
                redirect("./");
                return;
            }

            if (!is_cro($dentistPost->cro)){
                redirect("./");
                return;
            }

            $dentist = (new Dentist())->findById($data['id']);
            $dentist->name = $dentistPost->name;
            $dentist->email = $dentistPost->email;
            $dentist->cro = $dentistPost->cro;
            $dentist->cro_uf = $dentistPost->cro_uf;

            if ($dentist->save()) {
//                $dentist->saveTrue($dentistPost->especialidade, $dentist->id);
                redirect("/admin/dash");
            }

        }else{

            $dentistId = filter_var($data['id'], FILTER_SANITIZE_SPECIAL_CHARS);
            $dentistEdit = (new Dentist())->findById($dentistId);

            if (!$dentistEdit) {
                redirect("./");
            }

            $dentistsAll = (new DentistSpecialty())->find();
            $specialityAll = (new Specialty())->find()->fetch(true);

            $pager = new Pager(url("/admin/dash/"));
            $pager->pager($dentistsAll->count(), 3, ($data['page'] ?? 1), 2);

            echo $this->view->render("dash", [
                "title" => "LISTA DE DENTISTAS | PROCESSO DENTAL UNI",
                "user" => Auth::user()->first_name . " " . Auth::user()->last_name,
                "dentistsAll" => $dentistsAll->limit($pager->limit())->offset($pager->offset())->fetch(true),
                "specialityAll" => $specialityAll,
                "paginator" => $pager->render(),
                "edit" => $dentistEdit
            ]);
        }


    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $type
     * @param string $text
     * @return object
     */
    public function message(string $type, string $text): object
    {
        return $this->message = (object)[
            "type" => $type,
            "text" => $text
        ];
    }


    /**
     *
     */
    public function exit(): void
    {
        Auth::logout();
        redirect("/login");
    }

}
