@extends('layout.layout')
@section('content')
    <main class="py-5">
        Dashboard

        @auth
            <p>
                Bem vindo {{ auth()->user()->name }}
            </p>
        @endauth
    </main>
@endsection
