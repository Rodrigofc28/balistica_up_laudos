<style>
    /* Exibe o menu dropdown Controle */
   .dropdown-menu {
   display: none;
   
 }
 

 .nav-item:hover .dropdown-menu {
   display: block;
 }
 .tipo_laudo{
   padding-left: 2px;
   font-size: 12px;
  
 }
</style>



<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="{{ route('home') }}">Laudos Balísticos</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fa fa-bars"></i>
    </button>
    <h5 style="color:aliceblue;padding-left:10px"><strong>{{Auth::user()->nome}}</strong></h5>
    
</nav>

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
            <a class="nav-link" href="{{ route('laudos.index') }}">
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
       
        <li class="nav-item">
            <a class="nav-link" href="{{ route('meus_laudos') }}">
            <svg style="width:15px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#c0c0c0" d="M64 32C64 14.3 49.7 0 32 0S0 14.3 0 32l0 96L0 384c0 35.3 28.7 64 64 64l192 0 0-64L64 384l0-224 192 0 0-64L64 96l0-64zM288 192c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-128c0-17.7-14.3-32-32-32l-98.7 0c-8.5 0-16.6-3.4-22.6-9.4L409.4 9.4c-6-6-14.1-9.4-22.6-9.4L320 0c-17.7 0-32 14.3-32 32l0 160zm0 288c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-128c0-17.7-14.3-32-32-32l-98.7 0c-8.5 0-16.6-3.4-22.6-9.4l-13.3-13.3c-6-6-14.1-9.4-22.6-9.4L320 288c-17.7 0-32 14.3-32 32l0 160z"/></svg>
                <span>Meus Laudos</span></a>
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