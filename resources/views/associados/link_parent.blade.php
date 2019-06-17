@extends('adminlte::page')
@section('title', 'Linkar associado')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3>Linkar associado</h3>
                </div>
                <div class="box-body">
                    <form novalidate action="{{route('associados.link_save')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="associado_id" value="{{$associado_id}}">
                        <div class="box-body">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label class="control-label">Selecionar associado</label>
                                    <select id="associado_id" name="parent_id" class="form-control"></select>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="box-footer">
                    <div class="form-row">
                        <div class="form-group col-md-12"> <!-- Botão submeter -->
                            <button type="submit" class="btn btn-primary btn-flat">Linkar <i class="fa fa-save"></i></button>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.onload = function () {

        }
    </script>


@endsection