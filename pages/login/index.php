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
  <title>Login</title>
  <link rel="stylesheet" href="/ana/pages/login/style.css">
  <link rel="stylesheet" href="/ana/public/css/global.css">
</head>

<body>
  <div class="título">
    <h1>Login</h1>
  </div>

  <div class="form">
    <form action="/ana/src/utils/log_user.php" method="post">
      <label for="email">Email: <input id="email" name="email" type="email"></label>
      <label for="senha">Senha: <input id="senha" name="senha" type="password"></label>
      <button type="submit" class="botao">Enviar</button>
    </form>
  </div>

  <div class="erro-msg">
    <?php if ($with_error): ?>
      <p class="error-msg">Usuário ou senha errados</p>
    <?php endif; ?>
  </div>

</body>

</html>