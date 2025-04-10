$(document).ready(function () {
    $.fn.select2.defaults.set("theme", "bootstrap");

    $('.js-single-cidades').select2({
        placeholder: "Selecione uma Cidade",
        language: 'pt-BR'
    });

    $('.js-single-solicitante').select2({
        placeholder: "Selecione um Órgão Solicitante",
        language: 'pt-BR'
    });

    $('.js-single-secoes, .js-single-diretores, .js-cidade-modal').select2({
        language: 'pt-BR'
    });

    $('.js-single-marcas').select2({
        placeholder: "Selecione uma Marca",
        language: 'pt-BR'
    });
    $('.js-single-calibres').select2({
        placeholder: "Selecione um Calibre",
        language: 'pt-BR'
    });
    

    $('.js-single-origens').select2({
        placeholder: "Selecione um País de Origem",
        language: 'pt-BR'
    });
    $('.js-single-select').select2({
        placeholder: "Selecione",
        language: 'pt-BR',
        minimumResultsForSearch: -1
    });
    $('.js-single').select2({
        language: 'pt-BR',
        minimumResultsForSearch: -1
    });

    $(".js-multiple-limit").select2({
        language: 'pt-BR',
        maximumSelectionLength: 5,
        placeholder: "Clique para selecionar (opcional)",
    });
    $(".js-multiple-limit-calibre").select2({
        language: 'pt-BR',
        maximumSelectionLength: 5,
        placeholder: "Selecione",
    });
});

$(".tamanho").mask('999,9');
$(".quantidade").mask('999,9');

$(".cep").mask('99999999');

