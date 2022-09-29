@extends('adminlte::page')
@section('title', 'Atualizar CPF')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                <h3>Atenção {{$associado->nome_completo}}!</h3>
                    <p>Favor, atualizar o seu CPF, pois ele não é válido. Em caso de problemas entrar em contato nos telefones:
                        (21) 98841-1190 / (21) 3899-7771 ou (21) 3899-7104
                    </p>
            </div>
            <div class="box-body">
                <form novalidate action="{{route('associados.updateCpf',$associado->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PATCH">

                    <h3>Informações do Associado</h3>
                    <div class="form-row">
                        <div class="form-group col-md-4"> <!-- CPF -->
                            <label for="cpf" class="control-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Apenas números"
                                    value="@if(isset($associado->cpf)){{$associado->cpf}}@else{{old('cpf')}}@endif">
                        </div>
                    </div>
            </div>
            <div class="box-footer">
                <div class="form-group"> <!-- Botão atualizar -->
                    <button type="submit" class="btn btn-primary btn-flat">Atualizar <i class="fa fa-save"></i></button>
                </div>

                </form>
            </div>
        </div>
    </div>
@endsection