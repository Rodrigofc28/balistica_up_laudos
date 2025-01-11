export default class RedimensionaImage {
    constructor(inputId, verificadorId, divCrop, botaoRotate, arg1,croppieInstances) {
        this.inputId = inputId;
        this.verificadorId = verificadorId;
        this.divCrop = divCrop;
        this.botaoRotate = botaoRotate;
        this.croppieInstances = {}; // Armazena as instâncias do Croppie
        this.arg1 = arg1; // Array para distinguir múltiplas instâncias
    }

    click_input_file(icon, file_input) {
        document.getElementById(icon).addEventListener('click', () => {
            document.getElementById(file_input).click();
        });
        this.carregando_img()
    }

    salvaContinuar(imagem1, imagem2) {
        const img1 = document.getElementById(imagem1);
        const img2 = document.getElementById(imagem2);
        const fileimg1 = img1.files[0];
        const fileimg2 = img2.files[0];

        if (!fileimg1 || !fileimg2) {
            document.querySelector('.msgErro').style.display = 'block';
        } else {
            document.querySelector('.msgErro').style.display = 'none'; //mudar msgErro
            document.getElementById('uploadForm').submit(); // mudar uploadForm
        }
    }

    processImage() {
        const croppieInstances = this.croppieInstances;

        // Itera sobre o array `arg1` para processar múltiplas imagens
       
            if (croppieInstances[this.arg1]) {
                croppieInstances[this.arg1].destroy(); // Destroi a instância anterior
                croppieInstances[this.arg1] = null;
            }
            console.log(croppieInstances[this.arg1])
            const input = document.getElementById(this.inputId);
            const verificador = document.getElementById(this.verificadorId);
            const file = input.files[0];

            if (file) {
                verificador.style.display = 'block';
                document.querySelector('.msgErro').style.display = 'none';

                const el = document.getElementById(this.divCrop);
                croppieInstances[this.arg1] = new Croppie(el, {
                    viewport: { width: 200, height: 200, type: 'square' },
                    boundary: { width: '100%', height: '100%' },
                    enableOrientation: true,
                    mouseWheelZoom: 'ctrl',
                });

                croppieInstances[this.arg1].bind({
                    url: URL.createObjectURL(file),
                });
                
                document.getElementById(this.botaoRotate).addEventListener('click', () => {
                    croppieInstances[this.arg1].rotate(90);
                });

            } else {
                verificador.style.display = 'none';
            }
        
    }

    carregando_img() {
        // Itera sobre os inputs associados ao array
        
            document.getElementById(this.inputId).addEventListener('change', () => {
                this.processImage();
            });
        
    }
    get_croppie() {
        return this.divCrop;
    }

    // Método para acessar as instâncias de Croppie
    get_croppieInstances() {
        return this.croppieInstances[this.arg1];
    }

    // Método para acessar o ID do input
    get_input() {
        return this.inputId;
    }
}
