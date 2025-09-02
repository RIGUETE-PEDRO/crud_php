<?php include 'header.php'?>

    <h1 id="titulo">Lista de Tarefas</h1>

    <table class="table">
        <thead >
            <tr>
                <th>Nome da Tarefa</th>
                <th>Custo (R$)</th>
                <th>Data Limite</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody class="tabela-tarefas">
            <?php 
              include 'dadosTabela.php'
            ?>
        </tbody>
    </table>
    
    <a href="incluir.php"><button class="inserir">Incluir Tarefa</button></a>
    <script src="reflesh.js"></script>
<?php include 'footer.php'?>