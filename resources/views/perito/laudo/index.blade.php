@extends('shared.tableReps', ['card_name' => 'Laudos',
'model_name_plural' => 'Reps',
'model_name_singular' => 'Rep',
'habilitar_pesquisa' => 'true',
'pesquisar' => 'Digite o número da REP',
'route_search_name' => 'laudos',
'route_create_name' => 'laudos.create',
'dados' => $laudos,
'ths' => ['REP','Recebimento','Designação', 'Ofício', 'Natureza do Exame','Cidade','Unidade','Status'],])

@section('table-content')


  @foreach ($documents as $document) 
    <tr>
      
      <td id="rep">{{$document->numeroAno}}</td>
      <td id="recebimento">{{$dateRe = \Carbon\Carbon::parse($document->creationDate)->format('d/m/Y') }}</td>
      <td id="designacao">{{$datedesi = \Carbon\Carbon::parse($document->allocationDate)->format('d/m/Y') }}</td>
      <td id="oficio">Null</td>
      <td id="exame">{{$document->examNature}}</td>
      <td id="cidade">{{$document->examCity}}</td>
      <td id="unidade">{{$document->unit}}</td>
      <td >
        @if ($document->status=="LAUDO EM EXECUÇÃO")
            <img src="{{asset('image/laudo_em_execução.gif')}}">&nbsp; {{$document->status}}
        @else
            <img src="{{asset('image/aberta_e_distribuída.gif')}}">&nbsp;{{$document->status}}
        @endif
      </td>   
      <td>
        <button  class="btn btn-success" 
            data-rep="{{$document->numeroAno}}"
            data-recebimento="{{$dateRe}}"
            data-designacao="{{$datedesi}}"
            data-exame="{{$document->examNature}}"
            data-cidade="{{$document->examCity}}"
            data-unidade="{{$document->unit}}"
            onclick="verifica(event)" value="{{ route('laudos.create', ['tipo_laudo' => 'balistica']) }}" >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
              <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
              <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
            </svg>
        </button>
      </td> 
    </tr>
  
  @endforeach



<tr>
    <td colspan="5">Nenhum Laudo Encontrado</td>
</tr>

<script>

   function verifica(event) {
    var button = event.currentTarget; // Garante que está pegando o botão, não um filho
    var repId = button.getAttribute('data-rep');
    var recebimento = button.getAttribute('data-recebimento');
    var designacao = button.getAttribute('data-designacao');
    var exame = button.getAttribute('data-exame');
    var cidade = button.getAttribute('data-cidade');
    
    // store dados em cache
    localStorage.setItem('repId', repId);
    localStorage.setItem('recebimento', recebimento);
    localStorage.setItem('designacao', designacao);
    localStorage.setItem('exame', exame);
    localStorage.setItem('cidade', cidade); 
    localStorage.setItem('unidade', cidade);
    
    
    Swal.fire({
    title: 'Deseja prosseguir?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Sim',
    cancelButtonText: 'Não'
  }).then((result) => {
    console.log('Resultado:', result); 

    if (result.value) {  
      console.log('Redirecionando...');
      window.location.href = button.value;  
    } else {
      console.log('Cancelado!');
    }
  }).catch((error) => {
    console.log('Erro:', error); 
  });

  }
    
</script>
@endsection
