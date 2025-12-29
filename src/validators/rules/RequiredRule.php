<?php


class RequiredRule
{
  public function validate($data)
  {
    if ($data === null || $data === "") {
      return "Campo obrigatório.";
    }

    return true;
  }
}
