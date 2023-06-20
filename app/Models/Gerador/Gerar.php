<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Models\Gerador;

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Style\Language;
use NumberFormatter;
$i=0;
class Gerar
{
    private $phpWord;
    private $section;
    private $conf;
    private $phpW;
    private $geral;

    public function __construct()
    {
        $this->phpWord = new PhpWord();
        $this->conf = new Config($this->phpWord);
        $this->section = $this->conf->getSection();
        $this->phpW = $this->phpWord;
    }

    public function create_docx($laudo)
    {
        
        global $i;
        $i = 0;

        global $numTab;
        $numTab=2;
        if(count($laudo->imagens)>0){
            $numTab+=1;
        }

        $this->phpW->getSettings()->setThemeFontLang(new Language(Language::PT_BR));
        Settings::setOutputEscapingEnabled(true);

        $this->geral = new Geral($this->section, $this->conf, $this->phpW);
        $this->geral->addText($laudo);
        
        //projetil
        if(empty($laudo->componentes[0])!=true){ //verificando se tem tabela componentes(projetil)
        $componentesText = new ComponentesText($this->section, $this->conf,$i,$this->phpWord,$numTab);
        $componentesText = $componentesText->addText($laudo->componentes,$laudo);
        
        }
        if((count($laudo->componentes)>0)&&(count($laudo->componentes)<5)){
                $i=1;
            
        }
        if((count($laudo->componentes)>5&&count($laudo->componentes)<10)){
                $i=2;
            }
            if((count($laudo->componentes)>10)&&(count($laudo->componentes)<15)){
                $i=3;
            }
        $i++;
        //cartucho
        
        if(empty($laudo->municoes[0])!=true){
        $municoesText = new MunicoesText($this->section, $this->conf,$i, $this->phpWord);
        $municoesText = $municoesText->addText($laudo->municoes,$laudo);
        
           }
         
        //estojo   
        $estojosText = new MunicoesText($this->section, $this->conf,$i, $this->phpWord);
        $estojosText = $estojosText->addTextEstojo($laudo->municoes,$laudo);        
  
        //Armas
        
        if($laudo->laudoEfetConst != 'constatacao'){
        $armasText = new ArmasText($this->section, $this->conf, $i,$this->phpWord);
        $armasText = $armasText->addText($laudo);
        }
       

        //texto final
        $this->geral->addFinalText($laudo->perito->nome,$laudo);


        //footer
        $footer=$this->section->addFooter();
        $footer->addLine(array(
            'width' => 445,
            'height' => 60,
            'positioning' => 'relative',
            
            'left' => 500,
            'top' => -500,
            'rotation' => 90
          ));
       /*  $source = public_path('image/linhadiagonal.png'); 
        
        $fileContent = file_get_contents($source);
        $footer->addImage($source, array(
            'width' => 455,
            'height' => 80,
            'align' => 'center',
            'border' => 0));  */



        $objWriter = IOFactory::createWriter($this->phpW, 'Word2007');

        $nome_arquivo = 'Laudo ' . str_replace("/", "-", $laudo->rep) . '.docx';

        if (!is_dir(storage_path('/laudos'))) {
            mkdir(storage_path('/laudos'), 0755, true);
        };

        try {
            $objWriter->save(storage_path('laudos/' . $nome_arquivo));
        } catch (Exception $e) {
            echo "erro";
        }
        return response()->download(storage_path('laudos/' . $nome_arquivo));

    }

    
}
