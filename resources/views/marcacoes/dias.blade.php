@extends('adminlte::page')
@section('title', 'Selecionar horário')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3>Selecionar dia para consulta com médico {{$medico->nome}}</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <form method="POST" novalidate action="{{route('marcacao.store')}}">
                            @csrf
                            <div class="col-12 col-md-6">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Próximas datas disponíveis</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($dias_semana as $data)
                                        <tr>
                                            <td>
                                                <a class="btn btn-primary btn-flat btn-block"
                                                        href="#"
                                                        onclick="getDiasMarcados('{{$data->format('Y-m-d')}}')"
                                                >{{$data->format('l, d/m/Y')}}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="" id="info">
                                </div>
                                <button type="submit" class="btn btn-primary btn-flat">Marcar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection