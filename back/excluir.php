<?php
include 'PropertiesConf.php';

$id = $_GET['id'] ?? 0;

if ($id) {
    $stmp = $conn->prepare("DELETE FROM TAREFAS WHERE ID = ?");
    $stmp->bind_param("i", $id);
    if ($stmp->execute()) {
        "tarefa excluida com sucesso";
    } else {
        "Erro ao excluir: " . $stmt->error;
    }
}
$conn->close();
 header("Location: ../front/index.php");
    exit;

?>
