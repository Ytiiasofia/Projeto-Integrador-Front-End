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
                                    <option value="emprego">Vagas de Emprego</option>
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
                    <table class="table table-hover align-middle">
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
                            <tr>
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
                                    <button class="btn btn-sm btn-details rounded-pill px-3">Detalhes</button>
                                </td>
                            </tr>
                            <tr>
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
                                    <button class="btn btn-sm btn-details rounded-pill px-3">Detalhes</button>
                                </td>
                            </tr>
                            <tr>
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
                                    <button class="btn btn-sm btn-details rounded-pill px-3">Detalhes</button>
                                </td>
                            </tr>
                            <tr>
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
                                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" disabled>Detalhes</button>
                                </td>
                            </tr>
                            <tr>
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
                                    <button class="btn btn-sm btn-details rounded-pill px-3">Detalhes</button>
                                </td>
                            </tr>
                            <tr>
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
                                    <button class="btn btn-sm btn-details rounded-pill px-3">Detalhes</button>
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
    </script>

</body>
</html>