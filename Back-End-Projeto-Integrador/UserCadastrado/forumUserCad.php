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
    error_log("Controller criado com sucesso");
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
                                <!--
                                    <button type="button" class="btn btn-primary saved-posts-btn rounded-pill shadow" data-bs-toggle="modal" data-bs-target="#savedPostsModal">
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
                    Seja a primeira a criar um post no fórum!
                <?php endif; ?>
            </p>
        </div>
    <?php else: ?>
        <?php foreach ($posts as $post): 
            $comentarios = $controller->listarComentariosPorPost($post['post_id']);
            $tags = $controller->getTagsDoPost($post['post_id']);
            $foto_perfil = $controller->getFotoPerfilUsuario($post['usuario_id']);
            
            // Verificar se o usuário logado já curtiu este post
            $esta_curtido = isset($_SESSION['usuario_id']) ? $controller->verificarCurtidaPost($_SESSION['usuario_id'], $post['post_id']) : false;
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
                    <div class="action-btn like-btn" data-post-id="<?php echo $post['post_id']; ?>">
                        <i class="bi bi-heart<?php echo $esta_curtido ? '-fill text-danger' : ''; ?> me-1"></i> 
                        <span class="like-count"><?php echo $post['curtidas']; ?></span>
                    </div>
                    <div class="action-btn comment-btn">
                        <i class="bi bi-chat-left-text me-1"></i> <span><?php echo $post['total_comentarios']; ?></span>
                    </div>
                    <!--
                    <div class="action-btn save-btn ms-auto">
                        <i class="bi bi-bookmark me-1"></i> Salvar
                    </div>
                    -->
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
                        $esta_curtido_comentario = isset($_SESSION['usuario_id']) ? $controller->verificarCurtidaComentario($_SESSION['usuario_id'], $comentario['comentario_id']) : false;
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
                                        <a href="#" class="text-muted small me-3 like-comment-btn" data-comentario-id="<?php echo $comentario['comentario_id']; ?>">
                                            <i class="bi bi-heart<?php echo $esta_curtido_comentario ? '-fill text-danger' : ''; ?>"></i> 
                                            <span class="comment-like-count"><?php echo $total_curtidas_comentario; ?></span>
                                        </a>
                                        <a href="#" class="text-muted small reply-btn" data-comentario-id="<?php echo $comentario['comentario_id']; ?>">Responder</a>
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
                                        $esta_curtido_resposta = isset($_SESSION['usuario_id']) ? $controller->verificarCurtidaComentario($_SESSION['usuario_id'], $resposta['comentario_id']) : false;
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
                                                        <a href="#" class="text-muted small me-3 like-comment-btn" data-comentario-id="<?php echo $resposta['comentario_id']; ?>">
                                                            <i class="bi bi-heart<?php echo $esta_curtido_resposta ? '-fill text-danger' : ''; ?>"></i> 
                                                            <span class="comment-like-count"><?php echo $total_curtidas_resposta; ?></span>
                                                        </a>
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
<!-- Todas partes que envolvem posts salvos estão comentadas pois eu tive problemas no layout da página que não era funcional pra essa aplicação, mas mantive o css porque vai que algum dia alguém queira aplicar né -->
<!-- Modal de Posts Salvos 
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
-->
<!-- Rodapé -->
    <footer id="footer" class="footer light-background">
        <?php
            require("../Include/footer.php");
        ?>
    </footer>
<!-- Fim do Rodapé -->
  <?php
    require("../Include/preloaderAndScrollTop.php");
  ?>

  <?php
require("../includeJS/scriptScr.php");  ?>
  
<script src="../includeJsForum/principalForumCad.js"></script>
<script src="../includeJsForum/sistemaFiltros.js"></script>
<script src="../includeJsForum/sistemaBusca.js"></script>
<script src="../includeJsForum/sistemaCurtidas.js"></script>
<script src="../includeJsForum/sistemaRespostas.js"></script>

</body>
</html>