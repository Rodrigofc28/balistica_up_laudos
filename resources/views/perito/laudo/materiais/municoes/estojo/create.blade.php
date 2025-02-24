@extends('layout.component')
@section('page')
    <div class="col-8">
        <h4>Cadastro de Estojo(s)</h4>
        
    </div>
    <hr>
    @include('perito.laudo.materiais.municoes.estojo.form', ['acao' => 'Cadastrar'])
@endsection