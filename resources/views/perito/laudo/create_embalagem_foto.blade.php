@extends('layout.component')

@section('page')
    <h1>Adicionar Fotos Da Embalagem</h1>
    <div style="border:solid 1px #E0E0E0; ">
    
        <form id="uploadForm" action="{{route('embalagem')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            <h4><strong style="padding:10px "> ADICIONAR IMAGENS DA EMBALAGEM RECEBIDA </strong> </h4>
            <input type="text" hidden name="laudo_id" value="{{$laudo_id}}">
            
            <div class="input-group mb-2">
                <button type="button" style="border:solid 0px;">FRENTE</button>
                <input type="file" class="form-control" name="fotoEmbalagem[]" multiple accept=".jpg, .jpeg, .png">
            </div>
            <div class="input-group mb-2">
                <button type="button" style="border:solid 0px;">VERSO</button>
                <input type="file" class="form-control" name="fotoEmbalagem[]" multiple accept=".jpg, .jpeg, .png">
            </div>
        </form>
        <button id="submitButton" style="margin-top: 10px; background-color: #007bff; color: white; padding: 10px; border: none; cursor: pointer;">
            Enviar Imagens
        </button>
        <script>
         document.getElementById('submitButton').addEventListener('click', async (event) => {
    event.preventDefault();

    const form = document.getElementById('uploadForm');
    const formData = new FormData(form);

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
        });

        const contentType = response.headers.get('Content-Type');

        if (response.ok) {
            if (contentType.includes('application/json')) {
                const result = await response.json();
                alert('Imagens enviadas com sucesso!');
                console.log(result);
            } else {
                const text = await response.text();
                alert('Resposta inesperada do servidor.');
                console.error('Resposta HTML:', text);
            }
        } else {
            const errorText = await response.text();
            alert('Erro ao enviar as imagens.');
            console.error('Erro:', errorText);
        }
    } catch (error) {
        console.error('Erro de rede:', error);
    }
});


        </script>
@endsection