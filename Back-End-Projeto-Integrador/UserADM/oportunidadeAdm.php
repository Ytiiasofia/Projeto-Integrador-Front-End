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

<?php require_once __DIR__ . '/../include/menuADM.php'; ?>


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

                <!-- Tabela de Oportunidades -->
                <div class="table-responsive" data-aos="fade-up">
                    <table class="table table-hover align-middle" id="opportunities-table">
                        <thead>
                            <tr class="text-center">
                                <th style="border-top-left-radius: 10px;">Título</th>
                                <th>Tipo</th>
                                <th>Modalidade</th>
                                <th>Local</th>
                                <th>Área</th>
                                <th>Edital</th>
                                <th style="border-top-right-radius: 10px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-id="1">
                                <td>Estágio em Desenvolvimento Front-end</td>
                                <td class="text-center">Estágio</td>
                                <td class="text-center"><span class="badge badge-online rounded-pill">Online</span></td>
                                <td class="text-center">São Paulo</td>
                                <td class="text-center">Front-end</td>
                                <td class="text-center">
                                    <span class="badge badge-aberto rounded-pill">
                                        <i class="bi bi-check-circle me-1"></i> Aberto
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="https://exemplo.com/oportunidade/1" class="btn btn-sm btn-details rounded-pill px-3">Detalhes</a>
                                        <button class="btn btn-sm btn-trash delete-btn" data-id="1">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-id="2">
                                <td>Iniciação Científica em IA</td>
                                <td class="text-center">Iniciação Científica</td>
                                <td class="text-center"><span class="badge badge-presencial rounded-pill">Presencial</span></td>
                                <td class="text-center">Rio Grande do Sul</td>
                                <td class="text-center">Inteligência Artificial</td>
                                <td class="text-center">
                                    <span class="badge badge-vigente rounded-pill">
                                        <i class="bi bi-clock me-1"></i> Vigente
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="https://exemplo.com/oportunidade/2" class="btn btn-sm btn-details rounded-pill px-3">Detalhes</a>
                                        <button class="btn btn-sm btn-trash delete-btn" data-id="2">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-id="3">
                                <td>Concurso para Analista de Sistemas</td>
                                <td class="text-center">Concurso</td>
                                <td class="text-center"><span class="badge badge-hibrido rounded-pill">Híbrido</span></td>
                                <td class="text-center">Minas Gerais</td>
                                <td class="text-center">Back-end</td>
                                <td class="text-center">
                                    <span class="badge badge-aberto rounded-pill">
                                        <i class="bi bi-check-circle me-1"></i> Aberto
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="https://exemplo.com/oportunidade/3" class="btn btn-sm btn-details rounded-pill px-3">Detalhes</a>
                                        <button class="btn btn-sm btn-trash delete-btn" data-id="3">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-id="4">
                                <td>Estágio em Ciência de Dados</td>
                                <td class="text-center">Estágio</td>
                                <td class="text-center"><span class="badge badge-online rounded-pill">Online</span></td>
                                <td class="text-center">Exterior</td>
                                <td class="text-center">Ciência de Dados</td>
                                <td class="text-center">
                                    <span class="badge badge-fechado rounded-pill">
                                        <i class="bi bi-x-circle me-1"></i> Fechado
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" disabled>Detalhes</button>
                                        <button class="btn btn-sm btn-trash delete-btn" data-id="4">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-id="5">
                                <td>Bootcamp de Desenvolvimento Fullstack</td>
                                <td class="text-center">Bootcamp</td>
                                <td class="text-center"><span class="badge badge-online rounded-pill">Online</span></td>
                                <td class="text-center">Nacional</td>
                                <td class="text-center">Fullstack</td>
                                <td class="text-center">
                                    <span class="badge badge-aberto rounded-pill">
                                        <i class="bi bi-check-circle me-1"></i> Aberto
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="https://exemplo.com/oportunidade/5" class="btn btn-sm btn-details rounded-pill px-3">Detalhes</a>
                                        <button class="btn btn-sm btn-trash delete-btn" data-id="5">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-id="6">
                                <td>Vaga para Engenheira de DevOps</td>
                                <td class="text-center">Emprego</td>
                                <td class="text-center"><span class="badge badge-hibrido rounded-pill">Híbrido</span></td>
                                <td class="text-center">Rio de Janeiro</td>
                                <td class="text-center">DevOps</td>
                                <td class="text-center">
                                    <span class="badge badge-vigente rounded-pill">
                                        <i class="bi bi-clock me-1"></i> Vigente
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="https://exemplo.com/oportunidade/6" class="btn btn-sm btn-details rounded-pill px-3">Detalhes</a>
                                        <button class="btn btn-sm btn-trash delete-btn" data-id="6">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
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

<footer id="footer" class="footer light-background">
  <?php
    require("../Include/footer.php");
  ?>
</footer>

  <?php
    require("../Include/preloaderAndScrollTop.php");
  ?>

  <?php
    require("../Include/scriptScr.php");
  ?>

    <script>
        // Variável para armazenar o ID da linha a ser deletada
        let opportunityToDelete = null;
        
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
            const rows = document.querySelectorAll('tbody tr');
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
                } else {
                    row.style.display = 'none';
                }
            });
        });
        
        // Função para adicionar nova oportunidade
        document.getElementById('add-opportunity-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Obter valores do formulário
            const title = document.getElementById('new-title').value;
            const type = document.getElementById('new-type').value;
            const modality = document.getElementById('new-modality').value;
            const location = document.getElementById('new-location').value;
            const area = document.getElementById('new-area').value;
            const status = document.getElementById('new-status').value;
            const link = document.getElementById('new-link').value;
            
            // Criar novo ID (simplesmente incrementando o último ID)
            const table = document.getElementById('opportunities-table');
            const lastId = table.querySelector('tbody tr:last-child') ? 
                          parseInt(table.querySelector('tbody tr:last-child').getAttribute('data-id')) : 0;
            const newId = lastId + 1;
            
            // Determinar a classe do badge com base na modalidade
            let badgeClass = '';
            if (modality === 'Online') badgeClass = 'badge-online';
            else if (modality === 'Presencial') badgeClass = 'badge-presencial';
            else if (modality === 'Híbrido') badgeClass = 'badge-hibrido';
            
            // Determinar a classe do badge com base no status
            let statusClass = '';
            let statusIcon = '';
            if (status === 'Aberto') {
                statusClass = 'badge-aberto';
                statusIcon = 'bi-check-circle';
            } else if (status === 'Vigente') {
                statusClass = 'badge-vigente';
                statusIcon = 'bi-clock';
            } else if (status === 'Fechado') {
                statusClass = 'badge-fechado';
                statusIcon = 'bi-x-circle';
            }
            
            // Criar nova linha na tabela
            const newRow = document.createElement('tr');
            newRow.setAttribute('data-id', newId);
            newRow.innerHTML = `
                <td>${title}</td>
                <td class="text-center">${type}</td>
                <td class="text-center"><span class="badge ${badgeClass} rounded-pill">${modality}</span></td>
                <td class="text-center">${location}</td>
                <td class="text-center">${area}</td>
                <td class="text-center">
                    <span class="badge ${statusClass} rounded-pill">
                        <i class="bi ${statusIcon} me-1"></i> ${status}
                    </span>
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">
                        <a href="${link}" class="btn btn-sm btn-details rounded-pill px-3">Detalhes</a>
                        <button class="btn btn-sm btn-trash delete-btn" data-id="${newId}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </td>
            `;
            
            // Adicionar a nova linha à tabela
            table.querySelector('tbody').appendChild(newRow);
            
            // Adicionar evento de clique ao novo botão de deletar
            newRow.querySelector('.delete-btn').addEventListener('click', function() {
                opportunityToDelete = this.getAttribute('data-id');
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                deleteModal.show();
            });
            
            // Limpar o formulário
            this.reset();
            
            // Mostrar mensagem de sucesso (opcional)
            alert('Oportunidade adicionada com sucesso!');
        });
        
        // Configurar eventos de clique para os botões de deletar existentes
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                opportunityToDelete = this.getAttribute('data-id');
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                deleteModal.show();
            });
        });
        
        // Configurar evento de clique para o botão de confirmar exclusão
        document.getElementById('confirmDelete').addEventListener('click', function() {
            if (opportunityToDelete) {
                // Encontrar e remover a linha com o ID correspondente
                const rowToDelete = document.querySelector(`tr[data-id="${opportunityToDelete}"]`);
                if (rowToDelete) {
                    rowToDelete.remove();
                }
                
                // Fechar o modal
                const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                deleteModal.hide();
                
                // Mostrar mensagem de sucesso (opcional)
                alert('Oportunidade excluída com sucesso!');
            }
        });
    </script>

</body>
</html>