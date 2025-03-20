@extends('shared.table', ['card_name' => 'Laudos',
'model_name_plural' => 'Laudos',
'model_name_singular' => 'Laudo',
'habilitar_pesquisa' => 'true',
'pesquisar' => 'Digite o número da REP',
'route_search_name' => 'laudos',
'route_create_name' => 'laudos.create',
'dados' => $laudos,
'ths' => ['Data','Natureza do Exame','REP', 'Ofício', 'Cidade', 'Órgão Solicitante','Perito','Tempo de execução']])

@section('table-content')

<style>
    .tabelaTodosLaudosTd{
        font-size: 12px;
    }
</style>

@if (count($laudos) > 0)
@foreach ($laudos as $laudo)
<tr>
    <td class="tabelaTodosLaudosTd">{{$laudo->created_at->format('d/m/Y')}}</td>
    <td class="tabelaTodosLaudosTd"> {{ $laudo->laudoEfetConst }}</td>
    <td class="tabelaTodosLaudosTd"> {{ $laudo->rep }}</td>
    <td class="tabelaTodosLaudosTd"> {{ $laudo->oficio }}</td>
    <td class="tabelaTodosLaudosTd"> {{ $laudo->cidade_id }}</td>
    <td class="tabelaTodosLaudosTd">{{ $laudo->solicitante && $laudo->solicitante->nome ? $laudo->solicitante->nome : '' }}</td>

    <td class="tabelaTodosLaudosTd"> {{ $laudo->perito->nome }}</td>
    <td class="tabelaTodosLaudosTd">
        
            @if($laudo->tempo_execucao)
                @php
                    $tempoExecucao = \Carbon\Carbon::parse($laudo->tempo_execucao); // Converte para Carbon
                    $diff = $laudo->created_at->diff($tempoExecucao); // Calcula a diferença
                @endphp
                {{ $diff->i }} Minutos e {{ $diff->s }} Segundos
            @else
                --
            @endif
        
        
    </td>
    <td>
        <a class="btn btn-primary mt-1" href="{{ route('laudos.show', $laudo) }}">
            <i class="fa fa-fw fa-eye"></i></a>
        <a class="btn btn-primary mt-1" href="{{ route('laudos.docx', $laudo) }}">
            <i class="fa fa-download" aria-hidden="true"></i></a>
        <button value="{{ route('laudos.destroy', $laudo) }}" class="btn btn-danger delete mt-1">
            <i class="fa fa-fw fa-trash"></i>
        </button>
    </td>
</tr>

@endforeach
@else
<tr>
    <td colspan="6">Nenhum Laudo Encontrado</td>
</tr>
@endif
@endsection