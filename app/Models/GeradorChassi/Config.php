<?php
namespace App\Models\GeradorChassi;

use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;

define('DEFAULT_FONT', 'Arial');

class Config{
    private $phpWord;
    private $section;

    public function __construct($phpWord){
        $this->phpWord = $phpWord;
        $this->section = $this->sectionConfig();
    }

    public function getPHPWord(){
        return $this->phpWord;
    }

    public function getSection(){
        return $this->section;
    }

    private function sectionConfig(){
        $this->section = $this->phpWord->addSection(
            array(
                'marginLeft' => Converter::cmToTwip(3),
                'marginRight' => Converter::cmToTwip(2),
                'marginBottom' => Converter::cmToTwip(2),
                'headerHeight' => Converter::cmToTwip(4.3),
                'footerHeight' => Converter::cmToTwip(4),
            )
        );
        return $this->section;
    }

    // ----------------- FONTES ------------------
    public function arial12(){
        return array('bold' => false, 'size' => 12);
    }

    public function arial14Bold(){
        return array('bold' => true, 'size' => 14);
    }

    public function arial12Bold(){
        return array('bold' => true, 'size' => 12);
    }
    
    public function arial12Underline(){
        return array('bold' => false, 'size' => 12, 'underline' => 'single');
    }
    
    public function arial10Bold(){
        return array('bold' => true, 'size' => 10);
    }
    
    public function arial10(){
        return array('bold' => false, 'size' => 10);
    }


    // ----------------- PARÁGRAFOS - ALINHAMENTO ------------------
    public function paragraphJustify(){
        $paragraphJustify = 'justify';
        $this->phpWord->addParagraphStyle($paragraphJustify, array(
            'alignment' => Jc::BOTH,
            'spaceAfter' => Converter::cmToTwip(0.0),
            'spacing' => Converter::cmToTwip(0.10),
            'indentation' => array('firstLine' => Converter::cmToTwip(2.0))
        ));

        return $paragraphJustify;
    }

    public function paragraphCenter(){
        $paragraphCenter = 'center';
        $this->phpWord->addParagraphStyle($paragraphCenter, array(
            'alignment' => Jc::CENTER,
            'spaceAfter' => Converter::cmToTwip(0.85),
            'spaceBefore' => Converter::cmToTwip(1.27)
        ));
        return $paragraphCenter;
    }

    public function paragraphRight(){
        $paragraphRight = 'right';
        $this->phpWord->addParagraphStyle($paragraphRight, array(
            'alignment' => Jc::END,
            'spaceAfter' => Converter::cmToTwip(0.0)
        ));
        return $paragraphRight;
    }

    public function paragraphJustifyExam(){
        $paragraphJustifyExam = 'justifyExam';
        $this->phpWord->addParagraphStyle(
            $paragraphJustifyExam,
            array(
                'alignment' => Jc::BOTH,
                'indentation' => array('firstLine' => Converter::cmToTwip(2.0)),
                'spaceAfter' => Converter::cmToTwip(0.35),
                'spaceBefore' => Converter::cmToTwip(0.35)
            )
        );
        return $paragraphJustifyExam;
    }


    // ----------------- TABELA ------------------
    public function tabelaConfig(){
        $tabelaConfig = 'tabelaConfig';
        $this->phpWord->addTableStyle(
            $tabelaConfig,
            array(
                'borderSize' => 11,
                'borderColor' => '171819',
                'alignment' => JcTable::CENTER,
                'valign' => Jc::CENTER
            ),
            array('bgColor' => 'cecece')
        );
        return $tabelaConfig;
    }

    public function cellCenter(){
        return array('alignment' => Jc::CENTER, 'spaceAfter' => 50, 'spaceBefore' => 50);
    }

    public function fonteTabela(){
        return array('bold' => false, 'size' => 12, 'name' => 'Arial');
    }
    
    public function confTabela(){
        return array('boderTopColor' => '009900');
    }

}
