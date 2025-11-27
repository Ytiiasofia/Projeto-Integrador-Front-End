<?php
session_start();
require("../Include/conexao.php");

// VerificaCão de autenticação e autorização
if (!isset($_SESSION['usuario_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../login/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['oportunidade_id'])) {
    $oportunidade_id = intval($_POST['oportunidade_id']);
    
    // Usando parametros preparados para evitar SQL Injection
    $sql = "DELETE FROM oportunidades WHERE id_oportunidade = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $oportunidade_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['mensagem'] = "Oportunidade excluída com sucesso!";
        $_SESSION['tipo_mensagem'] = "success";
    } else {
        $_SESSION['mensagem'] = "Erro ao excluir oportunidade.";
        $_SESSION['tipo_mensagem'] = "error";
    }
    
    mysqli_stmt_close($stmt);
}

// Redirecionar de volta para a página de oportunidades, dai a página já recarrega a lista atualizada
header("Location: ../UserADM/oportunidadeAdm.php");
exit();
?>