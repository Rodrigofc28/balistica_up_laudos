<?php



namespace App\Models\Gerador;

use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\Border;
use App\Models\Componente;
use Illuminate\Support\Facades\DB;
class Tabelas {
    //configuração da tabela
    private $fontStyle = array ('bold' => true); 
    private $paraStyle = array ('align' =>'center');
    private $styleTable = array('borderColor'=>'777777','borderSize'=>10, 'cellMarginTop'=>10,'cellMarginLeft'=>0,'cellMarginRight'=>0,'cellSpacing'=>10000); //configuração da borda
    private $styleFirstRow = array('bgColor'=>' #F0FFFF');
    private $cellStyle=array('borderSize'=>50);

     //adicionando a tabela
//Função para criação da tabela material apresentado a exame
// tabela B602 ----------------------------------------------------------------------------------------------------------------------------------------------------
    protected function tabelaExameB602($phpWord,$section,$config,$laudo){

 
    $this->phpWord->addTableStyle('tabela', $this->styleTable, $this->styleFirstRow);

    $text=[
            $table = $this->section->addTable('tabela'),
            $table->addRow(10,['tblHeader'=>true]),
            $table->addCell(null,['bgColor'=>'d3d3d3'])->addText('TABELA 2 – MATERIAL ENCAMINHADO A EXAME', $this->fontStyle, $this->paraStyle),//cabeçalho tabela
            $table->addRow(10,['tblHeader'=>true]),
            //$table->addCell(null)->addText('Item', $this->fontStyle,$this->paraStyle),
            $table->addCell()->addText('Natureza', $this->fontStyle,$this->paraStyle),
            $table->addCell()->addText('Quantidade', $this->fontStyle,$this->paraStyle),
            $table->addCell()->addText('Tipo', $this->fontStyle,$this->paraStyle),
            
            $table->addCell()->addText('Lacre de Entrada', $this->fontStyle,$this->paraStyle),
            //chama a função tabelaMaterialExame
            $this->tabelaMaterialExame($laudo->armas,$laudo->municoes,$table,$laudo)
        
    ];

 }
 //função para a criação dos campos em caso arma ou munição
 protected function tabelaMaterialExame($armalaudo,$municaolaudo,$table,$laudo){//laudo eficiencia arma e munições
        
    $item=1;
    $quantidade='';
    //caso arma B602
    if($armalaudo!=''){
        
                foreach ($armalaudo as $arma ){
                        $quantidade=1;
                    
                      $naturezaArma=substr_replace($arma->marca->categoria,'',4,1);

                    [
                    $table->addRow(10,['tblHeader'=>true]),
                    //$table->addCell()->addText($item,null,$this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper($naturezaArma),null,$this->paraStyle),
                    $table->addCell()->addText($quantidade,null,$this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper($arma->tipo_arma),null,$this->paraStyle),
                   
                    $table->addCell()->addText($arma->num_lacre_saida,null,$this->paraStyle),
                    

                    ];
                $item++;

                }
            
            
            }
    //caso munição B602--------------------------------------------------------------------------------------------------------------------------------------------           
    if($municaolaudo!=''){
         
        $tabelaNecropsia=DB::select('select dito_oficio,lacrecartucho,tipo_municao,calibre_id,sum(quantidade),marca_id from municoes where laudo_id = :id group by dito_oficio,lacrecartucho,tipo_municao,marca_id,calibre_id ',['id'=>$laudo->id]); 
       
       
       
                    foreach($tabelaNecropsia as $municao){
                        
                         $tableM=DB::table('municoes')->join('marcas','municoes.marca_id','=','marca_id')->select('municoes.marca_id','marcas.nome')->where('marca_id',$municao->marca_id)->where('marcas.id', '=', $municao->marca_id)->get();
                        $tableX=DB::table('municoes')->join('calibres','municoes.calibre_id','=','calibre_id')->select('municoes.calibre_id','calibres.nome')->where('calibre_id',$municao->calibre_id)->where('calibres.id',$municao->calibre_id)->get();
                        
                        $marca='';
                        $modelo='';
                        if(isset($tableM[0]->nome)){
                            $marca=$tableM[0]->nome;
                        }
                        if(isset($tableX[0]->nome)){
                            $modelo=$tableX[0]->nome;
                        } 
                    $naturezaMunicao="munição";
                    
                        [$table->addRow(10,['tblHeader'=>true]),
                                //$table->addCell()->addText($item,null,$this->paraStyle),
                                $table->addCell()->addText(mb_strtoupper($naturezaMunicao),null,$this->paraStyle),
                                $table->addCell()->addText($municao->{'sum(quantidade)'},null,$this->paraStyle),
                                $table->addCell()->addText(mb_strtoupper($municao->tipo_municao),null,$this->paraStyle),
                               
                                $table->addCell()->addText($municao->lacrecartucho,null,$this->paraStyle),
                                
        
                                ];
                                $item++;
        
                }

   
            }
    //caso projetil--------------------------------------------------------------------------------------------------------------------------------
    if($laudo->componentes!=''){

        $tabelaNecropsia=DB::select('select dito_oficio,lacrecartucho,group_concat(calibreNominal),group_concat(tipo_projetil),sum(quantidade_frascos) from componentes where laudo_id = :id group by dito_oficio,lacrecartucho',['id'=>$laudo->id]);
       

        foreach($tabelaNecropsia as $projetil){
          
            $ti_projetil=explode(',',$projetil->{'group_concat(tipo_projetil)'});
            $cali_projetil=explode(',',$projetil->{'group_concat(calibreNominal)'});
            [$table->addRow(10,['tblHeader'=>true]),
                    //$table->addCell()->addText($item,null,$this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper('Projetil'),null,$this->paraStyle),
                    $table->addCell()->addText($projetil->{'sum(quantidade_frascos)'},null,$this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper($ti_projetil[0]),null,$this->paraStyle),
                    
                    $table->addCell()->addText($projetil->lacrecartucho,null,$this->paraStyle),
                    

                    ];
                    $item++;
                                 
    }
  
    }
    //caso outros materias 
    if($laudo->outros!=''){
       
       
        foreach($laudo->outros as $outro){
            
              [$table->addRow(10,['tblHeader'=>true]),
                    //$table->addCell()->addText($item,null,$this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper('Outros'),null,$this->paraStyle),
                    $table->addCell()->addText("$outro->quantidade $outro->medida",null,$this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper($outro->nome),null,$this->paraStyle),
                   
                    $table->addCell()->addText($outro->lacre_entrada,null,$this->paraStyle),
                    

                    ];
                    $item++;
                                 
                }
                  

  
    }
    return $table;
}

public function tabelaDadosInvestigacao($phpWord,$section,$config,$laudo){
   
    

    $dataHora=formatar_data_do_bd($laudo->data_solicitacao);
    
    $dataOcorencia=empty($laudo->data_ocorrencia)?'':formatar_data_do_bd($laudo->data_ocorrencia);

    $this->phpWord->addTableStyle('tabela', $this->styleTable, $this->styleFirstRow);

    
    $cidadeGdl=(!empty($laudo->solicitante->cidade_id)?$laudo->solicitante->cidade_id:$laudo->cidadeGdl);
    $orgaoGdl=(!empty($laudo->solicitante->nome)?$laudo->solicitante->nome:$laudo->orgaoGdl);

    
            $table = $this->section->addTable('tabela');//cabeçalho tabela
            $table->addRow(50);
            $table->addCell(5,['bgColor'=>'d3d3d3'])->addText('TABELA 1 – DADOS DA INVESTIGAÇÃO', $this->fontStyle, $this->paraStyle);
            $hideShowDataOcorrencia='3000';
            $tamanhoCell = '3050';
            if($dataOcorencia=="" && $laudo->boletim_ocorrencia=="" ){
                $hideShowDataOcorrencia='6000';
            }elseif($dataOcorencia==""){
                $tamanhoCell = '3502';
            }elseif($laudo->boletim_ocorrencia==""){
                $tamanhoCell = '3502';
            }

            $this->nomes($table,$laudo,$hideShowDataOcorrencia);
            $table->addRow(50);
            $dataOcorencia!=""?[$table->addCell(3050)->addText('Data da Ocorrência:', $this->fontStyle,$this->paraStyle), 
            $table->addCell(2000)->addText($dataOcorencia,null,$this->paraStyle)]:"";     
            
            $table->addCell(1000)->addText('Local:', $this->fontStyle,$this->paraStyle); 
            $table->addCell(3050)->addText(mb_strtoupper($cidadeGdl),null,$this->paraStyle); 
            $this->inqueritos($table,$laudo,$hideShowDataOcorrencia);
            
            $table->addRow(50);
            $table->addCell(3052)->addText( 'Unidade Policial:', $this->fontStyle,$this->paraStyle);
            $table->addCell(3000)->addText(mb_strtoupper($orgaoGdl),null,$this->paraStyle);

    return $table;
}

protected function tabelaExameLocalNecropsia($phpWord,$section,$config,$laudo){

    

    $this->phpWord->addTableStyle('tabela', $this->styleTable, $this->styleFirstRow);

    $text=[
        $table = $this->section->addTable('tabela'),
            $table->addRow(10,['tblHeader'=>true]),
            $table->addCell(null,['bgColor'=>'d3d3d3'])->addText('TABELA 2 – MATERIAL ENCAMINHADO A EXAME ', $this->fontStyle, $this->paraStyle),//cabeçalho tabela
            $table->addRow(10,['tblHeader'=>true]),
           // $table->addCell()->addText('Item', $this->fontStyle,$this->paraStyle),
            $table->addCell()->addText('Tipo', $this->fontStyle,$this->paraStyle),
            $table->addCell()->addText('Qtde', $this->fontStyle,$this->paraStyle),
            $table->addCell()->addText('Origem', $this->fontStyle,$this->paraStyle),
            $table->addCell()->addText('Nº Exame Coleta', $this->fontStyle,$this->paraStyle),
            $table->addCell()->addText('N° Requisição', $this->fontStyle,$this->paraStyle),
            $table->addCell()->addText('Lacre de Entrada', $this->fontStyle,$this->paraStyle),
            $this->tabelaExameLocalNecropsiaCorpo($table,$laudo)
        
    ];

 }
 // tabela B601 ----------------------------------------------------------------------------------------------------------------------------------------------------
 protected function tabelaExameB601($phpWord,$section,$config,$laudo){

    

    $this->phpWord->addTableStyle('tabela', $this->styleTable, $this->styleFirstRow);

    $text=[
        $table = $this->section->addTable('tabela'),
            $table->addRow(10,['tblHeader'=>true]),
            $table->addCell(null,['bgColor'=>'d3d3d3'])->addText('TABELA 2 – MATERIAL ENCAMINHADO A EXAME ', $this->fontStyle, $this->paraStyle),//cabeçalho tabela
            $table->addRow(10,['tblHeader'=>true]),
           // $table->addCell()->addText('Item', $this->fontStyle,$this->paraStyle),
            $table->addCell()->addText('Tipo', $this->fontStyle,$this->paraStyle),
            $table->addCell()->addText('Qtde', $this->fontStyle,$this->paraStyle),
            $table->addCell()->addText('Origem', $this->fontStyle,$this->paraStyle),
            $table->addCell()->addText('Identificação', $this->fontStyle,$this->paraStyle),
             $table->addCell()->addText('Lacre de Entrada', $this->fontStyle,$this->paraStyle),
            $this->tabelaExameLocalNecropsiaCorpo($table,$laudo)
        
    ];

 }
           
//Função para criação dos campos da tabelaExameB601 e tabelaExameLocalNecropsia

 protected function tabelaExameLocalNecropsiaCorpo($table,$laudo){//laudo eficiencia arma e munições
        
    $item=1;
    $quantidade='';
    if($laudo->laudoEfetConst=="B602"){
            if(isset($laudo->armas[0])){
        
                foreach ($laudo->armas as $arma ){
                        $quantidade=1;

                    [$table->addRow(10,['tblHeader'=>true]),
                    //$table->addCell()->addText($item,null,$this->paraStyle),
                    $table->addCell()->addText(mb_strtoupper($arma->tipo_arma),null,$this->paraStyle),
                    $table->addCell()->addText($quantidade,null,$this->paraStyle),
                    $arma->origem_coletaPerito=!''?$table->addCell()->addText($arma->origem_coletaPerito,null,$this->paraStyle):$table->addCell()->addText('',null,$this->paraStyle),
                    $arma->rep_materialColetado!=''?$table->addCell()->addText($arma->rep_materialColetado,null,$this->paraStyle):$table->addCell()->addText('',null,$this->paraStyle),
                    
                    $table->addCell()->addText($arma->num_lacre_saida,null,$this->paraStyle),
                    
                    ];
                $item++;

                }}
    }else{    
            //caso cartuchos----------------------------------------------------------------------------------------------------------------------------------------------  
                if(isset($laudo->municoes[0])){
                    $tabelaNecropsia=DB::select('select lacrecartucho,origem_coletaPerito,rep_materialColetado,lacre_saida,tipo_municao,sum(quantidade) from municoes where laudo_id = :id group by lacrecartucho,origem_coletaPerito,rep_materialColetado,lacre_saida,tipo_municao ',['id'=>$laudo->id]);
                    $lacreCartucho='';
                    $somaCartucho=[];
                    $cartucho=false;
                    
                foreach($tabelaNecropsia as $municao){
                       
  
                       if($municao->tipo_municao=="cartucho"){
                        $cartucho=true;
                        $origemColeta=$municao->origem_coletaPerito;
                        $materialColetado=$municao->rep_materialColetado;
                        $somaCartucho[]=$municao->{'sum(quantidade)'};
                        $lacreCartucho=$municao->lacrecartucho;
                        $item++;
                                
                }
                }
                if($cartucho){
                [$table->addRow(10,['tblHeader'=>true]),
                // $table->addCell()->addText($item,null,$this->paraStyle),
                 $table->addCell()->addText(mb_strtoupper('cartucho'),null,$this->paraStyle),
                 $table->addCell()->addText(array_sum($somaCartucho),null,$this->paraStyle),
                 $origemColeta=!''?$table->addCell()->addText($origemColeta,null,$this->paraStyle):$table->addCell()->addText('',null,$this->paraStyle),
                 $materialColetado!=''?$table->addCell()->addText($materialColetado,null,$this->paraStyle):$table->addCell()->addText('',null,$this->paraStyle),
                
                 $table->addCell()->addText($lacreCartucho,null,$this->paraStyle),
                 ];
                }
                 
            
            }
            //caso estojos------------------------------------------------------------------------------------------------------------------------------------------------
                if(isset($laudo->municoes[0])){
                    $tabelaNecropsia=DB::select('select lacrecartucho,origem_coletaPerito,rep_materialColetado,lacre_saida,tipo_municao,sum(quantidade) from municoes where laudo_id = :id group by lacrecartucho,origem_coletaPerito,rep_materialColetado,lacre_saida,tipo_municao ',['id'=>$laudo->id]);
                    $lacreEstojo='';
                    $somaEstojo=[];
                    $estojo=false;
                    foreach($tabelaNecropsia as $municao){
                                   
              
                                   if($municao->tipo_municao=="estojo"){
                                    $estojo=true;
                                    $origemColeta=$municao->origem_coletaPerito;
                                    $materialColetado=$municao->rep_materialColetado;
                                    $somaEstojo[]=$municao->{'sum(quantidade)'};
                                    $lacreEstojo=$municao->lacrecartucho;
                                    $item++;
                                            
                                }
                            }
                        if($estojo){
                            [$table->addRow(10,['tblHeader'=>true]),
                            //  $table->addCell()->addText($item,null,$this->paraStyle),
                              $table->addCell()->addText(mb_strtoupper('estojo'),null,$this->paraStyle),
                              $table->addCell()->addText(array_sum($somaEstojo),null,$this->paraStyle),
                              $origemColeta=!''?$table->addCell()->addText($origemColeta,null,$this->paraStyle):$table->addCell()->addText('',null,$this->paraStyle),
                              $materialColetado!=''?$table->addCell()->addText($materialColetado,null,$this->paraStyle):$table->addCell()->addText('',null,$this->paraStyle),
                             
                              $table->addCell()->addText($municao->lacrecartucho,null,$this->paraStyle),
                              
      
                              ];}
                        
                        }

           //Caso Projétil----------------------------------------------------------------------------------------------------------------------------------------------------- 
            if(isset($laudo->componentes[0])){
                
               
            $tabelaNecropsia=DB::select('select lacrecartucho,origem_coletaPerito,rep_materialColetado,sum(quantidade_frascos) from componentes where laudo_id = :id group by lacrecartucho,origem_coletaPerito,rep_materialColetado ',['id'=>$laudo->id]);
            
            $lacreProjetil='';
            $somaProjetil=[];
            foreach($tabelaNecropsia as $tabela){
                    $origemColeta=$tabela->origem_coletaPerito;
                    
                    $materialColetado=$tabela->rep_materialColetado;
                    $somaProjetil[]=$tabela->{'sum(quantidade_frascos)'};
                    $lacreProjetil=$tabela->lacrecartucho;
                    $item++;

            }
            [
                $table->addRow(10,['tblHeader'=>true]),
               // $table->addCell()->addText($item,null,$this->paraStyle),
                $table->addCell()->addText(mb_strtoupper('Projétil'),null,$this->paraStyle),
                $table->addCell()->addText(array_sum($somaProjetil),null,$this->paraStyle),
                $origemColeta=!''?$table->addCell()->addText($origemColeta,null,$this->paraStyle):$table->addCell()->addText('',null,$this->paraStyle),
                $materialColetado!=''?$table->addCell()->addText($materialColetado,null,$this->paraStyle):$table->addCell()->addText('',null,$this->paraStyle),
              
                $table->addCell()->addText($lacreProjetil,null,$this->paraStyle),
                
    
                ];
            }
        //Caso outros materiais
        
           
            }
    return $table;
}
//Tabela de nomes de envolvidos
public function nomes($table, $laudo, $hideShowDataOcorrencia)
{
    // Verifica se nomeIncluir não está vazio e decodifica caso seja JSON
    if (!empty($laudo->nomeIncluir)) {
        $envolvidos = is_string($laudo->nomeIncluir) ? json_decode($laudo->nomeIncluir, true) : $laudo->nomeIncluir;

        if (is_array($envolvidos)) {
            foreach ($envolvidos as $item) {
                $nome = mb_strtoupper($item['nome']);
                $perfil = mb_strtoupper($item['perfil']);

                // Define o título com switch (para compatibilidade com PHP 7.x)
                $titulo = 'Outro';
                switch ($perfil) {
                    case 'VITIMA':
                        $titulo = 'Nome da Vítima';
                        break;
                    case 'EM PODER DE':
                        $titulo = 'Em Poder de';
                        break;
                    case 'ENVOLVIDO':
                        $titulo = 'Envolvido';
                        break;
                    case 'AUTOR':
                        $titulo = 'Autor';
                        break;
                    case 'INDICIADO':
                        $titulo = 'Indiciado';
                        break;
                    case 'INVESTIGADO':
                        $titulo = 'Investigado';
                        break;
                }

                $table->addRow(50);
                $table->addCell(3052, [$this->styleFirstRow])->addText($titulo, $this->fontStyle, $this->paraStyle);
                $table->addCell($hideShowDataOcorrencia)->addText($nome, null, $this->paraStyle);
            }
        }
    }
}
//Tabela de inqueritos
public function inqueritos($table, $laudo, $hideShowDataOcorrencia)
{
    // Verifica se nomeIncluir não está vazio e decodifica caso seja JSON
    if (!empty($laudo->docs)) {
        $docs = is_string($laudo->docs) ? json_decode($laudo->docs, true) : $laudo->docs;

        if (is_array($docs)) {
            foreach ($docs as $item) {
                $inqueritoDC = mb_strtoupper($item['inqueritoDC']);
                $numeroInq = mb_strtoupper($item['numeroInq']);

             
                $titulo = $inqueritoDC;
               

                $table->addRow(50);
                $table->addCell(3052, [$this->styleFirstRow])->addText($titulo, $this->fontStyle, $this->paraStyle);
                $table->addCell($hideShowDataOcorrencia)->addText($numeroInq, null, $this->paraStyle);
            }
        }
    }
}






 }

