<?php
class CpfRule
{
  public function validate($value)
  {
    if (!$value) {
      return true;
    }

    $cpf = preg_replace('/\D/', '', $value);


    if (strlen($cpf) != 11) {
      return "CPF inválido.";
    }


    if (preg_match('/^(\d)\1{10}$/', $cpf)) {
      return "CPF inválido.";
    }


    for ($t = 9; $t < 11; $t++) {
      $soma = 0;

      for ($i = 0; $i < $t; $i++) {
        $soma += $cpf[$i] * (($t + 1) - $i);
      }

      $digito = ((10 * $soma) % 11) % 10;

      if ($cpf[$t] != $digito) {
        return "CPF inválido.";
      }
    }

    return true;
  }
}
