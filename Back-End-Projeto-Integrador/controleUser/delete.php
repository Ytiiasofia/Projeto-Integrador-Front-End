<?php
// Configurações do banco de dados
$host = "db";      
$user = "root";
$pass = "root";    
$dbname = "meu_banco";
$port = 3306;

// Conexão com o banco
$con = mysqli_connect($host, $user, $pass, $dbname, $port);

// Verifica se a conexão foi bem-sucedida
if (!$con) {
    die("Erro ao conectar com o banco de dados: " . mysqli_connect_error());
}

// Verifica se recebeu via POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);

    // Protege contra exclusão acidental de administradores
    $check = $con->prepare("SELECT is_admin FROM usuarios WHERE usuario_id = ?");
    $check->bind_param("i", $user_id);
    $check->execute();
    $res = $check->get_result();

    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        if ($row['is_admin'] == 1) {
            // Bloqueia exclusão de administradores
            $conn->close();
            header("Location: ../UserADM/controleUserAdm.php?msg=nao_autorizado");
            exit;
        }
    }

    // Executa exclusão
    $stmt = $con->prepare("DELETE FROM usuarios WHERE usuario_id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $stmt->close();
        $con->close();
        header("Location: ../UserADM/controleUserAdm.php?msg=sucesso");
        exit;
    } else {
        $stmt->close();
        $con->close();
        header("Location: ../UserADM/controleUserAdm.php?msg=erro");
        exit;
    }
} else {
    // Caso tentem acessar direto
    $conn->close();
    header("Location: ../UserADM/controleUserAdm.php?msg=invalid");
    exit;
}
