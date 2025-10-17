<?php
require_once __DIR__ . "/../models/usuario/Usuario.php";
require_once __DIR__ . "/navegar.php";

function admin_required()
{
    session_start();

    if (!isset($_SESSION["user"])) {
        navegar("Location: /ana/");
    }

    if ($_SESSION["user"]->tipo !== "admin") {
        navegar("Location: /ana/");
    }
}
