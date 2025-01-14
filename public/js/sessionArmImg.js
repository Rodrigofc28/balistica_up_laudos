

 function click_input_file(inputFile,image,preview,imagemCanto,id_preview,rotateButton) {
    
 document.getElementById(inputFile).click();
 
    var inputFile_ = document.getElementById(inputFile);
    var image = document.getElementById(image);
    var preview = document.getElementById(preview);
    var upImage = document.getElementById(imagemCanto); // Seu input de arquivo
    
    var prevFrente = id_preview
    var rotateButton = document.getElementById(rotateButton);
    let cropper;
 carrega(inputFile_,image,cropper,preview,upImage,rotateButton,prevFrente)


}

function nextButton(arg){
    
        var inputFile ='';
        var image = '' ;
        var preview = '';
        var imagemCanto  = '';
        var id_preview  = '';
        var rotate = ''
        if(arg=="dir"){
            
            inputFile = "inputFileDir"
            image = "image_dir"
            preview = "preview_dir"
            imagemCanto ="imagemCantoSuperior"
            rotate ="rotateButtonDir"
            id_preview = "#preview_dir"
            click_input_file(inputFile,image,preview,imagemCanto,id_preview,rotate)
        }else if((arg=="esq")){
            inputFile = "inputFileEsq"
            image = "image_esq"
            preview = "preview_esq"
            imagemCanto ="imagemCantoInferior"
            id_preview = "#preview_esq"
            rotate="rotateButtonEsq"
        click_input_file(inputFile,image,preview,imagemCanto,id_preview,rotate)
        
        }else if(arg=="serie"){
            inputFile = "inputFileSerie"
            image = "image_serie"
            preview = "preview_serie"
            imagemCanto ="imagemNumSerie"
            id_preview = "#preview_serie"
            rotate = "rotateButtonSerie"
        click_input_file(inputFile,image,preview,imagemCanto,id_preview,rotate)
        }
        document.getElementById("imagemCantoSuperior").addEventListener("change", function(event) {
            
            const file = event.target.files[0]; // Obtém o arquivo selecionado
        
            if (file) {
                const reader = new FileReader();
        
                // Evento disparado quando a leitura do arquivo termina
                reader.onload = function(e) {
                    const dataURL = e.target.result; // Data URL completo (MIME + Base64)
                    console.log("Data URL:", dataURL);
                };
        
                // Lê o arquivo e converte para Data URL (Base64 + MIME)
                reader.readAsDataURL(file);
            } else {
                console.error("Nenhum arquivo selecionado.");
            }
        });
}