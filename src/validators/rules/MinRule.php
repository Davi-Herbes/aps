<?php


class MinRule
{
  public int $min = 1;

  public function __construct(int $min)
  {
    $this->min = $min;
  }

  public function validate($data)
  {
    if (!$data) {
      return true;
    }

    if (strlen($data) < $this->min) {
      return "Campo deve ter pelo menos $this->min caracteres.";
    }

    return true;
  }
}
