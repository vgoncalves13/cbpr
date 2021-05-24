@extends('adminlte::page')
@section('title', 'Selecionar médico')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3>Selecionar médico {{$especialidade->nome}}</h3>
            </div>
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome médico</th>
                            <th>CRM</th>
                            <th>Horários</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($medicos as $medico)
                            <tr>
                                <td>{{$medico->nome}}</td>
                                <td>{{$medico->crm}}</td>
                                <td>
                                    <a href="{{route('marcacao.dias',[$medico->id,$especialidade->id])}}"
                                       class="btn btn-primary">
                                        Ver datas
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection