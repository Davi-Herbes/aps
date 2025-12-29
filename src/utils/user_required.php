<?php
require_once __DIR__ . "/../models/usuario/Usuario.php";
require_once __DIR__ . "/navegar.php";

function user_required()
{

  if (!isset($_SESSION["idUsuario"])) {
    header("Location: /2025/projeto/grupo1");
    exit;
  }
}
