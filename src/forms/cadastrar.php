<?php
require_once __DIR__ . "/../../src/models/usuario/Usuario.php";
require_once __DIR__ . "/../../src/utils/navegar.php";

session_start();


$nome = $_POST["nome"] ?? "";
$sobrenome = $_POST["sobrenome"] ?? "";
$login = $_POST["login"] ?? "";
$email = $_POST["email"] ?? "";
$tipo_usuario = $_POST["tipo-usuario"] = "admin";
$senha = $_POST["senha"] ?? "";

$user = new Usuario($nome, $sobrenome, $login, $email, $tipo_usuario,  $senha);

// $user->save();

$validador_user = new ValidadorUsuario($user);
$validador_user->validar();

if (!$validador_user->valido) {
  $_SESSION["validador"] = $validador_user;
  navegar("/ana/pages/cadastro/");
}

$_SESSION["usuario_para_cadastro"] = $user;

navegar("/ana/pages/cadastro/$tipo_usuario");
