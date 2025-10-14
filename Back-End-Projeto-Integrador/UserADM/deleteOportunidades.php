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
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['oportunidade_id'])) {
    $oportunidade_id = intval($_POST['oportunidade_id']);

    // Executa exclusão
    $stmt = $con->prepare("DELETE FROM oportunidades WHERE id_oportunidade = ?");
    $stmt->bind_param("i", $oportunidade_id);

    if ($stmt->execute()) {
        $stmt->close();
        $con->close();
        header("Location: oportunidadeAdm.php?msg=sucesso");
        exit;
    } else {
        $stmt->close();
        $con->close();
        header("Location: oportunidadeAdm.php?msg=erro");
        exit;
    }
} else {
    // Caso tentem acessar direto
    $con->close();
    header("Location: oportunidadeAdm.php?msg=invalid");
    exit;
}
?>