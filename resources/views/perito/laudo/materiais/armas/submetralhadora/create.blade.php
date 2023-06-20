@extends('layout.component')
@section('page')
    <div class="col-8">
        <h4>Cadastro de Submetralhadora</h4>
    </div>
    <hr>
    @include('perito.laudo.materiais.armas.submetralhadora.form', ['acao' => 'Cadastrar'])
@endsection