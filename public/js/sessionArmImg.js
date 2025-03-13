
//Função pega as variaveis de input de preview da imagem botoes de escala e rotação
 function click_input_file(inputFile,image,preview,imagemCanto,id_preview,rotateButton,quadradoArg,retanguloArg,retanguloPlusArg,scale) {
    
    
 document.getElementById(inputFile).click();
 
    var inputFile_ = document.getElementById(inputFile);
    var image = document.getElementById(image);
    var preview = document.getElementById(preview);
    var upImage = document.getElementById(imagemCanto); // Seu input de arquivo
    
    var prevFrente = id_preview
    var rotateButton = document.getElementById(rotateButton);
    
    var  quadrado=document.getElementById(quadradoArg)
    
    var retangulo=document.getElementById(retanguloArg)
    var retanguloPlus=document.getElementById(retanguloPlusArg)
    
    let cropper;
 //Função carrega a imagem no cropper    
 carrega(inputFile_,image,cropper,preview,upImage,rotateButton,prevFrente,scale,quadrado,retangulo,retanguloPlus)


}
//função de carregar a imagem que é passado a posição da imagem e o tipo de arma
function nextButton(arg,tipo){
    
        var inputFile ='';
        var image = '' ;
        var preview = '';
        var imagemCanto  = '';
        var id_preview  = '';
        var rotate = ''
        var quadradoArg = ''
        var retanguloArg = ''  
        var retanguloPlusArg = ''
        var scale='';
        
        if(arg=="dir"){
            
            inputFile = "inputFileDir"
            image = "image_dir"
            preview = "preview_dir"
            imagemCanto ="imagemCantoSuperior"
            rotate ="rotateButtonDir"
            id_preview = "#preview_dir"
            quadradoArg="quadradoDireita"
            retanguloArg="retanguloDireita"
            retanguloPlusArg="retanguloPlusDireita"
            if(tipo=="armaCurta"){
                scale = 2
            }else if(tipo=="armaLonga"){
                scale = 3
            }
            
            click_input_file(inputFile,image,preview,imagemCanto,id_preview,rotate,quadradoArg,retanguloArg,retanguloPlusArg,scale)
        }else if((arg=="esq")){
            inputFile = "inputFileEsq"
            image = "image_esq"
            preview = "preview_esq"
            imagemCanto ="imagemCantoInferior"
            id_preview = "#preview_esq"
            rotate="rotateButtonEsq"
            quadradoArg="quadradoEsquerda"
            retanguloArg="retanguloEsquerda"
            retanguloPlusArg="retanguloPlusEsquerda"
            if(tipo=="armaCurta"){
                scale = 2
            }else if(tipo=="armaLonga"){
                scale = 3
            }
        click_input_file(inputFile,image,preview,imagemCanto,id_preview,rotate,quadradoArg,retanguloArg,retanguloPlusArg,scale)
        
        }else if(arg=="serie"){
            inputFile = "inputFileSerie"
            image = "image_serie"
            preview = "preview_serie"
            imagemCanto ="imagemNumSerie"
            id_preview = "#preview_serie"
            rotate = "rotateButtonSerie"
            quadradoArg="quadradoSerie"
            retanguloArg="retanguloSerie"
            retanguloPlusArg="retanguloPlusSerie"
            scale = 1
        click_input_file(inputFile,image,preview,imagemCanto,id_preview,rotate,quadradoArg,retanguloArg,retanguloPlusArg,scale)
        }
       
}