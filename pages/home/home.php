<?php
require_once __DIR__."\..\..\src\models\usuario\Usuario.php";


session_start();

$user = $_SESSION["user"];

if ($user->tipo == "admin") {
  require_once __DIR__."\..\..\src\models\admin\Admin.php";
  $pessoa = Admin::find($user->id);
  header("location: \ana\pages\home\admin.php");

} elseif ($user->tipo == "aluno") {
  require_once __DIR__."\..\..\src\models\aluno\Aluno.php";
  $pessoa = Aluno::find($user->id);
  header("location: \ana\pages\home\aluno.php");

} elseif ($user->tipo == "professor") {
  require_once __DIR__."\..\..\src\models\professor\Professor.php";
  $pessoa = Professor::find($user->id);
  header("location: \ana\pages\home\professor.php");
}

$_SESSION["user"] = $pessoa;

?>