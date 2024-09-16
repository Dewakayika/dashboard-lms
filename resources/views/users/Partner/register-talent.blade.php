@extends('layouts.app')

@section('title') Additional Info @endsection

@section('content')
<body>
    <section class="bg-white">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <!-- Left Image Section -->
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

            <!-- Form Section -->
            <div class="flex items-center justify-center min-h-screen px-4 py-10 bg-white sm:px-6 lg:px-8 sm:py-16 lg:py-24">
                <div class="xl:w-full xl:max-w-sm 2xl:max-w-md xl:mx-auto">
                    <h3 class="text-3xl font-bold leading-tight text-black sm:text-3xl">Talent Additional Info</h3>

                    <form action="{{ route('talent#submitData') }}" method="POST" class="mt-8 space-y-5">
                        @csrf

                        <!-- School -->
                        <div>
                            <label for="school" class="text-base font-medium text-gray-900">School</label>
                            <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                <input type="text" name="school" id="school" placeholder="Enter your school" class="block w-full py-4 pl-4 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:bg-white" required>
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <div>
                            <label for="date_of_birth" class="text-base font-medium text-gray-900">Date of Birth</label>
                            <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                <input type="date" name="date_of_birth" id="date_of_birth" class="block w-full py-4 pl-4 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:bg-white" required>
                            </div>
                        </div>

                        <!-- Bank Name -->
                        <div>
                            <label for="bank_name" class="text-base font-medium text-gray-900">Bank Name</label>
                            <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                <input type="text" name="bank_name" id="bank_name" placeholder="Enter your bank name" class="block w-full py-4 pl-4 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:bg-white" required>
                            </div>
                        </div>

                        <!-- Bank Account -->
                        <div>
                            <label for="bank_account" class="text-base font-medium text-gray-900">Bank Account</label>
                            <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                <input type="text" name="bank_account" id="bank_account" placeholder="Enter your bank account number" class="block w-full py-4 pl-4 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:bg-white" required>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" style="background-color: #2e2e2e" class="inline-flex items-center justify-center w-full px-4 py-4 text-base font-semibold text-white transition-all duration-200 border border-transparent rounded-md hover:opacity-80 focus:opacity-80">
                                Submit
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</body>
@endsection
