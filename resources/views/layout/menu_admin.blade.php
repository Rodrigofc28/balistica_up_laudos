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
    width: 8px;
    height: 8px;
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
    