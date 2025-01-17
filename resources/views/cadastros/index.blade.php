<!DOCTYPE html>
<html lang="pt-BR">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Solicitação de cadastro</title>
        <link rel="stylesheet" href="{{ URL::asset('css/layout.css')}}">

</head>

<body class="corpo" onload="funcaoCarregar()" >
        <main id="main">
                <div>
                        @if ($errors->any())
                                <div class="alert alert-danger">
                                        <ul>
                                                @foreach ($errors->all() as $error)
                                                <li style="color:red;">{{ $error }}</li>
                                                @endforeach
                                        </ul>
                        </div>
                        @endif
                </div>
                        
              
                
                <div>
                        <div id="solicitacao_cadastro" >
                       
                                <h1 class="titulo">Polícia Científica do Paraná</h1>
                                <img src="image/logo_policia_cientifica.jpeg" style="width: 25%" alt="">    
                                <h3>Pedir solicitação de Cadastro</h3>
                                <legend>
                                        {!! Form::open(['route' => 'register']) !!}
                                                {{ csrf_field() }}
                                                <label for="nome">Nome completo:</label>
                                                <input type="text" name="nome" id="nome"  required><br>
                                                <label for="email">Email &nbsp;<ion-icon name="mail"></ion-icon>:</label>
                                                <input type="email" name="email"  requered><br>
                                                <span>Unidade Padrão:</span>
                                                <span id="secao"> @include('admin.shared.attributes.secao', ['secoes' => $secoes, 'secao2' => $user->secao_id ?? old('secao_id')])</span><br>
                                                <label >Use Username GDL:<input type="text" name="userGDL"></label><br>
                                                <label >Senha GDL: <input type="password" name="senhaGDL"> </label><br>
                                                <label for="password1"> Senha &nbsp;<ion-icon name="key"></ion-icon>:</label>
                                                <input type="password" id="password1"  name="password" id="senha" requered><br>
                                                <label for="password2"> Confirma senha &nbsp;<ion-icon name="key"></ion-icon>:</label>
                                                <input type="password" id="password2"  name="confirmacao_senha" id="senha" requered><br>
                                                <h6 >*Nome deve conter no minimo 6 caracter.</h6>
                                                
                                                <input type="submit" value="Enviar solicitação">
                                                
                                                {{ Form::close() }} 
                                        
                                        <a href="{{ route('home') }}" ><button>voltar para home <ion-icon name="home"></ion-icon></button></a>
                                        
                                </legend>
                        </div>        
                
                        
                </div>
        </main>
        <script src="..\public\js\cadastroSolicitacao.js"></script>
        <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</body>
</html>

        
        






    
        
       

