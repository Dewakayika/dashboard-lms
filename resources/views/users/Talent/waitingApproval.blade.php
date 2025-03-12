<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Padma Dashboard | Waiting</title>
    <script src="https://cdn.tailwindcss.com/3.4.1"></script>

</head>
<body class="bg-[#FCF8F1]">
    <div class="bg-[#FCF8F1]">
        <header class="bg-[#FCF8F1] bg-opacity-30">
            <div class="px-4 mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 lg:h-20">
                    <div class="flex-shrink-0">
                        <a href="#" title="" class="flex">
                            <img class="w-auto h-8" src="" alt="" />
                        </a>
                    </div>

                    <button type="button" class="inline-flex p-2 text-black transition-all duration-200 rounded-md lg:hidden focus:bg-gray-100 hover:bg-gray-100">
                        <!-- Menu open: "hidden", Menu closed: "block" -->
                        <svg class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                        </svg>

                        <!-- Menu open: "block", Menu closed: "hidden" -->
                        <svg class="hidden w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                </div>
            </div>
        </header>



        <section class="bg-[#FCF8F1] bg-opacity-30 py-10 sm:py-16 lg:py-24">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid items-center grid-cols-1 gap-12 lg:grid-cols-2">
                    <div>
                        <p class="text-base font-semibold tracking-wider text-gray-900 uppercase"><img src="{{ asset('storage/' . $talent->profile_photo) }}" alt="profile_image" class="w-10 h-10 shadow-sm" style="border-radius: 100%">Hi {{$user->name}} 👋</p>

                        <h1 class="mt-4 text-4xl font-bold text-black lg:mt-8 sm:text-6xl xl:text-8xl">Our Success Story Start From You</h1>
                        <p class="mt-4 text-base text-black lg:mt-8 sm:text-xl">
                            Your request is under review. Please wait a moment
                            <span class="loading-dots">
                                <span class="dot">.</span>
                                <span class="dot">.</span>
                                <span class="dot">.</span>
                            </span>
                        </p>

                        <style>
                        .loading-dots {
                            display: inline-block;
                        }

                        .dot {
                            display: inline-block;
                            animation: bounce 1.4s infinite;
                        }

                        .dot:nth-child(2) {
                            animation-delay: 0.2s;
                        }

                        .dot:nth-child(3) {
                            animation-delay: 0.4s;
                        }

                        @keyframes bounce {
                            0%, 80%, 100% {
                                transform: translateY(0);
                            }
                            40% {
                                transform: translateY(-6px);
                            }
                        }
                        </style>


                        <a href="https://padmastudio.io/" target="_blank" title="" class="inline-flex items-center px-6 py-4 mt-8 font-semibold text-white transition-all duration-200 bg-red-500 rounded-full lg:mt-16 hover:bg-red-400 focus:bg-red-400" role="button">
                            Visit our website
                            <svg class="w-6 h-6 ml-8 -mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </a>

                    </div>

                    <div>
                        <img class="w-full" style="border-radius: 5%" src="{{ url('images/webtoon.jpg')}}" alt="" />
                    </div>
                </div>
            </div>
        </section>
    </div>


</body>
</html>
