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
?>