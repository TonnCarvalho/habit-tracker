@extends('layout.layout')
@section('content')
    <main class="py-5">
        Main

        @auth
            <p>
                Bem vindo {{ auth()->user()->name }}
            </p>
        @endauth
    </main>
@endsection
