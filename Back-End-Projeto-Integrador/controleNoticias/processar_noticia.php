<?php
session_start();
require_once '../Include/conexao.php'; // Usando seu arquivo de conexão

header('Content-Type: application/json');

// Verificar se o usuário é admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['is_admin'] != 1) {
    echo json_encode(['success' => false, 'message' => 'Acesso negado. Apenas administradores podem publicar notícias.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receber dados do formulário
    $titulo = mysqli_real_escape_string($con, $_POST['titulo'] ?? '');
    $conteudo = mysqli_real_escape_string($con, $_POST['conteudo'] ?? '');
    $categoria = mysqli_real_escape_string($con, $_POST['categoria'] ?? '');
    $tags = $_POST['tags'] ?? '';
    $autor_id = $_SESSION['usuario_id'];

    // Validações básicas
    if (empty($titulo) || empty($conteudo) || empty($categoria)) {
        echo json_encode(['success' => false, 'message' => 'Preencha todos os campos obrigatórios.']);
        exit;
    }

    // Processar upload da imagem
    $imagem_capa = null;
    if (isset($_FILES['imagem_capa']) && $_FILES['imagem_capa']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/img/blog/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileExtension = pathinfo($_FILES['imagem_capa']['name'], PATHINFO_EXTENSION);
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        
        if (in_array(strtolower($fileExtension), $allowedExtensions)) {
            $fileName = uniqid() . '_' . time() . '.' . $fileExtension;
            $uploadPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['imagem_capa']['tmp_name'], $uploadPath)) {
                $imagem_capa = 'assets/img/blog/' . $fileName;
            }
        }
    }

    // Iniciar transação
    mysqli_begin_transaction($con);

    try {
        // Obter categoria_id baseado no nome da categoria
        $query = "SELECT categoria_id FROM categorias WHERE nome_categoria = '$categoria'";
        $result = mysqli_query($con, $query);
        
        if (!$result || mysqli_num_rows($result) === 0) {
            throw new Exception('Categoria inválida.');
        }
        
        $categoria_data = mysqli_fetch_assoc($result);
        $categoria_id = $categoria_data['categoria_id'];

        // Inserir a notícia
        $imagem_capa_escaped = $imagem_capa ? "'$imagem_capa'" : "NULL";
        $query = "INSERT INTO noticias (titulo, conteudo, imagem_capa, categoria_id, autor_id, status, data_publicacao) 
                  VALUES ('$titulo', '$conteudo', $imagem_capa_escaped, '$categoria_id', '$autor_id', 'publicado', NOW())";
        
        $result = mysqli_query($con, $query);
        
        if (!$result) {
            throw new Exception('Erro ao inserir notícia: ' . mysqli_error($con));
        }

        $noticia_id = mysqli_insert_id($con);

        // Processar tags
        if (!empty($tags)) {
            $tags_array = explode(',', $tags);
            
            foreach ($tags_array as $tag_nome) {
                $tag_nome = trim(mysqli_real_escape_string($con, $tag_nome));
                
                if (empty($tag_nome)) continue;
                
                // Verificar se a tag já existe
                $tag_query = "SELECT tag_id FROM tags WHERE nome_tag = '$tag_nome'";
                $tag_result = mysqli_query($con, $tag_query);
                
                if ($tag_result && mysqli_num_rows($tag_result) > 0) {
                    $tag_data = mysqli_fetch_assoc($tag_result);
                    $tag_id = $tag_data['tag_id'];
                } else {
                    // Criar nova tag
                    $insert_tag_query = "INSERT INTO tags (nome_tag) VALUES ('$tag_nome')";
                    $insert_tag_result = mysqli_query($con, $insert_tag_query);
                    
                    if (!$insert_tag_result) {
                        throw new Exception('Erro ao criar tag: ' . mysqli_error($con));
                    }
                    
                    $tag_id = mysqli_insert_id($con);
                }
                
                // Associar tag à notícia
                $associar_query = "INSERT INTO noticias_tags (noticia_id, tag_id) VALUES ('$noticia_id', '$tag_id')";
                $associar_result = mysqli_query($con, $associar_query);
                
                if (!$associar_result) {
                    // Ignora erro de duplicação (tag já associada)
                    if (mysqli_errno($con) != 1062) { // Código de erro para entrada duplicada
                        throw new Exception('Erro ao associar tag: ' . mysqli_error($con));
                    }
                }
            }
        }

        // Confirmar transação
        mysqli_commit($con);
        echo json_encode(['success' => true, 'message' => 'Notícia publicada com sucesso!']);

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