<?php


class MaxRule
{
  public int $max = 1;

  public function __construct(int $max)
  {
    $this->max = $max;
  }

  public function validate($data)
  {
    if (!$data) {
      return true;
    }
    if (strlen($data) > $this->max) {
      return "Campo deve no máximo $this->max caracteres.";
    }

    return true;
  }
}
