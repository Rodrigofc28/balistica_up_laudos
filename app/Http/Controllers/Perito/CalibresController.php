<?php

/*
 * Developed by Milena Mognon
 */

namespace App\Http\Controllers\Perito;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalibreRequest;
use App\Models\Calibre;

class CalibresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CalibreRequest $request)
    {
        
        $nome = $request->input('nome');
        $tipo_arma = $request->input('tipo_arma');
        
        if (is_array($tipo_arma)){
            foreach ($tipo_arma as $tipo) {
                $calibre = Calibre::create(['nome' => $nome, 'tipo_arma' => $tipo]);
            }
        } else {
            $calibre = Calibre::create($request->all());
        }
        return response()->json($calibre);
    }
}
