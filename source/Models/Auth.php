<?php


namespace Source\Models;


use Source\Core\Model;
use Source\Core\Session;

/**
 * Class Auth
 * @package Source\Models
 * MODELO DE AUTENTICAÇÃO :: AUTH - DESENVOLVIDO POR ADAM ALMEIDA
 * PROCESSO DENTAL UNI 2021
 */
class Auth extends Model
{
    /**
     * @var null
     */
    private $message;

    /**
     * Auth constructor.
     */
    public function __construct()
    {
        parent::__construct("users", ["id"], ["email", "password"]);
    }

    /**
     * @return null|User
     */
    public static function user(): ?User
    {
        $session = new Session();
        if (!$session->has("authUser")) {
            return null;
        }

        return (new User())->findById($session->authUser);
    }

    /**
     * log-out
     */
    public static function logout(): void
    {
        $session = new Session();
        $session->unset("authUser");
    }

    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function login(string $email, string $password): bool
    {
        if (!is_email($email)) {
            $this->message("warning", "O e-mail informado não é válido");
            return false;
        }

        if (!is_passwd($password)) {
            $this->message("warning", "A senha informada não é válida");
            return false;
        }

        $user = (new User())->findByEmail($email);
        if (!$user) {
            $this->message("warning", "O e-mail informado não está cadastrado");
            return false;
        }

        if (!passwd_verify($password, $user->password)) {
            $this->message("warning", "A senha informada não confere");
            return false;
        }


        //LOGIN
        (new Session())->set("authUser", $user->id);
        $this->message("success", "Login efetuado com sucesso");
        return true;
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


}