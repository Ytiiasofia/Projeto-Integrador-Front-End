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
                <!-- Seção para Adicionar Nova Oportunidade -->
                <div class="add-opportunity-section" data-aos="fade-up">
                    <h4 class="mb-4">Adicionar Nova Oportunidade</h4>
                    <form id="add-opportunity-form">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="new-title" class="form-label">Título</label>
                                <input type="text" class="form-control" id="new-title" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="new-type" class="form-label">Tipo</label>
                                <select class="form-select" id="new-type" required>
                                    <option value="">Selecione...</option>
                                    <option value="Estágio">Estágio</option>
                                    <option value="Iniciação Científica">Iniciação Científica</option>
                                    <option value="Concurso">Concurso</option>
                                    <option value="Emprego">Vaga de Emprego</option>
                                    <option value="Bootcamp">Bootcamp</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="new-modality" class="form-label">Modalidade</label>
                                <select class="form-select" id="new-modality" required>
                                    <option value="">Selecione...</option>
                                    <option value="Online">Online</option>
                                    <option value="Presencial">Presencial</option>
                                    <option value="Híbrido">Híbrido</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="local" class="form-label">Local</label>
                                <select id="local" class="form-select">
                                    <option value="">Selecione...</option>
                                    <option value="ac">Acre</option>
                                    <option value="al">Alagoas</option>
                                    <option value="ap">Amapá</option>
                                    <option value="am">Amazonas</option>
                                    <option value="ba">Bahia</option>
                                    <option value="ce">Ceará</option>
                                    <option value="df">Distrito Federal</option>
                                    <option value="es">Espírito Santo</option>
                                    <option value="go">Goiás</option>
                                    <option value="ma">Maranhão</option>
                                    <option value="mt">Mato Grosso</option>
                                    <option value="ms">Mato Grosso do Sul</option>
                                    <option value="mg">Minas Gerais</option>
                                    <option value="pa">Pará</option>
                                    <option value="pb">Paraíba</option>
                                    <option value="pr">Paraná</option>
                                    <option value="pe">Pernambuco</option>
                                    <option value="pi">Piauí</option>
                                    <option value="rj">Rio de Janeiro</option>
                                    <option value="rn">Rio Grande do Norte</option>
                                    <option value="rs">Rio Grande do Sul</option>
                                    <option value="ro">Rondônia</option>
                                    <option value="rr">Roraima</option>
                                    <option value="sc">Santa Catarina</option>
                                    <option value="sp">São Paulo</option>
                                    <option value="se">Sergipe</option>
                                    <option value="to">Tocantins</option>
                                    <option value="exterior">Exterior</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="new-area" class="form-label">Área</label>
                                <select id="area" class="form-select">
                                    <option value="">Selecione...</option>
                                    <option value="fullstack">Desenvolvimento Full Stack</option>
                                    <option value="frontend">Desenvolvimento Front-End</option>
                                    <option value="backend">Desenvolvimento Back-End</option>
                                    <option value="mobile">Desenvolvimento Mobile</option>
                                    <option value="games">Desenvolvimento de Jogos</option>
                                    <option value="embarcados">Sistemas Embarcados</option>
                                    <option value="ia">Inteligência Artificial</option>
                                    <option value="web">Desenvolvimento Web</option>
                                    <option value="seguranca">Segurança da Informação</option>
                                    <option value="desktop">Aplicativos Desktop</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="new-status" class="form-label">Status do Edital</label>
                                <select class="form-select" id="new-status" required>
                                    <option value="">Selecione...</option>
                                    <option value="Aberto">Aberto</option>
                                    <option value="Vigente">Vigente</option>
                                    <option value="Fechado">Fechado</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="new-link" class="form-label">Link para Detalhes</label>
                                <input type="url" class="form-control" id="new-link" required>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-search rounded-pill px-4 me-2">
                                <i class="bi bi-plus-circle me-1"></i> Adicionar Oportunidade
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Formulário de Busca -->
                <div class="search-card" data-aos="fade-up">
                    <h4 class="mb-4">Encontre oportunidades</h4>
                    <form id="search-form">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="tipo" class="form-label">Tipo de Oportunidade</label>
                                <select id="tipo" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="estagio">Estágio</option>
                                    <option value="ic">Iniciação Científica</option>
                                    <option value="concurso">Concurso</option>
                                    <option value="emprego">Vgas de Emprego</option>
                                    <option value="bootcamp">Bootcamp</option>
                                    <option value="freelance">Freelance</option>
                                    <option value="mentoria">Mentoria</option>
                                    <option value="voluntariado">Voluntariado</option>
                                    <option value="treinee">Trainee</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="modalidade" class="form-label">Modalidade</label>
                                <select id="modalidade" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="online">Online</option>
                                    <option value="presencial">Presencial</option>
                                    <option value="hibrido">Híbrido</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="local" class="form-label">Local</label>
                                <select id="local" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="ac">Acre</option>
                                    <option value="al">Alagoas</option>
                                    <option value="ap">Amapá</option>
                                    <option value="am">Amazonas</option>
                                    <option value="ba">Bahia</option>
                                    <option value="ce">Ceará</option>
                                    <option value="df">Distrito Federal</option>
                                    <option value="es">Espírito Santo</option>
                                    <option value="go">Goiás</option>
                                    <option value="ma">Maranhão</option>
                                    <option value="mt">Mato Grosso</option>
                                    <option value="ms">Mato Grosso do Sul</option>
                                    <option value="mg">Minas Gerais</option>
                                    <option value="pa">Pará</option>
                                    <option value="pb">Paraíba</option>
                                    <option value="pr">Paraná</option>
                                    <option value="pe">Pernambuco</option>
                                    <option value="pi">Piauí</option>
                                    <option value="rj">Rio de Janeiro</option>
                                    <option value="rn">Rio Grande do Norte</option>
                                    <option value="rs">Rio Grande do Sul</option>
                                    <option value="ro">Rondônia</option>
                                    <option value="rr">Roraima</option>
                                    <option value="sc">Santa Catarina</option>
                                    <option value="sp">São Paulo</option>
                                    <option value="se">Sergipe</option>
                                    <option value="to">Tocantins</option>
                                    <option value="exterior">Exterior</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="area" class="form-label">Área de Interesse</label>
                                <select id="area" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="fullstack">Desenvolvimento Full Stack</option>
                                    <option value="frontend">Desenvolvimento Front-End</option>
                                    <option value="backend">Desenvolvimento Back-End</option>
                                    <option value="mobile">Desenvolvimento Mobile</option>
                                    <option value="games">Desenvolvimento de Jogos</option>
                                    <option value="embarcados">Sistemas Embarcados</option>
                                    <option value="ia">Inteligência Artificial</option>
                                    <option value="web">Desenvolvimento Web</option>
                                    <option value="seguranca">Segurança da Informação</option>
                                    <option value="desktop">Aplicativos Desktop</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edital" class="form-label">Status do Edital</label>
                                <select id="edital" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="aberto">Aberto</option>
                                    <option value="fechado">Fechado</option>
                                    <option value="vigente">Vigente</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-search rounded-pill px-4 me-2">
                                <i class="bi bi-search me-1"></i> Buscar
                            </button>
                            <button type="reset" class="btn btn-outline-secondary rounded-pill px-4">
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

    <!-- Modal de Confirmação para Exclusão -->
    <div class="modal fade modal-confirm-delete" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Você tem certeza que deseja excluir esta oportunidade? Esta ação não pode ser desfeita.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill px-3" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger rounded-pill px-3" id="confirmDelete">Excluir</button>
                </div>
            </div>
        </div>
    </div>

</main>

<!-- Rodapé -->
<footer id="footer" class="footer light-background">
  <?php require("../Include/footer.php"); ?>
</footer>

<?php require("../Include/preloaderAndScrollTop.php"); ?>
<?php require("../Include/scriptScr.php"); ?>



</body>
</html>