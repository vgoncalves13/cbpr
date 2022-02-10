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


        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class=""><a href="#tab_1" data-toggle="tab" aria-expanded="false">Consultas passadas</a></li>
                <li class="active"><a href="#tab_2" data-toggle="tab" aria-expanded="true">Consultas futuras</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="tab_1">
                    <div class="box-body table-responsive">
                        <table class="data-table table table-bordered" id="data-table">
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
                            @foreach($marcacoes_passadas as $marcacao)
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
                    </div>
                </div>

                <div class="tab-pane active" id="tab_2">
                    <div class="box-body table-responsive">
                        <table class="data-table table table-bordered">
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
                            @foreach($marcacoes_futuras as $marcacao)
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
                    </div>
                </div>

            </div>

        </div>





@endsection
@section('js')
    <script>
        $('.data-table').dataTable();
    </script>
@endsection