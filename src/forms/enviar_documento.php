<?php


ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . "/../models/documento/Documento.php";
require_once __DIR__ . "/../validators/ValidadorDocumento.php";
require_once __DIR__ . "/../utils/navegar.php";



session_start();


$dados = array_merge($_POST, $_FILES);


$validador = new ValidadorDocumento($dados);

$id_estagio = isset($_POST["id_estagio"]) ? "?e=" . $_POST["id_estagio"] : "";
$validador->validate();


$error_in = $_POST["tipo"] ?? "envio";
if (!$validador->valido) {
  $_SESSION["flash-msg"] = ["message" => "Ocorreu um erro no {$error_in}.", "type" => "error"];
  navegar("/$id_estagio");
}



$pasta_upload = __DIR__ . "/../../uploads/documents/";

$nome_arquivo = $_FILES['arquivo']['name'];
$arquivo_tmp = $_FILES['arquivo']['tmp_name'];

$nome_arquivo_upado = time() . '_' . basename($nome_arquivo);
$caminho = "/2025/projeto/grupo2/uploads/documents/" . $nome_arquivo_upado;
$destino = $pasta_upload . $nome_arquivo_upado;

$extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);

$documento = null;

$data = new DateTime();
$data->modify('+6 months');

$validade = isset($_POST["validade"]) && $_POST["validade"] !== "" ? $_POST["validade"] : $data->format('Y-m-d');

// Move o arquivo da pasta temporária para a pasta final
if ($_FILES["arquivo"]["error"] === UPLOAD_ERR_NO_FILE) {



  $documento = new Documento(null, null, null, $_POST["tipo"], isset($_POST["validade"]) && $_POST["validade"] !== "" ? $_POST["validade"] : null, null, $_POST["id_estagio"] ?? null);
  $documento->id = isset($_POST["id"]) && $_POST["id"] !== "" ? (int)$_POST["id"] : null;

  $result = $documento->save();

  if (!$result) {
    $validador->gerarErroGenerico();
    $_SESSION["flash-msg"] = ["message" => "Ocorreu um erro no {$error_in}.", "type" => "error"];
    $_SESSION["validador"] = $validador;
    navegar("/$id_estagio");
  }
} else if (move_uploaded_file($arquivo_tmp, $destino)) {
  $date_time = new DateTime();
  $documento = new Documento($nome_arquivo, $extensao, $caminho, $_POST["tipo"], $validade, $date_time->format("Y-m-d H:i:s"), $_POST["id_estagio"]);
  $documento->id = isset($_POST["id"]) && $_POST["id"] !== "" ? (int)$_POST["id"] : null;

  $result = $documento->save();


  if (!$result) {
    $validador->gerarErroGenerico();
    $_SESSION["flash-msg"] = ["message" => "Ocorreu um erro no {$error_in}.", "type" => "error"];
    $_SESSION["validador"] = $validador;
    navegar("/$id_estagio");
  }
}
$_SESSION["flash-msg"] = ["message" => "Documento registrado com sucesso.", "type" => "success"];
navegar("/$id_estagio");
