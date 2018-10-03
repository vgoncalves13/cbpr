@extends('adminlte::page')
@section('title','401')
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h1  id="fittext1">401<i class="fa fa-exclamation-triangle fa-fw"></i></h1>
            </div>
            <div class="box-body">
                <h2>Sem autorização</h2>
                <a
                        id="botao"
                        href="{{url()->previous()}}"
                        data-original-title="Voltar"
                        data-toggle="tooltip"
                        type="submit"
                        class="btn btn-primary btn-flat">
                    <i class="fa fa-arrow-left"> Voltar</i>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection