@extends('layout.component')
@section('page')
<div class="col-8">
    <h4>Atualizar Pistolete</h4>
</div>
<hr>
@include('perito.laudo.materiais.armas.pistolete.form', ['acao' => 'Atualizar'])
@endsection