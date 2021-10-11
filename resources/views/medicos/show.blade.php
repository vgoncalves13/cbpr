@extends('adminlte::page')
@section('title','Exibir usuário')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3>{{$associado->nome_completo}}
                        @if($associado->status == 1)
                            <span class="label label-success">Adimplente</span>
                        @else
                            <span class="label label-danger">Inadimplente</span>
                        @endif

                    </h3>
                    <h6 align="right">Cadastrado em: {{\Carbon\Carbon::parse($associado->created_at)->format('d/m/Y - H:m')}}</h6>
                    <h6 align="right">Última atualização em: {{\Carbon\Carbon::parse($associado->updated_at)->format('d/m/Y - H:m')}}</h6>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center">
                            @if(isset($associado->foto))
                                <img height="240" width="160" alt="Foto usuário {{$associado->nome_completo}}"
                                     src="{{\Storage::url("$associado->foto")}}" class="img-thumbnail img-responsive">
                            @endif
                        </div>
                        <div class="box-body table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Associado Pai:</td>
                                    <td>@isset($associado->parent_id)<a href="{{route('associados.show',$associado->parent->id)}}">{{$associado->parent->nome_completo}}</a> @endisset</td>

                                </tr>
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
                <div class="box-footer">
                    <h4 class="card-title">Associados linkados</h4>

                    <div class="box-body">
                        <div class="row">
                            <div class=" col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered ">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>Nome</th>
                                            <th>CPF</th>
                                            <th>Matrícula Nova</th>
                                            <th>Data nascimento</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($associados_linkados as $associado_linkado)
                                            <tr>
                                                <td><a href="{{route('associados.show',$associado_linkado->id)}}">{{$associado_linkado->nome_completo}}</a> </td>
                                                <td>{{$associado_linkado->cpf}}</td>
                                                <td>{{$associado_linkado->matricula_nova}}</td>
                                                <td>{{\Carbon\Carbon::parse($associado_linkado->data_nascimento)->format('d/m/Y')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="card-title">Dependentes</h4>

                    <div class="box-body table-responsive">
                        <div class="row">
                            <div class=" col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
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
                                                <td>{{$dependente->nome_completo}}</td>
                                                <td>{{$dependente->cpf}}</td>
                                                <td>{{$dependente->grau_parentesco}}</td>
                                                <td>{{\Carbon\Carbon::parse($dependente->data_nascimento)->format('d/m/Y')}}</td>
                                                <td><a href="{{route('dependentes.edit',$dependente->id)}}" data-original-title="Editar dependente" data-toggle="tooltip" type="button"
                                                       class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                    <a href="{{route('dependentes.pre_delete',$dependente->id)}}" data-original-title="Excluir" data-toggle="tooltip" type="button"
                                                       class="btn btn-danger text-light"><i class="fa fa-trash"></i></a>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <a href="{{route('dependente_info_delete.show',$associado->id)}}" type="button">Clique para verificar histórico de dependentes desativados</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a data-original-title="Imprimir {EM BREVE}" data-toggle="tooltip" type="button"
                       class="btn btn-primary"><i class="fa fa-print"></i></a>
                    <span class="pull-right">
                        <a href="{{route('pagamentos.show',$associado->id)}}"
                           data-original-title="Verificar histórico pagamento" data-toggle="tooltip" type="button"
                           class="btn btn-success"><i class="fa fa-dollar"></i></a>
                        <a href="{{route('associados.edit',$associado->id)}}"
                           data-original-title="Editar este associado" data-toggle="tooltip" type="button"
                           class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                        <a href="#"
                           onclick="
                                var result = confirm('Tem certeza que deseja excluir este associado?');
                                        if (result){
                                                event.preventDefault();
                                                document.getElementById('delete-form').submit();
                                        } "
                           data-original-title="Excluir este associado" data-toggle="tooltip" type="button"
                           class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        <form id="delete-form" action="{{route('associados.destroy',$associado->id)}}" method="POST"
                              style="display: none;">
                            <input type="hidden" name="_method" value="delete">
                            {{csrf_field()}}
                        </form>
                        <a href="{{route('dependentes.pre_create',$associado->id)}}"
                           data-original-title="Adicionar dependentes" data-toggle="tooltip" type="button"
                           class="btn btn-info"><i class="fa fa-user-plus"></i>
                        </a>
                        <a href="{{route('associados.link',$associado->id)}}"
                           data-original-title="Linkar associado" data-toggle="tooltip" type="button"
                           class="btn btn-info"><i class="fa fa-chain"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>



@endsection