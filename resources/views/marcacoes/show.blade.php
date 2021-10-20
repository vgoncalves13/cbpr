@extends('adminlte::page')
@section('title','Detalhes marcação')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h2>Consulta paciente: {{$marcacao->pacienteable->nome_completo}}</h2>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="box-body table-responsive">
                            @if(session()->has('associado_id'))
                                <div class="col-12">
                                    <form class="form-inline" novalidate action="{{route('associados.update_cellphone',session()->get('associado_id'))}}" method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="form-group"> <!-- Celular-->
                                            <label for="telefone_celular" class="control-label">Celular</label>
                                            <input type="text" class="form-control" id="telefone_celular" name="telefone_celular" placeholder="Telefone Celular"
                                                   value="@if(session()->has('telefone_celular')){{session()->get('telefone_celular')}}@else{{old('telefone_celular')}}@endif">
                                        </div>
                                        <div class="form-group"> <!-- Botão atualizar -->
                                            <button type="submit" class="btn btn-primary btn-flat">Atualizar <i class="fa fa-save"></i></button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Data da consulta:</td>
                                    <td>{{$marcacao->dia_consulta}} {{$marcacao->hora_consulta}}</td>
                                </tr>
                                <tr>
                                    <td>Médico:</td>
                                    <td>{{$marcacao->medico->nome}}</td>
                                </tr>
                                <tr>
                                    <td>Especialidade:</td>
                                    <td>{{$marcacao->especialidade->nome}}</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="pull-right">
                        <form novalidate action="{{route('marcacao.download_pdf',1)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="marcacao_id" value="{{$marcacao->id}}">
                            <button class="btn btn-flat btn-primary" type="submit"><i class="fas fa-file-pdf"></i> Download PDF</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection