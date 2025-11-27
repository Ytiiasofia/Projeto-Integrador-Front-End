<?php
session_start();
require("../Include/conexao.php");

header('Content-Type: application/json');

// Verificação de adicional de segurança para garantir que apenas administradores possam acessar
if (!isset($_SESSION['usuario_id']) || $_SESSION['perfil'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Acesso não autorizado']);
    exit;
}

$estatisticas = [];

try {
    if (!isset($con) || $con === null) {
        throw new Exception("Conexão com o banco de dados não estabelecida");
    }

    // Contar usuários registrados
    $query_usuarios = "SELECT COUNT(*) as total_usuarios FROM usuarios";
    $result_usuarios = $con->query($query_usuarios);
    if ($result_usuarios) {
        $estatisticas['total_usuarios'] = $result_usuarios->fetch_assoc()['total_usuarios'];
    } else {
        $estatisticas['total_usuarios'] = 0;
    }

    // Contar posts no fórum
    $query_posts = "SELECT COUNT(*) as total_posts FROM forum_posts";
    $result_posts = $con->query($query_posts);
    if ($result_posts) {
        $estatisticas['total_posts'] = $result_posts->fetch_assoc()['total_posts'];
    } else {
        $estatisticas['total_posts'] = 0;
    }

    // Contar oportunidades
    $query_oportunidades = "SELECT COUNT(*) as total_oportunidades FROM oportunidades";
    $result_oportunidades = $con->query($query_oportunidades);
    if ($result_oportunidades) {
        $estatisticas['total_oportunidades'] = $result_oportunidades->fetch_assoc()['total_oportunidades'];
    } else {
        $estatisticas['total_oportunidades'] = 0;
    }

    // Data e hora da última atualização (eu tive que remover essa parte porque estava bugando e dando a data errada na hora de puxar a data de atualização)
    $estatisticas['ultima_atualizacao'] = date('d/m/Y \à\s H:i');
    
    echo json_encode([
        'success' => true,
        'total_usuarios' => $estatisticas['total_usuarios'],
        'total_posts' => $estatisticas['total_posts'],
        'total_oportunidades' => $estatisticas['total_oportunidades'],
        'ultima_atualizacao' => $estatisticas['ultima_atualizacao']
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Erro ao obter estatísticas: ' . $e->getMessage()
    ]);
}
?>