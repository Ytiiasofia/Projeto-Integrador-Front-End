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

    
    <style>
        /* Estilos adicionais */
        .add-opportunity-section {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .btn-add {
            background-color: #6f42c1;
            color: white;
            border: none;
        }
        
        .btn-add:hover {
            background-color: #5a32a3;
            color: white;
        }
        
        .btn-trash {
            color: #dc3545;
            background: none;
            border: none;
        }
        
        .btn-trash:hover {
            color: #bb2d3b;
        }
        
        .modal-confirm-delete .modal-header {
            border-bottom: none;
        }
        
        .modal-confirm-delete .modal-footer {
            border-top: none;
        }
    </style>
</head>

<body class="portfolio-page">

<?php require_once __DIR__ . '/../Include/menuADM.php'; ?>


    <main class="main">
        <!-- Título da Página -->
        <div class="page-title dark-background" data-aos="fade" style="background-image: url(../assets/img/mulheres-na-tecnologia-2.png);">
            <div class="container">
                <h1>Oportunidades</h1>
            </div>
        </div><!-- Fim do Título da Página -->

        <!-- Seção de Oportunidades -->
        <div class="opportunities-container">
            <div class="container">

        <?php 
            // Seção para Adicionar Nova Oportunidade
            require("../controleTabela/cadastroOportunidades.php");
        ?>

            <!-- Formulário de Busca -->
        <?php 
            require("../controleTabela/buscaTabelaOportunidades.php");
        ?>

            <?php
                require("../controleTabela/tabelaOportunidadesAdm.php");
            ?>
                </div>
            </div>
        </div>
    </main>

</main>

<!-- Rodapé -->
<footer id="footer" class="footer light-background">
  <?php require("../Include/footer.php"); ?>
</footer>

<?php require("../Include/preloaderAndScrollTop.php"); ?>
<?php require("../includeJS/scriptScr.php"); ?>
<script src="../controleTabela/scriptBusca.js"></script>

</body>
</html>