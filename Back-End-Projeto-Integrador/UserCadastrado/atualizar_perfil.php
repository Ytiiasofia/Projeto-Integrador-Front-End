<?php
session_start();
require("../Include/conexao.php");

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Usuário não logado']);
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    switch($action) {
        case 'update_username':
            $novo_username = trim($_POST['novo_username'] ?? '');
            
            if (empty($novo_username)) {
                $response['message'] = 'Nome de usuário não pode estar vazio';
                break;
            }
            
            if (strlen($novo_username) < 3 || strlen($novo_username) > 20) {
                $response['message'] = 'Nome de usuário deve ter entre 3 e 20 caracteres';
                break;
            }
            
            // Verificar se o username já existe (excluindo o usuário atual)
            $sql_check = "SELECT usuario_id FROM usuarios WHERE nome_usuario = ? AND usuario_id != ?";
            $stmt_check = mysqli_prepare($con, $sql_check);
            mysqli_stmt_bind_param($stmt_check, "si", $novo_username, $usuario_id);
            mysqli_stmt_execute($stmt_check);
            mysqli_stmt_store_result($stmt_check);
            
            if (mysqli_stmt_num_rows($stmt_check) > 0) {
                $response['message'] = 'Este nome de usuário já está em uso';
                mysqli_stmt_close($stmt_check);
                break;
            }
            mysqli_stmt_close($stmt_check);
            
            // Atualizar username
            $sql_update = "UPDATE usuarios SET nome_usuario = ? WHERE usuario_id = ?";
            $stmt_update = mysqli_prepare($con, $sql_update);
            mysqli_stmt_bind_param($stmt_update, "si", $novo_username, $usuario_id);
            
            if (mysqli_stmt_execute($stmt_update)) {
                $response['success'] = true;
                $response['message'] = 'Nome de usuário atualizado com sucesso!';
                $_SESSION['nome_usuario'] = $novo_username; // Atualizar sessão
            } else {
                $response['message'] = 'Erro ao atualizar nome de usuário';
            }
            mysqli_stmt_close($stmt_update);
            break;
            
        case 'update_email':
            $novo_email = trim($_POST['novo_email'] ?? '');
            
            if (empty($novo_email)) {
                $response['message'] = 'Email não pode estar vazio';
                break;
            }
            
            if (!filter_var($novo_email, FILTER_VALIDATE_EMAIL)) {
                $response['message'] = 'Email inválido';
                break;
            }
            
            // Verificar se o email já existe (excluindo o usuário atual)
            $sql_check = "SELECT usuario_id FROM usuarios WHERE email = ? AND usuario_id != ?";
            $stmt_check = mysqli_prepare($con, $sql_check);
            mysqli_stmt_bind_param($stmt_check, "si", $novo_email, $usuario_id);
            mysqli_stmt_execute($stmt_check);
            mysqli_stmt_store_result($stmt_check);
            
            if (mysqli_stmt_num_rows($stmt_check) > 0) {
                $response['message'] = 'Este email já está em uso';
                mysqli_stmt_close($stmt_check);
                break;
            }
            mysqli_stmt_close($stmt_check);
            
            // Atualizar email
            $sql_update = "UPDATE usuarios SET email = ? WHERE usuario_id = ?";
            $stmt_update = mysqli_prepare($con, $sql_update);
            mysqli_stmt_bind_param($stmt_update, "si", $novo_email, $usuario_id);
            
            if (mysqli_stmt_execute($stmt_update)) {
                $response['success'] = true;
                $response['message'] = 'Email atualizado com sucesso!';
            } else {
                $response['message'] = 'Erro ao atualizar email';
            }
            mysqli_stmt_close($stmt_update);
            break;
            
        case 'update_password':
            $senha_atual = $_POST['senha_atual'] ?? '';
            $nova_senha = $_POST['nova_senha'] ?? '';
            $confirmar_senha = $_POST['confirmar_senha'] ?? '';
            
            if (empty($senha_atual) || empty($nova_senha) || empty($confirmar_senha)) {
                $response['message'] = 'Todos os campos de senha são obrigatórios';
                break;
            }
            
            if ($nova_senha !== $confirmar_senha) {
                $response['message'] = 'As senhas não coincidem';
                break;
            }
            
            if (strlen($nova_senha) < 8) {
                $response['message'] = 'A senha deve ter pelo menos 8 caracteres';
                break;
            }
            
            if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $nova_senha)) {
                $response['message'] = 'A senha deve conter letras e números';
                break;
            }
            
            // Verificar senha atual
            $sql_check = "SELECT senha FROM usuarios WHERE usuario_id = ?";
            $stmt_check = mysqli_prepare($con, $sql_check);
            mysqli_stmt_bind_param($stmt_check, "i", $usuario_id);
            mysqli_stmt_execute($stmt_check);
            mysqli_stmt_bind_result($stmt_check, $senha_hash);
            mysqli_stmt_fetch($stmt_check);
            mysqli_stmt_close($stmt_check);
            
            if (!password_verify($senha_atual, $senha_hash)) {
                $response['message'] = 'Senha atual incorreta';
                break;
            }
            
            // Atualizar senha
            $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
            $sql_update = "UPDATE usuarios SET senha = ? WHERE usuario_id = ?";
            $stmt_update = mysqli_prepare($con, $sql_update);
            mysqli_stmt_bind_param($stmt_update, "si", $nova_senha_hash, $usuario_id);
            
            if (mysqli_stmt_execute($stmt_update)) {
                $response['success'] = true;
                $response['message'] = 'Senha atualizada com sucesso!';
            } else {
                $response['message'] = 'Erro ao atualizar senha';
            }
            mysqli_stmt_close($stmt_update);
            break;
            
        case 'update_photo':
            // Diretório para salvar as fotos
            $upload_dir = "../uploads/fotos_perfil/";
            
            // Criar diretório se não existir
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            // Verificar se arquivo foi enviado
            if (!isset($_FILES['foto_perfil']) || $_FILES['foto_perfil']['error'] !== UPLOAD_ERR_OK) {
                $response['message'] = 'Erro no upload do arquivo';
                break;
            }
            
            $file = $_FILES['foto_perfil'];
            
            // Validar tipo de arquivo
            $allowed_types = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);
            
            if (!in_array($mime_type, $allowed_types)) {
                $response['message'] = 'Tipo de arquivo não permitido';
                break;
            }
            
            // Validar tamanho do arquivo (2MB)
            if ($file['size'] > 2 * 1024 * 1024) {
                $response['message'] = 'Arquivo muito grande. Máximo 2MB.';
                break;
            }
            
            // Gerar nome único para o arquivo
            $extensao = pathinfo($file['name'], PATHINFO_EXTENSION);
            $nome_arquivo = 'perfil_' . $usuario_id . '_' . time() . '.' . $extensao;
            $caminho_completo = $upload_dir . $nome_arquivo;
            
            // Mover arquivo para o diretório de uploads
            if (move_uploaded_file($file['tmp_name'], $caminho_completo)) {
                
                // Iniciar transação
                mysqli_begin_transaction($con);
                
                try {
                    // Marcar todas as fotos anteriores como não atuais
                    $sql_desativar = "UPDATE usuario_fotos SET is_atual = 0 WHERE usuario_id = ?";
                    $stmt_desativar = mysqli_prepare($con, $sql_desativar);
                    mysqli_stmt_bind_param($stmt_desativar, "i", $usuario_id);
                    mysqli_stmt_execute($stmt_desativar);
                    mysqli_stmt_close($stmt_desativar);
                    
                    // Inserir nova foto
                    $sql_inserir = "INSERT INTO usuario_fotos (usuario_id, nome_arquivo, caminho_arquivo, is_atual) VALUES (?, ?, ?, 1)";
                    $stmt_inserir = mysqli_prepare($con, $sql_inserir);
                    mysqli_stmt_bind_param($stmt_inserir, "iss", $usuario_id, $nome_arquivo, $caminho_completo);
                    
                    if (mysqli_stmt_execute($stmt_inserir)) {
                        mysqli_commit($con);
                        $response['success'] = true;
                        $response['message'] = 'Foto de perfil atualizada com sucesso!';
                        $response['foto_url'] = $caminho_completo;
                    } else {
                        throw new Exception('Erro ao inserir foto no banco de dados');
                    }
                    
                    mysqli_stmt_close($stmt_inserir);
                    
                } catch (Exception $e) {
                    mysqli_rollback($con);
                    // Deletar arquivo se houve erro no banco
                    if (file_exists($caminho_completo)) {
                        unlink($caminho_completo);
                    }
                    $response['message'] = 'Erro ao salvar foto: ' . $e->getMessage();
                }
                
            } else {
                $response['message'] = 'Erro ao salvar arquivo';
            }
            break;
            
        default:
            $response['message'] = 'Ação inválida';
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>