@extends('adminlte::page')
@section('title','Exibir usuário')
@section('content')
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">

                </div>

                <script>
                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
                    })
                </script>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3>{{$associado->nome_completo}}
                        @if($associado->status == 1)
                            <span class="label label-success">Adimplente</span>
                        @else
                            <span class="label label-danger">Inadimplente</span>
                        @endif </h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center">

                            @if(isset($associado->foto))
                                <img height="240" width="160" alt="Foto usuário {{$associado->nome_completo}}"
                                     src="{{\Storage::url("$associado->foto")}}" class="img-thumbnail img-responsive">
                                @if(!Auth::user()->isGuest())
                                    <form novalidate
                                          action="{{action('AssociadoController@updateFoto',$associado->id)}}"
                                          method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="PUT">
                                        <div class="form-group"> <!-- Foto -->
                                            <label for="Foto" class="control-label">Foto</label>
                                            <input type="file" class="form-control" id="foto" name="foto" placeholder=""
                                                   value="@if(isset($associado->foto)){{$associado->foto}}@else{{old('foto')}}@endif">
                                        </div>
                                        <div class="form-group"> <!-- Botão atualizar -->
                                            <button type="submit" class="btn btn-secondary"></i>Atualizar</button>
                                        </div>
                                    </form>
                                @endif
                            @else
                                @if(!Auth::user()->isGuest())
                                    <form class="d-print-none" novalidate
                                          action="{{action('AssociadoController@updateFoto',$associado->id)}}"
                                          method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="PUT">
                                        <div class="form-group"> <!-- Foto -->
                                            <label for="Foto" class="control-label">Foto</label>
                                            <input type="file" class="form-control" id="foto" name="foto" placeholder=""
                                                   value="@if(isset($associado->foto)){{$associado->foto}}@else{{old('foto')}}@endif">
                                        </div>
                                        <div class="form-group"> <!-- Botão atualizar -->
                                            <button type="submit" class="btn btn-secondary"></i>Salvar</button>
                                        </div>
                                    </form>
                                @endif
                            @endif
                        </div>

                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-responsive-md">
                                <tbody>

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


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a data-original-title="Imprimir {EM BREVE}" data-toggle="tooltip" type="button"
                       class="btn btn-primary"><i class="fa fa-print"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection