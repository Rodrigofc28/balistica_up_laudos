<?php



namespace App\Models\Gerador;


use PhpOffice\PhpWord\Shared\Converter;
use App\Models\Componente;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
use PhpOffice\PhpWord\Style\Table;
use NumberFormatter;
class ComponentesText
{
    private $section, $i, $config;
    private $fontStyle = array ('bold' => true); 
    private $paraStyle = array ('align' =>'center');
    private $styleTable = array('borderColor'=>'ffffff','borderSize'=>10,'cellMarginTop'=>10,'cellMarginLeft'=>0,'cellMarginRight'=>0,'cellSpacing'=>10000); //configuração da borda
    private $styleFirstRow = array('bgColor'=>' #F0FFFF');
    private $cellStyle=array('borderSize'=>50);

    public function __construct($section, $config,$i, $phpWord)
    {
        $this->section = $section;
        $this->config = $config;
        $this->phpWord = $phpWord;
        $this->i =$i;
        
    }

    
    

    public function addText($componentes,$laudo)
    {
        
        
        //Criando tabela Projetil onde 0 a 5 é uma tabela 6 a 10 
        $pQ=1;
        $arraycomp=[];
        for($i=0;$i<count($componentes)&&$i<5;$i++)
        {
            array_push($arraycomp,$componentes[$i]);
            
        }
        
   
 
        $table = $this->section->addTable('tabela',['cantSplit'=>false]);
        
        if($componentes!=null)
        {
            
            
            $this->tabelaProjetil($this->phpWord,$this->section,$this->config,$arraycomp,$pQ,$laudo);
        
        }
        if(count($componentes)>5&&count($componentes)<10)
        {
            $pQ=6;
            $arraycomp2=[];
            for($i=5;$i<count($componentes);$i++)
            {
                array_push($arraycomp2,$componentes[$i]);
            
            }
        
        $this->tabelaProjetil($this->phpWord,$this->section,$this->config,$arraycomp2,$pQ,$laudo);
        
        }
    if(count($componentes)>10){
        $pQ=11;
        $arraycomp2=[];
            for($i=10;$i<count($componentes);$i++)
            {
                array_push($arraycomp3,$componentes[$i]);
            
            }
        
        $this->tabelaProjetil($this->phpWord,$this->section,$this->config,$arraycomp2,$pQ,$laudo);
    }
    

    }





    protected function tabelaProjetil($phpWord,$section,$config,$componentes,$pQ,$laudo){ //tabela de cartuchos
        global $numTab;
        $this->i++;
       
       
    
        $this->phpWord->addTableStyle('tabela', $this->styleTable, $this->styleFirstRow);
        
         //colocar
        $quantidade=[];
       
        foreach($componentes as $componente){
            array_push($quantidade,$componente->quantidade_frascos);
            
            
        }
        $stringQuantidade=array_sum($quantidade);
        $extenso = new NumberFormatter('pt_BR',NumberFormatter::SPELLOUT);
        $nomecartucho=$extenso->format($stringQuantidade).' projétil';
        
        
        $text=[
                
                $this->section->addText('3.'.$this->i.' DOS PROJÉTEIS:', $this->config->arial12Bold(), $this->config->paragraphJustify()) ,
                $textrun = $this->section->addTextRun($this->config->paragraphJustify()), 
                $textrun->addText('Trata-se de ',$this->config->arial12()),
                $textrun->addText($nomecartucho,$this->config->arial12Underline()),
                $textrun->addText(' provenientes de munição própria para uso em armas de fogo, integralmente descritos no quadro a seguir:',$this->config->arial12()),
                $this->section->addTextBreak(1),
                 $table = $this->section->addTable('tabela'),
                $table->addRow(10,['tblHeader'=>true]),
                $table->addCell(null,['bgColor'=>'d3d3d3'])->addText(' TABELA '.$numTab.' –  DESCRIÇÃO DOS PROJÉTEIS', $this->fontStyle, $this->paraStyle),//cabeçalho tabela
                $table->addRow(10,['cantSplit'=>false]),
                $table->addCell(null,['bgColor'=>'d3d3d3'])->addText('Características', $this->fontStyle,$this->paraStyle),
                $this->caracteristica($componentes,$table,$pQ),
                $table->addRow(10),
                $table->addCell()->addText('Origem', $this->fontStyle,$this->paraStyle),
                $this->origem($componentes,$table),
                
                $table->addRow(10),
                $table->addCell()->addText('Tipo', $this->fontStyle,$this->paraStyle),
                $this->tipoProjetil($componentes,$table),
                $table->addRow(10),

                $table->addCell()->addText('Constituição e formato', $this->fontStyle,$this->paraStyle),
                $this->constituicao($componentes,$table),
                $table->addRow(10),
                $table->addCell()->addText('Massa (g)', $this->fontStyle,$this->paraStyle),
                $this->massa($componentes,$table),
                $table->addRow(10),
                $table->addCell()->addText('Calibre real médio (mm)', $this->fontStyle,$this->paraStyle),
                $this->calibreReal($componentes,$table),
                $table->addRow(10),
                $table->addCell()->addText('Altura máxima (mm)', $this->fontStyle,$this->paraStyle),
                $this->alturaProjetil($componentes,$table),
                $table->addRow(10),
                $table->addCell()->addText('Provável calibre nominal', $this->fontStyle,$this->paraStyle),
                $this->calibreNominal($componentes,$table),
                $table->addRow(10),
                
                $table->addCell()->addText('Cavados e Ressaltos', $this->fontStyle,$this->paraStyle),
                $this->cavadosRessaltos($componentes,$table),
                $table->addRow(10),
                $table->addCell()->addText('Raiamento e Orientação', $this->fontStyle,$this->paraStyle),
                $this->quantidadeRaias($componentes,$table),
                $table->addRow(10),
                $table->addCell()->addText('Tipo de Raiamento', $this->fontStyle,$this->paraStyle),
                $this->tipo_raiamento($componentes,$table),
                $table->addRow(10),
                $table->addCell()->addText('Deformações Acidentais', $this->fontStyle,$this->paraStyle),
                $this->deformacaoAcidental($componentes,$table),
                $table->addRow(10),
                $table->addCell()->addText('Aderências ', $this->fontStyle,$this->paraStyle),
                $this->aderencia($componentes,$table),
                $table->addRow(10),
                $cell=$table->addCell(),
                $cell->addText('Legenda:',['bold'=>true,'size'=>9]),
                $this->legenda($componentes,$cell,$table)

        ];
        $numTab++;
        $arrayImageProjetil=[];
        foreach($componentes as $componente){
            array_push($arrayImageProjetil,$componente->up_image,$componente->up_image2);}
/* projetil Imagem  */

$numImg=count($arrayImageProjetil); 

for($i=0;$i<count($arrayImageProjetil);$i++){
 
        if(!empty($arrayImageProjetil[$i])){
                        $source = storage_path('app/public/' .$arrayImageProjetil[$i]);
                    
                        if (file_exists($source)) {
                            
                        $fileContent = file_get_contents($source);
                        
                        $contagem[$i]=$fileContent;
                        
                        } else {
                        $this->section->addText("Ocorreu um erro com a imagem.", ['color' => "FF0000", 'size' => 14]);
                        }
                    
                }
} 


        if(!isset($item)){
        $item=1;}
        $this->section->addTextBreak(1);

           
        foreach($componentes as $componente){
        array_push($arrayImageProjetil,$componente->imagensProjetil);
            
            
        if(empty($this->imagem($componente)[0])){
        
        }else{

            $this->section->addTextBreak(1);
            $item++;
        
    }}

      
    global $cont;
    $cont = 0;
   
    if(!empty($contagem)) {
        for($cont2=0;$cont2<count($componentes);$cont2++){

             $this->imagemProj($contagem,$cont,$cont2);
             
             
           
             
        }
    }
  
     }
    
     protected function caracteristica($componentes,$table,$pQ){foreach($componentes as $componente){$teste=[$table->addCell(null,['bgColor'=>'d3d3d3'])->addText('PQ '.$pQ,null,$this->paraStyle),];$pQ++; }}  
     protected function origem($componentes,$table){foreach($componentes as $componente){ $repOrigem=($componente->rep_materialColetado!='')?" REP $componente->rep_materialColetado":'';$detOrigem=($componente->detalharLocalizacao!='')?"/ $componente->detalharLocalizacao":'';
        ;$teste=[$table->addCell()->addText("".mb_strtoupper($componente->origem_coletaPerito)."".mb_strtoupper($repOrigem)."".mb_strtoupper($detOrigem),null,$this->paraStyle)];}}
     protected function tipoProjetil($componentes,$table){foreach($componentes as $componente){$teste=[$table->addCell()->addText(mb_strtoupper($componente->tipo_projetil),null,$this->paraStyle)];}}
     protected function constituicao($componentes,$table){foreach($componentes as $componente){$teste=[$text2=$table->addCell(),$text2->addText($componente->constituicao_formato ,null,$this->paraStyle),$text2->addText(mb_strtoupper($componente->recoberto),null,$this->paraStyle)];}}
     protected function massa($componentes,$table){foreach($componentes as $componente){$teste=[$table->addCell()->addText($componente->massa,null,$this->paraStyle)];}}                            
     protected function calibreReal($componentes,$table){foreach($componentes as $componente){$teste=[$table->addCell()->addText($componente->calibreReal,null,$this->paraStyle)];}}       
     protected function alturaProjetil($componentes,$table){foreach($componentes as $componente){$teste=[$table->addCell()->addText($componente->altura_projetil,null,$this->paraStyle)];}}       
     protected function calibreNominal($componentes,$table){foreach($componentes as $componente){$teste=[$table->addCell()->addText($componente->calibreNominal,null,$this->paraStyle)];}}
     protected function cavadosRessaltos($componentes,$table){foreach($componentes as $componente){ $naoSeAplica='NÃO SE APLICA';$teste=[$table->addCell()->addText(($componente->tipo_projetil=="Núcleo")?$naoSeAplica:"$componente->cavados/$componente->ressaltos",null,$this->paraStyle)];}}    
     protected function quantidadeRaias($componentes,$table){foreach($componentes as $componente){$naoSeAplica='NÃO SE APLICA';$quntidadeRaias=($componente->sentido_raias=='')?'':$componente->quantidade_raias.' RAIAS ';$teste=[$table->addCell()->addText(($componente->tipo_projetil=="Núcleo")?$naoSeAplica:$quntidadeRaias.''.mb_strtoupper($componente->sentido_raias),null,$this->paraStyle)];}}
     protected function tipo_raiamento($componentes,$table){foreach($componentes as $componente){$teste=[$table->addCell()->addText(($componente->tipo_projetil=="Núcleo")?'NÃO SE APLICA':mb_strtoupper($componente->tipo_raiamento),null,$this->paraStyle)];}}
     protected function deformacaoAcidental($componentes,$table){foreach($componentes as $componente){$teste=[$table->addCell()->addText(mb_strtoupper($componente->deformacaoAcidental),null,$this->paraStyle)];}}                       
     protected function aderencia($componentes,$table){foreach($componentes as $componente){$teste=[$table->addCell()->addText($componente->aderencia,null,$this->paraStyle)];}}                          
     protected function legenda($componentes,$cell,$table)
     {
        
        
        $material=[];
        $constituicaoFormato=[];
        
        $arrayLegenda=['CHOG' =>'Chumbo Ogival', 
            'CHPP' =>'Cumbo Ponta Plana', 
            'CHCV' =>'Chumbo Canto Vivo', 
            'CSCV' =>'Chumbo Semi Canto Vivo' ,
            'EPP'=>'Encamisado Ponta Plana',
            'CXPO' =>'Cobre Expansivo Ponta Oca', 
            'EXPP' =>'Encamisado Expansivo Ponta Plana' ,
            'ETOG' =>'Encamisado Total Ogival' ,
            'ETPP' =>'Encamisado Total Ponta Plana' ,
            'ETPO' =>'Encamisado Total Ponta-Oca' ,
            'ETHS' =>'Encamisado Total Hydra-Shok' ,
            'ETPT' =>'Encamisado Total Pontiagudo' ,
            'EXPO' =>'Encamisado Expansivo Ponta Oca' ,
            'EXPT' =>'Encamisado Expansivo Pontiagudo' ,
            'ETPT' =>'Encamisado Total Pontiagudo Boat Tail' ,
            'HPBT' =>'Hollow Point Boat Tail' ,
            'SEPO' =>'Semi-encamisado Expansivo Ponta Oca',
            'SEPP' =>'Semi-encamisado Ponta Plana',
            'SAT' => ' Ponta de Aço',
            'POLÍMERO'=>'',
            'FRANGÍVEL'=>'' ,
            'BALINS CHSG' =>'(Ø8,4mm)',
            'BALINS CHSG4'=>' (Ø8,8mm)',
            'BALINS CHTTT' => '(Ø5,5mm)',
            'BALINS CHT' => '(Ø5mm)',
            'BALINS CH1' => '(Ø4mm)',
            'BALINS CH3' => '(Ø3,5mm)',
            'BALINS CH5' => '(Ø3mm)',
            'BALINS CH6' => '(Ø2,75mm)',
            'BALINS CH7' => '(Ø2,5mm)',
            'BALINS CH8' => '(Ø2,25mm)',
            'BALINS CH9' => '(Ø2mm)',
            'BALINS CH11' => '(Ø1,5mm)',
            'BALINS CH12' => '(Ø1,25mm)',
            'BALINS'=> 'MULTIPLOS',
            'BALOTE DE CHUMBO'=>'',
            'BALOTE SG1'=>'',
            'BALOTE FOSTER'=>'' ,
            'CHUMBO AMOLGADO'=>'',
            'FRAGMENTADO'=>'',
            'INDETERMINADO'=>'',
            'POLYMATCH'=>'']; 
            $aderencias=['TOD'=>'tecido Orgânico dessecado', 'NNI'=>'natureza não identificada',
            'SS'=>'natureza não identificada, de cor castanho avermelhado semelhante a sangue',
            'NDR'=>'Nada digno de registro','CALIÇA'=>'','MADEIRA'=>'','TERRA'=>'','OUTROS'=>''];
        foreach($componentes as $componente)
        { 
            
            $aderenciaArray=explode(', ',$componente->aderencia);

            foreach($aderenciaArray as $aderenciaString){
 
            if(($aderenciaString=='MADEIRA')||($aderenciaString=='CALIÇA')||($aderenciaString=='TERRA')||($aderenciaString=='OUTROS')){
                
                array_push($material,$aderencias[$aderenciaString]);
            }else{
                
                $aderenciaString=trim($aderenciaString);
                array_push($material,$aderenciaString,$aderencias[$aderenciaString]);
            }
  
        }
        
        $lengContForm=$arrayLegenda[$componente->constituicao_formato]==''?'':$componente->constituicao_formato;
        
       array_push($constituicaoFormato,$lengContForm,$arrayLegenda[$componente->constituicao_formato]);
       
          
    }
    
    $constituicaoFormato=array_unique($constituicaoFormato); //transforma os dados do array em unicos
    $material=array_unique($material);
    $constituicaoFormato=implode(' ',$constituicaoFormato);
    $material=implode(' ',$material);
  
    $cell->addText("$constituicaoFormato $material",['bold'=>false,'size'=>8]);
 
}               

     public function imagem($componente){
        
        $i=0;
        $contagem=[];
        $imagens = $componente->imagensProjetil;
       
        if ($imagens->count() > 0) {
            foreach ($imagens as $imagem) {
                
                $source = storage_path('app/public/imagensMunicaoProjeteis/' . $imagem->nome);
                
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
    
    public function imagemProj($contagem,&$cont,$cont2){
        
            global $numTab;
          $pq=$cont2+1;
       if(!empty($contagem[$cont]))
       {
            $table = $this->section->addTable('tabela2img');
            $table->addRow(10,['tblHeader'=>true]);
            $table->addCell(null,['bgColor'=>'d3d3d3'])->addText('Tabela '.$numTab.' Tomadas fotográficas Projétil', $this->fontStyle, $this->paraStyle);//cabeçalho da tabela
            $table->addRow(10,['cantSplit'=>false]);
            
            $table->addCell()->addImage($contagem[$cont], array('alignment' => Jc::CENTER, 'width' => 150, 'height'=>150));
            
            $cont++;
        }
        else{
                $table = ""; 
            }

        if(!empty($contagem[$cont]))
        {
                $table->addCell()->addImage($contagem[$cont], array('alignment' => Jc::CENTER, 'width' => 150, 'height'=>150)); 
                 $table->addRow(1,['cantSplit'=>false]);
                $table->addCell()->addText('Projétil Base PQ 0'.$pq,$this->fontStyle, $this->paraStyle);
                $table->addCell()->addText('Projétil Lateral PQ 0'.$pq,$this->fontStyle, $this->paraStyle);
                $cont++;
        }
       
            $numTab++;
            
       
            
     }                         
                                       
       
}
