@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <div class="container">
        <div class="py-4 text-center">
        <img src="{{ asset('img/logo.svg') }}" alt="">
        </div>
        <div class="row">
                <div class="col-md-12">
                    <h2 class="card-title">Cadastro de Sorteios</h2>
                    <p class="card-text">
                        Crie um Amigo Secreto e convide seus amigos a participar ou <br>
                        Inscreva-se e participe de um Amigo Secreto criado por outra pessoa.
                    </p>
                    <a href="/grupoSorteio" class="btn btn-lg btn-block btn-primary">Acessar</a>
                </div>
        </div>
    </div>
</div>
@endsection