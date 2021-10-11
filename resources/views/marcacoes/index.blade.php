@extends('adminlte::page')
@section('title', 'Lista marcações')

@section('content')

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3>Lista de marcações</h3>
            @if(!\Laratrust::hasRole(['admin','superadmin']))
                <a href="{{route('marcacao.especialidade')}}" class="btn btn-primary pull-right">Agendar uma nova consulta</a>
            @endif
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
                            <td><a href="{{route('associados.show',$marcacao->associado_id)}}">
                                    {{$marcacao->pacienteable->nome_completo}}</a> </td>
                        <td>{{$marcacao->especialidade->nome}}</td>
                        <td>{{$marcacao->dia_consulta}}</td>
                        <td>{{($marcacao->hora_consulta)}}</td>
                        <td>
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{route('marcacao.show',$marcacao)}}" class="btn btn-xs btn-flat btn-primary"><i
                                                class="fa fa-eye"></i>Detalhes</a>
                                    <a href="#"
                                       onclick="
                                               var result = confirm('Você tem certeza que deseja cancelar esta consulta?');
                                               if (result){
                                               event.preventDefault();
                                               document.getElementById('cancel-form{{$marcacao->id}}').submit();
                                               } "
                                       data-original-title="Cancelar consulta" data-toggle="tooltip" type="button"
                                       class="btn btn-xs btn-flat btn-danger"><i class="fa fa-ban"> </i> Cancelar
                                    </a>
                                    <form id="cancel-form{{$marcacao->id}}" action="{{route('marcacao.destroy',$marcacao)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

@endsection