<?php


class StringRule
{
  public function validate($data)
  {
    if (!$data) {
      return true;
    }

    if (gettype($data) !== "string") {
      return "Campo obrigatório.";
    }

    return true;
  }
}
