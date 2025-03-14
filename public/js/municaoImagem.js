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
  //função de carregar a imagem que é passado a posição da imagem 
   function nextButton(arg){
       
           var inputFile ='';
           var image = '' ;
           var preview = '';
           var imagemBase  = '';
           var imagemLateral  = '';
           var id_preview  = '';
           var rotate = ''
           var quadradoArg = ''
           var retanguloArg = ''  
            var retanguloPlusArg = ''
            var scale='';
           if(arg=="base"){
              
               inputFile = "inputFileBase"
               image = "imageBase"
               preview = "previewBase"
               imagemBase ="up_image"
               rotate ="rotateButtonbase"
               id_preview = "#previewBase"
               quadradoArg="quadradoBase"
               retanguloArg="retanguloBase"
               retanguloPlusArg="retanguloPlusBase"
               scale = 2
               click_input_file(inputFile,image,preview,imagemBase,id_preview,rotate,quadradoArg,retanguloArg,retanguloPlusArg,scale)
           }else if((arg=="lateral")){

                inputFile = "inputFileLateral"
                image = "imageLateral"
                preview = "previewLateral"
                imagemLateral ="up_image2"
                id_preview = "#previewLateral"
                rotate="rotateButtonLateral"
                quadradoArg="quadradoLateral"
                retanguloArg="retanguloLateral"
                retanguloPlusArg="retanguloPlusLateral"
                scale = 2
                click_input_file(inputFile,image,preview,imagemLateral,id_preview,rotate,quadradoArg,retanguloArg,retanguloPlusArg,scale)
           
           }
        
   }