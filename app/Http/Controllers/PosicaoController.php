<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Posicao;

class PosicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posicao = new Posicao();
        
        $posicoes = Posicao::All();
        return view("posicao.index",[
            "posicao" => $posicao,
            "posicoes" => $posicoes                
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validacao = $request->validate([
            "descricao"=>"required",
        ],[
            "*.required"=>"(:attribute) é obrigatório!"
        ]);

        if ($request->get("id") ==""){
            $posicao = new Posicao();
        }else
        {
            $posicao = Posicao::find($request->get("id"));
        }
        $posicao->descricao = $request->get("posicao");
        $posicao->save();

        $request->Session()->flash("salvar","Posição salva com sucesso!");
		return redirect("/posicao");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posicoes = Posicao::All();
        $posicao = Posicao::find($id);
        return view ("posicao.index",[
            "posicao"=>$posicao,
            "posicoes"=>$posicoes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Posicao::destroy($id);
        $request->Session()->flash("excluir","Posição excluida com sucesso!");
        return redirect("/posicao");
    }
}
