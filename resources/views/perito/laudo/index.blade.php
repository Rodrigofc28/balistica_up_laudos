@extends('shared.tableReps', ['card_name' => 'Laudos',
'model_name_plural' => 'Reps',
'model_name_singular' => 'Rep',
'habilitar_pesquisa' => 'true',
'pesquisar' => 'Digite o número da REP',
'route_search_name' => 'laudos',
'route_create_name' => 'laudos.create',
'dados' => $laudos,
'ths' => ['REP', 'Ofício', 'Natureza do Exame','Cidade','Unidade','Status'],])

@section('table-content')


  @foreach ($documents as $document) 
    <tr>
      <td>{{$document->numeroAno}}</td>
      <td>Null</td>
      <td>{{$document->examNature}}</td>
      <td>{{$document->examCity}}</td>
      <td>{{$document->unit}}</td>
      <td>
      @if ($document->status=="LAUDO EM EXECUÇÃO")
          <img src="{{asset('image/laudo_em_execução.gif')}}">&nbsp; {{$document->status}}
      @else
          <img src="{{asset('image/aberta_e_distribuída.gif')}}">&nbsp;{{$document->status}}
      @endif
      </td>   
      <td><button class="btn btn-success" onclick="verifica({{$document->repId}})" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
      </svg></button></td> 
    </tr>
  
  @endforeach



<tr>
    <td colspan="5">Nenhum Laudo Encontrado</td>
</tr>

<script>
   function verifica(repId) {
    console.log(repId)
    Swal.fire({
        title: "A REP designada já foi atualizada no GDL?",
        showDenyButton: true,
        confirmButtonText: "Sim",
        showDenyButton: true,
        showCancelButton: true,
         denyButtonText: `Don't save`
    }).then((result) => {
        if (result.isConfirmed) {
            // Fazer requisição à API
            
            fetch('http://10.66.10.102:5000/restApi', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ repId: repId, atualizado: true })
            })
            .then(response => response.json())
            .then(data => {
              console.log("Resposta da API:", data);
              Swal.fire(`Resposta: ${data.message}`, `Status: ${data.status}`, "success");
            })
            .catch(error => {
                Swal.fire("Erro ao atualizar!", "", "error");
                console.error('Erro:', error);
            });
        } else if (result.isDenied) {
            Swal.fire("Alterações não foram salvas", "", "info");
        }
    });
}
  document.addEventListener('click', function() {
    var loadingImage = document.getElementById('loading');
    loadingImage.hidden = false;
    
    });
</script>
@endsection
