@extends('shared.table', ['card_name' => 'Órgãos Solicitantes',
'model_name_plural' => 'Órgãos Solicitantes',
'model_name_singular' => 'Órgão Solicitante',
'habilitar_pesquisa' => false,
'route_create_name' => 'solicitantes.create',
'pesquisar' => 'Digite o nome do órgão solicitante',
'route_search_name' => 'solicitantes',
'dados' => $solicitantes,
'ths' => ['Nome', 'Cidade']])

@section('table-content')
@if (count($solicitantes) > 0)
{{--Busca Pela cidade--}}
@include('shared.attributes.buscaCidade', ['size' => '4', 'cidade2' => $laudo->cidade_id ?? old('cidade_id')])
@foreach ($solicitantes as $solicitante)
<tr>

    <td> {{ $solicitante->nome }}</td>
    <td> {{ $solicitante->cidade_id }}</td>
    <td>
        <a class="btn btn-primary" href="{{ route('solicitantes.edit', $solicitante) }}">
            <i class="fa fa-fw fa-edit"></i> Editar</a>

        <button value="{{ route('solicitantes.destroy', $solicitante) }}" class="btn btn-danger delete">
            <i class="fa fa-fw fa-trash"></i>
            Deletar
        </button>
    </td>
</tr>
@endforeach
@endif
@endsection