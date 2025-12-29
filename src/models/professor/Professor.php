<?php

require_once __DIR__ . "/../../config/db/MySQL.php";
require_once __DIR__ . "/../usuario/Usuario.php";

class Professor
{
  public ?int $id;
  public ?string $status_disponibilidade;
  public static $column_names = ["ID_Professor", "Status_Disponibilidade"];

  public ?Usuario $user;

  public function __construct(
    ?int $id,
    ?string $status_disponibilidade
  ) {
    $this->id = $id;
    $this->status_disponibilidade = $status_disponibilidade;
  }

  public static function find($id)
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM professor WHERE ID_Professor = $id";
    $resultado = $conexao->consulta($sql);


    $professor = new Professor($resultado[0]['ID_Professor'], $resultado[0]['Status_Disponibilidade']);
    return $professor;
  }

  public static function instanciarArray($result, ?string $prefixo = null)
  {
    $prefixo = $prefixo ? "$prefixo." : "";

    $professor = new Professor(
      $result[$prefixo . "ID_Professor"] ?? null,
      $result[$prefixo . "Status_Disponibilidade"] ?? null,
    );

    return $professor;
  }

  public static function findAllJoinWithUser()
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM professor p JOIN usuario u ON u.ID_Usuario = p.ID_Professor";
    $resultado = $conexao->consulta($sql);

    $professores = [];


    foreach ($resultado as $p) {
      $professor = new Professor($p['ID_Professor'], $p['Matricula'], $p['ID_Curso'], $p['Ano_Ingresso']);
      $usuario = new Usuario($p["Nome"] ?? "", $p["Sobrenome"] ?? "", $p['Email'] ?? "", $p['Senha'] ?? "", $p['CPF'] ?? "", $p['Tipo_Usuario'] ?? "", $p['Data_Nascimento'] ?? "");
      $professor->id = $p["ID_Professor"];
      $professor->user = $usuario;
      $professores[] = $professor;
    }

    return $professor;
  }
}
