

      
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
              aspectRatio: 2, // Proporção do quadrado
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
                console.log('Cropper pronto !'); // Verifica quando o cropper está pronto
                
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
                  const randomString = Math.random().toString(36).substring(2, 10); // Gera uma string aleatória
                  const fileName = `cropped-image-${randomString}.png`; // Concatena o nome com o random
                  
                  const file = new File([blob], fileName, { type: 'image/png' });
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
  
   