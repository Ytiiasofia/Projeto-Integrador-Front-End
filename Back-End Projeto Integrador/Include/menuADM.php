<?php
function carregarMenu() {
    $current_page = basename($_SERVER['PHP_SELF']);
    $current_dir = basename(dirname($_SERVER['SCRIPT_NAME'])); // pega o nome da pasta

    // MENU ADM
    if ($current_dir === 'UserADM') {
        ?>
        <ul>
            <li><a href="controleUserAdm.php" class="<?= ($current_page == 'controleUserAdm.php') ? 'active' : '' ?>">Gerenciamento de Usuários</a></li>
            <li><a href="noticiaAdm.php" class="<?= ($current_page == 'noticiaAdm.php') ? 'active' : '' ?>">Notícias</a></li>
            <li><a href="oportunidadeAdm.php" class="<?= ($current_page == 'oportunidadeAdm.php') ? 'active' : '' ?>">Oportunidades</a></li>
            <li><a href="forumAdm.php" class="<?= ($current_page == 'forumAdm.php') ? 'active' : '' ?>">Fórum</a></li>
            <li><a href="perfilAdm.php" class="<?= ($current_page == 'perfilAdm.php') ? 'active' : '' ?>">Perfil</a></li>
        </ul>
        <?php
    }

    // MENU USUÁRIO CADASTRADO
    elseif ($current_dir === 'UserCadastrado') {
        ?>
        <ul>
            <li><a href="inicioUserCad.php" class="<?= ($current_page == 'inicioUserCad.php') ? 'active' : '' ?>">Início</a></li>
            <li><a href="noticiasUserCad.php" class="<?= ($current_page == 'noticiasUserCad.php') ? 'active' : '' ?>">Notícias</a></li>
            <li><a href="oportunidadesUserCad.php" class="<?= ($current_page == 'oportunidadesUserCad.php') ? 'active' : '' ?>">Oportunidades</a></li>
            <li><a href="forumUserCad.php" class="<?= ($current_page == 'forumUserCad.php') ? 'active' : '' ?>">Fórum</a></li>
            <li><a href="perfilUserCad.php" class="<?= ($current_page == 'perfilUserCad.php') ? 'active' : '' ?>">Perfil</a></li>
        </ul>
        <?php
    }

    // MENU USUÁRIO ANÔNIMO
    elseif ($current_dir === 'UserAnonimo') {
        ?>
        <ul>
            <li><a href="index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Início</a></li>
            <li><a href="blog.php" class="<?= ($current_page == 'blog.php') ? 'active' : '' ?>">Notícias</a></li>
            <li><a href="portfolio.php" class="<?= ($current_page == 'portfolio.php') ? 'active' : '' ?>">Oportunidades</a></li>
            <li><a href="services.php" class="<?= ($current_page == 'services.php') ? 'active' : '' ?>">Fórum</a></li>
            <li><a href="contact.php" class="<?= ($current_page == 'contact.php') ? 'active' : '' ?>">Login</a></li>
        </ul>
        <?php
    }
}
?>
