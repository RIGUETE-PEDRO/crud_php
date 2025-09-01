<?php


$host = "localhost";
$db   = "TAREFAS";
$user = "tarefas";
$pass = "tarefa@123";


$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

?>