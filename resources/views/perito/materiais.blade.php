@extends('layout.component')
@section('page')
<div class="col-12">
    <h4>Selecione o Material /Laudo {{$laudo->laudoEfetConst=='B601'?'constatação':'eficiência' }}</h4>
</div>
<hr>

@if($laudo->laudoEfetConst!='B601')
<h5><strong>Armas de fogo</strong></h5>
<input type="hidden" name="laudo_id" value="{{$laudo}}">
<div class="col-12">
    <div class="row border mb-3">
        <div class="col-lg-3 mt-3">
            @include('shared.block_button', ['col_name' => 'tipo_arma',
            'value' => 'Pistola', 'route' => 'pistolas.create'])
        </div>
        <div class="col-lg-3 mt-3">
            @include('shared.block_button', ['col_name' => 'tipo_arma',
            'value' => 'Revólver', 'route' => 'revolveres.create'])
        </div>
        <div class="col-lg-3 mt-3">
            @include('shared.block_button', ['col_name' => 'tipo_arma',
            'value' => 'Garrucha', 'route' => 'garruchas.create'])
        </div>
        
        <div class="col-lg-3 mt-3">
            @include('shared.block_button', ['col_name' => 'tipo_arma',
            'value' => 'Espingarda', 'route' => 'espingardas.create'])
        </div>
       
        <div class="col-lg-3 mt-3">
            @include('shared.block_button', ['col_name' => 'tipo_arma',
            'value' => 'Espingarda mista', 'route' => 'espingardamistas.create'])
        </div>
        
        

        <div class="col-lg-3 mt-3">
            
           
            @include('shared.block_button', ['col_name' => 'tipo_arma',
            'value' => 'Carabina', 'route' => 'carabinas.create'])
        </div>
     
        <div class="col-lg-3 mt-3">
            @include('shared.block_button', ['col_name' => 'tipo_arma',
            'value' => 'Metralhadora', 'route' => 'metralhadoras.create'])
        </div>
        <div class="col-lg-3 mt-3">
            @include('shared.block_button', ['col_name' => 'tipo_arma',
            'value' => 'Submetralhadora', 'route' => 'submetralhadoras.create'])
        </div>
        <div class="col-lg-3 mt-3">
            @include('shared.block_button', ['col_name' => 'tipo_arma',
            'value' => 'Fuzil', 'route' => 'fuzils.create'])
        </div>
        <div class="col-lg-3 mt-3">
            @include('shared.block_button', ['col_name' => 'tipo_arma',
            'value' => 'Pistolete', 'route' => 'pistoletes.create'])
        </div>
    

    </div>
</div>
@endif
<h5><strong>Munição</strong></h5>
<div class="col-12">
    <div class="row border mb-3 mt-3">
        <div class="col-lg-3 mt-3">
            @include('shared.block_button', ['col_name' => 'tipo_municao',
            'value' => 'Cartucho', 'route' => 'armas_curtas.create'])
        </div>
        <div class="col-lg-3 mt-3">
            @include('shared.block_button', ['col_name' => 'tipo_municao',
            'value' => 'Estojo', 'route' => 'armas_longas.create'])
        </div>
        <div class="col-lg-3 mt-3">
            @include('shared.block_button', ['col_name' => 'componente',
            'value' => 'Projétil', 'route' => 'balins_chumbo.create'])
        </div>
        
        
    </div>
</div>
<h5><strong>Outros</strong></h5>
<div class="col-12">
    <div class="row border mb-3 mt-3">
        <div class="col-lg-3 mt-3">
           @include('shared.block_button', ['col_name' => 'outros',
            'value' => 'outros', 'route' => 'outro.create'])
        </div>
        
    </div>
</div>
@if($laudo->laudoEfetConst!='constatacao')
<h5><strong>Armas de pressão/simulacro</strong></h5>
<div class="col-12">
    <div class="row border mb-3 mt-3">
        <div class="col-lg-3 mt-3">
            @include('shared.block_button', ['col_name' => 'componente',
            'value' => 'Pistola de pressão ', 'route' => 'pressaopistolas.create'])
        </div>
        <div class="col-lg-3 mt-3">
            @include('shared.block_button', ['col_name' => 'componente',
            'value' => 'Carabina de pressão ', 'route' => 'pressaocarabinas.create'])
        </div>
        <div class="col-lg-3 mt-3">
            @include('shared.block_button', ['col_name' => 'componente',
            'value' => 'Simulacro ', 'route' => 'simulacros.create'])
        </div>
    </div>
</div>
@endif
<div class="col-lg-3 mt-2">
    <a class="btn btn-secondary btn-block" href="{{ route('laudos.show', $laudo) }}">
        <i class="fas fa-arrow-circle-left"></i> Voltar ao Laudo</a>
</div>
@endsection