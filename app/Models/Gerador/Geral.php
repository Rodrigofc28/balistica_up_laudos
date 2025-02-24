<?php


namespace App\Models\Gerador;

use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\Border;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Shape;
use PhpOffice\PhpWord\Style\Font;
use Illuminate\Support\Facades\DB;
use NumberFormatter;


class Geral extends Tabelas
{
    public $section, $config, $phpWord;//mudei de private para public

    public function __construct($section, $config, $phpWord)
    {
        
        $this->section = $section;
        $this->config = $config;
        $this->phpWord = $phpWord;
    }
    private function titulo_e_exame($laudo)
    {
       
        
        if ($laudo =='B602') {
            $titulo = "LAUDO DE PERÍCIA CRIMINAL";
            $exame = "(EXAME DE EFICIÊNCIA EM ARMA DE FOGO E MUNIÇÃO)";
            $codigo ="Código: B602 - EFICIÊNCIA E PRESTABILIDADE";
        } else {
            if ($laudo=='B601') {
                $titulo = "LAUDO DE PERÍCIA CRIMINAL";
                $exame = "(EXAME DE CONSTATAÇÃO DE VESTÍGIOS BALÍSTICOS)";
                $codigo = "Código: B601 - CONSTATAÇÃO";
            }
        
        }return ['exame' => $exame, 'titulo' => $titulo,'codigo'=>$codigo];
    }
    
    public function vereficaTabela($laudo){
        
        if($laudo->oficio==true || $laudo->oficio==false){
            if($laudo->material_coletado=="sim"){
                $this->tabelaExameLocalNecropsia($this->phpWord,$this->section,$this->config,$laudo);
                
            }else{
                
            $this->tabelaExame($this->phpWord,$this->section,$this->config,$laudo);
        
        }
        }
        
        return $this;
    }
         
       
    
    public function addText($laudo)
    {

        $header = $this->section->addHeader();
        $header->addTextBreak(1);
        $header->addPreserveText('FLS. {PAGE}', array('bold' => true,
            'size' => 10, 'name' => 'arial'), $this->config->paragraphRight());

        $num_laudo = "LAUDO Nº $laudo->rep";
        $header->addText($num_laudo, array('bold' => true,
            'size' => 10, 'name' => 'arial'), array('alignment' => Jc::END));

        $intCrim = "POLÍCIA CIENTÍFICA DO PARANÁ";
        $constatacao="a constatação de calibre nominal, ";
        $eficiencia="a sua eficiência e prestabilidade, ";
        $textEfecienciConstatacao=($laudo->laudoEfetConst=="B601")?($constatacao):($eficiencia);
        $objetivo=['1. OBJETIVO','A perícia tem como objetivo a efetivação do exame descritivo da totalidade do material, bem como '. $textEfecienciConstatacao.'para instruir os autos da investigação policial abaixo descrita:'];
        
        
        $cidadeGdl=$laudo->cidadeGdl;
        $orgaoGdl=$laudo->orgaoGdl;
        $unidadeGdl=$laudo->unidadeGdl;


        $perito = $laudo->perito->nome;
        
        $delegacia = (!empty($laudo->solicitante->nome))?$laudo->solicitante->nome:$orgaoGdl;
        $oficio = $laudo->oficio;
        $secao = (!empty($laudo->secao->nome))?$laudo->secao->nome:$unidadeGdl;

        $aux = $this->titulo_e_exame($laudo->laudoEfetConst);
        
        $cabecalho2 = "Em consequência, o Perito procedeu ao exame solicitado, relatando-o com a verdade e com todas as circunstâncias relevantes, da forma como segue:";

        $exame = "2. MATERIAL APRESENTADO A EXAME";
        $data_rec=formatar_data_do_bd($laudo->data_recebimento);
        $data_solic =formatar_data_do_bd($laudo->data_solicitacao);
        $data_desig = data($laudo->data_designacao);

        //configuração da tabela  cabeçalho
        $fontStyle = array ('bold' => true); 
        $paraStyle = array ('align' =>'center');
        $styleTable = array('borderColor'=>'777777','borderSize'=>10, 'cellMarginTop'=>10,'cellMarginLeft'=>0,'cellMarginRight'=>0,'cellSpacing'=>10000); //configuração da borda
        $styleFirstRow = array('bgColor'=>' #F0FFFF');
        $cellStyle=array('borderSize'=>50);
        
        
        $this->phpWord->addTableStyle('tabela', $styleTable, $styleFirstRow); //cabeçalho da tabela
        $this->phpWord->addTableStyle('tabela2img', $styleTable, $styleFirstRow);
        
        
        

        //caminho da imagem
        
        $source = public_path('image/logo.jpg'); 
        
        $fileContent = file_get_contents($source);
        //oficio requisitante
        
        if($laudo->laudoEfetConst!="constatacao"){//$oficio!=null
            $paragrafo_material="Foi encaminhado a esta Unidade de Execução Técnico-científica, em embalagens plásticas transparentes lacradas, conforme ofício recebido, o seguinte material:";
            $requisicaoOficio=['materiais abaixo discriminados ',' a fim de ser atendida solicitação contida no Ofício nº '.$oficio.', datado de '.$data_solic.', oriundo da '.$delegacia.'.'];
        }else{
            $paragrafo_material="Foi encaminhado a esta Unidade de Execução Técnico-científica, em embalagens plásticas transparentes lacradas, o seguinte material:";
            $requisicaoOficio=['vestígios balísticos abaixo discriminados, ',' em complemento aos exames de local de morte e/ou necrópsia em que tais vestígios foram coletados.'];
        }
        
        
        
       
        //PREÂMBULO ARMAS
        $text = [
            
            $textrun = $this->section->addTextRun($this->config->paragraphCenter()),
            $textrun->addText($aux['titulo'], $this->config->arial14Bold()),
            $textrun->addTextBreak(),
            $textrun->addText($aux['exame'],$this->config->arial12Bold(),$this->config->paragraphCenter()),
            
            $this->section->addText($aux['codigo'],$this->config->arial12Bold(),$this->config->paragraphRight()),
            $this->section->addTextBreak(),
            $textrun = $this->section->addTextRun($this->config->paragraphJustify()),
            $textrun->addText("$data_desig, nesta cidade de $secao e na ", $this->config->arial12()),
            $textrun->addText($intCrim, $this->config->arial12Bold()),
            $textrun->addText(", foi designado(a)", $this->config->arial12()),
            
            $textrun->addText(" o(a) Perito(a) Criminal ", $this->config->arial12()),
            $textrun->addText($perito, $this->config->arial12Bold()),
            $textrun->addText(", para proceder ao exame dos ".$requisicaoOficio[0]."recebidos nesta Seção em $data_rec", $this->config->arial12()),
            
            $textrun->addText($requisicaoOficio[1], $this->config->arial12()),
            
            $this->section->addText($cabecalho2, $this->config->arial12(), $this->config->paragraphJustify()),
            $this->section->addTextBreak(1),//pula linha
            $this->section->addText($objetivo[0], $this->config->arial12Bold(), $this->config->paragraphJustify()),//*
            
            $this->section->addText($objetivo[1], $this->config->arial12(), $this->config->paragraphJustify()),//*
            //tabela 1 dados da investigação
            $this->section->addTextBreak(1),
            $this->tabelaDadosInvestigacao($this->phpWord,$this->section,$this->config,$laudo),
            $this->section->addText($exame, $this->config->arial12Bold(), $this->config->paragraphJustifyExam()),
            $this->section->addText($paragrafo_material,$this->config->arial12(), $this->config->paragraphJustify()),
            $this->section->addTextBreak(1),
              //pula a pagina quando ta no final
             
           $this->vereficaTabela($laudo),//tabela
            $this->section->addText(''),'phpWord' => $this->phpWord];
            if(count($laudo->imagens)==0){
                global $numTab;
                $numTab++;
            }
            if(count($laudo->imagens)>0){
                $a=2;
                $b=0;
                $this->imagemEmbalagemrecursiva($a,$b,$laudo,$fontStyle,$paraStyle);
           
        }



            $this->section->addText('3. DO EXAME', $this->config->arial12Bold(), $this->config->paragraphJustify());
            
            
            
        return $this->section;

    }

    
    


 
    public function addFinalText($perito,$laudo)
    {   
        $numberExtenso = new NumberFormatter('pt_BR',NumberFormatter::SPELLOUT);
        $cartuchosEstojosTipo=[];
        $arrayNumeroLacre=[];
        $i=0;
        $g=1;
        $ordemAlfabeto=[1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',25=>'Z',26=>'Y'];
        foreach ($laudo->armas as $armaLacre){
            
            $arrayNumeroLacre[$i]=' nº '.$armaLacre->num_lacre.' (Arma AF-'.$ordemAlfabeto[$g].'),';
            
            
           
            $g++;
            $i++;
           
        }
        
        $tituloConclusao='';

        
        

        if(count($laudo->municoes)==0&&count($laudo->armas)==0){
            
        }else{
            
            
            if(count($laudo->armas)>0){
                $tituloConclusao='4. CONCLUSÃO:';
                $this->section->addText($tituloConclusao, $this->config->arial12Bold(), $this->config->paragraphJustify());
                $this->section->addText("Concluídos os exames descritos neste laudo, constatou-se que:", $this->config->arial12(), $this->config->paragraphJustify());
                $g=1;
                foreach($laudo->armas as $arma){
                    if($arma->funcionamento=="eficiente"){
                        
                        
                        $this->section->addText("•   Arma AF-".$ordemAlfabeto[$g]." encontrava-se eficiente para a realização de tiros.", $this->config->arial12());
                        
                    }
                    if($arma->funcionamento=="ineficiente"){
    

                        $this->section->addText("•   Arma AF-".$ordemAlfabeto[$g]." encontrava-se ineficiente para a realização de tiros.", $this->config->arial12());
                        
    
                    }
                    $g++;
                }}
            $arrayEstojo=[];
            
            $verifica=[];
            
            foreach($laudo->municoes as $municao){
                if($municao->funcionamento!='intacto'){
                if($municao->funcionamentoCartucho==null){
                    array_push($verifica,$municao);   
                }
                $cartuchoNome=ucfirst($municao->tipo_municao);
                $cartuchoNome="($cartuchoNome";
               $funcionamentoCondicao="$municao->funcionamento),";
               
                array_push($cartuchosEstojosTipo,' nº',$municao->lacrecartucho,$cartuchoNome,$funcionamentoCondicao);}

                if($municao->tipo_municao=="estojo"){
                  
                array_push($arrayEstojo,$municao->tipo_municao);
                $cartuchoNome=ucfirst($municao->tipo_municao);
                $funcionamentoCondicao="($municao->funcionamento)";
                 
                    
                }}}
                
            
            if(count($laudo->municoes)>0 && count($laudo->municoes)!=count($arrayEstojo) ){
                if(count($laudo->armas)==0){
                    if(count($laudo->municoes)!=count($verifica)){
                    $tituloConclusao='4. CONCLUSÃO:';
                    $descricaoConclusao="Concluídos os exames descritos neste laudo, constatou-se que:";
                    $this->section->addText($tituloConclusao, $this->config->arial12Bold(), $this->config->paragraphJustify());
                    $this->section->addText($descricaoConclusao, $this->config->arial12(), $this->config->paragraphJustify());}
            }
                $item=1;
                $municaoFuncionamento=false;
                
                foreach($laudo->municoes as $municao){
                    
        
                      
                    if($municao->tipo_municao=="cartucho"){
                        
                    if($municao->funcionamentoCartucho=="eficiente"){
                        
                        
                        $this->section->addText("•   cartuchos item $item encontravam-se eficientes para a realização de tiros.", $this->config->arial12());
                        $item++;
                    }
                    elseif($municao->funcionamentoCartucho=="ineficiente"){
    
                        $this->section->addText("•   cartuchos item $item encontravam-se ineficiente para a realização de tiros.", $this->config->arial12());
                        $item++;
    
                    }elseif($municao->funcionamentoCartucho=="parcial"){
                        $this->section->addText('•   cartuchos item '.$item.' encontravam-se parcialmente eficiente para a realização de tiros (Quantidade eficiente '. $numberExtenso->format($municao->qtEficiente).', Ineficiente '. $numberExtenso->format($municao->qtIneficiente).')', $this->config->arial12());
                        $item++;
                    }
                
                }}
        
        
       } 

       
        if($laudo->sinab=='1'&& count($laudo->armas)>0){
            $consideracaoFinaisSinab=" Cumpre ressaltar que os padrões balísticos elegíveis para inclusão no Banco Nacional de Perfis Balísticos (BNPB) devem ser armazenados pelo prazo de 20 anos conforme definido no Procedimento Operacional do Sistema Nacional de Análise Balística (SINAB), independentemente de futura destruição da arma.";
        }
        elseif($laudo->sinab=='1'&& $laudo->laudoEfetConst){
            $consideracaoFinaisSinab="Cumpre ressaltar que o material é elegível para inclusão no Banco Nacional de Perfis Balísticos (BNPB) e deverá ser submetido aos exames e prazos de custódia definidos no Procedimento Operacional do Sistema Nacional de Análise Balística (SINAB), motivo pelo qual foi gerada a Requisição de Exame Complementar (REP) nº  $laudo->rep_exame_complementar" ;
        }
        else{
            $consideracaoFinaisSinab='' ;
        }

        
       
        $consideracaoFinais="O material descrito neste documento, após examinado, foi devidamente identificado, embalado e lacrado com o(s) lacre(s)".implode($arrayNumeroLacre).''.implode(' ',$cartuchosEstojosTipo)." conforme requerido pelos artigos 158-A a 158-F do Código de Processo Penal (Lei nº 13.964/2019), e encaminhado para a Central de Custódia da Polícia Científica do Paraná.".$consideracaoFinaisSinab;
         
          
       
       
    
        if($cartuchosEstojosTipo==null&&$arrayNumeroLacre==null){
            $finalConsideracoesTexto=null;
        }else{
        $finalConsideracoesTexto=[  
            $this->section->addTextBreak(1),
            $this->section->addText(($tituloConclusao=='')?"4. CONSIDERAÇÕES FINAIS:":"5. CONSIDERAÇÕES FINAIS:", $this->config->arial12Bold(), $this->config->paragraphJustify()),//consideracão final
            $this->section->addText($consideracaoFinais, $this->config->arial12(), $this->config->paragraphJustify()),
                                     
            $this->section->addTextBreak(1) ];
        }                           
        $styleTable = array('borderColor'=>'777777','borderSize'=>10, 'cellMarginTop'=>10,'cellMarginLeft'=>0,'cellMarginRight'=>0,'cellSpacing'=>10000); //configuração da tabela
        $styleFirstRow = array('bgColor'=>' #F0FFFF');
        $this->phpWord->addTableStyle('tabela', $styleTable, $styleFirstRow);


        
        $unidade=(!empty($laudo->secao->nome)?$laudo->secao->nome:$laudo->unidadeGdl);



        $final = [
            $this->section->addText(($tituloConclusao=='')?'5. ENCERRAMENTO:':'6. ENCERRAMENTO: ', $this->config->arial12Bold(), $this->config->paragraphJustify()),//encerramento
            $textrun = $this->section->addTextRun($this->config->paragraphJustify()),
            
            $textrun->addText("Este laudo foi redigido pelo(a) Perito(a) que realizou o exame e que o subscreve digitalmente em ", $this->config->arial12(), $this->config->paragraphJustify()),
           
            $textrun->addField('NUMPAGES', array(), array()),
            
            $textrun->addText(" página(s). E são essas as declarações que em sua consciência tem o(a) Perito(a) a fazer. E por nada mais haver, deu-se por findo o exame solicitado, que de tudo se lavrou o presente Laudo, emitido através do Sistema de Gestão de Documentos e Laudos (GDL) conforme Instrução Normativa nº 001/2020-PCP, visando atender às deliberações da Autoridade requisitante.", $this->config->arial12(), $this->config->paragraphJustify()),
            $textrun->addTextBreak(2),
            $textrun->addText(''),
            $table=$this->section->addTable(), 
            $table->addRow(),
            $cell=$table->addCell(),
            $cell->addText($perito,array('bold' => true,
            'size' =>14 ), array('alignment' => Jc::CENTER)),
            
            $cell->addText('Perito(a) Criminal – Seção de Balística Forense',array('bold' => true,
            'size' =>14 ), array('alignment' => Jc::CENTER)),
            
            $cell->addText('UETC '.$unidade.' – Polícia Científica do Paraná',array('bold' => true,
            'size' =>14 ), array('alignment' => Jc::CENTER)),
            
            
           
    ];

    
    
    



        //return [$final,$conclusao,$finalConsideracoesTexto];
    }

    public function imagem($laudo){
        
        $i=0;
        $contagem=[];
        $imagens = $laudo->imagens;
       
        if ($imagens->count() > 0) {
            foreach ($imagens as $imagem) {
                $source = storage_path('app/public/imagensEmbalagem/' . $imagem->nome);
                if (file_exists($source)) {
                    $fileContent = file_get_contents($source);
                    
                    $contagem[$i]=$fileContent;
                    
                } else {
                    $this->section->addText("Ocorreu um erro com a imagem.", ['color' => "FF0000", 'size' => 14]);
                }
                $i++;
            }
            return $contagem;
        }


    }




    public function imagemEmbalagemrecursiva($a,$b,$laudo,$fontStyle,$paraStyle){
        global $numTab;
        $numeroEmbalagem = $numTab-2;
            if(count($laudo->imagens)>0){
            $table = $this->section->addTable('tabela2img'); //tabela de imagem embalagens
            $table->addRow(10,['tblHeader'=>true]);

            
            $table->addCell(null,['bgColor'=>'d3d3d3'])->addText('TABELA ' .$numTab .' – TOMADAS FOTOGRÁFICAS DA EMBALAGEM RECEBIDA '.$numeroEmbalagem, $fontStyle, $paraStyle);//cabeçalho da tabela
            $table->addRow(10);
            $numTab++;
            $test=$table->addCell();
            $test->addImage($this->imagem($laudo)[$b], array('alignment' => Jc::CENTER, 'width' => 220, 'height'=>150));
            $test->addText('Frente', $fontStyle, $paraStyle); 
            $b++;
           
            if(!empty($this->imagem($laudo)[$b])){
                
                $test2=$table->addCell();
                $test2->addImage($this->imagem($laudo)[$b], array('alignment' => Jc::CENTER, 'width' => 220, 'height'=>150));}
                $test2->addText('Verso', $fontStyle, $paraStyle);
                $this->section->addTextBreak(1);
                $b++;
            }
            
            if(count($laudo->imagens)>$a){
                $a+=2;
               $this->imagemEmbalagemrecursiva($a,$b,$laudo,$fontStyle,$paraStyle);
               
            }else{
                return $table;
            }

    }

   
}


