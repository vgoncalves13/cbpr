<?php

namespace App\Http\Controllers;

use App\Associado;
use App\AutoAssociado;
use App\Http\Requests\AutoAssociadoStore;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AutoAssociadoController extends Controller
{

    protected $associado;

    public function __construct(Associado $associado)
    {
        $this->associado = $associado;
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $associados = AutoAssociado::all();
        $unserialize_associados = array();
        foreach ($associados as $key => $associado) {
            $unserialize_associados[$key] = unserialize($associado->serialize_request);
            $unserialize_associados[$key]['created_at'] = $associado->created_at;
            $unserialize_associados[$key]['id'] = $associado->id;
        }
        return view('auto_associado.index')->with(compact('unserialize_associados'));

    }

    public function create()
    {
        return view('auto_associado.create');
    }

    public function store(AutoAssociadoStore $request)
    {
        $serialized_request['serialize_request'] = serialize($request->all());
        AutoAssociado::create($serialized_request);
        return redirect(route('auto_cadastro.create'))
            ->with('message', 'Cadastro realizado com sucesso. Em breve será contactado.');
    }

    public function show($id)
    {
        $auto_associado = AutoAssociado::findOrFail($id);
        $unserialize_associado = unserialize($auto_associado->serialize_request);
        $unserialize_associado['created_at'] = $auto_associado->created_at;
        $unserialize_associado['id'] = $auto_associado->id;
        return view('auto_associado.show')->with('associado', $unserialize_associado);
    }

    public function approve($id)
    {
        $auto_associado = AutoAssociado::findOrFail($id);
        $unserialize_request = unserialize($auto_associado->serialize_request);

        $data_nascimento = [
            'data_nascimento' => Carbon::now()
                ->createFromFormat('d/m/Y', $unserialize_request['data_nascimento'])
                ->toDateString(),
        ];
        $unserialize_request = array_merge($unserialize_request, $data_nascimento);

        $associado = Associado::create($unserialize_request);
        //Cria usuário e senha para associado acessar plataforma
        $user = $this->associado->criarUsername($unserialize_request['cpf']);
        $associado->user_id = $user->id;
        $associado->save();
        $associado->endereco()->create(unserialize($auto_associado->serialize_request));

        $auto_associado->delete();

        return redirect(route('associados.show',$associado->id))->with('message','Associado aprovado com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $auto_associado = AutoAssociado::findOrFail($id);
        $auto_associado->delete();
        return redirect(route('auto_cadastro.index'))->with('message','Associado apagado com sucesso!');
    }
}
