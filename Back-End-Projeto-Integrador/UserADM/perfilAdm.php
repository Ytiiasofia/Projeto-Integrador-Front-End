<?php
session_start();
require("../Include/conexao.php");

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login/login.php");
    exit();
}

// Buscar dados do usuário administrador
$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT usuario_id, nome_usuario, email, is_admin, data_cadastro FROM usuarios WHERE usuario_id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $usuario_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$usuario = mysqli_fetch_assoc($result);

if (!$usuario) {
    echo "Usuário não encontrado!";
    exit();
}

// Formatar data de cadastro
if (isset($usuario['data_cadastro']) && !empty($usuario['data_cadastro'])) {
    $data_cadastro = date('F Y', strtotime($usuario['data_cadastro']));
    $meses_ingles = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $meses_portugues = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
    $data_cadastro = str_replace($meses_ingles, $meses_portugues, $data_cadastro);
} else {
    $data_cadastro = "Janeiro 2022"; // Placeholder
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Perfil Admin - She Innovates</title>
  <meta name="description" content="Página de perfil do administrador">
  <meta name="keywords" content="perfil, administrador, configurações">

  <?php
  require("../Include/hrefCssHead.php");
  ?>

  
  <!-- Custom Admin CSS -->
  <style>
    .admin-badge {
      background-color: #dc3545;
      color: white;
      padding: 3px 8px;
      border-radius: 12px;
      font-size: 0.75rem;
      font-weight: bold;
      margin-left: 8px;
      vertical-align: middle;
    }
    
    .admin-section {
      border-left: 4px solid #6a62d4;
      background-color: rgba(135, 127, 235, 0.1);
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 0 4px 4px 0;
    }
    
    .admin-section h5 {
      color: #6a62d4;
    }
    
    .stats-card {
      background: white;
      border-radius: 8px;
      padding: 15px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      margin-bottom: 15px;
      border-top: 3px solid #877feb;
    }
    
    .stats-card h6 {
      color: #6a62d4;
      font-size: 0.9rem;
      font-weight: 500;
    }
    
    .stats-card .number {
      font-size: 1.5rem;
      font-weight: bold;
      color: #877feb;
    }
    
    .backup-btn {
      background-color: #877feb;
      border-color: #6a62d4;
      color: white;
    }
    
    .backup-btn:hover {
      background-color: #6a62d4;
      border-color: #5a52c4;
    }
    
    .readonly-field {
      position: relative;
    }
    
    .readonly-field .input-group-text {
      background-color: #f8f9fa;
      border: 1px solid #ced4da;
    }
    
    .security-note {
      background-color: #fff3cd;
      border: 1px solid #ffeaa7;
      border-radius: 4px;
      padding: 10px;
      margin-top: 20px;
      font-size: 0.875rem;
    }
  </style>
</head>

<body class="contact-page">

<?php require_once __DIR__ . '/../Include/menuADM.php'; ?>


  <main class="main">
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(../assets/img/services.jpg);">
      <div class="container">
        <h1>Perfil Administrador</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li class="current">Gerencie a sua conta e os backups </li>
                    </ol>
                </nav>
      </div>
    </div><!-- End Page Title -->
    
    <!-- Profile Container -->
    <section class="profile-section">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="profile-card shadow-sm p-4 rounded">
              <div class="text-center mb-4">
                <!-- Foto de perfil circular -->
                <div class="position-relative d-inline-block">
                  <div class="profile-picture-circle" style="width: 150px; height: 150px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="rounded-circle img-fluid border">
                      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                      <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                  </div>
                </div>
                <h2 class="mt-3"><?php echo htmlspecialchars($usuario['nome_usuario']); ?> <span class="admin-badge">ADMIN</span></h2>
                <p class="text-muted">Administrador desde <?php echo $data_cadastro; ?></p>
              </div>
              
              <div class="admin-section">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h5><i class="bi bi-graph-up"></i> Estatísticas da Plataforma</h5>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="stats-card">
                      <h6>Usuários Registrados</h6>
                      <div class="number">1,248</div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="stats-card">
                      <h6>Posts no Fórum</h6>
                      <div class="number">3,756</div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="stats-card">
                      <h6>Oportunidades</h6>
                      <div class="number">142</div>
                    </div>
                  </div>
                </div>
                <div class="text-end small text-muted mt-2">
                  Última atualização: hoje às 14:30
                </div>
              </div>
              
              <form>
                <!-- Nome de Usuário (apenas leitura) -->
                <div class="mb-3">
                  <label for="username" class="form-label">Nome de Usuário</label>
                  <div class="input-group readonly-field">
                    <input type="text" class="form-control" id="username" value="<?php echo htmlspecialchars($usuario['nome_usuario']); ?>" readonly>
                    <span class="input-group-text">
                      <i class="bi bi-lock-fill text-muted" title="Nome de usuário não pode ser alterado"></i>
                    </span>
                  </div>
                  <div class="form-text text-muted">
                    <small>O nome de usuário do administrador não pode ser alterado por questões de segurança.</small>
                  </div>
                </div>
                
                <!-- Email (apenas leitura) -->
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <div class="input-group readonly-field">
                    <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" readonly>
                    <span class="input-group-text">
                      <i class="bi bi-lock-fill text-muted" title="Email não pode ser alterado"></i>
                    </span>
                  </div>
                  <div class="form-text text-muted">
                    <small>O email do administrador não pode ser alterado por questões de segurança.</small>
                  </div>
                </div>
                
                <!-- Senha (apenas visualização) -->
                <div class="mb-3">
                  <label for="password" class="form-label">Senha</label>
                  <div class="input-group readonly-field">
                    <input type="password" class="form-control" id="password" value="••••••••" readonly>
                    <span class="input-group-text">
                      <i class="bi bi-lock-fill text-muted" title="Senha não pode ser alterada por aqui"></i>
                    </span>
                  </div>
                  <div class="form-text text-muted">
                    <small>Para alterar a senha, entre em contato com o suporte técnico.</small>
                  </div>
                </div>

                <!-- Nota de segurança -->
                <div class="security-note">
                  <h6><i class="bi bi-shield-lock"></i> Nota de Segurança</h6>
                  <p class="mb-0">A conta de administrador possui configurações bloqueadas para garantir a segurança do sistema. Para alterar qualquer informação da conta administrativa, entre em contato com a equipe de suporte técnico.</p>
                </div>
          
                <!-- Botão de Logout -->
                  <div class="mt-4 text-start">
                    <a href="../login/logout.php" class="btn btn-danger btn-sm">
                      <i class="bi bi-box-arrow-right"></i> Sair da Conta
                    </a>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Profile Container -->
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
    require("../includeJS/scriptScr.php");
  ?>

  <!-- Admin Profile Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Função para mostrar mensagem
      function showMessage(message, isSuccess = true) {
        let messageDiv = document.getElementById('message-alert');
        if (!messageDiv) {
          messageDiv = document.createElement('div');
          messageDiv.id = 'message-alert';
          messageDiv.className = `alert ${isSuccess ? 'alert-success' : 'alert-danger'} alert-dismissible fade show`;
          messageDiv.style.position = 'fixed';
          messageDiv.style.top = '20px';
          messageDiv.style.right = '20px';
          messageDiv.style.zIndex = '9999';
          messageDiv.style.minWidth = '300px';
          messageDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          `;
          document.body.appendChild(messageDiv);
        } else {
          messageDiv.className = `alert ${isSuccess ? 'alert-success' : 'alert-danger'} alert-dismissible fade show`;
          messageDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          `;
        }
        
        setTimeout(() => {
          if (messageDiv && messageDiv.parentNode) {
            messageDiv.parentNode.removeChild(messageDiv);
          }
        }, 5000);
      }
    });
  </script>
</body>
</html>