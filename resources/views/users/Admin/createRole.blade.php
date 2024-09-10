@extends('Users.Admin.layouts.app')

@section('title')
    Add New Role
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@section('content')
    <section class="py-10  sm:py-16 lg:py-24">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-xl font-bold leading-tight text-black sm:text-4xl lg:text-2xl">Registration Code</h2>
                <p class=" mx-auto mt-4 text-base leading-relaxed text-gray-600">Fill in the details below to add a new registration code.</p>
            </div>

            <div class="relative max-w-md mx-auto mt-8 md:mt-16">
                <div class="overflow-hidden bg-white rounded-md shadow">
                    <div class="px-4 py-6 sm:px-8 sm:py-7">
                        <!-- Error Handling -->
                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-300 rounded-md">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (Session::has('roleCreated'))
                            <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded-md">
                                {{ Session::get('roleCreated') }}
                            </div>
                        @endif

                        <form action="{{ route('admin#storeRole') }}" method="POST">
                            @csrf
                            <div class="space-y-5">
                                <div>
                                    <label for="registration_code" class="text-base font-medium text-gray-900">Registration Code</label>
                                    <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <!-- Add an appropriate icon if needed -->
                                            <i class="fa-solid fa-key"></i>
                                        </div>
                                        <input
                                            type="text"
                                            id="registration_code"
                                            name="registration_code"
                                            placeholder="Enter registration code"
                                            class="block w-full py-3 pl-10 pr-4 text-black placeholder-gray-500 transition-all duration-200 bg-white border border-gray-200 rounded-md focus:outline-none focus:border-blue-600 caret-blue-600"
                                            value="{{ old('registration_code') }}"
                                            required
                                        />
                                    </div>
                                </div>

                                <div>
                                    <label for="role_types" class="text-base font-medium text-gray-900">Role Type</label>
                                    <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                        <select
                                            name="role_types"
                                            id="role_types"
                                            class="block w-full py-3 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 bg-white border border-gray-200 rounded-md focus:outline-none focus:border-blue-600 caret-blue-600 @error('role_types') is-invalid @enderror"
                                            required
                                        >
                                            <option value="">Please Select Role</option>
                                            <option value="intern" {{ old('role_types') == 'intern' ? 'selected' : '' }}>Intern</option>
                                            <option value="talent" {{ old('role_types') == 'talent' ? 'selected' : '' }}>Talent</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="inline-flex items-center justify-center w-full px-3 py-3 text-base font-semibold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-md focus:outline-none hover:bg-blue-700 focus:bg-blue-700">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
