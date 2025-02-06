@extends('shared.tableReps', ['card_name' => 'Laudos',
'model_name_plural' => 'Reps',
'model_name_singular' => 'Rep',
'habilitar_pesquisa' => 'true',
'pesquisar' => 'Digite o número da REP',
'route_search_name' => 'laudos',
'route_create_name' => 'laudos.create',
'dados' => $laudos,
'ths' => ['REP', 'Ofício', 'Tipo de exame','Cidade'],])

@section('table-content')


  @foreach ($documents as $document) 
    <tr>
      <td>{{$document->repId}}</td>
      <td>{{$document->numeroAno}}</td>
      <td>{{$document->examNature}}</td>
      <td>{{$document->examCity}}</td>
      <td><button class="btn btn-success" onclick="verifica({{$document->repId}})" ><img width="35%" src="{{asset('image/bell.png')}}" alt=""></button></td> 
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
