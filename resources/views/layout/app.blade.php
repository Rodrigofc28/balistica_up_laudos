<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- base url -->
        <meta name="base-url" content="{{ url('/') }}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>
        <!-- Fonts -->
        {{--<link rel="dns-prefetch" href="https://fonts.gstatic.com">--}}
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/layout.css')}}">
        <link rel="stylesheet" href="{{ URL::asset('css/cssMunicao.css')}}">
        <link rel="stylesheet" href="{{ URL::asset('jquery-ui-1.12.1.custom/jquery-ui.min.css')}}">
        <link rel="stylesheet" href="{{ URL::asset('css/sweetalert2.min.css')}}">
        <link rel="stylesheet" href="{{ URL::asset('css/sb-admin.css')}}">
        <link rel="stylesheet" href="{{ URL::asset('fontawesome-free/css/all.css')}}">
        <link rel="stylesheet" href="{{ URL::asset('css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/select2-bootstrap.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" />
        <link rel="stylesheet" href="{{ URL::asset('css/my_select2.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/btnAcao.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
        
{{--        <link rel="stylesheet" href="{{ URL::asset('css/dropzone_custom.css') }}">--}}

        <!-- Styles Chassi -->
        <link rel="stylesheet" href="{{ URL::asset('css/index-chassi.css') }}">

        @yield('style')
    </head>
    <body>
        @includeWhen(Auth::user()->cargo->nome=='Administrador','layout.menu_admin')
        @includeWhen(Auth::user()->cargo->nome!='Administrador','layout.menu')
        <div id="content-wrapper">
            <div class="container-fluid">
                {{ Breadcrumbs::render() }}
                @include('flash_message')
                @yield('content')
            </div>

            <!-- Sticky Footer -->
           
        </div>
        @include('layout.scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>


        <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
       
        
        
      
    </body>
</html>
