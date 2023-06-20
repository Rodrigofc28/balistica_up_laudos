@extends('layout.component')
@section('page')
<div class="col-8">
    <h4>Atualizar Simulacro</h4>
</div>
<hr>
@include('perito.laudo.materiais.componentes.simulacros.form', ['acao' => 'Atualizar'])
@endsection