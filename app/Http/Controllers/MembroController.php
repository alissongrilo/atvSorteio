<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Membro;
use App\Models\GrupoSorteio;
use App\Models\AmigoSecreto;
use App\Models\User;

class MembroController extends Controller
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
        $array = Membro::where('grupoSorteio_id', '=', $id)->with('User')->get();
        if(isset($array))
            return view('listaMembros', compact('array'));
        return redirect('/grupoSorteio');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $verifica = Membro::where('user_id', '=', Auth::id())->where('grupoSorteio_id', '=', $id)->first();
        if(isset($verifica)){
            return redirect('/grupoSorteio')->with('danger', 'Você já está inscrito neste sorteio!!');
        }else{
            $array = GrupoSorteio::find($id);
            if(isset($array))
                return view('novaInscricao', compact('array'));
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
        $array = new Membro();
        $array->dicaPresente = $request->input('dicaPresente');
        $array->user_id = Auth::id();
        $array->grupoSorteio_id = $id;
        $array->save();
        return redirect('/grupoSorteio')->with('success', 'Inscrição realizada!');
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
        $array = Membro::find($id);
        if(isset($array))
            return view('editarPresente', compact('array'));
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
        $array = Membro::find($id);
        if(isset($array)){
            $array->dicaPresente = $request->input('dicaPresente');
            $array->save();
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
        $array = Membro::find($id);
        if(isset($array))
            $array->delete();
        return redirect('/grupoSorteio');
    }

    public function verAmigo($id){
        $array = AmigoSecreto::where('grupoSorteio_id', '=', $id)->where('membro_id', '=', Auth::id())->first();
        $membro = Membro::find($array->membroSorteado_id);
        $amigo = User::find($membro->user_id);
        
        return view('verAmigo', compact('amigo'));
    }
}