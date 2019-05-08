@extends('adminlte::page')
@section('title', 'Index')

@section('content')

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3>Lista de associados</h3>
        </div>
        <div class="box-body table-responsive">

            <table class="table table-bordered" id="associados-table">
                <thead>
                <tr>
                    <th scope="col">Nome completo</th>
                    <th scope="col">Classe</th>
                    <th scope="col">Data de nascimento</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
            </table>
            <a href="{{route('exportar_csv')}}" class="btn btn-primary pull-right btn-flat"><i class="fa fa-file-excel-o"></i> Exportar para CSV </a>
@endsection