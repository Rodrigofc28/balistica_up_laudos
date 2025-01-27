<?php


namespace App\Models\GeradorChassi;
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
    }

    public function create_docx($laudo)
    {
        $tempoAtual = now();
        Laudo::where('id', $laudo->id)->update(['tempo_execucao' => $tempoAtual]);

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
