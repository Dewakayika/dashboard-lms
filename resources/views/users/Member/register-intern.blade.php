@extends('layouts.app')

@section('content')

    <body>
        <section class="bg-gray-50">
            <div class="grid grid-cols-1 lg:grid-cols-2 h-screen">
                <!-- Left side image -->
                <div class="h-screen relative flex items-start px-4 pb-10 pt-6 sm:pb-16 md:justify-left lg:pb-24 bg-gray-50 sm:px-6 lg:px-8 hidden lg:block absolute inset-0">
                    <div class="absolute inset-0">
                        <img class="object-cover object-top w-full h-full cover" src="{{ url('images/login-image.jpg') }}" alt="" />
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
    
                    <div class="absolute">
                        <div class="">
                            <img style="width: 30px" src="{{ url('images/padma.png') }}" alt="">
                        </div>
                    </div>
                </div>
    
                <!-- Right side form -->
                <div class="flex items-center justify-center px-4 py-10 bg-white sm:px-6 lg:px-8 sm:py-16 lg:py-24">
                    <div class="xl:w-full xl:max-w-sm 2xl:max-w-md xl:mx-auto">
                        <h2 class="text-3xl font-bold leading-tight text-black sm:text-4xl">Intern Additional Info</h2>
    
                        <!-- Registration Form -->
                        <form action="{{ route('intern#submitData') }}" method="POST" class="mt-8">
                            @csrf
                            <div class="space-y-5">
                                <!-- Name Input -->
                                <div>
                                    <label for="name" class="text-base font-medium text-gray-900">Job Tittle</label>
                                    <div class="mt-2.5 relative">
                                        <input
                                            type="text" name="job" id="job"
                                            placeholder="Enter your Job"
                                            class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('name') is-invalid @enderror"
                                        />
                                        @error('job')
                                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
    
                                    
                                <!-- Submit Button -->
                                <div>
                                    <button
                                        type="submit"
                                        class="w-full py-4 text-base font-medium text-white bg-blue-600 rounded-md transition-all duration-200 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                    >Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
@endsection
