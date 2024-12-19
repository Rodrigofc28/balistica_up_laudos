@extends('layout.component')
@section('page')
    <div class="col-8">
        <h4>Cadastro de Estojos/Cartuchos</h4>
        <span style="color:red">Em desenvolvimento</span>
        <span style="color:red">Implementando imagens ao final do cadastro</span>
    </div>
    <hr>
    @include('perito.laudo.materiais.municoes.arma_curta.form', ['acao' => 'Cadastrar'])
@endsection