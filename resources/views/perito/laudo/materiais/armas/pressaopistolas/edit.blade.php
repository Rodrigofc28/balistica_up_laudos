@extends('layout.component')
@section('page')
<div class="col-8">
    <h4>Atualizar Pistola Pressão</h4>
</div>
<hr>
@include('perito.laudo.materiais.armas.pressaopistolas.form', ['acao' => 'Atualizar'])
@endsection