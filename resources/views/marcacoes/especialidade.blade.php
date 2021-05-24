@extends('adminlte::page')
@section('title', 'Cadastrar nova consulta')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3>Cadastrar nova consulta</h3>
            </div>
            <div class="box-body">
                <form novalidate action="{{route('marcacao.paciente')}}" method="GET" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-row">
                            <div class="form-group col-md-12"> <!-- Paciente -->
                                <label class="control-label">Escolha o paciente</label>
                                <div class="form-group">
                                    <select class="form-control" name="paciente_id">
                                        <option value="">Selecione um paciente...</option>
                                        <option value="associado.{{Auth::id()}}">
                                            {{Auth::user()->associado->nome_completo}} (Titular)
                                        </option>
                                        <optgroup label="Dependentes">
                                        @foreach($dependentes as $dependente)
                                            <option value="dependente.{{$dependente->id}}">{{$dependente->nome_completo}}</option>
                                        @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12"> <!-- Especialidade -->
                                <label class="control-label">Escolha a especialidade</label>
                                    <div class="form-group">
                                        <select class="form-control" name="especialidade_id">
                                            <option value="">Selecione uma especialidade...</option>
                                            @foreach($especialidades as $especialidade)
                                                <option value="{{$especialidade->id}}">{{$especialidade->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="form-row">
                            <div class="form-group col-md-12"> <!-- Botão submeter -->
                                <button type="submit" class="btn btn-primary btn-flat">Avançar
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