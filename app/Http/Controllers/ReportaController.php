<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Erro;
class ReportaController extends Controller
{
    public function index(){
        return view('Admin.reports.reportar');
    }

    public function store(Request $request){
        Erro::create($request->all());
        return view('home');
    }
}
