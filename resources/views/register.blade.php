@extends('layout.layout')
@section('content')
    <main class="py-5">
        <section class="mx-auto bg-white max-w-[600px] p-10 pb-6 border-2">
            <h1 class="text-3xl font-bold">Registre-se</h1>
            <p>Preencha as informações para cadastrar seus habítos</p>
            <form action="{{ route('register.store') }}" method="POST" class="flex flex-col gap-2">
                @csrf

                <label for="name">Nome</label>

                <input type="name" id="name" name="name" placeholder="Seu nome" value="{{ old('name') }}"
                    class="bg-white p-2 border-2
                    @error('name')
                    border-red-500
                    @enderror">
                @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <label for="email">Email</label>

                <input type="email" id="email" name="email" placeholder="email@email.com.br"
                    value="{{ old('email') }}"
                    class="bg-white p-2 border-2
                    @error('email')
                    border-red-500
                    @enderror">
                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <label for="password">Senha</label>

                <input type="password" id="password" name="password" placeholder="*******"
                    class="bg-white p-2 border-2 @error('password')
                    border-red-500
                @enderror">
                @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <label for="password_confirmation">Confirmar senha</label>

                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="*******"
                    class="bg-white p-2 border-2 @error('password')
                    border-red-500
                @enderror">
                @error('password_confirmation')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <button type="submit" class=" bg-amber-500 border-2 p-2 cursor-pointer">Registrar</button>
            </form>

            <p class="mt-3 text-center">
                Já possui uma conta?
                <a class="underline hover:opacity-50 transition" href="{{ route('login.index') }}">
                    Fazer login
                </a>
            </p>

        </section>
    </main>
@endsection
