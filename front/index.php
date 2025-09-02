<?php include 'header.php' ?>

<h1 id="titulo">Lista de Tarefas</h1>

<table class="table">
    <thead>
        <tr class="title">
            <th class="coluns">Nome da Tarefa</th>
            <th class="coluns">Custo (R$)</th>
            <th class="coluns">Data Limite</th>
            <th class="coluns">Ações</th>
        </tr>
    </thead>
   <tbody class="tabela-tarefas">
    <?php
    include 'dadosTabela.php';
    
    ?>
</tbody>
</table>

<div class="container">
    <a href="incluir.php"><button class="inserir" >Incluir Tarefa</button></a>
</div>

<div id="confirm-popup-overlay">
    <div id="confirm-popup-content">
        <h2>Confirmar Exclusão</h2>
        <p>Tem certeza que deseja excluir esta tarefa?</p>
        <button id="confirm-delete-btn">Sim, Excluir</button>
        <button id="cancel-delete-btn">Cancelar</button>
    </div>
</div>

<script src="validacao.js"></script>
<script src="editarTabela.js"></script>
<script src="reflesh.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script src="reordenar.js"></script>

<?php include 'footer.php' ?>