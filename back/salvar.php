<?php
session_start();
include 'PropertiesConf.php';

// Recebe os valores do POST
$valores = [
    'nome' => $_POST['nome'] ?? '',
    'custo' => $_POST['custo'] ?? '',
    'data_limite' => $_POST['data_limite'] ?? ''
];

$status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validação básica
    if (empty($valores['nome']) || empty($valores['custo']) || empty($valores['data_limite'])) {
        $status = "Todos os campos são obrigatórios!";
    } else {
        // Verifica se já existe
        $stmtcheck = $conn->prepare("SELECT ID FROM TAREFAS WHERE NOME = ?");
        $stmtcheck->bind_param("s", $valores['nome']);
        $stmtcheck->execute();
        $stmtcheck->store_result();

        if($stmtcheck->num_rows > 0){
            $status = "Já existe uma tarefa com esse nome";
        } else {
            $stmtcheck->close();

            // Próxima ordem
            $resultado = $conn->query("SELECT MAX(ORDEM) AS max_ordem FROM TAREFAS");
            $row = $resultado->fetch_assoc();
            $proxima_ordem = $row['max_ordem'] + 1;

            // Insere no banco
            $stmt = $conn->prepare("INSERT INTO TAREFAS (NOME, CUSTO, DATA_LIMITE, ORDEM) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sdsi", $valores['nome'], $valores['custo'], $valores['data_limite'], $proxima_ordem);

            if ($stmt->execute()) {
                $status = "Tarefa salva com sucesso!";
                $valores = ['nome'=>'','custo'=>'','data_limite'=>'']; // limpa campos
            } else {
                $status = "Erro ao salvar tarefa: " . $stmt->error;
            }

            $stmt->close();
        }
    }

    $conn->close();

    // Salva status e valores na session
    $_SESSION['status'] = $status;
    $_SESSION['valores'] = $valores;

    // Redireciona para a página de inclusão
    header("Location: ../front/incluir.php");
    exit;
}
?>
