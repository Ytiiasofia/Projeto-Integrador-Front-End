<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login - She Innovates</title>
  <meta name="description" content="Página de login para usuários">
  <meta name="keywords" content="login, cadastro, usuário">

  <?php
  require("../Include/hrefCssHead.php");
  ?>

  <style>
    .login-form {
      background-color: white;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .login-divider {
      display: flex;
      align-items: center;
      margin: 20px 0;
    }
    
    .login-divider::before,
    .login-divider::after {
      content: "";
      flex: 1;
      border-bottom: 1px solid #dee2e6;
    }
    
    .login-divider-text {
      padding: 0 10px;
      color: #6c757d;
    }
    
    .btn-register {
      background-color:  #877feb;
      border-color:  #877feb;
    }
    
    .btn-register:hover {
      background-color: #6a62d4;
      border-color: #6a62d4;
    }
  </style>
</head>

<body class="contact-page">

<?php require_once __DIR__ . '/../include/menuADM.php'; ?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(../assets/img/services.jpg);">
      <div class="container">
        <h1>Login</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Início</a></li>
            <li class="current">Login</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- End Page Title -->

    <!-- Login Container -->
    <section class="login-section">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="login-form">
              <h2 class="text-center mb-4">Acesse sua conta</h2>

              <form>
                <div class="mb-3">
                  <label for="username" class="form-label">Usuário ou E-mail</label>
                  <input type="text" class="form-control" id="username" placeholder="Digite seu usuário ou e-mail">
                </div>

                <div class="mb-3">
                  <label for="password" class="form-label">Senha</label>
                  <input type="password" class="form-control" id="password" placeholder="Digite sua senha">
                </div>

                <div class="d-flex justify-content-between mb-4">
                  <div>
                    <a href="recSenha.php" class="text-primary">Esqueceu sua senha?</a>
                  </div>
                </div>

                <div class="d-grid gap-2">
                  <a href="inicioUserCad.php" class="btn btn-primary">Entrar</a>
                </div>

                <div class="login-divider">
                  <span class="login-divider-text">OU</span>
                </div>

                <div class="d-grid gap-2">
                  <a href="cadastro.php" class="btn btn-primary">Criar nova conta</a>
                </div>

                <div class="d-grid gap-2 mt-3">
                  <a href="perfilAdm.php" class="btn btn-primary">Acessar como Administrador</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Login Container -->

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