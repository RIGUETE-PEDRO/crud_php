<?php
include 'PropertiesConf.php';


$id_tarefa_movida = $_GET['id'] ?? 0;
$acao = $_GET['acao'] ?? '';


if (!$id_tarefa_movida || !in_array($acao, ['up', 'down'])) {
    header("Location: ../front/index.php");
    exit;
}

$conn->begin_transaction();

try {
    
    $stmt_atual = $conn->prepare("SELECT ORDEM FROM TAREFAS WHERE ID = ?");
    $stmt_atual->bind_param("i", $id_tarefa_movida);
    $stmt_atual->execute();
    $resultado_atual = $stmt_atual->get_result();
    $tarefa_atual = $resultado_atual->fetch_assoc();
    $ordem_atual = $tarefa_atual['ORDEM'];
    $stmt_atual->close();

    $sql_vizinho = "";
    if ($acao === 'up') {

        $sql_vizinho = "SELECT ID, ORDEM FROM TAREFAS WHERE ORDEM < ? ORDER BY ORDEM DESC LIMIT 1";
    } else {
   
        $sql_vizinho = "SELECT ID, ORDEM FROM TAREFAS WHERE ORDEM > ? ORDER BY ORDEM ASC LIMIT 1";
    }

    $stmt_vizinho = $conn->prepare($sql_vizinho);
    $stmt_vizinho->bind_param("i", $ordem_atual);
    $stmt_vizinho->execute();
    $resultado_vizinho = $stmt_vizinho->get_result();
    
   
    if ($resultado_vizinho->num_rows > 0) {
        $tarefa_vizinha = $resultado_vizinho->fetch_assoc();
        $id_vizinho = $tarefa_vizinha['ID'];
        $ordem_vizinho = $tarefa_vizinha['ORDEM'];

        
        $stmt_update1 = $conn->prepare("UPDATE TAREFAS SET ORDEM = ? WHERE ID = ?");
        $stmt_update1->bind_param("ii", $ordem_vizinho, $id_tarefa_movida);
        $stmt_update1->execute();
        $stmt_update1->close();

        $stmt_update2 = $conn->prepare("UPDATE TAREFAS SET ORDEM = ? WHERE ID = ?");
        $stmt_update2->bind_param("ii", $ordem_atual, $id_vizinho);
        $stmt_update2->execute();
        $stmt_update2->close();
    }
    $stmt_vizinho->close();

    
    $conn->commit();

} catch (Exception $e) {
   
    $conn->rollback();
}

$conn->close();


header("Location: ../front/index.php");
exit;
?>