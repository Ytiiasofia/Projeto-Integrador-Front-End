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
                <h2 class="mt-3" id="profile-name"><?php echo htmlspecialchars($usuario['nome_usuario']); ?> <span class="admin-badge">ADMIN</span></h2>
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
                
                <!-- Senha (com opção de alteração) -->
                <div class="mb-3">
                  <label for="password" class="form-label">Senha</label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="password" value="********" readonly>
                    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#editPasswordModal">
                      <i class="bi bi-pencil-fill"></i>
                    </button>
                  </div>
                  <div class="form-text text-muted">
                    <small>Clique no ícone para alterar sua senha.</small>
                  </div>
                </div>

                <!-- Nota de segurança -->
                <div class="security-note">
                  <h6><i class="bi bi-shield-lock"></i> Nota de Segurança</h6>
                  <p class="mb-0">A conta de administrador possui algumas configurações bloqueadas para garantir a segurança do sistema. Você pode alterar sua foto de perfil e senha.</p>
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

      // Upload e preview de foto
      const photoUpload = document.getElementById('photoUpload');
      const currentPhotoPreview = document.getElementById('currentPhotoPreview');
      const savePhotoBtn = document.getElementById('savePhotoBtn');

      if (photoUpload) {
          photoUpload.addEventListener('change', function(e) {
              const file = e.target.files[0];
              const feedback = document.getElementById('photoFeedback');
              
              if (file) {
                  // Validar tipo de arquivo
                  const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                  if (!validTypes.includes(file.type)) {
                      feedback.textContent = 'Formato de arquivo inválido. Use JPG, PNG ou GIF.';
                      feedback.style.color = 'red';
                      savePhotoBtn.disabled = true;
                      return;
                  }
                  
                  // Validar tamanho do arquivo (2MB)
                  if (file.size > 2 * 1024 * 1024) {
                      feedback.textContent = 'Arquivo muito grande. Máximo 2MB.';
                      feedback.style.color = 'red';
                      savePhotoBtn.disabled = true;
                      return;
                  }
                  
                  feedback.textContent = 'Arquivo válido';
                  feedback.style.color = 'green';
                  savePhotoBtn.disabled = false;
                  
                  // Preview da imagem
                  const reader = new FileReader();
                  reader.onload = function(e) {
                      currentPhotoPreview.src = e.target.result;
                  }
                  reader.readAsDataURL(file);
              }
          });
      }

      // Salvar foto
      if (savePhotoBtn) {
          savePhotoBtn.addEventListener('click', function() {
              const fileInput = document.getElementById('photoUpload');
              const file = fileInput.files[0];
              
              if (!file) {
                  showMessage('Selecione uma imagem para upload', false);
                  return;
              }
              
              const formData = new FormData();
              formData.append('action', 'update_photo');
              formData.append('foto_perfil', file);
              
              fetch('../UserCadastrado/atualizar_perfil.php', {
                  method: 'POST',
                  body: formData
              })
              .then(response => response.json())
              .then(data => {
                  if (data.success) {
                      // Atualizar a foto na página
                      document.getElementById('currentProfilePhoto').src = data.foto_url + '?t=' + new Date().getTime();
                      bootstrap.Modal.getInstance(document.getElementById('editPhotoModal')).hide();
                      showMessage(data.message, true);
                      
                      // Resetar o formulário
                      document.getElementById('photoUploadForm').reset();
                      document.getElementById('photoFeedback').textContent = '';
                  } else {
                      showMessage(data.message, false);
                  }
              })
              .catch(error => {
                  console.error('Error:', error);
                  showMessage('Erro ao fazer upload da foto', false);
              });
          });
      }

      // Limpar feedback quando modal de foto é fechado
      const editPhotoModal = document.getElementById('editPhotoModal');
      if (editPhotoModal) {
          editPhotoModal.addEventListener('hidden.bs.modal', function() {
              document.getElementById('photoUploadForm').reset();
              document.getElementById('photoFeedback').textContent = '';
              savePhotoBtn.disabled = false;
              
              // Restaurar preview original
              const currentProfilePhoto = document.getElementById('currentProfilePhoto').src;
              document.getElementById('currentPhotoPreview').src = currentProfilePhoto;
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
          
          fetch('../UserCadastrado/atualizar_perfil.php', {
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

      // Limpar feedback quando modal de senha é fechado
      const editPasswordModal = document.getElementById('editPasswordModal');
      if (editPasswordModal) {
        editPasswordModal.addEventListener('hidden.bs.modal', function() {
          // Limpar campos de senha
          document.getElementById('currentPassword').value = '';
          document.getElementById('newPassword').value = '';
          document.getElementById('confirmPassword').value = '';
          if (passwordFeedback) passwordFeedback.textContent = '';
          if (confirmFeedback) confirmFeedback.textContent = '';
        });
      }
    });
  </script>
</body>
</html>