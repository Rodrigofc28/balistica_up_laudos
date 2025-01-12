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
    <link rel="manifest" href="manifest.json" />
        <link rel="manifest" href="/app.webmanifest" crossorigin="use-credentials" />

        <meta name="theme-color" content="#000000">
</head>

<body onload="funcaoCarregar()">
    <style>
        #installPWA {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin:auto;
        }

        #installPWA:hover {
            background-color: #0056b3;
        }
    </style>


    <section id="home">
        <div class="home-container">
            <div class="home-logo">
                <img src="../public/image/logo_policia_cientifica.jpeg" style="width: 30%" alt="Logo da Policia Científica do Paraná">
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
            
            <button id="installPWA" style="display: none;">
                <p>INSTALAR PARA DESKTOP</p>
                
                
            </button>

            
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
    <script>
           
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('./service-worker.js')
                    .then(function(registration) {
                        console.log('Service Worker registrado com sucesso:', registration);
                    })
                    .catch(function(error) {
                        console.log('Falha ao registrar o Service Worker:', error);
                    });
            }
        </script>
        <script>
    let deferredPrompt;

    window.addEventListener('beforeinstallprompt', (e) => {
        // Impede o navegador de mostrar automaticamente o banner de instalação
        e.preventDefault();
        deferredPrompt = e;

        // Mostra o botão para instalação
        const installBtn = document.getElementById('installPWA');
        installBtn.style.display = 'block';

        // Adiciona um evento de clique no botão
        installBtn.addEventListener('click', () => {
            // Mostra o prompt de instalação
            deferredPrompt.prompt();

            // Aguarda o resultado do usuário
            deferredPrompt.userChoice.then((choiceResult) => {
                if (choiceResult.outcome === 'accepted') {
                    console.log('Usuário aceitou instalar a PWA');
                } else {
                    console.log('Usuário recusou instalar a PWA');
                }
                deferredPrompt = null;
            });
        });
    });
</script>

</body>

</html>