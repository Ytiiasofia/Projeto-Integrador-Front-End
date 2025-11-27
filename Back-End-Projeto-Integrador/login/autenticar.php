<?php
session_start();

require("../Include/conexao.php");

if (isset($_POST['login'])) {
    $usuario = mysqli_real_escape_string($con, $_POST['usuario']);
    $senha = $_POST['senha'];

    // Busca o usuário pelo nome ou email, protegido contra SQL Injection
    $sql = "SELECT * FROM usuarios WHERE email = ? OR nome_usuario = ?";
    $stmt = mysqli_prepare($con, $sql);
    
    if (!$stmt) {
        die("Erro na preparação da consulta: " . mysqli_error($con));
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $usuario, $usuario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Verifica se encontrou um usuário
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Verificação de senha COM HASH usando password_verify()
        if (password_verify($senha, $row['senha'])) {
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
    
    mysqli_stmt_close($stmt);
} else {
    header("Location: ../UserAnonimo/contact.php");
    exit();
}

// Fechar conexão
mysqli_close($con);
?>