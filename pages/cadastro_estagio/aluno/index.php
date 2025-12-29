<?php
// pega o $user_role do arquivo que importou ele
global $user_role;

$aluno;

if ($user_role instanceof Aluno) {
  $aluno = $user_role;
}

$alunos = Aluno::findAllJoinWithUser($aluno->id);


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
    <span class="logo">Estag.io</span>
    <span class="logo user-role-title">Professores</span>
    <nav class="header-nav">
      <ul>
        <li>
          <a href="/2025/projeto/grupo2/src/forms/log_out.php">
            Logout
          </a>
        </li>
        <li>
          <a href="/2025/projeto/grupo1/pages/visualizar/visualizarAluno.php?id=<?= $aluno->id ?>">
            Perfil
          </a>
        </li>
        <li>
          <a href="/2025/projeto/grupo1/privado.php">
            Voltar
          </a>
        </li>
      </ul>
    </nav>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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

          <label class="aluno-input-label" for="aluno-input">Aluno:

            <div class="datalist-input-container">
              <label class="input-label">
                <img class="aluno-input-search-icon" src="/2025/projeto/grupo2/public/imgs/search.svg" alt="search icon">
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

          <label for="modalidade-input">Modalidade:
            <div class="datalist-input-container">
              <label for="presencial-input">
                Presencial
              </label>
              <input id="presencial-input" type="radio" name="modalidade">
              <label for="remoto-input">
                Remoto
              </label>
              <input id="remoto-input" type="radio" name="modalidade">
              <label for="hibrido-input">
                Híbrido
              </label>
              <input id="hibrido-input" type="radio" name="modalidade">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["modalidade"] ?>
          </p>


          <label for="turno-input">Turno:
            <div class="datalist-input-container">
              <label for="manha-input">
                Manhã
              </label>
              <input id="manha-input" type="radio" name="turno">
              <label for="tarde-input">
                Tarde
              </label>
              <input id="tarde-input" type="radio" name="turno">
              <label for="noite-input">
                Noite
              </label>
              <input id="noite-input" type="radio" name="turno">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["turno"] ?>
          </p>




          <label for="carga-hora-input">Carga horária semanal:
            <div class="datalist-input-container">
              <input name="carga_horaria" id="carga-hora-input" type="text">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["carga_horaria"] ?>
          </p>









          <label for="data-inicio-input">Data de Início do Estágio:
            <div class="datalist-input-container">
              <input name="data_inicio" id="data-inicio-input" type="date">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["data_inicio"] ?>
          </p>



          <label for="data-fim-input">Data de Conclusão do Estágio:
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

          <label for="nome-empresa-input">Nome da Empresa:
            <div class="datalist-input-container">
              <input name="nome_empresa" id="nome-empresa-input" type="text">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["nome_empresa"] ?>
          </p>


          <label for="cpnj-input">CNPJ:
            <div class="datalist-input-container">
              <input name="cnpj_empresa" id="cpnj-input" type="text">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["cnpj_empresa"] ?>
          </p>




          <label for="area-input">Área:
            <div class="datalist-input-container">
              <input name="area_empresa" id="area-input" type="text">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["area_empresa"] ?>
          </p>



          <label for="telefone-input">Telefone:
            <div class="datalist-input-container">
              <input name="telefone_empresa" id="telefone-input" type="text" placeholder="Ex:(xx) xxxxx-xxxx">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["telefone_empresa"] ?>
          </p>


          <label for="email-input">E-mail:
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
          <label for="nome-representanteinput">Nome:
            <div class="datalist-input-container">
              <input name="nome_representante" id="nome-representante-input" type="text">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["nome_representante"] ?>
          </p>


          <label for="cargo-input">Cargo:
            <div class="datalist-input-container">
              <input name="cargo_representante" id="cargo-input" type="text">
              <div hidden class="datalist-input-data">
              </div>
            </div>
          </label>
          <p class="error-msg">
            <?= $validador->errors["cargo_representante"] ?>
          </p>



          <label for="cpf-input">CPF:
            <div class="datalist-input-container">
              <input name="cpf_representante" id="cpf-input" type="text">
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