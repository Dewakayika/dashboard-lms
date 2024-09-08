@vite('resources/css/navbar.css') 
@vite('resources/css/welcome.css')
@extends('layouts.app')

<body>
    @if (Route::has('login'))
    <nav x-data="{ open: false }" class="relative w-full bg-black text-white">
        <div class="container mx-auto flex justify-between items-center">
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

            <!-- Desktop menu -->
            <div class="hidden lg:flex items-center space-x-6">

                <a href="#">Home</a>
                <a href="#">Our Services</a>
                <a href="#">Let's Talk</a>
                <a href="#">Community</a>
                <a href="#">Contact Us</a>

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
    @endif @endauth

    

    <main>
        <div
            class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
            aria-hidden="true">
            <div
                class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        <div class="hero">
            <div class="hero-title">
                <p>Your creative partner</p>
                <h1>Simplify your messy </h1>
                <h1>technical production</h1>
            </div>
            
            <div class="desc">
                <p>boost creative productivity: webtoons, video editing, social media</p>
            </div>
        </div>
        
    </main>

   <!-- <div class="lg:hidden" role="dialog" aria-modal="true">
    <div class="fixed inset-0 z-50"></div>
    <div
        class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        <div class="flex items-center justify-between">
            <a href="#" class="-m-1.5 p-1.5">
                <span class="sr-only">Your Company</span>
                <img
                    class="h-8 w-auto"
                    src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                    alt=""></a>
                <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                    <span class="sr-only">Close menu</span>
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        viewbox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            @if (Route::has('login'))
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6">
                        <a
                            href="#"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Home</a>
                        <a
                            href="#"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Our Services</a>
                        <a
                            href="#"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Let's Talk</a>
                        <a
                            href="#"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Community</a>
                        <a
                            href="#"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Contact Us</a>
                    </div>
                    <div class="py-6">
                        @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                        <a
                            href="{{ route('login')}}"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log in</a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="button">Logout</button>
                        </form>
                        @else
                        <p>{{Auth::check()}}</p>

                        <a
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                            href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                        <a
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                            href="{{ route('register') }}">Register</a>
                        @endif
                    </div>
                </div>
            </div>
            @endif @endauth
        </div>
    </div>

    <div class="relative isolate px-6 pt-14 lg:px-8">
        <div
            class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
            aria-hidden="true">
            <div
                class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
            <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                <div
                    class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                    Your creative partner.
                    <a href="https://www.padmastudio.io" class="font-semibold text-indigo-600">
                        <span class="absolute inset-0" aria-hidden="true"></span>Read more
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Simplify your messy technical production</h1>
                <p class="mt-6 text-lg leading-8 text-gray-600">boost creative productivity: webtoons, video editing, social media</p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a
                        href="#"
                        class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get started</a>
                    <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Learn more
                        <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>
        <div
            class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
            aria-hidden="true">
            <div
                class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
    </div>
</div> -->
</body>

<!-- @section('title') Meals on Wheels @endsection
@vite('resources/css/welcome.css') -->
<!-- @vite('resources/css/flying.css') -->
<!-- <script src="{{ asset('js/components/welcome.js')}}"></script> <style>
.hiden{ opacity: 0; filter: blur(5px); transform: translateX(-100%); transition:
all 1.7s; } .show{ opacity: 1; filter: blur(0); transform: translateX(0); }
</style> -->
<!-- <div class="bg-white"> <header class="absolute
inset-x-0 top-0 z-50"> <nav class="flex items-center justify-between p-6
lg:px-8" aria-label="Global"> <div class="flex lg:flex-1"> <a href="#"
class="-m-1.5 p-1.5"> <span class="sr-only">Your Company</span> <img class="h-8
w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
alt=""> </a> </div> <div class="flex lg:hidden"> <button type="button"
class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5
text-gray-700"> <span class="sr-only">Open main menu</span> <svg class="h-6 w-6"
fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
aria-hidden="true"> <path stroke-linecap="round" stroke-linejoin="round"
d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /> </svg> </button> </div> <div
class="hidden lg:flex lg:gap-x-12"> <a href="#" class="text-sm font-semibold
leading-6 text-gray-900">Product</a> <a href="#" class="text-sm font-semibold
leading-6 text-gray-900">Features</a> <a href="#" class="text-sm font-semibold
leading-6 text-gray-900">Marketplace</a> <a href="#" class="text-sm
font-semibold leading-6 text-gray-900">Company</a> </div> <div class="hidden
lg:flex lg:flex-1 lg:justify-end"> <a href="#" class="text-sm font-semibold
leading-6 text-gray-900">Log in <span aria-hidden="true">&rarr;</span></a>
</div> </nav> Mobile menu, show/hide based on menu open state. -->

