<?php
namespace App\Models\Gerador;

use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\Border;
use Illuminate\Support\Facades\DB;

class Tabelas{
    //configuração da tabela
    private $fontStyle = array('bold' => true);
    private $paraStyle = array('align' => 'center');
    private $styleTable = array('borderColor' => '777777', 'borderSize' => 10, 'cellMarginTop' => 10, 'cellMarginLeft' => 0, 'cellMarginRight' => 0, 'cellSpacing' => 10000); //configuração da borda
    private $styleFirstRow = array('bgColor' => ' #F0FFFF');
    private $cellStyle = array('borderSize' => 50);

    //adicionando a tabela
    protected function tabelaExame($phpWord, $section, $config, $laudo)
    {
        $this->phpWord->addTableStyle('tabela', $this->styleTable, $this->styleFirstRow);

        $text = [
            $table = $this->section->addTable('tabela'),
            $table->addRow(10, ['tblHeader' => true]),
            $table->addCell(null, ['bgColor' => 'd3d3d3'])->addText('TABELA 2 – MATERIAL ENCAMINHADO A EXAME', $this->fontStyle, $this->paraStyle),//cabeçalho tabela
            $table->addRow(10, ['tblHeader' => true]),
            $table->addCell(null)->addText('Item', $this->fontStyle, $this->paraStyle),
            $table->addCell()->addText('Natureza', $this->fontStyle, $this->paraStyle),
            $table->addCell()->addText('Quantidade', $this->fontStyle, $this->paraStyle),
            $table->addCell()->addText('Tipo', $this->fontStyle, $this->paraStyle),
            $table->addCell()->addText('Dito no ofício', $this->fontStyle, $this->paraStyle),
            $table->addCell()->addText('Lacre de Entrada', $this->fontStyle, $this->paraStyle),
            $this->tabelaMaterialExame($laudo->armas, $laudo->municoes, $table, $laudo)
        ];

    }

    protected function tabelaMaterialExame($armalaudo, $municaolaudo, $table, $laudo){//laudo eficiencia arma e munições
        $item = 1;
        $quantidade = '';

        if ($armalaudo != '') {
            foreach ($armalaudo as $arma) {
                $quantidade = 1;
                $naturezaArma = substr_replace($arma->marca->categoria, '', 4, 1);
                [
                    $table->addRow(10, ['tblHeader' => true]),
                    $table->addCell()->addText($item, null, $this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper($naturezaArma), null, $this->paraStyle),
                    $table->addCell()->addText($quantidade, null, $this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper($arma->tipo_arma), null, $this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper($arma->dito_oficio), null, $this->paraStyle),
                    $table->addCell()->addText($arma->num_lacre_saida, null, $this->paraStyle),
                ];
                $item++;
            }
        }

        if ($municaolaudo != '') {
            $tabelaNecropsia = DB::select('select lacrecartucho,tipo_municao,calibre_id,sum(quantidade),marca_id from municoes where laudo_id = :id group by lacrecartucho,tipo_municao,marca_id,calibre_id ', ['id' => $laudo->id]);
            
            foreach ($tabelaNecropsia as $municao) {
                $tableM = DB::table('municoes')->join('marcas', 'municoes.marca_id', '=', 'marca_id')->select('municoes.marca_id', 'marcas.nome')->where('marca_id', $municao->marca_id)->where('marcas.id', '=', $municao->marca_id)->get();
                $tableX = DB::table('municoes')->join('calibres', 'municoes.calibre_id', '=', 'calibre_id')->select('municoes.calibre_id', 'calibres.nome')->where('calibre_id', $municao->calibre_id)->where('calibres.id', $municao->calibre_id)->get();

                $marca = '';
                $modelo = '';
                
                if (isset($tableM[0]->nome)) {
                    $marca = $tableM[0]->nome;
                }
                
                if (isset($tableX[0]->nome)) {
                    $modelo = $tableX[0]->nome;
                }
                
                $naturezaMunicao = "munição";
                
                [
                    $table->addRow(10, ['tblHeader' => true]),
                    $table->addCell()->addText($item, null, $this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper($naturezaMunicao), null, $this->paraStyle),
                    $table->addCell()->addText($municao->{'sum(quantidade)'}, null, $this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper($municao->tipo_municao), null, $this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper($marca), null, $this->paraStyle),
                    $table->addCell()->addText($municao->lacrecartucho, null, $this->paraStyle),
                ];
                
                $item++;
            }
        }

        if ($laudo->componentes != '') {
            $tabelaNecropsia = DB::select('select lacrecartucho,group_concat(calibreNominal),group_concat(tipo_projetil),sum(quantidade_frascos) from componentes where laudo_id = :id group by lacrecartucho', ['id' => $laudo->id]);

            foreach ($tabelaNecropsia as $projetil) {
                $ti_projetil = explode(',', $projetil->{'group_concat(tipo_projetil)'});
                $cali_projetil = explode(',', $projetil->{'group_concat(calibreNominal)'});
                
                [
                    $table->addRow(10, ['tblHeader' => true]),
                    $table->addCell()->addText($item, null, $this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper('Projetil'), null, $this->paraStyle),
                    $table->addCell()->addText($projetil->{'sum(quantidade_frascos)'}, null, $this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper($ti_projetil[0]), null, $this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper($cali_projetil[0]), null, $this->paraStyle),
                    $table->addCell()->addText($projetil->lacrecartucho, null, $this->paraStyle),
                ];
                
                $item++;
            }
        }
        
        return $table;
    }

    public function tabelaDadosInvestigacao($phpWord, $section, $config, $laudo){
        $dataHora = formatar_data_do_bd($laudo->data_solicitacao);
        $dataOcorencia = empty($laudo->data_ocorrencia) ? '' : formatar_data_do_bd($laudo->data_ocorrencia);
        
        $this->phpWord->addTableStyle('tabela', $this->styleTable, $this->styleFirstRow);

        $cidadeGdl = (!empty($laudo->solicitante->cidade_id) ? $laudo->solicitante->cidade_id : $laudo->cidadeGdl);
        $orgaoGdl = (!empty($laudo->solicitante->nome) ? $laudo->solicitante->nome : $laudo->orgaoGdl);

        $table = $this->section->addTable('tabela');//cabeçalho tabela
        $table->addRow(50);
        $table->addCell(5, ['bgColor' => 'd3d3d3'])->addText('TABELA 1 – DADOS DA INVESTIGAÇÃO', $this->fontStyle, $this->paraStyle);
        $hideShowDataOcorrencia = '3000';
        $tamanhoCell = '3050';
        
        if ($dataOcorencia == "" && $laudo->boletim_ocorrencia == "") {
            $hideShowDataOcorrencia = '6000';
        } elseif ($dataOcorencia == "") {
            $tamanhoCell = '3502';
        } elseif ($laudo->boletim_ocorrencia == "") {
            $tamanhoCell = '3502';
        }

        $this->nomes($table, $laudo, $hideShowDataOcorrencia);
        $table->addRow(50);
        $dataOcorencia != "" ? [
            $table->addCell(3050)->addText('Data da Ocorrência:', $this->fontStyle, $this->paraStyle),
            $table->addCell(2000)->addText($dataOcorencia, null, $this->paraStyle)
        ] : "";

        $table->addCell(1000)->addText('Local:', $this->fontStyle, $this->paraStyle);
        $table->addCell(3050)->addText(mb_strtoupper($cidadeGdl), null, $this->paraStyle);
        $table->addRow(50);
        $laudo->boletim_ocorrencia != "" ? [
            $table->addCell(2000)->addText('Boletim de Ocorrência:', $this->fontStyle, $this->paraStyle),
            $table->addCell(2500)->addText($laudo->boletim_ocorrencia, null, $this->paraStyle)
        ] : "";

        $table->addCell(1000)->addText("Nº do $laudo->tipo_inquerito:", $this->fontStyle, $this->paraStyle);
        $table->addCell($tamanhoCell)->addText($laudo->inquerito, null, $this->paraStyle);
        $table->addRow(50);
        $table->addCell(3052)->addText('Unidade Policial:', $this->fontStyle, $this->paraStyle);
        $table->addCell(3000)->addText(mb_strtoupper($orgaoGdl), null, $this->paraStyle);

        return $table;
    }

    protected function tabelaExameLocalNecropsia($phpWord, $section, $config, $laudo){
        $this->phpWord->addTableStyle('tabela', $this->styleTable, $this->styleFirstRow);

        $text = [
            $table = $this->section->addTable('tabela'),
            $table->addRow(10, ['tblHeader' => true]),
            $table->addCell(null, ['bgColor' => 'd3d3d3'])->addText('TABELA 2 – MATERIAL ENCAMINHADO A EXAME ', $this->fontStyle, $this->paraStyle),//cabeçalho tabela
            $table->addRow(10, ['tblHeader' => true]),
            $table->addCell()->addText('Item', $this->fontStyle, $this->paraStyle),
            $table->addCell()->addText('Tipo', $this->fontStyle, $this->paraStyle),
            $table->addCell()->addText('Qtde', $this->fontStyle, $this->paraStyle),
            $table->addCell()->addText('Origem', $this->fontStyle, $this->paraStyle),
            $table->addCell()->addText('Nº Exame Coleta', $this->fontStyle, $this->paraStyle),
            $table->addCell()->addText('N° Requisição', $this->fontStyle, $this->paraStyle),
            $table->addCell()->addText('Lacre de Entrada', $this->fontStyle, $this->paraStyle),
            $this->tabelaExameLocalNecropsiaCorpo($table, $laudo)
        ];
    }

    protected function tabelaExameLocalNecropsiaCorpo($table, $laudo){
        //laudo eficiencia arma e munições

        $item = 1;
        $quantidade = '';

        if (isset($laudo->armas[0])) {
            foreach ($laudo->armas as $arma) {
                $quantidade = 1;
               
                [
                    $table->addRow(10, ['tblHeader' => true]),
                    $table->addCell()->addText($item, null, $this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper($arma->tipo_arma), null, $this->paraStyle),
                    $table->addCell()->addText($quantidade, null, $this->paraStyle),
                    $table->addCell()->addText($arma->origem_coletaPerito, null, $this->paraStyle),
                    $table->addCell()->addText($arma->rep_materialColetado, null, $this->paraStyle),
                    $table->addCell()->addText($laudo->rep, null, $this->paraStyle),
                    $table->addCell()->addText($arma->num_lacre_saida, null, $this->paraStyle),
                ];
                
                $item++;
            }
        }

        if (isset($laudo->municoes[0])) {
            $tabelaNecropsia = DB::select('select lacrecartucho,origem_coletaPerito,rep_materialColetado,lacre_saida,tipo_municao,sum(quantidade) from municoes where laudo_id = :id group by lacrecartucho,origem_coletaPerito,rep_materialColetado,lacre_saida,tipo_municao ', ['id' => $laudo->id]);

            foreach ($tabelaNecropsia as $municao) {
                if ($municao->tipo_municao == "cartucho") {
                    [
                        $table->addRow(10, ['tblHeader' => true]),
                        $table->addCell()->addText($item, null, $this->paraStyle),
                        $table->addCell()->addText(mb_strtoupper($municao->tipo_municao), null, $this->paraStyle),
                        $table->addCell()->addText($municao->{'sum(quantidade)'}, null, $this->paraStyle),
                        $table->addCell()->addText($municao->origem_coletaPerito, null, $this->paraStyle),
                        $table->addCell()->addText($municao->rep_materialColetado, null, $this->paraStyle),
                        $table->addCell()->addText($laudo->rep, null, $this->paraStyle),
                        $table->addCell()->addText($municao->lacrecartucho, null, $this->paraStyle),


                    ];
                    
                    $item++;
                }
            }
        }

        if (isset($laudo->municoes[0])) {
            $tabelaNecropsia = DB::select('select lacrecartucho,origem_coletaPerito,rep_materialColetado,lacre_saida,tipo_municao,sum(quantidade) from municoes where laudo_id = :id group by lacrecartucho,origem_coletaPerito,rep_materialColetado,lacre_saida,tipo_municao ', ['id' => $laudo->id]);

            foreach ($tabelaNecropsia as $municao) {
                if ($municao->tipo_municao == "estojo") {
                    [
                        $table->addRow(10, ['tblHeader' => true]),
                        $table->addCell()->addText($item, null, $this->paraStyle),
                        $table->addCell()->addText(mb_strtoupper($municao->tipo_municao), null, $this->paraStyle),
                        $table->addCell()->addText($municao->{'sum(quantidade)'}, null, $this->paraStyle),
                        $table->addCell()->addText($municao->origem_coletaPerito, null, $this->paraStyle),
                        $table->addCell()->addText($municao->rep_materialColetado, null, $this->paraStyle),
                        $table->addCell()->addText($laudo->rep, null, $this->paraStyle),
                        $table->addCell()->addText($municao->lacrecartucho, null, $this->paraStyle),


                    ];
                    
                    $item++;
                }
            }
        }


        if (isset($laudo->componentes[0])) {
            $tabelaNecropsia = DB::select('select lacrecartucho,origem_coletaPerito,rep_materialColetado,sum(quantidade_frascos) from componentes where laudo_id = :id group by lacrecartucho,origem_coletaPerito,rep_materialColetado ', ['id' => $laudo->id]);

            foreach ($tabelaNecropsia as $tabela) {
                [
                    $table->addRow(10, ['tblHeader' => true]),
                    $table->addCell()->addText($item, null, $this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper('projétil'), null, $this->paraStyle),
                    $table->addCell()->addText($tabela->{'sum(quantidade_frascos)'}, null, $this->paraStyle),
                    $table->addCell()->addText($tabela->origem_coletaPerito, null, $this->paraStyle),
                    $table->addCell()->addText($tabela->rep_materialColetado, null, $this->paraStyle),
                    $table->addCell()->addText($laudo->rep, null, $this->paraStyle),
                    $table->addCell()->addText($tabela->lacrecartucho, null, $this->paraStyle),


                ];
                
                $item++;
            }
        }
        
        return $table;
    }

    public function nomes($table, $laudo, $hideShowDataOcorrencia){
        if ($laudo->nomeIncluir != '') {
            $armazenanomes = explode(',', $laudo->nomeIncluir);
            
            $filtar = array_filter($armazenanomes, function ($number) {
                return $number % 2 != 0;
            }, ARRAY_FILTER_USE_KEY);

            $filtarnome = array_filter($armazenanomes, function ($number) {
                return $number % 2 == 0;
            }, ARRAY_FILTER_USE_KEY);

            $combinar = array_combine($filtar, $filtarnome);

            foreach ($combinar as $envolvidos => $perfil) {
                if ($envolvidos == "Em poder de") {
                    $table->addRow(50);
                    $table->addCell(3052, [$this->styleFirstRow])->addText($envolvidos, $this->fontStyle, $this->paraStyle);
                    $table->addCell($hideShowDataOcorrencia)->addText($perfil, null, $this->paraStyle);
                }
                
                if ($envolvidos == "Vitima") {
                    $nomeVitima = "Nome da vítima";
                    $table->addRow(50);
                    $table->addCell(3052, [$this->styleFirstRow])->addText($nomeVitima, $this->fontStyle, $this->paraStyle);
                    $table->addCell($hideShowDataOcorrencia)->addText($perfil, null, $this->paraStyle);
                }
                
                if ($envolvidos == "Envolvido") {
                    $table->addRow(50);
                    $table->addCell(3052, [$this->styleFirstRow])->addText($envolvidos, $this->fontStyle, $this->paraStyle);
                    $table->addCell($hideShowDataOcorrencia)->addText($perfil, null, $this->paraStyle);
                }
            }
        }
        
        if (!empty($laudo->envolvidoGdl)) {
            $envolve = str_replace(',,', ',', $laudo->envolvidoGdl);
            $indiciados = explode(',', $envolve);

            $a = 0;
            $b = 1;
            $new_arr = [];
            $v = [];
            for ($i = 0; $i < count($indiciados) / 2 - 1; $i++) {
                $key = (!empty($indiciados[$a])) ? $indiciados[$a] : '';
                $value = (!empty($indiciados[$b])) ? $indiciados[$b] : '';
                $new_arr = array_push($v, array($key => $value));

                $a += 2;
                $b += 2;
            }

            foreach ($v as $n) {
                foreach ($n as $envolvidosGDL => $extensao) {
                    $table->addRow(50, );
                    $table->addCell(3052, [$this->styleFirstRow])->addText(ucfirst(mb_strtolower($envolvidosGDL)), $this->fontStyle, $this->paraStyle);
                    $table->addCell($hideShowDataOcorrencia)->addText(mb_strtoupper($extensao), null, $this->paraStyle);
                }
            }
        }
        
        if ($laudo->perfil_envolvido == 'Vitima') {
            $suspeito = 'Nome da vítima';
            $table->addRow(50, );
            $table->addCell(3052, [$this->styleFirstRow])->addText($suspeito, $this->fontStyle, $this->paraStyle);
            $table->addCell($hideShowDataOcorrencia)->addText(mb_strtoupper($laudo->nome_vitima), null, $this->paraStyle);

        } else if ($laudo->perfil_envolvido == 'Em poder de') {
            $suspeito = 'Em poder de';
            $table->addRow(50, );
            $table->addCell(3052, [$this->styleFirstRow])->addText($suspeito, $this->fontStyle, $this->paraStyle);
            $table->addCell($hideShowDataOcorrencia)->addText(mb_strtoupper($laudo->nome_vitima), null, $this->paraStyle);

        } else if ($laudo->perfil_envolvido == 'Envolvido') {
            $suspeito = 'Envolvido';
            $table->addRow(50, );
            $table->addCell(3052, [$this->styleFirstRow])->addText($suspeito, $this->fontStyle, $this->paraStyle);
            $table->addCell($hideShowDataOcorrencia)->addText(mb_strtoupper($laudo->nome_vitima), null, $this->paraStyle);
        }
    }
}

