@extends('layout.component')
@section('page')
    <div class="col-8">
        <h4>Cadastro de Carabina de pressão</h4>
    </div>
    <hr>
    @include('perito.laudo.materiais.armas.pressaocarabinas.form', ['acao' => 'Cadastrar'])
@endsection