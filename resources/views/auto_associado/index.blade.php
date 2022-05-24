@extends('adminlte::page')
@section('title', 'Index')

@section('content')

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3>Lista de associados para aprovar</h3>
        </div>
        <div class="box-body table-responsive">

            <table class="table table-bordered" id="auto_cadastro-table">
                <thead>
                <tr>
                    <th scope="col">Nome completo</th>
                    <th scope="col">Classe</th>
                    <th scope="col">Data de nascimento</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Criado em:</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($unserialize_associados as $associado)
                        <tr>
                            <td>{{$associado['nome_completo']}}</td>
                            <td>{{$associado['classe']}}</td>
                            <td>{{$associado['data_nascimento']}}</td>
                            <td>{{$associado['cpf']}}</td>
                            <td>{{\Carbon\Carbon::parse($associado['created_at'])->format('d/m/Y H:i:s')}}</td>
                            <td><a href="{{route('auto_cadastro.show',$associado['id'])}}"
                                   data-original-title="Ver mais detalhes" data-toggle="tooltip" type="button"
                                   class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="{{route('auto_cadastro.approve',$associado['id'])}}"
                                   data-original-title="Aprovar" data-toggle="tooltip" type="button"
                                   class="btn btn-success text-light"><i class="fa fa-check"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
@endsection
@section('js')
    <script>
        $(function() {
            $('#auto_cadastro-table').DataTable();
        });
    </script>
@endsection