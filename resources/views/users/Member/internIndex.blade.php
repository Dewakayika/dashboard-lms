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

        @vite('resources/css/app.css') @vite('resources/css/member.css')

        <title>Intern | Dashboard</title>

        <!-- FontAwesome -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link
            rel="icon"
            href="https://cdn.discordapp.com/attachments/1018894859832148009/1025031221799043102/meals_on_wheels.png">

        <!-- FontAwesome Kit -->
        <script src="https://kit.fontawesome.com/bf49ffd5fb.js" crossorigin="anonymous"></script>

        <!-- Alpine.js -->
        <script
            src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
            defer="defer"></script>

        <!-- Bootstrap JS -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    </head>

    <body>
        <!-- Navbar -->
        <nav x-data="{ open: false }" class="relative w-full bg-black text-white">
            <div class="container mx-auto px-6 py-4 flex justify-between items-center ">
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
                    <div class="text-center space-y-6">
                        <a href="{{ url('/dashboard') }}" class="block text-2xl hover:text-gray-300">Dashboard</a>
                        @if (Route::has('login')) @auth
                        <div x-data="{ userOpen: false }" class="relative">
                            <button @click="userOpen = !userOpen" class="text-2xl hover:text-gray-300">{{ $internData->users->name }}</button>
                            <div
                                x-show="userOpen"
                                @click.away="userOpen = false"
                                class="mt-2 py-2 bg-white rounded-md shadow-xl">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">User</a>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none">Logout</button>
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
                        <button
                            @click="open = !open"
                            class="flex items-center space-x-2 hover:text-gray-300 focus:outline-none">
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
                        <div
                            x-show="open"
                            @click.away="open = false"
                            class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">User</a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button
                                    type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none">Logout</button>
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

        <div class="relative py-10 overflow-hidden bg-black sm:py-16 lg:py-24 xl:py-32 h-99vh" style="z-index: -1;">
            <div class="absolute inset-0">
                <img
                    class="object-cover w-full h-full md:object-left md:scale-150 md:origin-top-left"
                    src="https://cdn.rareblocks.xyz/collection/celebration/images/cta/5/girl-working-on-laptop.jpg"
                    alt=""/>
            </div>
            <div class="absolute inset-0 hidden bg-gradient-to-r md:block from-black to-transparent "></div>
            <div class="absolute inset-0 block bg-black/60 md:hidden h-screen"></div>

            <div class="relative px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
                <div class="md:w-2/3 lg:w-1/2 xl:w-1/2 text-left">
                    <h2 class="text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl">Padma Community</h2>
                    <p class="mt-3 text-base text-gray-200">Where creators, designers, and enthusiasts come together to delve into the intricacies of webtoon background design. Our community is dedicated to exploring every facet of the background creation process, from initial concept development to final implementation.</p>
                    <div class="mt-4">
                        <a
                            href="https://discord.com/"
                            target="_blank"
                            class="rounded-s bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Join Discord Channel</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
            <div class="mb-4">
                <h1 class="text-xl font-bold mb-4">Learning Course </h1>
                <hr>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
                <div
                    class="border-r border-b border-l border-gray-400 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
                    <img src="{{ url('images/Intro.png') }}" class="w-full mb-0">
                    <div class="p-4 pt-2">
                        <div class="mb-8">
                            <p class="text-sm text-gray-600 flex items-center">
                                <i class="fas fa-book fill-current text-gray-500 w-3 h-3 mr-2"></i>
                                INTRO
                            </p>
                            <a
                                href="{{ route('course#introduction') }}"
                                class="text-gray-900 font-bold text-lg mb-2 hover:text-indigo-600 inline-block">Intro Webtoon Background Design</a>
                            <p class="text-gray-700 text-sm text-justify">This course provides a comprehensive introduction to becoming a webtoon background designer, utilizing SketchUp for 3D modeling and Photoshop for post-production and refinement. </p>
                        </div>
                        <div class="flex items-center">
                            <a href="#"><img
                                class="w-10 h-10 rounded-full mr-4"
                                src="{{ url('images/padma-black.png') }}"
                                alt="Avatar of Jonathan Reinink"></a>
                            <div class="text-sm">
                                <a
                                    href="#"
                                    class="text-gray-900 font-semibold leading-none hover:text-indigo-600">Padma Studio</a>
                                <p class="text-gray-600">Sept 06</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="border-r border-b border-l border-gray-400 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
                    <img src="{{ url('images/Basic.png') }}" class="w-full mb-3">
                    <div class="p-4 pt-2">
                        <div class="mb-8">
                            <p class="text-sm text-gray-600 flex items-center">
                                <i class="fas fa-book fill-current text-gray-500 w-3 h-3 mr-2"></i>
                                #CHAPTER 1
                            </p>
                            <a
                                href="{{ route('course#basic') }}"
                                class="text-gray-900 font-bold text-lg mb-2 hover:text-indigo-600 inline-block">Comic and Webtoon Introduction
                            </a>
                            <p class="text-gray-700 text-sm text-justify">The Webtoon Fundamentals course is designed for aspiring creators who want to develop their skills in visual storytelling, focusing on essential elements like storyboarding, shot composition, and camera angles.</p>
                        </div>
                        <div class="flex items-center">
                            <a href="#"><img
                                class="w-10 h-10 rounded-full mr-4"
                                src="{{ url('images/padma-black.png') }}"
                                alt="Avatar of Jonathan Reinink"></a>
                            <div class="text-sm">
                                <a
                                    href="#"
                                    class="text-gray-900 font-semibold leading-none hover:text-indigo-600">Padma Studio</a>
                                <p class="text-gray-600">Sept 06</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="border-r border-b border-l border-gray-400 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
                    <img src="{{ url('images/sketchup.png') }}" class="w-full mb-3">
                    <div class="p-4 pt-2">
                        <div class="mb-8">
                            <p class="text-sm text-gray-600 flex items-center">
                                <i class="fas fa-book fill-current text-gray-500 w-3 h-3 mr-2"></i>
                                #CHAPTER 2
                            </p>
                            <a
                                href="{{ route('course#basicSketchup') }}"
                                class="text-gray-900 font-bold text-lg mb-2 hover:text-indigo-600 inline-block">Introduction in to Sketchup</a>
                            <p class="text-gray-700 text-sm text-justify">This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling for webtoon background design. </p>
                        </div>
                        <div class="flex items-center">
                            <a href="#"><img
                                class="w-10 h-10 rounded-full mr-4"
                                src="{{ url('images/padma-black.png') }}"
                                alt="Avatar of Jonathan Reinink"></a>
                            <div class="text-sm">
                                <a
                                    href="#"
                                    class="text-gray-900 font-semibold leading-none hover:text-indigo-600">Padma Studio</a>
                                <p class="text-gray-600">Sept 06</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="border-r border-b border-l border-gray-400 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
                    <img src="{{ url('images/photosop.png') }}" class="w-full mb-3">
                    <div class="p-4 pt-2">
                        <div class="mb-8">
                            <p class="text-sm text-gray-600 flex items-center">
                                <i class="fas fa-book fill-current text-gray-500 w-3 h-3 mr-2"></i>
                                #CHAPTER 3
                            </p>
                            <a
                                href="{{ route('course#sketchupPhotoshop')}}"
                                class="text-gray-900 font-bold text-lg mb-2 hover:text-indigo-600 inline-block">Sketchup to Photoshop</a>
                            <p class="text-gray-700 text-sm text-justify">This specialized course focuses on mastering the seamless workflow between SketchUp and Photoshop to create high-quality, detailed webtoon backgrounds. </p>
                        </div>
                        <div class="flex items-center">
                            <a href="#"><img
                                class="w-10 h-10 rounded-full mr-4"
                                src="{{ url('images/padma-black.png') }}"
                                alt="Avatar of Jonathan Reinink"></a>
                            <div class="text-sm">
                                <a
                                    href=""
                                    class="text-gray-900 font-semibold leading-none hover:text-indigo-600">Padma Studio</a>
                                <p class="text-gray-600">Sept 06</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="border-r border-b border-l border-gray-400 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
                    <img src="{{ url('images/advance.png') }}" class="w-full mb-3">
                    <div class="p-4 pt-2">
                        <div class="mb-8">
                            <p class="text-sm text-gray-600 flex items-center">
                                <i class="fas fa-book fill-current text-gray-500 w-3 h-3 mr-2"></i>
                                #CHAPTER 4
                            </p>
                            <a
                                href="#"
                                class="text-gray-900 font-bold text-lg mb-2 hover:text-indigo-600 inline-block">Advance Tools Webtoon Design</a>
                            <p class="text-gray-700 text-sm">Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque,
                                exercitationem praesentium nihil.</p>
                        </div>
                        <div class="flex items-center">
                            <a href="#"><img
                                class="w-10 h-10 rounded-full mr-4"
                                src="{{ url('images/padma-black.png') }}"
                                alt="Avatar of Jonathan Reinink"></a>
                            <div class="text-sm">
                                <a
                                    href="#"
                                    class="text-gray-900 font-semibold leading-none hover:text-indigo-600">Padma Studio</a>
                                <p class="text-gray-600">Sept 06</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="border-r border-b border-l border-gray-400 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
                    <img src="{{ url('images/industry.png') }}" class="w-full mb-3">
                    <div class="p-4 pt-2">
                        <div class="mb-8">
                            <p class="text-sm text-gray-600 flex items-center">
                                <i class="fas fa-book fill-current text-gray-500 w-3 h-3 mr-2"></i>
                                #CHAPTER 5
                            </p>
                            <a
                                href="#"
                                class="text-gray-900 font-bold text-lg mb-2 hover:text-indigo-600 inline-block">standard industry Practise</a>
                            <p class="text-gray-700 text-sm">Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque,
                                exercitationem praesentium nihil.</p>
                        </div>
                        <div class="flex items-center">
                            <a href="#"><img
                                class="w-10 h-10 rounded-full mr-4"
                                src="{{ url('images/padma-black.png') }}"
                                alt="Avatar of Jonathan Reinink"></a>
                            <div class="text-sm">
                                <a
                                    href="#"
                                    class="text-gray-900 font-semibold leading-none hover:text-indigo-600">Padma Studio</a>
                                <p class="text-gray-600">Sept 06</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center text-lg-start bg-white text-muted ">
            <hr>
            <!-- Copyright -->
            <div class="text-center p-4" style="background-color: rgba(215, 3, 3, 0.025);">
                © 2024 Copyright:
                <a class="text-reset fw-bold" href="">Padma Studio</a>
            </div>
            <!-- Copyright -->
        </footer>

        <!-- Footer -->

    </body>

</html>