<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Participante;
use App\Models\GrupoSorteio;
use App\Models\AmigoSecreto;
use App\Models\User;

class ParticipanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index($id)
    {
        $dados = Participante::where('grupoSorteio_id', '=', $id)->with('User')->get();
        if(isset($dados))
            return view('listaParticipantes', compact('dados'));
        return redirect('/grupoSorteio');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $verifica = Participante::where('user_id', '=', Auth::id())->where('grupoSorteio_id', '=', $id)->first();
        if(isset($verifica)){
            return redirect('/grupoSorteio')->with('danger', 'Você já está inscrito neste sorteio!!');
        }else{
            $dados = GrupoSorteio::find($id);
            if(isset($dados))
                return view('novaInscricao', compact('dados'));
            return redirect('/grupoSorteio');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $dados = new Participante();
        $dados->dicaPresente = $request->input('dicaPresente');
        $dados->user_id = Auth::id();
        $dados->grupoSorteio_id = $id;
        $dados->save();
        return redirect('/grupoSorteio')->with('success', 'Inscrição realizada com sucesso!!');
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
        $dados = Participante::find($id);
        if(isset($dados))
            return view('editarPresente', compact('dados'));
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
        $dados = Participante::find($id);
        if(isset($dados)){
            $dados->dicaPresente = $request->input('dicaPresente');
            $dados->save();
            return redirect('/grupoSorteio')->with('success', 'atualização realizada com sucesso!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dados = Participante::find($id);
        if(isset($dados))
            $dados->delete();
        return redirect('/grupoSorteio');
    }

    public function verAmigo($id){
        $dados = AmigoSecreto::where('grupoSorteio_id', '=', $id)->where('participante_id', '=', Auth::id())->first();
        $participante = Participante::find($dados->participanteSorteado_id);
        $amigo = User::find($participante->user_id);
        
        return view('verAmigo', compact('amigo'));
    }
}