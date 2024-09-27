@section('title') Login @endsection 
@extends('layouts.app') 

@section('content')

<body>

    <section class="bg-white">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class=" h-screen relative flex items-start px-4 pb-10 pt-6 sm:pb-16 md:justify-left lg:pb-24 bg-gray-50 sm:px-6 lg:px-8 hidden lg:block absolute inset-0">
                <div class="absolute inset-0">
                    <img
                        class="object-cover object-top w-full h-full cover"
                        src="{{ url('images/login-image.jpg')}}"
                        alt=""/>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>

                <div class="absolute">
                    <div class="">
                        <img style="width: 30px" src="{{url('images/padma.png')}}" alt="">
                    </div>
                </div>
            </div>
            


            <div
                class="flex items-center justify-center min-h-screen px-4 py-10 bg-white sm:px-6 lg:px-8 sm:py-16 lg:py-24">
                <div class="xl:w-full xl:max-w-sm 2xl:max-w-md xl:mx-auto">
                    @if(session('message'))
                    <div id="toast-danger" class="flex items-center w-full max-w-xs p-4 mb-4 text-red-700 bg-red-50 rounded-lg shadow" role="alert">
                        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-600 bg-red-100 rounded-lg">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                            </svg>
                            <span class="sr-only">Error icon</span>
                        </div>
                        <div class="ms-3 text-sm font-normal">{{session('message') }}</div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const toast = document.getElementById('toast-danger');
                            
                            // Show the toast with fade-in effect
                            setTimeout(() => {
                                toast.classList.remove('opacity-0', 'translate-y-2');
                                toast.classList.add('opacity-100', 'translate-y-0');
                            }, 100); // Delay to ensure the animation plays
                    
                            // Automatically hide the toast after 10 seconds
                            setTimeout(() => {
                                toast.classList.add('opacity-0', 'translate-y-2'); // Fade out animation
                                setTimeout(() => {
                                    toast.remove(); // Remove from DOM after animation
                                }, 500); // Time for the fade-out animation to complete
                            }, 5000); // 10 seconds delay before hiding
                        });
                    </script>
                    @endif                   

                    
                    <h3 class="text-3xl font-bold leading-tight text-black sm:text-3xl">Welcome Dashboard!👋</h3>
                    <p class="mt-2 text-base text-gray-600">Don’t have an account?
                        <a
                            href="{{ route('register') }}"
                            title=""
                            class="font-medium text-blue-600 transition-all duration-200 h  over:text-blue-700 focus:text-blue-700 hover:underline">Create a free account</a>
                    </p>

                    <form action="{{ route('login') }}" method="POST" class="mt-8">
                        @csrf
                        <div class="space-y-5">
                            <div>
                                <label for="email" class="text-base font-medium text-gray-900">
                                    Email address
                                </label>
                                <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg
                                            class="w-5 h-5"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewbox="0 0 24 24"
                                            stroke="currentColor">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                        </svg>
                                    </div>

                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        value="{{ old('email') }}"
                                        placeholder="Enter email to get started"
                                        class="block w-full py-4 pl-10 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('email') is-invalid @enderror"/>
                                </div>
                                @error('email')
                                <p class="invalid-feedback" role="alert">
                                    <p style="padding-top: 10px;color: red;">{{ $message }}</p>
                                </p>
                                @enderror
                            </div>

                            <div>
                                <div class="flex items-center justify-between">
                                    <label for="password" class="text-base font-medium text-gray-900">
                                        Password
                                    </label>

                                    <a
                                        href="{{ route('password.request') }}"
                                        title=""
                                        class="text-sm font-medium text-blue-600 transition-all duration-200 hover:text-blue-700 focus:text-blue-700 hover:underline">
                                        Forgot password?
                                    </a>
                                </div>
                                <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg
                                            class="w-5 h-5"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewbox="0 0 24 24"
                                            stroke="currentColor">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/>
                                        </svg>
                                    </div>

                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        placeholder="Enter your password"
                                        class="block w-full py-4 pl-10 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('password') is-invalid @enderror"/>
                                </div>
                                @error('password')
                                <p class="invalid-feedback" role="alert">
                                    <p>{{ $message }}</p>
                                </p>
                                @enderror
                            </div>

                            <div>
                                <button
                                    type="submit"
                                    style="background-color: #2e2e2e"
                                    class="inline-flex items-center justify-center w-full px-4 py-4 text-base font-semibold text-white transition-all duration-200 border border-transparent rounded-md  focus:outline hover:opacity-80 focus:opacity-80">
                                    Log in
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

</body>
@endsection