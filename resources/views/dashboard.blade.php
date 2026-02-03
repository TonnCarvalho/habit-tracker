@extends('layout.layout')
@section('content')
    <main class="py-10">
        <h1 class="font-bold text-4xl text-center">
            Dashboard
        </h1>

        <a href="{{ route('habits.create') }}" class="p-2 border-2 bg-white font-bold">
            Cadastrar Hábito
        </a>

        @session('success')
            <p class="bg-green-100 text-green-700 border border-green-500 p-3 mt-4">
                {{ session('success') }}
            </p>
        @endsession

        <h2 class="text-xl mt-4">
            Listagem dos hábitos
        </h2>

        <ul class="flex flex-col gap-2">
            @forelse ($habits as $habit)
                <li class="pl-4">
                    <div class="flex gap-2 items-center">
                        <p class="font-bold text-xl">
                            - {{ $habit->name }}
                        </p>

                        <p>
                            [{{ $habit->habitsLogs->count() }}]
                        </p>
                    </div>
                </li>
            @empty
                <p>
                    Ainda não possui habitos
                </p>
                <a href="" class="bg-white p-2 border-2">Cadastra</a>
            @endforelse
        </ul>
    </main>
@endsection
