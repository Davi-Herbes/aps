<?php


class RestrictCharsRule
{

  public function validate($data)
  {
    if (!$data) {
      return true;
    }
    if (!preg_match('/^[a-zA-Z0-9._]+$/', $data)) {
      return "Este campo deve conter apenas letras, números, ponto final e underline .";
    }

    return true;
  }
}
