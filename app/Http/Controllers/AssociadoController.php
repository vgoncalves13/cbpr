<?php

namespace App\Http\Controllers;

use App\Associado;
use App\Dependente;
use App\Endereco;
use App\Http\Requests\BuscaAssociadoRequest;
use App\Http\Requests\StoreAssociadoRequest;
use App\Http\Requests\UpdateAssociadoRequest;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        //
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
            return view('associados.index')->with('associados', $associados);
        }else {
            return redirect('procurar')->withErrors('Nenhum associado encontrado com os termos fornecidos! ' . 'Termo: ' . $termo . ' Valor: ' . $busca);
        }

    }

    public function saveProfilePhoto(Request $request)
    {
        $file = $request->file('foto');
        $ext = $file->guessClientExtension();

        $path = $file->storeAs('fotos', "{$request->cpf}.{$ext}");

        return $path;

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
}