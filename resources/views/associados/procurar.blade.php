@extends('adminlte::page')
@section('title','Pesquisar associado')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3>Pesquisa de Associados</h3>
                </div>
                <div class="box-body">
                    <form class="" action="{{route('associados.busca')}}" method="GET">
                        <div class="form-group">
                            <label>Palavra-chave</label>
                            <input type="text" name="busca" class="form-control" placeholder="Procurar" value="{{old('busca')}}">
                        </div>
                        <div class="form-group">
                            <label>Termo</label>
                            <select class="custom-select form-control" name="termo">
                                <option value="" selected>Escolha um termo</option>
                                <option value="cpf">CPF</option>
                                <option value="nome_completo">Nome</option>
                                <option value="email">E-mail</option>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                        Procurar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


