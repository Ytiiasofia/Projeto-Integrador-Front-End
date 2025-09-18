<?php
session_start();

// Configurações do banco de dados conforme seu docker-compose
$host = "db"; // Nome do serviço do MySQL no docker-compose
$user = "user"; // MYSQL_USER
$pass = "senha"; // MYSQL_PASSWORD
$bdname = "meu_banco"; // MYSQL_DATABASE

// Conexão com o banco
$con = mysqli_connect($host, $user, $pass, $bdname);

// Verifica conexão
if (!$con) {
    die("Erro ao conectar com o banco de dados: " . mysqli_connect_error());
}

// Verifica se o formulário de login foi enviado
if (isset($_POST['login'])) {
    // Protege contra SQL Injection
    $usuario = mysqli_real_escape_string($con, $_POST['usuario']); 
    $senha = $_POST['senha'];

    // Consulta para buscar usuário pelo email
    $sql = "SELECT * FROM usuarios WHERE email = '$usuario' LIMIT 1";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Erro na consulta SQL: " . mysqli_error($con));
    }

    // Verifica se encontrou o usuário
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Verificação da senha
        // Se estiver salvando senha com hash (recomendado), use password_verify()
        if ($senha === $row['senha']) { 
            // Seta os dados na sessão
            $_SESSION['usuario_id'] = $row['usuario_id'];
            $_SESSION['usuario_nome'] = $row['nome_usuario'];
            $_SESSION['is_admin'] = $row['is_admin'];
            $_SESSION['logado'] = true;

            // Redireciona para a página principal
            header("Location: ../emprestimo/mostrar.php?status=success");
            exit();
        } else {
            // Senha incorreta
            header("Location: login.php?status=erro");
            exit();
        }
    } else {
        // Usuário não encontrado
        header("Location: login.php?status=erro");
        exit();
    }
} else {
    header("Location: ../UserAnonimo/contact.php");
    exit();
}
?>
