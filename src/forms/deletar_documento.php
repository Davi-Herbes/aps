<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../models/documento/Documento.php";
require_once __DIR__ . "/../utils/navegar.php";

session_start();

// Precisa vir como POST
if (!isset($_POST["id"])) {
  $_SESSION["flash-msg"] = [
    "message" => "Documento inválido.",
    "type" => "error"
  ];
  echo "a";
  navegar("/");
}

$id = intval($_POST["id"]);

// Buscar documento no banco
$documento = Documento::find($id);

if (!$documento) {
  $_SESSION["flash-msg"] = [
    "message" => "Documento não encontrado.",
    "type" => "error"
  ];
  echo "b";
  navegar("/");
}

$id_estagio = $documento->id_estagio;
$redirect = "?e=" . $id_estagio;

// Caminho físico do arquivo
$caminho_fisico = __DIR__ . "/../../uploads/documents/" . basename($documento->path);

// Excluir arquivo físico
if (file_exists($caminho_fisico)) {
  unlink($caminho_fisico);
}

// Excluir registro no banco
$result = Documento::delete($id);

if (!$result) {
  $_SESSION["flash-msg"] = [
    "message" => "Erro ao excluir documento.",
    "type" => "error"
  ];
  var_dump($result);
  navegar("/$redirect");
}

// Sucesso
$_SESSION["flash-msg"] = [
  "message" => "Documento excluído com sucesso.",
  "type" => "success"
];

echo "d";
navegar("/$redirect");
