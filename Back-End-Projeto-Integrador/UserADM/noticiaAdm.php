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
    /* Estilo para a seção de adicionar notícias */
    .add-news-section {
      background-color: #f8f9fa;
      border-radius: 8px;
      padding: 25px;
      margin-bottom: 40px;
      margin-top: 30px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .tag-badge {
      margin-right: 5px;
      margin-bottom: 5px;
      font-size: 0.8rem;
      font-weight: normal;
      cursor: pointer;
      background-color: #6a62d4;
      color: white;
    }
    
    .tag-badge:hover {
      opacity: 0.9;
    }
    
    .tag-badge.selected {
      background-color: #6a62d4;
      opacity: 0.8;
    }
    
    .category-option {
      padding: 8px 15px;
      border-radius: 20px;
      margin-right: 10px;
      margin-bottom: 10px;
      background-color: #e9ecef;
      cursor: pointer;
      display: inline-block;
    }
    
    .category-option:hover {
      background-color: #dee2e6;
    }
    
    .category-option.selected {
      background-color: #6a62d4;
      color: white;
    }
    
    #tag-container {
      min-height: 42px;
      border: 1px solid #ced4da;
      border-radius: 4px;
      padding: 5px;
    }
    
    .delete-news {
      font-size: 0.8rem;
      padding: 0.25rem 0.5rem;
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
            <li class="current">Adicione noticías relevantes da área</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <div class="container">
      <!-- Seção para Adicionar Notícia -->
      <section id="add-news" class="add-news-section" data-aos="fade-up">
        <h3><i class="bi bi-plus-circle"></i> Adicionar Nova Notícia</h3>
        <form id="news-form" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="news-title" class="form-label">Título</label>
            <input type="text" class="form-control" id="news-title" name="titulo" placeholder="Digite o título da notícia" required>
          </div>
          
          <div class="mb-3">
            <label for="news-content" class="form-label">Conteúdo</label>
            <textarea class="form-control" id="news-content" name="conteudo" rows="5" placeholder="Digite o conteúdo da notícia" required></textarea>
          </div>
          
          <div class="mb-3">
            <label for="news-image" class="form-label">Imagem de Capa</label>
            <input type="file" class="form-control" id="news-image" name="imagem_capa" accept="image/*">
          </div>
          
          <div class="mb-3">
            <label class="form-label">Categoria</label>
            <div>
              <div class="category-option" data-category="inovacao">Inovação e Tendências</div>
              <div class="category-option" data-category="carreira">Carreira e Oportunidades</div>
              <div class="category-option" data-category="educacao">Educação e Capacitação</div>
              <div class="category-option" data-category="startups">Startups e Iniciativas Inovadoras</div>
              <div class="category-option" data-category="eventos">Eventos e Conexões</div>
              <div class="category-option" data-category="tecnologia">Tecnologia e Impacto Social</div>
            </div>
            <input type="hidden" id="selected-category" name="categoria">
          </div>
          
          <div class="mb-3">
            <label class="form-label">Tags</label>
            <div class="mb-2">
              <span class="badge tag-badge" data-tag="IA">IA</span>
              <span class="badge tag-badge" data-tag="FrontEnd">FrontEnd</span>
              <span class="badge tag-badge" data-tag="BackEnd">BackEnd</span>
              <span class="badge tag-badge" data-tag="Estágio">Estágio</span>
              <span class="badge tag-badge" data-tag="VagaTech">VagaTech</span>
              <span class="badge tag-badge" data-tag="Mentoria">Mentoria</span>
              <span class="badge tag-badge" data-tag="Networking">Networking</span>
              <span class="badge tag-badge" data-tag="Currículo">Currículo</span>
              <span class="badge tag-badge" data-tag="Workshops">Workshops</span>
              <span class="badge tag-badge" data-tag="Certificação">Certificação</span>
              <span class="badge tag-badge" data-tag="Cursos Online">Cursos Online</span>
              <span class="badge tag-badge" data-tag="Notícia">Notícia</span>
              <span class="badge tag-badge" data-tag="Entrevista">Entrevista</span>
            </div>
            <div id="tag-container" class="mb-2"></div>
            <input type="text" class="form-control" id="new-tag" placeholder="Digite uma nova tag e pressione Enter">
            <input type="hidden" id="selected-tags" name="tags">
          </div>
          
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary me-2" id="clear-form">Limpar</button>
            <button type="submit" class="btn btn-primary" id="submit-btn">Publicar Notícia</button>
          </div>
        </form>
      </section>

      <div class="row">
        <div class="col-lg-8">
          <!-- Blog Posts Section -->
          <section id="blog-posts" class="blog-posts section">
            <div class="container">
              <div class="row gy-4">
                <?php
                // Conexão e consulta para as notícias principais
                require_once '../Include/conexao.php';
                
                // Consulta para buscar notícias
                $query = "SELECT n.*, c.nome_categoria, u.nome_usuario 
                          FROM noticias n 
                          JOIN categorias c ON n.categoria_id = c.categoria_id 
                          JOIN usuarios u ON n.autor_id = u.usuario_id 
                          WHERE n.status = 'publicado' 
                          ORDER BY n.data_publicacao DESC 
                          LIMIT 6";
                
                $result = mysqli_query($con, $query);
                
                if ($result && mysqli_num_rows($result) > 0) {
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
                      <article>
                        <div class="post-img">
                          <?php if ($noticia['imagem_capa']): ?>
                            <img src="../<?php echo $noticia['imagem_capa']; ?>" alt="<?php echo $noticia['titulo']; ?>" class="img-fluid">
                          <?php else: ?>
                            <img src="../assets/img/blog/blog-1.jpg" alt="Imagem padrão" class="img-fluid">
                          <?php endif; ?>
                        </div>
                        <p class="post-category"><?php echo $categoria_nome; ?></p>
                        <h2 class="title">
                          <a href="noticiaDetalhesAdm.php?id=<?php echo $noticia['noticia_id']; ?>">
                            <?php echo htmlspecialchars($noticia['titulo']); ?>
                          </a>
                        </h2>
                        <div class="d-flex align-items-center">
                          <img src="../assets/img/blog/blog-author.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
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
                        
                        <!-- Botão de Deletar -->
                        <div class="mt-3">
                          <button class="btn btn-danger btn-sm delete-news" 
                                  data-id="<?php echo $noticia['noticia_id']; ?>" 
                                  data-title="<?php echo htmlspecialchars($noticia['titulo']); ?>">
                            <i class="bi bi-trash"></i> Deletar
                          </button>
                        </div>
                      </article>
                    </div><!-- End post list item -->
                    <?php
                  }
                } else {
                  echo '<div class="col-12"><p class="text-center">Nenhuma notícia publicada ainda.</p></div>';
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
              <form action="">
                <input type="text">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
              </form>
            </div><!--/Search Widget -->

            <!-- Categories Widget -->
            <div class="categories-widget widget-item">
              <h3 class="widget-title">Categorias</h3>
              <ul class="mt-3">
                <li><a href="#">Inovação e Tendências <span>(25)</span></a></li>
                <li><a href="#">Carreira e Oportunidades <span>(12)</span></a></li>
                <li><a href="#">Educação e Capacitação <span>(5)</span></a></li>
                <li><a href="#">Startups e Iniciativas Inovadoras <span>(22)</span></a></li>
                <li><a href="#">Eventos e Conexões <span>(8)</span></a></li>
                <li><a href="#">Tecnologia e Impacto Social <span>(14)</span></a></li>
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
                      <h4><a href="noticiaDetalhesAdm.php?id=<?php echo $recent['noticia_id']; ?>">
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
                <li><a href="#">IA</a></li>
                <li><a href="#">FrontEnd</a></li>
                <li><a href="#">BackEnd</a></li>
                <li><a href="#">Estágio</a></li>
                <li><a href="#">VagaTech</a></li>
                <li><a href="#">Mentoria</a></li>
                <li><a href="#">Networking</a></li>
                <li><a href="#">Currículo</a></li>
                <li><a href="#">Workshops</a></li>
                <li><a href="#">Certificação</a></li>
                <li><a href="#">Cursos Online</a></li>
                <li><a href="#">Notícia</a></li>
                <li><a href="#">Entrevista</a></li>
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

  <!-- Script para a seção de adicionar notícias -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Seleção de categorias
      const categoryOptions = document.querySelectorAll('.category-option');
      const selectedCategoryInput = document.getElementById('selected-category');
      
      categoryOptions.forEach(option => {
        option.addEventListener('click', function() {
          // Remove a seleção de todas as categorias
          categoryOptions.forEach(opt => opt.classList.remove('selected'));
          
          // Adiciona a seleção apenas à categoria clicada
          this.classList.add('selected');
          selectedCategoryInput.value = this.getAttribute('data-category');
        });
      });
      
      // Seleção de tags
      const tagBadges = document.querySelectorAll('.tag-badge');
      const tagContainer = document.getElementById('tag-container');
      const selectedTagsInput = document.getElementById('selected-tags');
      const newTagInput = document.getElementById('new-tag');
      let selectedTags = [];
      
      tagBadges.forEach(badge => {
        badge.addEventListener('click', function() {
          const tag = this.getAttribute('data-tag');
          
          if (this.classList.contains('selected')) {
            // Remove a tag se já estiver selecionada
            this.classList.remove('selected');
            selectedTags = selectedTags.filter(t => t !== tag);
          } else {
            // Adiciona a tag se não estiver selecionada
            this.classList.add('selected');
            selectedTags.push(tag);
          }
          
          updateTagContainer();
          updateSelectedTagsInput();
        });
      });
      
      // Adicionar nova tag
      newTagInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          const newTag = this.value.trim();
          
          if (newTag && !selectedTags.includes(newTag)) {
            selectedTags.push(newTag);
            updateTagContainer();
            updateSelectedTagsInput();
            this.value = '';
          }
        }
      });
      
      // Atualiza o container de tags selecionadas
      function updateTagContainer() {
        tagContainer.innerHTML = '';
        selectedTags.forEach(tag => {
          const badge = document.createElement('span');
          badge.className = 'badge me-1 mb-1';
          badge.style.backgroundColor = '#6a62d4';
          badge.style.color = 'white';
          badge.style.cursor = 'default';
          badge.textContent = tag;
          
          const removeBtn = document.createElement('span');
          removeBtn.innerHTML = ' &times;';
          removeBtn.style.cursor = 'pointer';
          removeBtn.style.fontWeight = 'bold';
          removeBtn.addEventListener('click', () => {
            selectedTags = selectedTags.filter(t => t !== tag);
            updateTagContainer();
            updateSelectedTagsInput();
            
            // Remove a seleção da tag na lista de opções
            const tagBadge = document.querySelector(`.tag-badge[data-tag="${tag}"]`);
            if (tagBadge) {
              tagBadge.classList.remove('selected');
            }
          });
          
          badge.appendChild(removeBtn);
          tagContainer.appendChild(badge);
        });
      }
      
      // Atualiza o input hidden com as tags selecionadas
      function updateSelectedTagsInput() {
        selectedTagsInput.value = selectedTags.join(',');
      }
      
      // Limpar formulário
      document.getElementById('clear-form').addEventListener('click', function() {
        document.getElementById('news-form').reset();
        selectedTags = [];
        updateTagContainer();
        updateSelectedTagsInput();
        selectedCategoryInput.value = '';
        
        // Remove seleção de categorias
        categoryOptions.forEach(opt => opt.classList.remove('selected'));
        
        // Remove seleção de tags
        tagBadges.forEach(badge => badge.classList.remove('selected'));
      });
      
      // Enviar formulário
      document.getElementById('news-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validação básica
        const titulo = document.getElementById('news-title').value.trim();
        const conteudo = document.getElementById('news-content').value.trim();
        
        if (!titulo) {
          showAlert('Por favor, digite um título para a notícia', 'warning');
          return;
        }
        
        if (!conteudo) {
          showAlert('Por favor, digite o conteúdo da notícia', 'warning');
          return;
        }
        
        if (!selectedCategoryInput.value) {
          showAlert('Por favor, selecione uma categoria', 'warning');
          return;
        }
        
        if (selectedTags.length === 0) {
          showAlert('Por favor, adicione pelo menos uma tag', 'warning');
          return;
        }

        // Desabilitar botão para evitar múltiplos envios
        const submitBtn = document.getElementById('submit-btn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Publicando...';

        // Criar FormData para enviar arquivos
        const formData = new FormData(this);
        
        // Enviar via AJAX
        fetch('../controleNoticias/processar_noticia.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            showAlert(data.message, 'success');
            // Limpar formulário
            this.reset();
            selectedTags = [];
            updateTagContainer();
            updateSelectedTagsInput();
            selectedCategoryInput.value = '';
            categoryOptions.forEach(opt => opt.classList.remove('selected'));
            tagBadges.forEach(badge => badge.classList.remove('selected'));
            
            // Recarregar a lista de notícias após 2 segundos
            setTimeout(() => {
              location.reload();
            }, 2000);
          } else {
            showAlert('Erro: ' + data.message, 'error');
          }
        })
        .catch(error => {
          console.error('Erro:', error);
          showAlert('Erro ao publicar notícia. Tente novamente.', 'error');
        })
        .finally(() => {
          // Reabilitar botão
          submitBtn.disabled = false;
          submitBtn.innerHTML = 'Publicar Notícia';
        });
      });

      // Configurar botões de deletar
      setupDeleteButtons();

      // Função para mostrar alertas personalizados
      function showAlert(message, type) {
        // Remove alertas existentes
        const existingAlert = document.querySelector('.custom-alert');
        if (existingAlert) {
          existingAlert.remove();
        }

        // Cria novo alerta
        const alert = document.createElement('div');
        alert.className = `custom-alert alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show`;
        alert.style.cssText = `
          position: fixed;
          top: 20px;
          right: 20px;
          z-index: 9999;
          min-width: 300px;
        `;
        alert.innerHTML = `
          ${message}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        document.body.appendChild(alert);

        // Remove automaticamente após 5 segundos
        setTimeout(() => {
          if (alert.parentNode) {
            alert.remove();
          }
        }, 5000);
      }

      // Função para configurar botões de deletar
      function setupDeleteButtons() {
        const deleteButtons = document.querySelectorAll('.delete-news');
        
        deleteButtons.forEach(button => {
          button.addEventListener('click', function() {
            const noticiaId = this.getAttribute('data-id');
            const noticiaTitle = this.getAttribute('data-title');
            
            // Confirmação antes de deletar
            if (confirm(`Tem certeza que deseja deletar a notícia "${noticiaTitle}"?\nEsta ação não pode ser desfeita.`)) {
              deleteNoticia(noticiaId, this);
            }
          });
        });
      }

      // Função para fazer a requisição de deleção
      function deleteNoticia(noticiaId, buttonElement) {
        // Desabilitar botão
        buttonElement.disabled = true;
        buttonElement.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Deletando...';

        // Criar FormData
        const formData = new FormData();
        formData.append('noticia_id', noticiaId);
        
        // Enviar via AJAX
        fetch('../controleNoticias/deletar_noticia.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            showAlert(data.message, 'success');
            // Remover o elemento da notícia da página
            const articleElement = buttonElement.closest('.col-lg-6');
            articleElement.style.opacity = '0';
            articleElement.style.transition = 'opacity 0.3s ease';
            
            setTimeout(() => {
              articleElement.remove();
              
              // Verificar se não há mais notícias
              const remainingArticles = document.querySelectorAll('.col-lg-6');
              if (remainingArticles.length === 0) {
                const blogPostsSection = document.getElementById('blog-posts');
                const container = blogPostsSection.querySelector('.container');
                container.innerHTML = '<div class="row gy-4"><div class="col-12"><p class="text-center">Nenhuma notícia publicada ainda.</p></div></div>';
              }
            }, 300);
            
          } else {
            showAlert('Erro: ' + data.message, 'error');
            // Reabilitar botão em caso de erro
            buttonElement.disabled = false;
            buttonElement.innerHTML = '<i class="bi bi-trash"></i> Deletar';
          }
        })
        .catch(error => {
          console.error('Erro:', error);
          showAlert('Erro ao deletar notícia. Tente novamente.', 'error');
          // Reabilitar botão em caso de erro
          buttonElement.disabled = false;
          buttonElement.innerHTML = '<i class="bi bi-trash"></i> Deletar';
        });
      }
    });
  </script>
</body>
</html>