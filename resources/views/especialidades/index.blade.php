@extends('adminlte::page')
@section('title', 'Index')

@section('content')

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3>Lista de especialidades</h3>
        </div>
        <div class="box-body table-responsive">

            <table class="table table-bordered" id="">
                <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($especialidades as $especialidade)
                        <tr>
                            <td>{{$especialidade->nome}}</td>
                            <td>
                                <a href="{{route('especialidades.edit',$especialidade)}}" class="btn btn-xs btn-flat btn-primary"><i class="fa fa-eye"></i>Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
@endsection