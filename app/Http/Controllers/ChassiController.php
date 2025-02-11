<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


class ChassiController extends Controller
{
   public function index(){
      
        return view('perito.chassi.index');
   }
    
}