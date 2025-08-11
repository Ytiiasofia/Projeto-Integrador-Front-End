<?php
// Descobre qual arquivo está sendo acessado
$current_page = basename($_SERVER['PHP_SELF']);
?>

<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
    <a class="logo d-flex align-items-center">
      <h1 class="sitename">She Innovates</h1>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="controleUserAdm.php" class="<?= ($current_page == 'controleUserAdm.php') ? 'active' : '' ?>">Gerenciamento de Usuários</a></li>
        <li><a href="noticiaAdm.php" class="<?= ($current_page == 'noticiaAdm.php') ? 'active' : '' ?>">Notícias</a></li>
        <li><a href="oportunidadeAdm.php" class="<?= ($current_page == 'oportunidadeAdm.php') ? 'active' : '' ?>">Oportunidades</a></li>
        <li><a href="forumAdm.php" class="<?= ($current_page == 'forumAdm.php') ? 'active' : '' ?>">Fórum</a></li>
        <li><a href="perfilAdm.php" class="<?= ($current_page == 'perfilAdm.php') ? 'active' : '' ?>">Perfil</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
  </div>
</header>
