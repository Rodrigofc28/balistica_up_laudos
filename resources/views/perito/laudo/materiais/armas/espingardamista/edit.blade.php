@extends('layout.component')
@section('page')
<div class="col-8">
    <h4>Atualizar Espingarda mista</h4>
</div>
<hr>
@include('perito.laudo.materiais.armas.espingardamista.form', ['acao' => 'Atualizar'])
@endsection