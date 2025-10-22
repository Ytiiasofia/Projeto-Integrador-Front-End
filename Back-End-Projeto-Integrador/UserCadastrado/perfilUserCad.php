<?php
// ESTE DEVE SER O PRIMEIRO ARQUIVO DO SEU CÓDIGO - SEM ESPAÇOS ANTES
session_start();
require("../Include/conexao.php");

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login/login.php");
    exit();
}

// Buscar dados do usuário
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
    // Converter a data do banco para formato em português
    $data_cadastro = date('F Y', strtotime($usuario['data_cadastro']));
    
    // Traduzir o mês para português
    $meses_ingles = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $meses_portugues = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
    $data_cadastro = str_replace($meses_ingles, $meses_portugues, $data_cadastro);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Perfil - She Innovates</title>
  <meta name="description" content="Página de perfil do usuário">
  <meta name="keywords" content="perfil, usuário, configurações">

  <?php
  require("../Include/hrefCssHead.php");
  ?>
</head>

<body class="contact-page">

<?php 
require_once __DIR__ . '/../Include/menuADM.php';
?>

  <main class="main">
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(../assets/img/services.jpg);">
      <div class="container">
        <h1>Perfil</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="inicioUserCad.html">Início</a></li>
            <li class="current">Perfil</li>
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
                <!-- Foto de perfil circular com botão de edição -->
                <div class="position-relative d-inline-block">
                <div class="profile-picture-circle" style="width: 150px; height: 150px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="rounded-circle img-fluid border">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <button class="btn btn-light rounded-circle position-absolute bottom-0 end-0" 
                        style="width: 36px; height: 36px;"
                        data-bs-toggle="modal" data-bs-target="#editPhotoModal">
                    <i class="bi bi-pencil-fill"></i>
                </button>
                </div>
                <h2 class="mt-3"><?php echo htmlspecialchars($usuario['nome_usuario']); ?></h2>
                <p class="text-muted">Membro desde <?php echo $data_cadastro; ?></p>
                <?php if ($usuario['is_admin'] == 1): ?>
                    <span class="badge bg-primary">Administrador</span>
                <?php endif; ?>
            </div>
              
              <form>
                <!-- Nome de Usuário -->
                <div class="mb-3">
                  <label for="username" class="form-label">Nome de Usuário</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="username" value="<?php echo htmlspecialchars($usuario['nome_usuario']); ?>" readonly>
                    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#editUsernameModal">
                      <i class="bi bi-pencil-fill"></i>
                    </button>
                  </div>
                </div>
                
                <!-- Email -->
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <div class="input-group">
                    <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" readonly>
                    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#editEmailModal">
                      <i class="bi bi-pencil-fill"></i>
                    </button>
                  </div>
                </div>
                
                <!-- Senha -->
                <div class="mb-3">
                  <label for="password" class="form-label">Senha</label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="password" value="********" readonly>
                    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#editPasswordModal">
                      <i class="bi bi-pencil-fill"></i>
                    </button>
                  </div>
                </div>
          
                <!-- Botão Sair da Conta -->
                  <div class="mt-4 text-start">
                    <a href="../login/logout.php" class="btn btn-danger btn-sm">
                      <i class="bi bi-box-arrow-right"></i> Sair da Conta
                    </a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Profile Container -->
  </main>

  <!-- Modals Section -->
  <!-- Modal para edição da foto -->
  <div class="modal fade" id="editPhotoModal" tabindex="-1" aria-labelledby="editPhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editPhotoModalLabel">Alterar Foto de Perfil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="text-center mb-3">
            <img id="currentPhoto" src="https://via.placeholder.com/150" 
                 class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
          </div>
          <div class="mb-3">
            <label for="photoUpload" class="form-label">Faça upload</label>
            <input class="form-control" type="file" id="photoUpload" accept="image/*">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="savePhotoBtn">Salvar Alterações</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para edição do nome de usuário -->
  <div class="modal fade" id="editUsernameModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Alterar Nome de Usuário</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="newUsername" class="form-label">Novo nome de usuário</label>
            <input type="text" class="form-control" id="newUsername" value="<?php echo htmlspecialchars($usuario['nome_usuario']); ?>">
            <div class="form-text">O nome de usuário deve conter entre 3-20 caracteres</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="saveUsernameBtn">Salvar Alterações</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para edição de email -->
  <div class="modal fade" id="editEmailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Alterar Email</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="newEmail" class="form-label">Novo email</label>
            <input type="email" class="form-control" id="newEmail" value="<?php echo htmlspecialchars($usuario['email']); ?>">
            <div class="form-text">Digite um email válido</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="saveEmailBtn">Salvar Alterações</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para edição de senha -->
  <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Alterar Senha</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="currentPassword" class="form-label">Senha atual</label>
            <input type="password" class="form-control" id="currentPassword">
          </div>
          <div class="mb-3">
            <label for="newPassword" class="form-label">Nova senha</label>
            <input type="password" class="form-control" id="newPassword">
            <div class="form-text">A senha deve conter pelo menos 8 caracteres, incluindo números e letras</div>
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirme a nova senha</label>
            <input type="password" class="form-control" id="confirmPassword">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="savePasswordBtn">Salvar Alterações</button>
        </div>
      </div>
    </div>
  </div>

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

  <!-- Profile Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Nome de usuário
      const saveUsernameBtn = document.getElementById('saveUsernameBtn');
      if (saveUsernameBtn) {
        saveUsernameBtn.addEventListener('click', function() {
          const newUsername = document.getElementById('newUsername').value;
          document.getElementById('username').value = newUsername;
          
          // Atualiza o nome abaixo da foto
          const profileName = document.querySelector('.profile-card h2');
          if (profileName) {
            profileName.textContent = newUsername;
          }
          
          bootstrap.Modal.getInstance(document.getElementById('editUsernameModal')).hide();
        });
      }

      // Email
      const saveEmailBtn = document.getElementById('saveEmailBtn');
      if (saveEmailBtn) {
        saveEmailBtn.addEventListener('click', function() {
          const newEmail = document.getElementById('newEmail').value;
          document.getElementById('email').value = newEmail;
          bootstrap.Modal.getInstance(document.getElementById('editEmailModal')).hide();
        });
      }

      // Senha
      const savePasswordBtn = document.getElementById('savePasswordBtn');
      if (savePasswordBtn) {
        savePasswordBtn.addEventListener('click', function() {
          const newPassword = document.getElementById('newPassword').value;
          const confirmPassword = document.getElementById('confirmPassword').value;
          
          if (newPassword === confirmPassword) {
            document.getElementById('password').value = '********'; // Apenas para demonstração
            bootstrap.Modal.getInstance(document.getElementById('editPasswordModal')).hide();
          } else {
            alert('As senhas não coincidem!');
          }
        });
      }

      // Validação de senha em tempo real
      const newPasswordInput = document.getElementById('newPassword');
      if (newPasswordInput) {
        newPasswordInput.addEventListener('input', function() {
          const password = this.value;
          const feedback = this.nextElementSibling;
          
          if (password.length < 8) {
            feedback.textContent = 'A senha deve ter pelo menos 8 caracteres';
            feedback.style.color = 'red';
          } else if (!/\d/.test(password) || !/[a-zA-Z]/.test(password)) {
            feedback.textContent = 'A senha deve conter letras e números';
            feedback.style.color = 'red';
          } else {
            feedback.textContent = 'Senha válida';
            feedback.style.color = 'green';
          }
        });
      }
    });
  </script>
</body>
</html>