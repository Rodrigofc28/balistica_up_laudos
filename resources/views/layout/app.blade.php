<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
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
        <link rel="stylesheet" href="https://unpkg.com/cropperjs/dist/cropper.min.css">
{{--        <link rel="stylesheet" href="{{ URL::asset('css/dropzone_custom.css') }}">--}}

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
       
        <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
        <script src="https://unpkg.com/cropperjs/dist/cropper.min.js"></script>
        <script>
            //mudar script de lugar
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                               
                                    $(".show-alert").on('click',async function () {
                    const usuarioData = this.dataset.usuario;

                    // Converte o valor de string JSON para um objeto JavaScript
                    const usuario = JSON.parse(usuarioData);
                    
                    const url_with_id = $(this).val(); // Recupera a URL definida no botão
                    console.log(url_with_id);

                    // Mostra o SweetAlert com os campos preenchidos
                    const { value: formValues } = await Swal.fire({
                        title: "",
                        html: `
                        <label for="swal-input1">E-mail
                        <input id="swal-input1" name="email" value="${usuario.email}" class="swal2-input" placeholder="Digite algo">
                        </label>
                        <label for="swal-input2">Nome
                        <input id="swal-input2" name="nome" value="${usuario.nome}" class="swal2-input" placeholder="Digite algo mais">
                        </label>
                        <input id="swal-input3" hidden name="id" value="${usuario.id}">
                        `,
                        focusConfirm: false,
                        showCancelButton: true,
                        confirmButtonText: "Enviar",
                        cancelButtonText: "Cancelar",
                        preConfirm: () => {
                        return {
                            email: document.getElementById("swal-input1").value,
                            nome: document.getElementById("swal-input2").value,
                            id: document.getElementById("swal-input3").value,
                        };
                        },
                    });

                    // Envia os dados se o SweetAlert for confirmado
                    if (formValues) {
                        // Envia os dados usando AJAX do jQuery
                        $.ajax({
                        url: url_with_id, // URL dinâmica com o ID do usuário
                        type: "POST", // Método da requisição
                        data: {
                        // Token CSRF
                            email: formValues.email,
                            nome: formValues.nome,
                            id: formValues.id,
                        },
                        success: function (response) {
                            Swal.fire("Sucesso", "Usuário atualizado com sucesso!", "success")
                            .then(() => {
                                    location.reload(); // Recarrega a página
                                });
                            
                        },
                        error: function (xhr) {
                            Swal.fire("Erro", "Não foi possível atualizar o usuário.", "error");
                            console.error(xhr.responseText); // Debug do erro
                        },
                        });
                    }
                    });


        
    </script>    
    </body>
</html>
