<?php


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
        <header class="header">OPA</header>
        <div class="form-container">
            <form action="/ana/src/utils/cadastrar.php" method="post">
                <h1>Cadastrar</h1>
                <!-- <label for="nome">Nome completo: <input id="nome" name="nome" type="text"></label> -->
                <label for="login">Email: <input id="login" name="login" type="email"></label>
                <label for="senha">Senha: <input id="senha" name="senha" type="password"></label>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>

</body>

</html>