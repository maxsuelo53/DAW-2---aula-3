<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jogador;
use App\Models\Posicao;
use App\Models\Clube;

class JogadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jogador = new Jogador();
        
        $jogadores = DB::table("jogador AS j")
                        ->join("posicao AS p","j.posicao", "=", "p.id")
                        ->join("clube AS c", "j.clube","=","c.id")
                        ->select("j.id","j.nome","p.descricao AS posicao","j.data_nascimento","c.nome AS clube")
                        ->get();

        $posicoes = Posicao::All();
        $clubes = Clube::All();
        return view("jogador.index",[
            "jogador" => $jogador,
            "jogadores" => $jogadores,
            "posicoes" => $posicoes,
            "clubes" => $clubes               
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
            "nome"=>"required",
            "data"=> "required",
            "posicao"=> "required",
            "clube"=> "required"
        ],[
            "*.required"=>"(:attribute) é obrigatório!"
        ]);

        if ($request->get("id") =="")
        {
            $jogador = new Jogador();
        }else
        {
            $jogador = Jogador::find($request->get("id"));
        }
        $jogador->nome = $request->get("nome");
        $jogador->data_nascimento = $request->get("data");
        $jogador->posicao= $request->get("posicao");
        $jogador->clube = $request->get("clube");
        $jogador->save();

        $request->Session()->flash("salvar","Jogador salvo com sucesso!");
		return redirect("/jogador");
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
        
        $jogadores = DB::table("jogador AS j")
                        ->join("posicao AS p","j.posicao", "=", "p.id")
                        ->join("clube AS c", "j.clube","=","c.id")
                        ->select("j.id","j.nome","p.descricao AS posicao","j.data_nascimento","c.nome AS clube")
                        ->get();

        $posicoes = Posicao::All();
        $clubes = Clube::All();
        $jogador = Jogador::find($id);
        return view ("jogador.index",[
            "jogador"=>$jogador,
            "posicoes" => $posicoes,
            "jogador"=>$jogadores,
            "clubes"=> $clubes
            
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
        Jogador::destroy($id);
        $request->Session()->flash("excluir","Jogador excluido com sucesso!");
        return redirect("/jogador");
    }
}
