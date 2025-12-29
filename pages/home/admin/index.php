<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/2025/projeto/grupo2/public/css/global.css">
  <title>Modelo</title>
</head>

<body>
  <header class="main-header">
    <span class="logo">Estag.io</span>
    <span class="logo user-role-title">Admin</span>
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
          <a href="/2025/projeto/grupo1/">
            Voltar
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
          <li class="selected">
            <a href="#">
              <figure>
                <img src="/2025/projeto/grupo2/public/imgs/register.svg" alt="Imagem Registro" />
                <figcaption>Funcionalidade 1</figcaption>
              </figure>
            </a>
          </li>
          <li>
            <a href="#">
              <figure>
                <img src="/2025/projeto/grupo2/public/imgs/list.svg" alt="Imagem Listar" />
                <figcaption>Funcionalidade 2</figcaption>
              </figure>
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <section class="main-section">
      <h1>Aqui vai o conteúdo da página</h1>


  </div>
  </section>
  </div>

  <script src="/2025/projeto/grupo2/public/js/global.js"></script>

</body>

</html>