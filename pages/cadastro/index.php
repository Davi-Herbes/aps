<?php

require_once __DIR__ . "/../../src/models/usuario/validador.php";
session_start();

$validador_usuario = new ValidadorUsuario();

if (isset($_SESSION["validador"])) {
  $validador_usuario = $_SESSION["validador"];
  unset($_SESSION["validador"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link rel="stylesheet" href="/ana/public/global.css">
  <link rel="stylesheet" href="/ana/pages/cadastro/styles.css">
</head>

<body>
  <div class="main">
    <header class="header">
      <h1 class="title">
        Cadastro
      </h1>
    </header>
    <div class="main-section">
      <div class="form-container">
        <div class="title-container">
          <h1>Dados de usuário</h1>
        </div>
        <form action="/ana/pages/cadastro/cadastrar.php" method="post">
          <label class="label" for="nome">
            Nome:
            <input id="nome" name="nome" type="text">
            <p class="error-msg"><?php echo $validador_usuario->erro_nome ?></p>
          </label>

          <label class="label" for="sobrenome">Sobrenome(s):
            <input id="sobrenome" name="sobrenome" type="text">
            <p class="error-msg"><?php echo $validador_usuario->erro_sobrenome ?></p>
          </label>

          <label class="label" for="login">
            Login:
            <input id="login" name="login" type="text">
            <p class="error-msg"><?php echo $validador_usuario->erro_login ?></p>
          </label>

          <label class="label" for="email">
            Email:
            <input id="email" name="email" type="email">
            <p class="error-msg"><?php echo $validador_usuario->erro_email ?></p>
          </label>

          <label class="label" for="senha">
            Senha:
            <input id="senha" name="senha" type="password">
            <p class="error-msg"><?php echo $validador_usuario->erro_senha ?></p>
          </label>

          <div class="label">
            <fieldset>
              <legend>Tipo:</legend>
              <label for="aluno">
                Aluno
                <input type="radio" name="tipo-usuario" value="aluno" id="aluno">
              </label>
              <label for="professor">
                Professor
                <input type="radio" name="tipo-usuario" value="professor" id="professor">
              </label>
              <label for="admin">
                Admin
                <input type="radio" name="tipo-usuario" value="admin" id="admin">
              </label>
            </fieldset>

            <p class="error-msg"><?php echo $validador_usuario->erro_tipo ?></p>
          </div>

          <div class="button-container">
            <button type="submit">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>