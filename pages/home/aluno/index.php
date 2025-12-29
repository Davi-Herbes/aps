<?php

require_once __DIR__ . "/../../../src/models/estagio/Estagio.php";
require_once __DIR__ . "/../../../src/models/curso/Curso.php";
require_once __DIR__ . "/../../../src/models/foto/Foto.php";
require_once __DIR__ . "/../../../src/validators/ValidadorDocumento.php";
require_once __DIR__ . "/../../../src/models/documento/Documento.php";

if (isset($_GET["e"])) {
  require_once __DIR__ . "/estagio/index.php";
} else {
  require_once __DIR__ . "/listagem_estagios/index.php";
}
