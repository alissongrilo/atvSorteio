<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GrupoSorteio;
use App\Models\Participante;
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
        $dados = GrupoSorteio::with('User')->get();
        foreach($dados as $item){
            $item->totalParticipantes = Participante::where('grupoSorteio_id', '=', $item->id)->count();
            $sorteio = AmigoSecreto::where('grupoSorteio_id', '=', $item->id)->first();
            if(isset($sorteio))
                $item->sorteioRealizado = 1;
            else 
                $item->sorteioRealizado = 0;
            $participante = AmigoSecreto::where('participante_id', '=', Auth::id())->where('grupoSorteio_id', '=', $item->id)->first();
            if(isset($participante))
                $item->souParticipante = 1;
            else{
                $item->souParticipante = 0;
            }
        }
        return view('sorteios', compact('dados'));
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
        $dados = new GrupoSorteio();
        $dados->user_id = Auth::id();
        $dados->dataSorteio = $request->input('dataSorteio');
        $dados->vrMinimo = $request->input('vrMinimo');
        $dados->vrMaximo = $request->input('vrMaximo');
        $dados->save();
        return redirect()->action(
            [ParticipanteController::class, 'create'], ['id' => $dados->id]
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
        $dados = GrupoSorteio::find($id);
        if(isset($dados))
            return view('editarSorteio', compact('dados'));
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
        $dados = GrupoSorteio::find($id);
        if(isset($dados)){
            $dados->user_id = Auth::id();
            $dados->dataSorteio = $request->input('dataSorteio');
            $dados->vrMinimo = $request->input('vrMinimo');
            $dados->vrMaximo = $request->input('vrMaximo');
            $dados->save();
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
        $dados = GrupoSorteio::find($id);
        if(isset($dados))
            $dados->delete();
        return redirect('/grupoSorteio');   
    }
    
    public function sortear($id){
        $dados = Participante::where('grupoSorteio_id', '=', $id)->with('User')->get();
        $quantidade = Participante::where('grupoSorteio_id', '=', $id)->count();

        foreach($dados as $item){
            $item->sorteado = 0;
            $item->amigo = NULL;
        }

        for($i = 0; $i < $quantidade; $i++){
            do{
                $n = rand(0, $quantidade-1);
            }while(($dados[$n]->sorteado != 0) or ($n == $i));
            $dados[$n]->sorteado = 1;
            $dados[$i]->amigo = $dados[$n]->User->id;

        }

        foreach($dados as $item){
            //echo "id participante: " . $item->id . " | seu user_id: " . $item->User->id . " | Amigo secreto: " . $item->amigo . " | Grupo Sorteio: " . $item->grupoSorteio_id . "<br>";            
            $r = new AmigoSecreto();
            $r->participante_id = $item->id;
            $r->participanteSorteado_id = $item->amigo;
            $r->grupoSorteio_id = $item->grupoSorteio_id;
            $r->save();
            
        }
        
        return redirect('/grupoSorteio')->with('success', 'Sorteio realizado com sucesso!!');
        
        
    }

    public function deletarSorteio($id){
        $dados = AmigoSecreto::where('grupoSorteio_id', '=', $id)->get();
        foreach($dados as $item)
            $item->delete();
        return redirect('/grupoSorteio');
    }

}