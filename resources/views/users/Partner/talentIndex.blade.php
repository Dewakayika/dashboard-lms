@section('title')
    Partner Dashboard
@endsection

@extends('Users.Partner.layouts.app')

@section('content')
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
            <h2 class="text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl">Welcome Talent!</h2>
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
                        href="{{ route('course#introduction') }}"
                        class="text-gray-900 font-bold text-lg mb-2 hover:text-indigo-600 inline-block">Comic and Webtoon Introduction
                    </a>
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
</div>        <!-- End content -->
    @endsection
