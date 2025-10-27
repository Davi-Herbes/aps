<?php

// falta salvar o usuário na sessão

require_once __DIR__ . "/../models/Usuario.php";
require_once __DIR__ . "/../utils/navegar.php";

$login = $_POST["login"];
$senha = $_POST["senha"];

$user =  Usuario::validar_login($login, $senha);

if (!$user) {
    navegar("/ana/pages/login?error=true");
}

navegar("/ana/");
