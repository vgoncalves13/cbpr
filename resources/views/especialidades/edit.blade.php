@extends('adminlte::page')
@section('title', 'Editar especialidade')
@section('content')
    <div class="card-header bg-dark">
    <div class="card-body">
    </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3>Editar especialidade</h3>
                    </div>
                    <div class="box-body">
                        <form novalidate action="{{route('especialidades.update',$especialidade)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="box-body">
                                <h3>Informações da especilidades médica</h3>
                                <div class="form-row">
                                    <div class="form-group col-md-4"> <!-- Nome -->
                                        <label for="nome" class="control-label">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nome"
                                               placeholder="Nome"
                                               value="@if(isset($especialidade->nome)){{$especialidade->nome}}@else{{old('nome')}}@endif">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="form-row">
                                    <div class="form-group col-md-12"> <!-- Botão submeter -->
                                        <button type="submit" class="btn btn-primary btn-flat">Atualizar
                                            <i class="fa fa-save"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection