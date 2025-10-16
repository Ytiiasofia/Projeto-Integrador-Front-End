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
            require("cadastroOportunidades.php");
        ?>

            <!-- Formulário de Busca -->
        <?php 
            require("buscaTabelaOportunidades.php");
        ?>

            <?php
                require("tabelaOportunidadesAdm.php");
            ?>

                    <!-- Paginação -->
                    <section id="blog-pagination" class="blog-pagination section">
                        <div class="container">
                            <div class="d-flex justify-content-center">
                                <ul>
                                    <li><a href="#"><i class="bi bi-chevron-left"></i></a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li>...</li>
                                    <li><a href="#">10</a></li>
                                    <li><a href="#"><i class="bi bi-chevron-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </section>
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
<?php require("../Include/scriptScr.php"); ?>

<script>
    // Função para filtrar a tabela
    document.getElementById('search-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Obter valores dos filtros
        const tipo = document.getElementById('tipo').value.toLowerCase();
        const modalidade = document.getElementById('modalidade').value.toLowerCase();
        const local = document.getElementById('local').value.toLowerCase();
        const area = document.getElementById('area').value.toLowerCase();
        const edital = document.getElementById('edital').value.toLowerCase();
        
        // Filtrar linhas da tabela
        const rows = document.querySelectorAll('#opportunities-table tbody tr');
        let resultadosEncontrados = 0;
        
        rows.forEach(row => {
            const rowTipo = row.cells[1].textContent.toLowerCase();
            const rowModalidade = row.cells[2].textContent.toLowerCase();
            const rowLocal = row.cells[3].textContent.toLowerCase();
            const rowArea = row.cells[4].textContent.toLowerCase();
            const rowEdital = row.cells[5].textContent.toLowerCase();
            
            const tipoMatch = !tipo || rowTipo.includes(tipo);
            const modalidadeMatch = !modalidade || rowModalidade.includes(modalidade);
            const localMatch = !local || rowLocal.includes(local);
            const areaMatch = !area || rowArea.includes(area);
            const editalMatch = !edital || rowEdital.includes(edital);
            
            if (tipoMatch && modalidadeMatch && localMatch && areaMatch && editalMatch) {
                row.style.display = '';
                resultadosEncontrados++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Mostrar mensagem se nenhum resultado for encontrado
        const mensagemVazio = document.getElementById('mensagem-vazia');
        if (resultadosEncontrados === 0) {
            if (!mensagemVazio) {
                const tr = document.createElement('tr');
                tr.id = 'mensagem-vazia';
                tr.innerHTML = '<td colspan="7" class="text-center">Nenhuma oportunidade encontrada com os filtros selecionados.</td>';
                document.querySelector('#opportunities-table tbody').appendChild(tr);
            }
        } else {
            if (mensagemVazio) {
                mensagemVazio.remove();
            }
        }
    });
    
    // Função para limpar a busca
    document.getElementById('limpar-busca').addEventListener('click', function() {
        // Resetar os selects
        document.getElementById('tipo').value = '';
        document.getElementById('modalidade').value = '';
        document.getElementById('local').value = '';
        document.getElementById('area').value = '';
        document.getElementById('edital').value = '';
        
        // Mostrar todas as linhas
        const rows = document.querySelectorAll('#opportunities-table tbody tr');
        rows.forEach(row => {
            if (row.id !== 'mensagem-vazia') {
                row.style.display = '';
            }
        });
        
        // Remover mensagem de vazio
        const mensagemVazio = document.getElementById('mensagem-vazia');
        if (mensagemVazio) {
            mensagemVazio.remove();
        }
    });
</script>

</body>
</html>