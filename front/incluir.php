<?php 
session_start();


$status = $_SESSION['status'] ?? '';
$valores = $_SESSION['valores'] ?? ['nome'=>'','custo'=>'','data_limite'=>''];

// Limpa session após ler
unset($_SESSION['status'], $_SESSION['valores']);

include 'header.php'; 
?>

<?php if ($status): ?>
    <p style="color: <?php echo strpos($status, 'sucesso') !== false ? 'green' : 'red'; ?>;">
        <?php echo htmlspecialchars($status); ?>
    </p>
<?php endif; ?>

<h1 class="title-inclusao">Incluir Nova Tarefa</h1>

<form method="POST" action="../back/salvar.php">
    <label>Nome da Tarefa:</label>
    <input type="text" name="nome" required value="<?php echo htmlspecialchars($valores['nome']); ?>"><br><br>

    <label>Custo (R$):</label>
    <input type="number" step="0.01" name="custo" required value="<?php echo htmlspecialchars($valores['custo']); ?>"><br><br>

    <label>Data Limite:</label>
    <input type="date"  name="data_limite" required value="<?php echo htmlspecialchars($valores['data_limite']); ?>"><br><br>

    <button type="submit">Salvar</button>

    <button type="button" onclick="window.location.href='index.php'" class="voltar">Voltar</button>
</form>



<?php include 'footer.php'; ?>
