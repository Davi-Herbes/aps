<?php
class CnpjRule
{
  public function validate($value)
  {
    if (!$value) {
      return true;
    }

    $cnpj = preg_replace('/\D/', '', $value);

    if (strlen($cnpj) != 14) {
      return "CNPJ inválido.";
    }

    if (preg_match('/^(\d)\1{13}$/', $cnpj)) {
      return "CNPJ inválido.";
    }

    $peso1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    $peso2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

    $soma = 0;
    for ($i = 0; $i < 12; $i++) {
      $soma += $cnpj[$i] * $peso1[$i];
    }

    $resto = $soma % 11;
    $digito1 = ($resto < 2) ? 0 : 11 - $resto;
    if ($cnpj[12] != $digito1) {
      return "CNPJ inválido.";
    }

    $soma = 0;
    for ($i = 0; $i < 13; $i++) {
      $soma += $cnpj[$i] * $peso2[$i];
    }

    $resto = $soma % 11;
    $digito2 = ($resto < 2) ? 0 : 11 - $resto;
    if ($cnpj[13] != $digito2) {
      return "CNPJ inválido.";
    }

    return true;
  }
}
