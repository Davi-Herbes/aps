<?php
require_once __DIR__ . "/../../src/models/estagio/Estagio.php";
require_once __DIR__ . "/../../src/models/usuario/Usuario.php";
require_once __DIR__ . "/../../src/utils/navegar.php";
require_once __DIR__ . "/../../src/utils/show_errors.php";
require_once __DIR__ . "/../../src/validators/ValidadorCadastroEstagio.php";

show_errors();

session_start();

// Validar dados do $_POST
$validador_estagio = new ValidadorCadastroEstagio($_POST);
$validador_estagio->setFailureURL("/pages/cadastro_estagio/");
$validador_estagio->validate();


// Com os dados validados, podemos gerar uma instancia de Estagio diretamente dos dados do $_POST
$professor = $_SESSION["user"];

$estagio = Estagio::instanciarArray($_POST);
$estagio->id_professor = $professor->id;

$resultado = $estagio->save();

if (!$resultado) {
  $validador_estagio =  new Validador();
  $_SESSION["validador"] = $validador_estagio;

  navegar("/pages/cadastro_estagio/");
}


$_SESSION["flash-msg"] = ["message" => "Cadastro de Estágio concluído com sucesso.", "type" => "flash-msg-success"];
navegar("/");
