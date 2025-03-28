<?php



namespace App\Models\Gerador;

use App\Models\Outros_balistica;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
use PhpOffice\PhpWord\Style\Section;
use NumberFormatter;
use Illuminate\Http\UploadedFile;
class OutrosText 
{
    
    private $section, $i, $config, $phpWord;

    public function __construct($section, $config, $i,$phpWord)
    {
        
        $this->section = $section;
        $this->config = $config;
        $this->i = $i;
        $this->phpWord=$phpWord;
    }
    public function addText($outros,$laudo)
    {
        
        
        $indice= 1;
        $contador = 1;
        if (count($laudo->municoes) > 0 && count($laudo->armas) > 0 && count($laudo->componentes) > 0) {
            $indice = 5;
        } elseif (count($laudo->municoes) > 0 && count($laudo->armas) > 0) {
            $indice = 4;
        } elseif (count($laudo->municoes) > 0 && count($laudo->componentes) > 0) {
            $indice = 4;
        } elseif (count($laudo->armas) > 0 && count($laudo->componentes) > 0) {
            $indice = 4;
        } elseif (count($laudo->municoes) > 0) {
            $indice = 2;
        } elseif (count($laudo->armas) > 0) {
            $indice = 2;
        } elseif (count($laudo->componentes) > 0) {
            $indice = 2;
        } else {
            $indice = 1; // Caso nenhuma das condições seja atendida
        }
        

        foreach ($outros as $value) {
            $textrun = $this->section->addTextRun($this->config->paragraphJustify());
            $textrun->addText("3. $indice. $contador {$value['nome']} - LACRE DE ENTRADA {$value['lacre_entrada']}", $this->config->arial12Bold());
            
            $this->section->addText($value['descricao_item'], $this->config->arial12(),$this->config->paragraphJustify());
            $this->section->addTextBreak(1);
           
           // $image1 = 'app/public/'.$value['up_image'];
           // $image2 = 'app/public/'.$value['up_image2'];
           // $tempFilePath = storage_path('app/public/imagensOutros');
            

           
            //Adicionando imagens ao documento
            $table = $this->section->addTable('tabela2img');
            $table->addRow(); 
            $img2=$table->addCell();
            $img2->addImage('C:\xampp\htdocs\LaudosApp\copy_Balistica\public\storage\imagensOutros\514e83767d0062d0292d67906cbefb93.jpg', array('alignment' => Jc::CENTER, 'width' => 220));
            $img3= $table->addCell();
            $img3->addImage('C:\xampp\htdocs\LaudosApp\copy_Balistica\public\storage\imagensOutros\514e83767d0062d0292d67906cbefb93.jpg', array('alignment' => Jc::CENTER, 'width' => 220));
            $indice++;
            $contador++;
        }
        
    }
    //trnasformar a imagem em base64
    public function img64base($a){
        
        $imageR = $a; // decodifica do banco a image em base 64
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageR)); // tira #^data:image/\w+;base64,#i
        
        $tempFilePath = storage_path('app/public/imagensOutros'). '/' . uniqid() . '.jpg'; // cria um diretorio temporariosys_get_temp_dir() 
         file_put_contents($tempFilePath, $imageData);//colocar arquivo
         
        // quando a image vêm de um input do tipo file não precisa transforma em um objeto porque ela já é, porem quando ta em base64 sim ae se usa o UploadedFile
          $imageConvertida = new UploadedFile($tempFilePath, 'diario_num_one.jpg', 'image/jpeg', null, true);
       
            
        $fileC = file_get_contents($imageConvertida); //pegar arquivo
        return $fileC;
    }
}