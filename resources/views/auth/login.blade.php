@extends('layout.login')
@section('content')
    <div class="container" >
        <div class="card card-login mx-auto mt-5">
            
            <div class="card-header">
                <img src="../public/image/logo_policia_cientifica.jpeg" alt="">
               <p>POLÍCIA CIENTÍFICA DO PARANÁ</p>
               
            </div>
            <div class="card-body">
                {{ Form::open(['route' => 'login']) }}
                @include('flash_message')
                <div class="form-group">
                    <div class="form-label-group">
                        <input id="email" type="email"
                               class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                               name="email" required autofocus>
                        <label for="email">E-Mail</label>
                        
                        @include('shared.error_feedback', ['name' => 'email'])
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input id="password" type="password"
                               class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                               name="password" required>
                        <label for="password">Senha</label>
                        @include('shared.error_feedback', ['name' => 'password'])
                    </div>
                </div>
                <div class="text-center">
                    <div class="btn-block">
                        
                        <button type="submit" class="btn btn-primary">
                            ENTRAR
                        </button>
                        <a href=" {{ route('home') }}" class="btn btn-secondary">
                            VOLTAR
                        </a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
