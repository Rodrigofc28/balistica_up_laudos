<?php
namespace App\Models\GeradorChassi;

class Textos {

    public function __construct(){
    }

    //Função para titulo e codigo do laudo
    public function titulo_e_exame($laudo){ 
        switch ($laudo) {
            case 'I801':
                $titulo = "LAUDO DE EXAME DE VEÍCULO A MOTOR";
                $exame = "(NUMERAÇÕES IDENTIFICADORAS)";
                $codigo = "Código: I801";
                $linha3preambulo=' no(s) veículo(s) adiante descrito';
                $tipoExame='ao exame nas numerações identificadoras do veículo apresentado.'; //Objetivo
            break;
            
            case 'I802':
                $titulo = "LAUDO DE EXAME DE COMPARTIMENTOS";
                $exame = "(COMPARTIMENTOS)";
                $codigo = "Código: I802";
                $linha3preambulo='ao exame no veículo adiante descrito';
                $tipoExame='ao exame para verificação de presença de compartimentos ocultos no veículo apresentado.';
            break;
            
            case 'I806':
                $titulo = "LAUDO DE EXAME DE CONSTATAÇÃO";
                $exame = "(CONSTATAÇÃO)";
                $codigo = "Código: I806";
                $linha3preambulo='ao exame nas peças adiante descritas,';
                $tipoExame='ao exame de constatação nas peças apresentadas para perícia.';
            break;
            
            case 'I812':
                $titulo = "LAUDO DE EXAME DE VEÍCULO A MOTOR";
                $exame = "(NUMERAÇÕES IDENTIFICADORAS + COMPARTIMENTOS)";
                $codigo = "Código: I812";
                $linha3preambulo='ao exame no veículo adiante descrito';
                $tipoExame='ao exame nas numerações identificadoras do veículo acima mencionado, bem como constatar no mesmo a existência de compartimentos ocultos.';
            break;
        }
        
        return ['titulo'=>$titulo,'exame'=>$exame,'codigo'=>$codigo,'linha3preambulo'=>$linha3preambulo,'tipoExame'=>$tipoExame];
    }





}
