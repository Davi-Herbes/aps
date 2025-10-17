<?php

function user_id_required()
{
    $user_id_exists = false;

    if (isset($_GET["user_id"])) {
        $user_id_exists = true;
    }

    if (!$user_id_exists) {
        navegar("/ana/pages/cadastro");
    }
}
