@extends('layout.component')
@section('page')
<style>
                .input-container {
                    position: relative;
                    margin-top: 20px;
                }
                
                .input-container input {
                    width: 100%;
                    padding: 10px;
                    font-size: 16px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    outline: none;
                }
                
                .input-container label {
                    position: absolute;
                    top: 50%;
                    left: 10px;
                    transform: translateY(-50%);
                    background: white;
                    padding: 0 5px;
                    color: #888;
                    transition: 0.3s;
                }
                
                .input-container input:focus + label,
                .input-container input:valid + label {
                    top: 0;
                    left: 10px;
                    font-size: 12px;
                    color: #333;
                }
    .inpt{
        border-radius: 5px;
    }
    .conteinerDiv{
        display: block;
        padding: 10%
    }
   
    .perfil{
        display: block;
        text-align: center;
        background-color: rgb(255, 255, 255);
    
    }
    .tecnicos{
        border: 1px solid rgb(206, 202, 202);
        padding: 5px;
        border-radius: 5px;
    }
</style>
<h2>{{$user->cargo->nome}}: {{$user->nome}}</h2>
    
    <div class="conteinerDiv">
        <div >
            <img src="{{asset('image/perfilUser.png')}}" alt="perfil do usuário">
            <form id="updateUserForm"  method="post">
                {{ csrf_field() }}
                <input class="form-control" hidden name="id" value="{{$user->id}}" type="text">
                
                <div class="mb-3 input-container">
                    <input id="nomeUser" class="form-control" name="nome" value="{{$user->nome}}" type="text">
                    <label for="nomeUser"  class="form-label">Nome Completo</label>
                    
                </div>
                <div class="mb-3 input-container">
                    
                    <input id="emailPerfil" class="form-control" name="email" value="{{$user->email}}" type="text">
                    <label for="emailPerfil" class="form-label">Email</label>
                </div>
                <div class="mb-3 input-container">
                    <input id="gdlUser" class="form-control" name="userGDL" value="{{$user->userGDL}}" type="text">
                    <label for="gdlUser" class="form-label">Username GDL</label>
                    
                </div>
                <div class="mb-3 input-container">
                    
                    <input id="gdlSenha" class="form-control" name="senhaGDL" value="{{$user->senhaGDL}}"  type="password">
                    <label for="gdlSenha"  class="form-label">Senha GDL</label>
                </div>
                
                
                <div class="mb-3 ">
                    <label  class="form-label">Unidade</label>
                    <select class="form-control" name="secao_id" id="">
                        @foreach ($secao as $s)
                            <option @if ($s->nome==$user->secao->nome) selected @endif value="{{$s->id}}">{{$s->nome}}</option>
                        @endforeach
                    </select>
                </div>
                @if ($user->cargo->nome == 'Perito' || $user->cargo->nome == 'Administrador')
                <span>Técnicos autorizados para a realização de laudos periciais</span>
                <div class="mb-3 tecnicos">
                    @foreach ($userAll as $tecnico)
                        <label for="">{{$tecnico->nome}}&nbsp;</label>
                        <input type="checkbox" name="tecnico_perito_aut[]" value="{{$tecnico->nome}}" 
                            {{ is_array($user->tecnico_perito_aut) && in_array($tecnico->nome, $user->tecnico_perito_aut) ? 'checked' : '' }}>
                    @endforeach
                </div>
                @endif

                <button value="{{route('users.update', ['user' => $user->id])}}"  class="btn btn-primary form-control">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                    Editar
                </button>
            </form>
        </div>
        
        
        
        
        
    </div>
    
    <script>
        document.getElementById('updateUserForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário
        let submitButton = event.submitter;
        let buttonValue = submitButton.value; 
        
        let formData = new FormData(this);

        fetch(buttonValue, {
            method: "Post", // Método HTTP PUT
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
            title: "Usuário atualizado com sucesso!",
            icon: "success",
            confirmButtonText: "OK"
            }).then(() => {
                location.reload(); // Recarrega a página quando o botão "OK" for clicado
            });
        })
        .catch(error => console.error("Erro:", error));
    });
    </script>        
                
@endsection

    