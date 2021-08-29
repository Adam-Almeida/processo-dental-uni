<?php

namespace Source\App;


use League\Plates\Engine;
use Source\Boot\Message;
use Source\Core\Pager;
use Source\Models\Auth;
use Source\Models\Dentist;
use Source\Models\DentistSpeciality;


/**
 * CONTROLADOR WEB - DESENVOLVIDO POR ADAM ALMEIDA
 * PROCESSO DENTAL UNI 2021
 * @package Source\App
 * @author Adam Almeida <adam.designjuridico@gmail.com>
 */
class Web
{
    /**@var Engine */
    private $view;

    /**
     * @var Message
     */
    private $message;

    /**
     * Web constructor.
     */
    public function __construct()
    {
        $this->view = Engine::create(__DIR__ . "/../../theme/", "php");
        $this->message = new Message();
    }

    /**
     *MÉTODO DE EXIBIÇÃO DA HOME
     */
    public function home(?array $data): void
    {

        //VALIDACAO DO NUMERO DA PAGINA NA URL
        if (!empty($data['page']) && !is_numeric($data['page'])) {
            redirect("/");
            return;
        }
        $names = (new Dentist())->order('id DESC')->find();

        $dentistsAll = (new DentistSpeciality())->order('id DESC')->find();

        $pager = new Pager(url("/"));
        $pager->pager($names->count(), 5, ($data['page'] ?? 1), 2);

        echo $this->view->render("home", [
            "title" => "HOME | PROCESSO DENTAL UNI",
            "dentistsAll" => $names->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    /**
     * @param array|null $data
     */
    public function search(?array $data): void
    {

        $types = ['name', 'email', 'cro', 'cro_uf'];

        if (!empty($data['s']) && !empty($data['tipo'] && in_array($data['tipo'], $types))) {
            $search = filter_var($data['s'], FILTER_SANITIZE_STRIPPED);
            $type = filter_var($data['tipo'], FILTER_SANITIZE_STRIPPED);
            redirect("/dentista/buscar/{$search}/{$type}/1");
            return;
        }

        if (empty($data['terms'] || empty($data['tipo']))) {
            redirect("/");
            return;
        }

        $search = filter_var($data['terms'], FILTER_SANITIZE_STRIPPED);
        $type = filter_var($data['tipo'], FILTER_SANITIZE_STRIPPED);
        $page = (filter_var($data['page'], FILTER_VALIDATE_INT) >= 1 ? $data['page'] : 1);

        $dentist = new Dentist();
        $dentistSearch = $dentist->find("{$type} LIKE :s", "s=%{$search}%")->fetch(true);


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
                $this->message("Os dados não podem estar em branco", "Opss! Login Incorreto", "warning");
                redirect("/login");
                echo $this->view->render("login", [
                    "title" => "LOGIN | PROCESSO DENTAL UNI"
                ]);

                die();
            }

            $auth = new Auth();
            $login = $auth->login($data['email'], $data['password']);

            if ($login) {
                redirect("/admin/dash");
            }

            $this->message("Os dados informados estão incorretos!", "Opss! Login Incorreto", "error");
            redirect("/login");
        }

        echo $this->view->render("login", [
            "title" => "LOGIN | PROCESSO DENTAL UNI"
        ]);
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
     * @param $data
     */
    public function error($data): void
    {
        redirect("/");
    }
}