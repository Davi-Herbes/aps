<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "src/models/admin/Admin.php";
require_once "src/models/aluno/Aluno.php";
require_once "src/models/usuario/Usuario.php";
require_once "src/models/professor/Professor.php";

require_once "src/utils/user_required.php";
session_start();

user_required();

$user_id = $_SESSION["idUsuario"];
$user = Usuario::find($user_id);
$_SESSION["user"] = $user;
$user_role = null;


switch ($user->tipo) {
  case "admin":
    $user_role = Admin::find($user->id);
    break;

  case "aluno":
    $user_role = Aluno::find($user->id);
    break;

  case "professor":
    $user_role = Professor::find($user->id);
    break;
}

$user_role->user = $user;


// Fazendo ele importar o arquivo baseado no tipo de usuário, invés de redirecionar
require_once __DIR__ . "/pages/home/$user->tipo/index.php";
