<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Goutte\Client;


class buscaGdlController extends Controller
{
   public function create(Request $request){
       

      $data = $request->dataBuscar;
      $data_formatada = date("d/m/Y", strtotime($data));

      chmod('C:\xampp\htdocs\laudos_balisticos\app\python',0777);
      $path=base_path('app\python\requisicao.py');
      
     
      /* trocar o caminho do python.exe que sera executado dentro do servidor  */
      $out=shell_exec('C:/Users/est.rodrigo.fc/AppData/Local/Programs/Python/Python310/python.exe ' .$path.' '.$request->password.' '.$request->username.' '.$data_formatada);
      
      
      

      $output = iconv('ISO-8859-1', 'UTF-8', $out); 
      
      
      $output = str_replace('\'', '"', $output);
      $output = str_replace('\\n', '', $output);
      $output = preg_replace('/[\r\n]/', '', $output);
     
      $array=json_decode($output, true);
      
      

   


      
     if(empty($array)){
      $tabela="Nenhuma REP Encontrada";
      
     }else{
         $tabela=$array;
         
      
   } 
   
   
   return redirect()->back()->with('tabela',$tabela);  
   }
    
}