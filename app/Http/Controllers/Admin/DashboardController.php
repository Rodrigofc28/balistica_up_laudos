<?php

/*
 * Developed by Milena Mognon
 */

namespace app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
      
       /*
      

      $output = iconv('ISO-8859-1', 'UTF-8', $out); 
      
      
      $output = str_replace('\'', '"', $output);
      $output = str_replace('\\n', '', $output);
      $output = preg_replace('/[\r\n]/', '', $output);
     
      $array=json_decode($output, true);
      
      

   


      
     if(empty($array)){
      $tabela="Nenhuma REP Encontrada";
      
     }else{
         $tabela=$array;
         
      
   }  */
        return view('dashboard');
    }
}
