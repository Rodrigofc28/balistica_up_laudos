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

<div >
  
  <button id="uol" class="btn btn-success" style="width:30%">Busca</button>
  <img id="loading" style="width: 100px" hidden  src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt="Carregando..." />

</div>
  



<tr>
    <td id="reps_on"><a id=gdl target="_blank" rel="noopener noreferrer"></a></td>
    <td> </td>
    
    
    <td></td>
     <td>
        
       
    </td> 
</tr>


<tr>
    <td colspan="5">Nenhum Laudo Encontrado</td>
</tr>

<script>
  
  document.addEventListener('click', function() {
    var loadingImage = document.getElementById('loading');
    loadingImage.hidden = false;
    fetch('http://10.66.10.102:5000/link_rep')
      .then(response => {
        
        // Verifica se a resposta é bem-sucedida
        if (!response.ok) {
          throw new Error('Erro na requisição');
        }
        return response.json(); // Converte a resposta para JSON
      })
      .then(data => {
        var link_ = document.getElementById('gdl');
        link_.href = data[0].link
        link_.textContent = data[0].description
        loadingImage.hidden = true;
        console.log(data); // Aqui você pode manipular o JSON
      })
      .catch(error => {
        loadingImage.hidden = true;
        console.error('Erro ao fazer a requisição:', error);
      });
    });
</script>
@endsection
