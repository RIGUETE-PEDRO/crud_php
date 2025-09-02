<?php
include 'PropertiesConf.php';


header('Content-Type: application/json');


$dados = json_decode(file_get_contents('php://input'), true);


if (empty($dados['id']) || !isset($dados['nome']) || !isset($dados['custo']) || !isset($dados['data_limite'])) {
    echo json_encode(['sucesso' => false, 'erro' => 'Dados incompletos.']);
    exit;
}

$id = $dados['id'];
$nome = trim($dados['nome']);
$custo = $dados['custo'];
$data_limite = $dados['data_limite'];


$stmtCheck = $conn->prepare("SELECT ID FROM TAREFAS WHERE NOME = ? AND ID != ?");
$stmtCheck->bind_param("si", $nome, $id);
$stmtCheck->execute();
$stmtCheck->store_result();

if ($stmtCheck->num_rows > 0) {

    echo json_encode(['sucesso' => false, 'erro' => 'Este nome de tarefa já existe. A alteração não foi salva.']);
    $stmtCheck->close();
    $conn->close();
    exit;
}
$stmtCheck->close();


$stmtUpdate = $conn->prepare("UPDATE TAREFAS SET NOME = ?, CUSTO = ?, DATA_LIMITE = ? WHERE ID = ?");
$stmtUpdate->bind_param("sdsi", $nome, $custo, $data_limite, $id);

if ($stmtUpdate->execute()) {

    echo json_encode(['sucesso' => true]);
} else {

    echo json_encode(['sucesso' => false, 'erro' => $stmtUpdate->error]);
}

$stmtUpdate->close();
$conn->close();
?>