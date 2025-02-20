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
        <span><strong>REP:</strong> 654654</span><br>
        <span><strong>Oficio:</strong> 56456</span><br>
        <span><strong>Cidade:</strong> 546546</span><br>
        <span><strong>Órgão solicitante:</strong> 54645645</span><br>
        
        
        <input type="button" class="btn btn-success" id="btn-edit" value="Editar Informações do cabeçalho">
       
      </div>
       


<hr>

<div class="col-lg-12">
    
    
   
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="tabela_chassis">
            <thead align="center">
                <tr>
                    <th>id</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ano</th>
                    
                    <th>Nº da placa</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody align="center">

        @foreach (['49','Moto','Honda','CG125','2010','666'] as $item)
            <td>{{$item}}</td>
            
        @endforeach
        <td><button>Editar</button></td>
        <td><button>excluir</button></td>
              
 

            </tbody>
        </table>
    </div>
    
    


    <div class="row mb-3">
        <div class="col-lg-3 mt-2">
            <a class="btn btn-secondary btn-block" href="">
                <i class="fas fa-arrow-circle-left"></i> Voltar</a>
        </div>

        <div class="col-lg-3 mt-2">
            <a class="btn btn-success btn-block" href="">
                <i class="fas fa-plus" aria-hidden="true"></i>
                Adicionar Material
            </a>
        </div>
        
    <div class="col-lg-3 mt-2">
        <a class="btn btn-primary btn-block" href="">
            <i class="fas fa-file-download" aria-hidden="true"></i>
            Gerar Laudo (.docx)
        </a>
    </div>
    
</div>
</div>


@endsection
