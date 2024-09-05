@section('title')
    Login
@endsection

@extends('layouts.app')
@section('content')
    <body>
    <div class="min-h-screen flex flex-col items-center justify-center">
  <div class="flex flex-col bg-white px-4 sm:px-6 md:px-8 lg:px-10 py-8 rounded-md w-full max-w-md">
    <div>
        <div class="font-medium self-center text-m sm:text-2xl  text-gray-800">Welcome Back!</div>
        <p class="font-xs self-center text-m sm:text-xs  text-gray-800 mt-2">Input your credentials</p>
    </div>
    <div class="relative mt-5 h-px bg-gray-300">
    </div>
    <div class="mt-10">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="flex flex-col mb-6">
          <label for="email" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-500">E-Mail Address:</label>
          <div class="relative">
            <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
              <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
              </svg>
            </div>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-Mail Address" class="text-s sm:text-base placeholder-gray-200 pl-10 pr-4 rounded border border-gray-200 w-full py-2 focus:outline-none focus:border-blue-400 @error('email') is-invalid @enderror" />
          </div>
          @error('email')
            <p class="invalid-feedback" role="alert" >
                <p style="padding-top: 10px;color: red;">{{ $message }}</p>
            </p>
            @enderror
        </div>
        <div class="flex flex-col mb-6">
          <label for="password" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-500">Password:</label>
          <div class="relative">
            <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
              <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
            </div>
            <input id="password" type="password" name="password" required placeholder="Password" class="text-sm sm:text-base placeholder-gray-200 pl-10 pr-4 rounded border border-gray-200 w-full py-2 focus:outline-none focus:border-blue-400 @error('password') is-invalid @enderror" />
          </div>
          @error('password')
            <p class="invalid-feedback" role="alert">
               <p>{{ $message }}</p>
            </p>
            @enderror
        </div>

        <div class="flex items-center mb-6 -mt-4">
          <div class="flex ml-auto">
            <a href="{{ route('password.request') }}" class="inline-flex text-xs sm:text-sm text-blue-500 hover:text-blue-700">Forgot Your Password?</a>
          </div>
        </div>

        <div class="flex w-full">
          <button type="submit" class="flex items-center justify-center focus:outline-none text-white text-sm sm:text-base bg-blue-600 hover:bg-blue-700 rounded py-2 w-full transition duration-150 ease-in">
            <h5 class="mr-2 uppercase">Login</h5>
          </button>
        </div>
      </form>
    </div>
    <div class="flex justify-center items-center mt-6">
      <a href="#" target="_blank" class="inline-flex items-center font-bold text-blue-500 hover:text-blue-700 text-xs text-center">
        <span>
        </span>
        <p class="ml-2">You don't have an account?</p>
      </a>
    </div>
  </div>
</div>

    </body>
@endsection


