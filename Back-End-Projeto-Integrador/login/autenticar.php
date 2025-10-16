<?php
session_start();

// Conexão com o banco de dados via require
require("../Include/conexao.php");

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

        // Verficação de senha sem o HASH
        if ($senha === $row['senha']) {
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
            header("Location: ../UserAnonimo/contact.php?status=erro");
            exit();
        }
    } else {
        header("Location: ../UserAnonimo/contact.php?status=erro");
        exit();
    }
} else {
    header("Location: ../UserAnonimo/contact.php");
    exit();
}
?>