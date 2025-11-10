<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Fórum - She Innovates</title>
    <meta name="description" content="Fórum de discussão para mulheres na tecnologia">
    <meta name="keywords" content="fórum, mulheres, tecnologia, discussão">

  <?php
  require("../Include/hrefCssHead.php");
  ?>
</head>

<body class="services-page">

<!-- Menu -->
<?php require_once __DIR__ . '/../Include/menuADM.php'; ?>
<!-- Fim do Menu -->

    <main class="main">
        <!-- Título -->
        <div class="page-title dark-background" data-aos="fade" style="background-image: url(../assets/img/services-page-title-bg.jpg);">
            <div class="container">
                <h1>Fórum</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="inicioUserCad.html">Início</a></li>
                        <li class="current">Fórum</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Fim do Título -->
         
        <!-- Seção do Fórum -->
        <div class="forum-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <!-- Formulário para Novo Post -->
                        <div id="new-post-form" data-aos="fade-up">
                            <h4 class="mb-4">Criar novo post</h4>
                            <form id="post-form">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="post-title" placeholder="Título do post" required>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" id="post-content" rows="3" placeholder="O que você gostaria de compartilhar?" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="post-tags" placeholder="Tags (separadas por vírgula)">
                                </div>
                                <div class="form-buttons">
                                    <button type="submit" class="btn btn-primary rounded-pill shadow">Publicar</button>
                                    <button type="button" class="btn btn-primary saved-posts-btn rounded-pill shadow" data-bs-toggle="modal" data-bs-target="#savedPostsModal">
                                        <i class="bi bi-bookmark-fill me-2"></i> Posts salvos
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Opções de Filtro -->
                        <div class="d-flex justify-content-between mb-4" data-aos="fade-up">
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Filtrar por
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                    <li><a class="dropdown-item" href="#">Mais recentes</a></li>
                                    <li><a class="dropdown-item" href="#">Mais populares</a></li>
                                    <li><a class="dropdown-item" href="#">Sem respostas</a></li>
                                </ul>
                            </div>
                            <div>
                                <input type="text" class="form-control" placeholder="Buscar no fórum...">
                            </div>
                        </div>

                        <!-- Lista de Posts -->
                        <div id="posts-container">
                            <!-- Exemplo de Post -->
                            <div class="forum-post" data-aos="fade-up">
                                <div class="d-flex mb-3">
                                    <img src="https://randomuser.me/api/portraits/women/88.jpg" alt="User" class="user-avatar me-3">
                                    <div>
                                        <h5 class="mb-1">Discussão sobre frameworks JavaScript modernos</h5>
                                        <p class="text-muted small mb-0">Postado por <strong>Camila Fernandes</strong> em 20/06/2023</p>
                                    </div>
                                </div>
                                <p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, nisl eget ultricies tincidunt, nisl nisl aliquam nisl, eget ultricies nisl nisl eget nisl. Nullam auctor, nisl eget ultricies tincidunt, nisl nisl aliquam nisl, eget ultricies nisl nisl eget nisl.</p>
                                
                                <div class="mb-3">
                                    <span class="tag">javascript</span>
                                    <span class="tag">frontend</span>
                                    <span class="tag">web-development</span>
                                </div>
                                
                                <div class="post-actions d-flex">
                                    <div class="action-btn like-btn">
                                        <i class="bi bi-heart me-1"></i> <span>18</span>
                                    </div>
                                    <div class="action-btn comment-btn">
                                        <i class="bi bi-chat-left-text me-1"></i> <span>6</span>
                                    </div>
                                    <div class="action-btn save-btn ms-auto">
                                        <i class="bi bi-bookmark me-1"></i> Salvar
                                    </div>
                                </div>
                                
                                <!-- Seção de Comentários Aprimorada -->
                                <div class="comments-section mt-4">
                                    <h6 class="mb-3">Comentários (3)</h6>
                                    
                                    <div class="comment mb-3">
                                        <div class="d-flex">
                                            <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="User" class="user-avatar me-3">
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <strong>Ana Paula</strong>
                                                    <small class="text-muted">21/06/2023</small>
                                                </div>
                                                <p class="mb-2">Concordo plenamente com seus pontos sobre React. A curva de aprendizado pode ser íngreme, mas vale a pena!</p>
                                                <div class="comment-actions">
                                                    <a href="#" class="text-muted small me-3"><i class="bi bi-heart"></i> Curtir</a>
                                                    <a href="#" class="text-muted small">Responder</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="comment mb-3">
                                        <div class="d-flex">
                                            <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="User" class="user-avatar me-3">
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <strong>Juliana Castro</strong>
                                                    <small class="text-muted">20/06/2023</small>
                                                </div>
                                                <p class="mb-2">Já experimentou Vue.js? Tenho achado mais intuitivo para projetos menores.</p>
                                                <div class="comment-actions">
                                                    <a href="#" class="text-muted small me-3"><i class="bi bi-heart"></i> Curtir</a>
                                                    <a href="#" class="text-muted small">Responder</a>
                                                </div>
                                                
                                                <!-- Resposta a comentário -->
                                                <div class="comment-reply mt-3 ps-3 border-start">
                                                    <div class="d-flex">
                                                        <img src="https://randomuser.me/api/portraits/women/88.jpg" alt="User" class="user-avatar me-3">
                                                        <div>
                                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                                <strong>Camila Fernandes</strong>
                                                                <small class="text-muted">20/06/2023</small>
                                                            </div>
                                                            <p class="mb-2">Sim! Vue é ótimo para prototipagem rápida. Usei em um projeto recente e foi bem tranquilo.</p>
                                                            <div class="comment-actions">
                                                                <a href="#" class="text-muted small me-3"><i class="bi bi-heart"></i> Curtir</a>
                                                                <a href="#" class="text-muted small">Responder</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="comment mb-3">
                                        <div class="d-flex">
                                            <img src="https://randomuser.me/api/portraits/women/67.jpg" alt="User" class="user-avatar me-3">
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <strong>Fernanda Lima</strong>
                                                    <small class="text-muted">20/06/2023</small>
                                                </div>
                                                <p class="mb-2">Ótima discussão! Estou começando com Svelte e estou adorando a simplicidade.</p>
                                                <div class="comment-actions">
                                                    <a href="#" class="text-muted small me-3"><i class="bi bi-heart"></i> Curtir</a>
                                                    <a href="#" class="text-muted small">Responder</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Formulário de comentário -->
                                    <div class="add-comment mt-4">
                                        <form class="comment-form">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Adicione um comentário..." required>
                                                <button class="btn btn-primary" type="submit">Enviar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
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
        </div>
    </main>

<!-- Modal de Posts Salvos -->
<div class="modal fade" id="savedPostsModal" tabindex="-1" aria-labelledby="savedPostsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="savedPostsModalLabel">Seus Posts Salvos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group saved-posts-list">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="post-title">Dicas para entrevistas técnicas</div>
                        <div class="post-actions">
                            <a href="#technical-interviews-post" class="btn btn-primary rounded-pill shadow"> Visualizar</a>
                            <button class="btn btn-sm btn-outline-danger remove-saved-post">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="post-title">Como negociar salário na área de TI</div>
                        <div class="post-actions">
                            <a href="#salary-negotiation-post" class="btn btn-primary rounded-pill shadow">Visualizar</a>
                            <button class="btn btn-sm btn-outline-danger remove-saved-post">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

    <!-- Rodapé -->
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
  
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simular salvamento de posts
    document.querySelector('.save-btn').addEventListener('click', function(e) {
        e.preventDefault();
        
        // Alternar ícone de salvamento
        const icon = this.querySelector('i');
        icon.classList.toggle('bi-bookmark');
        icon.classList.toggle('bi-bookmark-fill');
        
        // Adicionar/remover post da lista de salvos
        const postTitle = this.closest('.forum-post').querySelector('h5').textContent;
        const postId = 'post-' + Math.random().toString(36).substr(2, 9); // Gerar um ID único para o post
        this.closest('.forum-post').id = postId; // Atribuir o ID ao post
        
        const savedPostsList = document.querySelector('.saved-posts-list');
        const existingPost = Array.from(savedPostsList.children).find(li => 
            li.querySelector('.post-title').textContent.includes(postTitle));
        
        if (existingPost) {
            existingPost.remove();
            alert('Post removido dos salvos!');
        } else {
            const newItem = document.createElement('li');
            newItem.className = 'list-group-item d-flex justify-content-between align-items-center';
            newItem.innerHTML = `
                <div class="post-title">${postTitle}</div>
                <div class="post-actions">
                    <a href="#${postId}" class="btn btn-sm btn-outline-primary view-post-btn me-2">
                        <i class="bi bi-eye"></i> Visualizar
                    </a>
                    <button class="btn btn-sm btn-outline-danger remove-saved-post">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            `;
            savedPostsList.prepend(newItem);
            alert('Post salvo com sucesso!');
        }
    });
    
    // Delegar evento para botões de remoção (incluindo os dinâmicos)
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-saved-post')) {
            e.preventDefault();
            const listItem = e.target.closest('li');
            listItem.remove();
            alert('Post removido dos salvos!');
        }
    });

    // Fechar o modal quando um link de visualização for clicado
    document.addEventListener('click', function(e) {
        if (e.target.closest('.view-post-btn')) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('savedPostsModal'));
            modal.hide();
        }
    });
}); </script>
</body>
</html>