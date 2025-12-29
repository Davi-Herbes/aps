<?php
// pega o $user_role do arquivo que importou ele
global $user;
global $user_role;

/** @var Aluno $aluno */
$aluno;


if ($user_role instanceof Aluno) {
  $aluno = $user_role;
}

$flash_msg = null;

if (isset($_SESSION["flash-msg"])) {
  $flash_msg = $_SESSION["flash-msg"];
  unset($_SESSION["flash-msg"]);
}

$validador = null;

if (isset($_SESSION["validador"])) {
  $validador = $_SESSION["validador"];
  unset($_SESSION["validador"]);
}


$estagio_id = $_GET["e"];
$result = Estagio::findJoinProfessorUsuario($estagio_id);

/** @var Estagio $estagio */
$estagio = $result["estagio"];
/** @var Usuario $usuario */
$usuario = $result["usuario"];
/** @var Professor $professor */
$professor = $result["professor"];

$documentos = $result["documentos"];

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estag.io - Alunos</title>
  <link rel="stylesheet" href="/2025/projeto/grupo2/pages/home/aluno/estagio/styles.css">

  <script defer src="/2025/projeto/grupo2/public/js/global.js"></script>
  <script defer src="/2025/projeto/grupo2/pages/home/professor/estagio/js/main.js" type="module"></script>
  <script defer src="/2025/projeto/grupo2/pages/home/aluno/estagio/js/main.js" type="module"></script>
</head>

<body>
  <?php if ($flash_msg): ?>
    <div class="flash-msg flash-msg-<?= $flash_msg["type"] ?>">
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
      <?php

      $data_inicio = DateTime::createFromFormat("Y-m-d", $estagio->data_inicio);
      $data_atual = DateTime::createFromFormat("Y-m-d", date("Y-m-d"));
      $data_fim = DateTime::createFromFormat("Y-m-d", $estagio->data_fim);

      $data_atual->setTimezone(new DateTimeZone("America/Sao_Paulo"));
      $data_atual->modify("-3 hours");

      ?>
      <div class="main-section-content">
        <div class="estagio-container">
          <div class="title-container">
            <h2>Estágio</h2>
            <div class="title-btn-container"><button id="submit-estagio-btn" disabled class="update-btn" type="button">Enviar</button></div>
          </div>
          <form id="estagio-form" method="POST" action="/2025/projeto/grupo2/src/forms/atualizar_estagio.php?estagio_id=<?= $estagio_id ?>" class="estagio-data">
            <div class="estagio estagio-data-card">
              <h3 class="estagio-data-title">Geral</h3>
              <input type="hidden" name="estagio_id" value="<?= $estagio_id ?>">

              <div class="field">
                <label for="hora_semana" class="field-title">Carga horária: </label>
                <input id="hora_semana" name="hora_semana" type="number" class="field-value" value="<?= $estagio->hora_semana ?>" placeholder="20">
              </div>

              <div class="field turno">
                <label class="" for="turno-input">Turno:

                  <div class="datalist-input-container">
                    <label class="input-label">
                      <input class="input-label-input" autocomplete="off" id="turno-input" type="text">
                      <input value="<?= $estagio->turno ?>" class="input-label-input" id="turno-input-slot" name="turno" type="hidden">
                      <img src="/2025/projeto/grupo2/public/imgs/arrow-down.svg" alt="arrow down icon">
                    </label>

                    <div hidden class="datalist-input-data">
                      <ul>
                        <li value="manha">
                          <div>Manhã</div>
                        </li>
                        <li value="tarde">
                          <div>Tarde</div>
                        </li>
                        <li value="noite">
                          <div>Noite</div>
                        </li>
                        <li value="integral">
                          <div>Integral</div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </label>
              </div>
              <div class="field">
                <label for="orgao_expedidor" class="field-title">Órgão expedidor: </label>
                <input id="orgao_expedidor" type="text" name="orgao_expedidor" class="field-value" value="<?= $estagio->orgao_expedidor ?>" placeholder="SSP">
              </div>

              <div class="field modalidade">
                <label class="" for="modalidade-input">Modalidade:

                  <div class="datalist-input-container">
                    <label class="input-label">
                      <input class="input-label-input" autocomplete="off" id="modalidade-input" type="text" required>
                      <input value="<?= $estagio->modalidade ?>" class="input-label-input" name="modalidade" id="modalidade-input-slot" type="hidden">
                      <img src="/2025/projeto/grupo2/public/imgs/arrow-down.svg" alt="arrow down icon">
                    </label>

                    <div hidden class="datalist-input-data">
                      <ul>
                        <li value="presencial">
                          <div>Presencial</div>
                        </li>
                        <li value="remoto">
                          <div>Remoto</div>
                        </li>
                        <li value="hibrido">
                          <div>Híbrido</div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </label>
              </div>
            </div>

            <div class="empresa estagio-data-card">
              <h3 class="estagio-data-title">Empresa </h3>
              <div class="field">
                <label for="nome_empresa" class="field-title">Nome: </label>
                <input id="nome_empresa" type="text" name="nome_empresa" placeholder="Madesa" class="field-value" value="<?= $estagio->nome_empresa ?>">
              </div>

              <div class="field">
                <label for="cnpj_empresa" class="field-title">CPNJ: </label>
                <input id="cnpj_empresa" type="text" name="cnpj_empresa" class="field-value" value="<?= $estagio->cnpj_empresa ?>" placeholder="00.000.000/0000-00">
              </div>

              <div class="field">
                <label for="email_empresa" class="field-title">Email: </label>
                <input id="email_empresa" type="email" name="email_empresa" class="field-value" value="<?= $estagio->email_empresa ?>" placeholder="contato@empresa.com">
              </div>

              <div class="field">
                <label for="telefone_empresa" class="field-title">Telefone: </label>
                <input id="telefone_empresa" type="text" name="telefone_empresa" class="field-value" value="<?= $estagio->telefone_empresa ?>" placeholder="51987654321">
              </div>

              <div class="field">
                <label for="area_empresa" class=" field-title">Área de atuação: </label>
                <input id="area_empresa" type="text" name="area_empresa" class="field-value" value="<?= $estagio->area_empresa ?>" placeholder="Móveis">
              </div>
            </div>
            <div class="representante estagio-data-card">
              <h3 class="estagio-data-title">Representante </h3>
              <div class="field">
                <label for="cpf_representante" class="field-title">CPF: </label>
                <input id="cpf_representante" type="text" name="cpf_representante" class="field-value" value="<?= $estagio->cpf_representante ?>" placeholder="000.000.000-00">
              </div>
              <div class="field">
                <label for="nome_representante" class="field-title">Nome: </label>
                <input id="nome_representante" type="text" name="nome_representante" class="field-value" value="<?= $estagio->nome_representante ?>" placeholder="João da Silva">
              </div>
              <div class="field">
                <label for="cargo_representante" class="field-title">Cargo: </label>
                <input id="cargo_representante" type="text" name="cargo_representante" class="field-value" value="<?= $estagio->cargo_representante ?>" placeholder="Gerente da Auditoria">
              </div>
            </div>

            <div class="estagio-date estagio-data-card">
              <h3 class="estagio-data-title">Progresso </h3>
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

              <div class="process">
                <div class="process-number"><?= $pct ?>%</div>
                <div class="graph">
                  <div class="graph-fill" style="width: <?= $pct ?>%"></div>
                </div>
              </div>


              <div class="field">
                <label for="data_inicio" class="field-title">Data de início: </label>
                <input id="data_inicio" type="date" name="data_inicio" class="field-value" value="<?= $estagio->data_inicio ?>" placeholder="15/01/2026">
              </div>

              <div class="field">
                <label for="data_fim" class="field-title">Data de conclusão: </label>
                <input id="data_fim" type="date" name="data_fim" class="field-value" value="<?= $estagio->data_fim ?>" placeholder="15/05/2026">
              </div>
            </div>
          </form>
        </div>


        <div class="related-data">

          <div class="data-card">
            <h2>Aluno</h2>
            <div>
              <span class="field-name">
                Nome:
              </span>
              <?= $aluno->user->nome . " " . $aluno->user->sobrenome ?>
            </div>
            <div>
              <span class="field-name">
                Nascido em:
              </span>
              <?= DateTime::createFromFormat("Y-m-d", $aluno->user->data_nasc)->format("d/m/Y") ?>
            </div>
            <div>
              <span class="field-name">
                CPF:
              </span>
              <?= $aluno->user->cpf ?>
            </div>
            <div>
              <span class="field-name">
                Matrícula:
              </span>
              <?= $aluno->matricula ?>
            </div>
          </div>

          <div class="data-card">
            <h2>Professor</h2>
            <div>
              <span class="field-name">
                Nome:
              </span>
              <?= $usuario->nome . " " . $usuario->sobrenome ?>
            </div>
            <div>
              <span class="field-name">
                CPF:
              </span>
              <?= $usuario->cpf ?>
            </div>
          </div>

        </div>

        <div class="documentos">
          <div class="title-container">
            <h2>Documentos</h2>
            <div class="title-btn-container">

              <!-- <button id="submit-docs-btn" class="submit-documento update-btn">Enviar Alterações</button> -->
            </div>
          </div>

          <!-- <?php foreach ($documentos as $doc): ?>
            <li class="documento-item">
              <a class="documento-link" href="<?= $doc->path ?>" target="_blank">
                <?= $doc->nome_arquivo ?>
              </a>

              <form class="delete-form" method="post"
                action="/2025/projeto/grupo2/src/forms/deletar_documento.php">
                <input type="hidden" name="id" value="<?= $doc->id ?>">
                <input type="hidden" name="id_estagio" value="<?= $estagio->id ?>">
                <button type="submit" class="delete-btn">×</button>
              </form>

            </li>
          <?php endforeach; ?> -->
          <div class="documentos-container data-card">

            <div class="doc-title">
              <div class="upload-form">
                <div class="upload-form-item">Descrição</div>
                <div class="upload-form-item">Arquivo</div>
                <div class="upload-form-item">Data de Envio</div>
                <div class="upload-form-item">Data de Validade</div>
                <div class="upload-form-item">Opções</div>
              </div>
            </div>

            <div class="doc">

              <?php
              /** @var ?Documento $confirmacao */
              $confirmacao = null;
              if (isset($documentos["confirmacao"])) {
                $confirmacao = $documentos["confirmacao"];
              }
              ?>

              <form class="upload-form" action="/2025/projeto/grupo2/src/forms/enviar_documento.php" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?= $confirmacao->id ?? "" ?>" name="id">
                <input type="hidden" value="<?= $estagio->id ?>" name="id_estagio">
                <input type="hidden" value="confirmacao" name="tipo">
                <h4 class=" upload-form-item">
                  Confirmação de orientação
                </h4>
                <label class="upload-form-item upload-form-item-file">
                  <?php if ($confirmacao && $confirmacao->nome_arquivo): ?>
                    <a href="<?= $confirmacao->path ?>" class="file-upload-text" target="_blank"><?= $confirmacao->nome_arquivo ?></a>
                  <?php else: ?>
                    <span class="file-upload-text file-upload-text-empty">Vazio</span>
                  <?php endif; ?>
                  <label class="file-upload-label">
                    Alterar
                    <input type="file" id="arquivo" class="doc-input" name="arquivo" accept=".pdf">
                  </label>
                </label>
                <div class="upload-form-item">
                  <?php if (isset($documentos["confirmacao"]) && $confirmacao->updated_at): ?>
                    <?php
                    $format = "Y-m-d H:i:s";
                    $datetime_envio = DateTime::createFromFormat($format, $confirmacao->updated_at);
                    $datetime_envio->modify('-3 hours');

                    $data_envio = $datetime_envio->format("d/m/Y");
                    $hora = $datetime_envio->format("H:i");
                    ?>

                    <div class="display-data-envio">
                      <?= $data_envio ?>
                    </div>

                    <div class="display-hora-envio">
                      <?= $hora ?>
                    </div>
                  <?php else:  ?>
                    <div class="file-upload-text-empty">Sem envios</div>

                  <?php endif;  ?>

                </div>
                <label class="upload-form-item">
                  <?php if (isset($documentos["confirmacao"]) && $confirmacao->validade): ?>
                    <?php
                    $format = "Y-m-d";
                    $datetime_validade = DateTime::createFromFormat($format, $confirmacao->validade);
                    $datetime_validade->modify('-3 hours');

                    $data_validade = $datetime_validade->format("d/m/Y");
                    ?>

                    <div class="validade-display">
                      <?= $data_validade ?>
                    </div>

                    <input type="date" class="validade-input" value="<?= $datetime_validade->format($format) ?>" name="validade">

                  <?php else:  ?>
                    <div class="validade-display file-upload-text-empty">Vazio</div>
                    <input type="date" class="validade-input" name="validade">
                  <?php endif;  ?>
                </label>
                <div class="upload-form-item options-btn-container">

                  <button <?= $confirmacao ? "documento-id=\"{$confirmacao->id}\"" : 'disabled' ?> class="delete-doc-btn doc-option-btn" type="button">
                    Apagar
                  </button>
                  <button class="submit-doc-btn doc-option-btn" type="submit">Enviar</button>
                </div>
              </form>
              <form action="/2025/projeto/grupo2/src/forms/deletar_documento.php" hidden class="delete-doc-form" method="POST">
                <input type="hidden" name="id" value="<?= $confirmacao->id ?>">
              </form>
            </div>
            <div class="doc">

              <?php
              /** @var ?Documento $plano */
              $plano = null;
              if (isset($documentos["plano"])) {
                $plano = $documentos["plano"];
              }
              ?>

              <form id="docs-form" class="upload-form" action="/2025/projeto/grupo2/src/forms/enviar_documento.php" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?= $plano->id ?? "" ?>" name="id">
                <input type="hidden" value="<?= $estagio->id ?>" name="id_estagio">
                <input type="hidden" value="plano" name="tipo">
                <h4 class="upload-form-item">
                  Plano de atividades
                </h4>
                <label class="upload-form-item upload-form-item-file">
                  <?php if ($plano && $plano->nome_arquivo): ?>
                    <a href="<?= $plano->path ?>" class="file-upload-text" target="_blank"><?= $plano->nome_arquivo ?></a>
                  <?php else: ?>
                    <span class="file-upload-text file-upload-text-empty">Vazio</span>
                  <?php endif; ?>
                  <label class="file-upload-label">
                    Alterar
                    <input type="file" id="arquivo" class="doc-input" name="arquivo" accept=".pdf">
                  </label>
                </label>
                <div class="upload-form-item">
                  <?php if ($plano && $plano->updated_at): ?>
                    <?php
                    $format = "Y-m-d H:i:s";
                    $datetime_envio = DateTime::createFromFormat($format, $plano->updated_at);
                    $datetime_envio->modify('-3 hours');

                    $data_envio = $datetime_envio->format("d/m/Y");
                    $hora = $datetime_envio->format("H:i");
                    ?>

                    <div class="display-data-envio">
                      <?= $data_envio ?>
                    </div>

                    <div class="display-hora-envio">
                      <?= $hora ?>
                    </div>
                  <?php else:  ?>
                    <div class="file-upload-text-empty">Sem envios</div>

                  <?php endif;  ?>
                </div>
                <label class="upload-form-item">
                  <?php if (isset($documentos["plano"]) && $plano->validade): ?>
                    <?php
                    $format = "Y-m-d";
                    $datetime_validade = DateTime::createFromFormat($format, $plano->validade);
                    $datetime_validade->modify('-3 hours');

                    $data_validade = $datetime_validade->format("d/m/Y");
                    ?>

                    <div class="validade-display">
                      <?= $data_validade ?>
                    </div>
                    <input type="date" class="validade-input" value="<?= $datetime_validade->format($format) ?>" name="validade">


                  <?php else:  ?>
                    <div class="validade-display file-upload-text-empty">Vazio</div>
                    <input type="date" class="validade-input" name="validade">
                  <?php endif;  ?>
                </label>
                <div class="upload-form-item options-btn-container">

                  <button <?= $plano ? "documento-id=\"{$plano->id}\"" : 'disabled' ?> class="delete-doc-btn doc-option-btn" type="button">
                    Apagar
                  </button>
                  <button class="submit-doc-btn doc-option-btn" type="submit">Enviar</button>
                </div>

              </form>
              <form action="/2025/projeto/grupo2/src/forms/deletar_documento.php" hidden class="delete-doc-form" method="POST">
                <input type="hidden" name="id" value="<?= $plano->id ?>">
              </form>
            </div>
            <div class="doc">
              <?php
              /** @var ?Documento $autorizacao */
              $autorizacao = null;
              if (isset($documentos["autorizacao"])) {
                $autorizacao = $documentos["autorizacao"];
              }
              ?>
              <form class="upload-form" action="/2025/projeto/grupo2/src/forms/enviar_documento.php" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?= $autorizacao->id ?? "" ?>" name="id">
                <input type="hidden" value="<?= $estagio->id ?>" name="id_estagio">
                <input type="hidden" value="autorizacao" name="tipo">
                <h4 class="upload-form-item">
                  Autorização de uso de imagens
                </h4>
                <label class="upload-form-item">

                  <?php if ($autorizacao && $autorizacao->nome_arquivo): ?>
                    <a href="<?= $autorizacao->path ?>" class="file-upload-text" target="_blank"><?= $autorizacao->nome_arquivo ?></a>
                  <?php else: ?>
                    <span class="file-upload-text file-upload-text-empty">Vazio</span>
                  <?php endif; ?>
                  <label class="file-upload-label">
                    Alterar
                    <input type="file" id="arquivo" class="doc-input" name="arquivo" accept=".pdf">
                  </label>
                </label>
                <div class="upload-form-item">
                  <?php if ($autorizacao && $autorizacao->updated_at): ?>
                    <?php
                    $format = "Y-m-d H:i:s";
                    $datetime_envio = DateTime::createFromFormat($format, $autorizacao->updated_at);
                    $datetime_envio->modify('-3 hours');
                    $data_envio = $datetime_envio->format("d/m/Y");
                    $hora = $datetime_envio->format("H:i");
                    ?>

                    <div class="display-data-envio">
                      <?= $data_envio ?>
                    </div>

                    <div class="display-hora-envio">
                      <?= $hora ?>
                    </div>
                  <?php else:  ?>
                    <div class="file-upload-text-empty">Sem envios</div>
                  <?php endif;  ?>
                </div>
                <label class="upload-form-item">
                  <?php if (isset($documentos["autorizacao"]) && $autorizacao->validade): ?>
                    <?php
                    $format = "Y-m-d";
                    $datetime_validade = DateTime::createFromFormat($format, $autorizacao->validade);
                    $datetime_validade->modify('-3 hours');

                    $data_validade = $datetime_validade->format("d/m/Y");
                    ?>

                    <div class="validade-display">
                      <?= $data_validade ?>
                    </div>
                    <input type="date" class="validade-input" value="<?= $datetime_validade->format($format) ?>" name="validade">


                  <?php else:  ?>
                    <div class="validade-display file-upload-text-empty">Vazio</div>
                    <input type="date" class="validade-input" name="validade">
                  <?php endif;  ?>
                </label>
                <div class="upload-form-item options-btn-container">

                  <button <?= $autorizacao ? "documento-id=\"{$autorizacao->id}\"" : 'disabled' ?> class="delete-doc-btn doc-option-btn" type="button">
                    Apagar
                  </button>
                  <button class="submit-doc-btn doc-option-btn" type="submit">Enviar</button>
                </div>

              </form>
              <form action="/2025/projeto/grupo2/src/forms/deletar_documento.php" hidden class="delete-doc-form" method="POST">
                <input type="hidden" name="id" value="<?= $autorizacao->id ?>">
              </form>
            </div>
            <div class="doc">
              <?php
              /** @var ?Documento $avaliacao_concedente */
              $avaliacao_concedente = null;
              if (isset($documentos["avaliacao_concedente"])) {
                $avaliacao_concedente = $documentos["avaliacao_concedente"];
              }
              ?>
              <form class="upload-form" action="/2025/projeto/grupo2/src/forms/enviar_documento.php" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?= $avaliacao_concedente->id ?? "" ?>" name="id">
                <input type="hidden" value="<?= $estagio->id ?>" name="id_estagio">
                <input type="hidden" value="avaliacao_concedente" name="tipo">
                <h4 class="upload-form-item">
                  Avaliação do concedente
                </h4>
                <label class="upload-form-item">

                  <?php if ($avaliacao_concedente && $avaliacao_concedente->nome_arquivo): ?>
                    <a href="<?= $avaliacao_concedente->path ?>" class="file-upload-text" target="_blank"><?= $avaliacao_concedente->nome_arquivo ?></a>
                  <?php else: ?>
                    <span class="file-upload-text file-upload-text-empty">Vazio</span>
                  <?php endif; ?>
                  <label class="file-upload-label">
                    Alterar
                    <input type="file" id="arquivo" class="doc-input" name="arquivo" accept=".pdf">
                  </label>
                </label>
                <div class="upload-form-item">
                  <?php if ($avaliacao_concedente && $avaliacao_concedente->updated_at): ?>
                    <?php
                    $format = "Y-m-d H:i:s";
                    $datetime_envio = DateTime::createFromFormat($format, $avaliacao_concedente->updated_at);
                    $datetime_envio->modify('-3 hours');
                    $data_envio = $datetime_envio->format("d/m/Y");
                    $hora = $datetime_envio->format("H:i");
                    ?>

                    <div class="display-data-envio">
                      <?= $data_envio ?>
                    </div>

                    <div class="display-hora-envio">
                      <?= $hora ?>
                    </div>
                  <?php else:  ?>
                    <div class="file-upload-text-empty">Sem envios</div>
                  <?php endif;  ?>
                </div>
                <label class="upload-form-item">
                  <?php if (isset($documentos["avaliacao_concedente"]) && $avaliacao_concedente->validade): ?>
                    <?php
                    $format = "Y-m-d";
                    $datetime_validade = DateTime::createFromFormat($format, $avaliacao_concedente->validade);
                    $datetime_validade->modify('-3 hours');

                    $data_validade = $datetime_validade->format("d/m/Y");
                    ?>

                    <div class="validade-display">
                      <?= $data_validade ?>
                    </div>
                    <input type="date" class="validade-input" value="<?= $datetime_validade->format($format) ?>" name="validade">


                  <?php else:  ?>
                    <div class="validade-display file-upload-text-empty">Vazio</div>
                    <input type="date" class="validade-input" name="validade">
                  <?php endif;  ?>
                </label>
                <div class="upload-form-item options-btn-container">

                  <button <?= $avaliacao_concedente ? "documento-id=\"{$avaliacao_concedente->id}\"" : 'disabled' ?> class="delete-doc-btn doc-option-btn" type="button">
                    Apagar
                  </button>
                  <button class="submit-doc-btn doc-option-btn" type="submit">Enviar</button>
                </div>

              </form>
              <form action="/2025/projeto/grupo2/src/forms/deletar_documento.php" hidden class="delete-doc-form" method="POST">
                <input type="hidden" name="id" value="<?= $avaliacao_concedente->id ?>">
              </form>
            </div>
            <div class="doc">
              <?php
              /** @var ?Documento $avaliacao_orientador */
              $avaliacao_orientador = null;
              if (isset($documentos["avaliacao_orientador"])) {
                $avaliacao_orientador = $documentos["avaliacao_orientador"];
              }
              ?>
              <form class="upload-form" action="/2025/projeto/grupo2/src/forms/enviar_documento.php" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?= $avaliacao_orientador->id ?? "" ?>" name="id">
                <input type="hidden" value="<?= $estagio->id ?>" name="id_estagio">
                <input type="hidden" value="avaliacao_orientador" name="tipo">
                <h4 class="upload-form-item">
                  Avaliação do orientador
                </h4>
                <label class="upload-form-item">

                  <?php if ($avaliacao_orientador && $avaliacao_orientador->nome_arquivo): ?>
                    <a href="<?= $avaliacao_orientador->path ?>" class="file-upload-text" target="_blank"><?= $avaliacao_orientador->nome_arquivo ?></a>
                  <?php else: ?>
                    <span class="file-upload-text file-upload-text-empty">Vazio</span>
                  <?php endif; ?>
                  <label class="file-upload-label">
                    Alterar
                    <input type="file" id="arquivo" class="doc-input" name="arquivo" accept=".pdf">
                  </label>
                </label>
                <div class="upload-form-item">
                  <?php if ($avaliacao_orientador && $avaliacao_orientador->updated_at): ?>
                    <?php
                    $format = "Y-m-d H:i:s";
                    $datetime_envio = DateTime::createFromFormat($format, $avaliacao_orientador->updated_at);
                    $datetime_envio->modify('-3 hours');
                    $data_envio = $datetime_envio->format("d/m/Y");
                    $hora = $datetime_envio->format("H:i");
                    ?>

                    <div class="display-data-envio">
                      <?= $data_envio ?>
                    </div>

                    <div class="display-hora-envio">
                      <?= $hora ?>
                    </div>
                  <?php else:  ?>
                    <div class="file-upload-text-empty">Sem envios</div>
                  <?php endif;  ?>
                </div>
                <label class="upload-form-item">
                  <?php if (isset($documentos["avaliacao_orientador"]) && $avaliacao_orientador->validade): ?>
                    <?php
                    $format = "Y-m-d";
                    $datetime_validade = DateTime::createFromFormat($format, $avaliacao_orientador->validade);
                    $datetime_validade->modify('-3 hours');

                    $data_validade = $datetime_validade->format("d/m/Y");
                    ?>

                    <div class="validade-display">
                      <?= $data_validade ?>
                    </div>
                    <input type="date" class="validade-input" value="<?= $datetime_validade->format($format) ?>" name="validade">


                  <?php else:  ?>
                    <div class="validade-display file-upload-text-empty">Vazio</div>
                    <input type="date" class="validade-input" name="validade">
                  <?php endif;  ?>
                </label>
                <div class="upload-form-item options-btn-container">

                  <button <?= $avaliacao_orientador ? "documento-id=\"{$avaliacao_orientador->id}\"" : 'disabled' ?> class="delete-doc-btn doc-option-btn" type="button">
                    Apagar
                  </button>
                  <button class="submit-doc-btn doc-option-btn" type="submit">Enviar</button>
                </div>

              </form>
              <form action="/2025/projeto/grupo2/src/forms/deletar_documento.php" hidden class="delete-doc-form" method="POST">
                <input type="hidden" name="id" value="<?= $avaliacao_orientador->id ?>">
              </form>
            </div>

            <div class="doc">
              <?php
              /** @var ?Documento $relatorio */
              $relatorio = null;
              if (isset($documentos["relatorio"])) {
                $relatorio = $documentos["relatorio"];
              }
              ?>
              <form class="upload-form" action="/2025/projeto/grupo2/src/forms/enviar_documento.php" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?= $relatorio->id ?? "" ?>" name="id">
                <input type="hidden" value="<?= $estagio->id ?>" name="id_estagio">
                <input type="hidden" value="relatorio" name="tipo">
                <h4 class="upload-form-item">
                  Relatório final
                </h4>
                <label class="upload-form-item">

                  <?php if ($relatorio && $relatorio->nome_arquivo): ?>
                    <a href="<?= $relatorio->path ?>" class="file-upload-text" target="_blank"><?= $relatorio->nome_arquivo ?></a>
                  <?php else: ?>
                    <span class="file-upload-text file-upload-text-empty">Vazio</span>
                  <?php endif; ?>
                  <label class="file-upload-label">
                    Alterar
                    <input type="file" id="arquivo" class="doc-input" name="arquivo" accept=".pdf">
                  </label>
                </label>
                <div class="upload-form-item">
                  <?php if ($relatorio && $relatorio->updated_at): ?>
                    <?php
                    $format = "Y-m-d H:i:s";
                    $datetime_envio = DateTime::createFromFormat($format, $relatorio->updated_at);
                    $datetime_envio->modify('-3 hours');
                    $data_envio = $datetime_envio->format("d/m/Y");
                    $hora = $datetime_envio->format("H:i");
                    ?>

                    <div class="display-data-envio">
                      <?= $data_envio ?>
                    </div>

                    <div class="display-hora-envio">
                      <?= $hora ?>
                    </div>
                  <?php else:  ?>
                    <div class="file-upload-text-empty">Sem envios</div>
                  <?php endif;  ?>
                </div>
                <label class="upload-form-item">
                  <?php if (isset($documentos["relatorio"]) && $relatorio->validade): ?>
                    <?php
                    $format = "Y-m-d";
                    $datetime_validade = DateTime::createFromFormat($format, $relatorio->validade);
                    $datetime_validade->modify('-3 hours');

                    $data_validade = $datetime_validade->format("d/m/Y");
                    ?>

                    <div class="validade-display">
                      <?= $data_validade ?>
                    </div>
                    <input type="date" class="validade-input" value="<?= $datetime_validade->format($format) ?>" name="validade">


                  <?php else:  ?>
                    <div class="validade-display file-upload-text-empty">Vazio</div>
                    <input type="date" class="validade-input" name="validade">
                  <?php endif;  ?>
                </label>
                <div class="upload-form-item options-btn-container">

                  <button <?= $relatorio ? "documento-id=\"{$relatorio->id}\"" : 'disabled' ?> class="delete-doc-btn doc-option-btn" type="button">
                    Apagar
                  </button>
                  <button class="submit-doc-btn doc-option-btn" type="submit">Enviar</button>
                </div>

              </form>
              <form action="/2025/projeto/grupo2/src/forms/deletar_documento.php" hidden class="delete-doc-form" method="POST">
                <input type="hidden" name="id" value="<?= $relatorio->id ?>">
              </form>
            </div>

          </div>
        </div>


      </div>
    </section>
  </div>


</body>

</html>