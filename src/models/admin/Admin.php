<?php

require_once __DIR__ . "/../../config/db/MySQL.php";
require_once __DIR__ . "/../usuario/Usuario.php";


class Admin
{
  public int $id;
  public int $id_usuario;
  public function __construct(?int $id_usuario)
  {
    $this->id_usuario = $id_usuario;
  }

  public function save(): bool
  {
    $conexao = new MySQL();
    $sql = "INSERT INTO Admin (id_usuario) VALUES ('{$this->id_usuario}')";
    return $conexao->executa($sql);
  }


  public static function find($id): Admin
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM Admin WHERE id_usuario = {$id}";
    $resultado = $conexao->consulta($sql);
    $admin = new Admin($resultado[0]['id_usuario']);
    $admin->id = $resultado[0]["id"];
    return $admin;
  }


  public static function usuarioFromConsulta($resultado): Usuario
  {

    $r = $resultado[0];

    $u = new Usuario($r["Nome"], $r["Sobrenome"], $r['Email'], $r['Senha'], $r['CPF'],  $r['tipo'], $r['Data_nasc']);
    $u->id = $resultado[0]['id'];
    return $u;
  }

  public static function findByemail($email): Usuario
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM Usuario WHERE email = '$email';";
    $resultado = $conexao->consulta($sql)[0];

    return Usuario::instanciarArray($resultado);
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
}
