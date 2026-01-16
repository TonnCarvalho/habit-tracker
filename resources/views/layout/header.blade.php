<header class="bg-white border-b-2 flex justify-between items-center p-4">
    <div class="">
        logo
    </div>
    <div class="">
        GitHub

        @guest
            <a href="{{ route('login.index') }}" class="bg-white border-2 p-2">
                Login
            </a>
        @endguest

        @auth
            <form class="inline" action="{{ route('login.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-white border-2 p-2">Logout</button>
            </form>
        @endauth


    </div>
</header>
