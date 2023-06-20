@extends('layout.component')
@section('page')

<div class="col-lg-12">


    <div id="teste" class="table-responsive" style="overflow-y: scroll;height: 700px;">
    
        <table id="tabeladepedidos" class="table table-bordered table-hover table-striped">
             
            <thead align="center">
            
                <tr>
                
                    @foreach ($ths as $th)
                    <th>{{ $th }}</th>
                    @endforeach
                    <th>Cadastrar Usuário</th>
                    <th>Função Cadastrada</th>
                    <th>Altera senha GDL</th>
                    
                </tr>
            </thead>
            <tbody align="center" class="table-search">
                @yield('table-content')
            </tbody>
        </table>
    </div>
</div>

@endsection
