<?php
session_start();
require("../Include/conexao.php");
require("../includePerfil/dadosUsuario.php");

// Consultas para obter estatísticas reais
$estatisticas = [];

try {
    // Verificar se a conexão existe - usar $con em vez de $conn
    if (!isset($con) || $con === null) {
        throw new Exception("Conexão com o banco de dados não estabelecida");
    }

    // Contar usuários registrados - tabela: usuarios
    $query_usuarios = "SELECT COUNT(*) as total_usuarios FROM usuarios";
    $result_usuarios = $con->query($query_usuarios);
    if ($result_usuarios) {
        $estatisticas['total_usuarios'] = $result_usuarios->fetch_assoc()['total_usuarios'];
    } else {
        $estatisticas['total_usuarios'] = 0;
    }

    // Contar posts no fórum - tabela: forum_posts
    $query_posts = "SELECT COUNT(*) as total_posts FROM forum_posts";
    $result_posts = $con->query($query_posts);
    if ($result_posts) {
        $estatisticas['total_posts'] = $result_posts->fetch_assoc()['total_posts'];
    } else {
        $estatisticas['total_posts'] = 0;
    }

    // Contar oportunidades - tabela: oportunidades
    $query_oportunidades = "SELECT COUNT(*) as total_oportunidades FROM oportunidades";
    $result_oportunidades = $con->query($query_oportunidades);
    if ($result_oportunidades) {
        $estatisticas['total_oportunidades'] = $result_oportunidades->fetch_assoc()['total_oportunidades'];
    } else {
        $estatisticas['total_oportunidades'] = 0;
    }

    // Data e hora da última atualização
    $estatisticas['ultima_atualizacao'] = date('d/m/Y \à\s H:i');

} catch (Exception $e) {
    // Em caso de erro, definir valores padrão
    $estatisticas['total_usuarios'] = 0;
    $estatisticas['total_posts'] = 0;
    $estatisticas['total_oportunidades'] = 0;
    $estatisticas['ultima_atualizacao'] = 'Erro ao carregar';
    error_log("Erro ao carregar estatísticas: " . $e->getMessage());
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
    
    .bi-arrow-clockwise.spin {
      animation: spin 1s linear infinite;
    }
    @keyframes spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }
    
    .error-stats {
      background-color: #f8d7da;
      border: 1px solid #f5c6cb;
      border-radius: 4px;
      padding: 10px;
      margin-bottom: 15px;
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
                  <button class="btn btn-sm btn-outline-primary" onclick="atualizarEstatisticas()">
                    <i class="bi bi-arrow-clockwise"></i> Atualizar
                  </button>
                </div>
                
                <?php if ($estatisticas['total_usuarios'] === 0 && $estatisticas['total_posts'] === 0 && $estatisticas['total_oportunidades'] === 0): ?>
                <div class="error-stats">
                  <i class="bi bi-exclamation-triangle"></i> 
                  Erro ao carregar estatísticas. Verifique os nomes das tabelas no banco de dados.
                </div>
                <?php endif; ?>
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="stats-card">
                      <h6>Usuários Registrados</h6>
                      <div class="number" id="stat-usuarios"><?php echo $estatisticas['total_usuarios']; ?></div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="stats-card">
                      <h6>Posts no Fórum</h6>
                      <div class="number" id="stat-posts"><?php echo $estatisticas['total_posts']; ?></div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="stats-card">
                      <h6>Oportunidades</h6>
                      <div class="number" id="stat-oportunidades"><?php echo $estatisticas['total_oportunidades']; ?></div>
                    </div>
                  </div>
                </div>
                <div class="text-end small text-muted mt-2">
                  Última atualização: <span id="stat-atualizacao"><?php echo $estatisticas['ultima_atualizacao']; ?></span>
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
<script src="../includeJsPerfil/codigosComuns.js"></script>
<script src="../includeJsPerfil/codigosExclusivoAdm.js"></script>
</body>
</html>