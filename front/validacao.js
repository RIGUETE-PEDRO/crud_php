
// Pega os elementos do pop-up
const popup = document.getElementById('confirm-popup-overlay');
const confirmBtn = document.getElementById('confirm-delete-btn');
const cancelBtn = document.getElementById('cancel-delete-btn');


function abrirConfirmacaoExclusao(id) {

    popup.style.display = 'flex';
    
 
    confirmBtn.setAttribute('data-id', id);
}


cancelBtn.addEventListener('click', () => {
    popup.style.display = 'none';
});


confirmBtn.addEventListener('click', () => {

    const id = confirmBtn.getAttribute('data-id');
    
    
    window.location.href = `/back/excluir.php?id=${id}`;
});
