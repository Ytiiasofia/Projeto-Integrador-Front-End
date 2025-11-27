<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Gerenciamento de Usuários</title>

  <?php require("../Include/hrefCssHead.php"); ?>

  <style>
    .user-table { border-radius: 10px; overflow: hidden; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
    .user-table thead { background-color: #6c63ff; color: white; }
    .user-table th { padding: 15px; font-weight: 600; }
    .user-table td { padding: 12px 15px; vertical-align: middle; }
    .user-table tbody tr { transition: all 0.3s ease; }
    .user-table tbody tr:hover { background-color: #6c63ff; transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.05); }
    .badge-user { background-color: #6c63ff; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 500; }
    .badge-admin { background-color: #28a745; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 500; }
    .action-btn { padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; transition: all 0.3s ease; }
    .action-btn:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    .section-header h2 { color: #6c63ff; font-weight: 700; margin-bottom: 15px; }
    .section-header p { color: #6c757d; font-size: 1.1rem; }
  </style>
</head>

<body class="contact-page">

<!-- Menu -->
<?php require_once __DIR__ . '/../Include/menuADM.php'; ?>
<!-- Fim do Menu -->

<main class="main">

  <!-- Título -->
  <div class="page-title dark-background" data-aos="fade" style="background-image: url(../assets/img/contact-page-title-bg.jpg);">
    <div class="container">
      <h1>Gerenciamento de Usuários</h1>
      <nav class="breadcrumbs">
        <ol>
          <li class="current">Administre as contas de usuários do sistema</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- Fim do Título -->

  <!-- Seção de Gerenciamento de Usuários -->
  <section id="user-management" class="user-management section">
    <div class="container" data-aos="fade-up">
      <div class="table-responsive">
        <table class="table table-hover user-table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nome</th>
              <th scope="col">E-mail</th>
              <th scope="col">Tipo</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
<?php
require("../Include/conexao.php");

// Busca os usuários
$sql = "SELECT usuario_id, nome_usuario, email, is_admin FROM usuarios ORDER BY nome_usuario ASC";
$resultado = mysqli_query($con, $sql);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $id = (int)$linha['usuario_id'];
        $nome = htmlspecialchars($linha['nome_usuario'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($linha['email'], ENT_QUOTES, 'UTF-8');
        $is_admin = (int)$linha['is_admin'] === 1;

        echo "<tr>";
        echo "<th scope='row'>{$id}</th>";
        echo "<td>{$nome}</td>";
        echo "<td>{$email}</td>";
        echo "<td>" . ($is_admin ? "<span class='badge-admin'>Administrador</span>" : "<span class='badge-user'>Usuário</span>") . "</td>";

        if ($is_admin) {
            echo "<td><button class='btn btn-sm btn-secondary action-btn' disabled><i class='bi bi-shield-lock'></i> Protegido</button></td>";
        } else {
            echo "<td>
                    <button class='btn btn-sm btn-danger action-btn delete-user' data-user-id='{$id}' data-user-name='{$nome}'>
                      <i class='bi bi-trash'></i> Excluir
                    </button>
                  </td>";
        }

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5' class='text-center'>Nenhum usuário encontrado.</td></tr>";
}

mysqli_close($con);
?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <!-- Fim da seção de Gerenciamento de Usuários -->

  <!-- Modal de Exclusão -->
  <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar Exclusão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Tem certeza que deseja excluir <strong id="userToDeleteName"></strong>?</p>
        <p class="text-danger"><i class="bi bi-exclamation-triangle-fill"></i> Esta ação é irreversível.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form method="POST" action="../controleUser/delete.php" style="display:inline;">
          <input type="hidden" name="user_id" id="userIdToDelete">
          <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Excluir</button>
        </form>
      </div>
    </div></div>
  </div>
  <!-- Fim Modal de exclusão -->

</main>

<!-- Rodapé -->
<footer id="footer" class="footer light-background">
  <?php require("../Include/footer.php"); ?>
</footer>
<!-- Fim do Rodapé -->

<?php require("../Include/preloaderAndScrollTop.php"); ?>
<?php require("../includeJS/scriptScr.php"); ?>
<script>
  // Script para lidar com o modal de exclusão
  document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-user');
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteUserModal'));
    const userToDeleteName = document.getElementById('userToDeleteName');
    const userIdToDelete = document.getElementById('userIdToDelete');

    deleteButtons.forEach(button => {
      button.addEventListener('click', function () {
        userToDeleteName.textContent = this.getAttribute('data-user-name');
        userIdToDelete.value = this.getAttribute('data-user-id');
        deleteModal.show();
      });
    });
  });
</script>

</body>
</html>