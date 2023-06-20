@extends('layout.component')
@section('page')
<div class="col-lg-12">
    <div class="row m-auto">
        <h3 class="float-left">{{ $model_name_plural }}: </h3>
    </div>
    
    <div class="table-responsive">
         
        <table class="table table-bordered table-hover table-striped">
            <thead align="center">
                <tr>
                    @foreach ($ths as $th)
                    <th>{{ $th }}</th>
                    @endforeach
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody align="center" class="table-search">
                @yield('table-content')
            </tbody>
        </table>
    </div>
</div>

@endsection