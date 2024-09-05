@vite('resources/css/navbar.css')
@vite('resources/css/welcome.css')

<body>
    <header>
        @if (Route::has('login'))
            <nav>
                <div class="left-nav">
                    <a href="">Ini Logo</a>
                </div>
                <div class="right-nav">
                    <div class="menu">
                        <a href="#">Home</a>
                        <a href="#">Our Services</a>
                        <a href="#">Let's Talk</a>
                        <a href="#">Community</a>
                        <a href="#">Contact Us</a>
                    </div>
                    <div class="auth">
                        @auth
                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf 
                                <button type="submit" class="button">Logout</button>
                            </form>
                        @else
                            <p>{{Auth::check()}}</p>

                            <a href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                            @endif
                    </div>
                </div>
            </nav>
        @endif
        @endauth
</header>

<main>
    <div class="hero">
        <div class="hero-title">
            <p>your creative partner</p>
            <h1>simplify your messy technical production</h1>  
        </div>
        <div class="desc">
            <p>boost creative productivity: webtoons, video editing, social media</p>
        </div>
    </div>
</main>

</body>


<!-- @section('title')
    Meals on Wheels
@endsection
@vite('resources/css/welcome.css') -->
<!-- @vite('resources/css/flying.css') -->
<!-- <script src="{{ asset('js/components/welcome.js')}}"></script>

<style>
    .hiden{
    opacity: 0;
    filter: blur(5px);
    transform: translateX(-100%);
    transition: all 1.7s;
}

    .show{
        opacity: 1;
        filter: blur(0);
        transform: translateX(0);
    }
</style> -->
<!-- @extends('layouts.app')




