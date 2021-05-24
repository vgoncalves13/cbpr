@extends('adminlte::page')
@section('title', 'Lista marcações')

@section('content')

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3>Lista de marcações</h3>
            <a href="{{route('marcacao.especialidade')}}" class="btn btn-primary pull-right">Cadastrar nova consulta</a>
        </div>
        <div class="box-body table-responsive">

            <table class="table table-bordered" id="">
                <thead>
                <tr>
                    <th scope="col">Nome médico</th>
                    <th scope="col">Nome paciente</th>
                    <th scope="col">Especialidade</th>
                    <th scope="col">Data</th>
                    <th scope="col">Horário</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($marcacoes as $marcacao)
                    <tr>
                        <td>{{$marcacao->medico->nome}}</td>
                        <td>{{$marcacao->pacienteable->nome_completo}}</td>
                        <td>{{$marcacao->especialidade->nome}}</td>
                        <td>{{\Carbon\Carbon::parse($marcacao->dia_consulta)->format('d/m/Y')}}</td>
                        <td>{{($marcacao->hora_consulta)}}</td>

                        <td>
                            <a href="{{route('medicos.edit',$marcacao->id)}}" class="btn btn-xs btn-flat btn-primary"><i
                                        class="fa fa-eye"></i>Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
@endsection