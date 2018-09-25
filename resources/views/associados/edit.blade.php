@extends('layouts.master')
@section('title', 'Editar associado')
@section('content')

    <div class="card-header bg-dark">
        <h1 class="text-light">Editar Associado</h1>

    <div class="card-body">
        <form novalidate action="{{route('associados.update',$associado->id)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
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
                    $("#cep").inputmask({
                        mask:"99999-999",
                        removeMaskOnSubmit:true
                    });

                    $("input[name*='cpf']").inputmask('999.999.999-99', { removeMaskOnSubmit : true});
                }
            </script>
            <div class="jumbotron">
                <h1>Informações do Associado</h1>
                <div class="form-row">
                    <div class="form-group col-md-4"> <!-- Matrícula Antiga -->
                        <label for="matricula_antiga" class="control-label">Matrícula Antiga</label>
                        <input type="text" class="form-control" id="matricula_antiga" name="matricula_antiga" placeholder="Matrícula Antiga"
                               value="@if(isset($associado->matricula_antiga)){{$associado->matricula_antiga}}@else{{old('matricula_antiga')}}@endif">
                    </div>
                    <div class="form-group col-md-4"> <!-- Matrícula Nova -->
                        <label for="matricula_nova" class="control-label">Matrícula Nova</label>
                        <input type="text" class="form-control" id="matricula_nova" name="matricula_nova" placeholder="Matrícula Nova"
                               value="@if(isset($associado->matricula_nova)){{$associado->matricula_nova}}@else{{old('matricula_nova')}}@endif">
                    </div>
                    <div class="form-group col-md-4"> <!-- CPF -->
                        <label for="cpf" class="control-label">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Apenas números"
                               value="@if(isset($associado->cpf)){{$associado->cpf}}@else{{old('cpf')}}@endif">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8"> <!-- Graduação -->
                        <label for="graduacao" class="control-label">Graduação</label>
                        <input type="text" class="form-control" id="graduacao" name="graduacao" placeholder="Graduação"
                               value="@if(isset($associado->graduacao)){{$associado->graduacao}}@else{{old('graduacao')}}@endif">
                    </div>
                    <div class="form-group col-md-4"> <!-- Admissão -->
                        <label for="admissao" class="control-label">Admissão</label>
                        <input type="text" class="form-control" id="admissao"  name="admissao" placeholder="Apenas números"
                               value="@if(isset($associado->admissao)){{\Carbon\Carbon::parse($associado->admissao)->format('d/m/Y')}}@else{{old('admissao')}}@endif">
                    </div>
                </div>
                <div class="form-row">
                    <label>Categoria</label>
                    <div class="form-group col-md-6">
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
                    <div class="form-group col-md-6">
                        <label>Status</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" value="1" id="adimplente"
                                   @if($associado->status === 1)checked= "checked" @endif>
                            <label class="form-check-label" for="adimplente">
                                Adimplente
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" value="0" id="inadimplente"
                                   @if($associado->status === 0)checked= "checked" @endif>
                            <label class="form-check-label" for="inadimplente">
                                Inadimplente
                            </label>
                        </div>
                    </div>
                </div>
            </div><!-- Fim jumbotron Informações Associado -->
            <div class="jumbotron">
                <h1>Informações Pessoais</h1>
                <div class="form-group"> <!-- Foto -->
                    <label for="Foto" class="control-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" placeholder=""
                           value="@if(isset($associado->foto)){{$associado->foto}}@else{{old('foto')}}@endif">
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
                        <input type="text" class="form-control" id="nome_mae" name="nome_mae" placeholder="Nome da mãe"
                               value="@if(isset($associado->nome_mae)){{$associado->nome_mae}}@else{{old('nome_mae')}}@endif">
                    </div>
                    <div class="form-group col-md-6"> <!-- Nome pai -->
                        <label for="nome_pai" class="control-label">Nome do Pai</label>
                        <input type="text" class="form-control" id="nome_pai" name="nome_pai" placeholder="Nome do pai"
                               value="@if(isset($associado->nome_pai)){{$associado->nome_pai}}@else{{old('nome_pai')}}@endif">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3"> <!-- Naturalidade -->
                        <label for="naturalidade" class="control-label">Naturalidade</label>
                        <input type="text" class="form-control" id="naturalidade" name="naturalidade" placeholder="Naturalidade"
                               value="@if(isset($associado->naturalidade)){{$associado->naturalidade}}@else{{old('naturalidade')}}@endif">
                    </div>
                    <?php $options = ['SOLTEIRO(A)','CASADO(A)','DIVORCIADO(A)','VIÚVO(A)','SEPARADO(A)'] ?>
                    <div class="form-group col-md-3"> <!-- Estado Civil -->
                        <label for="estado_civil" class="control-label">Estado civil</label>
                        <select class="form-control" id="estado_civil" name="estado_civil">
                                <option value="">Selecione...</option>
                            @foreach ($options as $key => $value)
                                <option value="{{ $value }}"
                                        @if ($key == old('estado_civil', $associado->estado_civil))
                                        selected="selected"
                                        @endif
                                >{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3"> <!-- Data Nascimento -->
                        <label for="data_nascimento" class="control-label">Data Nascimento</label>
                        <input type="text" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="Apenas números"
                               value="@if(isset($associado->data_nascimento)){{\Carbon\Carbon::parse($associado->data_nascimento)->format('d/m/Y')}}@else{{old('data_nascimento')}}@endif">
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
            </div><!-- Fim jumbotron Informações Pessoais -->
            <div class="jumbotron">
                <h1>Informações Endereço</h1>
                <div class="form-row">
                    <div class="form-group col-md-4"> <!-- Logradouro-->
                        <label for="logradouro" class="control-label">Logradouro</label>
                        <input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Logradouro"
                               value="@if(isset($associado->endereco->logradouro)){{$associado->endereco->logradouro}}@else{{old('logradouro')}}@endif">
                    </div>
                    <div class="form-group col-md-4"> <!-- Número-->
                        <label for="numero" class="control-label">Número</label>
                        <input type="text" class="form-control" id="numero" name="numero" placeholder="Nº"
                               value="@if(isset($associado->endereco->numero)){{$associado->endereco->numero}}@else{{old('numero')}}@endif">
                    </div>
                    <div class="form-group col-md-4"> <!-- Complemento-->
                        <label for="complemento" class="control-label">Complemento</label>
                        <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento Ex: AP 704, Fundos, Casa 02"
                               value="@if(isset($associado->endereco->complemento)){{$associado->endereco->complemento}}@else{{old('complemento')}}@endif">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8"> <!-- Bairro-->
                        <label for="bairro" class="control-label">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro"
                               value="@if(isset($associado->endereco->bairro)){{$associado->endereco->bairro}}@else{{old('bairro')}}@endif">
                    </div>
                    <div class="form-group col-md-4"> <!-- CEP-->
                        <label for="cep" class="control-label">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP"
                               value="@if(isset($associado->endereco->cep)){{$associado->endereco->cep}}@else{{old('cep')}}@endif">
                    </div>
                </div>
            </div><!-- Fim jumbotron Informações Endereço -->
            <div class="form-row">
                <div class="form-group col-md-12"> <!-- Observação-->
                    <label for="observacoes" class="text-light control-label">Observações</label>
                    <textarea class="form-control" id="observacoes" rows="5"  name="observacoes">@if(isset($associado->observacoes)){{$associado->observacoes}}@else{{old('observacoes')}}@endif</textarea>
                </div>
            </div>
            <div class="form-group"> <!-- Botão submeter -->
                <button type="submit" class="btn btn-primary">Atualizar <i class="fa fa-save"></i></button>
            </div>
        </form>
    </div>
@endsection