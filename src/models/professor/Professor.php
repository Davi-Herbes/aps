<?php
class Professor
{
  public int $id;
  public function __construct(public string $data_nasc, public int $usuario_id) {}

  public function save(): bool
  {
    $conexao = new MySQL();

    if (isset($this->id)) {
      $sql = "UPDATE professor SET Usuario_id = '{$this->usuario_id}', data_nasc = '{$this->data_nasc}' WHERE Usuario_id = '{$this->usuario_id}'";
    } else {
      $sql = "INSERT INTO professor (data_nasc, Usuario_id) VALUES ('{$this->data_nasc}', '{$this->usuario_id}')";
    }

    return $conexao->executa($sql);
  }

  public static function find($id)
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM professor WHERE Usuario_id = {$id}";
    $resultado = $conexao->consulta($sql);


    $professor = new Professor($resultado[0]['data_nasc'], $resultado[0]['Usuario_id']);
    $professor->id = $resultado[0]['Usuario_id'];
    return $professor;
  }

  public function delete($id)
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM professor WHERE Usuario_id = {$id}";
    return $conexao->executa($sql);
  }
}
