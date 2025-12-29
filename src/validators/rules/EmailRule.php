<?php

class EmailRule
{
  public function validate($data)
  {
    if (!$data) {
      return true;
    }
    if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
      return "email inválido";
    }
    return true;
  }
}
