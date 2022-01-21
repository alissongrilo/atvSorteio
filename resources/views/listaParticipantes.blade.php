<link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet">

@extends('layouts.app')

@section('content')
<div class="container" style="border: 3px solid black; background-color :white; margin-top:50px; border-radius: 10px">
    <div class="py-5 text-center">
            <table class="table table-sm">
                <thead>
                  <tr>
                    <th style="text-align:left;width: 50px" scope="col"><img src="{{ asset('img/foto.svg') }}" alt=""></th>
                    <th style= "font-family: Rancho; font-size:30px; font-weight: bolder"><class="card-title">⠀⠀⠀Participantes do Amigo Secreto</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
                <table class="table table-ordered table-hover" id="tabelaParticipantes">
                    <thead>
                        <tr>
                            <th>Participante</th>
                            <th>Dica de presente</th>
                            <th style="text-align:center" colspan="2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dados as $item)
                        <tr>
                            <td>{{ $item->User->name }}</td>
                            <td>{{ $item->dicaPresente }}</td>
                            @if($item->User->id == Auth::id())
                                <td style="text-align:center">
                                    <a href="/participante/editar/{{$item->id}}" class="btn btn-primary" style="background-color: green; border-color: green">Editar dica</a>
                                </td>
                                <td style="text-align:center">
                                    <a href="/participante/apagar/{{$item->id}}" class="btn btn-danger">Sair do sorteio</a>
                                </td>
                            @endif
                        </tr>  
                        @endforeach
                    </tbody>
                </table>
        </div>
        <div class="card-footer">
            <a href="/grupoSorteio" class="btn btn-primary btn-sm" role="button">Voltar</a>
        </div>
    </div>
@endsection