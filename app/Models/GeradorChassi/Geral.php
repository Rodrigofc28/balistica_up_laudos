<?php


namespace App\Models\GeradorChassi;

use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\Border;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Shape;
use PhpOffice\PhpWord\Style\Font;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use App\Models\ChassiDate\Chassi;
use App\Models\Laudo;
use App\Models\VeiculoInspecao;
use NumberFormatter;


class Geral 
{
    public $section, $config, $phpWord;//mudei de private para public

    public function __construct($section, $config, $phpWord)
    {
        
        $this->section = $section;
        $this->config = $config;
        $this->phpWord = $phpWord;
    }
    //Função para titulo e codigo do laudo
    private function titulo_e_exame($laudo)
    { 
        
        switch ($laudo) {
            case 'I801':
                $titulo = "LAUDO DE EXAME DE VEÍCULO A MOTOR";
                $codigo = "Código: I801";
                $exame = "(NUMERAÇÕES IDENTIFICADORAS)";
                $linha3preambulo='ao exame no veículo adiante descrito';
                $tipoExame='ao exame nas numerações identificadoras do veículo apresentado.';

                break;
            case 'I802':
                $titulo = "LAUDO DE EXAME DE COMPARTIMENTOS";
                $codigo = "Código: I802";
                $exame = "(COMPARTIMENTOS)";
                $linha3preambulo='ao exame no veículo adiante descrito';
                $tipoExame='ao exame para verificação de presença de compartimentos ocultos no veículo apresentado.';
                break;
            case 'I806':
                $titulo = "LAUDO DE EXAME DE CONSTATAÇÃO";
                $codigo = "Código: I806";
                $exame = "(CONSTATAÇÃO)";
                $linha3preambulo='ao exame nas peças adiante descritas,';
                $tipoExame='ao exame de constatação nas peças apresentadas para perícia.';
                break;
            case 'I812':
                $titulo = "LAUDO DE EXAME DE VEÍCULO A MOTOR";
                $codigo = "Código: I812";
                $exame = "(NUMERAÇÕES IDENTIFICADORAS + COMPARTIMENTOS)";
                $linha3preambulo='ao exame no veículo adiante descrito';
                $tipoExame='ao exame nas numerações identificadoras do veículo acima mencionado, bem como constatar no mesmo a existência de compartimentos ocultos.';
                break;
            default:
                $titulo = "";
                $codigo = "";
                $linha3preambulo="";
                $tipoExame='';
                $exame='';
                break;
        }
        
        return [ 'titulo' => $titulo,'codigo'=>$codigo,'linha3preambulo'=>$linha3preambulo,'tipoExame'=>$tipoExame,'exame'=>$exame];
    }
    
        //Corpo do laudo
    public function addText($laudo)
    {
        
        $chassi = Chassi::where('laudo_id', $laudo->id)->first();
         
        //pegando as imagens e alocando na variavel
        $image1 = $this->img64base($chassi['image1']);
        $image2 = $this->img64base($chassi['image2']);

        $header = $this->section->addHeader();
        $header->addTextBreak(1);
        $header->addPreserveText('FLS. {PAGE}', array('bold' => true,
            'size' => 10, 'name' => 'arial'), $this->config->paragraphRight());

        $num_laudo = "LAUDO Nº $laudo->rep";
        $header->addText($num_laudo, array('bold' => true,
            'size' => 10, 'name' => 'arial'), array('alignment' => Jc::END));

        $intCrim = "POLÍCIA CIENTÍFICA DO PARANÁ";
        
        $exame = "2. MATERIAL APRESENTADO A EXAME";
        $data_rec=formatar_data_do_bd($laudo->data_recebimento);
        $data_solic =formatar_data_do_bd($laudo->data_solicitacao);
        $data_desig = data($laudo->data_designacao);

        $perito = $laudo->perito->nome;
        
        $delegacia = (!empty($laudo->solicitante->nome))?$laudo->solicitante->nome:$orgaoGdl;
        $oficio = $laudo->oficio;
        $secao = (!empty($laudo->secao->nome))?$laudo->secao->nome:$unidadeGdl;

        $aux = $this->titulo_e_exame($laudo->laudoEfetConst);
        
        $consequencia = "Em consequência, o Perito procedeu ao exame solicitado, relatando-o com a verdade e com todas as circunstâncias relevantes, da forma como segue:";

        //configuração da tabela  cabeçalho
        $fontStyle = array ('bold' => true); 
        $paraStyle = array ('align' =>'center');
        $styleTable = array('borderColor'=>'777777','borderSize'=>10, 'cellMarginTop'=>10,'cellMarginLeft'=>0,'cellMarginRight'=>0,'cellSpacing'=>10000); //configuração da borda
        $styleFirstRow = array('bgColor'=>' #F0FFFF');
        $cellStyle=array('borderSize'=>50);
        
        
        $this->phpWord->addTableStyle('tabela', $styleTable, $styleFirstRow); //cabeçalho da tabela
        $this->phpWord->addTableStyle('tabela2img', $styleTable, $styleFirstRow);
        
        
        //Laudo CHASSI
        $text = [
            //Titulo e codigo
            $textrun = $this->section->addTextRun($this->config->paragraphCenter()),
            $textrun->addText($aux['titulo'], $this->config->arial14Bold()),
            $textrun->addTextBreak(),
            $textrun->addText($aux['exame'],$this->config->arial12Bold(),$this->config->paragraphCenter()),
           
            //texto 1° paragrafo
            $this->section->addText($aux['codigo'],$this->config->arial12Bold(),$this->config->paragraphRight()),
            $this->section->addTextBreak(),
            $textrun = $this->section->addTextRun($this->config->paragraphJustify()),
            $textrun->addText("$data_desig, nesta cidade de $secao e na ", $this->config->arial12()),
            $textrun->addText($intCrim, $this->config->arial12Bold()),
            $textrun->addText(", foi designado(a)", $this->config->arial12()),
            $textrun->addText(" o(a) Perito(a) Criminal ", $this->config->arial12()),
            $textrun->addText("$perito, ", $this->config->arial12Bold()),
            $textrun->addText('para proceder ao exame no veículo adiante descrito, ', $this->config->arial12()),
            $textrun->addText('a fim de ser atendida a solicitação constante no Ofício sob n°', $this->config->arial12()),
            $textrun->addText(" $oficio, datado de $data_solic, oriundo da ", $this->config->arial12()),
            $textrun->addText($delegacia.'.', $this->config->arial12Bold()),
            //texto 2° paragrafo (das consequêcias)
            $this->section->addText($consequencia, $this->config->arial12(), $this->config->paragraphJustify()),
            $this->section->addTextBreak(1),
            $this->section->addText(''),'phpWord' => $this->phpWord];
            
            //texto 3° paragrafo (Motivo da pericia)
        $text2 = [
            $this->section->addText('MOTIVO DA PERÍCIA', $this->config->arial12Bold(), $this->config->paragraphJustify()),
            $this->section->addTextBreak(1),
            $textrun = $this->section->addTextRun($this->config->paragraphJustify()),
            $textrun->addText('Depreende-se da leitura do ofício supracitado que a perícia tem por finalidade ', $this->config->arial12()),
            $textrun->addText("proceder ".$aux['tipoExame'], $this->config->arial12()),
            $this->section->addTextBreak(1),
            $this->section->addText(''),'phpWord' => $this->phpWord];
        //texto 4° paragrafo (Descrição do veículo)
        $text3 = [
            $this->section->addText('DO VEÍCULO', $this->config->arial12Bold(), $this->config->paragraphJustify()),
            $this->section->addTextBreak(1),
            $textrun = $this->section->addTextRun($this->config->paragraphJustify()),
            $textrun->addText('Trata-se de uma '.$chassi['veiculo_id'].' da marca de fabricação '.$chassi['marca_fabricacao'].' '. $chassi['modelo'], $this->config->arial12()),
            $textrun->addText(', ano de fabricação/modelo '.$chassi['ano_fab'].'/'.$chassi['modelo'].' de cor '.$chassi['cor'], $this->config->arial12()),
            $textrun->addText(', '.($chassi['placa']=='' ? 'ostentando placa de licenciamento '.$chassi['placa'] : 'desprovido de placa'), $this->config->arial12()),
            $textrun->addText(' e em '.$chassi['estado_conservacao'].' estado de conservação.', $this->config->arial12()),
            $this->section->addTextBreak(1),
            $this->section->addText(''),'phpWord' => $this->phpWord]; 
        //Das Imagens 
            $table = $this->section->addTable('tabela2img');
            $table->addRow(); 
            $img2=$table->addCell();
            $img2->addImage($image1, array('alignment' => Jc::CENTER, 'width' => 220));
            $img3= $table->addCell();
            $img3->addImage($image2, array('alignment' => Jc::CENTER, 'width' => 220));

            $this->section->addText(strtoupper($chassi['veiculo_id']).' PERICIADA', $this->config->arial12Bold(),$this->config->paragraphCenter());
        //Do exame chassi
         //  $this->doExameChassi($laudo); está com erro
        // imagens numeração do chassi
        //    $table2 = $this->section->addTable('tabela2img');
         //   $table2->addRow(); 
          //  $img4=$table2->addCell();
        //    $img4->addImage('C:\xampp\htdocs\LaudosApp\copy_Balistica\public\image\carabina.png', array('alignment' => Jc::CENTER, 'width' => 440, 'height'=>100));
        //    $this->section->addText('NUMERAÇÃO DO CHASSI', $this->config->arial12Bold(),$this->config->paragraphCenter());
        // do exame motor  
        //   $this->exameMotor($laudo);
        // imagens numeração do motor
        //    $table3 = $this->section->addTable('tabela2img');
         //   $table3->addRow(); 
        //    $img5=$table3->addCell();
        //    $img5->addImage('C:\xampp\htdocs\LaudosApp\copy_Balistica\public\image\carabina.png', array('alignment' => Jc::CENTER, 'width' => 440, 'height'=>100));
        //    $this->section->addText('NUMERAÇÃO DO MOTOR', $this->config->arial12Bold(),$this->config->paragraphCenter());
          return $this->section;

    } 
    //trnasformar a imagem em base64
    public function img64base($a){
        
        $imageR = $a; // decodifica do banco a image em base 64
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageR)); // tira #^data:image/\w+;base64,#i
        
        $tempFilePath = storage_path('app/public/imagensChassi'). '/' . uniqid() . '.jpg'; // cria um diretorio temporariosys_get_temp_dir() 
         file_put_contents($tempFilePath, $imageData);//colocar arquivo
         
        // quando a image vêm de um input do tipo file não precisa transforma em um objeto porque ela já é, porem quando ta em base64 sim ae se usa o UploadedFile
          $imageConvertida = new UploadedFile($tempFilePath, 'diario_num_one.jpg', 'image/jpeg', null, true);
       
            
        $fileC = file_get_contents($imageConvertida); //pegar arquivo
        return $fileC;
    }

    //função para exame de chassi
   public function doExameChassi($laudo){
    $laudo = Laudo::find($laudo->id);
    $exameChassi=VeiculoInspecao::where('laudo_id', $laudo->id)->first();
    
    $dadosVeiculo=Chassi::where('laudo_id', $laudo->id)->first();
   
    switch ($laudo->laudoEfetConst) {
        case 'I801':
            $exame = 'numerações identificadoras';
            
            if($exameChassi->chassi_status=='integro'&& $exameChassi->chassi_tipo_adulteracao==NULL){
                
                $texto2= "Ao exame de referido suporte, após a devida limpeza, foi verificada a gravação da sequência alfanumérica $exameChassi->chassi_numero, a qual apresenta-se íntegra, sem sinais ou vestígios de adulteração.";
            }else if($exameChassi->chassi_status=='adulterado' && $exameChassi->chassi_tipo_adulteracao=='desbaste_regravação_revelado'){
                $texto2= "Ao exame de referido suporte, após a devida limpeza, verificou o perito evidentes sinais deixados pela operação ali procedida, que consistiu no desbaste, por ação abrasiva, o que ocasionou a destruição da numeração original, possibilitando a gravação da atual $exameChassi->chassi_revelado_numero. Submetida à superfície em referência a tratamento químico-metalográfico, destinado a revelar remanescentes da gravação original, foi obtida a sequência alfanumérica $exameChassi->chassi_adulterado_numero.";
            }else if($exameChassi->chassi_status=='adulterado' && $exameChassi->chassi_tipo_adulteracao=='contundencia_parcial'){
                $texto2= 'Ao exame de referido suporte, após a devida limpeza, verificou o perito evidentes sinais deixados pela operação ali procedida, que consistiu na aplicação de ação contundente, o que ocasionou a destruição da numeração original. Submetida à superfície em referência a '. ($exameChassi->chassi_metodologia=='tratamento_quimico')?'químico-metalográfico':'instrumento óptico'.", destinado a revelar remanescentes da gravação original, foi obtida a sequência alfanumérica $exameChassi->chassi_adulterado_numero.";
            }else if($exameChassi->chassi_status=='adulterado' && $exameChassi->chassi_tipo_adulteracao=='desbaste_nao_revelado'){
                $texto2= 'Ao exame de referido suporte, após a devida limpeza, verificou o perito evidentes sinais deixados pela operação ali procedida, que consistiu na aplicação de ação contundente, o que ocasionou a destruição da numeração original. Submetida à superfície em referência a '. ($exameChassi->chassi_metodologia=='tratamento_quimico')?'químico-metalográfico':'instrumento óptico'.", destinado a revelar remanescentes da gravação original, foi obtida a sequência alfanumérica $exameChassi->chassi_adulterado_numero.";
            }
                
               
            break;
        case 'I802':
            
            break;
        case 'I806':
            
            break;
        case 'I812':
            
            break;
        default:
            
            break;
    }
     
    $text4 = [
        $this->section->addText('DO EXAME', $this->config->arial12Bold(), $this->config->paragraphJustify()),
        $this->section->addTextBreak(1),
        $textrun = $this->section->addTextRun($this->config->paragraphJustify()),
        $textrun->addText('Com relação às '.$exame.' da '.$dadosVeiculo['veiculo_id']. ' foram observados:', $this->config->arial12()),
        $this->section->addTextBreak(1),
        $textrun2 = $this->section->addTextRun($this->config->paragraphJustify()),
        $textrun2->addText('a) '.$texto2, $this->config->arial12()),
        
        $this->section->addTextBreak(1),
        $this->section->addText(''),'phpWord' => $this->phpWord]; 
       
        return $this->section;
   }
       //função para exame de motor      
    public function exameMotor($laudo){
        $laudo = Laudo::find($laudo->id);
        $exameMotor=VeiculoInspecao::where('laudo_id', $laudo->id)->first();
        $dadosVeiculo=Chassi::where('laudo_id', $laudo->id)->first();
        
        switch ($laudo->laudoEfetConst) {
            case 'I801':
                $exame = 'numerações identificadoras';
                
                if($exameMotor->motor_status=='integro'){
                    $texto2= ",a qual apresenta-se íntegra, sem sinais ou vestígios de adulteração.";
                }else if($exameMotor->motor_status=='adulterado' && $exameMotor->motor_tipo_adulteracao=='desbaste_regravação_revelado'){
                    $texto2= "Ao exame de referido suporte, após a devida limpeza, verificou o perito evidentes sinais deixados pela operação ali procedida, que consistiu no desbaste, por ação abrasiva, o que ocasionou a destruição da numeração original, possibilitando a gravação da atual $exameMotor->motor_revelado_numero. Submetida à superfície em referência a tratamento químico-metalográfico, destinado a revelar remanescentes da gravação original, foi obtida a sequência alfanumérica $exameMotor->motor_adulterado_numero.";
                }else if($exameMotor->motor_status=='adulterado' && $exameMotor->motor_tipo_adulteracao=='desbaste_regravação_revelado'){
                    $texto2= "Ao exame de referido suporte, após a devida limpeza, verificou o perito evidentes sinais deixados pela operação ali procedida, que consistiu no desbaste, por ação abrasiva, o que ocasionou a destruição da numeração original, possibilitando a gravação da atual $exameMotor->motor_revelado_numero. Submetida à superfície em referência a tratamento químico-metalográfico, destinado a revelar remanescentes da gravação original, foi obtida a sequência alfanumérica $exameMotor->motor_adulterado_numero.";
                }
                    
                   
                break;
            case 'I802':
                
                break;
            case 'I806':
                
                break;
            case 'I812':
                
                break;
            default:
                
                break;
        }
        $text5 = [
           
            $this->section->addTextBreak(1),
            $textrun = $this->section->addTextRun($this->config->paragraphJustify()),
            $textrun->addText('b) número do motor: '.$exameMotor->motor_numero, $this->config->arial12()),
            $textrun->addText($texto2, $this->config->arial12()),
        ];

    }       
            
            
           
       
    
}


