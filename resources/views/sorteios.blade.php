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
            <table class="table table-sm">
                <thead>
                  <tr>
                    <th style="text-align:left;width: 50px" scope="col"><img src="{{ asset('img/logo.svg') }}" alt=""></th>
                    <th style="text-align:center;width: 400px"scope="col"><h5 class="card-title">Amigo Secreto</h5> </th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            <h5 class="card-title" style="text-align: center">Cadastro de Sorteios</h5>
                <table class="table table-ordered table-hover" id="tabelaSorteios">
                    <thead>
                        <tr>
                            <th>Data do Sorteio</th>
                            <th>Valor mínimo</th>
                            <th>Valor máximo</th>
                            <th>criado por:</th>
                            <th style="text-align:center" colspan="5">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dados as $item)
                        <tr>
                            <td>{{ $item->dataSorteio }}</td>
                            <td> R$ {{ $item->vrMinimo }}</td>
                            <td> R$ {{ $item->vrMaximo }}</td>
                            <td>{{ $item->User->name }}</td>
                            @if($item->User->id == Auth::id())
                                <td style="text-align:center">
                                    <a href="/grupoSorteio/editar/{{$item->id}}" class="btn btn-primary">Editar</a>
                                </td>
                                <td style="text-align:center">
                                    <a href="/grupoSorteio/apagar/{{$item->id}}" class="btn btn-danger">Apagar</a>
                                </td>
                                @if($item->sorteioRealizado == 0)
                                    @if($item->totalParticipantes > 2)
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
                                        <a href="/participante/inscrever/{{$item->id}}" class="btn btn-success">Inscrever-se</a>
                                    </td>
                            @else 
                                @if($item->souParticipante == 1)
                                    <td style="text-align:center">
                                        <a href="/participante/verAmigo/{{$item->id}}" class="btn btn-success">Ver Amigo Secreto</a>
                                    </td>
                                @endif
                            @endif
                            <td style="text-align:center">
                                    <a href="/participante/{{$item->id}}" class="btn btn-info">Participantes</a>
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