<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Cadastro - She Innovates</title>
  <meta name="description" content="Página de cadastro para novos usuários">
  <meta name="keywords" content="cadastro, registro, nova conta">

  <?php
  require("../Include/hrefCssHead.php");
  ?>
</head>
  <style>
    .signup-form {
      background-color: white;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      max-width: 600px;
      margin: 0 auto;
    }
    
    .password-strength {
      height: 5px;
      background-color: #e9ecef;
      margin-top: 5px;
      border-radius: 3px;
      overflow: hidden;
    }
    
    .password-strength-bar {
      height: 100%;
      width: 0%;
      background-color: #6a62d4;
      transition: width 0.3s ease;
    }
    
    .form-note {
      font-size: 0.85rem;
      color: #6c757d;
      margin-top: 5px;
    }
    
    .btn-signup {
      background-color: #6a62d4;
      border-color: #6a62d4;
    }
    
    .btn-signup:hover {
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
        <h1>Criar Conta</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Início</a></li>
            <li class="current">Cadastro</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- End Page Title -->

    <!-- Signup Container -->
    <section class="signup-section">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="signup-form">
              <h2 class="text-center mb-4">Junte-se à nossa comunidade</h2>
              
              <form id="signupForm">
                
                <div class="mb-3">
                  <label for="username" class="form-label">Nome de usuário</label>
                  <input type="text" class="form-control" id="username" placeholder="Escolha um nome de usuário" required>
                  <div class="form-note">Mínimo de 4 caracteres</div>
                </div>
                
                <div class="mb-3">
                  <label for="email" class="form-label">E-mail</label>
                  <input type="email" class="form-control" id="email" placeholder="Seu e-mail" required>
                </div>
                
                <div class="mb-3">
                  <label for="password" class="form-label">Senha</label>
                  <input type="password" class="form-control" id="password" placeholder="Crie uma senha" required>
                  <div class="password-strength">
                    <div class="password-strength-bar" id="passwordStrength"></div>
                  </div>
                  <div class="form-note">Mínimo de 8 caracteres, incluindo números e letras</div>
                </div>
                
                <div class="mb-3">
                  <label for="confirmPassword" class="form-label">Confirmar Senha</label>
                  <input type="password" class="form-control" id="confirmPassword" placeholder="Repita sua senha" required>
                </div>   
                <div class="d-grid gap-2">
                  <a href="perfilUserCad.php" class="btn btn-primary">Criar conta</a>
                </div>
                
                <div class="text-center">
                  <p>Já tem uma conta? <a href="contact.php" class="login-link">Faça login</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Signup Container -->

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

  <!-- Signup Form Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const passwordInput = document.getElementById('password');
      const passwordStrength = document.getElementById('passwordStrength');
      const signupForm = document.getElementById('signupForm');
      
      // Password strength indicator
      passwordInput.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;
        
        // Length check
        if (password.length >= 8) strength += 25;
        if (password.length >= 12) strength += 25;
        
        // Character variety
        if (/[A-Z]/.test(password)) strength += 15;
        if (/[0-9]/.test(password)) strength += 15;
        if (/[^A-Za-z0-9]/.test(password)) strength += 20;
        
        // Update strength bar
        strength = Math.min(strength, 100);
        passwordStrength.style.width = strength + '%';
        
        // Update color based on strength
        if (strength < 40) {
          passwordStrength.style.backgroundColor = '#dc3545';
        } else if (strength < 70) {
          passwordStrength.style.backgroundColor = '#fd7e14';
        } else {
          passwordStrength.style.backgroundColor = '#28a745';
        }
      });
      
      // Form validation
      signupForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        
        // Check if passwords match
        if (password !== confirmPassword) {
          alert('As senhas não coincidem!');
          return;
        }
        
        // Check password strength
        if (password.length < 8) {
          alert('A senha deve ter pelo menos 8 caracteres!');
          return;
        }
        
        // Check terms agreement
        if (!document.getElementById('termsCheck').checked) {
          alert('Você deve concordar com os Termos de Serviço e Política de Privacidade!');
          return;
        }
        
        // Simulate successful registration
        alert('Cadastro realizado com sucesso! Redirecionando...');
        setTimeout(() => {
          window.location.href = 'perfilUserCad.php';
        }, 1500);
      });
    });
  </script>
</body>

</html>