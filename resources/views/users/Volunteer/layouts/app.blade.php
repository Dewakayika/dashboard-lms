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

    <nav
        class="relative w-full flex flex-wrap py-4 bg-white text-gray-500 hover:text-gray-700 focus:text-gray-700 navbar navbar-expand-lg shadow-md">
        <div class="container w-full flex flex-wrap items-center justify-between">
            <div class="items-between gap-4 flex collapse navbar-collapse" id="navbarSupportedContent">
                <a href="/">
                    <img src="{{ url('images/logo.png') }}" alt="" srcset="" width="185px">
                </a>
                <!-- Left links -->
                <div>
                </div>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="items-between relative flex gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-700 ">Dashboard</a>
                        <!-- component -->
                        <div x-data="{ open: false }" class="">
                            <div @click="open = !open" class="relative border-b-2 pb-1 border-transparent z-50"
                                :class="{ 'border-mow-shine-yellow transform transition duration-300 ': open }"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100">
                                <div class="flex justify-center items-center space-x-3 font-semibold cursor-pointer">
                                    <div class="">
                                        <div class="cursor-pointer"><i class="fas fa-xl fa-user-alt"> &nbsp;
                                            </i>{{ $volunteerData->name }}</div>
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
                                            <a href="{{ route('volunteer#volunteerProfile') }}"
                                                class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-mow-shine-yellow hover:text-mow-dark-yellow">
                                                <div class="mr-3">
                                                    <i class="fas fa-user-alt"></i>
                                                </div>
                                                User
                                            </a>
                                        </li>
                                        <li class="font-medium">
                                            <a href="{{ route('volunteer#orderList') }}"
                                                class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-mow-shine-yellow hover:text-mow-dark-yellow">
                                                <div class="mr-3">
                                                    <i class="fa-sharp fa-solid fa-bag-shopping"></i>
                                                </div>
                                                Orders
                                            </a>
                                        </li>
                                        <li class="font-medium">
                                            <a href="{{ route('volunteer#orderHistory') }}"
                                                class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-mow-shine-yellow hover:text-mow-dark-yellow">
                                                <div class="mr-3">
                                                    <i class="fa-sharp fa-solid fa-bag-shopping"></i>
                                                </div>
                                                Order History
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
            <!-- Right elements -->
        </div>
    </nav>


    <!-- Content -->
    <section class="">
        <div>
            @yield('content')
        </div>
    </section>
    <!-- End Content -->

    <!-- Footer -->
    <footer class="text-center text-lg-start bg-white text-muted ">
        <hr>
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-github"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3 text-secondary"></i>Meals On Wheels
                        </h6>
                        <p>
                            Here you can use rows and columns to organize your footer content. Lorem ipsum
                            dolor sit amet, consectetur adipisicing elit.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Products
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Healty</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Fresh</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Vegetable</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Fruits</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Pricing</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Settings</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Orders</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Help</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fas fa-home me-3 text-secondary"></i> New York, NY 10012, US</p>
                        <p>
                            <i class="fas fa-envelope me-3 text-secondary"></i>
                            info@example.com
                        </p>
                        <p><i class="fas fa-phone me-3 text-secondary"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print me-3 text-secondary"></i> + 01 234 567 89</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(215, 3, 3, 0.025);">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="">Meals On Wheels</a>
        </div>
        <!-- Copyright -->
    </footer>

    <!-- Footer -->

</body>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>

</html>
