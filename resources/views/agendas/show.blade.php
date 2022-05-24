@extends('adminlte::page')
@section('title','Exibir usuário')
@section('content')

    <div class="sticky-top box box-danger">
        <div class="box-body">
            <div class="col-12">
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
                                        <input type="text" class="form-control manha" id="inicio_horario_manha" name="inicio_horario_manha"
                                               placeholder="Início horário manhã"
                                               value="{{old('inicio_horario_manha') ?? isset($agenda['configs'])?$agenda['configs']['horarios']['manha']['inicio']:''}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group"> <!-- Final de atendimento manhã -->
                                        <label for="crm" class="control-label"> Final de atendimento manhã </label>
                                        <input type="text" class="form-control manha" id="final_horario_manha" name="final_horario_manha"
                                               placeholder="Final horário manhã"
                                               value="{{old('final_horario_manha') ?? isset($agenda['configs'])?$agenda['configs']['horarios']['manha']['final']:''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group"> <!-- Início de atendimento tarde -->
                                        <label for="crm" class="control-label"> Início de atendimento tarde </label>
                                        <input type="text" class="form-control tarde" id="inicio_horario_manha" name="inicio_horario_tarde"
                                               placeholder="Início horário manhã"
                                               value="{{old('inicio_horario_tarde') ?? isset($agenda['configs'])?$agenda['configs']['horarios']['tarde']['inicio']:''}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group"> <!-- Final de atendimento tarde -->
                                        <label for="crm" class="control-label"> Final de atendimento tarde </label>
                                        <input type="text" class="form-control tarde" id="final_horario_manha" name="final_horario_tarde"
                                               placeholder="Final horário manhã"
                                               value="{{old('final_horario_tarde') ?? isset($agenda['configs'])?$agenda['configs']['horarios']['tarde']['final']:''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label class="control-label">Período de atendimento:</label>
                                    <div class="form-check"> <!--Período de atendimento-->
                                        <input class="form-check-input"
                                               @if($agenda['configs']['periodo']=='manha') checked @endif
                                               id="manha"
                                               type="radio"
                                               name="agenda_periodo_atendimento"
                                               value="manha">
                                        <label for="manha" class="form-check-label">Manhã</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                                @if($agenda['configs']['periodo']=='tarde') checked @endif
                                                id="tarde"
                                                type="radio"
                                                name="agenda_periodo_atendimento"
                                               value="tarde">
                                        <label for="tarde" class="control-label">Tarde</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               @if($agenda['configs']['periodo']=='ambos') checked @endif
                                               id="ambos"
                                               type="radio"
                                               name="agenda_periodo_atendimento"
                                               value="ambos">
                                        <label for="ambos" class="control-label">Manhã/Tarde</label>
                                    </div>
                                    <label class="control-label">Dias de atendimento:</label>
                                    <div class="form-check">
                                        <input type="checkbox" name="dias_semana[]" value="0" @isset($agenda['configs']['dias_semana']){{  (in_array('0',$agenda['configs']['dias_semana']) ? ' checked' : '') }} @endisset class="form-check-input" id="dia-0">
                                        <label for="dia-0" class="control-label">Domingo</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="dias_semana[]" value="1" @isset($agenda['configs']['dias_semana']){{  (in_array('1',$agenda['configs']['dias_semana']) ? ' checked' : '') }} @endisset class="form-check-input" id="dia-1">
                                        <label for="dia-1" class="control-label">Segunda</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="dias_semana[]" value="2" @isset($agenda['configs']['dias_semana']){{  (in_array('2',$agenda['configs']['dias_semana']) ? ' checked' : '') }} @endisset class="form-check" id="dia-2">
                                        <label for="dia-2" class="control-label">Terça</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="dias_semana[]" value="3" @isset($agenda['configs']['dias_semana']){{  (in_array('3',$agenda['configs']['dias_semana']) ? ' checked' : '') }} @endisset class="form-check" id="dia-3">
                                        <label for="dia-3" class="control-label">Quarta</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="dias_semana[]" value="4" @isset($agenda['configs']['dias_semana']){{  (in_array('4',$agenda['configs']['dias_semana']) ? ' checked' : '') }} @endisset class="form-check" id="dia-4">
                                        <label for="dia-4" class="control-label">Quinta</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="dias_semana[]" value="5" @isset($agenda['configs']['dias_semana']){{  (in_array('5',$agenda['configs']['dias_semana']) ? ' checked' : '') }} @endisset class="form-check" id="dia-5">
                                        <label for="dia-5" class="control-label">Sexta</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="dias_semana[]" value="6" @isset($agenda['configs']['dias_semana']){{  (in_array('6',$agenda['configs']['dias_semana']) ? ' checked' : '') }} @endisset class="form-check" id="dia-6">
                                        <label for="dia-6" class="control-label">Sábado</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group"> <!-- Estado Civil -->
                                        <label for="intervalo_consultas" class="control-label">Intervalo dos horários de consultas</label>
                                        <select class="form-control" id="intervalo_consultas" name="intervalo_consultas">
                                            <option value="" selected="">
                                                Selecione..
                                            </option>
                                            <option @isset($agenda['configs']['intervalo']) {{($agenda['configs']['intervalo'] == \App\Agenda::CADA_15_MINUTOS) ? 'selected' : ''}} @endisset
                                                    value="{{\App\Agenda::CADA_15_MINUTOS}}">
                                                A cada 15 minutos
                                            </option>
                                            <option @isset($agenda['configs']['intervalo']) {{($agenda['configs']['intervalo'] == \App\Agenda::CADA_30_MINUTOS) ? 'selected' : ''}} @endisset
                                                    value="{{\App\Agenda::CADA_30_MINUTOS}}">
                                                A cada 30 minutos
                                            </option>
                                            <option @isset($agenda['configs']['intervalo']) {{($agenda['configs']['intervalo'] == \App\Agenda::CADA_60_MINUTOS) ? 'selected' : ''}} @endisset
                                                    value="{{\App\Agenda::CADA_60_MINUTOS}}">
                                                A cada 1 hora
                                            </option>
                                            <option @isset($agenda['configs']['intervalo']) {{($agenda['configs']['intervalo'] == \App\Agenda::CADA_120_MINUTOS) ? 'selected' : ''}} @endisset
                                                    value="{{\App\Agenda::CADA_120_MINUTOS}}">
                                                A cada 2 horas
                                            </option>
                                        </select>
                                    </div>
                                </div>
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
    <div class="box box-danger">
        <div class="box-body">
            {{--Render do calendário--}}
            <div id='calendar'></div>
        </div>

    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.select2').select2();

            $('input[name=agenda_periodo_atendimento]').on('change', function() {
                if(this.value == 'tarde'){
                    $('.manha').prop('disabled', true);
                    $('.tarde').prop('disabled', false);
                }else if (this.value == 'manha'){
                    $('.tarde').prop('disabled', true);
                    $('.manha').prop('disabled', false);
                } else {
                    $('.tarde').prop('disabled', false);
                    $('.manha').prop('disabled', false);
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var medico_id = document.getElementById('medico_id').value;
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    center: 'dayGridMonth,timeGridWeek,timeGridDay' // buttons for switching between views
                },
                eventSources: [
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
