<?php

namespace App\Http\Controllers;

use App\Associado;
use App\Dependente;
use App\Endereco;
use App\Http\Requests\BuscaAssociadoRequest;
use App\Http\Requests\StoreAssociadoRequest;
use App\Http\Requests\UpdateAssociadoRequest;
use App\Report;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Laracsv\Export;

class AssociadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        return view('associados.index', compact('graficoClasseAssociado'));



    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('associados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
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


            return redirect("associados/$associado->id")->with('message', 'Associado cadastrado com sucesso.');
        }
        return Redirect::back()->withErrors(['message', 'Erro ao cadastrar']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Associado $associado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $associado = Associado::find($id);
        $dependentes = Dependente::where([
            ['associado_id', '=', $id],
            ['status','=','1']
        ])->get();
        //dd($dependente);
        return view('associados.show')->with(compact('associado', $associado,'dependentes',$dependentes));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Associado $associado
     * @return \Illuminate\Http\Response
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
     * @param  \App\Associado $associado
     * @return \Illuminate\Http\Response
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

        Report::displayReport($request);
        /*
        $associados = Associado::with('endereco')->orderBy('nome_completo','asc')->get();
        $fields = [
            'nome_completo' => 'Nome Completo',
            'endereco.logradouro' => 'Logradouro',
            'endereco.numero' => 'Número',
            'endereco.bairro' => 'Bairro',
            'endereco.complemento' => 'Complemento',
            'endereco.cep' => 'CEP'
        ];
        $csvExporter = new Export();
        //$csvExporter->beforeEach(function ($associado) {
        //    $associado->endereco->logradouro;
        //});
        $csvExporter->build($associados,$fields)->download();
        */
    }
}