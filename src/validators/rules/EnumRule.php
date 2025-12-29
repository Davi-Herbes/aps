<?php


class EnumRule
{
  public array $allowedValues = [];

  public function __construct(array $allowedValues)
  {
    $this->allowedValues = $allowedValues;
  }

  public function validate($data)
  {
    if (!$data) {
      return true;
    }

    if (!in_array($data, $this->allowedValues, true)) {
      return "Campo obrigatório.";
    }

    return true;
  }
}
