@extends('layout.layout')
@section('content')
    <main class="py-5">
        <section class="mx-auto bg-white max-w-[600px] p-10 pb-6 border-2">
            <h1 class="text-3xl font-bold">Logue</h1>
            <p>Insira seus dados para acessar</p>
            <form action="{{ route('login.autenticate') }}" method="POST" class="flex flex-col gap-2">
                @csrf

                <label for="email">Email</label>

                <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}"
                    class="bg-white p-2 habit-shadow
                    @error('email')
                    border-red-500
                    @enderror">
                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <label for="password">Senha</label>

                <input type="password" id="password" name="password" placeholder="*******"
                    class="bg-white p-2 habit-shadow @error('password')
                    border-red-500
                @enderror">
                @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <button type="submit" class="bg-habit-orange habit-shadow habit-btn">
                    Entrar
                </button>
            </form>

            <p class="mt-3 text-center">
                Ainda não tem uma conta?
                <a class="underline hover:opacity-50 transition" href="{{ route('register.index') }}">
                    Registre-se
                </a>
            </p>

        </section>
    </main>
@endsection
