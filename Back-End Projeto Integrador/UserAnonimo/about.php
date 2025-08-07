<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sobre - She Innovates</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <?php
  require("../Include/hrefCssHead.php");
  ?>

</head>

<body class="about-page">

  <!-- Cabeçalho -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <h1 class="sitename">She Innovates</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.html">Início</a></li>
          <li><a href="blog.html">Notícias</a></li>
          <li><a href="portfolio.html">Oportunidades</a></li>
          <li><a href="services.html">Fórum</a></li>
          <li><a href="contact.html">Login</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>
  <!-- Fim do Cabeçalho -->

  <main class="main">

    <!-- Título da Página -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(../../assets/img/about-page-title-bg.jpg);">
      <div class="container">
        <h1>Sobre</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Início</a></li>
            <li class="current">Sobre</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- Fim do Título da Página -->

    <!-- Seção Sobre -->
    <section id="about" class="about section">
      <div class="container">
        <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-5">
            <img src="../../assets/img/team-page-title-bg.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Por que Criamos o She Innovates?</h3>
              <p class="paragrafo-destaque">
                No Brasil e no mundo, a presença feminina na tecnologia ainda enfrenta barreiras históricas e desafios diários. Muitas mulheres desistem do setor por falta de referências, apoio e oportunidades que valorizem seu potencial. O She Innovates nasceu para mudar essa realidade. Nosso objetivo é criar um espaço seguro, inclusivo e inspirador, onde cada mulher possa encontrar informação de qualidade, compartilhar experiências, fortalecer sua rede de apoio e descobrir caminhos reais para crescer profissionalmente. Acreditamos que, juntas, podemos transformar o mercado de tecnologia em um ambiente mais justo, diverso e acessível para todas. Aqui, cada passo conta — e cada história importa.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Fim da Seção Sobre -->

    <!-- Seção de Chamada para Ação -->
    <section id="call-to-action" class="call-to-action section dark-background">

      <img src="../../assets/img/ImagemApp3.png" alt="">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>Agora é a sua vez de dar o próximo passo</h3>
              <p>Aqui, cada história tem valor. Ao compartilhar a sua, trocar experiências e explorar conteúdos, você se torna parte da mudança que constrói um futuro mais justo, diverso e inclusivo na tecnologia.</p>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- Fim da Seção de Chamada para Ação -->

  </main>

  <!-- Rodapé -->
<footer id="footer" class="footer light-background">
  <?php
    require("../Include/footerUserAnom.php");
  ?>
</footer>
  <!-- Fim do Rodapé -->

  <!-- Botão Voltar ao Topo -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Pré-carregamento -->
  <div id="preloader"></div>

  <?php
    require("../Include/scriptScr.php");
  ?>

</body>

</html>
