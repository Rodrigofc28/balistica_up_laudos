document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("itensAdd").addEventListener("click", function () {
        document.querySelectorAll("input[name='item']").forEach(input => {
            if (!input.dataset.incremented) {
                let valorAtual = parseInt(input.value, 10) || 0;
                input.value = valorAtual + 1;
                input.dataset.incremented = "true";
                
                let tr = input.closest("tr");
                let itemTd = tr.querySelector(".item" + input.dataset.id);
                if (itemTd) {
                    itemTd.textContent = input.value;
                }
            }
        });
    });
});