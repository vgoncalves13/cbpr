<?php

namespace App\Http\Controllers;

use App\DependenteDeleteInfo;
use App\Http\Requests\DependenteDeleteInfoRequest;
use Illuminate\Http\Request;
use App\Dependente;
use PHPUnit\Framework\RiskyTestError;

class DependenteDeleteInfoController extends Controller
{

    public function index($id)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function store(DependenteDeleteInfoRequest $request)
    {
        $dependente_info = new DependenteDeleteInfo();
        $dependente_info->data_solicitacao = $request->data_solicitacao;
        $dependente_info->observacao = $request->observacao;
        $dependente_info->dependente_id = $request->dependente_id;
        $dependente_info->documento_comprovante = $path = $this->saveDoc($request->file('documento_comprovante'));

        if ($dependente_info->save()){
            return true;
        }
        return false;
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return boolean
     */
    public function excluir(DependenteDeleteInfoRequest $request, $dependente_id)
    {
        //Procura pelo dependente
        $dependente = Dependente::with('associado')->findOrFail($dependente_id);
        //Salva o id do associado atrelado ao dependente que queremos deletar para usar posteriormente no redirect da rota
        $associado_id = $dependente->associado->id;
        //Seta o valor da coluna status para 0 (desativado)
        $dependente->status = 0;
        //Salva o valor
        $dependente->save();

        //Se o campo for alterado com sucesso, registra as informações no banco
        if ($dependente){
            if ($this->store($request)){
                return redirect("associados/$associado_id")->with('message','Dependente desativado com sucesso!');
            }
        return false;

        }
    }

    public function saveDoc($documento)
    {

        //$ext = $documento->guessClientExtension();

        $path = $documento->store('documentos');

        return $path;

    }

    public function restaurar(Request $request, $dependente_id)
    {
        //Procura pelo dependente
        $dependente = Dependente::with('associado')->findOrFail($dependente_id);
        //Salva o id do associado atrelado ao dependente que queremos deletar para usar posteriormente no redirect da rota
        $associado_id = $dependente->associado->id;
        //Seta o valor da coluna status para 1 (ativado)
        $dependente->status = 1;
        //Salva o valor
        $dependente->save();

        $dependente_info = DependenteDeleteInfo::where('dependente_id', $dependente_id)->first();
        $dependente_info->delete();

        return redirect("associados/$associado_id")->with('message','Dependente restaurado com sucesso!');
    }

}
