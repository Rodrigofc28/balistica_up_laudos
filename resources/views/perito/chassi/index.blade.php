@extends('layout.component')
@section('page')
<style>
    .container {
        width: 90%;
        max-width: 1200px;
        background: rgba(255, 255, 255, 0.747);
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    header {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        color: rgb(0, 48, 48);
    }

    h1 {
        font-size: 36px;
        text-decoration: underline;
    }

    .option-container {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 30px;
        max-width: 800px;
        margin: auto;
    }

    .option {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 200px;
        height: 200px;
        background: rgba(248, 248, 248, 0.623);
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        text-align: center;
        cursor: pointer;
        transition: transform 0.2s;
        border: 1px solid #ddd;
    }

    .option:hover {
        transform: scale(1.05);
    }

    img {
        width: 100%;
        max-width: 150px;
        height: auto;
        border-radius: 5px;
        opacity: 0.7;
    }

    .back-button {
        margin-top: 30px;
        padding: 10px 20px;
        background-color: #71e0ce;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 18px;
        transition: background 0.3s;
    }

    .back-button:hover {
        background-color: #0cc9cfb0;
        color: aliceblue;
        text-decoration: none;
    }
</style>

<div class="container">
    <header>
        <h1>Escolha um Veículo</h1>
    </header>
    <br>
    <hr><br>

    <div class="option-container">
        <div class="option">
            <a href="{{route('carro.index')}}"><img src="{{asset('image/img/carro.png')}}" alt="Carro"></a>
            <span>Carro</span>
        </div>

        <div class="option">
            <a href="{{route('motocicletas.tela2', $laudo_id)}}"><img src="{{asset('image/img/moto.png')}}" alt="Moto"></a>
            <span>Moto</span>
        </div>  
        <div class="option">
            <a href="{{route('motocicleta.index')}}"><img src="{{asset('image/img/caminhao.png')}}" alt="Caminhão"></a>
            <span>Caminhão</span>
        </div>
        <div class="option">
            <a href="{{route('motocicleta.index')}}"><img src="{{asset('image/img/semi-reboque.png')}}" alt="Semi-reboque"></a>
            <span>Semi-reboque</span>
        </div>
        <div class="option">
            <a href="{{route('motocicleta.index')}}"><img src="{{asset('image/img/outros.png')}}" alt="Outros"></a>
            <span>Outros</span>
        </div>
        <div class="option">
            <a href="{{route('motocicleta.index')}}"><img src="{{asset('image/img/outros.png')}}" alt="Outros"></a>
            <span>Outros</span>
        </div>
        

        
        

    </div>

    <a href="javascript:history.back()" class="back-button">Voltar</a>
</div>

@endsection
