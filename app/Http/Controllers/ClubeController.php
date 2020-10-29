<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Clube;

class ClubeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clube = new Clube();
        
        $clubes =  Clube::All();
        return view("clube.index",[
            "clube" => $clube,
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
            "foto"=> "image"
        ],[
            "*.required"=>"(:attribute) é obrigatório!",
            "foto.image" => "Deve ser salva apenas uma imagem!"
        ]);

        if ($request->get("id") ==""){
            $clube = new Clube();
        }else
        {
            $clube = Clube::find($request->get("id"));
        }

        if($request->file("foto") != "")
        {
            $clube->foto = $request->file("foto")->store("public");
            $clube->foto = explode("/",$clube->foto)[1];
            
        }
        
        $clube->nome = $request->get("nome");
        $clube->save();

        $request->Session()->flash("salvar","Clube salvo com sucesso!");
		return redirect("/clube");

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
        $clubes = Clube::All();
        $clube = Clube::find($id);
        return view ("clube.index",[
            "clube"=>$clube,
            "clubes"=>$clubes
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
        Clube::destroy($id);
        $request->Session()->flash("excluir","Clube excluido com sucesso!");
        return redirect("/clube");
    }
}
