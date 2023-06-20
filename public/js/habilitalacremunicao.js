$('#nao_deflagrado').on('click', function () {
  
    if($('#lacrecartucho').attr('disabled')){
        $('#lacrecartucho').attr('disabled', false);
    }
    else{
        $('#lacrecartucho').attr('disabled', true);
    }
    
});