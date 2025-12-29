<?php


class NumberRule
{
  public function validate($data)
  {
    if (!$data) {
      return true;
    }

    if (!filter_var($data, FILTER_VALIDATE_INT) || !filter_var($data, FILTER_VALIDATE_FLOAT)) {
      return "Campo obrigatório.";
    }

    return true;
  }
}
