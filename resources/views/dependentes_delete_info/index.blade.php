@extends('adminlte::page')
@section('titulo','Dependentes Deletados')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3>Lista de dependentes desativados</h3>
                </div>
                <div class="box-body">
                    <table class="table table-responsive-md table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <th>Nome do dependente</th>
                            <th>Data da exclusão</th>
                            <th>Observação</th>
                            <th>Documento</th>
                            <!--<th>Ver mais</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dependentes as $dependente)
                            <tr>
                                <td>{{$dependente->nome_dependente}}</td>
                                <td>{{\Carbon\Carbon::parse($dependente->dependente_delete_info->data_solicitacao)->format('d/m/Y')}}</td>
                                <td>{{$dependente->dependente_delete_info->observacao}}</td>
                                <td><a target="_blank" href="{{\Storage::url($dependente->dependente_delete_info->documento_comprovante)}}">
                                        Download <i class="fa fa-download"></i></a></td>
                            <!--<td><a href="{{route('dependentes.pre_delete',$dependente->id)}}" data-original-title="Ver mais" data-toggle="tooltip" type="button"
                                   class="btn btn-danger text-light"><i class="fas fa-trash-alt"></i></a>

                            </td>-->
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>











@endsection