<?php
require_once '../Include/conexao.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: noticiaAdm.php');
    exit;
}

$noticia_id = mysqli_real_escape_string($con, $_GET['id']);

// Buscar a notícia
$query = "SELECT n.*, c.nome_categoria, u.nome_usuario 
          FROM noticias n 
          JOIN categorias c ON n.categoria_id = c.categoria_id 
          JOIN usuarios u ON n.autor_id = u.usuario_id 
          WHERE n.noticia_id = '$noticia_id' AND n.status = 'publicado'";

$result = mysqli_query($con, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    header('Location: noticiaAdm.php');
    exit;
}

$noticia = mysqli_fetch_assoc($result);

// Buscar tags da notícia
$tags_query = "SELECT t.nome_tag 
               FROM tags t 
               JOIN noticias_tags nt ON t.tag_id = nt.tag_id 
               WHERE nt.noticia_id = '$noticia_id'";
$tags_result = mysqli_query($con, $tags_query);
$tags = [];
if ($tags_result) {
    while ($tag = mysqli_fetch_assoc($tags_result)) {
        $tags[] = $tag['nome_tag'];
    }
}

// Converter nome da categoria para exibição
$categoria_display = [
    'inovacao' => 'Inovação e Tendências',
    'carreira' => 'Carreira e Oportunidades', 
    'educacao' => 'Educação e Capacitação',
    'startups' => 'Startups e Iniciativas Inovadoras',
    'eventos' => 'Eventos e Conexões',
    'tecnologia' => 'Tecnologia e Impacto Social'
];

$categoria_nome = $categoria_display[$noticia['nome_categoria']] ?? $noticia['nome_categoria'];

// Formatar data
$data_formatada = date('d/m/Y', strtotime($noticia['data_publicacao']));
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo htmlspecialchars($noticia['titulo']); ?> - She Innovates</title>
  <meta name="description" content="<?php echo substr(strip_tags($noticia['conteudo']), 0, 150); ?>...">
  <meta name="keywords" content="notícias, tecnologia, inovação">

  <?php
  require("../Include/hrefCssHead.php");
  ?>

  <style>
    .blog-details .post-img {
        width: 100%;
        height: 400px;
        border-radius: 8px;
    }
    
    .blog-details .post-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
    
    .blog-details .content {
        text-align: justify;
        line-height: 1.8;
    }
    
    .blog-details .content p {
        line-height: 1.8;
        margin-bottom: 1.5rem;
        text-align: justify;
        text-justify: inter-word;
    }
    
    .blog-details .content li {
        line-height: 1.8;
        margin-bottom: 0.5rem;
        text-align: justify;
    }
    
    .blog-details .content blockquote {
        border-left: 4px solid #6a62d4;
        padding-left: 1.5rem;
        margin: 2rem 0;
        font-style: italic;
        color: #555;
        text-align: justify;
    }
    
    .blog-details .content strong,
    .blog-details .content b {
        font-weight: 600;
    }
    
    .blog-details .content em,
    .blog-details .content i {
        font-style: italic;
    }
    
    .tags-badge {
        background-color: #6a62d4;
        color: white;
        margin-right: 5px;
        margin-bottom: 5px;
    }
    
    /* Responsividade para a imagem */
    @media (max-width: 768px) {
        .blog-details .post-img {
            height: 300px;
        }
        
        .blog-details .content {
            text-align: left;
        }
        
        .blog-details .content p {
            text-align: left;
        }
    }
    
    @media (max-width: 576px) {
        .blog-details .post-img {
            height: 250px;
        }
        
        .blog-details .content p {
            text-align: left;
        }
        
        .blog-details .content ul,
        .blog-details .content ol {
            padding-left: 1.5rem;
        }
    }
  </style>
</head>

<body class="blog-details-page">

  <?php require_once __DIR__ . '/../Include/menuADM.php'; ?>

  <main class="main">

    <!-- Título -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(../assets/img/blog-page-title-bg.jpg);">
      <div class="container">
        <h1>Notícias</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="noticiaAdm.php">Notícias</a></li>
            <li> Detalhes</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- Fim do Título -->

    <div class="container">
      <div class="row">

        <div class="col-lg-8">

          <!-- Seção de Detalhes do Blog -->
          <section id="blog-details" class="blog-details section">
            <div class="container">

              <article class="article">

                <div class="post-img">
                  <?php if ($noticia['imagem_capa']): ?>
                    <img src="../<?php echo $noticia['imagem_capa']; ?>" alt="<?php echo htmlspecialchars($noticia['titulo']); ?>" class="img-fluid">
                  <?php else: ?>
                    <img src="../assets/img/blog/blog-1.jpg" alt="Imagem padrão" class="img-fluid">
                  <?php endif; ?>
                </div>

                <h2 class="title"><?php echo htmlspecialchars($noticia['titulo']); ?></h2>

                <div class="meta-top">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> 
                      <a href="#"><?php echo htmlspecialchars($noticia['nome_usuario']); ?></a>
                    </li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> 
                      <a href="#"><time datetime="<?php echo $noticia['data_publicacao']; ?>">
                        <?php echo $data_formatada; ?>
                      </time></a>
                    </li>
                    <li class="d-flex align-items-center"><i class="bi bi-folder"></i> 
                      <a href="#"><?php echo $categoria_nome; ?></a>
                    </li>
                  </ul>
                </div><!-- Fim do meta top -->

                <div class="content">
                  <?php 
                  // Exibir o conteúdo formatado mantendo quebras de linha, tava me agoniando ver tudo junto e desparelho
                  $conteudo_formatado = nl2br(htmlspecialchars($noticia['conteudo']));
                  echo '<div class="text-justified">' . $conteudo_formatado . '</div>';
                  ?>
                </div>
                <!-- Fim do conteúdo da postagem -->

                <div class="meta-bottom">
                  <i class="bi bi-tags"></i>
                  <ul class="tags">
                    <?php foreach ($tags as $tag): ?>
                      <li><a href="#"><?php echo $tag; ?></a></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
                <!-- Fim do meta bottom -->

              </article>

            </div>
          </section>
          <!-- Fim da Seção de Detalhes do Blog -->
        </div>

        <div class="col-lg-4 sidebar">

          <div class="widgets-container">

            <!-- Widget de Posts Recentes -->
            <div class="recent-posts-widget widget-item">
              <h3 class="widget-title">Posts Recentes</h3>
              <?php
              // Buscar posts recentes (excluindo a notícia atual em que o usuário está)
              $recent_query = "SELECT n.noticia_id, n.titulo, n.imagem_capa, n.data_publicacao 
                              FROM noticias n 
                              WHERE n.status = 'publicado' 
                              AND n.noticia_id != '$noticia_id'
                              ORDER BY n.data_publicacao DESC 
                              LIMIT 5";
              $recent_result = mysqli_query($con, $recent_query);
              
              if ($recent_result && mysqli_num_rows($recent_result) > 0) {
                  while ($recent = mysqli_fetch_assoc($recent_result)) {
                      $recent_data = date('d/m/Y', strtotime($recent['data_publicacao']));
                      ?>
                      <div class="post-item">
                          <?php if ($recent['imagem_capa']): ?>
                              <img src="../<?php echo $recent['imagem_capa']; ?>" alt="<?php echo htmlspecialchars($recent['titulo']); ?>" class="flex-shrink-0">
                          <?php else: ?>
                              <img src="../assets/img/blog/blog-recent-1.jpg" alt="Imagem padrão" class="flex-shrink-0">
                          <?php endif; ?>
                          <div>
                              <h4><a href="noticiaDetalhesAdm.php?id=<?php echo $recent['noticia_id']; ?>">
                                  <?php echo htmlspecialchars($recent['titulo']); ?>
                              </a></h4>
                              <time datetime="<?php echo $recent['data_publicacao']; ?>"><?php echo $recent_data; ?></time>
                          </div>
                      </div>
                      <!-- Fim do item de post recente -->
                      <?php
                  }
              } else {
                  echo '<p>Nenhum post recente encontrado.</p>';
              }
              
              mysqli_close($con);
              ?>
            </div>
            <!--Fim do Widget de Posts Recentes -->
          </div>

        </div>

      </div>
    </div>

  </main>
  <!-- Rodapé -->
  <footer id="footer" class="footer light-background">
    <?php require("../Include/footer.php"); ?>
  </footer>
  <!-- Fim do Rodapé -->           
  <?php require("../Include/preloaderAndScrollTop.php"); ?>
  <?php require("../includeJS/scriptScr.php"); ?>

</body>
</html>