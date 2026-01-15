@extends('layout.layout')
@section('content')
    <main class="py-5">
        <section>
            <form action="{{ route('login.autenticate') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Email" class="bg-white p-2 border-2">

                <input type="password" name="password" placeholder="*******" class="bg-white p-2 border-2">

                <button type="submit" class="bg-white border-2 p-2">Entrar</button>
            </form>
            
            <div>
                @error('email')
                <p class="text-red-500 p-2">
                    {{ $message }}
                </p>
                @enderror
            </div>
        </section>
    </main>
@endsection
