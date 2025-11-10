<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inicializar a variável $posts como array vazio
$posts = [];

try {
    require_once __DIR__ . '/../controleForum/postsForum.php';
    $controller = new ForumController();
    $posts = $controller->listarPosts();
    
    // DEBUG
    error_log("Controller criado com sucesso");
    error_log("Total de posts: " . count($posts));
    
} catch (Exception $e) {
    error_log("Erro ao carregar posts: " . $e->getMessage());
    $_SESSION['erro'] = "Erro ao carregar o fórum: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Fórum - She Innovates</title>
    <meta name="description" content="Fórum de discussão para mulheres na tecnologia">
    <meta name="keywords" content="fórum, mulheres, tecnologia, discussão">

    <?php require("../Include/hrefCssHead.php"); ?>
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
    <?php if (isset($_SESSION['sucesso'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['erro'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

        <!-- Seção do Fórum -->
        <div class="forum-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">

                        <!-- Formulário para Novo Post -->
                        <div id="new-post-form" data-aos="fade-up">
                            <h4 class="mb-4">Criar novo post</h4>
                            <form id="post-form" action="../controleForum/postsForum.php?action=criar_post" method="POST">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="post-title" name="titulo" placeholder="Título do post" required>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" id="post-content" name="conteudo" rows="3" placeholder="O que você gostaria de compartilhar?" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="post-tags" name="tags" placeholder="Tags (separadas por vírgula)">
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
    <?php if (empty($posts)): ?>
        <div class="text-center py-5" data-aos="fade-up">
            <h5>Nenhum post encontrado</h5>
            <p class="text-muted">Seja a primeira a criar um post no fórum!</p>
        </div>
    <?php else: ?>
        <?php foreach ($posts as $post): 
            $comentarios = $controller->listarComentariosPorPost($post['post_id']);
            $tags = $controller->getTagsDoPost($post['post_id']); // LINHA CORRIGIDA
        ?>
            <div class="forum-post" data-aos="fade-up" id="post-<?php echo $post['post_id']; ?>">
                <div class="d-flex mb-3">
                    <img src="https://randomuser.me/api/portraits/women/<?php echo rand(1, 90); ?>.jpg" alt="User" class="user-avatar me-3">
                    <div>
                        <h5 class="mb-1"><?php echo htmlspecialchars($post['titulo']); ?></h5>
                        <p class="text-muted small mb-0">
                            Postado por <strong><?php echo htmlspecialchars($post['nome_usuario']); ?></strong> 
                            em <?php echo date('d/m/Y H:i', strtotime($post['data_criacao'])); ?>
                        </p>
                    </div>
                </div>
                <p class="mb-3"><?php echo nl2br(htmlspecialchars($post['conteudo'])); ?></p>
                
                <?php if (!empty($tags)): ?>
                    <div class="mb-3">
                        <?php foreach ($tags as $tag): ?>
                            <span class="tag"><?php echo htmlspecialchars($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <div class="post-actions d-flex">
                    <div class="action-btn like-btn">
                        <i class="bi bi-heart me-1"></i> <span><?php echo $post['curtidas']; ?></span>
                    </div>
                    <div class="action-btn comment-btn">
                        <i class="bi bi-chat-left-text me-1"></i> <span><?php echo $post['total_comentarios']; ?></span>
                    </div>
                    <div class="action-btn save-btn ms-auto">
                        <i class="bi bi-bookmark me-1"></i> Salvar
                    </div>
                </div>
                
                <!-- Seção de Comentários -->
                <div class="comments-section mt-4">
                    <h6 class="mb-3">Comentários (<?php echo count($comentarios); ?>)</h6>
                    
                    <?php 
                    // Organizar comentários por hierarquia
                    $comentarios_principais = array_filter($comentarios, function($c) { return $c['comentario_pai_id'] === null; });
                    ?>
                    
                    <?php foreach ($comentarios_principais as $comentario): ?>
                        <div class="comment mb-3">
                            <div class="d-flex">
                                <img src="https://randomuser.me/api/portraits/women/<?php echo rand(1, 90); ?>.jpg" alt="User" class="user-avatar me-3">
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <strong><?php echo htmlspecialchars($comentario['nome_usuario']); ?></strong>
                                        <small class="text-muted"><?php echo date('d/m/Y H:i', strtotime($comentario['data_criacao'])); ?></small>
                                    </div>
                                    <p class="mb-2"><?php echo htmlspecialchars($comentario['comentario']); ?></p>
                                    <div class="comment-actions">
                                        <a href="#" class="text-muted small me-3"><i class="bi bi-heart"></i> Curtir</a>
                                        <a href="#" class="text-muted small reply-btn" data-comentario-id="<?php echo $comentario['comentario_id']; ?>">Responder</a>
                                    </div>
                                    
                                    <!-- Respostas -->
                                    <?php 
                                    $respostas = array_filter($comentarios, function($c) use ($comentario) { 
                                        return $c['comentario_pai_id'] == $comentario['comentario_id']; 
                                    });
                                    ?>
                                    
                                    <?php foreach ($respostas as $resposta): ?>
                                        <div class="comment-reply mt-3 ps-3 border-start">
                                            <div class="d-flex">
                                                <img src="https://randomuser.me/api/portraits/women/<?php echo rand(1, 90); ?>.jpg" alt="User" class="user-avatar me-3">
                                                <div>
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <strong><?php echo htmlspecialchars($resposta['nome_usuario']); ?></strong>
                                                        <small class="text-muted"><?php echo date('d/m/Y H:i', strtotime($resposta['data_criacao'])); ?></small>
                                                    </div>
                                                    <p class="mb-2"><?php echo htmlspecialchars($resposta['comentario']); ?></p>
                                                    <div class="comment-actions">
                                                        <a href="#" class="text-muted small me-3"><i class="bi bi-heart"></i> Curtir</a>
                                                        <a href="#" class="text-muted small reply-btn" data-comentario-id="<?php echo $comentario['comentario_id']; ?>">Responder</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <!-- Formulário de comentário -->
                    <div class="add-comment mt-4">
                        <form class="comment-form" action="../controleForum/postsForum.php?action=adicionar_comentario" method="POST">
                            <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                            <div class="input-group">
                                <input type="text" class="form-control" name="comentario" placeholder="Adicione um comentário..." required>
                                <button class="btn btn-primary" type="submit">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim da Seção do Fórum -->
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
    document.querySelectorAll('.save-btn').forEach(function(saveBtn) {
        saveBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Alternar ícone de salvamento
            const icon = this.querySelector('i');
            icon.classList.toggle('bi-bookmark');
            icon.classList.toggle('bi-bookmark-fill');
            
            // Adicionar/remover post da lista de salvos
            const postTitle = this.closest('.forum-post').querySelector('h5').textContent;
            const postId = this.closest('.forum-post').id;
            
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

    // Adicionar funcionalidade de resposta a comentários
    document.addEventListener('click', function(e) {
        if (e.target.closest('.reply-btn')) {
            e.preventDefault();
            const comentarioId = e.target.closest('.reply-btn').getAttribute('data-comentario-id');
            const commentForm = e.target.closest('.comments-section').querySelector('.comment-form');
            
            // Adicionar campo hidden para comentário pai
            let hiddenField = commentForm.querySelector('input[name="comentario_pai_id"]');
            if (!hiddenField) {
                hiddenField = document.createElement('input');
                hiddenField.type = 'hidden';
                hiddenField.name = 'comentario_pai_id';
                commentForm.appendChild(hiddenField);
            }
            hiddenField.value = comentarioId;
            
            // Focar no campo de comentário
            const commentInput = commentForm.querySelector('input[name="comentario"]');
            commentInput.focus();
            commentInput.placeholder = "Respondendo ao comentário...";
            
            alert('Agora você está respondendo a um comentário!');
        }
    });
}); 
</script>
</body>
</html>