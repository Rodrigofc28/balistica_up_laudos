@extends('layout.component')
@section('page')
<div class="col-lg-12">
    <div class="row m-auto">
        <h3 class="float-left">{{ $model_name_plural }}: </h3>
    </div>
    <div class="row">
        
        
    </div>
    <div class="table-responsive" style="overflow-y: scroll;height: 700px;">
        <table class="table table-bordered table-hover table-striped" >
            <thead align="center">
                <tr>
                    @foreach ($ths as $th)
                        <th>{{ $th }}</th>
                    @endforeach
                   
                </tr>
            </thead>
            <tbody align="center" class="table-search">
                @yield('table-content')
            </tbody>
        </table>
    </div>
</div>

@endsection