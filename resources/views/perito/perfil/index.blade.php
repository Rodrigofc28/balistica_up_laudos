@extends('layout.component')
@section('page')
<style>
    .inpt{
        border-radius: 5px;
    }
    .conteinerDiv{
        display: block;
        padding: 20%
    }
</style>
    <div class="conteinerDiv">
        <input class="inpt" value="{{$user->nome}}" type="text"><br>
        <input class="inpt" value="{{$user->email}}" type="text"><br>
        <select name="" id="">
            @foreach ($secao as $s)
               <option @if ($s->nome==$user->secao->nome) checked @endif value="{{$s->id}}">{{$s->nome}}</option>
            @endforeach
        </select><br>
        <input type="text"><br>
        <button>Editar</button>
        
        
    </div>
    
                
                
@endsection

    