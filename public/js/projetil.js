$('#tipo_projetil').on('change',function(){
    
    if($('#tipo_projetil').val()=='Núcleo'){
        
        $('#cavados').attr('disabled',true)
        $('#ressaltos').attr('disabled',true)
        $('#tipo_raiamento').attr('disabled',true)
        $('#sentido_raias').attr('disabled',true)
    }
    else{
        $('#cavados').attr('disabled',false)
        $('#ressaltos').attr('disabled',false)
        $('#tipo_raiamento').attr('disabled',false)
        $('#sentido_raias').attr('disabled',false)
    }
    
    }
    
)