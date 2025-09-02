<?php
$host = "localhost";
$db   = "TAREFAS";
$user = "tarefas";
$pass = "tarefa@123";


$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


$conn->query("CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");


$conn->select_db($db);

$sql = "CREATE TABLE IF NOT EXISTS TAREFAS (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    NOME VARCHAR(100) NOT NULL,
    CUSTO DECIMAL(10,2) NOT NULL,
    DATA_LIMITE DATE,
    ORDEM INT
)";
$conn->query($sql);


?>
