@extends('layout.component')
@section('page')
<div class="container">
    <style>
       

        .container {
            height: 80%;
            width: 80%;
            max-width: 100%;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }


        header {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .back-button {
            position: left;
            background: none;
            border-radius: 50px;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #1ba4dad0;
        }


        .progress-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
            color: #4bb2c4;
        }


        .image-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-left: 10px;
        }

        .image-container div {
            flex: 1;
            max-width: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-container img {
            width: 100%;
            height: auto;

        }



        .step {
            flex: 1;
            text-align: center;
            font-size: 14px;
            padding: 5px;
            border-radius: 50%;
            color: white;
            background-color: #5cc7d8;
            margin: 0 5px;
        }

        .completed {
            font-weight: bold;
            border-radius: 50px;
        }


        .button-group {
            display: flex;
            text-align: center;
            flex-direction: column;
            gap: 10px;
            margin: 15px 0;
        }

        .large-button {
            background-color: #04a9c2c7;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .large-button:hover {
            background-color: #5cc7d8ee;

        }


        .aggregated {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 15px 0;
        }

        .aggregated label {
            flex: 1;
            font-weight: bold;
        }

        .aggregated select {
            flex: 2;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .add-button {
            background-color: #5cc7d8;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        .add-button:hover {
            background-color: #4bb2c4;
        }




        .progress-container {
        display: flex;
        justify-content: space-between;
      
        max-width: 400px;
        margin: 20px auto;
     
        top: 50%;
        left: 10%;
        width: 80%;
        height: 4px;
        background-color: #ddd;
      
        transition: width 0.4s ease;
    }

        .nav-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 100px;

        }

        .nav-buttons button {
            flex: 1;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            border: none;

        }
        .step {
        width: 40px;
        height: 40px;
        background-color: #ddd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
    }

    .step.active {
        background-color: #00bcd4;
    }

        .back-button {

            background-color: #031d20c7;
            border: 2px solid #031416;
            color: #eeeeee;
            margin-right: 10px;
        }

        .next-button {
            background-color: #031d20c7;
            color: #f8f8f8;
            margin-left: 10px;

        }

        .back-button:hover {
            background-color: #0691eeb7;
            color: aliceblue;
        }

        .next-button:hover {
            background-color: #0691eeb7;
        }
    </style>
    <header>


        <h1>Exame de Identificação Veicular</h1>
    </header>
    <br>
    <div class="progress-container">
        <div class="progress-bar"></div>
        <div class="step active">1</div>
        <div class="step ">2</div>
        <div class="step ">3</div>
        <div class="step ">4</div>
    </div>
    <br><br>
    <h2>Carro</h2>
    <br> <br>

    <div class="button-group">
        <button class="large-button">Chassi &#8594;</button>
        <button class="large-button">Motor &#8594;</button>
    </div>

    <div class="aggregated">
        <label for="aggregated">Adicionar Agregado</label>
        <select id="aggregated">
            <option>Selecione</option>
        </select>
        <button class="add-button">+</button>
    </div>

    <div class="image-container">
        <div>
            <h3></h3>
            <a href="">
                <img src="{{asset('image/scroll.png')}}" alt="Exemplo de imagem" />
            </a>
        </div>
        <div>
            <h3></h3>
            <a href="">
                <img src="{{asset('image/scroll.png')}}"  alt="Exemplo de imagem" />
            </a>
        </div>
        <div>
            <h3></h3>
            <a href="">
                <img src="{{asset('image/scroll.png')}}"  alt="Exemplo de imagem" />
            </a>
        </div>
        <div>
            <h3></h3>
            <a href="">
                <img src="{{asset('image/scroll.png')}}"  alt="Exemplo de imagem" />
            </a>
        </div>
        <div>
            <h3></h3>
            <a href="">
                <img src="{{asset('image/scroll.png')}}"  alt="Exemplo de imagem" />
            </a>
        </div>
        <div>
            <h3></h3>
            <a href="">
                <img src="{{asset('image/scroll.png')}}"  alt="Exemplo de imagem" />
            </a>
        </div>

    </div>
<br><br>
<div class="nav-buttons">
    <button class="back-button">&#8592; Voltar</button>
    <br>
    <button class="next-button">Próximo &#8594;</button>
</div>
</div>




@endsection