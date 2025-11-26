<?php
session_start();
require("../Include/conexao.php");
require("../includePerfil/dadosUsuario.php");
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
                    <img id="currentProfilePhoto" src="<?php echo $foto_url; ?>" 
                         class="rounded-circle img-fluid border" 
                         style="width: 150px; height: 150px; object-fit: cover;"
                         alt="Foto de perfil de <?php echo htmlspecialchars($usuario['nome_usuario']); ?>"
                         onerror="this.src='../assets/img/avatar-placeholder.png'">
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
            <img id="currentPhotoPreview" src="<?php echo $foto_url; ?>" 
                 class="rounded-circle mb-3" 
                 style="width: 120px; height: 120px; object-fit: cover;"
                 onerror="this.src='../assets/img/avatar-placeholder.png'">
          </div>
          <form id="photoUploadForm" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="photoUpload" class="form-label">Selecione uma imagem</label>
              <input class="form-control" type="file" id="photoUpload" name="foto_perfil" accept="image/jpeg,image/png,image/jpg,image/gif" required>
              <div class="form-text">Formatos permitidos: JPG, PNG, GIF. Tamanho máximo: 2MB</div>
              <div id="photoFeedback" class="form-text"></div>
            </div>
          </form>
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
    require("../includeJS/scriptScr.php");
  ?>

  <!-- Incluir apenas o código comum para usuários -->
  <script src="../includeJsPerfil/codigosComuns.js"></script>

  <!-- Script específico para usuário comum (apenas as funcionalidades que não estão no comum) -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Validação de nome de usuário em tempo real (específico do usuário comum)
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

      // Validação de email em tempo real (específico do usuário comum)
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

      // Nome de usuário - Salvar (específico do usuário comum)
      const saveUsernameBtn = document.getElementById('saveUsernameBtn');
      if (saveUsernameBtn) {
        saveUsernameBtn.addEventListener('click', function() {
          const newUsername = document.getElementById('newUsername').value.trim();
          
          if (newUsername.length < 3 || newUsername.length > 20) {
            if (window.profileManager) {
              window.profileManager.showMessage('Nome de usuário deve ter entre 3 e 20 caracteres', false);
            }
            return;
          }
          
          if (!/^[a-zA-Z0-9_]+$/.test(newUsername)) {
            if (window.profileManager) {
              window.profileManager.showMessage('Use apenas letras, números e underline no nome de usuário', false);
            }
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
              if (window.profileManager) {
                window.profileManager.showMessage(data.message, true);
              }
            } else {
              if (window.profileManager) {
                window.profileManager.showMessage(data.message, false);
              }
            }
          })
          .catch(error => {
            console.error('Error:', error);
            if (window.profileManager) {
              window.profileManager.showMessage('Erro ao atualizar nome de usuário', false);
            }
          });
        });
      }

      // Email - Salvar (específico do usuário comum)
      const saveEmailBtn = document.getElementById('saveEmailBtn');
      if (saveEmailBtn) {
        saveEmailBtn.addEventListener('click', function() {
          const newEmail = document.getElementById('newEmail').value.trim();
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          
          if (!emailRegex.test(newEmail)) {
            if (window.profileManager) {
              window.profileManager.showMessage('Email inválido', false);
            }
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
              if (window.profileManager) {
                window.profileManager.showMessage(data.message, true);
              }
            } else {
              if (window.profileManager) {
                window.profileManager.showMessage(data.message, false);
              }
            }
          })
          .catch(error => {
            console.error('Error:', error);
            if (window.profileManager) {
              window.profileManager.showMessage('Erro ao atualizar email', false);
            }
          });
        });
      }

      // Limpar feedback quando modais são fechados (apenas os específicos do usuário)
      const modals = ['editUsernameModal', 'editEmailModal'];
      modals.forEach(modalId => {
        const modal = document.getElementById(modalId);
        if (modal) {
          modal.addEventListener('hidden.bs.modal', function() {
            // Limpar mensagens de feedback específicas
            const feedbacks = this.querySelectorAll('.form-text');
            feedbacks.forEach(feedback => {
              if (feedback.id === 'usernameFeedback' || feedback.id === 'emailFeedback') {
                feedback.textContent = '';
              }
            });
          });
        }
      });
    });
  </script>
</body>
</html>