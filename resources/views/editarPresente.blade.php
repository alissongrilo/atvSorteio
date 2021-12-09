@extends('layouts.app')

@section('content')
<div class="container">
    <div class="py-5 text-center">
        <form action="/participante/atualizar/{{$dados->id}}" method="POST">
           @csrf
           <div class="form-group">
                <label for="dicaPresente">Dica de presente que gostaria de ganhar</label>
                <input type="text" class="form-control" name="dicaPresente" id="dicaPresenbte" value="{{$dados->dicaPresente}}">
            </div>
            
            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <button onclick="window.location.href='/grupoSorteio';" type="button" class="btn btn-danger btn-sm">Cancelar</button>
        </form>
    </div> 
</div> 
@endsection