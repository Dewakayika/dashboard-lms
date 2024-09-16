@section('title') Forgot Password @endsection
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
                    <div class="mt-4">
                        <img style="width: 30px" src="{{url('images/padma.png')}}" alt="">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center min-h-screen px-4 py-10 bg-white sm:px-12 lg:px-24 sm:py-16 lg:py-24">
                <div class="xl:w-full xl:max-w-sm 2xl:max-w-md xl:mx-auto">
                    <h3 class="text-3xl font-bold leading-tight text-black sm:text-3xl">Forgot Your Password?</h3>
                    <p class="mt-2 text-base text-gray-600">
                        {{ __('No problem. Just let us know your email address and we will email you a password reset link') }}
                    </p>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="mt-8">
                        @csrf
                        <div class="space-y-5">
                            <div>
                                <label for="email" class="text-base font-medium text-gray-900">
                                    Email address
                                </label>
                                <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg
                                            class="w-5 h-5"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewbox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                        </svg>
                                    </div>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        value="{{ old('email') }}"
                                        placeholder="Enter your email address"
                                        class="block w-full py-4 pl-10 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('email') is-invalid @enderror"
                                        required autofocus/>
                                </div>
                                @error('email')
                                <p class="invalid-feedback" role="alert">
                                    <p style="padding-top: 10px;color: red;">{{ $message }}</p>
                                </p>
                                @enderror
                            </div>

                            <div>
                                <button
                                    type="submit"
                                    style="background-color: #2e2e2e"
                                    class="inline-flex items-center justify-center w-full px-4 py-4 text-base font-semibold text-white transition-all duration-200 border border-transparent rounded-md hover:opacity-80 focus:opacity-80">
                                    {{ __('Email Password Reset Link') }}
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
