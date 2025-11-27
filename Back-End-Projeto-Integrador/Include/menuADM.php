<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
    <a class="logo d-flex align-items-center">
      <h1 class="sitename">She Innovates</h1>
    </a>

    <nav id="navmenu" class="navmenu">
        <?php carregarMenu(); ?> <!-- Chama a função para carregar o menu correto -->
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
  </div>
</header>
<?php

// Função para carregar o menu com base no diretório de pastas que o usuário está navegando
function carregarMenu() {
    $current_page = basename($_SERVER['PHP_SELF']);
    $current_dir = basename(dirname($_SERVER['SCRIPT_NAME'])); 

    // Menu para Administrador
    if ($current_dir === 'UserADM') {
        ?>
        <ul>
            <li><a href="../UserADM/controleUserAdm.php" class="<?= ($current_page == 'controleUserAdm.php') ? 'active' : '' ?>">Gerenciamento de Usuários</a></li>
            <li><a href="../UserADM/noticiaAdm.php" class="<?= ($current_page == 'noticiaAdm.php') ? 'active' : '' ?>">Notícias</a></li>
            <li><a href="../UserADM/oportunidadeAdm.php" class="<?= ($current_page == 'oportunidadeAdm.php') ? 'active' : '' ?>">Oportunidades</a></li>
            <li><a href="../UserADM/forumAdm.php" class="<?= ($current_page == 'forumAdm.php') ? 'active' : '' ?>">Fórum</a></li>
            <li><a href="../UserADM/perfilAdm.php" class="<?= ($current_page == 'perfilAdm.php') ? 'active' : '' ?>">Perfil</a></li>
        </ul>
        <?php
    }
    // Menu para Usuário Cadastrado
    elseif ($current_dir === 'UserCadastrado') {
        ?>
        <ul>
            <li><a href="../UserCadastrado/inicioUserCad.php" class="<?= ($current_page == 'inicioUserCad.php') ? 'active' : '' ?>">Início</a></li>
            <li><a href="../UserCadastrado/noticiasUserCad.php" class="<?= ($current_page == 'noticiasUserCad.php') ? 'active' : '' ?>">Notícias</a></li>
            <li><a href="../UserCadastrado/oportunidadesUserCad.php" class="<?= ($current_page == 'oportunidadesUserCad.php') ? 'active' : '' ?>">Oportunidades</a></li>
            <li><a href="../UserCadastrado/forumUserCad.php" class="<?= ($current_page == 'forumUserCad.php') ? 'active' : '' ?>">Fórum</a></li>
            <li><a href="../UserCadastrado/perfilUserCad.php" class="<?= ($current_page == 'perfilUserCad.php') ? 'active' : '' ?>">Perfil</a></li>
        </ul>
        <?php
    }
    // Menu para Usuário Anônimo
    elseif ($current_dir === 'UserAnonimo') {
        ?>
        <ul>
            <li><a href="../UserAnonimo/index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Início</a></li>
            <li><a href="../UserAnonimo/blog.php" class="<?= ($current_page == 'blog.php') ? 'active' : '' ?>">Notícias</a></li>
            <li><a href="../UserAnonimo/portfolio.php" class="<?= ($current_page == 'portfolio.php') ? 'active' : '' ?>">Oportunidades</a></li>
            <li><a href="../UserAnonimo/services.php" class="<?= ($current_page == 'services.php') ? 'active' : '' ?>">Fórum</a></li>
            <li><a href="../UserAnonimo/contact.php" class="<?= ($current_page == 'contact.php') ? 'active' : '' ?>">Login</a></li>
        </ul>
        <?php
    }
}
?> 
