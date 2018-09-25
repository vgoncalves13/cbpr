@extends('layouts.master')
@section('content')
<form novalidate action="{{route('dependentes.create',$associado_id)}}" method="GET" >

    <input type="hidden" value="{{$associado_id}}" name="associado_id">
    <div class="form-row"> <!-- Quantidade de dependentes -->
        <div class="form-group col-md-2">
            <label for="quantidade_dependentes" class="control-label">Quantidade de dependentes</label>
            <select class="form-control" id="quantidade_dependentes" name="quantidade_dependentes">
                <option value="1" selected>1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group"> <!-- Botão submeter -->
            <button type="submit" class="btn btn-primary">Avançar <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>


</form>
@endsection
