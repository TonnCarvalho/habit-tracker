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

    <h2 class="text-xl mt-8 mb-4">
        {{ date('d/m/Y') }}
    </h2>

    <ul class="flex flex-col gap-2">
        @forelse ($habits as $habit)
            @php
                $wasCompetedToday = $habit->habitsLogs
                    ->where('user_id', auth()->id())
                    ->where('completed_at', now()->format('Y-m-d'))
                    ->isNotEmpty();
            @endphp
            <li class="habit-shadow p-2 bg-[#FFDAAC]">
                <div class="flex gap-2 items-center">

                    <form action="{{ route('habits.toggle', $habit->id) }}" class="flex gap-2 items-center" method="post"
                        id="form-{{ $habit->id }}">
                        @csrf
                        <input type="checkbox" class=" w-5 h-5" {{ $wasCompetedToday ? 'checked' : '' }}
                            onchange="document.getElementById('form-{{ $habit->id }}').submit()" />

                        <p class="font-bold text-xl">
                            {{ $habit->name }}
                        </p>
                    </form>

                </div>
            </li>
        @empty
            <p>
                Ainda não possui habitos
            </p>
            <a href="" class="bg-white p-2 border-2">Cadastra</a>
        @endforelse
    </ul>
@endsection

{{-- <a class="text-blue-500 hover:opacity-50" href="{{ route('habits.edit', $habit->id) }}">
    <x-icons.pencil />
</a>
<form action="{{ route('habits.destroy', $habit->id) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit" class=" text-red-500 p-1 hover:opacity-50 cursor-pointer">
        <x-icons.trash />
    </button>
</form> --}}
