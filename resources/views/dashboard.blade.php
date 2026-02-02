@extends('layout.layout')
@section('content')
    <main class="py-5">
        <h1>
            Dashboard
        </h1>

        <p>
            Bem vindo {{ auth()->user()->name }}
        </p>

        <h2>
            Listagem dos habitos
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
