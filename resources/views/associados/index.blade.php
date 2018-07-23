@extends('layouts.master');
@section('title', 'Index');
@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th scope="col">Nome Completo</th>
            <th scope="col">Data Nascimento</th>
            <th scope="col">Classe</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($associados as $associado)
        <tr>
            <td><img height="60" width="40" alt="Foto usuário {{$associado->nome_completo}}" src="{{\Storage::url("$associado->foto")}}" class="img-thumbnail img-responsive"></td>
            <td scope="row">{{$associado->nome_completo}}</td>
            <td>  {{\Carbon\Carbon::parse($associado->data_nascimento)->format('d/m/Y')}}</td>
            <td>{{$associado->classe}}</td>
            <td>
                <button class="btn btn-outline-primary" onclick="location.href='{{ route('associados.show',$associado->id) }}'">Mostrar mais</button>
                <button class="btn btn-outline-warning" onclick="location.href='{{ route('pagamentos.show',$associado->id) }}'">Verificar pagamentos</button>
                <button class="btn btn-outline-secondary" onclick="location.href='{{ route('associados.edit',$associado->id) }}'">Editar</button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
{{ $associados->links() }}
@endsection