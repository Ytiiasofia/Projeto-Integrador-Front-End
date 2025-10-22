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
            
        default:
            $response['message'] = 'Ação inválida';
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>