<?php
require_once __DIR__ . "/../../src/models/estagio/Estagio.php";
require_once __DIR__ . "/../../src/models/usuario/Usuario.php";
require_once __DIR__ . "/../../src/utils/navegar.php";
require_once __DIR__ . "/../../src/utils/show_errors.php";
require_once __DIR__ . "/../../src/validators/ValidadorUpdateEstagio.php";

show_errors();

session_start();

$estagio_id = $_GET['estagio_id'];

// Validar dados do $_POST
$validador_estagio = new ValidadorUpdateEstagio($_POST);
$validador_estagio->setFailureURL("/?e=$estagio_id");
$_SESSION["flash-msg"] = ["message" => "Você enviou algum dado inválido.", "type" => "error"];
$validador_estagio->validate();


// Com os dados validados, podemos gerar uma instancia de Estagio diretamente dos dados do $_POST
$professor = $_SESSION["user"];

$estagio = Estagio::instanciarArray($_POST);
$estagio->id = $estagio_id;

$resultado = $estagio->save();


if (!$resultado) {
  $validador_estagio =  new Validador();
  $_SESSION["validador"] = $validador_estagio;

  navegar("/?e=$estagio_id");
}


$_SESSION["flash-msg"] = ["message" => "Estágio atualizado com sucesso.", "type" => "success"];
navegar("/?e=$estagio_id");
