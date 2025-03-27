document.addEventListener('DOMContentLoaded', function() {
    var selectElement = document.getElementById('modelossalvos');
    if (selectElement) {
        selectElement.addEventListener('change', function() {
            var buscaCadastroSalvo = this.value;
            
            try {
                var buscaCadastro = JSON.parse(buscaCadastroSalvo);
                
                
                var objetoBuscaCadastro = buscaCadastro;
                var marcaInput = document.getElementById('marca');
                var descricaoItemInput = document.getElementById('descricao_item');
                var nomeInput = document.getElementById('nome');
                if (nomeInput) {
                    nomeInput.value = objetoBuscaCadastro.nome;
                    nomeInput.dispatchEvent(new Event('change'));
                }
                if (descricaoItemInput) {
                    descricaoItemInput.value = objetoBuscaCadastro.descricao_item;
                    descricaoItemInput.dispatchEvent(new Event('change'));
                }
                if (marcaInput) {
                    marcaInput.value = objetoBuscaCadastro.marca;
                    marcaInput.dispatchEvent(new Event('change'));
                }
            } catch (error) {
                console.error('Erro ao processar JSON:', error);
            }
        });
    } else {
        console.error("Elemento com ID 'modelossalvos' não encontrado.");
    }
});


    