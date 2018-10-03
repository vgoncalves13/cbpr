@extends('adminlte::page')
@section('title','Deletar dependente')
@section('content')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informações para deletar dependente</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form novalidate action="{{route('dependentes_info.excluir',$dependente->id)}}" method="POST"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                            <input type="hidden" value="{{$dependente->id}}" name="dependente_id">
                            <div class="form-group"> <!-- Motivo -->
                                <label for="data_solicitacao" class="">Data da solicitação</label>
                                <input type="date" class="form-control" id="data_solicitacao" name="data_solicitacao">
                            </div>
                            <div class="form-group">

                                <label for="documento" class="">Documento Comprovante</label>
                                <input type="file" name="documento_comprovante" id="documento_comprovante">

                            </div>
                            <div class="form-group">
                                {{--Campo de observações--}}

                                <label for="observacao" class="">Observação</label>
                                <textarea type="text" class="form-control" id="observacao" name="observacao"
                                          placeholder="Observação"></textarea>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary btn-flat">Enviar</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
                <!-- /.box -->







@endsection