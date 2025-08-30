<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Recuperar Senha - She Innovates</title>
  <meta name="description" content="Recuperação de senha para usuários">
  <meta name="keywords" content="recuperar senha, redefinir senha, acesso">

    <?php
    require("../Include/hrefCssHead.php");
    ?>

</head>
  <style>
    .recovery-form {
      background-color: white;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      max-width: 500px;
      margin: 0 auto;
    }
    
    .recovery-steps {
      margin-bottom: 25px;
    }
    
    .step {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }
    
    .step-number {
      width: 30px;
      height: 30px;
      background-color: #6a62d4;
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 10px;
      font-weight: bold;
    }
    
    .step-text {
      color: #495057;
    }
    
    .btn-recovery {
      background-color: #6a62d4;
      border-color: #6a62d4;
    }
    
    .btn-recovery:hover {
      background-color: #5a52c4;
      border-color: #5a52c4;
    }
    
    .login-link {
      color: #6a62d4;
      text-decoration: none;
    }
    
    .login-link:hover {
      text-decoration: underline;
    }
  </style>

<body class="contact-page">

<?php require_once __DIR__ . '/../include/menuADM.php'; ?>


  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(../assets/img/contact-page-title-bg.jpg);">
      <div class="container">
        <h1>Recuperar Senha</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Início</a></li>
            <li><a href="contact.php">Login</a></li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- End Page Title -->

    <!-- Recovery Container -->
    <section class="recovery-section">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="recovery-form">
              <h2 class="text-center mb-4">Redefina sua senha</h2>
              
              <div class="recovery-steps">
                <div class="step">
                  <div class="step-number">1</div>
                  <div class="step-text">Informe seu e-mail cadastrado</div>
                </div>
                <div class="step">
                  <div class="step-number">2</div>
                  <div class="step-text">Receba o link de recuperação</div>
                </div>
                <div class="step">
                  <div class="step-number">3</div>
                  <div class="step-text">Crie uma nova senha</div>
                </div>
              </div>

              <form id="recoveryForm">
                <div class="mb-4">
                  <label for="recoveryEmail" class="form-label">E-mail cadastrado</label>
                  <input type="email" class="form-control" id="recoveryEmail" placeholder="Digite seu e-mail" required>
                  <div class="form-text mt-1">Enviaremos um link para redefinir sua senha</div>
                </div>
                
                <div class="d-grid gap-2 mb-3">
                  <button type="submit" class="btn btn-recovery text-white">Enviar Link de Recuperação</button>
                </div>
                
                <div class="text-center">
                  <p>Lembrou sua senha? <a href="contact.php" class="login-link">Faça login</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Recovery Container -->

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

  <!-- Recovery Form Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const recoveryForm = document.getElementById('recoveryForm');
      
      recoveryForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const email = document.getElementById('recoveryEmail').value;
        
        // Simple email validation
        if (!email.includes('@') || !email.includes('.')) {
          alert('Por favor, insira um e-mail válido!');
          return;
        }
        
        // Simulate sending recovery email
        alert(`Link de recuperação enviado para: ${email}\n\n(Esta é uma simulação. Em um sistema real, um e-mail seria enviado com instruções para redefinir a senha.)`);
        
        // In a real application, you would:
        // 1. Check if email exists in your database
        // 2. Generate a unique token
        // 3. Send email with reset link
        // 4. Store token in database with expiration
      });
    });
  </script>
</body>

</html>