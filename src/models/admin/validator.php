<?php

require_once __DIR__ . "/Admin.php";
require_once __DIR__ . "/../validador.php";
require_once __DIR__ . "/../usuario/Usuario.php";

class ValidadorAdmin extends Validador
{
  public string $erro = "";

  public function __construct(public Admin $admin = new Admin()) {}

  public function validar()
  {
    $this->validarUserId();
  }

  public function validarUserId()
  {
    $admin = Admin::find($this->admin->usuario_id);
    if (!$admin) {
      $this->valido = false;
      $this->erro = "Erro de sincronia.";
    }
  }
}
