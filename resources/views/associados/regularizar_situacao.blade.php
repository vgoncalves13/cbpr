@extends('adminlte::page')
@section('title', 'Regularize sua situação')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                <h3>Atenção {{$associado->nome_completo}}!</h3>
                    <p>Favor entrar em contato com a administração do CBPR,  Telefones:
                        (21) 98841-1190 / (21) 3899-7771 ou (21) 3899-7104
                    </p>
            </div>
        </div>
    </div>
@endsection