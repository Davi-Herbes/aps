<?php
class DateRule
{
  public function validate($data)
  {
    if (!$data) {
      return true;
    }

    $formato = "Y-m-d";
    $d = DateTime::createFromFormat($formato, $data);

    if (!$d || $d->format($formato) !== $data) {
      return "Campo inválido.";
    }
    return true;
  }
}
