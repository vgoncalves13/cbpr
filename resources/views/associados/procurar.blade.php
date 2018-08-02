@extends('layouts.master')
@section('content')
        <form class="card card-sm" action="{{route('associados.busca')}}" method="GET">

            <div class="card-body row no-gutters align-items-center">
                <div class="col-auto">
                    <i class="fas fa-search h4 text-body"></i>
                </div>
                <!--end of col-->
                <div class="col">
                    <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Digite aqui sua busca" name="busca">
                </div>
                <div class="col-4">
                    <select class="form-control form-control-lg" name="termo">
                        <option value="" selected>Escolha um termo</option>
                        <option value="cpf">CPF</option>
                        <option value="nome_completo">Nome</option>
                        <option value="email">E-mail</option>
                    </select>
                </div>
                <!--end of col-->
                <div class="col-auto">
                    <button class="btn btn-lg btn-success" type="submit">Procurar</button>
                </div>
                <!--end of col-->
            </div>
        </form>
    <!--end of col-->
@endsection