function atualizarTabela() {
   
    fetch('dadosTabela.php')
    .then(res => res.text())
    .then(html => {
  
        const tbody = document.getElementById('tabela-tarefas-body');
        if (tbody) {
            tbody.innerHTML = html;
        }
    });
}