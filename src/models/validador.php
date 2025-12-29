<?php
class Validador
{
  public $valido = true;

  public function validate_string_range_1_50(string $valor_campo, string $nome_campo, string &$erro)
  {
    if (!$valor_campo) {
      $erro = "O campo $nome_campo é obrigatório.";
      $this->valido = false;
    } else if (strlen($valor_campo) > 50) {
      $erro = "O campo $nome_campo deve ter entre 1 e 50 caracteres.";
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

  public function validate_string($valor_campo, string $nome_campo, string &$erro)
  {
    if (gettype($valor_campo) !== "string") {
      $erro = "O campo $nome_campo é obrigatório.";
      $this->valido = false;
    }
  }

  public function validate_int($valor_campo, string $nome_campo, string &$erro)
  {
    if (gettype($valor_campo) !== "int") {
      $erro = "O campo $nome_campo é obrigatório.";
      $this->valido = false;
    }
  }

  public function validate_enum($valor_campo, string $nome_campo, string &$erro, array $valores_permitidos)
  {
    if (!in_array($valor_campo, $valores_permitidos, true)) {
      $erro = "O campo $nome_campo deve estar entre os valores permitidos: " . implode(", ", $valores_permitidos) . ".";
      $this->valido = false;
    }
  }


  public function validate_date(string $valor_campo, string $nome_campo, string &$erro)
  {

    $formato = "YYYY-MM-DD";
    $d = DateTime::createFromFormat($formato, $valor_campo);

    if ($d && $d->format($formato) === $valor_campo) {
      $this->valido = false;
      $erro = "A data do campo $nome_campo é inválida.";

    }  }
}
