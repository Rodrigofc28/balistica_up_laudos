<?php



namespace App\Models\Gerador;

use App\Models\Arma;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
use PhpOffice\PhpWord\Style\Section;
use NumberFormatter;
use Illuminate\Http\UploadedFile;
class ArmasText 
{
    
    private $section, $i, $config, $phpWord;

    public function __construct($section, $config, $i,$phpWord)
    {
        
        $this->section = $section;
        $this->config = $config;
        $this->i = $i;
        $this->phpWord=$phpWord;
    }

    public function medidas ($armamedida,$medida){

        if($armamedida!=''){
        $medidareal=$medida.''.$armamedida;
        return $medidareal;}
        else if($armamedida==''){
        $medidareal='xxxxx';
        return $medidareal;}
    }
    public function img64base($a){
        
        $imageR = $a; // decodifica do banco a image em base 64
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageR)); // tira #^data:image/\w+;base64,#i
        
        $tempFilePath = storage_path('app/public/imagensArmas'). '/' . uniqid() . '.jpg'; // cria um diretorio temporariosys_get_temp_dir() 
         file_put_contents($tempFilePath, $imageData);//colocar arquivo
         
        // quando a image vêm de um input do tipo file não precisa transforma em um objeto porque ela já é, porem quando ta em base64 sim ae se usa o UploadedFile
          $imageConvertida = new UploadedFile($tempFilePath, 'diario_num_one.jpg', 'image/jpeg', null, true);
       
            
        $fileC = file_get_contents($imageConvertida); //pegar arquivo
        return $fileC;
    }

    


    public function addText($laudo)
    {
        /*
         *num_lacre_saida é o lacre de entrada
         */
        
        $fontStyle = array ('bold' => true); 
        $paraStyle = array ('align' =>'center');
        $styleTable = array('borderColor'=>'999999','borderSize'=>10, 'cellMarginTop'=>10,'cellMarginLeft'=>0,'cellMarginRight'=>0,'cellSpacing'=>10000); //configuração da borda
        $styleFirstRow = array('bgColor'=>' #F0F0F0');
        $tamanhocel=array('cellSpacing');
        $cellStyle = array(
            'borderColor' => '006699',
            'borderSize'  => 100,
            
        );
        $this->phpWord->addTableStyle('tabelaArmas', $styleTable, $styleFirstRow);
        $this->phpWord->addTableStyle('tabela2img', $styleTable, $styleFirstRow);
        

        $a=0;
        $b=1;
        $c=2;
        
        
        $contadorAlfanumerico=1;
        foreach ($laudo->armas as $arma) {
            
            if(!empty($arma->imagemCantoSuperior)){

                $imagemCantoSuperior = $this->img64base($arma->imagemCantoSuperior);
            }else{
                $imagemCantoSuperior = "";
            }


            if(!empty($arma->imagemCantoInferior)){
                $imagemCantoInferior = $this->img64base($arma->imagemCantoInferior);
            }else{
                $imagemCantoInferior = "";
            }

            if(!empty($arma->imagemNumSerie)){
                $imagemNumSerie = $this->img64base($arma->imagemNumSerie);
            }else{
                $imagemNumSerie = "";
            }
            
            
            $this->tabelaarmas($arma,$fontStyle,$paraStyle,$laudo,$contadorAlfanumerico);

            $contadorAlfanumerico++;
         
            $tabelaImage=$this->i+1;
            
            global $numTab;

            $table = $this->section->addTable('tabela2img');
            $table->addRow(10,['tblHeader'=>true]);
            $table->addCell(null,['bgColor'=>'d3d3d3'])->addText('Tabela '.$numTab.' -Tomadas fotográficas- '.$arma->tipo_arma, $fontStyle, $paraStyle);//cabeçalho da tabela
            $imagemCantoSuperior!=''?[$table->addRow(10,['cantSplit'=>true]),
            $img=$table->addCell(),
            $img->addImage($imagemCantoSuperior, array('alignment' => Jc::CENTER, 'width' => 450, 'height'=>250)),
            $img->addText('Vista lateral direita', $fontStyle, $paraStyle)]:'';
            $imagemCantoInferior!=''||$imagemNumSerie!=''?$table->addRow(10):'';
            $imagemCantoInferior!=''?[$img2=$table->addCell(),
            $img2->addImage($imagemCantoInferior, array('alignment' => Jc::CENTER, 'width' => 220, 'height'=>150)),
            
            $img2->addText('Vista lateral esquerda', $fontStyle, $paraStyle)]:'';
            
            $imagemNumSerie!=''?[$img3= $table->addCell(),
            $img3->addImage($imagemNumSerie, array('alignment' => Jc::CENTER, 'width' => 220, 'height'=>150)),
            $img3->addText('Número de série', $fontStyle, $paraStyle)]:'';
            $numTab++;
            
            $this->section->addTextBreak(1);
            
            
            
        }
        
        return array('i' => $this->i, 'section' => $this->section);
        
    }
       
       public function funcionamento($laudo,$arma,$textrun)
    {      
        
        if($arma->institutoArma==null){
           $testeMunicao="encaminhadas para o exame"; 
        }else{
            $testeMunicao="fornecida por este Instituto"; 
        }      
        
        if ($arma->funcionamento == 'eficiente') {
            $textoEficiencia="Buscando atestar tais atributos da arma, o Perito(a) submeteu-a ao teste de tiro, usando as munições de correspondente calibre $testeMunicao e efetuando disparos em ação simples e ação dupla. Foram observados os funcionamentos normais dos seus componentes, os quais deflagraram as respectivas cargas de projeção ao serem as espoletas percutidas por uma só vez. Os remanescentes da munição foram devidamente descartados. Nestas condições, verificou-se estar a";
            $textoEficienciaSublinhado=" arma eficiente para a realização de tiros.";
           
           if($laudo->sinab=="1"){
            $fraseBancoPerfilBalistico=" e/ou inclusão no Banco Nacional de Perfis Balísticos";}
            else{
                $fraseBancoPerfilBalistico="";
            }
         
            
            $coletaPadraoBalistico="Cumpre informar que foram coletados padrões balísticos da arma em exame, com o propósito de viabilizar futuros exames complementares" .$fraseBancoPerfilBalistico.", conforme descrito no Relatório de Coleta de Padrão nº $arma->rep_materialColetado.";
           
           $textrun->addText($textoEficiencia, $this->config->arial12());
           $textrun->addText($textoEficienciaSublinhado,$this->config->arial12Underline());
          // $this->section->addPageBreak(1);
           $tituloColetaBalistico=$this->section->addText('c) Coleta de Padrões Balísticos:', $this->config->arial12Bold());
           $this->section->addTextBreak(1);
           $textoColetaBalistico=$this->section->addText($coletaPadraoBalistico,$this->config->arial12(),$this->config->paragraphJustify());
           
           return [$textrun, $tituloColetaBalistico,$textoColetaBalistico ];
            
             
        }
        if ($arma->funcionamento == 'ineficiente') {
            $textoInificiente="Submetida esta arma de fogo a prova de disparo foi observado o funcionamento dos seus mecanismos, porém a mesma não percutiu eficientemente os estojos a fim de deflagrar a munição, não estando apta para realização de disparos, podendo ainda ser utilizada como instrumento contundente e/ou de intimidação.";
            
            $textrun->addText($textoInificiente, $this->config->arial12());
            
            return $textrun;
        }
    }

    public function imagem($arma){
        
        $i=0;
        $contagem=[];
        $imagens = $arma->imagens;
       
        if ($imagens->count() > 0) {
            foreach ($imagens as $imagem) {
                $source = storage_path('app/public/imagens/' . $imagem->nome);
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

    public function tabelaarmas($arma,$fontStyle,$paraStyle,$laudo,$contadorAlfanumerico){
            $this->i++;
        
            $contagem=$this->i;
            $dig2 = 1; 
            for ($cn = 0; $this->i > 9; $cn++) {
                $this->i=1; 
                $dig2 = $cn;
            }
            $laudoArma = Arma::arma($arma);
           $ordemAlfabeto=[1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',25=>'Z',26=>'Y'];
            
           $alturaArma=$arma->altura;
            if($arma->altura!=''){
            $alturaArma=["ALTURA ","$arma->altura cm"] ;
            
            }else{
                $alturaArma=[" "," "] ; 
            }
            
            if($arma->tipo_arma=="Revólver"||$arma->tipo_arma=="Fuzil"){
                $preposicaoArma="do";
            }else{
                $preposicaoArma="da";
            }
            $tabelaProjetil=false;
            

            if(count($laudo->municoes)>0){
            foreach($laudo->municoes as $componente){
                if(count($componente->imagens)>0){
                    $tabelaProjetil=true;
                }
            }}

            $numeroTabela=$contagem;
            
            if(count($laudo->imagens)>0){
                
                if(count($arma->imagens)>0){
                    $numeroTabela++;
                }
                $numeroTabela+=3;
                if($tabelaProjetil==true){
                    $numeroTabela++;
                }
                }else{
                    if(count($arma->imagens)>0){
                        $numeroTabela++;
                    }
                    
                    if($tabelaProjetil==true){
                        $numeroTabela++;
                    }

                    $numeroTabela+=2;
                  
                }
          
            global $numTab;
            $numTab;
            $extenso = new NumberFormatter('pt_BR',NumberFormatter::SPELLOUT);
            $this->section->addTextBreak(1);
            
            $textrun = $this->section->addTextRun($this->config->paragraphJustify());
            $textrun->addText('3. '.$dig2.'. '. $contagem.' -DA ARMA AF-'.$ordemAlfabeto[$contadorAlfanumerico].' - '.mb_strtoupper($arma->marca->nome).' '.$arma->modelo.' – LACRE DE ENTRADA '.$arma->num_lacre_saida, $this->config->arial12Bold());
            $this->section->addTextBreak(1);
            $this->section->addText('a) Descrição da arma:', $this->config->arial12Bold()); 
            $table=$this->section->addTable('tabelaArmas');
            $table->addRow(50,['tblHeader'=>true]);
            $table->addCell(5050,['bgColor'=>'d3d3d3'])->addText('TABELA '.$numTab.' – Descrição '.$preposicaoArma.' '.$arma->tipo_arma,$fontStyle, $paraStyle);

            $table->addRow(50,['cantSplit'=>true]);                         
            $table->addCell(2000,['vMerge'=>'restart'])->addText('Características Identificadoras', $fontStyle,$paraStyle); 
            $table->addCell(2000)->addText('Marca:', $fontStyle,$paraStyle);
            $table->addCell(5050)->addText(mb_strtoupper($arma->marca->nome),null,$paraStyle);
            //modelo
            ($arma->modelo!='')?[$table->addRow(50,['cantSplit'=>true]),
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''),                      
            $table->addCell(3050)->addText('Modelo:', $fontStyle,$paraStyle), 
            $table->addCell(5050)->addText($arma->modelo,null,$paraStyle)]:'';
            //calibre
            isset($arma->calibre->nome)?[$table->addRow(50,['cantSplit'=>true]),
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''),
            $table->addCell(1000)->addText('Calibre nominal:', $fontStyle,$paraStyle), 
            $table->addCell(5050)->addText($arma->calibre->nome,null,$paraStyle)]:'';
            //procedencia
            $table->addRow(50,['cantSplit'=>true]);
            $table->addCell(2000,['vMerge'=>'continue'])->addText(' '); 
            $table->addCell(2000)->addText('Procedência:', $fontStyle,$paraStyle);
            $table->addCell(5050)->addText(mb_strtoupper($arma->marca->fabricacao),null,$paraStyle);
            //Nº de serie
            ($arma->num_serie!="")?[$table->addRow(50,['cantSplit'=>true]),                
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''),  
            $table->addCell(3050)->addText('Nº de série:', $fontStyle,$paraStyle), 
            $table->addCell(5050)->addText(mb_strtoupper($arma->num_serie),null,$paraStyle)]:'';
            //Nº de patrimonio
            $arma->numero_patrimonio!=''?[$table->addRow(50,['cantSplit'=>true]),
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''),
            $table->addCell(1000)->addText('Nº de patrimônio:', $fontStyle,$paraStyle), 
            $table->addCell(5050)->addText($arma->numero_patrimonio,null,$paraStyle)]:"";
            //Nº de montagem
            $arma->numeracao_montagem!=''?[$table->addRow(50,['cantSplit'=>true]),
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''),
            $table->addCell(1000)->addText('Nº de montagem:', $fontStyle,$paraStyle), 
            $table->addCell(5050)->addText($arma->numeracao_montagem,null,$paraStyle)]:"";
            //características do funcionamento
            
            $table->addRow(50,['cantSplit'=>true]);                         
            $table->addCell(2000,['vMerge'=>'restart'])->addText('Características do funcionamento', $fontStyle,$paraStyle);
           

//Quantidade de canos
            

            $arma->num_canos!=''?[
            $table->addCell(1000)->addText('Quantidade de canos:', $fontStyle,$paraStyle), 
            $table->addCell(5050)->addText(mb_strtoupper($arma->num_canos),null,$paraStyle)]:'';

            //Regime de tiro
            $arma->sistema_funcionamento!=''?[$table->addRow(50,['cantSplit'=>true]),
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''),               
            $table->addCell(3050)->addText('Regime de tiro:', $fontStyle,$paraStyle),
            $table->addCell(5050)->addText(mb_strtoupper($arma->sistema_funcionamento),null,$paraStyle)]:'';
            
            //Comprimento do cano
            $arma->comprimento_cano!=''?[$table->addRow(50,['cantSplit'=>true]),
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''),
            $table->addCell(2000)->addText('Comprimento do cano:', $fontStyle,$paraStyle),
            $table->addCell(5050)->addText($arma->comprimento_cano.' cm',null,$paraStyle)]:'';
            //Diâmetro do cano
            $arma->diametro_cano!=''?[$table->addRow(50,['cantSplit'=>true]),
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''),        
            $table->addCell(3050)->addText('Diâmetro do cano:', $fontStyle,$paraStyle), 
            $table->addCell(5050)->addText($arma->diametro_cano.' mm',null,$paraStyle)]:'';
            //Nº de raias
            $arma->quantidade_raias!=''?[$table->addRow(50,['cantSplit'=>true]),
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''),
            $table->addCell(1000)->addText('Nº de raias:', $fontStyle,$paraStyle), 
            $table->addCell(5050)->addText(mb_strtoupper($extenso->format($arma->quantidade_raias)),null,$paraStyle)]:'';
            //Orientação das raias
            $arma->sentido_raias!=''?[$table->addRow(50,['cantSplit'=>true]),
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''),
            $table->addCell(1000)->addText('Orientação de raias:', $fontStyle,$paraStyle), 
            $table->addCell(5050)->addText(mb_strtoupper($arma->sentido_raias),null,$paraStyle)]:'';
            //tipo do tambor
            $arma->tipo_tambor!=''?[$table->addRow(50,['cantSplit'=>true]),                         
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''),
            $table->addCell(2000)->addText('Tipo do tambor:', $fontStyle,$paraStyle),
            $table->addCell(5050)->addText(mb_strtoupper($arma->tipo_tambor),null,$paraStyle)]:'';
            //Giro de tambor
            $arma->tambor_rebate!=''?[$table->addRow(50,['cantSplit'=>true]),
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''),                      
            $table->addCell(3050)->addText('Giro do tambor:', $fontStyle,$paraStyle), 
            $table->addCell(5050)->addText(mb_strtoupper($arma->tambor_rebate),null,$paraStyle)]:'';
            //Sistema de carregamento
            $arma->sistema_carregamento!=''?[$table->addRow(50,['cantSplit'=>true]),
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''),
            $table->addCell(1000)->addText('Sistema de carregamento:', $fontStyle,$paraStyle), 
            $table->addCell(5050)->addText(mb_strtoupper($arma->sistema_carregamento),null,$paraStyle)]:'';
            //Capacidade
            $arma->capacidade_carregador!=''?[$table->addRow(50,['cantSplit'=>true]),
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''),  
            $table->addCell(1000)->addText('Capacidade:', $fontStyle,$paraStyle), 
            $table->addCell(5050)->addText(mb_strtoupper($extenso->format($arma->capacidade_carregador)),null,$paraStyle)]:'';
            //Percussão
            $arma->sistema_percussao!=''?[$table->addRow(50,['cantSplit'=>true]),
            $table->addCell(2000,['vMerge'=>'continue'])->addText(' '), 
            $table->addCell(2000)->addText('Percussão:', $fontStyle,$paraStyle),
            $table->addCell(5050)->addText(mb_strtoupper($arma->sistema_percussao),null,$paraStyle)]:'';
            //Sistema de disparo
            $arma->sistema_disparo!=''?[$table->addRow(50,['cantSplit'=>true]),
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''),        
            $table->addCell(3050)->addText('Sistema de disparo:', $fontStyle,$paraStyle), 
            $table->addCell(5050)->addText(mb_strtoupper($arma->sistema_disparo),null,$paraStyle)]:'';
            //Outras caracteristicas
            $table->addRow(50,['cantSplit'=>true]);
            $table->addCell(2000,['vMerge'=>'restart'])->addText('Outras Características', $fontStyle,$paraStyle); 
            //Cabo
            $arma->cabo!=''?[$table->addCell(3050)->addText('Cabo:', $fontStyle,$paraStyle),
            $table->addCell(5050)->addText(mb_strtoupper($arma->cabo),null,$paraStyle)]:'';                     
            //Acabamento
            $arma->tipo_acabamento!=''?[$table->addRow(50,['cantSplit'=>true]),
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''),
            $table->addCell(1000)->addText('Acabamento:', $fontStyle,$paraStyle), 
            $table->addCell(5050)->addText(mb_strtoupper($arma->tipo_acabamento),null,$paraStyle)]:'';
            //Medidas
            $table->addRow(50,['cantSplit'=>true]);
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''); 
            $table->addCell(2000)->addText('Medidas:', $fontStyle,$paraStyle);
            $table->addCell(5050)->addText("COMPRIMENTO ".$arma->comprimento_total." cm $alturaArma[0]".$alturaArma[1],null,$paraStyle); 
            //Estado de conservação
            $arma->estado_geral!=''?[$table->addRow(50,['cantSplit'=>true]),                
            $table->addCell(2000,['vMerge'=>'continue'])->addText(''),        
            $table->addCell(3050)->addText('Estado de conservação:', $fontStyle,$paraStyle), 
            $table->addCell(5050)->addText(mb_strtoupper($arma->estado_geral),null,$paraStyle)]:'';
            $numTab++;

            $this->section->addTextBreak(1);
            
            $this->section->addText('b) Funcionamento e Eficiência:', $this->config->arial12Bold());
            $this->section->addTextBreak(1);
            $textrun = $this->section->addTextRun($this->config->paragraphJustify());
            $this->section->addTextBreak(1);
            
            $this->funcionamento($laudo,$arma,$textrun,null,$paraStyle);
            $this->section->addTextBreak(1);
            
            
              
    }
}
            
            
            
           
        

            
   

       
        
        
        
       
         