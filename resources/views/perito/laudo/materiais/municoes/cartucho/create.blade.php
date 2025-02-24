@extends('layout.component')
@section('page')
    <div class="col-8">
        <h4>Cadastro de Cartucho(s)</h4>
        
    </div>
    <hr>
    @include('perito.laudo.materiais.municoes.cartucho.form', ['acao' => 'Cadastrar'])
@endsection