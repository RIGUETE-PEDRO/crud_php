<?php
include 'PropertiesConf.php';

// Pega o ID da tarefa e a ação ('up' ou 'down') da URL
$id_tarefa_movida = $_GET['id'] ?? 0;
$acao = $_GET['acao'] ?? '';

// Se os parâmetros estiverem inválidos, apenas redireciona de volta
if (!$id_tarefa_movida || !in_array($acao, ['up', 'down'])) {
    header("Location: ../front/index.php");
    exit;
}

// Inicia uma transação para garantir que a troca seja segura
$conn->begin_transaction();

try {
    // 1. Busca a ordem da tarefa que queremos mover
    $stmt_atual = $conn->prepare("SELECT ORDEM FROM TAREFAS WHERE ID = ?");
    $stmt_atual->bind_param("i", $id_tarefa_movida);
    $stmt_atual->execute();
    $resultado_atual = $stmt_atual->get_result();
    $tarefa_atual = $resultado_atual->fetch_assoc();
    $ordem_atual = $tarefa_atual['ORDEM'];
    $stmt_atual->close();

    $sql_vizinho = "";
    if ($acao === 'up') {
        // 2. Encontra a tarefa vizinha de CIMA
        $sql_vizinho = "SELECT ID, ORDEM FROM TAREFAS WHERE ORDEM < ? ORDER BY ORDEM DESC LIMIT 1";
    } else { // 'down'
        // 2. Encontra a tarefa vizinha de BAIXO
        $sql_vizinho = "SELECT ID, ORDEM FROM TAREFAS WHERE ORDEM > ? ORDER BY ORDEM ASC LIMIT 1";
    }

    $stmt_vizinho = $conn->prepare($sql_vizinho);
    $stmt_vizinho->bind_param("i", $ordem_atual);
    $stmt_vizinho->execute();
    $resultado_vizinho = $stmt_vizinho->get_result();
    
    // 3. Se existe uma tarefa vizinha para trocar de lugar...
    if ($resultado_vizinho->num_rows > 0) {
        $tarefa_vizinha = $resultado_vizinho->fetch_assoc();
        $id_vizinho = $tarefa_vizinha['ID'];
        $ordem_vizinho = $tarefa_vizinha['ORDEM'];

        // 4. Faz a troca (SWAP) das ordens
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

    // 5. Confirma todas as alterações no banco de dados
    $conn->commit();

} catch (Exception $e) {
    // Se qualquer passo falhar, desfaz todas as alterações
    $conn->rollback();
}

$conn->close();

// 6. Redireciona de volta para a página principal para ver o resultado
header("Location: ../front/index.php");
exit;
?>