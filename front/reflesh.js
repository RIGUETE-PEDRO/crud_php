function atualizarTabela() {
    fetch('dadosTabela.php')
    .then(res => res.text())
    .then(html => {
        document.getElementById('tabela-tarefas').innerHTML = html;
    });
}

setInterval(atualizarTabela, 1000);
