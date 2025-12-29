<?php

require_once __DIR__ . "/../../config/db/MySQL.php";
require_once __DIR__ . "/../usuario/Usuario.php";

class Aluno
{
  public static $column_names = ["ID_Aluno", "ID_Curso", "Ano_Ingresso", "Matricula", "Modalidade", "Turno_Disponivel", "Status_Estagio"];

  public ?int $id;
  public ?int $id_curso;

  public ?int $ano_ingresso;

  public ?string $matricula;
  public ?string $modalidade;
  public ?string $turno_disponivel;
  public ?string $status_estagio;

  public ?Usuario $user;

  public function __construct(?int $id_usuario = null, ?int $id_curso, ?int $ano_ingresso = null, ?string $matricula = null, ?string $modalidade, ?string $turno_disponivel, ?string $status_estagio)
  {

    $this->id = $id_usuario;
    $this->id_curso = $id_curso;

    $this->ano_ingresso = $ano_ingresso;

    $this->matricula = $matricula;
    $this->modalidade = $modalidade;
    $this->turno_disponivel = $turno_disponivel;
    $this->status_estagio = $status_estagio;
  }

  public static function instanciarArray($result, ?string $prefixo = null)
  {
    $prefixo = $prefixo ? "$prefixo." : "";

    $aluno = new Aluno(
      $result[$prefixo . "ID_Aluno"] ?? null,
      $result[$prefixo . "ID_Curso"] ?? null,
      $result[$prefixo . "Ano_Ingresso"] ?? null,
      $result[$prefixo . "Matricula"] ?? null,
      $result[$prefixo . "Modalidade"] ?? null,
      $result[$prefixo . "Turno_Disponivel"] ?? null,
      $result[$prefixo . "Status_Estagio"] ?? null
    );

    return $aluno;
  }

  public static function find($id_usuario): Aluno
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM aluno WHERE ID_Aluno = {$id_usuario}";
    $resultado = $conexao->consulta($sql)[0];
    $aluno = Aluno::instanciarArray($resultado);
    return $aluno;
  }



  public static function findAllJoinWithUser()
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM aluno a JOIN usuario u ON u.ID_Usuario = a.ID_Aluno";
    $resultado = $conexao->consulta($sql);

    $alunos = [];


    foreach ($resultado as $a) {
      $aluno = Aluno::instanciarArray($a);
      $usuario = Usuario::instanciarArray($a);

      $aluno->user = $usuario;
      $alunos[] = $aluno;
    }

    return $alunos;
  }
}
