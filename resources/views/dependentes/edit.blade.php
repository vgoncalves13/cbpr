@extends('layouts.master')
@section('content')
    <form method="POST" novalidate action="{{route('dependentes.update',$dependente->id)}}"  >
        {{csrf_field()}}
        <input type="hidden" value="{{$dependente->id}}" name="dependente_id">
        <input type="hidden" name="_method" value="PUT">
            <div class="form-row"> <!-- Nome dependente -->
                <div class="form-group col-md-5"> <!-- Dependentes campos com valores do banco, caso precise alterar -->
                    <label for="nome_dependente" class="control-label">Nome Dependente</label>
                    <input type="text" class="form-control" id="nome_dependente" name="nome_dependente"
                    value="@if(isset($dependente->nome_dependente)){{$dependente->nome_dependente}}@else{{old('nome_dependente')}}@endif">
                </div>
                <div class="form-group col-md-3"><!-- CPF -->
                    <label for="cpf" class="control-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf"
                           value="@if(isset($dependente->cpf)){{$dependente->cpf}}@else{{old('cpf')}}@endif">
                </div>
                <div class="form-group col-md-2"> <!-- Grau parentesco -->
                    <label for="grau_parentesco" class="control-label">Grau Parentesco</label>

                    <select class="form-control" id="grau_parentesco" name="grau_parentesco">
                        <option value="">Selecione...</option>
                        <option value="MÃE"  @if($dependente->grau_parentesco=='MÃE') selected='selected' @endif >MÃE</option>
                        <option value="PAI"  @if($dependente->grau_parentesco=='PAI') selected='selected' @endif >PAI</option>
                        <option value="ESPOSA(O)"  @if($dependente->grau_parentesco=='ESPOSA(O)') selected='selected' @endif >ESPOSA(O)</option>
                        <option value="FILHO(A)"  @if($dependente->grau_parentesco=='FILHO(A)') selected='selected' @endif >FILHO(A)</option>
                        <option value="COMPANHEIRO(A)"  @if($dependente->grau_parentesco=='COMPANHEIRO(A)') selected='selected' @endif >COMPANHEIRO(A)</option>
                    </select>
                </div><!-- Data nascimento -->
                <div class="form-group col-md-2">
                    <label for="data_nascimento" class="control-label">Data de nascimento</label>
                    <input type="text" class="form-control" id="data_nascimento" name="data_nascimento"
                           value="@if(isset($dependente->data_nascimento)){{\Carbon\Carbon::parse($dependente->data_nascimento)->format('d/m/Y')}}@else{{old('data_nascimento')}}@endif">
                </div>
            </div>
        <div class="form-group"> <!-- Botão submeter -->
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a class="btn btn-secondary" href="/associados/{{$dependente->associado->id}}">Voltar para associado</a>
        </div>
    </form>
    <script type="text/javascript">
        window.onload = function() {

            $("input[name*='cpf']").inputmask('999.999.999-99', { removeMaskOnSubmit : true});
            $("input[name*='nascimento']").inputmask("datetime", { "inputFormat": "dd/mm/yyyy" });
        }
    </script>
@endsection
