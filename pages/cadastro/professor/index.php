<?php

//require_once __DIR__ . "/../utils/user_id_required.php";
//user_id_required();


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro Professor</title>
  <link rel="stylesheet" href="../../../public/global.css">
  <link rel="stylesheet" href="../styles.css">
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

        <h1>Dados do Professor</h1>
        <form action="/ana/src/utils/cadastrar.php" method="post">
          <label class="label" for="data_nasc">Data de nascimento: <input id="data_nasc" name="data_nasc" type="date"></label>

          <div class="button-container">
            <button type="submit">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>