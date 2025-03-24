<?php

namespace App\Http\Controllers\Perito\Componentes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Componente;

class OutrosmateriasController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($laudo)
    {
        
        return view('perito.laudo.materiais.componentes.outros.create',
            compact('laudo'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  $laudo
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        return view('perito.laudo.materiais.componentes.outros.create',
            compact('laudo'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  $laudo
     * @param  Componente $componente
     * @return \Illuminate\Http\Response
     */
    public function edit($laudo, Componente $componente)
    {
        return view('perito.laudo.materiais.componentes.polvora.edit',
            compact('componente', 'laudo'));
    }
}
