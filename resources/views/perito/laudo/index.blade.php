@extends('shared.tableReps', ['card_name' => 'Laudos',
'model_name_plural' => 'Reps',
'model_name_singular' => 'Rep',
'habilitar_pesquisa' => 'true',
'pesquisar' => 'Digite o número da REP',
'route_search_name' => 'laudos',
'route_create_name' => 'laudos.create',
'dados' => $laudos,
'ths' => ['REP', 'Ofício',  'Status']])

@section('table-content')
<div id="progress-bar"></div>

<a href="{{route('laudos.atualiza','CONFRONTO')}}"class="btn btn-success" style="width:30%">EXAME DE CONFRONTO BALÍSTICO</a><br>
<a id="uol" href="{{route('laudos.atualiza','EFICIÊNCIA')}}" class="btn btn-success"style="width:30%">EXAME DE EFICIÊNCIA E PRESTABILIDADE</a>

@if (count($reps) > 0)
@foreach ($reps as $laudo)
@php
$new=json_decode($laudo->envolvidos);

@endphp

<tr>
    <td> {{ $laudo->rep }}</td>
    <td> {{ $laudo->oficio }}</td>
    
    
    <td>{{$laudo->status}}</td>
     <td>
        <a class="btn btn-primary mt-1" href="{{ route('laudos.rep',['rep'=>$laudo->rep,'oficio'=>$laudo->oficio,
            'unidade'=>$laudo->unidade,'orgao'=>$laudo->orgao,'envolvido'=>$new,'cidade'=>$laudo->cidade,
            'data_solicitacao'=>$laudo->data_solicitacao,'ip'=>$laudo->ip,'bo'=>$laudo->bo,
            'data_designacao'=>$laudo->data_designacao,'data_recebimento'=>$laudo->dataSoli,'ipOn'=>$laudo->ipOn,'ipPm'=>$laudo->ipPm,'boc'=>$laudo->boc,'ipOnOrgao'=>$laudo->ipOnOrgao,'ipPmOrgao'=>$laudo->ipPmOrgao,
            'bocOrgao'=>$laudo->bocOrgao,'ipOnCidade'=>$laudo->ipOnCidade,'ipPmCidade'=>$laudo->ipPmCidade,'bocCidade'=>$laudo->bocCidade,'ipAi'=>$laudo->ipAi,'orgaoAi'=>$laudo->orgaoAi,'cidadeAi'=>$laudo->cidadeAi,
            'cidadeBo'=>$laudo->cidadeBo,'orgaoBo'=>$laudo->orgaBo]) }}">
            <i class="fa fa-fw fa-file"></i></a>
       
    </td> 
</tr>
<script>
    var teste = document.getElementById('uol');
    teste.addEventListener('click', function() {
        var progressBar = document.getElementById('progress-bar');
        var progress = 0;
        var intervalId = setInterval(function() {
          progress += 1;
          progressBar.style.width = progress + '%';
          if (progress >= 100) {
            clearInterval(intervalId);
            progressBar.style.display = 'none';
          }
        }, 400);
      });
</script>
@endforeach
@else
<tr>
    <td colspan="5">Nenhum Laudo Encontrado</td>
</tr>
@endif
@endsection
