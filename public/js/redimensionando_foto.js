export default class RedimensionaImage {
    
    constructor(inputFile,image,preview,input_img,rotateButton,sentido) {
       this.inputFile = inputFile;
       this.image = image;
       this.preview = preview;
       this.input_img = input_img;
       this.rotateButton = rotateButton;
       this.sentido = sentido;  
       this.cropper = null;
    }
    carrega(){
        this.inputFile.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
              const reader = new FileReader();
    
              reader.onload = () => {
                this.image.src = reader.result; // Define o src da imagem
                this.image.style.display = 'block'; // Exibe a imagem
    
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
                  preview: '.preview', // Atualiza automaticamente a pré-visualização
                  ready() {
                    console.log('Cropper pronto!'); // Verifica quando o cropper está pronto
                  },
                  crop() {
                    const canvas = cropper.getCroppedCanvas({
                      width: 200, // Largura do canvas
                      height: 200, // Altura do canvas
                    });
    
                    this.preview.innerHTML = ''; // Limpa a pré-visualização anterior
                    const croppedImage = document.createElement(sentido);
                    croppedImage.src = canvas.toDataURL(); // Converte o canvas para DataURL
                    this.preview.appendChild(croppedImage); // Adiciona a nova imagem cortada
                    canvas.toBlob((blob) => {
                    const file = new File([blob], "cropped-image.png", { type: 'image/png' });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file); // Adiciona o arquivo ao DataTransfer
    
                    // Simula a seleção do arquivo
                    this.input_img.files = dataTransfer.files;
                    }, 'image/png');
                    
                  },
                });
              };
    
              reader.readAsDataURL(file); // Lê o arquivo como DataURL
            } else {
              alert('Por favor, selecione um arquivo de imagem válido.');
            }
          });
    }
    botaoRotate(){
        
    }
   
}
