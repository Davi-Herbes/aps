<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

$with_error = false;

if (isset($_GET["error"])) {
  $with_error = true;
}

session_start();

$user_id = $_SESSION["idUsuario"];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header class="topo">
    <h2>Estag.io</h2>
  </header>

  <main>
    <h1 class="titulo"> Login <?= $user_id ?></h1>

    <form class="formLogin" action="../../src/forms/log_user.php" method="post">
      <div class="campos">
        <label for="login">Email:</label>
        <input id="login" name="login" type="email" required>

        <label for="senha">Senha:</label>
        <input id="senha" name="senha" type="password" required>
      </div>

      <button type="submit" class="botao">Entrar</button>
    </form>

    <p class="recuperar">
      Esqueceu sua senha?
      <a href="#">Recupere aqui</a>
    </p>

    <p class="recuperar">
      É professor e não tem cadastro?
      <a href="/2025/projeto/grupo1/pages/cadastrar/cadastroProfessor.php">Cadastre-se aqui</a>
    </p>

    <p class="recuperar">
      É aluno e não tem cadastro?
      <a href="/2025/projeto/grupo1/pages/cadastrar/cadastroAluno.php">Cadastre-se aqui</a>
    </p>

    <div class="erro-msg">
      <?php if ($with_error): ?>
        <p>Usuário ou senha errados</p>
      <?php endif; ?>
    </div>
  </main>
</body>

</html>