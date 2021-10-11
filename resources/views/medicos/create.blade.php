@extends('adminlte::page')
@section('title', 'Cadastrar novo médico')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3>Cadastrar novo médico</h3>
                </div>
                <div class="box-body">
                    <form novalidate action="{{route('medicos.store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                            <h3>Informações do médico</h3>
                            <div class="form-row">
                                <div class="form-group col-md-4"> <!-- Nome -->
                                    <label for="nome" class="control-label">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome"
                                           placeholder="Nome"
                                           value="@if(isset($medico->nome)){{$medico->nome}}@else{{old('nome')}}@endif">
                                </div>
                                <div class="form-group col-md-4"> <!-- CRM -->
                                    <label for="crm" class="control-label">CRM</label>
                                    <input type="text" class="form-control" id="crm" name="crm"
                                           placeholder="CRM"
                                           value="@if(isset($medico->crm)){{$medico->crm}}@else{{old('crm')}}@endif">
                                </div>
                                <div class="form-group col-md-12"> <!-- Especialidade -->
                                    <label class="control-label">Especialidades</label>
                                    @foreach($especialidades as $especialidade)
                                        <div class="form-check">
                                            <input name="especialidades[]" class="form-check-input" type="checkbox" value="{{$especialidade->id}}"
                                                   id="{{$especialidade->nome}}" >
                                            <label class="form-check-label" for="{{$especialidade->nome}}">
                                                {{$especialidade->nome}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="form-row">
                                <div class="form-group col-md-12"> <!-- Botão submeter -->
                                    <button type="submit" class="btn btn-primary btn-flat">Cadastrar
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
    <script type="text/javascript">
        window.onload = function () {

            $("#cpf").inputmask({
                mask: "999.999.999-99",
                removeMaskOnSubmit: true
            });  // cpf"

            $("#data_nascimento").inputmask("datetime", {"inputFormat": "dd/mm/yyyy"});
            $("#admissao").inputmask("datetime", {"inputFormat": "dd/mm/yyyy"});

            $("#telefone_casa").inputmask({
                mask: "(99)9999-9999",
                removeMaskOnSubmit: true
            });  //telefone casa
            $("#telefone_trabalho").inputmask({
                mask: "(99)9999-9999",
                removeMaskOnSubmit: true
            });  //telefone trabalho
            $("#telefone_celular").inputmask({
                mask: "(99)9999[9]-9999",
                removeMaskOnSubmit: true
            });
            $("#cep").inputmask({
                mask: "99999-999",
                removeMaskOnSubmit: true
            });

            $("input[name*='cpf']").inputmask('999.999.999-99', {removeMaskOnSubmit: true});
        }
    </script>


@endsection