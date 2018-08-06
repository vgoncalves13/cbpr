@extends('layouts.master');
@section('title', 'Index');

@section('content')
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th><i class="fa fa-user"></i> </th>
            <th scope="col">Nome Completo</th>
            <th scope="col">Data Nascimento</th>
            <th scope="col">Classe</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($associados as $associado)
        <tr>
            <td><img height="80" width="60"  src="{{\Storage::url("$associado->foto")}}" class="img-thumbnail img-responsive rounded"></td>
            <td scope="row">{{$associado->nome_completo}}</td>
            <td>  {{\Carbon\Carbon::parse($associado->data_nascimento)->format('d/m/Y')}}</td>
            <td>{{$associado->classe}}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ route('associados.show',$associado->id) }}" data-original-title="Ver mais" data-toggle="tooltip"  type="submit" class="btn btn-primary"><i class="fa fa-search-plus"></i></a>
                    <a href="{{ route('pagamentos.show',$associado->id) }}" data-original-title="Verificar pagamentos" data-toggle="tooltip"  type="submit" class="btn btn-primary"><i class="fa fa-dollar-sign"></i></a>
                    <a href="{{ route('associados.edit',$associado->id) }}" data-original-title="Editar associado" data-toggle="tooltip"  type="submit" class="btn btn-primary"><i class="fa fa-user-edit"></i></a>
                </div>


            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
{{ $associados->links() }}
@endsection