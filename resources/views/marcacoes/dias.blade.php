@extends('adminlte::page')
@section('title', 'Selecionar horário')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3>Selecionar dia para consulta com {{$medico->nome}}</h3>
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
                                <input id="medico_id" type="hidden" name="medico_id" value="{{session()->get('medico_id')}}">
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="" id="info">
                                </div>
                                <button id="botao_enviar" type="submit" class="btn btn-primary btn-flat">Marcar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        $('#botao_enviar').prop("disabled", true);

        function getHorarios() {
            var medico_id = document.getElementById('medico_id').value;
            var horarios;
            $.ajax({
                url: "{!! URL::to('/api/agenda/horarios') !!}" + '/' + medico_id,
                error: function() {
                    $('#info').html('<p>An error has occurred</p>');
                },
                dataType: 'json',
                async: false,
                success: function(data) {
                    horarios = data
                },
                type: 'GET'
            });
            return horarios;
        }

        function getDiasMarcados(dias) {
            var el = document.getElementById("info");

            if(el.children.length > 0){
                var child = el.children;
                el.removeChild(child[0]);
            }

            var select_horario = document.createElement("span");
            el.appendChild(select_horario);
            select_horario.setAttribute('id','select_horario');

            $.ajax({
                url: "{!! URL::to('/marcacoes/horarios') !!}" + '/' + dias,
                error: function() {
                    $('#info').html('<p>An error has occurred</p>');
                },
                dataType: 'json',
                success: function(data) {
                    var select = document.createElement("select");
                    select.name = "hora_consulta";
                    select.id = "hora_consulta"
                    select.setAttribute('class','form-control color-select-horario');

                    for (const val of getHorarios())
                    {
                        var option = document.createElement("option");
                        option.value = val;
                        for (horario_marcado of data){
                            if (option.value === horario_marcado['hora_consulta']){
                                option.disabled = true;
                            }
                        }
                        option.text = val.charAt(0).toUpperCase() + val.slice(1);
                        select.appendChild(option);
                    }

                    var label = document.createElement("label");
                    label.innerHTML = "Escolha o horário: "
                    label.htmlFor = "hora_consulta";

                    document.getElementById("select_horario").appendChild(label).appendChild(select).animate([
                            {transform: 'translate(-300px)'},
                            {transform: 'translate(0px)'}
                        ],{
                            duration: 500,
                            iterations: 1
                        }
                    );

                },
                type: 'GET'
            });
            $('#botao_enviar').prop("disabled", false);
        }

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $('#associado_id').select2({
            ajax: {
                url: '{{'/associados/load/select2'}}',
                data: function (params) {
                    return {
                        search: params.term,
                        page: params.page || 1
                    };
                },
                dataType: 'json',
                processResults: function (data) {
                    data.page = data.page || 1;
                    return {
                        results: data.items.map(function (item) {
                            return {
                                id: item.id,
                                text: item.nome_completo
                            };
                        }),
                        pagination: {
                            more: data.pagination
                        }
                    }
                },
                cache: true,
                delay: 250
            },
            placeholder: 'Selecione um associado',
            minimumInputLength: 3,
            multiple: false
        });
    </script>
@endsection