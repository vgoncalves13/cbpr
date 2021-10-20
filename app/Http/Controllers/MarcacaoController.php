<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\Associado;
use App\Dependente;
use App\Especialidade;
use App\Marcacao;
use App\Medico;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laratrust\Laratrust;

class MarcacaoController extends Controller
{

    protected $marcacao;
    function __construct()
    {
        $this->marcacao = new Marcacao();
    }

    public function index()
    {
        $marcacoes = Marcacao::with(['medico','especialidade'])
            ->orderBy('dia_consulta')
            ->orderBy('hora_consulta')
            ->get();


        if (!Auth::user()->hasRole(['superadmin', 'admin'])){
            $marcacoes = $marcacoes->where('associado_id',Auth::user()->associado->id);
            return view('marcacoes.index')->with(compact('marcacoes'));
        }
        return view('marcacoes.index')->with(compact('marcacoes'));
    }

    public function show(Marcacao $marcacao)
    {
        if (
            Auth::user()->hasRole(['admin', 'superadmin']) ||
            Auth::user()->owns($marcacao)
        ){
            return view('marcacoes.show')->with(compact('marcacao'));
        }else{
            return abort('403');
        }
    }

    /**
     *
     * Generate PDF to download
     *
     * @param Request
     * @return \Barryvdh\DomPDF\PDF
     */
    public function download_pdf(Request $request, $download = 1)
    {
        $marcacao = Marcacao::findOrFail($request->marcacao_id);

        $pdf = PDF::loadView('marcacoes.download_pdf', compact('marcacao'));

        if ($download == 1) {
            return $pdf->download(Carbon::now() . '.pdf');
        } else {
            return $pdf->stream('print', array("Attachment" => 1));
        }

    }

    public function especialidade($associado_id = null)
    {
        $especialidades = Especialidade::all(['id','nome']);
        if (isset($associado_id)){
            $dependentes = Dependente::where('associado_id',$associado_id)->get();
            session()->put('associado_id', $associado_id);
            $associado = Associado::findOrFail($associado_id);
        }else{
            $dependentes = Dependente::where('associado_id',Auth::user()->associado->id)->get();
            session()->put('associado_id', Auth::user()->associado->id);
            $associado = Auth::user()->associado;
        }


        return view('marcacoes.especialidade')->with(compact(
            'especialidades',
            'dependentes',
            'associado'
        ));
    }

    public function paciente(Request $request)
    {
        $namespace = app()->getNamespace();
        $paciente_tipo_array = explode('.',$request->paciente_id);
        $paciente_id = $paciente_tipo_array[1];
        $tipo_paciente = ucfirst($paciente_tipo_array[0]);
        $paciente = $namespace . $tipo_paciente;

        \session()->put([
            'paciente_id' => $paciente_id,
            'tipo_paciente' => $paciente,
            'especialidade_id' => $request->especialidade_id
        ]);
        return redirect(route('marcacao.medico'));
    }

    public function medico(Request $request)
    {
        $especialidade = Especialidade::findOrFail(\session()->get('especialidade_id'));
        $medicos = $especialidade->medicos()
            ->wherePivot('especialidade_id',$especialidade->id)
            ->get();
        return view('marcacoes.medico')->with(compact('medicos','especialidade'));
    }


    public function dias(Request $request, $medico_id, $especialidade_id)
    {
        $request->session()->put([
            'especialidade_id' => $especialidade_id,
            'medico_id' => $medico_id
            ]);
        $medico = Medico::findOrFail($medico_id);
        $agenda = Agenda::where('medico_id',$medico_id)->first();

        $horarios = $this->marcacao->horasRange(
            $this->marcacao->getSecondsFromTime($agenda->configs['horarios']['manha']['inicio']),
            $this->marcacao->getSecondsFromTime($agenda->configs['horarios']['tarde']['final']),
            60*15
        );

        $dias_marcacao = $this->marcacao->getDiasMarcacao(15);
        $dias_semana = $this->marcacao->getDiasDaSemana($dias_marcacao);
        return view('marcacoes.dias')->with(compact('medico','dias_semana','horarios'));

    }


    public function horarios($dia)
    {
        $horas = ['09:00','09:15','09:30','09:45',
            '10:00','10:15','10:30','10:45',
            '11:00','11:15','11:30','11:45',
            '12:00','12:15','12:30','12:45',
            '13:00','13:15','13:30','13:45',
            '14:00','14:15','14:30','14:45',
            '15:00','15:15','15:30','15:45',
            '16:00','16:15','16:30','16:45',
            '17:00',
        ];
        $horarios_marcados = Marcacao::where('medico_id',\session()->get('medico_id'))
            ->where('dia_consulta',$dia)
            ->get(['hora_consulta']);
        \session()->put(['dia_consulta' => $dia]);
        //return view('marcacoes.horarios')->with(compact('horas','horarios_marcados'));
        //$horas_json = json_encode($horarios_marcados);
        return response()->json($horarios_marcados);
    }
    public function store(Request $request)
    {
        $marcacao = new Marcacao();

        //Concatena data e hora consulta
        $data_hora_consulta = \session()->get('dia_consulta') . $request->hora_consulta;
        //Cria uma instancia carbon para criar um datetime
        $data_hora_consulta = Carbon::createFromFormat('Y-m-dH:i',$data_hora_consulta)->toDateTime();

        $marcacao->hora_consulta = $request->hora_consulta;
        $marcacao->data_hora_consulta = $data_hora_consulta;
        $marcacao->medico_id = \session()->get('medico_id');
        $marcacao->associado_id = \session()->get('associado_id');
        $marcacao->especialidade_id = \session()->get('especialidade_id');
        $marcacao->dia_consulta = \session()->get('dia_consulta');
        $marcacao->pacienteable_type = \session()->get('tipo_paciente');
        $marcacao->pacienteable_id = \session()->get('paciente_id');

        $marcacao->save();

        if ($marcacao){
            $associado = Associado::findOrFail(Session::get('associado_id'));
            if (!$associado->hasCellphone($associado)){
                Session::flash('warning','Identificamos que você não possui um celular cadastrado conosco!');
            }
            \session()->forget([
                'especialidade_id',
                'medico_id',
                'paciente_id',
                'tipo_paciente',
                'dia_consulta',
            ]);
            $message = "Consulta marcada com sucesso! Você pode baixar o comprovante de agendamento clicando no botão Download PDF";
            return redirect()
                ->route('marcacao.show',$marcacao->id)
                ->with(['message' => $message,
                    'telefone_celular' => $associado->telefone_celular
                ]);
        }
    }

    public function getMarcacoes(Request $request)
    {
        $from = $request->start;
        $to = $request->end;

        $marcacoes = Marcacao::with('pacienteable')
            ->whereBetween('data_hora_consulta', [$from, $to])
            ->where('medico_id', $request->medico_id)
            ->get();
        $arr_marcacoes = [];
        foreach ($marcacoes as $key => $value){
            $arr_marcacoes[$key]['title'] = 'Paciente ' . $value->pacienteable->nome_completo;
            $arr_marcacoes[$key]['start'] = $value->data_hora_consulta->toIso8601String();
            $arr_marcacoes[$key]['end'] = $value->data_hora_consulta->addMinutes(15)->toIso8601String();

        }

        return response()->json($arr_marcacoes);
    }

    public function login()
    {
        return view('marcacoes.login');
    }

    public function destroy(Marcacao $marcacao)
    {
        $marcacao->delete();
        return redirect(route('marcacao.index'))
            ->with('message', 'Consulta cancelada com sucesso!');
    }

}
