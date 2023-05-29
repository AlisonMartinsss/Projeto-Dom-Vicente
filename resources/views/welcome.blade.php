@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-column justify-content-center align-items-center flex-nowrap mt-5">
            @guest
                <h1>Bem-vindo ao aplicativo Dom Vicente</h1>
                <p>O aplicativo feito para você gerenciar o seu condomínio!</p>
                <img src="{{asset('img/login.png')}}" alt="Login" class="img_inicial">
            @endguest
            @auth
                <h1>Bem-vindo, {{Auth::user()->name}}</h1>
                <p>Gerencie o seu condomínio agora mesmo!</p>
                <img src="{{asset('img/bem_vindo.png')}}" alt="Bem Vindo" class="img_inicial">
            @endauth
        </div>
    </div>
@endsection
