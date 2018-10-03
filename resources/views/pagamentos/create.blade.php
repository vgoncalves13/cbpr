@extends('adminlte::page')
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

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3>Criar novo registro anual</h3>
                </div>
                <div class="box-body">
                    <form method="POST" novalidate action="{{route('pagamentos.store',$associado_id)}}">
                        {{csrf_field()}}
                        <input type="hidden" name="associado_id" value="{{$associado_id}}">
                        <div class="form-group"> <!-- Ano histórico -->
                            <label for="ano" class="">Ano Histórico</label>
                            <input type="text" class="form-control" id="ano" name="ano" placeholder="ANO"
                                   value="{{old('graduacao')}}">
                        </div>
                        <div class="form-group"><!--Botão enviar-->
                            <button type="submit" class="btn btn-primary btn-flat">Cadastrar</button>
                            <a href="{{url('pagamentos',$associado_id)}}"
                               data-original-title="Voltar"
                               data-toggle="tooltip"
                               type="submit"
                               class="btn btn-secondary btn-flat">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection