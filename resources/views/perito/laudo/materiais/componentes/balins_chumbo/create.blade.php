@extends('layout.component')
@section('page')
    <div class="col-8">
        <h4>Cadastro de projéteis</h4>
    </div>
    <hr>
    @include('perito.laudo.materiais.componentes.balins_chumbo.form', ['acao' => 'Cadastrar'])
@endsection