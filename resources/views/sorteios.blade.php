<link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet">

@extends('layouts.app')

@section('content')
<div class="container" style="width: 100%;">
    <div class="py-6 text-center">
        @if(session()->get('danger'))
            <div class="alert alert-danger">
                {{ session()->get('danger') }}
            </div><br />
        @elseif(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif        
            <table class="table table-sm" style="margin-top: 100px">
                <thead>
                </thead>
                <tbody>
                </tbody>
              </table>
            <h5 class="card-title" style="text-align: center; font-family: Rancho; font-size:40px; font-weight: bolder" >Cadastro de Sorteios</h5>
            <img src="{{asset('img/guido.png')}}" style="width: 150px">    
            <table class="table table-ordered table-hover" id="tabelaSorteios" style="border: 3px solid black; background-color :white; margin-top:50px; border-radius: 10px">
                    <thead>
                        <tr>
                            <th>Data da brincadeira</th>
                            <th>Mínimo valor</th>
                            <th>Máximo valor</th>
                            <th>Autor:</th>
                            <th style="text-align:center" colspan="5">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($array as $item)
                        <tr>
                            <td>{{ $item->dataSorteio }}</td>
                            <td> R$ {{ $item->valorMinimo }}</td>
                            <td> R$ {{ $item->valorMaximo }}</td>
                            <td>{{ $item->User->name }}</td>
                            @if($item->User->id == Auth::id())
                                <td style="text-align:center">
                                    <a href="/grupoSorteio/editar/{{$item->id}}" class="btn btn-primary" style="background-color:green; color:white; border-color:green">Editar</a>
                                </td>
                                <td style="text-align:center">
                                    <a href="/grupoSorteio/apagar/{{$item->id}}" class="btn btn-danger" style="background-color:green; color:white; border-color:green">Apagar</a>
                                </td>
                                @if($item->sorteioRealizado == 0)
                                    @if($item->totalMembros > 2)
                                        <td style="text-align:center">
                                            <a href="/grupoSorteio/sortear/{{$item->id}}" class="btn btn-primary">Sortear</a>
                                        </td>
                                    @endif
                                @else 
                                    <td style="text-align:center">
                                        <a href="/grupoSorteio/deletarSorteio/{{$item->id}}" class="btn btn-primary">Desfazer Sorteio</a>
                                    </td>
                                @endif 
                            @endif
                            @if($item->sorteioRealizado == 0)
                                    <td style="text-align:center">
                                        <a href="/membro/inscrever/{{$item->id}}" class="btn btn-success" style="background-color:green; color:white">Inscrever</a>
                                    </td>
                            @else 
                                @if($item->souMembro == 1)
                                    <td style="text-align:center">
                                        <a href="/membro/verAmigo/{{$item->id}}" class="btn btn-success">Ver Amigo Secreto</a>
                                    </td>
                                @endif
                            @endif
                            <td style="text-align:center">
                                    <a href="/membro/{{$item->id}}" class="btn btn-info " style="background-color:green; color:white; border-color:green" >Amigos</a>
                            </td>
                        </tr>  
                        @endforeach
                    </tbody>
                </table>
        </div>
        <div class="card-footer">
            <a href="/grupoSorteio/novo" class="btn btn-primary btn-sm" role="button">Novo Sorteio</a>
            <a href="/home" class="btn btn-primary btn-sm" role="button">Voltar</a>
        </div>
    </div>
@endsection