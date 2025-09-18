<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Blog - Nova Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <?php
  require("../Include/hrefCssHead.php");
  ?>

</head>

<body class="blog-page">

  <!-- Cabeçalho -->
<?php require_once __DIR__ . '/../Include/menuADM.php'; ?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(../../assets/img/blog-page-title-bg.jpg);">
      <div class="container">
        <h1>Notícias</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Início</a></li>
            <li class="current">Notícias</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- End Page Title -->

    <div class="container">
      <div class="row">

        <div class="col-lg-8">

          <!-- Blog Posts Section -->
          <section id="blog-posts" class="blog-posts section">
            <div class="container">
              <div class="row gy-4">

                <!-- Post 1 -->
                <div class="col-lg-6">
                  <article>
                    <div class="post-img">
                      <img src="../../assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
                    </div>
                    <p class="post-category">Politics</p>
                    <h2 class="title">
                      <a href="blog-details.php">Dolorum optio tempore voluptas dignissimos</a>
                    </h2>
                    <div class="d-flex align-items-center">
                      <img src="../../assets/img/blog/blog-author.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                      <div class="post-meta">
                        <p class="post-author">Maria Doe</p>
                        <p class="post-date"><time datetime="2022-01-01">Jan 1, 2022</time></p>
                      </div>
                    </div>
                  </article>
                </div>

                <!-- Post 2 -->
                <div class="col-lg-6">
                  <article>
                    <div class="post-img">
                      <img src="../../assets/img/blog/blog-2.jpg" alt="" class="img-fluid">
                    </div>
                    <p class="post-category">Sports</p>
                    <h2 class="title">
                      <a href="blog-details.php">Nisi magni odit consequatur autem nulla dolorem</a>
                    </h2>
                    <div class="d-flex align-items-center">
                      <img src="../../assets/img/blog/blog-author-2.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                      <div class="post-meta">
                        <p class="post-author">Allisa Mayer</p>
                        <p class="post-date"><time datetime="2022-01-01">Jun 5, 2022</time></p>
                      </div>
                    </div>
                  </article>
                </div>

                <!-- Post 3 -->
                <div class="col-lg-6">
                  <article>
                    <div class="post-img">
                      <img src="../../assets/img/blog/blog-3.jpg" alt="" class="img-fluid">
                    </div>
                    <p class="post-category">Entertainment</p>
                    <h2 class="title">
                      <a href="blog-details.php">Possimus soluta ut id suscipit ea ut in quo quia et soluta</a>
                    </h2>
                    <div class="d-flex align-items-center">
                      <img src="../../assets/img/blog/blog-author-3.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                      <div class="post-meta">
                        <p class="post-author">Mark Dower</p>
                        <p class="post-date"><time datetime="2022-01-01">Jun 22, 2022</time></p>
                      </div>
                    </div>
                  </article>
                </div>

                <!-- Post 4 -->
                <div class="col-lg-6">
                  <article>
                    <div class="post-img">
                      <img src="../../assets/img/blog/blog-4.jpg" alt="" class="img-fluid">
                    </div>
                    <p class="post-category">Sports</p>
                    <h2 class="title">
                      <a href="blog-details.php">Non rem rerum nam cum quo minus olor distincti</a>
                    </h2>
                    <div class="d-flex align-items-center">
                      <img src="../../assets/img/blog/blog-author-4.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                      <div class="post-meta">
                        <p class="post-author">Lisa Neymar</p>
                        <p class="post-date"><time datetime="2022-01-01">Jun 30, 2022</time></p>
                      </div>
                    </div>
                  </article>
                </div>

                <!-- Post 5 -->
                <div class="col-lg-6">
                  <article>
                    <div class="post-img">
                      <img src="../../assets/img/blog/blog-5.jpg" alt="" class="img-fluid">
                    </div>
                    <p class="post-category">Politics</p>
                    <h2 class="title">
                      <a href="blog-details.php">Accusamus quaerat aliquam qui debitis facilis consequatur</a>
                    </h2>
                    <div class="d-flex align-items-center">
                      <img src="../../assets/img/blog/blog-author-5.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                      <div class="post-meta">
                        <p class="post-author">Denis Peterson</p>
                        <p class="post-date"><time datetime="2022-01-01">Jan 30, 2022</time></p>
                      </div>
                    </div>
                  </article>
                </div>

                <!-- Post 6 -->
                <div class="col-lg-6">
                  <article>
                    <div class="post-img">
                      <img src="../../assets/img/blog/blog-6.jpg" alt="" class="img-fluid">
                    </div>
                    <p class="post-category">Entertainment</p>
                    <h2 class="title">
                      <a href="blog-details.php">Distinctio provident quibusdam numquam aperiam aut</a>
                    </h2>
                    <div class="d-flex align-items-center">
                      <img src="../../assets/img/blog/blog-author-6.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                      <div class="post-meta">
                        <p class="post-author">Mika Lendon</p>
                        <p class="post-date"><time datetime="2022-01-01">Feb 14, 2022</time></p>
                      </div>
                    </div>
                  </article>
                </div>

              </div>
            </div>
          </section>

          <!-- Blog Pagination -->
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

        <!-- Sidebar -->
        <div class="col-lg-4 sidebar">
          <div class="widgets-container">

            <!-- Search Widget -->
            <div class="search-widget widget-item">
              <h3 class="widget-title">Pesquisa</h3>
              <form action="">
                <input type="text">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
              </form>
            </div>

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
            </div>

            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">
              <h3 class="widget-title">Posts Recentes</h3>

              <div class="post-item">
                <img src="../../assets/img/blog/blog-recent-1.jpg" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="blog-details.php">Nihil blanditiis at in nihil autem</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div>

              <div class="post-item">
                <img src="../../assets/img/blog/blog-recent-2.jpg" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="blog-details.php">Quidem autem et impedit</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div>

              <div class="post-item">
                <img src="../../assets/img/blog/blog-recent-3.jpg" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="blog-details.php">Id quia et et ut maxime similique occaecati ut</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div>

              <div class="post-item">
                <img src="../../assets/img/blog/blog-recent-4.jpg" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="blog-details.php">Laborum corporis quo dara net para</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div>

              <div class="post-item">
                <img src="../../assets/img/blog/blog-recent-5.jpg" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="blog-details.php">Et dolores corrupti quae illo quod dolor</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div>

            </div>

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
            </div>

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

</body>

</html>
