/*
* Componentes
*/

$(function () {
    let campo2 = $('#altura_projetil');
    let campo1 = $('#calibre_real_medio');
    let selectCalibre = $('#calibre');

    // Inicialmente desabilita o campo
    campo2.prop('disabled', true);
    campo1.prop('disabled', true);
    selectCalibre.on('change', function () {
        let selectedValue = $(this).val().trim(); // Obtém o valor selecionado
        

        if (selectedValue === "sem") {
            campo2.prop('disabled', false);
            campo1.prop('disabled', false);
        } else {
            campo2.prop('disabled', true);
            campo1.prop('disabled', true);
        }
    });
});
