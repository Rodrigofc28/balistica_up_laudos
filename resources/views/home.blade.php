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
    
        

        <meta name="theme-color" content="#000000">
</head>

<body onload="funcaoCarregar()">
    
<style>
   
</style>

    <section id="home">
        <div class="home-container">
            <div class="home-logo">
                <img style="width: 20%" src="{{asset('image/logo_policia_cientifica.jpeg')}}" alt="logo">
            </div>

            

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
            
            
            <a href="./mysetup.exe" download class="btn btn-primary">Baixar arquivo teste</a>

            
        </div>
    </section>
    <footer>

    </footer>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script>
        async function checkServer() {
            try {
                // Faz uma requisição para o servidor localhost na porta 5000
                const response = await fetch("http://localhost:5000");

                if (response.ok) {
                    // Cria um elemento <p> e insere a mensagem
                    const p = document.createElement("p");
                    p.textContent = "Conectado ao servidor local!";
                    p.style.color = "green";
                    document.body.appendChild(p);
                } else {
                    console.error("Servidor respondeu, mas não está OK");
                }
            } catch (error) {
                // Caso o servidor não esteja rodando
                console.error("Não foi possível conectar ao servidor:", error);
            }
        }

        // Chama a função para verificar o servidor
        checkServer();
        function funcaoCarregar(){
            var elemento = document.getElementById('home');
            elemento.style.opacity = 3;
        }
      
        function playSound() {
            const audio = document.getElementById('whaleSound');
            audio.play(); // Reproduz o som
        }
    
    </script>
   
        

</body>

</html>