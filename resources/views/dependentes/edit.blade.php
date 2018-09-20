@extends('layouts.master')
@section('content')
    <form novalidate action="{{route('dependentes.update',$associado_id)}}" method="POST" >
        {{csrf_field()}}
        <input type="hidden" value="{{$associado_id}}" name="associado_id">
        <div class="form-row"> <!-- Nome dependente -->
            <div class="form-group col-md-5"> <!-- Dependentes campos com valores do banco, caso precise alterar -->
                <label for="dependente_nome" class="control-label">Nome Dependente</label>
                <input type="text" class="form-control" id="dependente_nome" name="dependentes[nome_dependente][]">
            </div>
            <div class="form-group col-md-3"><!-- CPF -->
                <label for="dependente_cpf" class="control-label">CPF</label>
                <input type="text" class="form-control" id="dependente_cpf" name="dependentes[cpf][]">
            </div>
            <div class="form-group col-md-2"> <!-- Grau parentesco -->
                <label for="dependente_parentesco" class="control-label">Grau Parentesco</label>
                <select class="form-control" id="dependente_parentesco" name="dependentes[grau_parentesco][]">
                    <option value="" selected>Selecione..</option>
                    <option value="Mãe">Mãe</option>
                    <option value="Pai">Pai</option>
                    <option value="Esposa(o)">Esposa(o)</option>
                    <option value="Filho(a)">Filho(a)</option>
                </select>
            </div><!-- Data nascimento -->
            <div class="form-group col-md-2">
                <label for="dependente_nascimento" class="control-label">Data de nascimento</label>
                <input type="text" class="form-control" id="dependente_nascimento" name="dependentes[data_nascimento][]">
            </div>


            <div class="form-group"> <!-- Botão submeter -->
                <button type="submit" class="btn btn-primary">Adicionar</button>
            </div>
        </div>
    </form>
    <script type="text/javascript">
        window.onload = function() {

            $("input[name*='cpf']").inputmask('999.999.999-99', { removeMaskOnSubmit : true});
            $("input[name*='nascimento']").inputmask("datetime", { "inputFormat": "dd/mm/yyyy" });
        }
    </script>
@endsection
