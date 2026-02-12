@extends('layout.layout')
@section('content')

    <h1 class="font-bold text-4xl text-center">
        Hábitos
    </h1>

    <x-navbar-habits />

    {{-- Botão Cadastrar --}}

    {{-- <div class="mt-3">
            <a href="{{ route('habits.create') }}" class="p-2 border-2 bg-white font-bold">
                Cadastrar Hábito
            </a>
        </div> --}}

    @session('success')
        <p class="bg-green-100 text-green-700 border border-green-500 p-3 mt-4">
            {{ session('success') }}
        </p>
    @endsession

    {{-- Habit grid --}}
    <div>
        @forelse($habits as $habit)
            <x-contribution :$habit :year="$selectedYear" />
        @empty
            <div>
                <p class="text-black">
                    Nenhum hábito para exibir histórico.
                </p>
                <a href="{{ route('habits.create') }}" class="underline ">
                    Crie um novo hábito
                </a>
            </div>
        @endforelse
    </div>
@endsection