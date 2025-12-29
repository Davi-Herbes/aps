<?php
require_once __DIR__ . "/../../../src/utils/navegar.php";
require_once __DIR__ . "/../../../src/models/admin/Admin.php";

require_once __DIR__ . "/../utils/user_id_required.php";
user_id_required();

$user_id = $_GET["user_id"];

$user = new Admin($user_id);

$validador = new ValidadorAdmin($user);
$validador->validar();

navegar("../../../");
