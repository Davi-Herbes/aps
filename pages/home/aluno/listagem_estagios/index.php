<?php
require_once __DIR__ . "/../../../../src/models/estagio/Estagio.php";

// pega o $user_role do arquivo que importou ele
global $user;
global $user_role;

$aluno;

if ($user_role instanceof Aluno) {
  $aluno = $user_role;
}

$flash_msg = null;

if (isset($_SESSION["flash-msg"])) {
  $flash_msg = $_SESSION["flash-msg"];
  unset($_SESSION["flash-msg"]);
}


$dados_estagios = Estagio::findByAluno($aluno->id);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estag.io - Alunos</title>
  <link rel="stylesheet" href="/2025/projeto/grupo2/pages/home/aluno/listagem_estagios/styles.css">
  <script defer src="/2025/projeto/grupo2/public/js/global.js"></script>
</head>

<body>
  <?php if ($flash_msg): ?>
    <div class="flash-msg <?= $flash_msg["type"] ?>">
      <?= $flash_msg["message"] ?>
    </div>
  <?php endif; ?>

  <header class="main-header">
    <a class="logo-estagirando" href="/2025/projeto/grupo1/privado.php">
      <img src="/2025/projeto/grupo2/public/imgs/arrow-left.svg" alt="">
      Estagirando
    </a>
    <a href="/2025/projeto/grupo2/" class="logo user-role-title">estag.io</a>
    <nav class="header-nav">
      <ul>
        <li>
          <a href="/2025/projeto/grupo1/pages/visualizar/visualizarAluno.php?id=<?= $aluno->id ?>">
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
          <li class="selected"><a href="/2025/projeto/grupo2/">
              <figure>
                <img src="/2025/projeto/grupo2/public/imgs/home.svg" alt="Imagem Listar">
                <figcaption>
                  Listar Estágios
                </figcaption>
              </figure>
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <section class="main-section">
      <!-- <div class="main-section-header">
        <h2>Estágios</h2>
  </div> -->
      <ul class="estagios">
        <?php foreach ($dados_estagios as $dados_estagio): ?>
          <?php

          /** @var Estagio $estagio */
          $estagio = $dados_estagio["estagio"];
          /** @var Aluno $aluno */
          $usuario = $dados_estagio["usuario"];
          /** @var Usuario $usuario */
          $aluno = $dados_estagio["aluno"];
          /** @var Curso $curso */
          $curso = $dados_estagio["curso"];


          $data_inicio = DateTime::createFromFormat("Y-m-d", $estagio->data_inicio);
          $data_atual = DateTime::createFromFormat("Y-m-d", date("Y-m-d"));
          $data_fim = DateTime::createFromFormat("Y-m-d", $estagio->data_fim);

          $data_atual->setTimezone(new DateTimeZone("America/Sao_Paulo"));
          $data_atual->modify("-3 hours");

          ?>
          <li class="estagio-card">
            <a href="/2025/projeto/grupo2/?e=<?= $estagio->id ?>">
              <div class="estagio-card-item main">
                <div class="user-img">
                  <img src="/2025/projeto/grupo2/public/imgs/clipboard.svg" alt="asdf">
                </div>
                <div class="user-description">
                  <h2 class="item-title">Empresa</h2>
                  <div class="item-description"><?= $estagio->nome_empresa ?? "-------" ?></div>
                </div>
              </div>
              <div class="estagio-card-item">
                <h3 class="item-title">
                  Atua em
                </h3>
                <div class="item-description">
                  <?= $estagio->area_empresa ?? "-------" ?>
                </div>
              </div>
              <!-- <div class="estagio-card-item">
                <h3 class="item-title">
                  Status
                </h3>
                <div class="item-description">

                </div>
              </div> -->
              <div class="estagio-card-item estagio-date-range">
                <h3 class="item-title">
                  <div>Início:</div>
                  <div class="item-date"><?= $data_inicio ? $data_inicio->format("d/m/Y") : "--/--/----" ?></div>
                </h3>
                <div class="item-description">
                  <div>Fim:</div>
                  <div class="item-date"><?= $data_fim ? $data_fim->format("d/m/Y")  : "--/--/----" ?></div>
                </div>
              </div>
              <div class="estagio-card-item estagio-card-item-grafico">
                <?php
                $pct = 0;

                if ($data_fim && $data_inicio) {
                  $x = $data_fim->getTimestamp() - $data_inicio->getTimestamp();
                  $y = $data_atual->getTimestamp() - $data_inicio->getTimestamp();

                  $pct = round(100 * ($y / $x));

                  if ($pct > 100) {
                    $pct = 100;
                  } else if ($pct < 0) {
                    $pct = 0;
                  }
                }

                ?>
                <h3 class="item-title"><?= $pct ?>%</h3>
                <div class="item-description">
                  <div class="graph">
                    <div class="graph-fill" style="width: <?= $pct ?>%;"></div>
                  </div>
                </div>
              </div>
            </a>
          </li>

        <?php endforeach; ?>
  </div>

  </section>
  </div>


</body>

</html>