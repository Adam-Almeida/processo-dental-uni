<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Core\Pager;
use Source\Models\Auth;
use Source\Models\Dentist;
use Source\Models\DentistSpecialty;
use Source\Models\Specialty;


/**
 * CONTROLADOR ADMIN - DESENVOLVIDO POR ADAM ALMEIDA
 * PROCESSO DENTAL UNI 2021
 * @package Source\App
 * @author Adam Almeida <adam.designjuridico@gmail.com>
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

    /**
     * Metodo que renderiza a Dash Administrativa
     * @param array|null $data
     */
    public function adminArea(?array $data): void
    {
        //VALIDACAO DO NUMERO DA PAGINA NA URL
        if(!empty($data['page']) && !is_numeric($data['page'])){
            redirect("/admin/dash");
            return;
        }

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

    /**
     * Metodo que renderiza a Dash de Especialidades
     */
    public function specialityArea(): void
    {
        $specialityAll = (new Specialty())->find()->fetch(true);

        echo $this->view->render("speciality", [
            "title" => "LISTA DE ESPECIALIDADES | PROCESSO DENTAL UNI",
            "user" => Auth::user()->first_name ." ". Auth::user()->last_name,
            "specialityAll" => $specialityAll
        ]);
    }

    /**
     * Metodo de criacao de Especialidades
     */
    public function specialityCreate(){

        $post = (object)filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);

        if (!empty($post)) {

            $speciality = new Specialty();
            $speciality->bootstrap($post->name);
            $speciality->save();
            redirect("./admin/especialidades");
            return;
        }

        redirect("./admin/especialidades");
    }

    /**
     * Metodo de Atualizacao de Especialidades
     * @param array $data
     */
    public function specialityUpdate(array $data)
    {
        if (!empty($data['id']) && !is_numeric($data['id'])){
            redirect("/admin/especialidades");
            return;
        }

        if (!empty($data['name'])){
            $editId = filter_var($data['id'], FILTER_VALIDATE_INT);
            $post = filter_var($data['name'], FILTER_SANITIZE_SPECIAL_CHARS);

            $speciality = (new Specialty())->findById($editId);
            $speciality->name = $post;

            if ($speciality->save()){
                redirect("/admin/especialidades");
            }

        }else{
            $specialityAll = (new Specialty())->find()->fetch(true);

            echo $this->view->render("speciality", [
                "title" => "LISTA DE ESPECIALIDADES | PROCESSO DENTAL UNI",
                "user" => Auth::user()->first_name ." ". Auth::user()->last_name,
                "specialityAll" => $specialityAll,
                "edit" => (new Specialty())->findById($data['id'])
            ]);

        }
    }

    /**
     * Metodo para Excluir uma Especialidades
     * @param array $data
     */
    public function specialityDelete(array $data)
    {
        if (!empty($data['id']) && !is_numeric($data['id'])){
            redirect("/admin/dash");
            return;
        }

        $idSpecility = filter_var($data['id'], FILTER_SANITIZE_SPECIAL_CHARS);

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

    /**
     * Metodo de criacao de um Dentista
     * @param array|null $data
     */
    public function dentistCreate(?array $data): void
    {
        //VALIDA SE OS CAMPOS ESTAO VAZIOS
        if (in_array("", $data)){
            redirect("/admin/dash");
            return;
        }

        //VALIDA O CAMPO EMAIL
        if (!is_email($data['email'])){
            redirect("/admin/dash");
            return;
        }

        //VALIDA O CAMPO CRO QTD MIN E MAX
        if (!is_cro($data['cro'])){
            redirect("./");
            return;
        }

        $data = (object)filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $dentist = (new Dentist())->bootstrap(
            $data->name,
            $data->email,
            $data->cro,
            $data->cro_uf
        );

        if ($dentist->save()){
            $dentist->saveTrue($data->especialidade, $dentist->id);
            redirect("/admin/dash");
        }
    }

    /**
     * Metodo de Atualizacao de um Dentista
     * @param array|null $data
     */
    public function dentistUpdate(?array $data): void
    {
        if ($data['id'] && !is_numeric($data['id'])) {
            redirect("/admin/dash");
            return;
        }

        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (!empty($data['name'])){

            //VALIDA SE OS CAMPOS ESTAO VAZIOS
            if (in_array("", $data)){
                redirect("/admin/dash");
                return;
            }

            //VALIDA O CAMPO EMAIL
            if (!is_email($data['email'])){
                redirect("/admin/dash");
                return;
            }

            //VALIDA O CAMPO CRO QTD MIN E MAX
            if (!is_cro($data['cro'])){
                redirect("./");
                return;
            }

            $data = (object)$data;

            $dentist = (new Dentist())->findById($data->id);
            $dentist->name = $data->name;
            $dentist->email = $data->email;
            $dentist->cro = $data->cro;
            $dentist->cro_uf = $data->cro_uf;

            if ($dentist->save()){
                $dentist->updateTrue($data->especialidade, $dentist->id);
                redirect("/admin/dash");
            }

        }else{

            if(!empty($data['page']) && !is_numeric($data['page'])){
                redirect("/admin/dash");
                return;
            }

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
     * Metodo para Excluir um Dentista
     * @param array $data
     */
    public function dentistDelete(array $data): void
    {
        if ($data['id'] && !is_numeric($data['id'])) {
            redirect("/admin/dash");
            return;
        }

        $dataId = filter_var($data['id'], FILTER_VALIDATE_INT);

        $dentistById = (new Dentist())->findById($dataId);
        $specialityDentist = (new DentistSpecialty())
            ->find("dentista_id = :dentista_id", "dentista_id={$dataId}")->fetch();

        //VALIDA EXISTENCIA DE AMBOS REGISTROS
        if (empty($dentistById) || empty($specialityDentist)){
            redirect("/admin/dash");
            return;
        }

        //EXCLUI AMBOS REGISTROS
        if ($dentistById->destroy()){
            $specialityDentist->destroy();
            var_dump(true);
            die();
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
