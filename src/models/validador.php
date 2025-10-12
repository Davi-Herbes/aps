<?php
class Validador
{
  public $valido = true;

  public function validate_range(string $valor_campo, string $nome_campo, string &$erro)
  {
    if (!$valor_campo) {
      $erro = "O campo $nome_campo é obrigatório.";
      $this->valido = false;
    } else if (strlen($valor_campo) < 3 || strlen($valor_campo) > 50) {
      $erro = "O campo $nome_campo deve ter entre 3 e 50 caracteres.";
      $this->valido = false;
    }
  }

  public function validate_email(string $valor_campo, string $nome_campo, string &$erro)
  {
    if (!filter_var($valor_campo, FILTER_VALIDATE_EMAIL)) {
      $erro = "$nome_campo inválido.";
      $this->valido = false;
    }
  }


  public function validate_chars(string $valor_campo, string $nome_campo, string &$erro)
  {
    if (!preg_match('/^[a-zA-Z0-9._]+$/', $valor_campo)) {
      $erro = "O campo $nome_campo só permite letras, números, underline '_' e ponto final '.'.";
      $this->valido = false;
    }
  }

  public function validate_string(string $valor_campo, string $nome_campo, string &$erro)
  {
    if (gettype($valor_campo) !== "string") {
      $erro = "O campo $nome_campo é obrigatório.";
      $this->valido = false;
    }
  }

  public function validate_int(string $valor_campo, string $nome_campo, string &$erro)
  {
    if (gettype($valor_campo) !== "int") {
      $erro = "O campo $nome_campo é obrigatório.";
      $this->valido = false;
    }
  }
}
