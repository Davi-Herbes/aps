<?php

require_once __DIR__ . "/../models/Usuario.php";

$login = $_POST["login"];
$senha = $_POST["senha"];

$user =  Usuario::validar_login($login, $senha);

if (!$user) {
    header("Location: /ana/pages/login?error=true");
}
