@section('title') Reset Password @endsection

@extends('layouts.app')

@section('content')
<body>
    <section class="bg-white">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <!-- Left image section -->
            <div class="h-screen relative flex items-start px-4 pb-10 pt-6 sm:pb-16 md:justify-left lg:pb-24 bg-gray-50 sm:px-6 lg:px-8 hidden lg:block absolute inset-0">
                <div class="absolute inset-0">
                    <img class="object-cover object-top w-full h-full cover" src="{{ url('images/login-image.jpg') }}" alt=""/>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>

                <div class="absolute">
                    <div>
                        <img style="width: 30px" src="{{ url('images/padma.png') }}" alt="">
                    </div>
                </div>
            </div>

            <!-- Form section -->
            <div class="flex items-center justify-center min-h-screen px-4 py-10 bg-white sm:px-12 lg:px-24 sm:py-16 lg:py-24">
                <div class="xl:w-full xl:max-w-sm 2xl:max-w-md xl:mx-auto">
                    <h3 class="text-3xl font-bold leading-tight text-black sm:text-3xl">Reset Your Password</h3>
                    <p class="mt-2 text-base text-gray-600">Enter your new password below.</p>

                    <!-- Reset Password Form -->
                    <form method="POST" action="{{ route('password.update') }}" class="mt-8">
                        @csrf

                        <!-- Hidden token input -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Input -->
                        <div class="space-y-5">
                            <div>
                                <label for="email" class="text-base font-medium text-gray-900">Email address</label>
                                <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                        </svg>
                                    </div>
                                    <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required autofocus class="block w-full py-4 pl-10 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:bg-white"/>
                                </div>
                                @error('email')
                                    <p style="padding-top: 10px;color: red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div>
                                <label for="password" class="text-base font-medium text-gray-900">New Password</label>
                                <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/>
                                        </svg>
                                    </div>
                                    <input type="password" id="password" name="password" required autocomplete="new-password" class="block w-full py-4 pl-10 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:bg-white"/>
                                </div>
                                @error('password')
                                    <p style="padding-top: 10px;color: red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password Input -->
                            <div>
                                <label for="password_confirmation" class="text-base font-medium text-gray-900">Confirm New Password</label>
                                <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/>
                                        </svg>
                                    </div>
                                    <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" class="block w-full py-4 pl-10 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:bg-white"/>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button type="submit" style="background-color: #2e2e2e" class="inline-flex items-center justify-center w-full px-4 py-4 text-base font-semibold text-white transition-all duration-200 border border-transparent rounded-md hover:opacity-80 focus:opacity-80">
                                    Reset Password
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
