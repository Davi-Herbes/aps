<?php

require_once __DIR__ . "/../../config/db/MySQL.php";
require_once __DIR__ . "/../usuario/Usuario.php";
require_once __DIR__ . "/validador.php";

class Admin
{

  public function __construct(public int $usuario_id = "") {}

  public function save(): bool
  {
    $conexao = new MySQL();
    $sql = "INSERT INTO admin (Usuario_id) VALUES ('{$this->login}','{$this->senha}')";

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
    $u = new Usuario($resultado[0]['login'], $resultado[0]['senha']);
    $u->id = $resultado[0]['id'];
    return $u;
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
