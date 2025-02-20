@extends('layout.component')
@section('js')
{!! Html::script('js/filtrar_solicitantes.js') !!}
{!! Html::script('js/calendar.js') !!}
{!! Html::script('js/cropper.js') !!}
{!! Html::script('js/dropzone.js') !!}
{!! Html::script('js/dropzone_config.js') !!}
{!! Html::script('js/cropper_image.js') !!}
{!! Html::script('js/edicaoimagem.js') !!}
{!! Html::script('js/edicaolaudo.js') !!}

@endsection
@section('page')
<style>
    .conteiner_embalagens_foto{
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
       justify-content: center
    }
    .fotosEmbalagens{
        border:1px solid black;
       
        border-radius: 5px;
        padding: 3px;
        background-color:#ffffff;
    }
    .icon-substituir{
        width: 50px;
        background-color: red;
        border-radius: 5px;
    }
</style>
<hr>

<div id="showLaudo" class="col-lg-12">
        <span><strong>REP:</strong> {{$laudo->rep}}</span><br>
        <span><strong>Oficio:</strong> {{$laudo->oficio}}</span><br>
        <span><strong>Cidade:</strong> {{$laudo->cidade_id}}</span><br>
        <span><strong>Órgão solicitante:</strong> {{ $laudo->solicitante->nome ?? '' }}</span><br>
        
        
       
       
      </div>
       


<hr>

<div class="col-lg-12">
    
    
   
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="tabela_chassis">
            <thead align="center">
                <tr>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ano</th>
                    
                    <th>Nº da placa</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody align="center">

   
    <td>{{$chassi['veiculo_id']}}</td>
    <td>{{$chassi['marca_fabricacao']}}</td>
    <td>{{$chassi['modelo']}}</td>
    <td>{{$chassi['ano']}}</td>
    <td>{{$chassi['placa']}}</td>
    <td><button>Excluir</button></td>
    <td><button>Deletar</button></td>
            <td><button>fgdf</button></td>  
 

            </tbody>
        </table>
    </div>
    
    


    <div class="row mb-3">
        <div class="col-lg-3 mt-2">
            <a class="btn btn-secondary btn-block" href="">
                <i class="fas fa-arrow-circle-left"></i> Voltar</a>
        </div>

        
        
        <div class="col-lg-3 mt-2">
            <a class="btn btn-primary btn-block" href="{{ route('laudosChassi.docx', ['laudo' => $laudo]) }}">
                <i class="fas fa-file-download" aria-hidden="true"></i>
                Gerar Laudo (.docx)
            </a>
        </div>
    
</div>
</div>


@endsection
