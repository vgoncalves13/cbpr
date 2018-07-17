@extends('layouts.master')
@if (Session::has('message'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(    Route::currentRouteName()==='associados.create')
@section('title', 'Cadastrar novo associado')
@else
@section('title', 'Editando usuário')
@endif
@section('content')
        <form novalidate action="
                    @if(    Route::currentRouteName()==='associados.create'){{route('associados.store')}}
                    @elseif(Route::currentRouteName()==='associados.edit'){{route('associados.update',$associado->id)}}
                    @endif"
              method="POST"
              enctype="multipart/form-data">
            {{csrf_field()}}


            <script type="text/javascript">
                window.onload = function() {

                    $("#cpf").inputmask({
                        mask: "999.999.999-99",
                        removeMaskOnSubmit: true
                    });  // cpf"

                    $("#data_nascimento").inputmask("datetime", { "inputFormat": "dd/mm/yyyy" });
                    $("#admissao").inputmask("datetime", { "inputFormat": "dd/mm/yyyy" });

                    $("#telefone_casa").inputmask({
                        mask:"(99)9999-9999",
                        removeMaskOnSubmit:true});  //telefone casa
                    $("#telefone_trabalho").inputmask({
                        mask:"(99)9999-9999",
                        removeMaskOnSubmit:true});  //telefone trabalho
                    $("#telefone_celular").inputmask({
                        mask:"(99)9999[9]-9999",
                        removeMaskOnSubmit:true
                    });

                    $('#dependente_cpf').inputmask('999.999.999-99', { removeMaskOnSubmit : true});

                }
            </script>


            @if(isset($associado->id))<input name="_method" type="hidden" value="PUT">@endif
            <div class="form-group"> <!-- Matrícula -->
                <label for="matricula" class="control-label">Matrícula/Registro</label>
                <input type="text" class="form-control" id="matricula" name="matricula" placeholder=""
                       value="@if(isset($associado->matricula)){{$associado->matricula}}@else{{old('matricula')}}@endif">
            </div>
            <div class="form-group"> <!-- Foto -->
                <label for="Foto" class="control-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" placeholder=""
                       value="@if(isset($associado->foto)){{$associado->foto}}@else{{old('foto')}}@endif">
            </div>
            <div class="form-row">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="classe" value="PMERJ" id="pmerj"
                    @if(isset($associado->classe) && $associado->classe === 'PMERJ')checked="checked" @endif>
                    <label class="form-check-label" for="pmerj">
                        PMERJ
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="classe" value="CBMERJ" id="cbmerj"
                           @if(isset($associado->classe) && $associado->classe === 'CBMERJ')checked="checked" @endif>
                    <label class="form-check-label" for="cbmerj">
                        CBMERJ
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="classe" value="PENSIONISTA" id="pensionista"
                           @if(isset($associado->classe) && $associado->classe === 'PENSIONISTA' || is_array(old('classe')) && in_array('PENSIONISTA',old('classe')))checked="checked" @endif>
                    <label class="form-check-label" for="pensionista">
                        PENSIONISTA
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="classe" value="CIVIL" id="socio"
                           @if(isset($associado->classe) && $associado->classe === 'CIVIL')checked= "checked" @endif>
                    <label class="form-check-label" for="socio">
                        SÓCIO CIVIL
                    </label>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-8"> <!-- Graduação -->
                    <label for="graduacao" class="control-label">Graduação</label>
                    <input type="text" class="form-control" id="graduacao" name="graduacao" placeholder=""
                           value="@if(isset($associado->graduacao)){{$associado->graduacao}}@else{{old('graduacao')}}@endif">
                </div>
                <div class="form-group col-md-4"> <!-- Admissão -->
                    <label for="admissao" class="control-label">Admissão</label>
                    <input type="text" class="form-control" id="admissao"  name="admissao" placeholder="Apenas números"
                           value="@if(isset($associado->admissao)){{/*\Carbon\Carbon::parse($associado->admissao)->format('d/m/Y')*/$associado->admissao}}@else{{old('admissao')}}@endif">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-8"> <!-- Nome Completo -->
                    <label for="nome_completo" class="control-label">Nome completo</label>
                    <input type="text" class="form-control" id="nome_completo_id" name="nome_completo" placeholder="Nome Completo"
                           value="@if(isset($associado->nome_completo)){{$associado->nome_completo}}@else{{old('nome_completo')}}@endif">
                </div>
                <div class="form-group col-md-4"> <!-- E-mail -->
                    <label for="email" class="control-label">E-mail</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="E-mail"
                           value="@if(isset($associado->email)){{$associado->email}}@else{{old('email')}}@endif">
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-6"> <!-- Nome mãe -->
                    <label for="nome_mae" class="control-label">Nome da Mãe</label>
                    <input type="text" class="form-control" id="nome_mae" name="nome_mae" placeholder=""
                           value="@if(isset($associado->nome_mae)){{$associado->nome_mae}}@else{{old('nome_mae')}}@endif">
                </div>
                <div class="form-group col-md-6"> <!-- Nome pai -->
                    <label for="nome_pai" class="control-label">Nome do Pai</label>
                    <input type="text" class="form-control" id="nome_pai" name="nome_pai" placeholder=""
                           value="@if(isset($associado->nome_pai)){{$associado->nome_pai}}@else{{old('nome_pai')}}@endif">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3"> <!-- Naturalidade -->
                    <label for="naturalidade" class="control-label">Naturalidade</label>
                    <input type="text" class="form-control" id="naturalidade" name="naturalidade" placeholder="Naturalidade"
                           value="@if(isset($associado->naturalidade)){{$associado->naturalidade}}@else{{old('naturalidade')}}@endif">
                </div>
                <div class="form-group col-md-3"> <!-- Estado Civil -->
                    <label for="estado_civil" class="control-label">Estado civil</label>
                    <select class="form-control" id="estado_civil" name="estado_civil">
                        <option value="" selected     @if(isset($associado->estado_civil) && $associado->estado_civil==='') selected='selected'@endif>Selecione..</option>
                        <option value="Solteiro(a)"   @if(isset($associado->estado_civil) && $associado->estado_civil==='Solteiro(a)') selected='selected'@endif>Solteiro(a)</option>
                        <option value="Casado(a)"     @if(isset($associado->estado_civil) && $associado->estado_civil==='Casado(a)') selected='selected'@endif>Casado(a)</option>
                        <option value="Divorciado(a)" @if(isset($associado->estado_civil) && $associado->estado_civil==='Divorciado(a)') selected='selected'@endif>Divorciado(a)</option>
                        <option value="Viúvo(a)"      @if(isset($associado->estado_civil) && $associado->estado_civil==='Viúvo(a)') selected='selected'@endif>Viúvo(a)</option>
                        <option value="Separado(a)"   @if(isset($associado->estado_civil) && $associado->estado_civil==='Separado(a)') selected='selected'@endif>Separado(a)</option>
                    </select>
                </div>
                <div class="form-group col-md-3"> <!-- Data Nascimento -->
                    <label for="data_nascimento" class="control-label">Data Nascimento</label>
                    <input type="text" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="Apenas números"
                           value="@if(isset($associado->data_nascimento)){{$associado->data_nascimento}}@else{{old('data_nascimento')}}@endif">
                </div>
                <div class="form-group col-md-3"> <!-- CPF -->
                    <label for="cpf" class="control-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Apenas números"
                           value="@if(isset($associado->cpf)){{$associado->cpf}}@else{{old('cpf')}}@endif">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4"> <!-- Telefone Trabalho-->
                    <label for="telefone_trabalho" class="control-label">Telefone Trabalho</label>
                    <input type="text" class="form-control" id="telefone_trabalho" name="telefone_trabalho" placeholder="Telefone Trabalho"
                           value="@if(isset($associado->telefone_trabalho)){{$associado->telefone_trabalho}}@else{{old('telefone_trabalho')}}@endif">
                </div>
                <div class="form-group col-md-4"> <!-- Telefone Casa-->
                    <label for="telefone_casa" class="control-label">Telefone Casa</label>
                    <input type="text" class="form-control" id="telefone_casa" name="telefone_casa" placeholder="Telefone Casa"
                           value="@if(isset($associado->telefone_casa)){{$associado->telefone_casa}}@else{{old('telefone_casa')}}@endif">
                </div>
                <div class="form-group col-md-4"> <!-- Celular-->
                    <label for="telefone_celular" class="control-label">Celular</label>
                    <input type="text" class="form-control" id="telefone_celular" name="telefone_celular" placeholder="Telefone Celular"
                           value="@if(isset($associado->telefone_celular)){{$associado->telefone_celular}}@else{{old('telefone_celular')}}@endif">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4"> <!-- Logradouro-->
                    <label for="logradouro" class="control-label">Logradouro</label>
                    <input type="text" class="form-control" id="logradouro" name="logradouro" placeholder=""
                           value="@if(isset($associado->endereco->logradouro)){{$associado->endereco->logradouro}}@else{{old('logradouro')}}@endif">
                </div>
                <div class="form-group col-md-4"> <!-- Número-->
                    <label for="numero" class="control-label">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero" placeholder=""
                           value="@if(isset($associado->endereco->numero)){{$associado->endereco->numero}}@else{{old('numero')}}@endif">
                </div>
                <div class="form-group col-md-4"> <!-- Complemento-->
                    <label for="complemento" class="control-label">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complemento" placeholder=""
                           value="@if(isset($associado->endereco->complemento)){{$associado->endereco->complemento}}@else{{old('complemento')}}@endif">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8"> <!-- Bairro-->
                    <label for="bairro" class="control-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" placeholder=""
                           value="@if(isset($associado->endereco->bairro)){{$associado->endereco->bairro}}@else{{old('bairro')}}@endif">
                </div>
                <div class="form-group col-md-4"> <!-- CEP-->
                    <label for="cep" class="control-label">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" placeholder=""
                           value="@if(isset($associado->endereco->cep)){{$associado->endereco->cep}}@else{{old('cep')}}@endif">
                </div>
            </div>

            <div class="form-row"> <!-- Dependentes -->
            @if(isset($associado) && Route::currentRouteName()==='associados.edit')

                @foreach($associado->dependente as $dependente)
                <div class="form-group col-md-5"> <!-- Dependentes campos com valores do banco, caso precise alterar -->
                    <label for="dependente_nome" class="control-label">Nome Dependente</label>
                    <input type="text" class="form-control" id="dependente_nome" name="dependentes[nome_dependente][]"
                           value="@if(isset($dependente)){{$dependente->nome_dependente}}@else{{old('dependentes.nome_dependente')}}@endif">
                </div>
                <div class="form-group col-md-3">
                    <label for="dependente_cpf" class="control-label">CPF</label>
                    <input type="text" class="form-control" id="dependente_cpf" name="dependentes[cpf][]"
                           value="@if(isset($dependente)){{$dependente->cpf}}@else{{old('dependentes.cpf')}}@endif">
                </div>

                <div class="form-group col-md-2">
                    <label for="dependente_parentesco" class="control-label">Grau parentesco</label>
                    <input type="text" class="form-control" id="dependente_parentesco" name="dependentes[grau_parentesco][]"
                           value="@if(isset($dependente)){{$dependente->grau_parentesco}}@else{{old('dependentes.grau_parentesco')}}@endif">
                </div>
                <div class="form-group col-md-2">
                    <label for="dependente_nascimento" class="control-label">Data de nascimento</label>
                    <input type="text" class="form-control" id="dependente_nascimento" name="dependentes[data_nascimento][]"
                           value="@if(isset($dependente)){{\Carbon\Carbon::parse($dependente->data_nascimento)->format('d/m/Y')}}@else{{old('dependentes.data_nascimento')}}@endif">
                </div>

                @endforeach
                @for($i = 0; $i <= (9 - count($associado->dependente));$i++)
                    <div class="form-group col-md-5"><!-- Campos vazios para serem editados -->
                        <label for="dependente_nome" class="control-label">Nome Dependente</label>
                        <input type="text" class="form-control" id="dependente_nome" name="dependentes[nome_dependente][]">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="dependente_cpf" class="control-label">CPF</label>
                        <input type="text" class="form-control" id="dependente_cpf" name="dependentes[cpf][]">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="dependente_parentesco" class="control-label">Grau parentesco</label>
                        <input type="text" class="form-control" id="dependente_parentesco" name="dependentes[grau_parentesco][]">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="dependente_nascimento" class="control-label">Data de nascimento</label>
                        <input type="text" class="form-control" id="dependente_nascimento" name="dependentes[data_nascimento][]">
                    </div>
                @endfor
                @else
                    @for($i=0;$i<=9;$i++)
                        <div class="form-group col-md-5"><!-- Dependentes 2 -->
                            <label for="dependente_nome" class="control-label">Nome Dependente</label>
                            <input type="text" class="form-control" id="dependente_nome" name="dependentes[nome_dependente][]">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="dependente_cpf" class="control-label">CPF</label>
                            <input type="text" class="form-control" id="dependente_cpf" name="dependentes[cpf][]">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="dependente_parentesco" class="control-label">Grau parentesco</label>
                            <input type="text" class="form-control" id="dependente_parentesco" name="dependentes[grau_parentesco][]">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="dependente_nascimento" class="control-label">Data de nascimento</label>
                            <input type="text" class="form-control" id="dependente_nascimento" name="dependentes[data_nascimento][]">
                        </div>
                    @endfor
                @endif
            </div>
            <div class="form-row">
                <div class="form-group col-md-12"> <!-- Observação-->
                    <label for="observacoes" class="control-label">Observações</label>
                    <textarea class="form-control" id="observacoes" rows="5" name="observacoes"></textarea>
                </div>
            </div>
            @if(Route::currentRouteName()==='associados.create')
                <div class="form-group"> <!-- Botão submeter -->
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            @else(Route::currentRouteName()==='associados.edit')
                <div class="form-group"> <!-- Botão atualizar -->
                    <button type="submit" class="btn btn-secondary">Atualizar</button>
                </div>
            @endif
        </form>

@endsection