<?php

// acho q daria pra botar o tipo de usuário na tabela de usuário no banco de dados, sendo "admin", "aluno", ou "professor"
// porque no log_user.php ele faz um select de usuário que é pra ser salvo na sessão, e não dá pra saber o tipo do usuário com esse select
// se a gente tem o tipo dele, a gente também salva na seção uma instância de um Admin, Aluno ou Professor, dependendo do tipo que tiver no Usuário

require_once __DIR__ . "/../../config/db/MySQL.php";

class Usuario
{
  public static $column_names = ["ID_Usuario", "Nome", "Sobrenome", "Email", "Senha", "CPF", "Tipo_Usuario", "Data_Nascimento", "Status_Cadastro"];

  public int $id;
  public ?string $nome;
  public ?string $sobrenome;
  public ?string $email;
  public ?string $senha;
  public ?string $cpf;
  public ?string $tipo;
  public ?string $data_nasc;
  public ?string $status_cadastro;

  public function __construct(
    ?string $nome = null,
    ?string $sobrenome = null,
    ?string $email = null,
    ?string $senha = null,
    ?string $cpf = null,
    ?string $tipo = null,
    ?string $data_nasc = null,
    ?string $status_cadastro = null
  ) {
    $this->email = $email;
    $this->nome = $nome;
    $this->sobrenome = $sobrenome;
    $this->senha = $senha;
    $this->cpf = $cpf;
    $this->tipo = $tipo;
    $this->data_nasc = $data_nasc;
    $this->status_cadastro = $status_cadastro;
  }


  public static function find($id): Usuario
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM usuario WHERE ID_Usuario = {$id}";
    $resultado = $conexao->consulta($sql)[0];

    return Usuario::instanciarArray($resultado);
  }

  public static function instanciarArray($result, ?string $prefixo = null)
  {
    $prefixo = $prefixo ? "$prefixo." : "";

    $usuario = new Usuario(
      $result[$prefixo . "Nome"] ?? null,
      $result[$prefixo . "Sobrenome"] ?? null,
      $result[$prefixo . "Email"] ?? null,
      $result[$prefixo . "Senha"] ?? null,
      $result[$prefixo . "CPF"] ?? null,
      $result[$prefixo . "Tipo_Usuario"] ?? null,
      $result[$prefixo . "Data_Nascimento"] ?? null,
      $result[$prefixo . "Status_Cadastro"] ?? null
    );

    $usuario->id = $result[$prefixo . "ID_Usuario"] ?? null;

    return $usuario;
  }

  public static function findByemail($email): ?Usuario
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM usuario WHERE Email = '$email';";
    $resultado = $conexao->consulta($sql);

    if (!$resultado || !isset($resultado[0])) {
      return null;
    }

    return Usuario::instanciarArray($resultado[0]);
  }

  public static function validar_login($email, $senha)
  {
    $usuario = Usuario::findByemail($email);

    // se não encontrou o usuário, retorna false (tratado como credenciais inválidas)
    if (!$usuario) {
      return null;
    }

    if (password_verify($senha, $usuario->senha)) {
      return $usuario;
    } else {
      return null;
    }
  }
}
