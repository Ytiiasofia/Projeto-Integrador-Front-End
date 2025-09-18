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
    
    /* Espaçamento entre seções */
    #blog-posts {
      margin-top: 40px;
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
        <form id="news-form">
          <div class="mb-3">
            <label for="news-title" class="form-label">Título</label>
            <input type="text" class="form-control" id="news-title" placeholder="Digite o título da notícia" required>
          </div>
          
          <div class="mb-3">
            <label for="news-content" class="form-label">Conteúdo</label>
            <textarea class="form-control" id="news-content" rows="5" placeholder="Digite o conteúdo da notícia" required></textarea>
          </div>
          
          <div class="mb-3">
            <label for="news-image" class="form-label">Imagem de Capa</label>
            <input type="file" class="form-control" id="news-image" accept="image/*">
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
            <input type="hidden" id="selected-category" name="category">
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
            <button type="submit" class="btn btn-primary">Publicar Notícia</button>
          </div>
        </form>
      </section>

      <div class="row">
        <div class="col-lg-8">
          <!-- Blog Posts Section -->
          <section id="blog-posts" class="blog-posts section">
            <div class="container">
              <div class="row gy-4">
                <div class="col-lg-6">
                  <article>
                    <div class="post-img">
                      <img src="../assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
                    </div>
                    <p class="post-category">Inovação e Tendências</p>
                    <h2 class="title">
                      <a href="noticaDetalhesAdm.php">Dolorum optio tempore voluptas dignissimos</a>
                    </h2>
                    <div class="d-flex align-items-center">
                      <img src="../assets/img/blog/blog-author.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                      <div class="post-meta">
                        <p class="post-author">Maria Doe</p>
                        <p class="post-date">
                          <time datetime="2022-01-01">Jan 1, 2022</time>
                        </p>
                      </div>
                    </div>
                  </article>
                </div><!-- End post list item -->

                <div class="col-lg-6">
                  <article>
                    <div class="post-img">
                      <img src="../assets/img/blog/blog-2.jpg" alt="" class="img-fluid">
                    </div>
                    <p class="post-category">Carreira e Oportunidades</p>
                    <h2 class="title">
                      <a href="noticaDetalhesAdm.php">Nisi magni odit consequatur autem nulla dolorem</a>
                    </h2>
                    <div class="d-flex align-items-center">
                      <img src="../assets/img/blog/blog-author-2.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                      <div class="post-meta">
                        <p class="post-author">Allisa Mayer</p>
                        <p class="post-date">
                          <time datetime="2022-01-01">Jun 5, 2022</time>
                        </p>
                      </div>
                    </div>
                  </article>
                </div><!-- End post list item -->

                <div class="col-lg-6">
                  <article>
                    <div class="post-img">
                      <img src="../assets/img/blog/blog-3.jpg" alt="" class="img-fluid">
                    </div>
                    <p class="post-category">Educação e Capacitação</p>
                    <h2 class="title">
                      <a href="noticaDetalhesAdm.php">Possimus soluta ut id suscipit ea ut in quo quia et soluta</a>
                    </h2>
                    <div class="d-flex align-items-center">
                      <img src="../assets/img/blog/blog-author-3.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                      <div class="post-meta">
                        <p class="post-author">Mark Dower</p>
                        <p class="post-date">
                          <time datetime="2022-01-01">Jun 22, 2022</time>
                        </p>
                      </div>
                    </div>
                  </article>
                </div><!-- End post list item -->

                <div class="col-lg-6">
                  <article>
                    <div class="post-img">
                      <img src="../assets/img/blog/blog-4.jpg" alt="" class="img-fluid">
                    </div>
                    <p class="post-category">Startups e Iniciativas Inovadoras</p>
                    <h2 class="title">
                      <a href="noticaDetalhesAdm.php">Non rem rerum nam cum quo minus olor distincti</a>
                    </h2>
                    <div class="d-flex align-items-center">
                      <img src="../assets/img/blog/blog-author-4.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                      <div class="post-meta">
                        <p class="post-author">Lisa Neymar</p>
                        <p class="post-date">
                          <time datetime="2022-01-01">Jun 30, 2022</time>
                        </p>
                      </div>
                    </div>
                  </article>
                </div><!-- End post list item -->

                <div class="col-lg-6">
                  <article>
                    <div class="post-img">
                      <img src="../assets/img/blog/blog-5.jpg" alt="" class="img-fluid">
                    </div>
                    <p class="post-category">Eventos e Conexões</p>
                    <h2 class="title">
                      <a href="noticaDetalhesAdm.php">Accusamus quaerat aliquam qui debitis facilis consequatur</a>
                    </h2>
                    <div class="d-flex align-items-center">
                      <img src="../assets/img/blog/blog-author-5.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                      <div class="post-meta">
                        <p class="post-author">Denis Peterson</p>
                        <p class="post-date">
                          <time datetime="2022-01-01">Jan 30, 2022</time>
                        </p>
                      </div>
                    </div>
                  </article>
                </div><!-- End post list item -->

                <div class="col-lg-6">
                  <article>
                    <div class="post-img">
                      <img src="../assets/img/blog/blog-6.jpg" alt="" class="img-fluid">
                    </div>
                    <p class="post-category">Tecnologia e Impacto Social</p>
                    <h2 class="title">
                      <a href="noticaDetalhesAdm.php">Distinctio provident quibusdam numquam aperiam aut</a>
                    </h2>
                    <div class="d-flex align-items-center">
                      <img src="../assets/img/blog/blog-author-6.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                      <div class="post-meta">
                        <p class="post-author">Mika Lendon</p>
                        <p class="post-date">
                          <time datetime="2022-01-01">Feb 14, 2022</time>
                        </p>
                      </div>
                    </div>
                  </article>
                </div><!-- End post list item -->
              </div>
            </div>
          </section><!-- /Blog Posts Section -->

          <!-- Blog Pagination Section -->
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
          </section><!-- /Blog Pagination Section -->
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
              <h3 class="widget-title">Posts Rescentes</h3>
              <div class="post-item">
                <img src="../assets/img/blog/blog-recent-1.jpg" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="blog-details.php">Nihil blanditiis at in nihil autem</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->

              <div class="post-item">
                <img src="../assets/img/blog/blog-recent-2.jpg" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="blog-details.php">Quidem autem et impedit</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->

              <div class="post-item">
                <img src="../assets/img/blog/blog-recent-3.jpg" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="blog-details.php">Id quia et et ut maxime similique occaecati ut</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->

              <div class="post-item">
                <img src="../assets/img/blog/blog-recent-4.jpg" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="blog-details.php">Laborum corporis quo dara net para</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->

              <div class="post-item">
                <img src="../assets/img/blog/blog-recent-5.jpg" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="blog-details.php">Et dolores corrupti quae illo quod dolor</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->
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
          badge.textContent = tag;
          
          const removeBtn = document.createElement('span');
          removeBtn.innerHTML = ' &times;';
          removeBtn.style.cursor = 'pointer';
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
        if (!selectedCategoryInput.value) {
          alert('Por favor, selecione uma categoria');
          return;
        }
        
        if (selectedTags.length === 0) {
          alert('Por favor, adicione pelo menos uma tag');
          return;
        }
        
        // Simulação de envio
        alert('Notícia enviada para aprovação!');
        this.reset();
        selectedTags = [];
        updateTagContainer();
        updateSelectedTagsInput();
        selectedCategoryInput.value = '';
        categoryOptions.forEach(opt => opt.classList.remove('selected'));
        tagBadges.forEach(badge => badge.classList.remove('selected'));
      });
    });
  </script>
</body>
</html>