<?php
require_once __DIR__ . "/../../src/models/usuario/Usuario.php";
require_once __DIR__ . "/../../src/utils/navegar.php";

function cadastrar()
{
  session_start();


  $nome = $_POST["nome"];
  $sobrenome = $_POST["sobrenome"];
  $login = $_POST["login"];
  $email = $_POST["email"];
  $senha = $_POST["senha"];


  $user = new Usuario($nome, $sobrenome, $login, $email, $senha);
  $validador_user = new ValidadorUsuario($user);
  $validador_user->validar();

  if (!$validador_user->valido) {
    $_SESSION["validador"] = $validador_user;
    navegar("/ana/pages/cadastro/");
  }

  $result = $user->save();

  if (!$result) {
    $validador_user->erro_generico();

    $_SESSION["validador"] = $validador_user;
    navegar("/ana/pages/cadastro/");
  }
}
