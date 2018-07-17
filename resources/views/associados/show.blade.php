@extends('layouts.master')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >


            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$associado->nome_completo}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="" src="{{\Storage::url("$associado->foto")}}" class="img-thumbnail img-responsive"> </div>

                        <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                          <dl>
                            <dt>DEPARTMENT:</dt>
                            <dd>Administrator</dd>
                            <dt>HIRE DATE</dt>
                            <dd>11/12/2013</dd>
                            <dt>DATE OF BIRTH</dt>
                               <dd>11/12/2013</dd>
                            <dt>GENDER</dt>
                            <dd>Male</dd>
                          </dl>
                        </div>-->
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Matrícula:</td>
                                    <td>{{$associado->matricula}}</td>
                                </tr>
                                <tr>
                                    <td>Admissão:</td>
                                    <td>{{\Carbon\Carbon::parse($associado->admissao)->format('d/m/Y')}}</td>
                                </tr>
                                <tr>
                                    <td>Data de nascimento</td>
                                    <td>{{\Carbon\Carbon::parse($associado->data_nascimento)->format('d/m/Y')}}</td>
                                </tr>

                                <tr>
                                <tr>
                                    <td>Nome da mãe:</td>
                                    <td>{{$associado->nome_mae}}</td>
                                </tr>
                                <tr>
                                    <td>Nome do pai:</td>
                                    <td>{{$associado->nome_pai}}</td>
                                </tr>
                                <tr>
                                    <td>Endereço:</td>
                                    <td>{{$associado->endereco->logradouro}},{{$associado->endereco->bairro}}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><a href="mailto:{{$associado->email}}">{{$associado->email}}</a></td>
                                </tr>
                                <tr>
                                    <td>Naturalidade:</td>
                                    <td>{{$associado->naturalidade}}</td>
                                </tr>
                                <tr>
                                    <td>Estado Civil:</td>
                                    <td>{{$associado->estado_civil}}</td>
                                </tr>
                                <tr>
                                    <td>CPF:</td>
                                    <td>{{$associado->cpf}}</td>
                                </tr>
                                <td>Telefones</td>
                                <td>@if(isset($associado->telefone_casa)){{$associado->telefone_casa}}(Resindencial)<br><br>@endif
                                    @if(isset($associado->telefone_celular)){{$associado->telefone_celular}}(Móvel)<br><br>@endif
                                    @if(isset($associado->telefone_trabalho)){{$associado->telefone_trabalho}}(Trabalho)<br><br>@endif
                                </td>


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a data-original-title="Imprimir" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-print"></i></a>
                    <span class="pull-right">
                            <a href="#" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                </div>

            </div>
        </div>
    </div>
</div>