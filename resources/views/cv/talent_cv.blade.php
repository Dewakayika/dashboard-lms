@section('title')
    Intern | Upload CV
@endsection

@extends('layouts.app')
@section('content')
<section class="bg-white">
    <div class="min-h-screen flex flex-col lg:grid lg:grid-cols-2">
        <div class="flex items-center justify-center px-4 py-10 sm:px-6 lg:px-8 sm:py-16 lg:py-24">
            <div class="xl:w-full xl:max-w-sm 2xl:max-w-md xl:mx-auto">
                <h2 class="text-3xl font-bold leading-tight text-black sm:text-4xl">Upload Your CV</h2>
                <p class="mt-2 text-base text-gray-600">Please provide your details and upload your CV.</p>

                <form action="{{ route('talent#cvSubmit') }}" method="POST" enctype="multipart/form-data" class="mt-8">
                    @csrf
                    <div class="space-y-5">
                
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="text-base font-medium text-gray-900"> Name </label>
                            <div class="mt-2.5">
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    placeholder="Enter your name"
                                    value="{{ old('name') }}" 
                                    class="block w-full p-2 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:border-blue-600 focus:bg-white caret-blue-600"
                                    required
                                />
                                @if ($errors->has('name'))
                                    <p class="text-red-600 text-sm mt-1">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                        </div>
                
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="text-base font-medium text-gray-900"> Email address </label>
                            <div class="mt-2.5">
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    placeholder="Enter your email"
                                    value="{{ old('email') }}" 
                                    class="block w-full p-2 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:border-blue-600 focus:bg-white caret-blue-600"
                                    required
                                />
                                @if ($errors->has('email'))
                                    <p class="text-red-600 text-sm mt-1">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>
                
                        <!-- Phone Number Field -->
                        <div>
                            <label for="phone_number" class="text-base font-medium text-gray-900"> Phone Number </label>
                            <div class="mt-2.5">
                                <input
                                    type="text"
                                    name="phone_number"
                                    id="phone_number"
                                    placeholder="Enter your phone number"
                                    value="{{ old('phone_number') }}" 
                                    class="block w-full p-2 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:border-blue-600 focus:bg-white caret-blue-600"
                                    required
                                />
                                @if ($errors->has('phone_number'))
                                    <p class="text-red-600 text-sm mt-1">{{ $errors->first('phone_number') }}</p>
                                @endif
                            </div>
                        </div>
                
                        <!-- CV File Upload -->
                        <div>
                            <label for="cv_file" class="text-base font-medium text-gray-900"> Upload CV </label>
                            <div class="mt-2.5">
                                <input
                                    type="file"
                                    name="cv_file"
                                    id="cv_file"
                                    accept=".pdf,.doc,.docx"
                                    class="block w-full p-2 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:border-blue-600 focus:bg-white caret-blue-600"
                                    required
                                />
                                @if ($errors->has('cv_file'))
                                    <p class="text-red-600 text-sm mt-1">{{ $errors->first('cv_file') }}</p>
                                @endif
                            </div>
                        </div>
                
                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="inline-flex items-center justify-center w-full px-2 py-2 text-base font-semibold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-md focus:outline-none hover:bg-blue-700 focus:bg-blue-700">Submit</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>

        <div class="hidden lg:flex items-center justify-center h-screen">
            <div>
                <img class="w-full mx-auto" src="{{url('images/cv-baner.jpg')}}" alt="" />
            </div>
        </div>
        
    </div>
</section>
@endsection
