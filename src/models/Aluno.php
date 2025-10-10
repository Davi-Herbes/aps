<?php

require_once __DIR__ . "\..\config\db\MySQL.php";
require_once __DIR__ . "\Usuario.php";

class Aluno
{




  public function __construct(public int $usuario_id, public int $matricula, public string $curso, public int $ano, public string $data_nasc) {}

  public function save(): bool
  {
    $conexao = new MySQL();
    if (isset($this->usuario_id)) {
      $sql = "UPDATE Aluno SET usuario_id = '{$this->usuario_id}', matricula = '{$this->matricula}', curso = '{$this->curso}', ano = '{$this->ano}', data_nasc = '{$this->data_nasc}'
       WHERE usuario_id = {$this->usuario_id}";
    } else {
      $sql = "INSERT INTO Aluno (usuario_id, matricula, curso, ano, data_nasc) VALUES ('{$this->usuario_id}','{$this->matricula}','{$this->curso}','{$this->ano}','{$this->data_nasc}')";
    }
    return $conexao->executa($sql);
  }

  public static function delete($usuario_id)
  {
    $conexao = new MySQL();
    $sql = "DELETE FROM Aluno WHERE usuario_id = {$usuario_id}";
    $resultado = $conexao->executa($sql);
    return $resultado;
  }

  public static function find($usuario_id): Aluno
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM Aluno WHERE usuario_id = {$usuario_id}";
    $resultado = $conexao->consulta($sql);
    $u = new Aluno($resultado[0]['usuario_id'], $resultado[0]['matricula'], $resultado[0][' curso'], $resultado[0]['ano'], $resultado[0]['data_nasc']);
    $u->usuario_id = $resultado[0]['usuario_id'];
    return $u;
  }
}
