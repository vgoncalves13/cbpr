@extends('adminlte::page')
@section('title', 'Histórico Pagamento')
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@section('content')
<style>
    table {
        table-layout: fixed;
        word-wrap: break-word;
    }

</style>

<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3>Histórico pagamento associado:
                    <a href="{!! '/associados/'.$associado->id !!}">{!! $associado->nome_completo !!}
                    </a> | Admissão: {{\Carbon\Carbon::parse($associado->admissao)->format('d/m/y')}}
                </h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-responsive-lg">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ANO</th>
                        <th scope="col">JAN</th>
                        <th scope="col">FEV</th>
                        <th scope="col">MAR</th>
                        <th scope="col">ABR</th>
                        <th scope="col">MAI</th>
                        <th scope="col">JUN</th>
                        <th scope="col">JUL</th>
                        <th scope="col">AGO</th>
                        <th scope="col">SET</th>
                        <th scope="col">OUT</th>
                        <th scope="col">NOV</th>
                        <th scope="col">DEZ</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagamentos as $pagamento)
                        <tr>
                            <td scope="row" class="table-dark">{{$pagamento->ano}}</td>
                            <td>@if(isset($pagamento->janeiro))R$ {{$pagamento->janeiro}}@else{{'-'}}@endif</td>
                            <td>@if(isset($pagamento->fevereiro))R$ {{$pagamento->fevereiro}}@else{{'-'}}@endif</td>
                            <td>@if(isset($pagamento->marco))R$ {{$pagamento->marco}}@else{{'-'}}@endif</td>
                            <td>@if(isset($pagamento->abril))R$ {{$pagamento->abril}}@else{{'-'}}@endif</td>
                            <td>@if(isset($pagamento->maio))R$ {{$pagamento->maio}}@else{{'-'}}@endif</td>
                            <td>@if(isset($pagamento->junho))R$ {{$pagamento->junho}}@else{{'-'}}@endif</td>
                            <td>@if(isset($pagamento->julho))R$ {{$pagamento->julho}}@else{{'-'}}@endif</td>
                            <td>@if(isset($pagamento->agosto))R$ {{$pagamento->agosto}}@else{{'-'}}@endif</td>
                            <td>@if(isset($pagamento->setembro))R$ {{$pagamento->setembro}}@else{{'-'}}@endif</td>
                            <td>@if(isset($pagamento->outubro))R$ {{$pagamento->outubro}}@else{{'-'}}@endif</td>
                            <td>@if(isset($pagamento->novembro))R$ {{$pagamento->novembro}}@else{{'-'}}@endif</td>
                            <td>@if(isset($pagamento->dezembro))R$ {{$pagamento->dezembro}}@else{{'-'}}@endif</td>
                            <td><a href="{{route('pagamentos.edit',$pagamento->id)}}" data-original-title="Editar Histórico" data-toggle="tooltip"  type="submit" class="d-print-none btn btn-secondary"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <a data-original-title="Imprimir" data-toggle="tooltip" onclick="window.print()" type="button" class="d-print-none btn btn-primary btn-flat"><i class="fa fa-print"></i></a>
                <a href="{{route('pagamentos.create',$associado_id)}}" data-original-title="Criar novo ano" data-toggle="tooltip"  type="submit" class="d-print-none btn btn-secondary"><i class="fa fa-plus"></i></a>

            </div>
        </div>
    </div>
</div>








@endsection
