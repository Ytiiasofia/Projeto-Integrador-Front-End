<?php
require("../Include/conexao.php");

// Recebe dados do formulário
$nome_usuario = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['password'] ?? '';
$confirmSenha = $_POST['confirmPassword'] ?? '';
$is_admin = 0; // sempre que usuário se cadastrar, ele automaticamente não será admin

$errors = [];

// Validações básicas para criação de conta
if (strlen($nome_usuario) < 4) {
    $errors[] = "Nome de usuário deve ter pelo menos 4 caracteres.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "E-mail inválido.";
}

if (strlen($senha) < 8) {
    $errors[] = "Senha deve ter pelo menos 8 caracteres.";
}

if ($senha !== $confirmSenha) {
    $errors[] = "As senhas não coincidem.";
}

// Verifica se o nome de usuário não está repetido
if (empty($errors)) {
    $stmt = $con->prepare("SELECT * FROM usuarios WHERE nome_usuario = ?");
    $stmt->bind_param("s", $nome_usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $errors[] = "Este nome de usuário já está em uso.";
    }
    $stmt->close();
}

// Verifica se o e-mail não está repetido
if (empty($errors)) {
    $stmt = $con->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $errors[] = "Este e-mail já está cadastrado.";
    }
    $stmt->close();
}

// Se não houver erros, insere usuário
if (empty($errors)) {
    // Aplicação de hash na senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    
    $stmt = $con->prepare("INSERT INTO usuarios (nome_usuario, email, senha, is_admin) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nome_usuario, $email, $senha_hash, $is_admin);

    if ($stmt->execute()) {
        // Sucesso - redireciona com mensagem de sucesso
        header("Location: ../UserAnonimo/cadastro.php?success=1");
        exit();
    } else {
        $errors[] = "Erro ao cadastrar: " . $stmt->error;
    }
    $stmt->close();
}

// Se houve erros, redireciona de volta com os erros
if (!empty($errors)) {
    $error_string = urlencode(implode(" ", $errors));
    $username_param = urlencode($nome_usuario);
    $email_param = urlencode($email);
    header("Location: ../UserAnonimo/cadastro.php?error=$error_string&username=$username_param&email=$email_param");
    exit();
}

$con->close();
?>