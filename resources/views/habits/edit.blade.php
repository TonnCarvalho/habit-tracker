@extends('layout.layout')
@section('content')
    <h1>Editar hábito</h1>
    <section class="bg-white max-w-[600px] mx-auto p-10 pb-6 border-2 mt-4 ">
        <form action="{{ route('habits.update', $habit->id) }}" method="POST">
            @csrf
            @method('patch')
            <div class="flex flex-col gap-2 mb-2">
                <label for="name">
                    Nome do hábito
                </label>
                <input type="text" type="text" name="name" placeholder="Hábito" value="{{ old('name', $habit->name) }}"
                    class="bg-white p-2 border-2 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm">
                        {{ $message }}
                    </p>
                @enderror
                <button class="bg-white border-2 p-2" type="submit">Editar</button>
            </div>
        </form>
    </section>
@endsection
