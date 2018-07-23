@extends('layouts.master')
@section('title','Cadastrar pagamento')
@section('content')
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
    <form method="POST" novalidate action="{{route('pagamentos.store',$associado_id)}}">
        {{csrf_field()}}
        <input type="hidden" name="associado_id" value="{{$associado_id}}">
        <div class="form-row">
            <div class="form-group col-md-3"> <!-- Ano histórico -->
                <label for="ano" class="control-label">Ano Histórico</label>
                <input type="text" class="form-control" id="ano" name="ano" placeholder="ANO"
                       value="{{old('graduacao')}}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <a href="{{url('pagamentos',$associado_id)}}" data-original-title="Voltar" data-toggle="tooltip"  type="submit" class="btn btn-secondary"><i class="fa fa-arrow-left"></i></a>
    </form>
@endsection