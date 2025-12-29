<?php
class FileRule
{
  public function validate(?array $file)
  {
    if (!$file) {
      return true;
    }

    if ($file['error'] === UPLOAD_ERR_NO_FILE) {
      return true;
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
      return "Falha ao enviar o arquivo.";
    }

    // Nome vazio ou só espaços
    if (!isset($file['name']) || trim($file['name']) === '') {
      return "O arquivo enviado é inválido.";
    }

    return true;
  }
}
