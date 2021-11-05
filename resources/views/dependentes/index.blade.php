@extends('adminlte::page')
@section('title', 'Index')

@section('content')

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3>Lista de dependentes</h3>
        </div>
        <div class="box-body table-responsive">

            <table class="table table-bordered" id="dependentes-table">
                <thead>
                <tr>
                    <th scope="col">Nome Dependente</th>
                    <th scope="col">Grau parentesco</th>
                    <th scope="col">Data de nascimento</th>
                    <th scope="col">Nome associado</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
            </table>
@endsection
@section('js')
    <script>
        $(function() {
            $('#dependentes-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('dependentes.datatables.data') !!}',
                columns: [
                    { data: 'nome_completo', name: 'nome_completo' },
                    { data: 'grau_parentesco', name: 'grau_parentesco' },
                    { data: 'data_nascimento', name: 'data_nascimento' },
                    { data: 'associado_nome_completo', name: 'associado.nome_completo' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection