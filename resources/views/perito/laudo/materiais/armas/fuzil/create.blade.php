@extends('layout.component')
@section('page')
    <div class="col-8">
        <h4>Cadastro de Fuzil</h4>
    </div>
    <hr>
    @include('perito.laudo.materiais.armas.fuzil.form', ['acao' => 'Cadastrar'])
@endsection