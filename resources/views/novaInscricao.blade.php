@extends('layouts.app')

@section('content')
<div class="container">
    <div class="py-5 text-center" style="border: 3px solid black; background-color :white; margin-top:50px; border-radius: 10px">
        <form action="/membro/{{$array->id}}" method="POST">
           @csrf
            <div class="form-group">
                <label for="dicaPresente" style="text-align: center; font-family: Rancho; font-size:30px; font-weight: bolder">Dica de presente</label>
                <input type="text" class="form-control" name="dicaPresente" id="dicaPresenbte" placeholder="Escreva sua dica">
            </div>
            
            <br>
            <button type="submit" class="btn btn-primary btn-sm" style="background-color: green; border-color:green">Salvar</button>
            <button onclick="window.location.href='/grupoSorteio';" type="button" class="btn btn-danger btn-sm">Cancelar</button>
        </form>
    </div> 
</div> 
@endsection