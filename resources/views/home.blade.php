@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <div class="container">
        <div class="py-4 text-center">
        <img src="{{ asset('img/logo.svg') }}" alt="">
        </div>
        <div class="row">
                <div class="col-md-12">
                    <center><img style="width:150px" src="{{ asset('img/amigo.png') }}"></center>
                    <br>
                    <center><a href="/grupoSorteio" class="btn btn-lg btn-block btn-primary">Acessar</a></center>
                </div>
        </div>
    </div>
</div>
@endsection