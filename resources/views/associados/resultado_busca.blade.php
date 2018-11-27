@extends('adminlte::page')
@section('title', 'Index')

@section('content')

    <table class="table table-responsive-md table-hover table-striped">
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

            <td scope="row"><a href="@if(\Illuminate\Support\Facades\Auth::user()->isGuest())show_consultorio/{!!$associado->id!!}@else{{'associados/'.$associado->id}}@endif">{{$associado->nome_completo}}        @if($associado->status == 1)
                        <span class="label label-success">A</span>
                    @else
                        <span class="label label-danger">I</span>
                    @endif</a></td>
            <td>  {{\Carbon\Carbon::parse($associado->data_nascimento)->format('d/m/Y')}}</td>
            <td>{{$associado->classe}}</td>
            <td>
                <div class="btn-group">
                    <a href="@if(\Illuminate\Support\Facades\Auth::user()->isGuest()){{ route('associados.show_consultorio',$associado->id) }} @else {{route('associados.show',$associado->id)}} @endif" data-original-title="Ver mais" data-toggle="tooltip"  type="submit" class="btn btn-primary"><i class="fa fa-search-plus"></i></a>
                    @if(!\Illuminate\Support\Facades\Auth::user()->isGuest())
                        <a href="{{ route('pagamentos.show',$associado->id) }}" data-original-title="Verificar pagamentos" data-toggle="tooltip"  type="submit" class="btn btn-primary"><i class="fa fa-dollar"></i></a>
                        <a href="{{ route('associados.edit',$associado->id) }}" data-original-title="Editar associado" data-toggle="tooltip"  type="submit" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="{{route('dependentes.pre_create',$associado->id)}}"
                           data-original-title="Adicionar dependentes" data-toggle="tooltip" type="button"
                           class="btn btn-primary"><i class="fa fa-user-plus"></i></a>
                    @endif
                </div>


            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
{{ $associados->links() }}
<a href="{{route('exportar_csv')}}" class="btn btn-primary pull-right"><i class="fa fa-file-excel-o"></i> Exportar para CSV </a>

@endsection