<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Notícias - She Innovates</title>
  <meta name="description" content="Página de notícias para usuários cadastrados">
  <meta name="keywords" content="notícias, tecnologia, inovação">

  <?php
  require("../Include/hrefCssHead.php");
  ?>

  <style>
    /* Estilo para resultados de busca */
    .search-results-info {
      background-color: #f8f9fa;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
      border-left: 4px solid #6a62d4;
    }

    .no-results {
      text-align: center;
      padding: 40px;
      color: #6c757d;
    }

    .clear-search {
      margin-left: 10px;
    }
    
    .article {
      position: relative;
    }
    
    .article:hover {
      transform: translateY(-2px);
      transition: transform 0.2s ease;
    }
  </style>
</head>

<body class="blog-page">

  <!-- Cabeçalho -->
  <?php require_once __DIR__ . '/../Include/menuADM.php'; ?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(../assets/img/blog-page-title-bg.jpg);">
      <div class="container">
        <h1>Notícias</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="inicioUserCad.html">Início</a></li>
            <li class="current">Notícias</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <!-- Blog Posts Section -->
          <section id="blog-posts" class="blog-posts section">
            <div class="container">

              <div class="row gy-4" id="news-container">
                <?php
                // Conexão e consulta para as notícias principais
                require_once '../Include/conexao.php';
                
                // Verificar se há busca
                $search_term = isset($_GET['search']) ? trim($_GET['search']) : '';
                $has_search = !empty($search_term);
                
                // Verificar se há filtro por categoria
                $categoria_filter = isset($_GET['categoria']) ? trim($_GET['categoria']) : '';
                $has_categoria = !empty($categoria_filter);
                
                if ($has_search) {
                  // Consulta de busca
                  $search_term_clean = mysqli_real_escape_string($con, $search_term);
                  $query = "SELECT DISTINCT n.*, c.nome_categoria, u.nome_usuario 
                            FROM noticias n 
                            JOIN categorias c ON n.categoria_id = c.categoria_id 
                            JOIN usuarios u ON n.autor_id = u.usuario_id 
                            LEFT JOIN noticias_tags nt ON n.noticia_id = nt.noticia_id 
                            LEFT JOIN tags t ON nt.tag_id = t.tag_id 
                            WHERE n.status = 'publicado' 
                            AND (n.titulo LIKE '%$search_term_clean%' 
                                 OR n.conteudo LIKE '%$search_term_clean%'
                                 OR t.nome_tag LIKE '%$search_term_clean%'
                                 OR c.nome_categoria LIKE '%$search_term_clean%')
                            ORDER BY n.data_publicacao DESC 
                            LIMIT 12";
                } else if ($has_categoria) {
                  // Consulta por categoria
                  $categoria_clean = mysqli_real_escape_string($con, $categoria_filter);
                  $query = "SELECT n.*, c.nome_categoria, u.nome_usuario 
                            FROM noticias n 
                            JOIN categorias c ON n.categoria_id = c.categoria_id 
                            JOIN usuarios u ON n.autor_id = u.usuario_id 
                            WHERE n.status = 'publicado' 
                            AND c.nome_categoria = '$categoria_clean'
                            ORDER BY n.data_publicacao DESC 
                            LIMIT 12";
                } else {
                  // Consulta normal para buscar notícias
                  $query = "SELECT n.*, c.nome_categoria, u.nome_usuario 
                            FROM noticias n 
                            JOIN categorias c ON n.categoria_id = c.categoria_id 
                            JOIN usuarios u ON n.autor_id = u.usuario_id 
                            WHERE n.status = 'publicado' 
                            ORDER BY n.data_publicacao DESC 
                            LIMIT 6";
                }
                
                $result = mysqli_query($con, $query);
                
                if ($result && mysqli_num_rows($result) > 0) {
                  // Mostrar info da busca se houver
                  if ($has_search) {
                    $total_results = mysqli_num_rows($result);
                    echo '<div class="search-results-info mb-4">';
                    echo '<h5>Resultados da busca para: "' . htmlspecialchars($search_term) . '"</h5>';
                    echo '<p class="mb-0">Encontrados ' . $total_results . ' resultado(s)';
                    echo '<a href="?" class="btn btn-outline-secondary btn-sm clear-search">Limpar busca</a>';
                    echo '</p>';
                    echo '</div>';
                  } else if ($has_categoria) {
                    $total_results = mysqli_num_rows($result);
                    $categoria_display = [
                      'inovacao' => 'Inovação e Tendências',
                      'carreira' => 'Carreira e Oportunidades', 
                      'educacao' => 'Educação e Capacitação',
                      'startups' => 'Startups e Iniciativas Inovadoras',
                      'eventos' => 'Eventos e Conexões',
                      'tecnologia' => 'Tecnologia e Impacto Social'
                    ];
                    $categoria_nome = $categoria_display[$categoria_filter] ?? $categoria_filter;
                    echo '<div class="search-results-info mb-4">';
                    echo '<h5>Categoria: ' . $categoria_nome . '</h5>';
                    echo '<p class="mb-0">Encontrados ' . $total_results . ' notícia(s)';
                    echo '<a href="?" class="btn btn-outline-secondary btn-sm clear-search">Mostrar todas</a>';
                    echo '</p>';
                    echo '</div>';
                  }
                  
                  while ($noticia = mysqli_fetch_assoc($result)) {
                    // Buscar tags da notícia
                    $tags_query = "SELECT t.nome_tag 
                                   FROM tags t 
                                   JOIN noticias_tags nt ON t.tag_id = nt.tag_id 
                                   WHERE nt.noticia_id = {$noticia['noticia_id']} 
                                   LIMIT 3";
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
                    <div class="col-lg-6">
                      <article class="article">
                        <div class="post-img">
                          <?php if ($noticia['imagem_capa']): ?>
                            <img src="../<?php echo $noticia['imagem_capa']; ?>" alt="<?php echo $noticia['titulo']; ?>" class="img-fluid">
                          <?php else: ?>
                            <img src="../assets/img/blog/blog-1.jpg" alt="Imagem padrão" class="img-fluid">
                          <?php endif; ?>
                        </div>
                        <p class="post-category"><?php echo $categoria_nome; ?></p>
                        <h2 class="title">
                          <a href="blog-details.php?id=<?php echo $noticia['noticia_id']; ?>">
                            <?php echo htmlspecialchars($noticia['titulo']); ?>
                          </a>
                        </h2>
                        <div class="d-flex align-items-center">
                          <div class="post-meta">
                            <p class="post-author"><?php echo htmlspecialchars($noticia['nome_usuario']); ?></p>
                            <p class="post-date">
                              <time datetime="<?php echo $noticia['data_publicacao']; ?>">
                                <?php echo $data_formatada; ?>
                              </time>
                            </p>
                          </div>
                        </div>
                        <?php if (!empty($tags)): ?>
                          <div class="tags mt-2">
                            <?php foreach ($tags as $tag): ?>
                              <span class="badge bg-secondary me-1"><?php echo $tag; ?></span>
                            <?php endforeach; ?>
                          </div>
                        <?php endif; ?>
                      </article>
                    </div><!-- End post list item -->
                    <?php
                  }
                } else {
                  if ($has_search) {
                    echo '<div class="col-12 no-results">';
                    echo '<h4>Nenhum resultado encontrado</h4>';
                    echo '<p>Não encontramos nenhuma notícia para: "' . htmlspecialchars($search_term) . '"</p>';
                    echo '</div>';
                  } else if ($has_categoria) {
                    $categoria_display = [
                      'inovacao' => 'Inovação e Tendências',
                      'carreira' => 'Carreira e Oportunidades', 
                      'educacao' => 'Educação e Capacitação',
                      'startups' => 'Startups e Iniciativas Inovadoras',
                      'eventos' => 'Eventos e Conexões',
                      'tecnologia' => 'Tecnologia e Impacto Social'
                    ];
                    $categoria_nome = $categoria_display[$categoria_filter] ?? $categoria_filter;
                    echo '<div class="col-12 no-results">';
                    echo '<h4>Nenhuma notícia encontrada</h4>';
                    echo '<p>Não encontramos nenhuma notícia na categoria: "' . $categoria_nome . '"</p>';
                    echo '</div>';
                  } else {
                    echo '<div class="col-12 no-results">';
                    echo '<h4>Nenhuma notícia publicada</h4>';
                    echo '<p>Aguarde novas publicações em breve!</p>';
                    echo '</div>';
                  }
                }
                ?>
              </div>
            </div>
          </section><!-- /Blog Posts Section -->
        </div>

        <div class="col-lg-4 sidebar">
          <div class="widgets-container">
            <!-- Search Widget -->
            <div class="search-widget widget-item">
              <h3 class="widget-title">Pesquisa</h3>
              <form id="search-form" method="GET" action="">
                <input type="text" name="search" id="search-input" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" placeholder="Buscar notícias...">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
              </form>
            </div><!--/Search Widget -->

            <!-- Categories Widget -->
            <div class="categories-widget widget-item">
              <h3 class="widget-title">Categorias</h3>
              <ul class="mt-3">
                <?php
                // Consulta para contar notícias por categoria
                $cat_query = "SELECT c.nome_categoria, COUNT(n.noticia_id) as total 
                              FROM categorias c 
                              LEFT JOIN noticias n ON c.categoria_id = n.categoria_id AND n.status = 'publicado' 
                              GROUP BY c.categoria_id, c.nome_categoria 
                              ORDER BY total DESC";
                $cat_result = mysqli_query($con, $cat_query);
                
                $categoria_display = [
                  'inovacao' => 'Inovação e Tendências',
                  'carreira' => 'Carreira e Oportunidades', 
                  'educacao' => 'Educação e Capacitação',
                  'startups' => 'Startups e Iniciativas Inovadoras',
                  'eventos' => 'Eventos e Conexões',
                  'tecnologia' => 'Tecnologia e Impacto Social'
                ];
                
                if ($cat_result && mysqli_num_rows($cat_result) > 0) {
                  while ($cat = mysqli_fetch_assoc($cat_result)) {
                    $cat_nome = $categoria_display[$cat['nome_categoria']] ?? $cat['nome_categoria'];
                    echo '<li><a href="?categoria=' . $cat['nome_categoria'] . '">' . $cat_nome . ' <span>(' . $cat['total'] . ')</span></a></li>';
                  }
                }
                ?>
              </ul>
            </div><!--/Categories Widget -->

            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">
              <h3 class="widget-title">Posts Recentes</h3>
              <?php
              // Nova conexão para os posts recentes (já que a anterior foi fechada)
              require_once '../Include/conexao.php';
              
              $recent_query = "SELECT n.noticia_id, n.titulo, n.imagem_capa, n.data_publicacao 
                              FROM noticias n 
                              WHERE n.status = 'publicado' 
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
                      <h4><a href="blog-details.php?id=<?php echo $recent['noticia_id']; ?>">
                        <?php echo htmlspecialchars($recent['titulo']); ?>
                      </a></h4>
                      <time datetime="<?php echo $recent['data_publicacao']; ?>"><?php echo $recent_data; ?></time>
                    </div>
                  </div><!-- End recent post item-->
                  <?php
                }
              } else {
                echo '<p>Nenhum post recente encontrado.</p>';
              }
              
              // Fechar conexão apenas uma vez, no final
              mysqli_close($con);
              ?>
            </div><!--/Recent Posts Widget -->

            <!-- Tags Widget -->
            <div class="tags-widget widget-item">
              <h3 class="widget-title">Tags</h3>
              <ul>
                <?php
                // Tags mais populares
                $popular_tags = ['IA', 'FrontEnd', 'BackEnd', 'Estágio', 'VagaTech', 'Mentoria', 'Networking', 'Currículo', 'Workshops', 'Certificação', 'Cursos Online', 'Notícia', 'Entrevista'];
                foreach ($popular_tags as $tag) {
                  echo '<li><a href="?search=' . urlencode($tag) . '">' . $tag . '</a></li>';
                }
                ?>
              </ul>
            </div><!--/Tags Widget -->
          </div>
        </div>
      </div>
    </div>
  </main>
  
  <footer id="footer" class="footer light-background">
    <?php require("../Include/footer.php"); ?>
  </footer>

  <?php require("../Include/preloaderAndScrollTop.php"); ?>
  <?php require("../includeJS/scriptScr.php"); ?>

<!-- Incluir apenas os arquivos JavaScript necessários -->
<script src="../includeJsNoticias/sistemaBusca.js"></script>

</body>
</html>