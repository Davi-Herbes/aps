<?php

require_once __DIR__ . "/../Model.php";

class Curso extends Model
{
  public ?int $id = null;
  public ?string $nome = null;
  public static $column_names = ["ID_Curso", "Nome"];

  public function __construct(?string $nome)
  {
    $this->nome = $nome;
  }


  public static function instanciarArray($result, ?string $prefixo = null)
  {
    $prefixo = $prefixo ? "$prefixo." : "";

    $curso = new Curso(
      $result[$prefixo . "Nome"] ?? null,
    );

    $curso->id = $result[$prefixo . 'ID_Curso'] ?? null;
    return $curso;
  }
}
