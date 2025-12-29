<?php

require_once __DIR__ . "/../Model.php";

class Foto extends Model
{

  public static $column_names = ["ID_Foto", "Nome_Foto", "Link_Foto"];

  public ?int $id = null;
  public ?string $nome = null;
  public ?string $url = null;

  public function __construct(?string $nome, ?string $url)
  {
    $this->nome = $nome;
    $this->url = $url;
  }


  public static function instanciarArray($result, ?string $prefixo = null)
  {
    $prefixo = $prefixo ? "$prefixo." : "";

    $foto = new Foto(
      $result[$prefixo . "Nome_Foto"] ?? null,
      $result[$prefixo . "Link_Foto"] ?? null,
    );

    $foto->id = $result[$prefixo . 'ID_Foto'] ?? null;
    return $foto;
  }
}
