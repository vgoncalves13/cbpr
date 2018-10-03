@extends('adminlte::page')
@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3>Informe quantidade de dependentes para cadastrar</h3>
                </div>
                <div class="box-body">
                    <form novalidate action="{{route('dependentes.create',$associado_id)}}" method="GET" >
                        <input type="hidden" value="{{$associado_id}}" name="associado_id">
                        <div class="form-group"> <!-- Quantidade de dependentes -->
                            <label for="quantidade_dependentes" class="">Quantidade de dependentes</label>
                            <select class="form-control" id="quantidade_dependentes" name="quantidade_dependentes">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                </div>
                <div class="box-footer">
                    <div class="form-group"> <!-- Botão submeter -->
                        <button type="submit" class="btn btn-primary btn-flat">Avançar <i class="fa fa-arrow-right"></i></button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
