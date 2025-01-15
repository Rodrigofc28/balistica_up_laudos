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
           var imagemBase  = '';
           var imagemLateral  = '';
           var id_preview  = '';
           var rotate = ''
           
           if(arg=="base"){
              
               inputFile = "inputFileBase"
               image = "imageBase"
               preview = "previewBase"
               imagemBase ="up_image"
               rotate ="rotateButtonbase"
               id_preview = "#previewBase"
                
               click_input_file(inputFile,image,preview,imagemBase,id_preview,rotate)
           }else if((arg=="lateral")){

                inputFile = "inputFileLateral"
                image = "imageLateral"
                preview = "previewLateral"
                imagemLateral ="up_image2"
                id_preview = "#previewLateral"
                rotate="rotateButtonLateral"
                
                click_input_file(inputFile,image,preview,imagemLateral,id_preview,rotate)
           
           }
        
   }