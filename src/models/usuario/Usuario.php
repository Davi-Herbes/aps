<?php

// acho q daria pra botar o tipo de usuário na tabela de usuário no banco de dados, sendo "admin", "aluno", ou "professor"
// porque no log_user.php ele faz um select de usuário que é pra ser salvo na sessão, e não dá pra saber o tipo do usuário com esse select
// se a gente tem o tipo dele, a gente também salva na seção uma instância de um Admin, Aluno ou Professor, dependendo do tipo que tiver no Usuário

require_once __DIR__ . "/../../config/db/MySQL.php";
require_once __DIR__ . "/validador.php";

class Usuario
{
  private bool $saved = false;

  public int $id;

  public function __construct(
    public string $nome = "",
    public string $sobrenome = "",
    public string $login = "",
    public string $email = "",
    public string $tipo = "",
    public string $senha = ""
  ) {}

  public function save(): bool
  {
    $conexao = new MySQL();
    $this->senha = password_hash($this->senha, PASSWORD_BCRYPT);
    if (isset($this->id)) {
      $sql = "UPDATE usuario SET nome = '{$this->nome}', sobrenome = '{$this->sobrenome}', login = '{$this->login}' ,email = '{$this->email}',senha = '{$this->senha}' WHERE id = {$this->id}";
    } else {
      $sql = "INSERT INTO usuario (nome, sobrenome, login, email, senha) VALUES ('{$this->nome}', '{$this->sobrenome}', '{$this->login}' ,'{$this->email}','{$this->senha}')";
    }
    $result = $conexao->executa($sql);

    $this->saved = $result;
    return $result;
  }

  // $user = new User(<valores>);
  // $user->save();
  public function set_user_id()
  {
    if ($this->saved) {
      $user = Usuario::findBylogin($this->login);
      $this->id = $user->id;
    }
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
    $r = $resultado[0];

    $usuario = new Usuario($r["nome"], $r["sobrenome"], $r['login'], $r['email'], $r['senha']);
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
