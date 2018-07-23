@extends('layouts.master')
@section('title','Exibir usuário')
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
@section('content')


<div class="row ">

    <div class="col-md-12" >


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$associado->nome_completo}}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-lg-3 " align="center"> <img height="240" width="160" alt="Foto usuário {{$associado->nome_completo}}" src="{{\Storage::url("$associado->foto")}}" class="img-thumbnail img-responsive"> </div>

                    <div class=" col-md-9 col-lg-9 ">
                        <table class="table table-responsive-md">
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
                            <td>@if(isset($associado->telefone_casa)){{$associado->telefone_casa}} (Resindencial)<br><br>@endif
                                @if(isset($associado->telefone_celular)){{$associado->telefone_celular}} (Móvel)<br><br>@endif
                                @if(isset($associado->telefone_trabalho)){{$associado->telefone_trabalho}} (Trabalho)<br><br>@endif
                            </td>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="card-header">
                <h4 class="card-title">Dependentes</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class=" col-md-12">
                        <table class="table table-responsive-md table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th>Nome do dependente</th>
                                <th>CPF</th>
                                <th>Grau parentesco</th>
                                <th>Data nascimento</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($associado->dependente as $dependente)
                            <tr>
                                <td>{{$dependente->nome_dependente}}</td>
                                <td>{{$dependente->cpf}}</td>
                                <td>{{$dependente->grau_parentesco}}</td>
                                <td>{{\Carbon\Carbon::parse($dependente->data_nascimento)->format('d/m/Y')}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <script>
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            </script>
            <div class="card-footer">
                <a data-original-title="Imprimir {EM BREVE}" data-toggle="tooltip" type="button" class="btn btn-primary"><i class="fa fa-print"></i></a>
                <span class="pull-right">
                    <a href="#" data-original-title="Editar este associado [EM BREVE]" data-toggle="tooltip" type="button" class="btn btn-warning"><i class="fas fa-user-edit"></i></a>
                    <a data-original-title="Excluir este associado [EM BREVE]" data-toggle="tooltip" type="button" class="btn btn-danger"><i class="fas fa-user-times"></i></a>
                    <a href="{{route('dependentes.create',$associado->id)}}" data-original-title="Adicionar dependentes" data-toggle="tooltip" type="button" class="btn btn-info"><i class="fas fa-user-plus"></i></a>
                </span>
            </div>

        </div>
    </div>
</div>
@endsection