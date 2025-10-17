<?php
require_once __DIR__ . "/../utils/user_id_required.php";
user_id_required();


$user_id = $_GET["user_id"];

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro Aluno</title>
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


        <h1>Dados de aluno</h1>
        <form action="/ana/src/utils/cadastrar.php" method="post">
          <label class="label" for="matricula">Matricula: <input id="matricula" name="matricula" type="text"></label>
          <fieldset class="label">
            <legend>Curso:</legend>
            <label>
              TADM
              <input name="curso" value="tadm" type="radio">
            </label>
            <label>
              TI
              <input name="curso" value="ti" type="radio">
            </label>
            <label>
              TQ
              <input name="curso" value="tq" type="radio">
            </label>
            <label>
              TMA
              <input name="curso" value="tma" type="radio">
            </label>
          </fieldset>
          <label class="label" for="ano">Ano: <input id="ano" name="ano" type="text"></label>
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