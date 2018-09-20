@extends('layouts.master')
@section('title','Deletar dependente')
@section('content')
    <form novalidate action="{{route('dependentes_info.excluir',$dependente->id)}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" value="{{$dependente->id}}" name="dependente_id">
        <div class="form-row"> <!-- Motivo -->
            <div class="form-group col-md-3"><!-- Data -->
                <label for="data_solicitacao" class="control-label">Data da solicitação</label>
                <input type="date" class="form-control" id="data_solicitacao" name="data_solicitacao">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2"> <!--Documento Comprovante-->
                <label for="documento" class="control-label">Documento Comprovante</label>
                <input type="file" name="documento_comprovante" id="documento_comprovante">
            </div>
        </div>
        <div class="form-row">
            {{--Campo de observações--}}
            <div class="form-group col-md-5">
                <label for="observacao" class="control-label">Observação</label>
                <textarea type="text" class="form-control" id="observacao" name="observacao" placeholder="Observação"></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group"> <!-- Botão submeter -->
                <button type="submit" class="btn btn-primary">Adicionar</button>
            </div>
        </div>
    </form>
@endsection