<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inicializar a variável $posts como array vazio
$posts = [];

// Verificar qual filtro está ativo e se há busca
$filtro_atual = isset($_GET['filtro']) ? $_GET['filtro'] : 'recentes';
$termo_busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';

try {
    require_once __DIR__ . '/../controleForum/postsForum.php';
    $controller = new ForumController();
    
    // Carregar posts com filtro ou busca
    if (!empty($termo_busca)) {
        $posts = $controller->buscarPosts($termo_busca);
        $modo_busca = true;
    } else {
        $posts = $controller->listarPostsFiltrados($filtro_atual);
        $modo_busca = false;
    }
    
    // DEBUG
    error_log("Controller criado com sucesso - Modo Anônimo");
    error_log("Filtro atual: " . $filtro_atual);
    error_log("Termo busca: " . $termo_busca);
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

    <main class="main">
        <!-- Título da Página -->
        <div class="page-title dark-background" data-aos="fade" style="background-image: url(../assets/img/services-page-title-bg.jpg);">
            <div class="container">
                <h1>Fórum</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.php">Início</a></li>
                        <li class="current">Fórum</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Seção do Fórum -->
        <div class="forum-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        
                        <!-- Aviso para Usuário Anônimo -->
                        <div class="alert alert-warning mb-4" data-aos="fade-up" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-info-circle-fill me-3 fs-4"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">Acesso de Visualização</h6>
                                    <p class="mb-0">Você está visualizando o fórum como visitante. <a href="#" class="alert-link" data-bs-toggle="modal" data-bs-target="#loginModal">Faça login</a> para interagir com os posts e comentários.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Formulário para Novo Post (Desabilitado) -->
                        <div id="new-post-form" data-aos="fade-up" style=>
                            <h4 class="mb-4">Criar novo post</h4>
                            <form id="post-form">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="post-title" placeholder="Título do post" disabled>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" id="post-content" rows="3" placeholder="O que você gostaria de compartilhar?" disabled></textarea>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="post-tags" placeholder="Tags (separadas por vírgula)" disabled>
                                </div>
                                <div class="form-buttons">
                                    <button type="button" class="btn btn-primary rounded-pill shadow" data-bs-toggle="modal" data-bs-target="#loginModal">
                                        Publicar
                                    </button>
                                    <!--
                                    <button type="button" class="btn btn-primary saved-posts-btn rounded-pill shadow" data-bs-toggle="modal" data-bs-target="#loginModal">
                                        <i class="bi bi-bookmark-fill me-2"></i> Posts salvos
                                    </button>
                                    -->
                                </div>
                            </form>
                        </div>

                        <!-- Opções de Filtro -->
                        <div class="d-flex justify-content-between mb-4" data-aos="fade-up">
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php 
                                    switch($filtro_atual) {
                                        case 'recentes': echo 'Mais recentes'; break;
                                        case 'populares': echo 'Mais populares'; break;
                                        case 'sem_respostas': echo 'Sem respostas'; break;
                                        default: echo 'Filtrar por'; break;
                                    }
                                    ?>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                    <li><a class="dropdown-item <?php echo $filtro_atual == 'recentes' ? 'active' : ''; ?>" href="?filtro=recentes">Mais recentes</a></li>
                                    <li><a class="dropdown-item <?php echo $filtro_atual == 'populares' ? 'active' : ''; ?>" href="?filtro=populares">Mais populares</a></li>
                                    <li><a class="dropdown-item <?php echo $filtro_atual == 'sem_respostas' ? 'active' : ''; ?>" href="?filtro=sem_respostas">Sem respostas</a></li>
                                </ul>
                            </div>
                            <div>
                                <form method="GET" action="" class="d-flex">
                                    <input type="text" class="form-control" name="busca" placeholder="Buscar por título ou tags..." value="<?php echo htmlspecialchars($termo_busca); ?>">
                                    <?php if (!empty($termo_busca)): ?>
                                        <a href="?" class="btn btn-outline-secondary ms-2">Limpar</a>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>

                        <!-- Lista de Posts -->
                        <div id="posts-container">
                            <?php if (empty($posts)): ?>
                                <div class="text-center py-5" data-aos="fade-up">
                                    <h5>
                                        <?php if (!empty($termo_busca)): ?>
                                            Nenhum post encontrado para "<?php echo htmlspecialchars($termo_busca); ?>"
                                        <?php else: ?>
                                            Nenhum post encontrado
                                        <?php endif; ?>
                                    </h5>
                                    <p class="text-muted">
                                        <?php if (!empty($termo_busca)): ?>
                                            Tente buscar com outros termos ou <a href="?" class="text-primary">limpe a busca</a> para ver todos os posts.
                                        <?php else: ?>
                                            Não há posts no fórum no momento.
                                        <?php endif; ?>
                                    </p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($posts as $post): 
                                    $comentarios = $controller->listarComentariosPorPost($post['post_id']);
                                    $tags = $controller->getTagsDoPost($post['post_id']);
                                    $foto_perfil = $controller->getFotoPerfilUsuario($post['usuario_id']);
                                ?>
                                    <div class="forum-post" data-aos="fade-up" id="post-<?php echo $post['post_id']; ?>">
                                        <div class="d-flex mb-3">
                                            <img src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de <?php echo htmlspecialchars($post['nome_usuario']); ?>" class="user-avatar me-3">
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
                                            <div class="action-btn">
                                                <i class="bi bi-heart me-1"></i> <span><?php echo $post['curtidas']; ?></span>
                                            </div>
                                            <div class="action-btn">
                                                <i class="bi bi-chat-left-text me-1"></i> <span><?php echo $post['total_comentarios']; ?></span>
                                            </div>
                                            <div class="action-btn ms-auto">
                                                <small class="text-muted">
                                                    <i class="bi bi-eye me-1"></i> Modo Visualização
                                                </small>
                                            </div>
                                        </div>
                                        
                                        <!-- Seção de Comentários -->
                                        <div class="comments-section mt-4">
                                            <h6 class="mb-3">Comentários (<?php echo count($comentarios); ?>)</h6>
                                            
                                            <?php 
                                            // Organizar comentários por hierarquia
                                            $comentarios_principais = array_filter($comentarios, function($c) { return $c['comentario_pai_id'] === null; });
                                            ?>
                                            
                                            <?php foreach ($comentarios_principais as $comentario): 
                                                $foto_comentario = $controller->getFotoPerfilUsuario($comentario['usuario_id']);
                                                $total_curtidas_comentario = $controller->getTotalCurtidasComentario($comentario['comentario_id']);
                                            ?>
                                                <div class="comment mb-3">
                                                    <div class="d-flex">
                                                        <img src="<?php echo htmlspecialchars($foto_comentario); ?>" alt="Foto de <?php echo htmlspecialchars($comentario['nome_usuario']); ?>" class="user-avatar me-3">
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                                <strong><?php echo htmlspecialchars($comentario['nome_usuario']); ?></strong>
                                                                <small class="text-muted"><?php echo date('d/m/Y H:i', strtotime($comentario['data_criacao'])); ?></small>
                                                            </div>
                                                            <p class="mb-2"><?php echo htmlspecialchars($comentario['comentario']); ?></p>
                                                            <div class="comment-actions">
                                                                <span class="text-muted small me-3">
                                                                    <i class="bi bi-heart"></i> 
                                                                    <span><?php echo $total_curtidas_comentario; ?></span>
                                                                </span>
                                                            </div>
                                                            
                                                            <!-- Respostas -->
                                                            <?php 
                                                            $respostas = array_filter($comentarios, function($c) use ($comentario) { 
                                                                return $c['comentario_pai_id'] == $comentario['comentario_id']; 
                                                            });
                                                            ?>
                                                            
                                                            <?php foreach ($respostas as $resposta): 
                                                                $foto_resposta = $controller->getFotoPerfilUsuario($resposta['usuario_id']);
                                                                $total_curtidas_resposta = $controller->getTotalCurtidasComentario($resposta['comentario_id']);
                                                            ?>
                                                                <div class="comment-reply mt-3 ps-3 border-start">
                                                                    <div class="d-flex">
                                                                        <img src="<?php echo htmlspecialchars($foto_resposta); ?>" alt="Foto de <?php echo htmlspecialchars($resposta['nome_usuario']); ?>" class="user-avatar me-3">
                                                                        <div>
                                                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                                                <strong><?php echo htmlspecialchars($resposta['nome_usuario']); ?></strong>
                                                                                <small class="text-muted"><?php echo date('d/m/Y H:i', strtotime($resposta['data_criacao'])); ?></small>
                                                                            </div>
                                                                            <p class="mb-2"><?php echo htmlspecialchars($resposta['comentario']); ?></p>
                                                                            <div class="comment-actions">
                                                                                <span class="text-muted small me-3">
                                                                                    <i class="bi bi-heart"></i> 
                                                                                    <span><?php echo $total_curtidas_resposta; ?></span>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            
                                            <!-- Formulário de comentário (Desabilitado) -->
                                            <div class="add-comment mt-4">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Faça login para comentar..." disabled>
                                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Enviar</button>
                                                </div>
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
    </main>

    <!-- Rodapé -->
    <footer id="footer" class="footer light-background">
        <?php require("../Include/footer.php"); ?>
    </footer>

    <!-- Modal de Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login Necessário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="bi bi-person-check fs-1 text-primary"></i>
                    </div>
                    <p class="text-center">Para interagir com o fórum, você precisa estar logada em sua conta.</p>
                    <p class="text-center mb-0">Faça login para curtir, comentar e criar posts!</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continuar Visualizando</button>
                    <a href="../UserAnonimo/contact.php" class="btn btn-primary">Fazer Login</a>
                </div>
            </div>
        </div>
    </div>

    <?php require("../Include/preloaderAndScrollTop.php"); ?>
    <?php require("../includeJS/scriptScr.php"); ?>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Interceptar todas as interações que requerem login
        const elementsRequiringLogin = [
            '.like-btn',
            '.comment-btn',
            '.save-btn',
            '.reply-btn',
            '[data-bs-toggle="modal"]'
        ];

        elementsRequiringLogin.forEach(selector => {
            document.querySelectorAll(selector).forEach(element => {
                element.addEventListener('click', function(e) {
                    // Se não for um botão que já abre o modal diretamente
                    if (!this.hasAttribute('data-bs-toggle') || this.getAttribute('data-bs-target') !== '#loginModal') {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                        loginModal.show();
                    }
                });
            });
        });

        // Sistema de Filtros
        const filterLinks = document.querySelectorAll('.dropdown-item[href*="filtro"]');
        filterLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Mostrar loading
                const postsContainer = document.getElementById('posts-container');
                postsContainer.innerHTML = `
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Carregando...</span>
                        </div>
                        <p class="mt-2">Aplicando filtro...</p>
                    </div>
                `;
            });
        });

        // Sistema de Busca
        const searchForm = document.querySelector('form[name="busca"]');
        const searchInput = document.querySelector('input[name="busca"]');
        
        if (searchForm && searchInput) {
            let searchTimeout;
            
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    if (this.value.trim().length >= 2 || this.value.trim().length === 0) {
                        // Mostrar loading para buscas com 2+ caracteres ou quando limpar
                        const postsContainer = document.getElementById('posts-container');
                        postsContainer.innerHTML = `
                            <div class="text-center py-5">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Buscando...</span>
                                </div>
                                <p class="mt-2">Buscando posts...</p>
                            </div>
                        `;
                        searchForm.submit();
                    }
                }, 800);
            });

            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const postsContainer = document.getElementById('posts-container');
                    postsContainer.innerHTML = `
                        <div class="text-center py-5">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Buscando...</span>
                            </div>
                            <p class="mt-2">Buscando posts...</p>
                        </div>
                    `;
                    searchForm.submit();
                }
            });
        }
    });
    </script>
</body>
</html>