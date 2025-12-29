<?php
require_once __DIR__ . "/../../src/models/estagio/Estagio.php";
require_once __DIR__ . "/../../src/models/usuario/Usuario.php";
require_once __DIR__ . "/../../src/models/professor/Professor.php";
require_once __DIR__ . "/../../src/models/admin/Admin.php";
require_once __DIR__ . "/../../src/utils/navegar.php";
require_once __DIR__ . "/../../src/utils/show_errors.php";

show_errors();
session_start();

// Verifica se usuário está logado
if (!isset($_SESSION['user'])) {
  $_SESSION['flash-msg'] = ["message" => "Você precisa estar logado para deletar um estágio.", "type" => "flash-msg-error"];
  navegar("/2025/projeto/grupo2/");
}

// Define usuário logado
$user = $_SESSION['user'];

// Define user_role
$user_role = null;
switch ($user->tipo) {
  case "admin":
    $user_role = Admin::find($user->id);
    break;
  case "professor":
    $user_role = Professor::find($user->id);
    break;
  default:
    $_SESSION['flash-msg'] = ["message" => "Permissão negada.", "type" => "flash-msg-error"];
    navegar("/2025/projeto/grupo2/");
}

// Pega o ID do estágio do POST
if (!isset($_POST['estagio_id'])) {
  $_SESSION['flash-msg'] = ["type" => "error", "message" => "Estágio não informado."];
  navegar("/2025/projeto/grupo2/");
}
$estagio_id = $_POST['estagio_id'];

// Busca o estágio
$estagio = Estagio::find($estagio_id);
if (!$estagio) {
  $_SESSION['flash-msg'] = ["type" => "error", "message" => "Estágio não encontrado."];
  navegar("/2025/projeto/grupo2/");
}

// Deleta o estágio
if ($estagio->delete()) {
  $_SESSION['flash-msg'] = ["type" => "success", "message" => "Estágio deletado com sucesso!"];
} else {
  $_SESSION['flash-msg'] = ["type" => "error", "message" => "Erro ao deletar estágio."];
}

navegar("");
