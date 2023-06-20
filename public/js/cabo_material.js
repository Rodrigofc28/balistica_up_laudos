//Habilitando o input  cabo_outra_opcao, acabamento_outra_opcao
$('#cabo').on('change',function(){
    
    if($('#cabo').val()=='outros'){
        
        $('#cabo_outra_opcao').attr('disabled',false);
    }
    else
        $('#cabo_outra_opcao').attr('disabled',true);
})
//------------------------------------------------------------
$('#tipo_acabamento').on('change',function(){
    console.log($('#tipo_acabamento').val());
    if($('#tipo_acabamento').val()=='outros'){
        
        $('#acabamento_outra_opcao').attr('disabled',false);
    }
    else
        $('#acabamento_outra_opcao').attr('disabled',true);
})
