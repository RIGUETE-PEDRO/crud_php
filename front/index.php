<?php include 'header.php' ?>

<h1 id="titulo">Lista de Tarefas</h1>

<table class="table">
    <thead>
        <tr class="title">
            <th>Nome da Tarefa</th>
            <th>Custo (R$)</th>
            <th>Data Limite</th>
            <th >Ações</th>
        </tr>
    </thead>
    <tbody class="tabela-tarefas">
        <div id="confirm-popup-overlay">
            <div id="confirm-popup-content">
                <h2>Confirmar Exclusão</h2>
                <p>Tem certeza que deseja excluir esta tarefa?</p>
                <button id="confirm-delete-btn">Sim, Excluir</button>
                <button id="cancel-delete-btn">Cancelar</button>
            </div>
        </div>
        <?php
        include 'dadosTabela.php';
        ?>
    </tbody>
</table>
<div class="container">
    <a href="incluir.php"><button class="inserir">Incluir Tarefa</button></a>
</div>
<script src="reflesh.js"></script>
<script src="validacao.js"></script>
<?php include 'footer.php' ?>