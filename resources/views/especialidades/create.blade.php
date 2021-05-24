@extends('adminlte::page')
@section('title', 'Cadastrar nova especialidade médica')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3>Cadastrar novo médico</h3>
                </div>
                <div class="box-body">
                    <form novalidate action="{{route('especialidades.store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
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