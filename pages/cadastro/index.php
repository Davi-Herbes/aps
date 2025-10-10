<?php

$with_error = false;

if (isset($_GET["error"])) {
  $with_error = true;
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

          <?php if ($with_error): ?>
            <p class="error-msg">Ocorreu um erro ao cadastrar o usuário</p>
          <?php endif; ?>
        </div>
        <form action="/ana/pages/cadastro/aluno.php" method="post">
          <label class="label" for="nome">Nome: <input id="nome" name="nome" type="text"></label>
          <label class="label" for="sobrenome">Sobrenome(s): <input id="sobrenome" name="sobrenome" type="text"></label>
          <label class="label" for="login">Login: <input id="login" name="login" type="text"></label>
          <label class="label" for="email">Email: <input id="email" name="email" type="email"></label>
          <label class="label" for="senha">Senha: <input id="senha" name="senha" type="password"></label>

          <div class="button-container">
            <button type="submit">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>