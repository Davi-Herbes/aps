<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../models/usuario/Usuario.php";
require_once __DIR__ . "/../utils/navegar.php";

session_start();

$login = $_POST["login"];
$senha = $_POST["senha"];

$user =  Usuario::validar_login($login, $senha);

$_SESSION["idUsuario"] = $user->id;
$_SESSION["user"] = $user;

if (!$user) {
  navegar("/pages/login?error=true");
}

navegar("/");
