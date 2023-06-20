@extends('layout.component')
@section('page')
    <div class="col-8">
        <h4>Cadastro de Estojos/Cartuchos</h4>
    </div>
    <hr>
    @include('perito.laudo.materiais.municoes.arma_curta.form', ['acao' => 'Cadastrar'])
@endsection