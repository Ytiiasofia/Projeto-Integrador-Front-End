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
  </style>
</head>

<body class="contact-page">

  <!-- Header -->
  <?php
    require("../Include/menuADM.php");
  ?>

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
                    <img src="https://via.placeholder.com/150" class="rounded-circle img-fluid border" style="width: 100%; height: 100%; object-fit: cover;">
                  </div>
                  <button class="btn btn-light rounded-circle position-absolute bottom-0 end-0" 
                          style="width: 36px; height: 36px;"
                          data-bs-toggle="modal" data-bs-target="#editPhotoModal">
                    <i class="bi bi-pencil-fill"></i>
                  </button>
                </div>
                <h2 class="mt-3">Admin She Innovates <span class="admin-badge">ADMIN</span></h2>
                <p class="text-muted">Administrador desde Janeiro 2022</p>
              </div>
              
              <div class="admin-section">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h5><i class="bi bi-graph-up"></i> Estatísticas da Plataforma</h5>
                  <button class="btn btn-sm backup-btn" id="backupBtn">
                    <i class="bi bi-database"></i> Fazer Backup
                  </button>
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
                <!-- Email -->
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <div class="input-group">
                    <input type="email" class="form-control" id="email" value="admin@sheinnovates.com" readonly>
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
                
                <!-- Biografia -->
                <div class="mb-3">
                  <label for="bio" class="form-label">Biografia</label>
                  <div class="input-group">
                    <textarea class="form-control" id="bio" rows="3" readonly>Administrador da plataforma She Innovates. Responsável pela moderação de conteúdo, gerenciamento de usuários e manutenção da plataforma.</textarea>
                    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#editBioModal">
                      <i class="bi bi-pencil-fill"></i>
                    </button>
                  </div>
                </div>

                <!-- Botão de Logout -->
                <div class="d-flex justify-content-end mt-4">
                  <button class="btn btn-danger" type="button" id="logoutBtn">
                    <i class="bi bi-box-arrow-right"></i> Sair da Conta
                  </button>
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
            <input type="text" class="form-control" id="newUsername" value="admin_sheinnovates">
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
            <input type="email" class="form-control" id="newEmail" value="admin@sheinnovates.com">
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
            <div class="form-text">A senha deve conter pelo menos 12 caracteres, incluindo números, letras e caracteres especiais</div>
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

  <!-- Modal para edição de biografia -->
  <div class="modal fade" id="editBioModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Alterar Biografia</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="newBio" class="form-label">Biografia</label>
            <textarea class="form-control" id="newBio" rows="4">Administrador da plataforma She Innovates. Responsável pela moderação de conteúdo, gerenciamento de usuários e manutenção da plataforma.</textarea>
            <div class="form-text">Máximo de 500 caracteres</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="saveBioBtn">Salvar Alterações</button>
        </div>
      </div>
    </div>
  </div>

<footer id="footer" class="footer light-background">
  <?php
    require("../Include/footerUserAnom.php");
  ?>
</footer>

  <?php
    require("../Include/preloaderAndScrollTop.php");
  ?>

  <?php
    require("../Include/scriptScr.php");
  ?>

  <!-- Admin Profile Script -->
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
            profileName.textContent = newUsername + ' <span class="admin-badge">ADMIN</span>';
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
      
      // Biografia
      const saveBioBtn = document.getElementById('saveBioBtn');
      if (saveBioBtn) {
        saveBioBtn.addEventListener('click', function() {
          const newBio = document.getElementById('newBio').value;
          document.getElementById('bio').value = newBio;
          bootstrap.Modal.getInstance(document.getElementById('editBioModal')).hide();
        });
      }

      // Validação de senha em tempo real - Versão mais rigorosa para admin
      const newPasswordInput = document.getElementById('newPassword');
      if (newPasswordInput) {
        newPasswordInput.addEventListener('input', function() {
          const password = this.value;
          const feedback = this.nextElementSibling;
          
          if (password.length < 12) {
            feedback.textContent = 'A senha deve ter pelo menos 12 caracteres';
            feedback.style.color = 'red';
          } else if (!/\d/.test(password)) {
            feedback.textContent = 'A senha deve conter números';
            feedback.style.color = 'red';
          } else if (!/[a-zA-Z]/.test(password)) {
            feedback.textContent = 'A senha deve conter letras';
            feedback.style.color = 'red';
          } else if (!/[^a-zA-Z0-9]/.test(password)) {
            feedback.textContent = 'A senha deve conter caracteres especiais';
            feedback.style.color = 'red';
          } else {
            feedback.textContent = 'Senha forte';
            feedback.style.color = 'green';
          }
        });
      }

      // Logout
      const logoutBtn = document.getElementById('logoutBtn');
      if (logoutBtn) {
        logoutBtn.addEventListener('click', function() {
          if (confirm('Tem certeza que deseja sair da sua conta de administrador?')) {
            window.location.href = 'index.php'; 
          }
        });
      }
      
      // Botão de Backup
      const backupBtn = document.getElementById('backupBtn');
      if (backupBtn) {
        backupBtn.addEventListener('click', function() {
          this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Fazendo backup...';
          this.disabled = true;
          
          // Simulação de backup
          setTimeout(() => {
            const toastHTML = `
              <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="backupToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header bg-success text-white">
                    <strong class="me-auto"><i class="bi bi-check-circle-fill"></i> Backup concluído</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Backup do sistema realizado com sucesso em 19/07/2023 às ${new Date().toLocaleTimeString()}.
                  </div>
                </div>
              </div>
            `;
            
            document.body.insertAdjacentHTML('beforeend', toastHTML);
            
            setTimeout(() => {
              const toast = document.getElementById('backupToast');
              if (toast) toast.remove();
            }, 5000);
            
            this.innerHTML = '<i class="bi bi-database"></i> Fazer Backup';
            this.disabled = false;
          }, 2000);
        });
      }
    });
  </script>
</body>
</html>