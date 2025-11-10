<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Oportunidades - She Innovates</title>
    <meta name="description" content="Oportunidades para mulheres na tecnologia">
    <meta name="keywords" content="oportunidades, estágio, iniciação científica, concurso, tecnologia">

  <?php
  require("../Include/hrefCssHead.php");
  ?>
</head>

<body class="portfolio-page">

<?php require_once __DIR__ . '/../Include/menuADM.php'; ?>


    <main class="main">
        <!-- Título da Página -->
        <div class="page-title dark-background" data-aos="fade" style="background-image: url(../assets/img/mulheres-na-tecnologia-2.png);">
            <div class="container">
                <h1>Oportunidades</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="inicioUserCad.html">Início</a></li>
                        <li class="current">Oportunidades</li>
                    </ol>
                </nav>
            </div>
        </div><!-- Fim do Título da Página -->

        <!-- Seção de Oportunidades -->
        <div class="opportunities-container">
            <div class="container">
                <!-- Formulário de Busca -->
                <?php require("../UserADM/buscaTabelaOportunidades.php"); ?>
                <!-- Tabela de Oportunidades -->
                <?php require("tabelaoportunidadesUserCad.php"); ?>
            </div>
        </div>
    </main>

<footer id="footer" class="footer light-background">
  <?php
    require("../Include/footer.php");
  ?>
</footer>

  <?php
    require("../Include/preloaderAndScrollTop.php");
  ?>

  <?php
require("../includeJS/scriptScr.php");  ?>
<script src="../Include/scriptBusca.js"></script>

</body>
</html>