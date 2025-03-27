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

            $indice++;
            $contador++;
        }
        
    }
}