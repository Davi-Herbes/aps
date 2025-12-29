<?php

require_once __DIR__ . "/rules/_rules.php";
require_once __DIR__ . "/Validador.php";

class ValidadorDocumento extends Validador
{
  // $_FILES
  public function __construct($data)
  {
    $this->data = $data;

    $this->rules = [
      "arquivo" => [
        new FileRule(),
        new PdfRule()
      ],
      "id_estagio" => [
        new RequiredRule(),
      ],

      "tipo" => [
        new EnumRule(["confirmacao", "plano", "autorizacao", "avaliacao_orientador", "avaliacao_concedente", "relatorio"]),
      ],
      "validade" => [
        new DateRule(),
      ]
    ];

    $this->define_errors();
  }

  public function gerarErroGenerico()
  {
    $this->valido = false;
    $this->errors["generico"] = "Ocorreu um erro ao enviar o documento.";
  }
}
