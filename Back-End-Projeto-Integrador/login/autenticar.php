<?php
session_start();

// Configurações do banco de dados
$host = "db";      // Usando localhost pois o PHP e o MySQL estão no mesmo servidor
$user = "root";           // Usuário root
$pass = "root";           // Senha root
$dbname = "meu_banco";    // Nome correto do banco de dados
$port = 3306;             // Porta padrão do MySQL (não é a 8081, essa é do phpMyAdmin)

// Conexão com o banco
$con = mysqli_connect($host, $user, $pass, $dbname, $port);

// Verifica se a conexão foi bem-sucedida
if (!$con) {
    die("Erro ao conectar com o banco de dados: " . mysqli_connect_error());
}

// Verifica se o formulário foi enviado
if (isset($_POST['login'])) {
    $usuario = mysqli_real_escape_string($con, $_POST['usuario']);
    $senha = $_POST['senha'];

    // Busca o usuário pelo nome ou email
    $sql = "SELECT * FROM usuarios WHERE email = '$usuario' OR nome_usuario = '$usuario'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Erro na consulta SQL: " . mysqli_error($con));
    }

    // Verifica se encontrou um usuário
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Verifica a senha (se estiver armazenada sem hash, apenas comparação direta)
        if ($senha === $row['senha']) {
            // Seta os dados na sessão
            $_SESSION['usuario_id'] = $row['usuario_id'];
            $_SESSION['usuario_nome'] = $row['nome_usuario'];
            $_SESSION['is_admin'] = $row['is_admin'];
            $_SESSION['logado'] = true;

            // Redireciona conforme o tipo de usuário
            if ($row['is_admin'] == 1) {
                header("Location: ../UserADM/perfilAdm.php");
            } else {
                header("Location: ../UserCadastrado/perfilUserCad.php");
            }
            exit();
        } else {
            // Senha incorreta
            header("Location: ../UserAnonimo/contact.php?status=erro");
            exit();
        }
    } else {
        // Usuário não encontrado
        header("Location: ../UserAnonimo/contact.php?status=erro");
        exit();
    }
} else {
    header("Location: ../UserAnonimo/contact.php");
    exit();
}
?>
