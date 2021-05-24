@extends('adminlte::page')
@section('title', 'Selecionar horário')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3>Selecionar horário para consulta</h3>
                </div>
                <div class="box-body with-border">
                    <form class="" action="{{route('marcacao.store')}}" method="POST">
                        @csrf
                        <div class="box-body">
                            @foreach($horas as $hora)
                                <div class="col-12 col-md-3">
                                    <div class="form-check">
                                        <input
                                                @foreach($horarios_marcados as $marcacao)
                                                @if($marcacao->hora_consulta == $hora) disabled @endif
                                                @endforeach class="form-check-input" id="{{$hora}}" type="radio"
                                                name="hora_consulta" value="{{$hora}}" >
                                        <label for="{{$hora}}" class="form-check-label">
                                            {{$hora}}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                </div>
                <div class="box-footer with-border">
                    <button type="submit" class="btn btn-primary">Agendar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection