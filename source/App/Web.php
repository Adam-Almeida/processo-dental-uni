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
        if (!empty($data['s'])){
            $search = filter_var($data['s'], FILTER_SANITIZE_STRIPPED);
            redirect("/dentista/buscar/{$search}/1");
            return;
        }

        echo $this->view->render("search", [
            "title" => "HOME | PROCESSO DENTAL UNI",
            "search" => ($search ?? null),
            "paginator" => ""
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