<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro - She Innovates</title>
  <?php require("../Include/hrefCssHead.php"); ?>
  <style>
    .signup-form { background-color: white; border-radius: 8px; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); max-width: 600px; margin: 0 auto; }
    .password-strength { height: 5px; background-color: #e9ecef; margin-top: 5px; border-radius: 3px; overflow: hidden; }
    .password-strength-bar { height: 100%; width: 0%; background-color: #6a62d4; transition: width 0.3s ease; }
    .form-note { font-size: 0.85rem; color: #6c757d; margin-top: 5px; }
    .btn-signup { background-color: #6a62d4; border-color: #6a62d4; }
    .btn-signup:hover { background-color: #5a52c4; border-color: #5a52c4; }
    .login-link { color: #6a62d4; text-decoration: none; }
    .login-link:hover { text-decoration: underline; }
    .alert { padding: 10px; margin-bottom: 15px; border-radius: 5px; }
    .alert-success { background-color: #d4edda; color: #155724; }
    .alert-error { background-color: #f8d7da; color: #721c24; }
  </style>
</head>
<body class="contact-page">
<?php require_once __DIR__ . '/../Include/menuADM.php'; ?>
<main class="main">

  <!-- Título -->
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
  <!-- Título -->

  <section class="signup-section">
    <div class="container" data-aos="fade-up">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="signup-form">
            <h2 class="text-center mb-4">Junte-se à nossa comunidade</h2>

            <!-- Mensagens de feedback de cadastro -->
            <?php 
            // Exibir mensagens de retorno do processamento
            if (isset($_GET['success']) && $_GET['success'] == '1') {
                echo "<div class='alert alert-success'>Cadastro realizado com sucesso!</div>";
            }
            if (isset($_GET['error'])) {
                $error_message = htmlspecialchars($_GET['error']);
                echo "<div class='alert alert-error'>$error_message</div>";
            }
            ?>
            <!-- Fim das mensagens de feedback de cadastro -->

            <form id="signupForm" method="POST" action="processa_cadastro.php">
              <div class="mb-3">
                <label for="username" class="form-label">Nome de usuário</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Escolha um nome de usuário" 
                       value="<?php echo isset($_GET['username']) ? htmlspecialchars($_GET['username']) : ''; ?>" required>
                <div class="form-note">Mínimo de 4 caracteres</div>
              </div>
              
              <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Seu e-mail" 
                       value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>" required>
              </div>
              
              <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Crie uma senha" required>
                <div class="password-strength">
                  <div class="password-strength-bar" id="passwordStrength"></div>
                </div>
                <div class="form-note">Mínimo de 8 caracteres, incluindo números e letras</div>
              </div>
              
              <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirmar Senha</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Repita sua senha" required>
              </div>   

              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="termsCheck" required>
                <label class="form-check-label" for="termsCheck">Concordo com os Termos de Serviço e Política de Privacidade</label>
              </div>

              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-signup">Criar conta</button>
              </div>
              
              <div class="text-center mt-3">
                <p>Já tem uma conta? <a href="contact.php" class="login-link">Faça login</a></p>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<footer id="footer" class="footer light-background">
  <?php require("../Include/footer.php"); ?>
</footer>

<?php require("../Include/preloaderAndScrollTop.php"); ?>
<?php require("../Include/scriptScr.php"); ?>

<!-- Script para barra de força da senha -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const passwordInput = document.getElementById('password');
  const passwordStrength = document.getElementById('passwordStrength');
  
  passwordInput.addEventListener('input', function() {
    const password = this.value;
    let strength = 0;
    if (password.length >= 8) strength += 25;
    if (/[A-Z]/.test(password)) strength += 25;
    if (/[0-9]/.test(password)) strength += 25;
    if (/[^A-Za-z0-9]/.test(password)) strength += 25;
    strength = Math.min(strength, 100);
    passwordStrength.style.width = strength + '%';
    if (strength < 40) passwordStrength.style.backgroundColor = '#dc3545';
    else if (strength < 70) passwordStrength.style.backgroundColor = '#fd7e14';
    else passwordStrength.style.backgroundColor = '#28a745';
  });
});
</script>

</body>
</html>