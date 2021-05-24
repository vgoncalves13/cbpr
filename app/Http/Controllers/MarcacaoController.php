<?php

namespace App\Http\Controllers;

use App\Associado;
use App\Dependente;
use App\Especialidade;
use App\Marcacao;
use App\Medico;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MongoDB\Driver\Session;

class MarcacaoController extends Controller
{

    protected $marcacao;
    function __construct()
    {
        $this->marcacao = new Marcacao();
    }

    public function index()
    {
        $marcacoes = Marcacao::with(['medico','especialidade'])->get();

        return view('marcacoes.index')->with(compact('marcacoes'));
    }

    public function especialidade()
    {
        $dependentes = Dependente::where('associado_id',Auth::user()->associado->id)->get();
        $especialidades = Especialidade::all(['id','nome']);
        return view('marcacoes.especialidade')->with(compact('especialidades','dependentes'));
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
        $dias_marcacao = $this->marcacao->getDiasMarcacao(15);
        $dias_semana = $this->marcacao->getDiasDaSemana($dias_marcacao);
        return view('marcacoes.dias')->with(compact('medico','dias_semana'));

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
        $marcacao->hora_consulta = $request->hora_consulta;
        $marcacao->medico_id = \session()->get('medico_id');
        $marcacao->especialidade_id = \session()->get('especialidade_id');
        $marcacao->dia_consulta = \session()->get('dia_consulta');
        $marcacao->pacienteable_type = \session()->get('tipo_paciente');
        $marcacao->pacienteable_id = \session()->get('paciente_id');

        $marcacao->save();

        if ($marcacao){
            \session()->forget([
                'especialidade_id',
                'medico_id',
                'paciente_id',
                'tipo_paciente',
                'dia_consulta',
            ]);
            return redirect(route('marcacao.index'))
                ->with('message', 'Consulta marcada com sucesso');
        }
    }

}
