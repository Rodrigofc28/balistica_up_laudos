<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}">
</head>

<body onload="funcaoCarregar()">
    <section id="home">
        <div class="home-container">
            <div class="home-logo">
                <img src="../public/image/logo_policia_cientifica.jpeg" style="width: 30%" alt="Logo da Policia Científica do Paraná">
            </div>

            <h1 style="color:red">Em manutenção</h1>

            <h1>Gerador de Laudos Balísticos</h1>
            <div class="actions">
                @auth
                <a class="btn-home-page" href="{{ route('dashboard') }}">
                    Home
                </a>
                @else
                <a class="btn-home-page" href="{{ route('login') }}">
                    Login
                </a>
                @endauth
                 <a href="{{ route('cadastros.index') }}" class="btn-solicita">Solicitar Acesso</a> 
                 <!-- <a href="{{route('reportar.index')}}" style="color:red">Reporta erro</a> -->
            </div>
            <br>
            
            
            
        </div>
    </section>
    <footer>

    </footer>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script>
        function funcaoCarregar(){
            var elemento = document.getElementById('home');
            elemento.style.opacity = 3;
        }
    </script>
</body>

</html>