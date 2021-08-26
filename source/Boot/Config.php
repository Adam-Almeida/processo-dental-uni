<?php
/**
 * ARQUIVO DE CONFIGURAÇÃO - DESENVOLVIDO POR ADAM ALMEIDA
 * PROCESSO DENTAL UNI 2021
 **/

/**
 * DATABASE::CONF
 */
define("CONF_DB_HOST", "localhost");
define("CONF_DB_USER", "root");
define("CONF_DB_PASS", "root");
define("CONF_DB_NAME", "processoSeletivo2021_Adam_Almeida");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);


/**
 * BASE URL
 * SEM BARRA NO FINAL
 */

//define("ROOT", "http://www.localhost/processo-dental-uni");
define("ROOT", "https://www.localhost/processo-dental-uni");

/**
 * BASE DATE
 */

define("DATE_BR", "d-m-Y");


/**-------------------------
 *
 * *HELPERS*
 *
 **-------------------------
 *
 * /**
 * PASSWORD VERIFY HELPER
 * @param string $password
 * @param string $hash
 * @return bool
 */
function passwd_verify(string $password, string $hash): bool
{
    return password_verify($password, $hash);
}


/**
 * EMAIL HELPER
 * @param string $email
 * @return bool
 */
function is_email(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function is_cro(int $cro): bool
{
    if (mb_strlen($cro) >= 3 && mb_strlen($cro) <= 11) {
        return true;
    }
    return false;
}

/**
 * PASSWORD HELPER
 * @param string $password
 * @return bool
 */
function is_passwd(string $password): bool
{
    if (password_get_info($password)['algo'] || (mb_strlen($password) >= CONF_PASSWD_MIN_LEN && mb_strlen($password) <= CONF_PASSWD_MAX_LEN)) {
        return true;
    }

    return false;
}


/**
 * ASSET HELPER
 * @param string|null $path
 * @return string
 */

function url(string $path = null): string
{
    if ($path) {
        return ROOT . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    return ROOT;
}


/**
 * LINK HELPER
 * @param string|null $link
 * @return string
 */

function urlLink(string $link = null): string
{
    if ($link) {
        return ROOT . "/" . ($link[0] == "/" ? mb_substr($link, 1) : $link);
    }
    return ROOT;
}


/**
 * REDIRECT HELPER
 * @param string $url
 */

function redirect(string $url): void
{
    header("HTTP/1.1 302 Redirect");
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
        exit;
    }

    if (filter_input(INPUT_GET, "route", FILTER_DEFAULT) != $url) {
        $location = url($url);
        header("Location: {$location}");
        exit;
    }
}


/**
 * @return null|string
 */
function flash(): ?string
{
    $session = new \Source\Core\Session();
    if ($flash = $session->flash()) {
        return $flash;
    }
    return null;
}

