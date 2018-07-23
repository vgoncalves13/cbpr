<?php

namespace App\Http\Controllers;

use App\Associado;
use App\Dependente;
use App\Endereco;
use App\Http\Requests\StoreAssociadoRequest;
use App\Http\Requests\UpdateAssociadoRequest;
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
        $foto['foto'] = $this->saveProfilePhoto($request);


        $datas = [
            'data_nascimento' => Carbon::now()
                ->createFromFormat('d/m/Y', $request->get('data_nascimento'))
                ->toDateString(),
            'admissao' => Carbon::now()
                ->createFromFormat('d/m/Y', $request->get('admissao'))
                ->toDateString(),
        ];

        if($associado = Associado::create(array_merge($request->all(), $datas, $foto))){


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

        $input = $request->all();

        $data_nascimento =  Carbon::now()
            ->createFromFormat('d/m/Y', $request->input('data_nascimento'))
            ->toDateString();
        $admissao = Carbon::now()
                ->createFromFormat('d/m/Y', $request->input('admissao'))
                ->toDateString();


        //$associado->data_nascimento = Carbon::parse($request->input('data_nascimento'));
        //$associado->admissao = Carbon::parse($request->input('admissao'));

        //$associado->save();
        $associado->update(
            [
                'id' => $id,
                'matricula' => $request->input('matricula'),
                'graduacao' => $request->input('graduacao'),
                'classe' => $request->input('classe'),
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
                'admissao' => $admissao
            ]
        );

        if ($associado) {

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