@extends('adminlte::page')
@section('content')
@section('title','Editar pagamento')
<style>
    input[type=text]{
        font-size: 12px;
        font-weight: lighter;
    }
</style>
<script type="text/javascript">
    window.onload = function() {


        $("input[id='mes']").inputmask(
            "currency",
            {
                "removeMaskOnSubmit": true,
                "prefix":"R$",
            });
        $("input[name='ano']").inputmask(
            "datetime",
            {
                inputFormat: "yyyy",
                removeMaskOnSubmit: true,
                min:"2015",
                placeholder:' '
            });
    }
    </script>


<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3>Editar pagamento</h3>
            </div>
            <div class="box-body">
                <form method="POST" action="{{route('pagamentos.update',$pagamento->id)}}" novalidate>
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="pagamento_id" value="{{$pagamento->id}}">
                    <table class="table table-bordered table-responsive-lg">
                        <thead class="">
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
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td scope="row"><input placeholder="ANO" readonly class="form-control" type="text" name="ano" value="{{$pagamento->ano}}"></td>
                            <td><input class="form-control" id="mes" type="text" name="janeiro" value="{{$pagamento->janeiro}}"></td>
                            <td><input class="form-control" id="mes" type="text" name="fevereiro" value="{{$pagamento->fevereiro}}"></td>
                            <td><input class="form-control" id="mes" type="text" name="marco" value="{{$pagamento->marco}}"></td>
                            <td><input class="form-control" id="mes" type="text" name="abril" value="{{$pagamento->abril}}"></td>
                            <td><input class="form-control" id="mes" type="text" name="maio" value="{{$pagamento->maio}}"></td>
                            <td><input class="form-control" id="mes" type="text" name="junho" value="{{$pagamento->junho}}"></td>
                            <td><input class="form-control" id="mes" type="text" name="julho" value="{{$pagamento->julho}}"></td>
                            <td><input class="form-control" id="mes" type="text" name="agosto" value="{{$pagamento->agosto}}"></td>
                            <td><input class="form-control" id="mes" type="text" name="setembro" value="{{$pagamento->setembro}}"></td>
                            <td><input class="form-control" id="mes" type="text" name="outubro" value="{{$pagamento->outubro}}"></td>
                            <td><input class="form-control" id="mes" type="text" name="novembro" value="{{$pagamento->novembro}}"></td>
                            <td><input class="form-control" id="mes" type="text" name="dezembro" value="{{$pagamento->dezembro}}"></td>
                        </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary btn-flat">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection