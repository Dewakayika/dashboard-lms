<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    @vite('resources/css/app.css')
    <title>
        @yield('title')
    </title>

    <!------------CSS-------------->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('main/css/style.css')}}"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon"
        href="https://cdn.discordapp.com/attachments/1018894859832148009/1025031221799043102/meals_on_wheels.png">
    <script src="https://kit.fontawesome.com/bf49ffd5fb.js" crossorigin="anonymous"></script>

</head>

<body>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    @include('sidebar.admin-sidebar')

    <div class="main-content">
        <section class="">
            <div>
                @yield('content')
            </div>
        </section>
    </div>











<!--
    <nav
        class="relative w-full flex flex-wrap py-4 bg-gray-10 text-gray-500 hover:text-gray-700 focus:text-gray-700 navbar navbar-expand-lg shadow-md">
        <div class="container w-full flex flex-wrap items-center justify-between">
            <div class="items-between gap-4 flex collapse navbar-collapse" id="navbarSupportedContent">
                <a href="/">
                    <img src="{{ url('images/logo.png') }}" alt="" srcset="" width="185px">
                </a>
                
                <div>
                </div>
                
            </div>
          

            <div class="items-between relative flex gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-700 ">Dashboard</a>
                
                        <div x-data="{ open: false }" class="">
                            <div @click="open = !open" class="relative border-b-2 pb-1 border-transparent z-50"
                                :class="{ 'border-mow-shine-yellow transform transition duration-300 ': open }"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100">
                                <div class="flex justify-center items-center space-x-3 font-semibold cursor-pointer">
                                    <div class="">
                                        <div class="cursor-pointer"><i class="fas fa-xl fa-user-alt"> &nbsp;
                                            </i>{{ $adminData->name }}</div>
                                    </div>
                                </div>
                                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="absolute w-48 py-3 bg-white -ml-4 rounded-md shadow border mt-2">
                                    <ul class="space-y-3 px-3 text-slate-700">
                                        <li class="font-medium">
                                            <a href="{{ route('admin#adminProfile') }}"
                                                class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-mow-shine-yellow hover:text-mow-dark-yellow">
                                                <div class="mr-3">
                                                    <i class="fas fa-user-alt"></i>
                                                </div>
                                                User
                                            </a>
                                        </li>
                                        <hr />
                                        <li class="font-medium">
                                            <a href="#"
                                                class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-red-700 hover:text-red-700">
                                                <div class="mr-3 text-red-700">
                                                    <i class="fas fa-sign-out-alt"></i>
                                                </div>
                                                <form action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                    <button type="submit" class=""
                                                        style="button:focus { outline: none; }">
                                                        Logout </button>
                                                </form>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- @foreach ($mealData as $users)
                            <a href="{{ url('#') }}" class="text-gray-700 dark:text-gray-500 ">{{ $users-> }}</a>
                        @endforeach --}}
                    @else
                        <p>{{ Auth::check() }}</p>

                        <ul class="navbar-nav flex pl-0 list-style-none text-lg font-medium mr-auto">
                            <li class="nav-item p-2">
                                <a class="nav-link link text-gray-500 hover:text-gray-900 focus:text-gray-700 p-0"
                                    href="{{ route('register') }}">SIGN UP</a>
                            </li>
                            <li class="nav-item p-2">
                                <a class="nav-link link text-gray-500 hover:text-gray-900 focus:text-gray-700 p-0"
                                    href="{{ route('login') }}">SIGN IN</a>
                            </li>
                        </ul>
                </div>
                @endif
            @endauth

        </div>
    </nav>
-->             

    <!-- Content -->
    
    <!-- End Content -->

    <!-- Footer -->
    
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
   
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="">Meals On Wheels</a>
        </div>
        <!-- Copyright -->
    </footer>

    <!-- Footer -->

</body>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>

</html>
