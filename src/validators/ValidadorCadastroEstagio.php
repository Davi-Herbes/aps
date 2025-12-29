<?php

require_once __DIR__ . "/rules/_rules.php";
require_once __DIR__ . "/Validador.php";

class ValidadorCadastroEstagio extends Validador
{
  public function __construct($data)
  {
    $this->data = $data;

    $this->rules = [
      "id_aluno" => [
        new RequiredRule(),
      ],
      "modalidade" => [
        new StringRule(),
        new EnumRule(["presencial", "remoto", "hibrido"]),
      ],
      "turno" => [
        new StringRule(),
        new EnumRule(["tarde", "noite", "manha", "integral"]),
      ],
      "hora_semana" => [
        new NumberRule(),
      ],
      "data_inicio" => [
        new DateRule(),
      ],
      "data_fim" => [
        new DateRule(),
        new DateCoherenceRule($this->data["data_inicio"] ?? ""),
      ],
      "nome_empresa" => [
        new StringRule(),
        new MaxRule(150),
      ],
      "cnpj_empresa" => [
        new StringRule(),
        new MaxRule(18),
        new CnpjRule(),
      ],
      "area_empresa" => [
        new StringRule(),
        new MaxRule(30),
      ],
      "telefone_empresa" => [
        new StringRule(),
        new MaxRule(15),
      ],
      "email_empresa" => [
        new EmailRule(),
        new MaxRule(50),
      ],
      "nome_representante" => [
        new StringRule(),
        new MaxRule(50),
      ],
      "cargo_representante" => [
        new StringRule(),
        new MaxRule(30),
      ],
      "cpf_representante" => [
        new StringRule(),
        new MaxRule(14),
        new CpfRule(),
      ],
    ];

    $this->define_errors();
  }

  public function gerarErroGenerico()
  {
    $this->errors["generico"] = "Ocorreu um erro ao cadastrar o estágio.";
  }
}
