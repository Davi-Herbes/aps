<?php
require_once __DIR__ . "/Usuario.php";
require_once __DIR__ . "/../validador.php";

class ValidadorUsuario extends Validador
{
  public $erro_nome = "";
  public $erro_sobrenome = "";
  public $erro_login = "";
  public $erro_email = "";
  public $erro_senha = "";
  public $erro_tipo = "";

  public function __construct(private Usuario $usuario = new Usuario()) {}

  public function validar()
  {

    $this->validar_nome();
    $this->validar_sobrenome();
    $this->validar_login();
    $this->validar_email();
    $this->validar_senha();
    $this->validar_tipo();
  }

  public function erro_generico()
  {
    $this->erro_tipo = "Algo deu errado ao cadastrar usuário.";
  }

  private function validar_nome()
  {
    $nome = $this->usuario->nome;
    $this->validate_range($nome, "Nome", $this->erro_nome);
  }

  private function validar_sobrenome()
  {
    $sobrenome = $this->usuario->sobrenome;
    $this->validate_range($sobrenome, "Sobrenome", $this->erro_sobrenome);
  }

  private function validar_email()
  {
    $email = $this->usuario->email;

    $this->validate_email($email, "E-mail", $this->erro_email);
    $this->validate_range($email, "E-mail", $this->erro_email);
  }

  private function validar_login()
  {
    $login = $this->usuario->login;

    $this->validate_chars($login, "Login", $this->erro_login);
    $this->validate_range($login, "Login", $this->erro_login);
  }


  private function validar_senha()
  {
    $senha = $this->usuario->senha;

    $this->validate_range($senha, "Senha", $this->erro_senha);
  }

  private function validar_tipo()
  {
    $tipo_usuario = $this->usuario->tipo;
    $valores_permitidos = ["aluno", "professor", "admin"];

    $this->validate_enum($tipo_usuario, "Tipo", $this->erro_tipo, $valores_permitidos);
    $this->validate_string($tipo_usuario, "Tipo", $this->erro_tipo);
  }
}
