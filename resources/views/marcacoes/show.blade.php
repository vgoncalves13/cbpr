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