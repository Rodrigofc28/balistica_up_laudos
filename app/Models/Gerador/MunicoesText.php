<?php


namespace App\Models\Gerador;

use App\Models\Municoes\Cartucho;
use App\Models\Municoes\Estojo;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
use PhpOffice\PhpWord\Element\Image;
use NumberFormatter;
class MunicoesText extends Tabelas
{
    private $section, $i, $config;
   
    private $fontStyle = array ('bold' => true); 
    private $paraStyle = array ('align' =>'center');
    private $styleTable = array('borderColor'=>'ffffff','borderSize'=>10,'cellMarginTop'=>0,'cellMarginLeft'=>0,'cellMarginRight'=>0,'cellSpacing'=>10000); //configuração da borda
    private $styleFirstRow = array('bgColor'=>' #F0FFFF');
    private $cellStyle=array('borderSize'=>50);
    
    public function __construct($section, $config,$i, $phpWord)
        {
            $this->section = $section;
            $this->config = $config;
            $this->phpWord = $phpWord;
            $this->i = $i;
        }
    //Função para adionar o texto referente ao estojo
    public function addTextEstojo($municoes,$laudo){

        
                return $this->estojos($this->phpWord,$this->section,$this->config,$laudo);
            
        }

    //Função para adionar o texto referente ao cartucho
    public function addText($municoes,$laudo)
        {
            $ligaTituloCartucho=false;//verefica se tem algum exame de cartucho
            foreach($laudo->municoes as $municao){  
                if($municao->tipo_municao=='cartucho'){ 
                    $ligaTituloCartucho=true;//verefica se tem algum exame de cartucho e passa a variavel para true
                } }
             //adicona apenas um subtítulo que no caso é cartucho caso tenha cartuchos no exame 
             if(count($laudo->componentes)>0){ 
                //caso tenha componentes(orjetil) no exame adiciona um ao item do subtitulo
                $tituloCartucho=3;
            }elseif(count($laudo->armas)>0){
                $tituloCartucho=2;
            }else{
                $tituloCartucho=1;}
             if($ligaTituloCartucho){
                $this->section->addText('3.'.$tituloCartucho.' DOS CARTUCHOS ', $this->config->arial12Bold(), $this->config->paragraphJustify());
             }
            
            return $this->cartuchoPercutido($this->phpWord,$this->section,$this->config,$laudo);
        }

    public function cartuchoPercutido($phpWord,$section,$config,$laudo){
        $this->i=1;
        
        $this->tabelaCartuchoPersonalizada($laudo);

        $this->phpWord->addTableStyle('tabela2img', $this->styleTable, $this->styleFirstRow);

                } 
    // função criada para a legenda do laudo
    protected function legenda($municao,$cell)
        {
            
            $arrayLegenda=['CHOG'=>'Chumbo Ogival',
            'CHPP'=>' Chumbo Ponta Plana',
            'CHCV'=>' Chumbo Canto Vivo' ,
            'CSCV'=>' Chumbo Semi Canto Vivo ',
            'CXPO'=>' Cobre Expansivo Ponta Oca',
            'EXPP'=>'Encamisado Expansivo Ponta Plana',
            'ETOG'=>'Encamisado Total Ogival',
            'EPP'=>'Encamisado Ponta Plana',
            'ETPP'=>'Encamisado Total Ponta Plana',
            'ETPO'=>' Encamisado Total Ponta-Oca',
            'ETHS'=>' Encamisado Total Hydra-Shok',
            'ETPT'=>' Encamisado Total Pontiagudo',
            'EXPO'=>' Encamisado Expansivo Ponta Oca',
            'EXPT'=>' Encamisado Expansivo Pontiagudo',
            'ETPT'=> ' Encamisado Total Pontiagudo Boat Tail',
            'HPBT'=>' Hollow Point Boat Tail',
            'SEPO'=>' Semi-encamisado Expansivo Ponta Oca',
            'SEPP'=>' Semi-encamisado Ponta Plana',
            'SAT'=>' Ponta de Aço',
            'POLÍMERO'=>'',
            'FRANGÍVEL'=>'',
            'BALINS CHSG'=> '(Ø8,4mm)',
            'BALINS CHSG4'=> '(Ø8,8mm)',
            'BALINS CHTTT '=> '(Ø5,5mm)',
            'BALINS CHT'=> '(Ø5mm)',
            'BALINS CH1'=> '(Ø4mm)',
            'BALINS CH3'=> '(Ø3,5mm)',
            'BALINS CH5'=> ' (Ø3mm)',
            'BALINS CH6'=> '(Ø2,75mm)',
            'BALINS CH7'=> '(Ø2,5mm)',
            'BALINS CH8'=> ' (Ø2,25mm)',
            'BALINS CH9'=> ' (Ø2mm)',
            'BALINS CH11'=> '(Ø1,5mm)',
            'BALINS CH12'=> '(Ø1,25mm)',
            'BALINS MULTIPLOS'=>'',
            'BALOTE DE CHUMBO'=>'',
            'BALOTE SG1'=>'',
            'BALOTE FOSTER'=>'',
            'POLYMATCH'=>''];
            $armazenaLegenda=[];
            foreach($municao as $legMunicao){
                if($legMunicao==null){

                }else{
                    if($arrayLegenda[$legMunicao]==''){

                    }else{
                array_push($armazenaLegenda,$legMunicao,$arrayLegenda[$legMunicao]);
                    }
            }
            
            
            
        
        }
        $armazenaLegenda=array_unique($armazenaLegenda);

            $armazenaLegenda=implode(' ',$armazenaLegenda);
        $cell->addText("$armazenaLegenda" ,['bold'=>false,'size'=>8]);
    }
    
    //função criada para testar a condições de cada cartucho e adicionar na tabela
    public function tabelaCartuchoPersonalizada($laudo){
        global $itensCartucho;//variavel para o item da coluna de cartuchos
        $itensCartucho=1;
        // arrays criados para armazenar os cartuchos de acordo com a condição
        $arraymunicao1=[];
        $arraymunicao2=[];
        $arraymunicao3=[];
        $arraymunicao4=[];
        $arraymunicao5=[];
        $arraymunicao6=[];
        $arraymunicao7=[];
        $arraymunicao8=[];
        $arraymunicao9=[];
        $arraymunicao10=[];
        $arraymunicao11=[];
        $arraymunicao12=[];
        $arraymunicao13=[];
        $arraymunicao14=[];
        $arraymunicao15=[];
        $arraymunicao16=[];
        $arraymunicao17=[];
        $arraymunicao18=[];
        $arraymunicao19=[];
        $arraymunicao20=[];
        $arraymunicao21=[];
        $arraymunicao22=[];
        $arraymunicao23=[];
        $arraymunicao24=[];
        $arraymunicao25=[];
        $arraymunicao26=[];
        //foreach para a verificação de cada cartucho e adiciona no array correspondente
        foreach($laudo->municoes as $municao){  
            switch($municao->tipo_municao){
                case 'cartucho':
                    
                    switch ($municao->funcionamentoCartucho) {
                        case "eficiente":
                            
                            switch ($municao->funcionamento) {
                                case "percutido e não deflagrado":
                                    
                                    switch ($municao->coleta) {
                                        case "1":
                                            
                                            switch ($municao->institutoArma) 
                                                {  
                                                case "instituto":
                                                    
                                                    array_push($arraymunicao1,$municao);
                                                    
                                                    break;
                                                default:
                                                    
                                                    array_push($arraymunicao2,$municao);
                                                    break;
                                                }
                                            break;
                                        case null:
                                            switch ($municao->institutoArma) 
                                                {  
                                                case "instituto":
                                                    
                                                    array_push($arraymunicao3,$municao);
                                                    
                                                    break;
                                                default:
                                                    
                                                    array_push($arraymunicao4,$municao);
                                                    break;
                                                }
                                                break;
                                    } 
                                break;
                                default:
                                    switch ($municao->coleta) {
                                        case "1":
                                            
                                            switch ($municao->institutoArma) 
                                                {  
                                                case "instituto":
                                                    
                                                    array_push($arraymunicao5,$municao);
                                                    break;
                                                default:
                                                    
                                                    array_push($arraymunicao6,$municao);
                                                    break;
                                                }
                                            break;
                                        case null:
                                            switch ($municao->institutoArma) 
                                                {  
                                                case "instituto":
                                                    
                                                    array_push($arraymunicao7,$municao);
                                                    break;
                                                default:
                                                
                                                    array_push($arraymunicao8,$municao);
                                                    break;
                                                }
                                                break;

                                }

                            }
                            break;
                        case "ineficiente":
                            
                            switch ($municao->funcionamento) {
                                case "percutido e não deflagrado":
                                    switch ($municao->coleta) {
                                        case "1":
                                        
                                            switch ($municao->institutoArma) 
                                                {  
                                                case "instituto":
                                                
                                                    array_push($arraymunicao9,$municao);
                                                    break;
                                                default:
                                                    
                                                    array_push($arraymunicao10,$municao);
                                                    break;
                                                }
                                            break;
                                        default :
                                            switch ($municao->institutoArma) 
                                                {  
                                                case "instituto":
                                                    
                                                    array_push($arraymunicao11,$municao);
                                                    break;
                                                default:
                                                    
                                                    array_push($arraymunicao12,$municao);
                                                    break;
                                                }
                                                break;

                                    } 
                                default:
                                    switch ($municao->coleta) {
                                        case "1":
                                            
                                            switch ($municao->institutoArma) 
                                                {  
                                                case "instituto":
                                                    
                                                    array_push($arraymunicao13,$municao);
                                                    break;
                                                default:
                                                    
                                                    array_push($arraymunicao14,$municao);
                                                    break;
                                                }
                                            break;
                                        default :
                                            switch ($municao->institutoArma) 
                                                {  
                                                case "instituto":
                                                    
                                                    array_push($arraymunicao15,$municao);
                                                    break;
                                                default:
                                                    
                                                    array_push($arraymunicao16,$municao);
                                                    break;
                                                }
                                                break;

                                }

                            }break;
                        case "parcial":
                            switch ($municao->funcionamento) {
                                case "percutido e não deflagrado":
                                    switch ($municao->coleta) {
                                        case "1":
                                        
                                            switch ($municao->institutoArma) 
                                                {  
                                                case "instituto":
                                                
                                                    array_push($arraymunicao18,$municao);
                                                    break;
                                                default:
                                                    
                                                    array_push($arraymunicao19,$municao);
                                                    break;
                                                }
                                            break;
                                        default :
                                            switch ($municao->institutoArma) 
                                                {  
                                                case "instituto":
                                                    
                                                    array_push($arraymunicao20,$municao);
                                                    break;
                                                default:
                                                    
                                                    array_push($arraymunicao21,$municao);
                                                    break;
                                                }
                                                break;

                                    } 
                                default:
                                    switch ($municao->coleta) {
                                        case "1":
                                            
                                            switch ($municao->institutoArma) 
                                                {  
                                                case "instituto":
                                                    
                                                    array_push($arraymunicao22,$municao);
                                                    break;
                                                default:
                                                    
                                                    array_push($arraymunicao23,$municao);
                                                    break;
                                                }
                                            break;
                                        default :
                                            switch ($municao->institutoArma) 
                                                {  
                                                case "instituto":
                                                    
                                                    array_push($arraymunicao24,$municao);
                                                    break;
                                                default:
                                                    
                                                    array_push($arraymunicao25,$municao);
                                                    break;
                                                }
                                                break;

                                }

                            }  
                        break; 
                        case "preservado":
                            switch ($municao->funcionamento) {
                                case "percutido e não deflagrado":
                                    array_push($arraymunicao26,$municao);

                            }  
                        break; 
                        
                    }
                    
        

                    break;
                default:
                    break;
                }


    }
   
    
    // verifica as condições de cada cartucho e chama a função tabela2 passando o array correspondente
    if(count($arraymunicao1)>0){
        
        $instituto='usando arma fornecida por esta Unidade de Execução Técnico Científica';
        $coleta='e/ou utilizados no procedimento de coleta de padrão balístico abaixo citado. ';
        $eficiencia="munição eficiente para a realização de tiros.";
        $percutido=["",""];
        $condicoes='eficiente';
        $this->tabela2($arraymunicao1,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao2)>0){
        
        $eficiencia="munição eficiente para a realização de tiros.";
        $coleta='e/ou utilizados no procedimento de coleta de padrão balístico abaixo citado. ';
        $instituto='usando a arma encaminhada para exame';
        $percutido=["",""];
        $condicoes='eficiente';
        $this->tabela2($arraymunicao2,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao3)>0){
        
        $coleta='';
        $eficiencia="munição eficiente para a realização de tiros.";
        $instituto='usando arma fornecida por esta Unidade de Execução Técnico Científica';
        $percutido=["",""];
        $condicoes='eficiente';
        $this->tabela2($arraymunicao3,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao4)>0){
        
        $coleta='';
        $instituto='usando a arma encaminhada para exame';
        $eficiencia="munição eficiente para a realização de tiros.";
        $percutido=["",""];
        $condicoes='eficiente';
        $this->tabela2($arraymunicao4,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao5)>0){
        
        $percutido=['',''];
        $instituto='usando arma fornecida por esta Unidade de Execução Técnico Científica';
        $coleta='e/ou utilizados no procedimento de coleta de padrão balístico abaixo citado. ';
        $eficiencia="munição eficiente para a realização de tiros.";
        $condicoes='eficiente';
        $this->tabela2($arraymunicao5,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao6)>0){
        
        $percutido=['',''];
        $instituto='usando a arma encaminhada para exame';
        $coleta='e/ou utilizados no procedimento de coleta de padrão balístico abaixo citado. ';
        $eficiencia="munição eficiente para a realização de tiros.";
        $condicoes='eficiente';
        $this->tabela2($arraymunicao6,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao7)>0){
        
        $coleta='';
        $instituto='usando arma fornecida por esta Unidade de Execução Técnico Científica';
        $percutido=['',''];
        $eficiencia="munição eficiente para a realização de tiros.";
        $condicoes='eficiente';
        $this->tabela2($arraymunicao7,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao8)>0){
        
        $coleta='';
        $instituto='usando a arma encaminhada para exame';
        $percutido=['',''];
        $eficiencia="munição eficiente para a realização de tiros.";
        $condicoes='eficiente';
        $this->tabela2($arraymunicao8,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao9)>0){
        
        $eficiencia="munição Ineficiente para a realização de tiros.";
        $percutido=[" "," "];
        $coleta='e/ou utilizados no procedimento de coleta de padrão balístico abaixo citado. ';
        $instituto='usando arma fornecida por esta Unidade de Execução Técnico Científica';
        $condicoes='Ineficiente';
        $this->tabela2($arraymunicao9,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao10)>0){
        
        $instituto='usando a arma encaminhada para exame';
        $eficiencia="munição Ineficiente para a realização de tiros.";
        $percutido=[" "," "];
        $coleta='e/ou utilizados no procedimento de coleta de padrão balístico abaixo citado. ';
        $condicoes='Ineficiente';
        $this->tabela2($arraymunicao10,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao11)>0){
    
        $instituto='usando arma fornecida por esta Unidade de Execução Técnico Científica';
        $coleta='';
        $eficiencia="munição Ineficiente para a realização de tiros.";
        $percutido=[" "," "];
        $condicoes='Ineficiente';
        $this->tabela2($arraymunicao11,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao12)>0){
        
        $instituto='usando a arma encaminhada para exame';
        $coleta='';
        $eficiencia="munição Ineficiente para a realização de tiros.";
        $percutido=[" "," "];
        $condicoes='Ineficiente';
        $this->tabela2($arraymunicao12,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao13)>0){
        
        $instituto='usando arma fornecida por esta Unidade de Execução Técnico Científica';
        $percutido=['',''];
        $eficiencia="munição Ineficiente para a realização de tiros.";
        $coleta='e/ou utilizados no procedimento de coleta de padrão balístico abaixo citado. ';
        $condicoes='Ineficiente';
        $this->tabela2($arraymunicao13,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao14)>0){
        
        $instituto='usando a arma encaminhada para exame';
        $percutido=['',''];
        $eficiencia="munição Ineficiente para a realização de tiros.";
        $coleta='e/ou utilizados no procedimento de coleta de padrão balístico abaixo citado. ';
        $condicoes='Ineficiente';
        $this->tabela2($arraymunicao14,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao15)>0){
        
        $instituto='usando arma fornecida por esta Unidade de Execução Técnico Científica';
        $coleta='';
        $percutido=['',''];
        $eficiencia="munição Ineficiente para a realização de tiros.";
        $condicoes='Ineficiente';
        $this->tabela2($arraymunicao15,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao16)>0){
        
        $instituto='usando a arma encaminhada para exame';
        $coleta='';
        $percutido=['',''];
        $eficiencia="munição Ineficiente para a realização de tiros.";
        $condicoes='Ineficiente';
        $this->tabela2($arraymunicao16,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }

    if(count($arraymunicao17)>0){
        
        $instituto='';
        $coleta='';
        $percutido=['Os cartuchos percutidos e não deflagrados foram retornados à Central de Custódia, devidamente embalados ','preservando a integridade das marcas de percussão para futuros exames de comparação microbalística, prestando ainda como prova material de tentativa de disparo de arma de fogo.'];
        $eficiencia="";
        $condicoes='preservado';
        $this->tabela2($arraymunicao17,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    //----------
    if(count($arraymunicao18)>0){
        
        $instituto='usando arma fornecida por esta Unidade de Execução Técnico Científica';
        $eficiencia="munição parcialmente eficiente para a realização de tiros.";
        $percutido=[" "," "];
        $coleta='e/ou utilizados no procedimento de coleta de padrão balístico abaixo citado. ';
        $condicoes='parcialmente';
        $this->tabela2($arraymunicao18,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao19)>0){
    
        $instituto='usando a arma encaminhada para exame';
        $coleta='e/ou utilizados no procedimento de coleta de padrão balístico abaixo citado. ';
        $eficiencia="munição parcialmente eficiente para a realização de tiros.";
        $percutido=[" "," "];
        $condicoes='parcialmente';
        $this->tabela2($arraymunicao19,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao20)>0){
        
        $instituto='usando arma fornecida por esta Unidade de Execução Técnico Científica';
        $coleta='';
        $eficiencia="munição parcialmente eficiente para a realização de tiros.";
        $percutido=[" "," "];
        $condicoes='parcialmente';
        $this->tabela2($arraymunicao20,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao21)>0){
        
        $instituto='usando a arma encaminhada para exame';
        $percutido=['',''];
        $eficiencia="munição parcialmente eficiente para a realização de tiros.";
        $coleta='';
        $condicoes='parcialmente';
        $this->tabela2($arraymunicao21,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao22)>0){
        
        $instituto='usando arma fornecida por esta Unidade de Execução Técnico Científica';
        $percutido=['',''];
        $eficiencia="munição parcialmente eficiente para a realização de tiros.";
        $coleta='e/ou utilizados no procedimento de coleta de padrão balístico abaixo citado. ';
        $condicoes='parcialmente';
        $this->tabela2($arraymunicao22,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao23)>0){
        
        $instituto='usando a arma encaminhada para exame';
        $coleta='e/ou utilizados no procedimento de coleta de padrão balístico abaixo citado.';
        $percutido=['',''];
        $eficiencia="munição parcialmente eficiente para a realização de tiros.";
        $condicoes='parcialmente';
        $this->tabela2($arraymunicao23,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao24)>0){
    
        $instituto='usando arma fornecida por esta Unidade de Execução Técnico Científica';
        $coleta='';
        $percutido=['',''];
        $eficiencia="munição parcialmente eficiente para a realização de tiros.";
        $condicoes='parcialmente';
        $this->tabela2($arraymunicao24,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    if(count($arraymunicao25)>0){
    
        $instituto='usando a arma encaminhada para exame';
        $coleta='';
        $percutido=['',''];
        $eficiencia="munição parcialmente eficiente para a realização de tiros.";
        $condicoes='parcialmente';
        $this->tabela2($arraymunicao25,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    
    if(count($arraymunicao26)>0){
    
        $instituto='';
        $coleta='';
        $percutido=['',''];
        $eficiencia="";
        $condicoes='preservado';
        $this->tabela2($arraymunicao26,$this->i,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes);
    }
    //----------
    }

        //Função para a criação da tabela e seus campos
    public function tabela2($arraymunicao,$item,$laudo,$instituto,$coleta,$eficiencia,$percutido,$condicoes){
        global $itensCartuchoTeste;//variavel criada para referencia os itens da tabela na conclusão final do laudo
        $itensCartuchoFotografia=[];
        global $itensCartucho;//variavel para o item da coluna
            $legendaArray=[];
            $numeroContagem=[];
            foreach($arraymunicao as $municao){
                array_push($numeroContagem,$municao->quantidade);
            }
            $qunttcartucho=array_sum($numeroContagem);
            

        $this->phpWord->addTableStyle('tabela', $this->styleTable, $this->styleFirstRow); 


        /*
        *
        *Numero da Tabela
        */ 
            $extenso = new NumberFormatter('pt_BR',NumberFormatter::SPELLOUT);
            global $numTab;
            
            foreach($arraymunicao as $municao){ 
                $condicao= mb_strtoupper($municao->funcionamento).'S';
            };
            
           
            $itens=1;
            $text=[
            
            $textrun = $this->section->addTextRun($this->config->paragraphJustify()),         
            $textrun->addText('Trata-se de ',$this->config->arial12()),
            $textrun->addText($extenso->format($qunttcartucho).' cartuchos ',$this->config->arial12Underline()),
            $textrun->addText(' próprios para uso em armas de fogo, integralmente descritos no quadro a seguir:',$this->config->arial12()),
            
            $textrun->addTextBreak(1),
        
            $table = $this->section->addTable('tabela'),
            $table->addRow(10),
            $table->addCell(null,['bgColor'=>'d3d3d3'])->addText(' TABELA '.$numTab.' – DESCRIÇÃO DO(S) CARTUCHO(S) '.$condicao, $this->fontStyle, $this->paraStyle),//cabeçalho tabela
            $table->addRow(10),
            $table->addCell(450)->addText('Item', $this->fontStyle,$this->paraStyle),
            $table->addCell(400)->addText('Qtd', $this->fontStyle,$this->paraStyle),
            $table->addCell(1100)->addText('Calibre Nominal', $this->fontStyle,$this->paraStyle),
            $table->addCell(1070)->addText('Marca', $this->fontStyle,$this->paraStyle),
            $table->addCell(1550)->addText('Procedência', $this->fontStyle,$this->paraStyle),
            $table->addCell(1200)->addText('Espoleta', $this->fontStyle,$this->paraStyle),
            $table->addCell(1300)->addText('Estojo (Lote)', $this->fontStyle,$this->paraStyle),
            $table->addCell(820)->addText('Projétil', $this->fontStyle,$this->paraStyle),
            $table->addCell(1220)->addText('Condição Observação', $this->fontStyle,$this->paraStyle)];
                
            $table->addRow();   
            foreach($arraymunicao as $municao){
                $lote=($municao->lote=='')?'':"($municao->lote)";
                $table->addCell(400)->addText($itensCartucho,null,$this->paraStyle);
                $table->addCell(400)->addText($municao->quantidade,null,$this->paraStyle);
                $table->addCell(1100)->addText($municao->calibre->nome,null,$this->paraStyle);
                $table->addCell(1070)->addText(mb_strtoupper($municao->marca->nome),null,$this->paraStyle);
                $table->addCell(1600)->addText(mb_strtoupper($municao->marca->fabricacao),null,$this->paraStyle);
                $table->addCell(1100)->addText(mb_strtoupper($municao->tipo_projetil),null,$this->paraStyle);
                $estojoCell=$table->addCell(1400);
                $estojoCell->addText(mb_strtoupper($municao->estojo),null,$this->paraStyle);
                $estojoCell->addText(mb_strtoupper($lote),null,$this->paraStyle);
                $table->addCell(820)->addText(strtoupper($municao->projetil),null,$this->paraStyle);
                $condicaoCell=$table->addCell(1250);
                $condicaoCell->addText(mb_strtoupper($municao->funcionamento),null,$this->paraStyle);
                $condicaoCell->addText(mb_strtoupper($municao->observacao),null,$this->paraStyle);
                $table->addRow(10);
                
                array_push($legendaArray,$municao->projetil);
                $itensCartuchoFotografia[] = $itensCartucho;
                $itensCartucho++; 
                $itensCartuchoTeste[] = $condicoes;
                
            }
          
            $cell=$table->addCell();
            $cell->addText('Legenda:',['bold'=>true,'size'=>9]);
            $this->legenda($legendaArray,$cell);

            $this->section->addTextBreak(1);
                [
                $textrun = $this->section->addTextRun($this->config->paragraphJustify()),  ];
                
                $textrun->addText($percutido[0],$this->config->arial12());
                
                $textrun->addText($percutido[1],$this->config->arial12());
                if($eficiencia!=''){
                    [$textrun->addText('Buscando testar a eficiência dos cartuchos, o Perito submeteu-os ao teste de tiro, ',$this->config->arial12()),
                    $textrun->addText($instituto,$this->config->arial12()),
                    $textrun->addText(' e efetuando disparos. Foram observados os funcionamentos normais dos seus componentes, os quais deflagraram as respectivas cargas de projeção ao serem as espoletas percutidas por uma só vez. Os remanescentes foram devidamente descartados. ',$this->config->arial12()),
                    $textrun->addText($coleta,$this->config->arial12()),];
                    $textrun->addText('Nestas condições, verificou-se estar a ',$this->config->arial12());
                    $textrun->addText($eficiencia,$this->config->arial12Bold());
                    $this->section->addTextBreak(1);
                }else{
                    [$textrun->addText('Os cartuchos percutidos e não deflagados não tiveram sua eficiência testada, ',$this->config->arial12()),
                    $textrun->addText($instituto,$this->config->arial12()),
                    $textrun->addText('sendo preservados para eventual exame complementar e servindo também como da intenção de tiro.',$this->config->arial12()),
                    $textrun->addText($coleta,$this->config->arial12()),];
                    
                    $this->section->addTextBreak(1);
                }
                $this->i++;

                $this->section->addTextBreak(1);
                
                $inicio=0;
                
                $indiceItem = 0; //indice dos itens na tabela cartuchos
                foreach($arraymunicao as $municao){
                    //se não tiver imagem pula pra proxima interação
                    if($municao->up_image=="imagem nao salva"||$municao->up_image2=="imagem nao salva"){
                        $indiceItem++; 
                        continue; 
                    }
                    $this->imagemMuniCartucho($municao,$condicao,$itensCartuchoFotografia,$indiceItem);
                    $indiceItem++; 
                };
                
                $numTab++;    
                $this->section->addTextBreak(1);
            
                global $i;
                $i=$this->i;
            
            }

        
    

    protected function estojos($phpWord,$section,$config,$laudo){ 
        global $i;
        $arraynum=[];
        foreach($laudo->municoes as $municao){
            if($municao->tipo_municao=='estojo'){
                array_push($arraynum,1);
            
        }}


        /*
        *
        *Numero da Tabela
        */ 
        
        $tabelaProjetil=false;
        if(count($laudo->componentes)>0){
            foreach($laudo->componentes as $componente){
                if(count($componente->imagensProjetil)>0){
                    $tabelaProjetil=true;

                }
            }}


        if(count($laudo->imagens)>0){
            $numeroTabela=$i+3;
            if($tabelaProjetil){
                $numeroTabela+=1;
                
            }
        }else{
            $numeroTabela=$i+2;
                if($tabelaProjetil){
                    $numeroTabela+=1;
                    
                }
            }
        
            foreach($laudo->municoes as $municao){

                if(count($municao->imagens)>0){
                    $numeroTabelaImage=$numeroTabela;

                    $numeroTabelaImage+=1;

                }
            }
        
        $ligaTabela=false;
       
        $identificacaoEstojo=1;
            foreach($laudo->municoes as $municao){  
                
                if($municao->tipo_municao=='estojo'){ 
                    $ligaTabela=true;
                }}
                if($ligaTabela){
                    $this->tabelaEstojo($laudo,$i,$identificacaoEstojo,$numeroTabela);
                    $this->section->addTextBreak(1);
                    $i++;
                $identificacaoEstojo++;
                    $textrun = $this->section->addTextRun($this->config->paragraphJustify()); 
                
                
                    if($municao->funcionamento=="percutido e deflagrado"){
                        $estojoDescricao='estojos percutido e deflagrado';}
                    else if($municao->funcionamento=="intacto"){
                        $estojoDescricao='estojos intacto';
                    }else if($municao->funcionamento=="percutido e não deflagrado"){
                        $estojoDescricao="percutido e não deflagrado";
                    }
                    
                    if($laudo->laudoEfetConst=="B601"&&$municao->funcionamento=="percutido e deflagrado"){
                        $textrun->addText('Os ',$this->config->arial12()); 
                        $textrun->addText($estojoDescricao,$this->config->arial12Underline());
                        $textrun->addText(' foram retornados à Central de Custódia, devidamente embalados, garantindo a integridade das marcas de percussão para futuros exames de comparação microbalística, prestando ainda como ',$this->config->arial12());
                        $textrun->addText('prova material de disparo de arma de fogo. ',$this->config->arial12Underline()); 
                        $this->section->addTextBreak(1);
                        $this->i++; 
                        $this->section->addTextBreak(1);}
                        
                    
                    
                        $inicio=0;
                        
                        $this->imagemMuni($laudo,$inicio);
        
                        $this->section->addTextBreak(1);
                    
                }
                }  
        //Função para a criação do texto e da tabela de estojo          
    public function tabelaEstojo($laudo,$item,$identificacaoEstojo,$numeroTabela){
        $ligaItemCartucho=false;//verefica se tem algum exame de cartucho
        $ligaItemArma=false;
        if(count($laudo->armas)>0){
            $ligaItemArma=true;
        }
            foreach($laudo->municoes as $municao){  
                if($municao->tipo_municao=='cartucho'){ 
                    $ligaItemCartucho=true;//verefica se tem algum exame de cartucho e passa a variavel para true
                } }
            $numeroContagem=[];
            foreach($laudo->municoes as $municao){
                if($municao->tipo_municao=="estojo"){
                    array_push($numeroContagem,$municao->quantidade);
                }
            }
            $qunttestojo=array_sum($numeroContagem);
        
            
            $this->phpWord->addTableStyle('tabela', $this->styleTable, $this->styleFirstRow);
            $lote=($municao->lote=='')?'':"($municao->lote)";


            $tabelaProjetil=false;
            if(count($laudo->componentes)>0){
                foreach($laudo->componentes as $componente){
                    if(count($componente->imagensProjetil)>0){
                        $tabelaProjetil=true;

                    }
                }}

        global $numTab;
        //caso o cartuchos exista ele adiciona 
        if($ligaItemCartucho){
            $itemEstojo=3;
        }elseif($ligaItemArma){
            $itemEstojo=2;
        }else{
            $itemEstojo=1;
        }
        if(count($laudo->componentes)>0){ 
            //adiciona mais um caso tenha projetil 
            $itemEstojo+=1;
        }
        $extenso = new NumberFormatter('pt_BR',NumberFormatter::SPELLOUT);       
        $text=[
        
                $this->section->addText('3.'.$itemEstojo.' DOS ESTOJOS', $this->config->arial12Bold(), $this->config->paragraphJustify()),
                $textrun = $this->section->addTextRun($this->config->paragraphJustify()),
                $textrun->addText('Trata-se de ',$this->config->arial12()),
                $textrun->addText($extenso->format($qunttestojo).' estojos ',$this->config->arial12Underline()),
                $textrun->addText('provenientes de cartuchos próprios para uso em armas de fogo, '.$municao->funcionamento.', integralmente descritos no quadro a seguir:',$this->config->arial12()),
                $this->section->addTextBreak(1),
                $table = $this->section->addTable('tabela'),
                $table->addRow(10,['tblHeader'=>true]),
                $table->addCell(null,['bgColor'=>'D3D3D3'])->addText(' TABELA '.$numTab.' – DESCRIÇÃO DOS ESTOJOS', $this->fontStyle, $this->paraStyle),//cabeçalho tabela
                $table->addRow(null),
                $table->addCell(1900)->addText('Identificação', $this->fontStyle,$this->paraStyle),
                $table->addCell(500)->addText('Qtd', $this->fontStyle,$this->paraStyle),
                $table->addCell(1400)->addText('Calibre Nominal', $this->fontStyle,$this->paraStyle),
                $table->addCell(1000)->addText('Marca', $this->fontStyle,$this->paraStyle),
                $table->addCell(1400)->addText('Procedência', $this->fontStyle,$this->paraStyle),
            // $table->addCell(1500)->addText('Espoleta', $this->fontStyle,$this->paraStyle),
                $table->addCell(1500)->addText('Estojo (Lote)', $this->fontStyle,$this->paraStyle),
                $table->addCell(1400)->addText('Calibre Nominal', $this->fontStyle,$this->paraStyle)];

        
                $numTab++;
                $eqCont=1;
                $quantidade=0;
            
            
            foreach($laudo->municoes as $municao){
                if($municao->tipo_municao=="estojo"){
                    $table->addRow(10,['tblHeader'=>true]);
    
                    $quantidade+=$municao->quantidade;                                 
                    $table->addCell()->addText('EQ '.$eqCont.' a EQ '.$quantidade,null,$this->paraStyle);
                    $table->addCell(600)->addText($municao->quantidade,null,$this->paraStyle);
                    $table->addCell()->addText($municao->calibre->nome,null,$this->paraStyle);
                    $table->addCell(800)->addText($municao->marca->nome,null,$this->paraStyle);
                    $table->addCell()->addText(mb_strtoupper($municao->marca->fabricacao),null,$this->paraStyle);
                                        
            // $table->addCell()->addText(mb_strtoupper($municao->tipo_projetil),null,$this->paraStyle);
                    $table->addCell()->addText(mb_strtoupper($municao->estojo).' '.mb_strtoupper($lote).'' ,null,$this->paraStyle);
                    $table->addCell()->addText(mb_strtoupper($municao->calibre->nome),null,$this->paraStyle);
                
                    $eqCont+=$municao->quantidade;
    
                    $item++;
            }
            }
                
        }
        
        //Imagens dos estojos
        public function imagemMuni($laudo,$inicio){
            
                        global $numTab;
                        //verefica se é estojo
                        if($laudo->municoes[$inicio]->tipo_municao=='estojo'){
                            
                            $imagem = $this->imagem($laudo->municoes[$inicio]);
                            if(isset($imagem[0]) || isset($imagem[1]))
                            {
                                
                                $table = $this->section->addTable('tabela2img');
                                $table->addRow(10,['tblHeader'=>true]);   
                                $table->addCell(null,['bgColor'=>'d3d3d3'])->addText('Tabela '.$numTab.' Tomada(s) fotográfica(s) Estojo(s) Lacre '.$laudo->municoes[$inicio]->lacrecartucho, $this->fontStyle, $this->paraStyle);//cabeçalho da tabela
                                $table->addRow(10,['cantSplit'=>false]);
                                $tabelaImg=$table->addCell();
                                $tabelaImg->addImage($this->imagem($laudo->municoes[$inicio])[0], array('alignment' => Jc::CENTER, 'width' => 220)); 
                                $tabelaImg->addText('Estojo(s) calibre '.$laudo->municoes[$inicio]->calibre->nome,$this->fontStyle,$this->paraStyle);
                                
                                
                                
                                if(!empty($this->imagem($laudo->municoes[$inicio])[1])){
                                $tabelaImg=$table->addCell();
                                $tabelaImg->addImage($this->imagem($laudo->municoes[$inicio])[1], array('alignment' => Jc::CENTER, 'width' => 220)); 
                                $tabelaImg->addText('Estojo(s) calibre '.$laudo->municoes[$inicio]->calibre->nome,$this->fontStyle,$this->paraStyle);
                                }
                                $inicio++;
                                if(!empty($laudo->municoes[$inicio])){
                                    
                                    $this->imagemMuni($laudo,$inicio);
                                    
                                } 
                            

                            }else{  
                                $inicio++;
                                
                                            if(!empty($laudo->municoes[$inicio])){
                                            
                                                $this->imagemMuni($laudo,$inicio);
                                                
                                            } 
                            }
                            $this->section->addTextBreak(1);
                        }
                        else{
                            //caso não seje estojo ele pula para o proximo até encontrar um estojo
                            if (!empty($laudo->municoes) && is_array($laudo->municoes) && array_key_exists($inicio, $laudo->municoes)) {
                                $this->imagemMuni($laudo, $inicio);
                            } else {
                                // Enquanto o índice existir e não for "estojo", continue procurando
                                while (isset($laudo->municoes[$inicio]) && $laudo->municoes[$inicio] !== 'estojo') {
                                    $inicio++;
                                }
                            
                                // Verifica novamente se o índice existe antes de chamar a função
                                if (isset($laudo->municoes[$inicio])) {
                                    $this->imagemMuni($laudo, $inicio);
                                }
                            }
                            
                            }
                                    
                        
                    $numTab++;
                

            
    }      
    //imagens dos cartuchos  
    public function imagemMuniCartucho($municao,$condicao,$itensCartuchoFotografia, $indiceItem){
        if (!isset($itensCartuchoFotografia[$indiceItem])) {
            return; // Sai da função se não houver mais itens
        }
        
        global $numTab;
        $numTab++;
        /*  */
       
        $imagem = $this->imagem($municao);
        
            $table = $this->section->addTable('tabela2img');
            $table->addRow(10,['tblHeader'=>true]); 
            
            $table->addCell(null,['bgColor'=>'d3d3d3'])->addText('Tabela '.$numTab.' Tomada(s) fotográfica(s) do(s) Cartucho(s) '.$condicao. ' item ' .$itensCartuchoFotografia[$indiceItem]. ' Lacre ' .$municao->lacrecartucho, $this->fontStyle, $this->paraStyle);//cabeçalho da tabela
            
            $table->addRow(10,['cantSplit'=>false]);
        
        $this->section->addTextBreak(1);
    
        if($municao->tipo_municao=='cartucho')
            {
            

            if(!isset($imagem[0]) || !isset($imagem[1]) || !$imagem[0] || !$imagem[1]){

            }else{
                $tabelaImg=$table->addCell();
                $tabelaImg->addImage($this->imagem($municao)[0], array('alignment' => Jc::CENTER, 'width' => 220)); 
                $tabelaImg->addText('Posição 1 -Cartucho(s) calibre '.$municao->calibre->nome,$this->fontStyle,$this->paraStyle);
                
                
                
                if(!empty($this->imagem($municao)[1])){
                    $tabelaImg=$table->addCell();
                    $tabelaImg->addImage($this->imagem($municao)[1], array('alignment' => Jc::CENTER, 'width' => 220)); 
                    $tabelaImg->addText('Posição 2 -Cartucho(s) calibre '.$municao->calibre->nome,$this->fontStyle,$this->paraStyle);
                }
                
               
            }
                    
            
    
    }
   
    

    }        

    //Função para adicionar imagens na tabela
    public function imagem($municao){
       
      
        $contagem=[];
       
                
                $source = storage_path('app/public/' . $municao->up_image);
                $source2 = storage_path('app/public/' . $municao->up_image2);

                if (file_exists($source)&&file_exists($source2)) {
                    $fileContent = file_get_contents($source);
                    $fileContent2 = file_get_contents($source2);
                    $contagem[0]=$fileContent;
                    $contagem[1]=$fileContent2;
                } else {
                    
                }
              
            return $contagem;
    

    }
    

}


         

