<?php


namespace App\Models\Gerador;
use App\Models\Laudo;
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
        $this->section->getSettings()->setFooterHeight(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5));// AJUSTE DO RODA PÉ PARA 1,5 CM
    }

    public function create_docx($laudo)
    {
        $tempoAtual = now();
        Laudo::where('id', $laudo->id)->update(['tempo_execucao' => $tempoAtual]);
        global $itensCartuchoTeste;
        $itensCartuchoTeste = []; //variavel criada para a conclusão de laudo de cartucho, para mostrar a eficiencia ou não do cartucho.
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
        //armas
        if($laudo->laudoEfetConst != 'B601'){
            $armasText = new ArmasText($this->section, $this->conf, $i,$this->phpWord);
            
            $armasText = $armasText->addText($laudo);
            }
        $i++;
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
  
       
        //texto final
        $this->geral->addFinalText($laudo);

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
