@extends('adminlte::page')
@section('title','Exibir usuário')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">

                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-12 col-md-3">
                        {{--Formulário configurações de data médicos--}}
                            <form novalidate action="{{route('agendas.store', $agenda)}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" id="medico_id" value="{{$agenda->medico->id}}">
                                <div class="box-body">
                                    <h3>Definições de data</h3>
                                    <div class="form-row">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group"> <!-- Início de atendimento manhã -->
                                                    <label for="crm" class="control-label"> Início de atendimento manhã </label>
                                                    <input type="text" class="form-control" id="inicio_horario_manha" name="inicio_horario_manha"
                                                           placeholder="Início horário manhã"
                                                           value="{{old('inicio_horario_manha') ?? isset($agenda['configs'])?$agenda['configs']['horarios']['manha']['inicio']:''}}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group"> <!-- Final de atendimento manhã -->
                                                    <label for="crm" class="control-label"> Final de atendimento manhã </label>
                                                    <input type="text" class="form-control" id="final_horario_manha" name="final_horario_manha"
                                                           placeholder="Final horário manhã"
                                                           value="{{old('final_horario_manha') ?? isset($agenda['configs'])?$agenda['configs']['horarios']['manha']['final']:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group"> <!-- Início de atendimento tarde -->
                                                    <label for="crm" class="control-label"> Início de atendimento tarde </label>
                                                    <input type="text" class="form-control" id="inicio_horario_manha" name="inicio_horario_tarde"
                                                           placeholder="Início horário manhã"
                                                           value="{{old('inicio_horario_tarde') ?? isset($agenda['configs'])?$agenda['configs']['horarios']['tarde']['inicio']:''}}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group"> <!-- Final de atendimento tarde -->
                                                    <label for="crm" class="control-label"> Final de atendimento tarde </label>
                                                    <input type="text" class="form-control" id="final_horario_manha" name="final_horario_tarde"
                                                           placeholder="Final horário manhã"
                                                           value="{{old('final_horario_tarde') ?? isset($agenda['configs'])?$agenda['configs']['horarios']['tarde']['final']:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <label class="control-label">Período de atendimento:</label>
                                        <div class="form-group"> <!--Período de atendimento-->
                                            <label for="manha" class="control-label">Manhã</label>
                                            <input @if($agenda['configs']['periodo']=='manha') checked @endif id="manha" type="radio" name="agenda_periodo_atendimento" value="manha">
                                            <label for="tarde" class="control-label">Tarde</label>
                                            <input @if($agenda['configs']['periodo']=='tarde') checked @endif id="tarde" type="radio" name="agenda_periodo_atendimento" value="tarde">
                                            <label for="ambos" class="control-label">Manhã/Tarde</label>
                                            <input @if($agenda['configs']['periodo']=='ambos') checked @endif id="ambos" type="radio" name="agenda_periodo_atendimento" value="ambos">
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="col-12 col-md-9">
                            {{--Render do calendário--}}
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary btn-flat" type="submit">Salvar</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var medico_id = document.getElementById('medico_id').value;
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    center: 'dayGridMonth,timeGridWeek,timeGridDay' // buttons for switching between views
                },

                eventSources: [

                    // your event source
                    {
                        url: '/api/marcacoes',
                        method: 'GET',
                        extraParams: {
                          medico_id: medico_id
                        },
                        failure: function() {
                            alert('there was an error while fetching events!');
                        },
                        color: 'blue',   // a non-ajax option
                        textColor: 'white' // a non-ajax option
                    }

                    // any other sources...

                ],
                initialView: 'timeGridWeek',
                locale: 'pt-br',
                height: 'auto',
                navLinks: true,
                nowIndicator: true,

            });
            calendar.render();
        });

    </script>

@endsection