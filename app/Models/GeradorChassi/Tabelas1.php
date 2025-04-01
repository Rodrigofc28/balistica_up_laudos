<?php
namespace App\Models\GeradorChassi;

use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\Border;
use Illuminate\Support\Facades\DB;

class Tabelas1
{
    public function __construct(){
    }

    public function criarTabela($section, $config, $phpWord/*, $laudo, $chassi*/){
        $this->section = $section;
        $this->config = $config;
        $this->phpWord = $phpWord;

        $styleName = 'TabelaEstilo'; // Nome do Estilo

        $styleTable = [ // Estilo da Tabela
            'width' => 9072,
            'borderSize' => 15, // Espessura da borda (10 = 0.15pt)
            'borderColor' => 'CCCCCC', // Cor da borda (cinza)
            'cellMargin' => 100, // Margem interna da célula
            'valign' => 'center'
        ];

        $styleFirstRow = [ // Estilo da Primeira Linha $firstRowStyle
            'bgColor' => 'CCCCCC' // Cor de fundo da primeira linha (cinza)
        ];

        $phpWord->addTableStyle($styleName, $styleTable);

        $table = $section->addTable($styleName); // Usa o estilo criado

        // Adiciona a primeira linha (vai aplicar o fundo cinza e o negrito)
        $table->addRow();
        $table->addCell(0, $styleFirstRow)->addText('Cabeçalho 1', $config->arial10Bold(), $config->cellCenter());

        // Adiciona uma linha normal (sem o estilo especial da primeira linha)
        $table->addRow();
        $table->addCell()->addText('Dado 1');
        $table->addCell()->addText('Dado 2');

    }

}