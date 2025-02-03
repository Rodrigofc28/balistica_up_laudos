<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="{{ route('home') }}">Laudos Balísticos</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fa fa-bars"></i>
        
    </button>
    <h5 style="color:aliceblue;padding-left:10px"><strong>{{Auth::user()->nome}}</strong></h5>
    
</nav>
<style>
     /* Exibe o menu dropdown Controle */
    .dropdown-menu {
    display: none;
    
  }
  
 
  .nav-item:hover .dropdown-menu {
    display: block;
  }
  .notification{
    width: 25px;
    height: 25px;
  }
  .uni, .os, .mar, .cal, .ms, .us{
    width: 12px;
    height: 12px;
    margin-left: 15%;
  }
 .notification, .uni, .os, .mar, .cal, .ms, .us{
   
    display: none;
 }
</style>



   


<div id="wrapper">
    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fa fa-fw fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  href="{{ route('laudos.index') }}">
                <i class="fa fa-fw fa-folder-open"></i>
                <span>Minhas REPS</span></a>
        </li>
        
        <li class="nav-item dropdown admin_menu">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fw fa-file"></i>
                <span>Novo Laudo</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a class="dropdown-item tipo_laudo"  href="{{ route('laudos.create', ['tipo_laudo' => 'balistica']) }}">Balística</a>
                <a class="dropdown-item tipo_laudo" href="{{ route('laudos.create', ['tipo_laudo' => 'chassi']) }}">Chassi</a>
               
            </div>
        </li>
        <li class="nav-item admin_reports">
            <a class="nav-link" href="{{ route('admin.relatorios.index') }}">
                <i class="fa fa-fw fa-chart-bar"></i>
                <span>Relatórios</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.laudos.index') }}">
                <i class="fa fa-fw fa-folder-open"></i>
                <span>Todos os Laudos</span></a>
        </li>
        
        <li class="nav-item dropdown admin_menu">
            <div style="display: flex;align-items: center;">
                
                <a class="nav-link dropdown-toggle"  href="#" id="pagesDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-folder"></i>
                    
                    <span>Controle </span>
                    
                </a>
                <img class="notification" src="{{asset('image/bell.png')}}" alt="">
            </div>
            
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a class="dropdown-item" href="{{ route('secoes.index') }}"><img class="notification uni"  src="{{asset('image/bell.png')}}" alt="">Unidades </a>
                <a class="dropdown-item" href="{{ route('diretores.index') }}"><img class="notification"  src="{{asset('image/bell.png')}}" alt="">Diretores </a>
                <a class="dropdown-item" href="{{ route('solicitantes.index') }}"><img class="notification os" src="{{asset('image/bell.png')}}" alt="">Órgãos Solicitantes </a>
                <a class="dropdown-item" href="{{ route('marcas.index') }}"><img class="notification mar"  src="{{asset('image/bell.png')}}" alt="">Marcas </a>
                <a class="dropdown-item" href="{{ route('calibres.index') }} "><img class="notification cal"  src="{{asset('image/bell.png')}}" alt="">Calibres </a>
                <a class="dropdown-item" href="{{ route('cadastro_armas.index') }}" style="display: flex; align-items: center;"> Modelos salvos <img class="notification ms" src="{{asset('image/bell.png')}}" alt=""></a>
                
                <a class="dropdown-item" href="{{ route('users.index') }}"style="display: flex; align-items: center;">Usuários <img class="notification us"  src="{{asset('image/bell.png')}}" alt=""></a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('users.perfil')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-gear" viewBox="0 0 16 16">
                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                  </svg>
                <span>Perfil</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-sign-out-alt"></i>
                <span>{{ __('Logout') }}</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
    <script src="{{asset('js/notification_modelo_arma.js')}}"></script>
    <script src="{{asset('js/notification_usuarios.js')}}"></script>
    <script src="{{asset('js/notification.js')}}"></script>
        
    