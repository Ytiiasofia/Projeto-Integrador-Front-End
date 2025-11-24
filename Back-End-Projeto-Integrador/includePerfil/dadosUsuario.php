<?php
// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login/login.php");
    exit();
}

// Buscar dados do usuário
$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT usuario_id, nome_usuario, email, is_admin, data_cadastro FROM usuarios WHERE usuario_id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $usuario_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$usuario = mysqli_fetch_assoc($result);

if (!$usuario) {
    echo "Usuário não encontrado!";
    exit();
}

// Buscar foto de perfil atual do usuário
$sql_foto = "SELECT nome_arquivo, caminho_arquivo FROM usuario_fotos WHERE usuario_id = ? AND is_atual = 1 ORDER BY data_upload DESC LIMIT 1";
$stmt_foto = mysqli_prepare($con, $sql_foto);
mysqli_stmt_bind_param($stmt_foto, "i", $usuario_id);
mysqli_stmt_execute($stmt_foto);
$result_foto = mysqli_stmt_get_result($stmt_foto);
$foto_perfil = mysqli_fetch_assoc($result_foto);

$foto_url = "../assets/img/avatar-placeholder.png"; // Foto padrão
if ($foto_perfil && file_exists($foto_perfil['caminho_arquivo'])) {
    $foto_url = $foto_perfil['caminho_arquivo'];
}

// Formatar data de cadastro
if (isset($usuario['data_cadastro']) && !empty($usuario['data_cadastro'])) {
    $data_cadastro = date('F Y', strtotime($usuario['data_cadastro']));
    $meses_ingles = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $meses_portugues = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
    $data_cadastro = str_replace($meses_ingles, $meses_portugues, $data_cadastro);
}
?>