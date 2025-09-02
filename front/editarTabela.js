function alternarEdicao(id) {
    const linha = document.getElementById(`linha-${id}`);
    

    const elementosParaAlternar = linha.querySelectorAll(
        '.texto, .campo-edicao, .icone-editar, .icone-salvar, .icone-cancelar'
    );

    elementosParaAlternar.forEach(el => {
        el.style.display = el.style.display === 'none' ? '' : 'none';
    });
}
    


function salvarEdicao(id) {
    const linha = document.getElementById(`linha-${id}`);
    const campos = linha.querySelectorAll('.campo-edicao');
    
    const dadosParaSalvar = {
        id: id,
        nome: campos[0].value,
        custo: campos[1].value,
        data_limite: campos[2].value
    };

    
    fetch('/back/atualizar.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(dadosParaSalvar),
    })
    .then(response => response.json())
    .then(data => {
        if (data.sucesso) {
          
            linha.querySelector('.texto-nome').textContent = dadosParaSalvar.nome;
            let custoFormatado = parseFloat(dadosParaSalvar.custo).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            linha.querySelector('.texto-custo').textContent = custoFormatado.replace('R$', '').trim();
            let [ano, mes, dia] = dadosParaSalvar.data_limite.split('-');
            linha.querySelector('.texto-data').textContent = `${dia}/${mes}/${ano}`;
            
            
            alternarEdicao(id);
        } else {
           
            alert('Erro ao salvar: ' + data.erro);
        }
    })
    .catch(error => {
        console.error('Erro na requisição:', error);
        alert('Ocorreu um erro de comunicação. Tente novamente.');
    });
}

