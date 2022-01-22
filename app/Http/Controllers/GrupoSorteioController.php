<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GrupoSorteio;
use App\Models\Membro;
use App\Models\AmigoSecreto;

class GrupoSorteioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $array = GrupoSorteio::with('User')->get();
        foreach($array as $item){
            $item->totalMembros = Membro::where('grupoSorteio_id', '=', $item->id)->count();
            $sorteio = AmigoSecreto::where('grupoSorteio_id', '=', $item->id)->first();
            if(isset($sorteio))
                $item->sorteioRealizado = 1;
            else 
                $item->sorteioRealizado = 0;
            $membro = AmigoSecreto::where('membro_id', '=', Auth::id())->where('grupoSorteio_id', '=', $item->id)->first();
            if(isset($membro))
                $item->souMembro = 1;
            else{
                $item->souMembro = 0;
            }
        }
        return view('sorteios', compact('array'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('novoSorteio');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $array = new GrupoSorteio();
        $array->user_id = Auth::id();
        $array->dataSorteio = $request->input('dataSorteio');
        $array->valorMinimo = $request->input('valorMinimo');
        $array->valorMaximo = $request->input('valorMaximo');
        $array->save();
        return redirect()->action(
            [MembroController::class, 'create'], ['id' => $array->id]
        );

        
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
        $array = GrupoSorteio::find($id);
        if(isset($array))
            return view('editarSorteio', compact('array'));
        return redirect('/grupoSorteio');
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
        $array = GrupoSorteio::find($id);
        if(isset($array)){
            $array->user_id = Auth::id();
            $array->dataSorteio = $request->input('dataSorteio');
            $array->valorMinimo = $request->input('valorMinimo');
            $array->valorMaximo = $request->input('valorMaximo');
            $array->save();
        }
        return redirect('/grupoSorteio');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $array = GrupoSorteio::find($id);
        if(isset($array))
            $array->delete();
        return redirect('/grupoSorteio');   
    }
    
    public function sortear($id){
        $array = Membro::where('grupoSorteio_id', '=', $id)->with('User')->get();
        $quantidade = Membro::where('grupoSorteio_id', '=', $id)->count();

        foreach($array as $item){
            $item->sorteado = 0;
            $item->amigo = NULL;
        }

        for($i = 0; $i < $quantidade; $i++){
            do{
                $n = rand(0, $quantidade-1);
            }while(($array[$n]->sorteado != 0) or ($n == $i));
            $array[$n]->sorteado = 1;
            $array[$i]->amigo = $array[$n]->User->id;

        }

        foreach($array as $item){
            //echo "id membro: " . $item->id . " | seu user_id: " . $item->User->id . " | Amigo secreto: " . $item->amigo . " | Grupo Sorteio: " . $item->grupoSorteio_id . "<br>";            
            $r = new AmigoSecreto();
            $r->membro_id = $item->id;
            $r->membroSorteado_id = $item->amigo;
            $r->grupoSorteio_id = $item->grupoSorteio_id;
            $r->save();
            
        }
        
        return redirect('/grupoSorteio')->with('success', 'Sorteio realizado com sucesso!!');
        
        
    }

    public function deletarSorteio($id){
        $array = AmigoSecreto::where('grupoSorteio_id', '=', $id)->get();
        foreach($array as $item)
            $item->delete();
        return redirect('/grupoSorteio');
    }

}