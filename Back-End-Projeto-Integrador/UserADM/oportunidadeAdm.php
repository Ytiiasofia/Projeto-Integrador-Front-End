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
                <div class="search-card" data-aos="fade-up">
                    <h4 class="mb-4">Encontre oportunidades</h4>
                    <form id="search-form">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="tipo" class="form-label">Tipo de Oportunidade</label>
                                <select id="tipo" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="Estágio">Estágio</option>
                                    <option value="Iniciação Científica">Iniciação Científica</option>
                                    <option value="Concurso">Concurso</option>
                                    <option value="Emprego">Vaga de Emprego</option>
                                    <option value="Bootcamp">Bootcamp</option>
                                    <option value="Freelance">Freelance</option>
                                    <option value="Mentoria">Mentoria</option>
                                    <option value="Voluntariado">Voluntariado</option>
                                    <option value="Trainee">Trainee</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="modalidade" class="form-label">Modalidade</label>
                                <select id="modalidade" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="Online">Online</option>
                                    <option value="Presencial">Presencial</option>
                                    <option value="Híbrido">Híbrido</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="local" class="form-label">Local</label>
                                <select id="local" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="Acre">Acre</option>
                                    <option value="Alagoas">Alagoas</option>
                                    <option value="Amapá">Amapá</option>
                                    <option value="Amazonas">Amazonas</option>
                                    <option value="Bahia">Bahia</option>
                                    <option value="Ceará">Ceará</option>
                                    <option value="Distrito Federal">Distrito Federal</option>
                                    <option value="Espírito Santo">Espírito Santo</option>
                                    <option value="Goiás">Goiás</option>
                                    <option value="Maranhão">Maranhão</option>
                                    <option value="Mato Grosso">Mato Grosso</option>
                                    <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                                    <option value="Minas Gerais">Minas Gerais</option>
                                    <option value="Pará">Pará</option>
                                    <option value="Paraíba">Paraíba</option>
                                    <option value="Paraná">Paraná</option>
                                    <option value="Pernambuco">Pernambuco</option>
                                    <option value="Piauí">Piauí</option>
                                    <option value="Rio de Janeiro">Rio de Janeiro</option>
                                    <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                                    <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                                    <option value="Rondônia">Rondônia</option>
                                    <option value="Roraima">Roraima</option>
                                    <option value="Santa Catarina">Santa Catarina</option>
                                    <option value="São Paulo">São Paulo</option>
                                    <option value="Sergipe">Sergipe</option>
                                    <option value="Tocantins">Tocantins</option>
                                    <option value="Exterior">Exterior</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="area" class="form-label">Área de Interesse</label>
                                <select id="area" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="Desenvolvimento Full Stack">Desenvolvimento Full Stack</option>
                                    <option value="Desenvolvimento Front-End">Desenvolvimento Front-End</option>
                                    <option value="Desenvolvimento Back-End">Desenvolvimento Back-End</option>
                                    <option value="Desenvolvimento Mobile">Desenvolvimento Mobile</option>
                                    <option value="Desenvolvimento de Jogos">Desenvolvimento de Jogos</option>
                                    <option value="Sistemas Embarcados">Sistemas Embarcados</option>
                                    <option value="Inteligência Artificial">Inteligência Artificial</option>
                                    <option value="Desenvolvimento Web">Desenvolvimento Web</option>
                                    <option value="Segurança da Informação">Segurança da Informação</option>
                                    <option value="Aplicativos Desktop">Aplicativos Desktop</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edital" class="form-label">Status do Edital</label>
                                <select id="edital" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="Aberto">Aberto</option>
                                    <option value="Fechado">Fechado</option>
                                    <option value="Vigente">Vigente</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-search rounded-pill px-4 me-2">
                                <i class="bi bi-search me-1"></i> Buscar
                            </button>
                            <button type="reset" class="btn btn-outline-secondary rounded-pill px-4" id="limpar-busca">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Limpar
                            </button>
                        </div>
                    </form>
                </div>

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