<?php

require_once __DIR__ . "/../../config/db/MySQL.php";
require_once __DIR__ . "/../usuario/Usuario.php";
require_once __DIR__ . "/../Model.php";


class Documento extends Model
{
  public static $column_names = [
    "id",
    "nome_arquivo",
    "extensao",
    "path",
    "tipo",
    "validade",
    "updated_at",
    "id_estagio"
  ];

  public ?int $id = null;
  public ?string $nome_arquivo;
  public ?string $extensao;
  public ?string $path;
  public ?string $tipo;
  public ?string $validade;
  public ?string $updated_at;
  public ?int $id_estagio;

  public function __construct(?string $nome_arquivo = null, ?string $extensao = null, ?string $path = null, ?string $tipo = null, ?string $validade = null, ?string $updated_at = null, ?int $id_estagio = null)
  {
    $this->nome_arquivo = $nome_arquivo;
    $this->extensao = $extensao;
    $this->path = $path;
    $this->tipo = $tipo;
    $this->validade = $validade;
    $this->updated_at = $updated_at;
    $this->id_estagio = $id_estagio;
  }

  public function save()
  {
    $conexao = new MySQL();

    if (isset($this->id)) {
      $sql = $this->generateUpdateSql("Documento", "id", $this->id);
    } else {
      $sql = $this->generateInsertSql("Documento");
    }

    return [$conexao->executa($sql), $sql];
  }

  public static function instanciarArray($result, ?string $prefixo = null)
  {
    $prefixo = $prefixo ? "$prefixo." : "";

    $documento = new Documento(
      isset($result[$prefixo . "nome_arquivo"]) ? $result[$prefixo . "nome_arquivo"] : null,
      isset($result[$prefixo . "extensao"]) ? $result[$prefixo . "extensao"] : null,
      isset($result[$prefixo . "path"]) ? $result[$prefixo . "path"] : null,
      isset($result[$prefixo . "tipo"]) ? $result[$prefixo . "tipo"] : null,
      isset($result[$prefixo . "validade"]) ? $result[$prefixo . "validade"] : null,
      isset($result[$prefixo . "updated_at"]) ? $result[$prefixo . "updated_at"] : null,
      isset($result[$prefixo . "id_estagio"]) ? $result[$prefixo . "id_estagio"] : null,
    );

    $documento->id = $result[$prefixo . 'id'] ?? null;
    return $documento;
  }


  public static function find($id): Documento
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM Documento WHERE id = {$id}";
    $resultado = $conexao->consulta($sql)[0];

    return Documento::instanciarArray($resultado);
  }


  public static function findByEstagio($id_estagio): array
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM Documento WHERE id_estagio = {$id_estagio}";
    $resultado = $conexao->consulta($sql);

    $docs = [];

    foreach ($resultado as $r) {
      $docs[] = Documento::instanciarArray($r);
    }

    return $docs;
  }
  public static function delete($id): bool
  {
    $conexao = new MySQL();
    $sql = "DELETE FROM Documento WHERE id = {$id}";
    return $conexao->executa($sql);
  }
}

  



/*public static function usuarioFromConsulta($resultado): Usuario
    {

        $r = $resultado[0];

        $u = new Usuario($r["nome"], $r["sobrenome"], $r['email'], $r['senha'], $r['cpf'],  $r['tipo'], $r['data_nasc']);
        $u->id = $resultado[0]['id'];
        return $u;
    }

    public static function findByemail($email): Usuario
    {
        $conexao = new MySQL();
        $sql = "SELECT * FROM Usuario WHERE email = '$email';";
        $resultado = $conexao->consulta($sql);

        return Usuario::usuarioFromConsulta($resultado);
    }

    public static function validar_login($email, $senha)
    {
        $usuario = Usuario::findByemail($email);

        if (password_verify($senha, $usuario->senha)) {
            return $usuario;
        } else {
            return false;
        }
    }
}*/
