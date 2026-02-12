<nav class="mb-10">
    <ul class="flex gap-2">
        <li>
            <a href="{{ route('habits.index') }}"
                class="{{ Route::is('habits.index') ? 'font-bold underline' : '' }} border-r-2 pr-2 border-habit-orange hover:underline">
                Hoje
            </a>
        </li>
        <li>
            <a href="{{ route('habits.history') }}"
                class="{{ Route::is('habits.history') ? 'font-bold underline' : '' }} border-r-2 pr-2 border-habit-orange hover:underline">
                Historico
            </a>
        </li>
        <li>
            <a href=""
                class="{{ Route::is('') ? 'font-bold underline' : '' }} border-r-2 pr-2 border-habit-orange hover:underline">
                Calendário
            </a>
        </li>
        <li>
            <a href="{{ route('habits.settings') }}"
                class="{{ Route::is('habits.settings') ? 'font-bold underline' : '' }} border-r-2 pr-2 border-habit-orange hover:underline">
                Gerenciar Hábitos
            </a>
        </li>
    </ul>
</nav>
