
//Frente Embalagens
    function click_input_file(file_input) {
            
            document.getElementById(file_input).click();
            let inputFile = document.getElementById('inputFile');
            let image = document.getElementById('image');
            let preview = document.getElementById('preview');
            let upImage = document.getElementById('upImage'); // Seu input de arquivo
            let prevFrente = "#preview"
            let rotateButton = document.getElementById('rotateButton');
            let cropper;
            carrega(inputFile,image,cropper,preview,upImage,rotateButton,prevFrente)
        
       
    }
    //Verso Embalagens
    function click_input_file1(file_input) {
            
            document.getElementById(file_input).click();
            let inputFile = document.getElementById('inputFile1');
            let image = document.getElementById('image1');
            let preview1 = document.getElementById('prev');
            let preVerso = "#prev"
            let upImage = document.getElementById('upImage2'); // Seu input de arquivo
            let rotateButton = document.getElementById('rotateButton1');
            let cropper;
            carrega(inputFile,image,cropper,preview1,upImage,rotateButton,preVerso)
        
       
    }
      
   // função pra pra redimensiona
    function carrega(inputFile,image,cropper,preview,upImage,rotateButton,pre){
        
        inputFile.addEventListener('change', (event) =>{
        const file = event.target.files[0];
        if (file && file.type.startsWith('image/')) {
          const reader = new FileReader();

          reader.onload = () => {
            image.src = reader.result; // Define o src da imagem
            image.style.display = 'block'; // Exibe a imagem

            if (cropper) {
              cropper.destroy(); // Remove o cropper anterior, se existir
            }

            // Inicializa o Cropper.js
            cropper = new Cropper(image, {
              aspectRatio: 1, // Proporção do quadrado
              viewMode: 0, // Garante que a área visível esteja dentro dos limites
              autoCrop: true, // Habilita o crop box automaticamente
              autoCropArea: 0.8, // Define 80% da imagem como área inicial de corte
              movable: true, // Permite mover o crop box
              zoomable: true, // Permite dar zoom na imagem
              scalable: true, // Permite redimensionar
              highlight: true, // Destaca a área de corte
              guides: true, // Mostra as linhas-guia dentro do crop box
              background: true, // Exibe o fundo sombreado
              cropBoxResizable: true, // Permite redimensionar o crop box
              preview: pre, // Atualiza automaticamente a pré-visualização
              ready() {
                console.log('Cropper pronto!'); // Verifica quando o cropper está pronto
              },
              crop() {
                const canvas = cropper.getCroppedCanvas({
                  width: 200, // Largura do canvas
                  height: 200, // Altura do canvas
                });

                preview.innerHTML = ''; // Limpa a pré-visualização anterior
                const croppedImage = document.createElement('img');
                croppedImage.src = canvas.toDataURL(); // Converte o canvas para DataURL
                preview.appendChild(croppedImage); // Adiciona a nova imagem cortada
                canvas.toBlob((blob) => {
                const file = new File([blob], "cropped-image.png", { type: 'image/png' });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file); // Adiciona o arquivo ao DataTransfer

                // Simula a seleção do arquivo
                upImage.files = dataTransfer.files;
                }, 'image/png');
              
              },
            });
          };

          reader.readAsDataURL(file); // Lê o arquivo como DataURL
        } else {
          alert('Por favor, selecione um arquivo de imagem válido.');
        }
      })
      rotateButton.addEventListener('click', () => {
        if (cropper) {
          cropper.rotate(90); // Rotaciona a imagem 90 graus no sentido horário
        }
  });}
   // função pra salva embalagens
    function salvaContinuar(imagem1, imagem2) {
            const img1 = document.getElementById(imagem1);
            const img2 = document.getElementById(imagem2);
            const fileimg = img1.files[0];
            const fileimg2 = img2.files[0];

            
            if (!fileimg || !fileimg2) {
                document.querySelector('.msgErro').style.display = 'block';
            } else {
                document.querySelector('.msgErro').style.display = 'none';
                
                document.getElementById('uploadForm').submit();
            }
        }
        // função pra chama a imagem
    function next(arg){
        if(arg=="seta_verso"){
            
            click_input_file1('inputFile1')
        }else if((arg=="seta_frente")){
            
            click_input_file('inputFile')
        }
          
    }