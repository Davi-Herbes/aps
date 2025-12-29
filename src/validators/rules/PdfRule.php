<?php
class PdfRule
{
  public function validate(?array $file)
  {

    if (!$file) {
      return true;
    }

    if ($file['error'] === UPLOAD_ERR_NO_FILE) {
      return true;
    }
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if ($ext !== 'pdf') {
      return "O arquivo deve ser um PDF.";
    }

    return true;
  }
}
