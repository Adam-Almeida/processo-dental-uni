<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Core\Pager;
use Source\Models\Auth;
use Source\Models\Dentist;
use Source\Models\DentistSpecialty;

/**
 * Class Web
 * @package Source\App
 * CONTROLADOR WEB - DESENVOLVIDO POR ADAM ALMEIDA
 * PROCESSO DENTAL UNI 2021
 */
class Web
{
    /**@var Engine */
    private $view;

    /**
     * Web constructor.
     */
    public function __construct()
    {
        $this->view = Engine::create(__DIR__ . "/../../theme/", "php");
    }

    /**
     *MÉTODO DE EXIBIÇÃO DA HOME
     */
    public function home(?array $data): void
    {
        if(!empty($data['page']) && !is_numeric($data['page'])){
            redirect("/");
            return;
        }

        $dentistsAll = (new DentistSpecialty())->find();

        $pager = new Pager(url("/"));
        $pager->pager($dentistsAll->count(), 5, ($data['page'] ?? 1), 2);

        echo $this->view->render("home", [
            "title" => "HOME | PROCESSO DENTAL UNI",
            "dentistsAll" => $dentistsAll->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    public function search(?array $data): void
    {

        $types = ['name', 'email', 'cro', 'cro_uf'];

        if (!empty($data['s']) && !empty($data['tipo'] && in_array($data['tipo'], $types))){
            $search = filter_var($data['s'], FILTER_SANITIZE_STRIPPED);
            $type = filter_var($data['tipo'], FILTER_SANITIZE_STRIPPED);
            redirect("/dentista/buscar/{$search}/{$type}/1");
            return;
        }

        if (empty($data['terms'] || empty($data['tipo']))){
            redirect("/");
            return;
        }

        $search = filter_var($data['terms'], FILTER_SANITIZE_STRIPPED);
        $type = filter_var($data['tipo'], FILTER_SANITIZE_STRIPPED);
        $page = (filter_var($data['page'], FILTER_VALIDATE_INT) >= 1 ? $data['page'] : 1);

        $dentist = new Dentist();
        $dentistSearch = $dentist->find("{$type} LIKE :s","s=%{$search}%")->fetch(true);


        echo $this->view->render("search", [
            "title" => "HOME | PROCESSO DENTAL UNI",
            "search" => ($search ?? null),
            "dentistsAll" => $dentistSearch
        ]);
    }

    /**
     * @param array|null $data
     */
    public function login(?array $data): void
    {
        if (!empty($data['csrf'])) {

            if (empty($data['email']) || empty($data['password'])) {

                $text = ("Preencha todos os campos" ?? null);
                $type = ("warning" ?? null);

                echo $this->view->render("login", [
                    "title" => "LOGIN | PROCESSO DENTAL UNI",
                    "message" => [
                        "text" => $text,
                        "type" => $type
                    ]
                ]);
                return;
            }

            $auth = new Auth();
            $login = $auth->login($data['email'], $data['password']);

            if ($login){
                redirect("/admin/dash");
            }

            $messageAuth = $auth->getMessage();

            echo $this->view->render("login", [
                "title" => "LOGIN | PROCESSO DENTAL UNI",
                "message" => [
                    "text" => $messageAuth->text,
                    "type" => $messageAuth->type
                ]
            ]);
            return;

        }

        echo $this->view->render("login", [
            "title" => "LOGIN | PROCESSO DENTAL UNI",
            "message"
        ]);
    }

    /**
     * @param $data
     */
    public function error($data): void
    {
        redirect("/");
    }
}