@extends('adminlte::page')
@section('title', 'Index')

@section('content')

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3>Lista de médicos</h3>
        </div>
        <div class="box-body table-responsive">

            <table class="table table-bordered" id="">
                <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">CRM</th>
                    <th scope="col">Especialidades</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($medicos as $medico)
                    <tr>
                        <td>{{$medico->nome}}</td>
                        <td>{{$medico->crm}}</td>
                        <td>
                            @foreach($medico->especialidades as $especialidade)
                                @if(count($medico->especialidades) > 1)
                                    {{$especialidade->nome . " -"}}
                                @else
                                    {{$especialidade->nome}}
                                @endif
                            @endforeach
                        </td>

                        <td>
                            <a href="{{route('medicos.edit',$medico->id)}}" class="btn btn-xs btn-flat btn-primary"><i class="fa fa-eye"></i>Editar</a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
@endsection