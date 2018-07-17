<?php

namespace App\Http\Controllers;

use App\Associado;
use App\Dependente;
use App\Endereco;
use App\Http\Requests\StoreAssociadoRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Auth;

class AssociadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $associados = Associado::paginate(10);

        return view('associados.index')->with('associados', $associados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('associados.create_update');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssociadoRequest $request)
    {
        $input = $request->all();

        $dependente_nascimento_carbon = [];
        if (is_array($input['dependentes']['data_nascimento'])) {
            $dependente_nascimento = $input['dependentes']['data_nascimento'];
            foreach (array_filter($dependente_nascimento) as $data => $value) {
                $data = Carbon::now()
                    ->createFromFormat('d/m/Y', $value)
                    ->toDateString();
                $dependente_nascimento_carbon[] = $data;
            }
        }


        $foto[] = null;
        $foto['foto'] = $this->saveProfilePhoto($request);


        $datas = [
            'data_nascimento' => Carbon::now()
                ->createFromFormat('d/m/Y', $request->get('data_nascimento'))
                ->toDateString(),
            'admissao' => Carbon::now()
                ->createFromFormat('d/m/Y', $request->get('admissao'))
                ->toDateString(),
        ];

        $associado = Associado::create(array_merge($request->all(), $datas, $foto));


        if ($associado) {
            $tamanho_array = count(array_filter($request['dependentes']['nome_dependente']));
            for ($i = 0; $i < $tamanho_array; $i++) {
                $dependente = new Dependente();
                $dependente->associado_id = $associado->id;
                $dependente->nome_dependente = $input['dependentes']['nome_dependente'][$i];
                $dependente->cpf = $input['dependentes']['cpf'][$i];
                $dependente->grau_parentesco = $input['dependentes']['grau_parentesco'][$i];
                $dependente->data_nascimento = $dependente_nascimento_carbon[$i];
                $dependente->save();
            }
            $endereco = new Endereco();
            $endereco->associado_id = $associado->id;
            $endereco->logradouro = $request->logradouro;
            $endereco->numero = $request->numero;
            $endereco->complemento = $request->complemento;
            $endereco->bairro = $request->bairro;
            $endereco->cep = $request->cep;
            $endereco->save();

            return redirect('associados/')->with('message', 'Associado cadastrado com sucesso.');
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
        return view('associados.show')->with(compact('associado', $associado));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Associado $associado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $associado = Associado::with('dependente')->find($id);
        return view('associados.create_update')->with(compact('associado', $associado));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Associado $associado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $associado = Associado::with(['dependente'])->findOrFail($id);

        $rules = [
            'nome_completo' => 'required',
            'nome_mae' => 'required',
            'email' => 'email|required'
        ];
        $mensagemCustomizada = ['required' => 'O campo :attribute é obrigatório.'];
        $this->validate($request, $rules, $mensagemCustomizada);

        $input = $request->all();

        $dependente_nascimento_carbon = [];
        if (is_array($input['dependentes']['data_nascimento'])) {
            $dependente_nascimento = $input['dependentes']['data_nascimento'];
            foreach (array_filter($dependente_nascimento) as $data => $value) {
                $data = Carbon::now()
                    ->createFromFormat('d/m/Y', $value)
                    ->toDateString();
                $dependente_nascimento_carbon[] = $data;
            }
        }

        $associado->id = $id;
        $associado->matricula = $request->input('matricula');
        $associado->graduacao = $request->input('graduacao');
        $associado->classe = $request->input('classe');
        $associado->nome_completo = $request->input('nome_completo');
        $associado->nome_mae = $request->input('nome_mae');
        $associado->nome_pai = $request->input('nome_pai');
        $associado->naturalidade = $request->input('naturalidade');
        $associado->estado_civil = $request->input('estado_civil');
        $associado->cpf = $request->input('cpf');
        $associado->telefone_trabalho = $request->input('telefone_trabalho');
        $associado->telefone_casa = $request->input('telefone_casa');
        $associado->telefone_celular = $request->input('telefone_celular');
        $associado->email = $request->input('email');
        $associado->observacoes = $request->input('observacoes');
        $associado->data_nascimento = $request->input('data_nascimento');
        $associado->admissao = $request->input('admissao');
        //$associado->data_nascimento = Carbon::parse($request->input('data_nascimento')->format('Y-m-d'));
        //$associado->admissao = Carbon::parse($request->input('admissao')->format('Y-m-d'));
        /*
        $associado->data_nascimento = Carbon::now()
            ->createFromFormat('d/m/Y',$request->get('data_nascimento'));
        $associado->admissao = Carbon::now()
            ->createFromFormat('d/m/Y',$request->get('admissao'));
        */
        $associado->save();

        if ($associado) {
            $tamanho_array = count(array_filter($request['dependentes']['nome_dependente']));
            for ($i = 0; $i < $tamanho_array; $i++) {
                $dependente = new Dependente();
                $dependente->associado_id = $associado->id;
                $dependente->nome_dependente = $input['dependentes']['nome_dependente'][$i];
                $dependente->cpf = $input['dependentes']['cpf'][$i];
                $dependente->grau_parentesco = $input['dependentes']['grau_parentesco'][$i];
                $dependente->data_nascimento = $dependente_nascimento_carbon[$i];
                $dependente->save();
            }
            $endereco = new Endereco();
            $endereco->associado_id = $associado->id;
            $endereco->logradouro = $request->logradouro;
            $endereco->numero = $request->numero;
            $endereco->complemento = $request->complemento;
            $endereco->bairro = $request->bairro;
            $endereco->cep = $request->cep;
            $endereco->save();

            return redirect('associados/')->with('message', 'Associado atualizado com sucesso.');
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
        //
    }

    public function procurar()
    {
        return view('associados.procurar');
    }



    public function busca(Request $request)
    {
        $data[] = null;
        $termo_busca = $request->input('busca');
        $query = Associado::where('nome_completo', 'LIKE', '%'.$termo_busca.'%')->exists();
        if ($query) {


            $id = Associado::with('endereco', 'dependente')
                ->where('nome_completo', 'LIKE', '%'.$termo_busca.'%')
                ->first();

            return redirect()->route('associados.show', $id->id);

        } else {
            return redirect()->back();
        }

    }

    public function saveProfilePhoto(Request $request)
    {
        $file = $request->file('foto');
        $ext = $file->guessClientExtension();

        $path = $file->storeAs('fotos',"{$request->cpf}.{$ext}");

        return $path;

    }
}