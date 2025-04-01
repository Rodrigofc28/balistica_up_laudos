
document.addEventListener("DOMContentLoaded", function () {
    
    document.getElementById("itensAdd").addEventListener("click", function () {
        let bloquear = true;
        
        document.querySelectorAll("input[name='item']").forEach(input => {
            if (!input.dataset.incremented) {
                let valorAtual = parseInt(input.value, 10) || 0;
                input.value = valorAtual + 1;
                input.dataset.incremented = "true";
                
                let tr = input.closest("tr");
                let itemTd = tr.querySelector(".item" + input.dataset.id);
                if (itemTd) {
                    let itemValor = parseInt(itemTd.textContent.trim(), 10) || 0;
                    itemTd.textContent = input.value;
                    
                    if (parseInt(input.value, 10) !== itemValor) {
                        bloquear = false;
                    }
                }
            }
        });
        
        let botaoCadastrar = document.getElementById("dito_oficio");
        if (botaoCadastrar) {
            botaoCadastrar.disabled = bloquear;
        }
    });
});