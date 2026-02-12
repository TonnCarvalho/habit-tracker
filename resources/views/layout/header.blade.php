<header class="bg-white border-b-2 p-4 ">
    <div class="max-w-7xl mx-auto flex  justify-between items-center">
        <div class="flex gap-2 items-center">
            <a class="habit-btn habit-shadow bg-habit-orange" href="{{ route('habits.index') }}">
                HT
            </a>
            <p>
                Habit Tracker
            </p>
        </div>
        @guest
            <div class="flex gap-2 items-center">
                <a class="text-orange-700 habit-btn" href="https://github.com/TonnCarvalho/habit-tracker" target="_blank"
                    rel="noopener noreferrer">
                    <x-icons.github />
                </a>
                <a class="bg-white habit-shadow border-2 p-2" href="{{ route('login.index') }}">
                    Cadastrar
                </a>

                <a class="bg-habit-orange habit-shadow border-2 p-2" href="{{ route('login.index') }}">
                    Login
                </a>
            </div>
        @endguest

        @auth
            <form class="inline" action="{{ route('login.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-white habit-shadow habit-btn p-2">Sair</button>
            </form>
        @endauth
    </div>
</header>
