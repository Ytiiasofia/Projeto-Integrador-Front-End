<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Contact - Nova Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <?php
  require("../Include/hrefCssHead.php");
  ?>

  <style>
    .user-table {
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .user-table thead {
      background-color: #6c63ff;
      color: white;
    }

    .user-table th {
      padding: 15px;
      font-weight: 600;
    }

    .user-table td {
      padding: 12px 15px;
      vertical-align: middle;
    }

    .user-table tbody tr {
      transition: all 0.3s ease;
    }

    .user-table tbody tr:hover {
      background-color: #f8f9fa;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .badge-user {
      background-color: #6c63ff;
      color: white;
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 500;
    }

    .badge-admin {
      background-color: #28a745;
      color: white;
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 500;
    }

    .action-btn {
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      transition: all 0.3s ease;
    }

    .action-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .section-header h2 {
      color: #6c63ff;
      font-weight: 700;
      margin-bottom: 15px;
    }

    .section-header p {
      color: #6c757d;
      font-size: 1.1rem;
    }
  </style>
</head>

<body class="contact-page">

<?php require_once __DIR__ . '/../include/menuADM.php'; ?>

  <!-- Main -->
  <main class="main">

    <!-- Page Title -->
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

    <!-- User Management Section -->
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
                <th scope="col">Data de Cadastro</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody>
              <!-- Usuários -->
              <tr>
                <th scope="row">1</th>
                <td>Ana Silva</td>
                <td>ana.silva@example.com</td>
                <td><span class="badge-user">Usuário</span></td>
                <td>15/03/2023</td>
                <td>
                  <button class="btn btn-sm btn-danger action-btn delete-user" data-user-id="1" data-user-name="Ana Silva">
                    <i class="bi bi-trash"></i> Excluir
                  </button>
                </td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Carlos Oliveira</td>
                <td>carlos@example.com</td>
                <td><span class="badge-admin">Administrador</span></td>
                <td>22/05/2023</td>
                <td>
                  <button class="btn btn-sm btn-secondary action-btn" disabled>
                    <i class="bi bi-shield-lock"></i> Protegido
                  </button>
                </td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Mariana Costa</td>
                <td>mariana.c@example.com</td>
                <td><span class="badge-user">Usuário</span></td>
                <td>10/06/2023</td>
                <td>
                  <button class="btn btn-sm btn-danger action-btn delete-user" data-user-id="3" data-user-name="Mariana Costa">
                    <i class="bi bi-trash"></i> Excluir
                  </button>
                </td>
              </tr>
              <tr>
                <th scope="row">4</th>
                <td>Juliana Santos</td>
                <td>juliana.s@example.com</td>
                <td><span class="badge-user">Usuário</span></td>
                <td>05/07/2023</td>
                <td>
                  <button class="btn btn-sm btn-danger action-btn delete-user" data-user-id="4" data-user-name="Juliana Santos">
                    <i class="bi bi-trash"></i> Excluir
                  </button>
                </td>
              </tr>
              <tr>
                <th scope="row">5</th>
                <td>Fernanda Alves</td>
                <td>fernanda.a@example.com</td>
                <td><span class="badge-admin">Administrador</span></td>
                <td>18/08/2023</td>
                <td>
                  <button class="btn btn-sm btn-secondary action-btn" disabled>
                    <i class="bi bi-shield-lock"></i> Protegido
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteUserModalLabel">Confirmar Exclusão</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Tem certeza que deseja excluir permanentemente a conta de <strong id="userToDeleteName"></strong>?</p>
            <p class="text-danger"><i class="bi bi-exclamation-triangle-fill"></i> Esta ação é irreversível e removerá todos os dados associados a este usuário.</p>
            <div id="passwordConfirmation" class="mt-3" style="display: none;">
              <label for="adminPassword" class="form-label">Digite sua senha de administrador para confirmar:</label>
              <div class="input-group">
                <input type="password" class="form-control" id="adminPassword" placeholder="Senha de administrador">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
              <div id="passwordError" class="text-danger mt-2" style="display: none;">
                <i class="bi bi-x-circle-fill"></i> Senha incorreta. Tente novamente.
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" id="confirmDelete">
              <i class="bi bi-trash"></i> Excluir
            </button>
          </div>
        </div>
      </div>
    </div>

  </main>

  <!-- Footer -->
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

  <!-- Custom Script for User Management -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const deleteButtons = document.querySelectorAll('.delete-user');
      const deleteModal = new bootstrap.Modal(document.getElementById('deleteUserModal'));
      const userToDeleteName = document.getElementById('userToDeleteName');
      const confirmDeleteBtn = document.getElementById('confirmDelete');
      const passwordConfirmation = document.getElementById('passwordConfirmation');
      const adminPasswordInput = document.getElementById('adminPassword');
      const passwordError = document.getElementById('passwordError');
      const togglePassword = document.getElementById('togglePassword');

      let userIdToDelete = null;
      const correctAdminPassword = "admin123";

      togglePassword.addEventListener('click', function () {
        const type = adminPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        adminPasswordInput.setAttribute('type', type);
        this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
      });

      deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
          userIdToDelete = this.getAttribute('data-user-id');
          const userName = this.getAttribute('data-user-name');
          userToDeleteName.textContent = userName;

          passwordConfirmation.style.display = 'none';
          adminPasswordInput.value = '';
          passwordError.style.display = 'none';
          adminPasswordInput.setAttribute('type', 'password');
          togglePassword.innerHTML = '<i class="bi bi-eye"></i>';

          deleteModal.show();
        });
      });

      confirmDeleteBtn.addEventListener('click', function () {
        if (passwordConfirmation.style.display === 'none') {
          passwordConfirmation.style.display = 'block';
          confirmDeleteBtn.innerHTML = '<i class="bi bi-check-circle"></i> Confirmar Exclusão';
          adminPasswordInput.focus();
        } else {
          if (adminPasswordInput.value === correctAdminPassword) {
            const toastHTML = `
              <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="deleteToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header bg-success text-white">
                    <strong class="me-auto"><i class="bi bi-check-circle-fill"></i> Sucesso</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Conta de <strong>${userToDeleteName.textContent}</strong> excluída com sucesso!
                  </div>
                </div>
              </div>
            `;
            document.body.insertAdjacentHTML('beforeend', toastHTML);
            setTimeout(() => {
              const toast = document.getElementById('deleteToast');
              if (toast) toast.remove();
            }, 5000);

            deleteModal.hide();
          } else {
            passwordError.style.display = 'block';
            adminPasswordInput.focus();
          }
        }
      });

      document.getElementById('deleteUserModal').addEventListener('hidden.bs.modal', function () {
        passwordConfirmation.style.display = 'none';
        adminPasswordInput.value = '';
        passwordError.style.display = 'none';
        confirmDeleteBtn.innerHTML = '<i class="bi bi-trash"></i> Excluir';
      });
    });
  </script>

</body>

</html>
