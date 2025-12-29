<?php
require_once __DIR__ . "/../../../src/models/estagio/Estagio.php"; //nao tem
require_once __DIR__ . "/../../../src/models/curso/Curso.php"; //nao tem
require_once __DIR__ . "/../../../src/models/foto/Foto.php"; //nao tem
require_once __DIR__ . "/../../../src/models/documento/Documento.php"; //nao tem
require_once __DIR__ . "/../../../src/validators/ValidadorUpdateEstagio.php"; //nao tem

if (isset($_GET["e"])) {
  require_once __DIR__ . "/estagio/index.php";
} else {
  require_once __DIR__ . "/listagem_estagios/index.php";
}
