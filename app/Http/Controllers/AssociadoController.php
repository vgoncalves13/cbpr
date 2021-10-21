<?php

namespace App\Http\Controllers;

use App\Associado;
use App\Dependente;
use App\Endereco;
use App\Http\Requests\BuscaAssociadoRequest;
use App\Http\Requests\StoreAssociadoRequest;
use App\Http\Requests\UpdateAssociadoRequest;
use App\Report;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laracsv\Export;
use MongoDB\Driver\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;

class AssociadoController extends Controller
{

    protected $associado;

    public function __construct(Associado $associado)
    {
        $this->associado = $associado;
    }

    public function index()
    {
        $graficoClasseAssociado = app()->chartjs
            ->name('pieChartTest')
            ->type('doughnut')
            ->size(['width' => 300, 'height' => 100])
            ->labels(['CBMERJ', 'PMERJ','PENSIONISTA','SÓCIO CIVIL'])
            ->datasets([
                [
                    'backgroundColor' => ['#FF0000','#0000b2', '#008000','#e5d800'],
                    'hoverBackgroundColor' => ['#ff6666', '#7f7fff','#4ca64c','#fff44c'],
                    'data' => [
                        getTotalClasse('CBMERJ'),
                        getTotalClasse('PMERJ'),
                        getTotalClasse('PENSIONISTA'),
                        getTotalClasse('CIVIL'),
                    ]
                ]
            ])
            ->options([]);
        if (Auth::user()->can('create-associado')){
            return view('associados.index', compact('graficoClasseAssociado'));
        }else{
            return redirect(route('marcacao.index'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {

        if (Auth::user()->can('create-associado')){
            return view('associados.create');
        }
        abort('403');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(StoreAssociadoRequest $request)
    {

        $foto[] = null;
        if ($request->hasFile('foto')) {
            $foto['foto'] = $this->saveProfilePhoto($request);
        }


        $datas = [
            'data_nascimento' => Carbon::now()
                ->createFromFormat('d/m/Y', $request->get('data_nascimento'))
                ->toDateString(),
            'admissao' => Carbon::now()
                ->createFromFormat('d/m/Y', $request->get('admissao'))
                ->toDateString(),
        ];

        if ($associado = Associado::create(array_merge($request->all(), $datas, $foto))) {


            $endereco = new Endereco();
            $endereco->associado_id = $associado->id;
            $endereco->logradouro = $request->logradouro;
            $endereco->numero = $request->numero;
            $endereco->complemento = $request->complemento;
            $endereco->bairro = $request->bairro;
            $endereco->cep = $request->cep;
            $endereco->save();

            $cpf_limpo = $this->associado->limparCpfUsuario($associado->cpf);
            $user = $this->associado->criarUsername($cpf_limpo);
            $user->attachRole('associado');
            $associado->user_id = $user->id;
            $associado->save();


            return redirect("associados/$associado->id")->with('message', 'Associado cadastrado com sucesso.');
        }
        return Redirect::back()->withErrors(['message', 'Erro ao cadastrar']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $associado = Associado::with(['parent'])->find($id);
        $dependentes = Dependente::where([
            ['associado_id', '=', $id],
            ['status','=','1']])
            ->get();
        $associados_linkados = Associado::where('parent_id',$associado->id)->get();

        if (Auth::user()->isAbleTo(['create-associado']) || $associado->isTheOwner(Auth::user())){
            return view('associados.show')->with(compact('associado','dependentes','associados_linkados'));
        }else{
            abort('403');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $associado = Associado::find($id);
        return view('associados.edit')->with(compact('associado', $associado));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return RedirectResponse
     */
    public function update(UpdateAssociadoRequest $request, $id)
    {
        $associado = Associado::findOrFail($id);
        if ($request->has('foto')){
            $this->updateFoto($request,$id);
        }

        $data_nascimento = Carbon::now()
            ->createFromFormat('d/m/Y', $request->input('data_nascimento'))
            ->toDateString();
        $admissao = Carbon::now()
            ->createFromFormat('d/m/Y', $request->input('admissao'))
            ->toDateString();

        $associado->update(
            [
                'id' => $id,
                'matricula_antiga' => $request->input('matricula_antiga'),
                'matricula_nova' => $request->input('matricula_nova'),
                'graduacao' => $request->input('graduacao'),
                'classe' => $request->input('classe'),
                'status' => $request->input('status'),
                'nome_completo' => $request->input('nome_completo'),
                'nome_mae' => $request->input('nome_mae'),
                'nome_pai' => $request->input('nome_pai'),
                'naturalidade' => $request->input('naturalidade'),
                'estado_civil' => $request->input('estado_civil'),
                'cpf' => $request->input('cpf'),
                'telefone_trabalho' => $request->input('telefone_trabalho'),
                'telefone_casa' => $request->input('telefone_casa'),
                'telefone_celular' => $request->input('telefone_celular'),
                'email' => $request->input('email'),
                'observacoes' => $request->input('observacoes'),
                'data_nascimento' => $data_nascimento,
                'admissao' => $admissao,
            ]
        );

        if ($associado) {

            $endereco = Endereco::where('associado_id',$id)->first();
            //$endereco->associado_id = $id;
            $endereco->logradouro = $request->logradouro;
            $endereco->numero = $request->numero;
            $endereco->complemento = $request->complemento;
            $endereco->bairro = $request->bairro;
            $endereco->cep = $request->cep;
            $endereco->save();

            \session()->forget('associado_id');
            return redirect("associados/$id")->with('message', 'Associado atualizado com sucesso.');
        }
        return Redirect::back()->withErrors(['message', 'Erro ao atualizar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Associado $associado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Associado $associado)
    {
        if ($associado->delete()){
            return redirect(route('associados.index'))->with('message','Associado deletado com sucesso');
        } else {
            return back()->withInput()->withErrors('error','Associado não pode ser deletado');
        }
    }

    public function procurar()
    {
        return view('associados.procurar');
    }


    public function busca(BuscaAssociadoRequest $request)
    {
        $termo = $request->input('termo');
        $busca = $request->input('busca');
        $query = Associado::where($termo, 'LIKE', '%' . $busca . '%')->exists();
        //Se a query tiver resultado e o usuario for admin, retorna a view index de associados com os resultados obtidos da query
        if ($query) {
            $associados = Associado::with('endereco', 'dependente')
                ->where($termo, 'LIKE', '%' . $busca . '%')
                ->paginate(10);
            $request->session()->flash('message', 'Resultado da busca ' . 'Termo: ' . $termo . ' Valor: ' . $busca);
            return view('associados.resultado_busca')->with('associados', $associados);
        }else {
            return redirect('procurar')->withErrors('Nenhum associado encontrado com os termos fornecidos! ' . 'Termo: ' . $termo . ' Valor: ' . $busca);
        }

    }

    public function saveProfilePhoto(Request $request)
    {
        if ($request->has('foto')){

            $file = $request->file('foto');
            $ext = $file->guessClientExtension();

            $path = $file->storeAs('fotos', "{$request->cpf}.{$ext}");

            return $path;
        }

    }

    public function updateFoto(Request $request, $id)
    {
        $associado = Associado::find($id);
        $request->merge(['cpf' => $associado->cpf]);
        $path = $this->saveProfilePhoto($request);

        $associado->foto = $path;
        if ($associado->save()) {
            return redirect('associados/' . $associado->id)->with('message', 'Foto adicionada com sucesso.');
        }

    }

    public function exportarCsv(Request $request)
    {

        $associados = Associado::with('endereco')->orderBy('nome_completo','asc')->get();
        $fields = [
            'nome_completo' => 'Nome Completo',
            'cpf' => 'CPF',
            'data_nascimento' => 'Data de nascimento',
            'endereco.logradouro' => 'Logradouro',
            'endereco.numero' => 'Número',
            'endereco.bairro' => 'Bairro',
            'endereco.complemento' => 'Complemento',
            'endereco.cep' => 'CEP',
            'status' => 'Status'
        ];
        $csvExporter = new Export();
        $csvExporter->beforeEach(function ($associado) {
            if ($associado->status == 0){
                $associado->status = 'INADIMPLENTE';
            } else {
                $associado->status = 'ADIMPLENTE';
            }
        });
        $csvExporter->build($associados,$fields)->download();

    }

    public function associadosData()
    {
        $associado = Associado::get();

        return DataTables::of($associado)
            ->addColumn('action', function ($associado) {
                return '
                <a href="associados/'.$associado->id.'" class="btn btn-xs btn-flat btn-primary"><i class="fa fa-eye"></i> Exibir</a>
                <a href="associados/'.$associado->id.'/edit" class="btn btn-xs btn-flat btn-primary"><i class="fa fa-edit"></i> Editar</a>
                <a href="pagamentos/'.$associado->id.'" class="btn btn-xs btn-flat btn-primary"><i class="fa fa-dollar"></i> Pagamentos</a>
                        ';
            })
            ->addColumn('data_nascimento',function ($associado) {
                return Carbon::parse($associado->data_nascimento)->format('d/m/Y');
            })
            ->addColumn('status',function ($associado) {
                if ($associado->status == 1){
                    return 'ADIMPLENTE';
                }else{
                    return 'INADIMPLENTE';
                }
            })
            ->make(true);
    }

    public function link($associado_id)
    {
        return view('associados.link_parent')->with(compact('associado_id'));
    }

    public function link_save(Request $request)
    {
        $associado = Associado::where('id',$request->associado_id)->first();
        $associado->parent_id = $request->parent_id;
        $associado->save();
        return redirect('associados/' . $associado->id)->with('message', 'Associado linkado com sucesso!');

    }

    /**
     * Return result to populate select2
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function associado_load_select2(Request $request)
    {

        $search = $request->get('search');
        $data = Associado::where('nome_completo', 'like', '%' . $search . '%')
            ->select('nome_completo','id')
            ->paginate(5);
        return response()->json(['items' => $data->toArray()['data'], 'pagination' => $data->nextPageUrl() ? true : false]);
    }


    public function CriacaoUsuariosLegado()
    {
        $associados = Associado::all();
        foreach ($associados as $associado){
            $cpf = $this->associado->limparCpfUsuario($associado->cpf);
            $user = $this->associado->criarUsername($cpf);
            $user->attachRole('associado');
            $associado->user_id = $user->id;
            $associado->save();
        }
        return redirect('/')->with('message','Usuarios criados com sucesso');
    }

    public function regularizar_situacao(Request $request)
    {
        $associado = $request->user()->associado;
        return view('associados.regularizar_situacao')->with(compact('associado'));
    }

    public function updateCellphone(Request $request, $associado_id)
    {
        $associado = Associado::findOrFail($associado_id);
        $this->associado->updateCellphone($request, $associado);
        \session()->forget('associado_id');
        return back()->with('message','Telefone cadastrado!');
    }

}