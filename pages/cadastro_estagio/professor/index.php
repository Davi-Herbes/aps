<?php
// pega o $user_role do arquivo que importou ele
global $user_role;
global $user;

$professor;

if ($user_role instanceof Professor) {
  $professor = $user_role;
}

$alunos = Aluno::findAllJoinWithUser($professor->id);

$validador = new ValidadorCadastroEstagio([]);

if (isset($_SESSION["validador"])) {
  $validador = $_SESSION["validador"];
  unset($_SESSION["validador"]);
}


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estag.io - Professores</title>
  <link rel="stylesheet" href="/2025/projeto/grupo2/pages/cadastro_estagio/professor/styles.css">
</head>

<body>
  <header class="main-header">
    <a class="logo-estagirando" href="/2025/projeto/grupo1/privado.php">
      <img src="/2025/projeto/grupo2/public/imgs/arrow-left.svg" alt="">
      Estagirando
    </a>
    <a href="/2025/projeto/grupo2/" class="logo user-role-title">estag.io</a>
    <nav class="header-nav">
      <ul>
        <li>
          <a href="/2025/projeto/grupo1/pages/visualizar/visualizarProfessor.php?id=<?= $professor->id ?>">
            <img class="user-icon" src="/2025/projeto/grupo2/public/imgs/user-icon.svg" alt="">
          </a>
        </li>
        <li>
          <a href="/2025/projeto/grupo2/src/forms/log_out.php">
            <img class="exit-icon" src="/2025/projeto/grupo2/public/imgs/logout.svg" alt="">
          </a>
        </li>
      </ul>
    </nav>
  </header>
  <div class="page-container">

    <aside class="main-aside">
      <!-- <h2 class="main-aside-title">
        Estágios
      </h2> -->
      <nav class="aside-nav">
        <ul>
          <li><a href="/2025/projeto/grupo2/">
              <figure>
                <img src="/2025/projeto/grupo2/public/imgs/home.svg" alt="Imagem Listar">
                <figcaption>
                  Listar Estágios
                </figcaption>
              </figure>
            </a></li>

          <li class="selected"><a href="/2025/projeto/grupo2/pages/cadastro_estagio">
              <figure>
                <img src="/2025/projeto/grupo2/public/imgs/register.svg" alt="Imagem Registro">
                <figcaption>
                  Cadastrar Estágio
                </figcaption>
              </figure>
            </a></li>

        </ul>
      </nav>
    </aside>

    <section class="main-section">
      <h2 class="error-msg">
        <?= $validador->errors["generico"] ?>
      </h2>

      <div class="form-container">

        <form action="../../src/forms/cadastrar_estagio.php" method="POST" class="form">
          <h2>Informações do estágio</h2>
          <input type="hidden" id="id-aluno-input" name="id_aluno">


          <label class="cadastro" for="aluno-input">
            <span class="vermelho">* <span>Aluno:</span></span>

            <div class="datalist-input-container">
              <label class="input-label">
                <!-- <img class="aluno-input-search-icon" src="/2025/projeto/grupo2/public/imgs/search.svg" alt="search icon"> -->
                <input class="input-label-input" autocomplete="off" id="aluno-input" type="text" required>
                <img src="/2025/projeto/grupo2/public/imgs/arrow-down.svg" alt="arrow down icon">
              </label>


              <div hidden class="datalist-input-data">


                <ul>
                  <?php foreach ($alunos as $aluno): ?>
                    <li user-id="<?= $aluno->id ?>" value="<?= $aluno->user->nome ?>">
                      <div><?= $aluno->user->nome ?></div>
                      <div class="cpf-container"><?= $aluno->user->cpf ?></div>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["id_aluno"] ?>
          </p>

          <label class="cadastro" for="modalidade-input">Modalidade:
            <div class="datalist-input-container radio">

              <input id="presencial-input" type="radio" value="presencial" name="modalidade">
              <label class="cadastro" for="presencial-input">
                Presencial
              </label>
              <input id="remoto-input" type="radio" value="remoto" name="modalidade">
              <label class="cadastro" for="remoto-input">
                Remoto
              </label>
              <input id="hibrido-input" type="radio" value="hibrido" name="modalidade">
              <label class="cadastro" for="hibrido-input">
                Híbrido
              </label>
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["modalidade"] ?>
          </p>


          <label class="cadastro" for="turno-input">Turno:
            <div class="datalist-input-container radio">
              <input id="manha-input" type="radio" value="manha" name="turno">
              <label for="manha-input">
                Manhã
              </label>
              <input id="tarde-input" type="radio" value="tarde" name="turno">
              <label class="cadastro" for="tarde-input">
                Tarde
              </label>
              <input id="noite-input" type="radio" value="noite" name="turno">
              <label class="cadastro" for="noite-input">
                Noite
              </label>
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["turno"] ?>
          </p>




          <label class="cadastro" for="carga-hora-input">Carga horária semanal:
            <div class="datalist-input-container">
              <input name="hora_semana" id="carga-hora-input" type="number" min="1">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["hora_semana"] ?>
          </p>









          <label class="cadastro" for="data-inicio-input">Data de Início do Estágio:
            <div class="datalist-input-container">
              <input name="data_inicio" id="data-inicio-input" type="date">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["data_inicio"] ?>
          </p>



          <label class="cadastro" for="data-fim-input">Data de Conclusão do Estágio:
            <div class="datalist-input-container">
              <input name="data_fim" id="data-fim-input" type="date">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["data_fim"] ?>
          </p>



          <h2>Informações da empresa </h2>

          <label class="cadastro" for="nome-empresa-input">Nome da Empresa:
            <div class="datalist-input-container">
              <input name="nome_empresa" id="nome-empresa-input" type="text">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["nome_empresa"] ?>
          </p>


          <label class="cadastro" for="cpnj-input">CNPJ:
            <div class="datalist-input-container">
              <input placeholder="xx.xxx.xxx/xxxx-xx" name="cnpj_empresa" id="cpnj-input" type="text">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["cnpj_empresa"] ?>
          </p>




          <label class="cadastro" for="area-input">Área:
            <div class="datalist-input-container">
              <input name="area_empresa" id="area-input" type="text">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["area_empresa"] ?>
          </p>



          <label class="cadastro" for="telefone-input">Telefone:
            <div class="datalist-input-container">
              <input name="telefone_empresa" id="telefone-input" type="text" placeholder="(xx) xxxxx-xxxx">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["telefone_empresa"] ?>
          </p>


          <label class="cadastro" for="email-input">E-mail:
            <div class="datalist-input-container">
              <input name="email_empresa" id="email-input" type="text">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["email_empresa"] ?>
          </p>


          <h2>Representante da empresa</h2>
          <label class="cadastro" for="nome-representanteinput">Nome:
            <div class="datalist-input-container">
              <input name="nome_representante" id="nome-representante-input" type="text">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["nome_representante"] ?>
          </p>


          <label class="cadastro" for="cargo-input">Cargo:
            <div class="datalist-input-container">
              <input name="cargo_representante" id="cargo-input" type="text">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["cargo_representante"] ?>
          </p>



          <label class="cadastro" for="cpf-input">CPF:
            <div class="datalist-input-container">
              <input placeholder="xxx.xxx.xxx-xx" name="cpf_representante" id="cpf-input" type="text">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["cpf_representante"] ?>
          </p>

          <button class='cadastrar_estagio' type="submit">Cadastrar estágio</button>
        </form>
      </div>
    </section>
  </div>

  <script src="/2025/projeto/grupo2/public/js/global.js"></script>
  <script src="/2025/projeto/grupo2/pages/cadastro_estagio/professor/main.js"></script>

</body>

</html>