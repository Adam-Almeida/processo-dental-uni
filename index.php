<?php
ob_start();

require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;
use Source\Core\Session;

$session = new Session();
$route = new Router(ROOT);
$route->namespace("Source\App");

/**
 *WEB ROUTES
 */

$route->group(null);
$route->get("/", "Web:home");
$route->get("/{page}", "Web:home");
$route->get("/login", "Web:login");
$route->post("/login", "Web:login");
$route->post("/dentista/buscar", "Web:search");
$route->get("/dentista/buscar/{terms}/{tipo}/{page}", "Web:search");

/**
 *ADMIN ROUTES
 */

$route->group("admin");

$route->get("/dash", "Admin:adminArea");
$route->get("/dash/{page}", "Admin:adminArea");
$route->get("/especialidades", "Admin:specialityArea");
$route->post("/especialidades", "Admin:specialityCreate");
$route->get("/especialidade/excluir/{id}", "Admin:specialityDelete");

$route->post("/dentista", "Admin:dentistCreate");
$route->get("/dentista/excluir/{id}", "Admin:dentistDelete");
$route->get("/dentista/editar/{id}", "Admin:dentistUpdate");
$route->post("/dentista/editar/{id}", "Admin:dentistUpdate");

$route->get("/sair", "Admin:exit");


/**
 *ERROR ROUTES
 */
$route->group("ops");
$route->get("/{errcode}", "Web:error");

/**
 *PROCESS ROUTES
 */
$route->dispatch();

if ($route->error()){
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();
