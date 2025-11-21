<?php
session_start();
require_once '../Include/conexao.php';

header('Content-Type: application/json');

// Verificar se o usuário é admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['is_admin'] != 1) {
    echo json_encode(['success' => false, 'message' => 'Acesso negado. Apenas administradores podem deletar notícias.']);
    exit;
}

// Verificar se a conexão foi bem-sucedida
if (!$con) {
    echo json_encode(['success' => false, 'message' => 'Erro de conexão com o banco de dados.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receber dados
    $noticia_id = mysqli_real_escape_string($con, $_POST['noticia_id'] ?? '');
    
    // Validações
    if (empty($noticia_id)) {
        echo json_encode(['success' => false, 'message' => 'ID da notícia não informado.']);
        exit;
    }

    // Iniciar transação
    mysqli_begin_transaction($con);

    try {
        // Verificar se a notícia existe
        $check_query = "SELECT noticia_id, imagem_capa FROM noticias WHERE noticia_id = '$noticia_id'";
        $check_result = mysqli_query($con, $check_query);
        
        if (!$check_result || mysqli_num_rows($check_result) === 0) {
            throw new Exception('Notícia não encontrada.');
        }
        
        $noticia_data = mysqli_fetch_assoc($check_result);
        
        // 1. Deletar as relações na tabela noticias_tags
        $delete_tags_query = "DELETE FROM noticias_tags WHERE noticia_id = '$noticia_id'";
        $delete_tags_result = mysqli_query($con, $delete_tags_query);
        
        if (!$delete_tags_result) {
            throw new Exception('Erro ao deletar tags da notícia: ' . mysqli_error($con));
        }
        
        // 2. Deletar a notícia
        $delete_news_query = "DELETE FROM noticias WHERE noticia_id = '$noticia_id'";
        $delete_news_result = mysqli_query($con, $delete_news_query);
        
        if (!$delete_news_result) {
            throw new Exception('Erro ao deletar notícia: ' . mysqli_error($con));
        }
        
        // 3. Deletar a imagem se existir
        if ($noticia_data['imagem_capa']) {
            $image_path = '../' . $noticia_data['imagem_capa'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        // Confirmar transação
        mysqli_commit($con);
        echo json_encode(['success' => true, 'message' => 'Notícia deletada com sucesso!']);

    } catch (Exception $e) {
        // Reverter transação em caso de erro
        mysqli_rollback($con);
        echo json_encode(['success' => false, 'message' => 'Erro: ' . $e->getMessage()]);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
}

// Fechar conexão
mysqli_close($con);
?>