<?php

require_once __DIR__ . "/../models/Usuario.php";

// $nome = $_POST["nome"];
$login = $_POST["login"];
$senha = $_POST["senha"];


$user =  new Usuario($login, $senha);

$user->save();

if (!$user) {
    header("Location: /ana/pages/cadastro");
}
