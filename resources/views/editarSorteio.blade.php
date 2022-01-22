@extends('layouts.app')

@section('content')
<div class="container" style="border: 3px solid black; background-color :white; margin-top:50px; border-radius: 10px">
    <div class="py-5 text-center ">
        <form action="/grupoSorteio/{{$array->id}}" method="POST">
           @csrf
           <img src="{{asset('img/guido.png')}}" style="width: 150px">
           <div class="form-group">
                <label for="dataSorteio">Data de realização do Amigo Secreto</label>
                <input type="text" class="datepicker form-control" name="dataSorteio" id="dataSorteio" value="{{$array->dataSorteio}}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="valorMinimo">Valor mínimo: R$</label>
                <input type="number" class="form-control" name="valorMinimo" id="valorMinimo" value="{{$array->valorMinimo}}" step="0.01" min="1" max="100">
            </div>
            <div class="form-group">
                <label for="valorMaximo">Valor máximo: R$</label>
                <input type="number" class="form-control" name="valorMaximo" id="valorMaximo" value="{{$array->valorMaximo}}" step="0.01" min="1" max="1000">
            </div>
            <br>
            <button type="submit" class="btn btn-primary btn-sm" style="background-color: green; border-color: green">Salvar</button>
            <button onclick="window.location.href='/grupoSorteio';" type="button" class="btn btn-danger btn-sm">Cancelar</button>
        </form>
    </div> 
</div> 
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            language: "pt-BR",
            autoclose: true
        });
    });
  </script>
@endsection