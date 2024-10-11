@extends('layouts.app')

@section('title')
    Register
@endsection

@section('content')

<body>
    <section class="bg-gray-50">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <!-- Left side image -->
            <div class="relative flex items-start px-6 py-6 justify-left bg-gray-50 hidden lg:block absolute inset-0">
                <div class="absolute inset-0">
                    <img
                        class="object-cover object-top w-full h-full"
                        src="{{ url('images/login-image.jpg')}}"
                        alt="Sample image"
                    />
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                <div class="absolute">
                    <div class="">
                        <img style="width: 30px" src="{{url('images/padma.png')}}" alt="">
                    </div>
                </div>  
            </div>

            <!-- Right side form -->
            <div class="flex items-center justify-center min-h-screen px-4 py-10 bg-white sm:px-4 lg:px-8 sm:py-16 lg:py-24">
                <div class="xl:w-full xl:max-w-sm 2xl:max-w-md xl:mx-auto">
                    <h2 class="text-3xl font-bold leading-tight text-black sm:text-4xl">Sign Up</h2>
                    <p class="mt-2 text-base text-gray-600">
                        Already have an account?
                        <a
                            href="{{ route('login') }}"
                            title=""
                            class="font-medium text-blue-600 transition-all duration-200 hover:text-blue-700 focus:text-blue-700 hover:underline"
                        >Sign in</a>
                    </p>

                    <!-- Registration Form -->
                    <form action="{{ route('register') }}" method="POST" class="mt-8">
                        @csrf
                        <div class="space-y-5">
                            <!-- Name Input -->
                            <div>
                                <label for="name" class="text-base font-medium text-gray-900">Full Name</label>
                                <div class="mt-2.5 relative">
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        placeholder="Enter your full name"
                                        value="{{ old('name') }}" 
                                        class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('name') is-invalid @enderror"
                                    />
                                    @error('name')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Input -->
                            <div>
                                <label for="email" class="text-base font-medium text-gray-900">Email address</label>
                                <div class="mt-2.5 relative">
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        placeholder="Enter email"
                                        value="{{ old('email') }}" 
                                        class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('email') is-invalid @enderror"
                                    />
                                    @error('email')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password Input -->
                            <div>
                                <label for="password" class="text-base font-medium text-gray-900">Password</label>
                                <div class="mt-2.5 relative">
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        placeholder="Enter your password"
                                        class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('password') is-invalid @enderror"
                                    />
                                    <p id="passwordHelp" class="text-red-600 text-sm mt-2 hidden">Password must be at least 8 characters long</p>
                                    @error('password')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirm Password Input -->
                            <div>
                                <label for="password_confirmation" class="text-base font-medium text-gray-900">Confirm Password</label>
                                <div class="mt-2.5 relative">
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        id="password_confirmation"
                                        placeholder="Confirm your password"
                                        class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600"
                                    />
                                    <p id="confirmPasswordHelp" class="text-red-600 text-sm mt-2 hidden">Passwords do not match</p>
                                </div>
                            </div>

                            <!-- Registration Code Input -->
                            <div>
                                <label for="registration_code" class="text-base font-medium text-gray-900">Registration Code</label>
                                <div class="mt-2.5 relative">
                                    <input
                                        type="text"
                                        name="registration_code"
                                        id="registration_code"
                                        placeholder="Enter registration code"
                                        value="{{ old('registration_code') }}" 
                                        class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('registration_code') is-invalid @enderror"
                                    />
                                    @error('registration_code')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button
                                    type="submit"
                                    class="w-full py-4 text-base font-medium text-white bg-blue-600 rounded-md transition-all duration-200 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                >Sign Up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript for Real-time Validation -->
    <script>
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const passwordHelp = document.getElementById('passwordHelp');
        const confirmPasswordHelp = document.getElementById('confirmPasswordHelp');

        // Validate password length
        passwordInput.addEventListener('input', function () {
            if (passwordInput.value.length < 8) {
                passwordHelp.classList.remove('hidden');
            } else {
                passwordHelp.classList.add('hidden');
            }
        });

        // Validate if passwords match
        confirmPasswordInput.addEventListener('input', function () {
            if (passwordInput.value !== confirmPasswordInput.value) {
                confirmPasswordHelp.classList.remove('hidden');
            } else {
                confirmPasswordHelp.classList.add('hidden');
            }
        });
    </script>
</body>
@endsection
