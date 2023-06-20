@extends('layout.component')
@section('page')
    <div class="col-8">
        <h4>Cadastro de Pistola de pressão</h4>
    </div>
    <hr>
    @include('perito.laudo.materiais.armas.pressaopistolas.form', ['acao' => 'Cadastrar'])
@endsection