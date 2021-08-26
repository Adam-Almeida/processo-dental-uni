<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Boot\Message;
use Source\Core\Pager;
use Source\Models\Auth;
use Source\Models\Dentist;
use Source\Models\DentistSpeciality;
use Source\Models\Speciality;


/**
 * CONTROLADOR ADMIN - DESENVOLVIDO POR ADAM ALMEIDA
 * PROCESSO DENTAL UNI 2021
 * @package Source\App
 * @author Adam Almeida <adam.designjuridico@gmail.com>
 */
class Admin
{
    /** @var Engine */
    protected $view;

    /** @var Message */
    protected $message;

    /**
     * Admin constructor.
     */
    public function __construct()
    {
        $this->view = Engine::create(__DIR__ . "/../../theme/", "php");
        $this->message = new Message();

        if (!Auth::user()) {
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
        if (!empty($data['page']) && !is_numeric($data['page'])) {
            redirect("/admin/dash");
            return;
        }

        $dentistsAll = (new DentistSpeciality())->find();

        $specialityAll = (new Speciality())->find()->fetch(true);

        $pager = new Pager(url("/admin/dash/"));
        $pager->pager($dentistsAll->count(), 3, ($data['page'] ?? 1), 2);

        echo $this->view->render("dash", [
            "title" => "LISTA DE DENTISTAS | PROCESSO DENTAL UNI",
            "user" => Auth::user()->first_name . " " . Auth::user()->last_name,
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
        $specialityAll = (new Speciality())->find()->fetch(true);

        echo $this->view->render("speciality", [
            "title" => "LISTA DE ESPECIALIDADES | PROCESSO DENTAL UNI",
            "user" => Auth::user()->first_name . " " . Auth::user()->last_name,
            "specialityAll" => $specialityAll
        ]);
    }

    /**
     * Metodo de criacao de Especialidades
     */
    public function specialityCreate()
    {

        $post = (object)filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);

        if (!empty($post)) {

            $speciality = new Speciality();
            $speciality->bootstrap($post->name);

            if ($speciality->save()) {
                $this->message("Especialidade criada com sucesso", "Bom Trabalho", "success");
                redirect("./admin/especialidades");
                return;
            }
        }
        $this->message("Erro ao criar especialidade", "Que Pena!", "error");
        redirect("./admin/especialidades");
    }

    /**
     * Metodo de Atualizacao de Especialidades
     * @param array $data
     */
    public function specialityUpdate(array $data)
    {
        if (!empty($data['id']) && !is_numeric($data['id'])) {
            redirect("/admin/especialidades");
            return;
        }

        if (!empty($data['name'])) {
            $editId = filter_var($data['id'], FILTER_VALIDATE_INT);
            $post = filter_var($data['name'], FILTER_SANITIZE_SPECIAL_CHARS);

            $speciality = (new Speciality())->findById($editId);
            $speciality->name = $post;

            if ($speciality->save()) {
                $this->message("A Especialidade {$speciality->name} foi atualizada!", "Bom Trabalho",
                    "success");
                redirect("/admin/especialidades");
                return;
            }

            $this->message("Erro ao atualizar especialidade", "Que Pena!", "error");
            redirect("./admin/especialidades");

        } else {
            $specialityAll = (new Speciality())->find()->fetch(true);

            echo $this->view->render("speciality", [
                "title" => "LISTA DE ESPECIALIDADES | PROCESSO DENTAL UNI",
                "user" => Auth::user()->first_name . " " . Auth::user()->last_name,
                "specialityAll" => $specialityAll,
                "edit" => (new Speciality())->findById($data['id'])
            ]);

        }
    }

    /**
     * Metodo para Excluir uma Especialidades
     * @param array $data
     */
    public function specialityDelete(array $data)
    {
        if (!empty($data['id']) && !is_numeric($data['id'])) {
            redirect("/admin/dash");
            return;
        }

        $idSpecility = filter_var($data['id'], FILTER_SANITIZE_SPECIAL_CHARS);

        $specility = (new Speciality())->findById($idSpecility);

        if (!$specility) {
            $this->message("A especialidade não foi encontrada", "Oppsss!", "info");
            redirect("./admin/especialidades");
            return;
        }

        if ($specility->destroy()) {
            $this->message("Especialidade foi excluida com sucesso", "Bom Trabalho!", "error");
            redirect("/admin/especialidades");
            return;
        }
        $this->message("Erro ao fazer exclusão!", "Oppsss", "warning");
        redirect("/admin/especialidades");
    }

    /**
     * Metodo de criacao de um Dentista
     * @param array|null $data
     */
    public function dentistCreate(?array $data): void
    {
        //VALIDA SE OS CAMPOS ESTAO VAZIOS
        if (in_array("", $data)) {
            $this->message("Preencha todos os campos", "Ops! É rapidinho!", "warning");
            redirect("/admin/dash");
            return;
        }

        //VALIDA O CAMPO EMAIL
        if (!is_email($data['email'])) {
            $this->message("O Email informato não é válido", "Hey! Corrija o email!", "warning");
            redirect("/admin/dash");
            return;
        }

        //VALIDA O CAMPO CRO QTD MIN E MAX
        if (!is_cro($data['cro'])) {
            $this->message("O CRO deve conter entre 3 e 11 Números", "Hey! Corrija o CRO!", "warning");
            redirect("/admin/dash");
            return;
        }

        $data = (object)filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $dentist = (new Dentist())->bootstrap(
            $data->name,
            $data->email,
            $data->cro,
            $data->cro_uf
        );

        if ($dentist->save()) {
            $dentist->saveTrue($data->especialidade, $dentist->id);
            $this->message("O Dentista {$dentist->name} foi criado com sucesso", "Bom Trabalho!",
                "success");
            redirect("/admin/dash");
            return;
        }
        $this->message("Erro ao realizar o cadastro", "Que Pena!", "error");
        redirect("/admin/dash");
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

        if (!empty($data['name'])) {

            //VALIDA SE OS CAMPOS ESTAO VAZIOS
            if (in_array("", $data)) {
                $this->message("Preencha todos os campos", "Ops! É rapidinho!", "warning");
                redirect("/admin/dash");
                return;
            }

            //VALIDA O CAMPO EMAIL
            if (!is_email($data['email'])) {
                $this->message("O Email informato não é válido", "Hey! Corrija o email!", "warning");
                redirect("/admin/dash");
                return;
            }

            //VALIDA O CAMPO CRO QTD MIN E MAX
            if (!is_cro($data['cro'])) {
                $this->message("O CRO deve conter entre 3 e 11 Números", "Hey! Corrija o CRO!",
                    "warning");
                redirect("/admin/dash");
                return;
            }

            $data = (object)$data;

            $dentist = (new Dentist())->findById($data->id);
            $dentist->name = $data->name;
            $dentist->email = $data->email;
            $dentist->cro = $data->cro;
            $dentist->cro_uf = $data->cro_uf;

            if ($dentist->save()) {
                $dentist->updateTrue($data->especialidade, $dentist->id);
                $this->message("O Dentista {$dentist->name} foi atualizado com sucesso", "Bom Trabalho!",
                    "success");
                redirect("/admin/dash");
                return;
            }

            $this->message("Erro ao realizar o cadastro", "Que Pena!", "error");
            redirect("/admin/dash");

        } else {

            if (!empty($data['page']) && !is_numeric($data['page'])) {
                redirect("/admin/dash");
                return;
            }

            $dentistId = filter_var($data['id'], FILTER_SANITIZE_SPECIAL_CHARS);
            $dentistEdit = (new Dentist())->findById($dentistId);

            if (!$dentistEdit) {
                $this->message("O dentista informado não foi encontradao", "Oppsss!", "info");
                redirect("./admin/dash");
                return;
            }

            $dentistsAll = (new DentistSpeciality())->find();
            $specialityAll = (new Speciality())->find()->fetch(true);

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
        $specialityDentist = (new DentistSpeciality())
            ->find("dentista_id = :dentista_id", "dentista_id={$dataId}")->fetch();

        //VALIDA EXISTENCIA DE AMBOS REGISTROS
        if (empty($dentistById) || empty($specialityDentist)) {
            $this->message("Não foram econtrados registros para este dentista", "Oppsss!", "warning");
            redirect("/admin/dash");
            return;
        }

        //EXCLUI AMBOS REGISTROS
        if ($dentistById->destroy()) {
            $specialityDentist->destroy();
            $this->message("Dentista excluido com sucesso", "Bom Trabalho!", "error");
            redirect("./admin/dash");
        }
    }

    /**
     * @param string $message
     * @param string $title
     * @param string $type
     */
    protected function message(string $message, string $title, string $type)
    {
        return $this->message->renderMessage($message, $title, $type)->flash();
    }

    /**
     * Metdodo para sair do Sistema ={
     */
    public function exit(): void
    {
        $this->message("Ótimo Descanso e até logo.", "Volte Sempre!", "success");
        Auth::logout();
        redirect("/login");
    }

}
