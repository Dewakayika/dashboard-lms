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
                                <label for="name" class="text-base font-medium text-gray-900">Name</label>
                                <div class="mt-2.5 relative">
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        placeholder="Enter your name"
                                        class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('name') is-invalid @enderror"
                                    />
                                    @error('name')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Gender Input -->
                            <div>
                                <label for="gender" class="text-base font-medium text-gray-900">Gender</label>
                                <div class="mt-2.5 relative">
                                    <select
                                        class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('gender') is-invalid @enderror"
                                        name="gender"
                                        id="gender"
                                        required
                                    >
                                        <option value="">Please Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    @error('gender')
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
                                    @error('password')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                    @enderror
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
                                        class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('registration_code') is-invalid @enderror"
                                    />
                                    @error('registration_code')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone Number Input -->
                            <div>
                                <label for="phone" class="text-base font-medium text-gray-900">Phone Number</label>
                                <div class="mt-2.5 relative">
                                    <input
                                        type="tel"
                                        name="phone"
                                        id="phone"
                                        placeholder="Enter your phone number"
                                        maxlength="12"
                                        class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('phone') is-invalid @enderror"
                                    />
                                    @error('phone')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Address Input -->
                            <div>
                                <label for="address" class="text-base font-medium text-gray-900">Address</label>
                                <div class="mt-2.5 relative">
                                    <input
                                        type="text"
                                        name="address"
                                        id="address"
                                        placeholder="Enter your address"
                                        class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('address') is-invalid @enderror"
                                    />
                                    @error('address')
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
</body>

{{-- <body>
    <section class="bg-gray-50">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <!-- Left side image -->
            <div class="relative flex items-center justify-center bg-gray-50">
                <div class="absolute inset-0">
                    <img
                        class="object-cover object-top w-full h-full"
                        src="https://cdn.rareblocks.xyz/collection/celebration/images/signin/4/girl-thinking.jpg"
                        alt="Sample image"
                    />
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                <div class="relative flex justify-center items-center">
                    <div class="w-full max-w-xl xl:w-full xl:mx-auto xl:pr-24 xl:max-w-xl">
                        <h1 class="text-4xl font-bold text-white">Padma Learning Center</h1>
                        <p class="text-xl font-semibold text-white mt-4">Your creative partner</p>
                    </div>
                </div>
            </div>

            <!-- Right side form -->
            <div class="flex items-center justify-center px-4 py-10 bg-white sm:px-6 lg:px-8 sm:py-16 lg:py-24">
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
                                <label for="name" class="text-base font-medium text-gray-900">Name</label>
                                <div class="mt-2.5 relative">
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        placeholder="Enter your name"
                                        class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('name') is-invalid @enderror"
                                    />
                                    @error('name')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="gender" class="text-base font-medium text-gray-900">Gender</label>
                                <div class="mt-2.5 relative">
                                    <select
                                        class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('gender') is-invalid @enderror"
                                        name="gender"
                                        id="gender"
                                        required
                                    >
                                        <option value="">Please Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    @error('gender')
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
                                    @error('password')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="registration_code">Registration Code</label>
                                <input id="registration_code" class="block mt-1 w-full" type="text" name="registration_code" required>
                            </div>
                            

                            <!-- Phone Number Input -->
                            <div>
                                <label for="phone" class="text-base font-medium text-gray-900">Phone Number</label>
                                <div class="mt-2.5 relative">
                                    <input
                                        type="tel"
                                        name="phone"
                                        id="phone"
                                        placeholder="Enter your phone number"
                                        maxlength="12"
                                        class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('phone') is-invalid @enderror"
                                    />
                                    @error('phone')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Address Input -->
                            <div>
                                <label for="address" class="text-base font-medium text-gray-900">Address</label>
                                <div class="mt-2.5 relative">
                                    <input
                                        type="text"
                                        name="address"
                                        id="address"
                                        placeholder="Enter your address"
                                        class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('address') is-invalid @enderror"
                                    />
                                    @error('address')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Gender Input -->
                            

                            <!-- Role Selection -->
                            <div>
                                <label for="role" class="text-base font-medium text-gray-900">Role</label>
                                <div class="mt-2.5 relative">
                                    <select
                                        class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('role') is-invalid @enderror"
                                        name="role"
                                        id="role"
                                        required
                                    >
                                        <option value="">Please Select Role</option>
                                        <option value="intern">Intern</option>
                                        <option value="talent">Talent</option>
                                    </select>
                                    @error('role')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Conditional Fields for Intern -->
                            <div class="intern box hidden">
                                <div class="mt-4">
                                    <label for="job" class="text-base font-medium text-gray-900">Job</label>
                                    <div class="mt-2.5 relative">
                                        <input
                                            type="text"
                                            name="job"
                                            id="job"
                                            placeholder="Enter your job"
                                            class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('job') is-invalid @enderror"
                                        />
                                        @error('job')
                                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Conditional Fields for Talent -->
                            <div class="talent box hidden">
                                <div class="mt-4">
                                    <label for="school" class="text-base font-medium text-gray-900">School</label>
                                    <div class="mt-2.5 relative">
                                        <input
                                            type="text"
                                            name="school"
                                            id="school"
                                            placeholder="Enter your school"
                                            class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('school') is-invalid @enderror"
                                        />
                                        @error('school')
                                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <label for="date_of_birth" class="text-base font-medium text-gray-900">Date of Birth</label>
                                    <div class="mt-2.5 relative">
                                        <input
                                            type="date"
                                            name="date_of_birth"
                                            id="date_of_birth"
                                            class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:caret-black-600 focus:bg-white caret-black-600 @error('date_of_birth') is-invalid @enderror"
                                        />
                                        @error('date_of_birth')
                                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button
                                    type="submit"
                                    class="w-full py-4 text-base font-medium text-white bg-blue-600 rounded-md transition-all duration-200 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                >Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript for Dynamic Form Fields -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const internFields = document.querySelector('.intern');
            const talentFields = document.querySelector('.talent');

            roleSelect.addEventListener('change', function() {
                if (roleSelect.value === 'intern') {
                    internFields.classList.remove('hidden');
                    talentFields.classList.add('hidden');
                } else if (roleSelect.value === 'talent') {
                    internFields.classList.add('hidden');
                    talentFields.classList.remove('hidden');
                } else {
                    internFields.classList.add('hidden');
                    talentFields.classList.add('hidden');
                }
            });
        });
    </script>

</body> --}}
@endsection