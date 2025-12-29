<?php

require_once __DIR__ . "/Admin.php";
require_once __DIR__ . "/../validador.php";
require_once __DIR__ . "/../usuario/Usuario.php";

class ValidadorAdmin extends Validador
{
  public string $erro = "";
  
  public Admin $admin;

  public function __construct(?Admin $admin = null) {
    $this->admin = $admin ?? new Admin();
  }

  public function validar()
  {
    $this->validarUserId();
  }

  public function validarUserId()
  {
    $admin = Admin::find($this->admin->id_usuario);
    if (!$admin) {
      $this->valido = false;
      $this->erro = "Erro de sincronia.";
    }
  }
}
