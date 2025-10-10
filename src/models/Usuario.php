<?php

require_once __DIR__ . "\..\config\db\MySQL.php";

class Usuario
{

  public int $id;

  public function __construct(public string $login, public string $senha) {}

  public function save(): bool
  {
    $conexao = new MySQL();
    $this->senha = password_hash($this->senha, PASSWORD_BCRYPT);
    if (isset($this->id)) {
      $sql = "UPDATE usuario SET login = '{$this->login}' ,senha = '{$this->senha}' WHERE id = {$this->id}";
    } else {
      $sql = "INSERT INTO usuario (login,senha) VALUES ('{$this->login}','{$this->senha}')";
    }
    return $conexao->executa($sql);
  }



  public static function find($id): Usuario
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM usuario WHERE id = {$id}";
    $resultado = $conexao->consulta($sql);

    return Usuario::usuarioFromConsulta($resultado);
  }

  public static function usuarioFromConsulta($resultado): Usuario
  {
    $usuario = new Usuario($resultado[0]['login'], $resultado[0]['senha']);
    $usuario->id = $resultado[0]['id'];
    return $usuario;
  }

  public static function findBylogin($login): Usuario
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM usuario WHERE login = '$login';";
    $resultado = $conexao->consulta($sql);

    return Usuario::usuarioFromConsulta($resultado);
  }

  public static function validar_login($login, $senha): bool | Usuario
  {
    $usuario = Usuario::findBylogin($login);

    if (password_verify($senha, $usuario->senha)) {
      return $usuario;
    } else {
      return false;
    }
  }
}
