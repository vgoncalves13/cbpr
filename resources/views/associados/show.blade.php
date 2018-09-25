@extends('layouts.master')
@section('title','Exibir usuário')
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@section('content')
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$associado->nome_completo}}</h3>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center">

                            <legend>Status</legend>
                            @if($associado->status == 1)
                                <h2 class="text-light bg-success">Adimplente</h2>
                            @else
                                <h2 class="text-light bg-danger">Inadimplente</h2>
                            @endif
                            <!--
                            <div class="switch-toggle alert alert-dark">
                                <input disabled id="adimplente" name="status" type="radio" @if ($associado->status == 1) checked @endif>
                                <label class="text-light" for="adimplente" onclick="">Adimplente</label>

                                <input disabled id="inadimplente" name="status" type="radio" @if ($associado->status == 0) checked @endif>
                                <label class="text-light" for="inadimplente" onclick="">Inadimplente</label>

                                @if($associado->status == 1)
                                    <a class="btn btn-success"></a>
                                @else
                                    <a class="btn btn-danger"></a>
                                @endif
                            </div>
                            -->
                            @if(isset($associado->foto))
                                <img height="240" width="160" alt="Foto usuário {{$associado->nome_completo}}"
                                     src="{{\Storage::url("$associado->foto")}}" class="img-thumbnail img-responsive">

                                @endif

                        </div>

                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-responsive-md">
                                <tbody>
                                <tr>
                                    <td>Matrícula Antiga:</td>
                                    <td>{{$associado->matricula_antiga}}</td>
                                </tr>
                                <tr>
                                    <td>Matrícula Nova:</td>
                                    <td>{{$associado->matricula_nova}}</td>
                                </tr>
                                <tr>
                                    <td>Admissão:</td>
                                    <td>{{\Carbon\Carbon::parse($associado->admissao)->format('d/m/Y')}}</td>
                                </tr>
                                <tr>
                                    <td>Graduação:</td>
                                    <td>{{$associado->graduacao}}</td>
                                </tr>
                                <tr>
                                    <td>Classe Associado:</td>
                                    <td>{{$associado->classe}}</td>
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
                                    <td>{{$associado->endereco->logradouro}}, {{$associado->endereco->numero}}
                                        - {{$associado->endereco->bairro}} / CEP: {{$associado->endereco->cep}}
                                    </td>
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
                                <td>@if(isset($associado->telefone_casa)){{$associado->telefone_casa}} (Resindencial)
                                    <br><br>@endif
                                    @if(isset($associado->telefone_celular)){{$associado->telefone_celular}} (Móvel)<br>
                                    <br>@endif
                                    @if(isset($associado->telefone_trabalho)){{$associado->telefone_trabalho}}
                                    (Trabalho)<br><br>@endif
                                </td>
                                <tr>
                                    <td>Observações</td>
                                    <td>@if(isset($associado->observacoes)){{$associado->observacoes}}@endif</td>
                                </tr>

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
                                    <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dependentes as $dependente)
                                    <tr>
                                        <td>{{$dependente->nome_dependente}}</td>
                                        <td>{{$dependente->cpf}}</td>
                                        <td>{{$dependente->grau_parentesco}}</td>
                                        <td>{{\Carbon\Carbon::parse($dependente->data_nascimento)->format('d/m/Y')}}</td>
                                        <td><a href="{{route('dependentes.pre_delete',$dependente->id)}}" data-original-title="Excluir" data-toggle="tooltip" type="button"
                                               class="btn btn-danger text-light"><i class="fas fa-trash-alt"></i></a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <a href="{{route('dependente_info_delete.show',$associado->id)}}" type="button">Clique para verificar histórico de dependentes desativados</a>
                        </div>
                    </div>
                </div>
                <script>
                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
                    })
                </script>
                <div class="card-footer">
                    <a data-original-title="Imprimir {EM BREVE}" data-toggle="tooltip" type="button"
                       class="btn btn-primary"><i class="fa fa-print"></i></a>
                    <span class="pull-right">
                        <a href="{{route('pagamentos.show',$associado->id)}}"
                           data-original-title="Verificar histórico pagamento" data-toggle="tooltip" type="button"
                           class="btn btn-success"><i class="fas fa-dollar-sign"></i></a>
                        <a href="{{route('associados.edit',$associado->id)}}"
                           data-original-title="Editar este associado" data-toggle="tooltip" type="button"
                           class="btn btn-warning"><i class="fas fa-user-edit"></i></a>
                        <a data-original-title="Excluir este associado [EM BREVE]" data-toggle="tooltip" type="button"
                           class="btn btn-danger"><i class="fas fa-user-times"></i></a>
                        <a href="{{route('dependentes.pre_create',$associado->id)}}"
                           data-original-title="Adicionar dependentes" data-toggle="tooltip" type="button"
                           class="btn btn-info"><i class="fas fa-user-plus"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection