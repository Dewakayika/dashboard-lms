<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous">
        
            <script src="https://cdn.tailwindcss.com"></script>

        {{-- @vite('resources/css/app.css') 
        @vite('resources/css/member.css') --}}
        <title>
            @yield('title')
        </title>

        <!------------CSS-------------->
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('main/css/style.css')}}"> --}}

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link
            rel="icon"
            href="https://cdn.discordapp.com/attachments/1018894859832148009/1025031221799043102/meals_on_wheels.png">
        <script src="https://kit.fontawesome.com/bf49ffd5fb.js" crossorigin="anonymous"></script>
        <script
            src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
            defer="defer"></script>
            <script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
        <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous">
                <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
        <link rel="icon" href="{{ url('images/padma-black.png') }}" type="image/png">

    </head>

    <body>  
        <!-- Option 1: Bootstrap Bundle with Popper -->


        <nav x-data="{ open: false }" class="relative w-full bg-black text-white">
            <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                <div class="flex items-center">
                    <a href="{{ url('/dashboard') }}" class="flex items-center">
                        <img src="{{ url('images/padma.png') }}" alt="" width="20" class="mr-2">
                        <p>Padma Learning Center</p>
                    </a>
                </div>

                <!-- Hamburger menu button -->
                <button
                    @click="open = !open"
                    class="lg:hidden focus:outline-none"
                    aria-label="Toggle navigation">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewbox="0 0 24 24"
                        stroke="currentColor">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Full-screen menu -->
                <div
                    x-show="open"
                    class="fixed inset-0 z-50 bg-black bg-opacity-90 flex flex-col items-center justify-center">
                    <button @click="open = false" class="absolute top-4 right-4 text-white">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8"
                            fill="none"
                            viewbox="0 0 24 24"
                            stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <div class="text-left space-y-6">
                        @if (Route::has('login')) @auth
                        <div x-data="{ userOpen: false }" class="relative">
                            <button @click="userOpen = !userOpen" class="text-2xl hover:text-gray-300">
                                {{ $internData->users->name }}
                            </button>
                            <div
                                class="mt-2 py-2">
                                <a href="#" class="text-2xl hover:text-gray-300">User</a>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="text-2xl hover:text-red-500 mt-2">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                        @else
                        <a href="{{ route('register') }}" class="block text-2xl hover:text-gray-300">Sign Up</a>
                        <a href="{{ route('login') }}" class="block text-2xl hover:text-gray-300">Sign In</a>
                        @endauth @endif
                    </div>
                </div>

                <!-- Desktop menu -->
                <div class="hidden lg:flex items-center space-x-6">
                    <a href="{{ url('/dashboard') }}" class="hover:text-gray-300">Dashboard</a>
                    @if (Route::has('login')) @auth
                    <div x-data="{ open: false }" class="relative">
                        <div class="flex gap-2 bg-gray-900 px-2 py-1 rounded">
                            <img src="{{ asset('storage/' .$internData->profile_photo) }}" alt="Profile" class="w-7 h-7 rounded-full object-cover">
                            <button
                                @click="open = !open"
                                class="flex items-center fw-bold space-x-2 hover:text-gray-300 focus:outline-none">
                                <span>{{ $internData->users->name }}</span>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewbox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                        <div
                            x-show="open"
                            @click.away="open = false"
                            class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Profile</a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button
                                    type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('register') }}" class="hover:text-gray-300">Sign Up</a>
                    <a href="{{ route('login') }}" class="hover:text-gray-300">Sign In</a>
                    @endauth @endif
                </div>
            </div>
        </nav>

        <!-- Content -->
        <section class="">
            <div>
                @yield('content')
            </div>
        </section>


    </body>


</html>