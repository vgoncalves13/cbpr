@extends('layouts.master');
@section('title', 'Index');

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Nome Completo</th>
            <th scope="col">Data Nascimento</th>
            <th scope="col">Classe</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($associados as $associado)
        <tr>
            <th scope="row">{{$associado->nome_completo}}</th>
            <td>  {{\Carbon\Carbon::parse($associado->data_nascimento)->format('d/m/Y')}}</td>
            <td>{{$associado->classe}}</td>
            <td>
                <button class="btn btn-outline-primary" onclick="location.href='{{ route('associados.show',$associado->id) }}'">Mostrar mais</button>
                <!--<button class="btn btn-outline-secondary" onclick="location.href='{{ route('associados.edit',$associado->id) }}'">Editar</button>-->
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
{{ $associados->links() }}
