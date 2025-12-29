<?php


ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../../src/models/usuario/validador.php";
require_once __DIR__ . "/../../src/utils/admin_required.php";

// admin_required();

session_start();

$validador_usuario = new ValidadorUsuario();

if (isset($_SESSION["validador"])) {
  $validador_usuario = $_SESSION["validador"];
  unset($_SESSION["validador"]);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link rel="stylesheet" href="../public/global.css">
  <link rel="stylesheet" href="./styles.css">
</head>

<body>
  <header class="header">
    <h1>Estag.io</h1>
  </header>

  <div class="main">
    <h1 class="title">Cadastro</h1>

    <div class="form-container">
      <form action="/ana/src/forms/cadastrar.php" method="post">
        <label class="label" for="nome">
          Nome:
          <input id="nome" name="nome" type="text">
          <p class="error-msg"><?= $validador_usuario->erro_nome ?></p>
        </label>

        <label class="label" for="sobrenome">
          Sobrenome(s):
          <input id="sobrenome" name="sobrenome" type="text">
          <p class="error-msg"><?= $validador_usuario->erro_nome ?></p>
        </label>

        <label class="label" for="login">
          Login:
          <input id="login" name="login" type="text">
          <p class="error-msg"><?= $validador_usuario->erro_nome ?></p>
        </label>

        <label class="label" for="email">
          Email:
          <input id="email" name="email" type="email">
          <p class="error-msg"><?= $validador_usuario->erro_nome ?></p>
        </label>

        <label class="label" for="senha">
          Senha:
          <input id="senha" name="senha" type="password">
          <p class="error-msg"><?= $validador_usuario->erro_nome ?></p>
        </label>

        <fieldset>
          <legend>Tipo:</legend>
          <label for="aluno">
            <input type="radio" name="tipo-usuario" value="aluno" id="aluno"> Aluno
          </label>
          <label for="professor">
            <input type="radio" name="tipo-usuario" value="professor" id="professor"> Professor
          </label>
          <label for="admin">
            <input type="radio" name="tipo-usuario" value="admin" id="admin"> Admin
          </label>
        </fieldset>

        <div class="button-container">
          <button type="submit">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>