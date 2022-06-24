<?php

namespace App\Http\Controllers;

use App\Associado;
use App\Http\Requests\StorePagamentoRequest;
use App\Pagamento;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($associado_id)
    {
        return view('pagamentos.create')->with('associado_id',$associado_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePagamentoRequest $request, $associado_id)
    {
        $pagamentos = Pagamento::where('associado_id',$associado_id)->get();

        foreach ($pagamentos as $pagamento){
            if ($request->input('ano')===$pagamento->ano){
                return back()->with('message','Este ano já está cadastrado, escolha outro!');
            }
        }
        $pagamento = Pagamento::create($request->all());
        return redirect('pagamentos/edit/'.$pagamento->id)->with('message','Histórico cadastrado');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pagamento  $pagamento
     * @return \Illuminate\Http\Response
     */
    public function show($associado_id)
    {

        $associado = Associado::find($associado_id);
        $pagamentos = Pagamento::where('associado_id', $associado_id)->orderBy('ano','ASC')->get();
        return view('pagamentos.show')->with(compact('pagamentos','associado_id','associado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pagamento  $pagamento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pagamento = Pagamento::find($id);
        return view('pagamentos.edit')->with(compact('pagamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pagamento  $pagamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $pagamento = Pagamento::with('associado')->findOrFail($id);
        $pagamento->id = $id;
        $pagamento->janeiro = $request->janeiro == '0.00' ? null : $request->janeiro;
        $pagamento->fevereiro = $request->fevereiro == '0.00' ? null : $request->fevereiro;
        $pagamento->marco = $request->marco == '0.00' ? null : $request->marco;
        $pagamento->abril = $request->abril == '0.00' ? null : $request->abril;
        $pagamento->maio = $request->maio == '0.00' ? null : $request->maio;
        $pagamento->junho = $request->junho == '0.00' ? null : $request->junho;
        $pagamento->julho = $request->julho == '0.00' ? null : $request->julho;
        $pagamento->agosto = $request->agosto == '0.00' ? null : $request->agosto;
        $pagamento->setembro = $request->setembro == '0.00' ? null : $request->setembro;
        $pagamento->outubro = $request->outubro == '0.00' ? null : $request->outubro;
        $pagamento->novembro = $request->novembro == '0.00' ? null : $request->novembro;
        $pagamento->dezembro = $request->dezembro == '0.00' ? null : $request->dezembro;

        //Atualiza os dados
        if($pagamento->save()){
            return redirect('pagamentos/'.$pagamento->associado->id)->with('message','Histórico atualizado com sucesso!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pagamento  $pagamento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pagamento = Pagamento::findOrFail($id);
        $pagamento->delete();

        return back()->with('message','Histórico pagamento deletado com sucesso!');
    }
}
