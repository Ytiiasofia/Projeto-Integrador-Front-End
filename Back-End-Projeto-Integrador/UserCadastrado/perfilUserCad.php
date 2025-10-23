<?php
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
    $data_cadastro = date('F Y', strtotime($usuario['data_cadastro']));
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
                <h2 class="mt-3" id="profile-name"><?php echo htmlspecialchars($usuario['nome_usuario']); ?></h2>
                <p class="text-muted">Membro desde <?php echo $data_cadastro; ?></p>
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
            <div id="usernameFeedback" class="form-text"></div>
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
            <div id="emailFeedback" class="form-text"></div>
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
            <div id="passwordFeedback" class="form-text"></div>
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirme a nova senha</label>
            <input type="password" class="form-control" id="confirmPassword">
            <div id="confirmFeedback" class="form-text"></div>
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
      // Função para mostrar mensagem
      function showMessage(message, isSuccess = true) {
        // Criar ou atualizar elemento de mensagem
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
        
        // Auto-remover após 5 segundos
        setTimeout(() => {
          if (messageDiv && messageDiv.parentNode) {
            messageDiv.parentNode.removeChild(messageDiv);
          }
        }, 5000);
      }

      // Validação de nome de usuário em tempo real
      const newUsernameInput = document.getElementById('newUsername');
      const usernameFeedback = document.getElementById('usernameFeedback');
      
      if (newUsernameInput) {
        newUsernameInput.addEventListener('input', function() {
          const username = this.value.trim();
          
          if (username.length < 3) {
            usernameFeedback.textContent = 'Nome muito curto (mínimo 3 caracteres)';
            usernameFeedback.style.color = 'red';
          } else if (username.length > 20) {
            usernameFeedback.textContent = 'Nome muito longo (máximo 20 caracteres)';
            usernameFeedback.style.color = 'red';
          } else if (!/^[a-zA-Z0-9_]+$/.test(username)) {
            usernameFeedback.textContent = 'Use apenas letras, números e underline';
            usernameFeedback.style.color = 'red';
          } else {
            usernameFeedback.textContent = 'Nome válido';
            usernameFeedback.style.color = 'green';
          }
        });
      }

      // Validação de email em tempo real
      const newEmailInput = document.getElementById('newEmail');
      const emailFeedback = document.getElementById('emailFeedback');
      
      if (newEmailInput) {
        newEmailInput.addEventListener('input', function() {
          const email = this.value.trim();
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          
          if (!emailRegex.test(email)) {
            emailFeedback.textContent = 'Email inválido';
            emailFeedback.style.color = 'red';
          } else {
            emailFeedback.textContent = 'Email válido';
            emailFeedback.style.color = 'green';
          }
        });
      }

      // Validação de senha em tempo real
      const newPasswordInput = document.getElementById('newPassword');
      const passwordFeedback = document.getElementById('passwordFeedback');
      const confirmPasswordInput = document.getElementById('confirmPassword');
      const confirmFeedback = document.getElementById('confirmFeedback');
      
      if (newPasswordInput) {
        newPasswordInput.addEventListener('input', function() {
          const password = this.value;
          
          if (password.length < 8) {
            passwordFeedback.textContent = 'A senha deve ter pelo menos 8 caracteres';
            passwordFeedback.style.color = 'red';
          } else if (!/\d/.test(password) || !/[a-zA-Z]/.test(password)) {
            passwordFeedback.textContent = 'A senha deve conter letras e números';
            passwordFeedback.style.color = 'red';
          } else {
            passwordFeedback.textContent = 'Senha válida';
            passwordFeedback.style.color = 'green';
          }
          
          // Verificar confirmação
          if (confirmPasswordInput.value) {
            if (password !== confirmPasswordInput.value) {
              confirmFeedback.textContent = 'As senhas não coincidem';
              confirmFeedback.style.color = 'red';
            } else {
              confirmFeedback.textContent = 'Senhas coincidem';
              confirmFeedback.style.color = 'green';
            }
          }
        });
      }
      
      if (confirmPasswordInput) {
        confirmPasswordInput.addEventListener('input', function() {
          const confirmPassword = this.value;
          const password = newPasswordInput.value;
          
          if (password !== confirmPassword) {
            confirmFeedback.textContent = 'As senhas não coincidem';
            confirmFeedback.style.color = 'red';
          } else {
            confirmFeedback.textContent = 'Senhas coincidem';
            confirmFeedback.style.color = 'green';
          }
        });
      }

      // Nome de usuário - Salvar
      const saveUsernameBtn = document.getElementById('saveUsernameBtn');
      if (saveUsernameBtn) {
        saveUsernameBtn.addEventListener('click', function() {
          const newUsername = document.getElementById('newUsername').value.trim();
          
          if (newUsername.length < 3 || newUsername.length > 20) {
            showMessage('Nome de usuário deve ter entre 3 e 20 caracteres', false);
            return;
          }
          
          if (!/^[a-zA-Z0-9_]+$/.test(newUsername)) {
            showMessage('Use apenas letras, números e underline no nome de usuário', false);
            return;
          }
          
          // Enviar para o servidor
          const formData = new FormData();
          formData.append('action', 'update_username');
          formData.append('novo_username', newUsername);
          
          fetch('atualizar_perfil.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              document.getElementById('username').value = newUsername;
              document.getElementById('profile-name').textContent = newUsername;
              bootstrap.Modal.getInstance(document.getElementById('editUsernameModal')).hide();
              showMessage(data.message, true);
            } else {
              showMessage(data.message, false);
            }
          })
          .catch(error => {
            console.error('Error:', error);
            showMessage('Erro ao atualizar nome de usuário', false);
          });
        });
      }

      // Email - Salvar
      const saveEmailBtn = document.getElementById('saveEmailBtn');
      if (saveEmailBtn) {
        saveEmailBtn.addEventListener('click', function() {
          const newEmail = document.getElementById('newEmail').value.trim();
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          
          if (!emailRegex.test(newEmail)) {
            showMessage('Email inválido', false);
            return;
          }
          
          // Enviar para o servidor
          const formData = new FormData();
          formData.append('action', 'update_email');
          formData.append('novo_email', newEmail);
          
          fetch('atualizar_perfil.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              document.getElementById('email').value = newEmail;
              bootstrap.Modal.getInstance(document.getElementById('editEmailModal')).hide();
              showMessage(data.message, true);
            } else {
              showMessage(data.message, false);
            }
          })
          .catch(error => {
            console.error('Error:', error);
            showMessage('Erro ao atualizar email', false);
          });
        });
      }

      // Senha - Salvar
      const savePasswordBtn = document.getElementById('savePasswordBtn');
      if (savePasswordBtn) {
        savePasswordBtn.addEventListener('click', function() {
          const currentPassword = document.getElementById('currentPassword').value;
          const newPassword = document.getElementById('newPassword').value;
          const confirmPassword = document.getElementById('confirmPassword').value;
          
          if (!currentPassword || !newPassword || !confirmPassword) {
            showMessage('Todos os campos são obrigatórios', false);
            return;
          }
          
          if (newPassword !== confirmPassword) {
            showMessage('As senhas não coincidem', false);
            return;
          }
          
          if (newPassword.length < 8) {
            showMessage('A senha deve ter pelo menos 8 caracteres', false);
            return;
          }
          
          if (!/\d/.test(newPassword) || !/[a-zA-Z]/.test(newPassword)) {
            showMessage('A senha deve conter letras e números', false);
            return;
          }
          
          // Enviar para o servidor
          const formData = new FormData();
          formData.append('action', 'update_password');
          formData.append('senha_atual', currentPassword);
          formData.append('nova_senha', newPassword);
          formData.append('confirmar_senha', confirmPassword);
          
          fetch('atualizar_perfil.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              // Limpar campos
              document.getElementById('currentPassword').value = '';
              document.getElementById('newPassword').value = '';
              document.getElementById('confirmPassword').value = '';
              
              bootstrap.Modal.getInstance(document.getElementById('editPasswordModal')).hide();
              showMessage(data.message, true);
            } else {
              showMessage(data.message, false);
            }
          })
          .catch(error => {
            console.error('Error:', error);
            showMessage('Erro ao atualizar senha', false);
          });
        });
      }

      // Limpar feedback quando modais são fechados
      const modals = ['editUsernameModal', 'editEmailModal', 'editPasswordModal'];
      modals.forEach(modalId => {
        const modal = document.getElementById(modalId);
        if (modal) {
          modal.addEventListener('hidden.bs.modal', function() {
            // Limpar mensagens de feedback
            const feedbacks = this.querySelectorAll('.form-text');
            feedbacks.forEach(feedback => {
              if (feedback.id !== 'usernameFeedback' && feedback.id !== 'emailFeedback' && 
                  feedback.id !== 'passwordFeedback' && feedback.id !== 'confirmFeedback') {
                feedback.textContent = '';
              }
            });
            
            // Limpar campos de senha
            if (modalId === 'editPasswordModal') {
              document.getElementById('currentPassword').value = '';
              document.getElementById('newPassword').value = '';
              document.getElementById('confirmPassword').value = '';
              if (passwordFeedback) passwordFeedback.textContent = '';
              if (confirmFeedback) confirmFeedback.textContent = '';
            }
          });
        }
      });
    });
  </script>
</body>
</html>