document.getElementById("itensAdd").addEventListener("click", function() {
    let itemInput = document.getElementById("item");
    let btnCadastrar = document.getElementById("cadastrar_calibre");
    // Converte o valor atual para número e incrementa
    let valorAtual = parseInt(itemInput.value) || 0;
    itemInput.value = valorAtual + 1;
});