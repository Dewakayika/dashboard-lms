@section('title') Member Dashboard @endsection
@extends('users.Member.layouts.app') @section('content')
@vite('resources/css/welcome.css') @vite('resources/css/flying.css')

<div class="bg-white">
    <div class="relative isolate px-6 pt-14 lg:px-8">
        <div
            class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
            aria-hidden="true">
            <div
                class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        <div class="mx-auto max-w-2xl">
            <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                <div
                    class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                    Hello
                    <span href="#" class="font-semibold text-indigo-600">
                        <span class="absolute inset-0" aria-hidden="true"></span>{{ $internData->users->name }}👋</span>
                    Welcome to
                </div>
            </div>
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Padma Community</h1>
                <p class="mt-6 text-lg leading-8 text-gray-600">Lorem ipsum dolor sit amet
                    consectetur adipisicing elit. Architecto illum distinctio nisi dolore iure quos,
                    esse sint itaque recusandae alias, dolor quia ipsa porro dolorem voluptas quasi
                    perferendis cupiditate maxime?</p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a
                        href="#"
                        class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Start Learning</a>
                    <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Join Discord Channel
                        <span aria-hidden="true">→</span></a>
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
</div>

{{-- <div class="flex flex-wrap justify-center mt-10">

    <!-- card 1 -->
    <div class="p-4 max-w-sm">
        <div class="flex rounded-lg h-full dark:bg-gray-800 bg-teal-400 p-8 flex-col">
            <div class="flex items-center mb-3">
                <div
                    class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full dark:bg-indigo-500 bg-indigo-500 text-white flex-shrink-0">
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        class="w-5 h-5"
                        viewbox="0 0 24 24">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                    </svg>
                </div>
                <h2 class="text-white dark:text-white text-lg font-medium">Feature 1</h2>
            </div>
            <div class="flex flex-col justify-between flex-grow">
                <p class="leading-relaxed text-base text-white dark:text-gray-300">
                    Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy.
                    Gastropub indxgo juice poutine.
                </p>
                <a
                    href="#"
                    class="mt-3 text-black dark:text-white hover:text-blue-600 inline-flex items-center">Learn More
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        class="w-4 h-4 ml-2"
                        viewbox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- card 2 -->
    <div class="p-4 max-w-sm">
        <div class="flex rounded-lg h-full dark:bg-gray-800 bg-teal-400 p-8 flex-col">
            <div class="flex items-center mb-3">
                <div
                    class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full dark:bg-indigo-500 bg-indigo-500 text-white flex-shrink-0">
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        class="w-5 h-5"
                        viewbox="0 0 24 24">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                    </svg>
                </div>
                <h2 class="text-white dark:text-white text-lg font-medium">Feature 2</h2>
            </div>
            <div class="flex flex-col justify-between flex-grow">
                <p class="leading-relaxed text-base text-white dark:text-gray-300">
                    Lorem ipsum dolor sit amet. In quos laboriosam non neque eveniet 33 nihil
                    molestias. Rem perspiciatis iure ut laborum inventore et maxime amet.
                </p>
                <a
                    href="#"
                    class="mt-3 text-black dark:text-white hover:text-blue-600 inline-flex items-center">Learn More
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        class="w-4 h-4 ml-2"
                        viewbox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- card 3 -->
    <div class="p-4 max-w-sm">
        <div class="flex rounded-lg h-full dark:bg-gray-800 bg-teal-400 p-8 flex-col">
            <div class="flex items-center mb-3">
                <div
                    class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full dark:bg-indigo-500 bg-indigo-500 text-white flex-shrink-0">
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        class="w-5 h-5"
                        viewbox="0 0 24 24">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                    </svg>
                </div>
                <h2 class="text-white dark:text-white text-lg font-medium">Feature 3</h2>
            </div>
            <div class="flex flex-col justify-between flex-grow">
                <p class="leading-relaxed text-base text-white dark:text-gray-300">
                    Lorem ipsum dolor sit amet. In quos laboriosam non neque eveniet 33 nihil
                    molestias. Rem perspiciatis iure ut laborum inventore et maxime amet.
                </p>
                <a
                    href="#"
                    class="mt-3 text-black dark:text-white hover:text-blue-600 inline-flex items-center">Learn More
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        class="w-4 h-4 ml-2"
                        viewbox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- card 4 -->
    <div class="p-4 max-w-sm">
        <div class="flex rounded-lg h-full dark:bg-gray-800 bg-teal-400 p-8 flex-col">
            <div class="flex items-center mb-3">
                <div
                    class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full dark:bg-indigo-500 bg-indigo-500 text-white flex-shrink-0">
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        class="w-5 h-5"
                        viewbox="0 0 24 24">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                    </svg>
                </div>
                <h2 class="text-white dark:text-white text-lg font-medium">Feature 4</h2>
            </div>
            <div class="flex flex-col justify-between flex-grow">
                <p class="leading-relaxed text-base text-white dark:text-gray-300">
                    Lorem ipsum dolor sit amet. In quos laboriosam non neque eveniet 33 nihil
                    molestias. Rem perspiciatis iure ut laborum inventore et maxime amet.
                </p>
                <a
                    href="#"
                    class="mt-3 text-black dark:text-white hover:text-blue-600 inline-flex items-center">Learn More
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        class="w-4 h-4 ml-2"
                        viewbox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- card 1 -->
    <div class="p-4 max-w-sm">
        <div class="flex rounded-lg h-full dark:bg-gray-800 bg-teal-400 p-8 flex-col">
            <div class="flex items-center mb-3">
                <div
                    class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full dark:bg-indigo-500 bg-indigo-500 text-white flex-shrink-0">
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        class="w-5 h-5"
                        viewbox="0 0 24 24">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                    </svg>
                </div>
                <h2 class="text-white dark:text-white text-lg font-medium">Feature 1</h2>
            </div>
            <div class="flex flex-col justify-between flex-grow">
                <p class="leading-relaxed text-base text-white dark:text-gray-300">
                    Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy.
                    Gastropub indxgo juice poutine.
                </p>
                <a
                    href="#"
                    class="mt-3 text-black dark:text-white hover:text-blue-600 inline-flex items-center">Learn More
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        class="w-4 h-4 ml-2"
                        viewbox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- card 2 -->
    <div class="p-4 max-w-sm">
        <div class="flex rounded-lg h-full dark:bg-gray-800 bg-teal-400 p-8 flex-col">
            <div class="flex items-center mb-3">
                <div
                    class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full dark:bg-indigo-500 bg-indigo-500 text-white flex-shrink-0">
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        class="w-5 h-5"
                        viewbox="0 0 24 24">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                    </svg>
                </div>
                <h2 class="text-white dark:text-white text-lg font-medium">Feature 2</h2>
            </div>
            <div class="flex flex-col justify-between flex-grow">
                <p class="leading-relaxed text-base text-white dark:text-gray-300">
                    Lorem ipsum dolor sit amet. In quos laboriosam non neque eveniet 33 nihil
                    molestias. Rem perspiciatis iure ut laborum inventore et maxime amet.
                </p>
                <a
                    href="#"
                    class="mt-3 text-black dark:text-white hover:text-blue-600 inline-flex items-center">Learn More
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        class="w-4 h-4 ml-2"
                        viewbox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- card 3 -->
    <div class="p-4 max-w-sm">
        <div class="flex rounded-lg h-full dark:bg-gray-800 bg-teal-400 p-8 flex-col">
            <div class="flex items-center mb-3">
                <div
                    class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full dark:bg-indigo-500 bg-indigo-500 text-white flex-shrink-0">
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        class="w-5 h-5"
                        viewbox="0 0 24 24">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                    </svg>
                </div>
                <h2 class="text-white dark:text-white text-lg font-medium">Feature 3</h2>
            </div>
            <div class="flex flex-col justify-between flex-grow">
                <p class="leading-relaxed text-base text-white dark:text-gray-300">
                    Lorem ipsum dolor sit amet. In quos laboriosam non neque eveniet 33 nihil
                    molestias. Rem perspiciatis iure ut laborum inventore et maxime amet.
                </p>
                <a
                    href="#"
                    class="mt-3 text-black dark:text-white hover:text-blue-600 inline-flex items-center">Learn More
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        class="w-4 h-4 ml-2"
                        viewbox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- card 4 -->
    <div class="p-4 max-w-sm">
        <div class="flex rounded-lg h-full dark:bg-gray-800 bg-teal-400 p-8 flex-col">
            <div class="flex items-center mb-3">
                <div
                    class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full dark:bg-indigo-500 bg-indigo-500 text-white flex-shrink-0">
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        class="w-5 h-5"
                        viewbox="0 0 24 24">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                    </svg>
                </div>
                <h2 class="text-white dark:text-white text-lg font-medium">Feature 4</h2>
            </div>
            <div class="flex flex-col justify-between flex-grow">
                <p class="leading-relaxed text-base text-white dark:text-gray-300">
                    Lorem ipsum dolor sit amet. In quos laboriosam non neque eveniet 33 nihil
                    molestias. Rem perspiciatis iure ut laborum inventore et maxime amet.
                </p>
                <a
                    href="#"
                    class="mt-3 text-black dark:text-white hover:text-blue-600 inline-flex items-center">Learn More
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        class="w-4 h-4 ml-2"
                        viewbox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

</div> --}}

<div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
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
                        href="#"
                        class="text-gray-900 font-bold text-lg mb-2 hover:text-indigo-600 inline-block">Intro Webtoon Background Design</a>
                    <p class="text-gray-700 text-sm ">Lorem ipsum dolor sit amet, consectetur
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
            <img src="{{ url('images/Basic.png') }}" class="w-full mb-3">
            <div class="p-4 pt-2">
                <div class="mb-8">
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-book fill-current text-gray-500 w-3 h-3 mr-2"></i>
                        #CHAPTER 1
                    </p>
                    <a
                        href="#"
                        class="text-gray-900 font-bold text-lg mb-2 hover:text-indigo-600 inline-block">Comic and Webtoon Introduction </a>
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
            <img src="{{ url('images/sketchup.png') }}" class="w-full mb-3">
            <div class="p-4 pt-2">
                <div class="mb-8">
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-book fill-current text-gray-500 w-3 h-3 mr-2"></i>
                        #CHAPTER 2
                    </p>
                    <a
                        href="#"
                        class="text-gray-900 font-bold text-lg mb-2 hover:text-indigo-600 inline-block">Introduction in to Sketchup</a>
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
            <img src="{{ url('images/photosop.png') }}" class="w-full mb-3">
            <div class="p-4 pt-2">
                <div class="mb-8">
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-book fill-current text-gray-500 w-3 h-3 mr-2"></i>
                        #CHAPTER 3
                    </p>
                    <a
                        href="#"
                        class="text-gray-900 font-bold text-lg mb-2 hover:text-indigo-600 inline-block">Sketchup to Photoshop</a>
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
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous">
    @endsection