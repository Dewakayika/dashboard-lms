@extends('layouts.app')

@section('content')
<style>
    .file-input-border.active {
        border-color: #2563eb; /* Blue border when active */
    }
</style>

    <body>
        <section class="bg-gray-50">
            <div class="grid grid-cols-1 lg:grid-cols-2 h-screen">
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
                <div class="flex items-center justify-center px-4 py-10 bg-white sm:px-6 lg:px-8 sm:py-16 lg:py-24">
                    <div class="xl:w-full xl:max-w-sm 2xl:max-w-md xl:mx-auto">
                        <h2 class="text-3xl font-bold leading-tight text-black sm:text-3xl">Welcome Intern!🎉</h2>
                        <p class="py-2 text-gray-600"> Let’s put the finishing touches on your intern data!</p>
    
                        <!-- Registration Form -->
                        <form action="{{ route('intern#submitData') }}" method="POST" class="mt-8" enctype="multipart/form-data">
                            @csrf
                            <div class="space-y-5">

                                <!-- Profile Photo Input -->
                                <div class="flex items-center justify-center w-full">
                                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed rounded-lg cursor-pointer bg-white hover:bg-gray-100 file-input-border">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg id="icon-upload" class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                            <p id="upload-text" class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload profile picture</span></p>
                                            <p id="upload-info" class="text-xs text-gray-500"> PNG, JPG or GIF</p>
                                            <!-- Image preview -->
                                            <img id="image-preview" src="" alt="" class="hidden max-w-full max-h-40 mt-2">
                                            <!-- Filename display -->
                                            <p id="file-name" class="hidden mt-2 text-sm text-gray-600"></p>
                                            <p id="change-text" class="hidden text-sm text-blue-500 cursor-pointer">Click to Change</p>
                                        </div>
                                        <input id="dropzone-file" type="file" name="profile_photo" class="hidden" />
                                    </label>
                                    @error('profile_photo')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Phone Number Input -->
                                <div>
                                    <label for="phone_number" class="text-base font-medium text-gray-900">Phone Number</label>
                                    <div class="mt-2.5 relative">
                                        <input
                                            type="text" name="phone_number" id="phone_number"
                                            placeholder="Enter your phone number"
                                            class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:caret-black-600 focus:bg-white caret-black-600 @error('phone_number') is-invalid @enderror"
                                        />
                                        @error('phone_number')
                                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Address Input -->
                                <div>
                                    <label for="address" class="text-base font-medium text-gray-900">Address</label>
                                    <div class="mt-2.5 relative">
                                        <input
                                            type="text" name="address" id="address"
                                            placeholder="Enter your address"
                                            class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:caret-black-600 focus:bg-white caret-black-600 @error('address') is-invalid @enderror"
                                        />
                                        @error('address')
                                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Gender Input -->
                                <div>
                                    <label for="gender" class="text-base font-medium text-gray-900">Gender</label>
                                    <div class="mt-2.5 relative">
                                        <select name="gender" id="gender" class="block w-full py-4 pl-3 pr-4 text-black transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:caret-black-600 focus:bg-white caret-black-600 @error('gender') is-invalid @enderror">
                                            <option value="" disabled selected>Select your gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        @error('gender')
                                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- School Name Input -->
                                <div>
                                    <label for="school_name" class="text-base font-medium text-gray-900">School Name</label>
                                    <div class="mt-2.5 relative">
                                        <input
                                            type="text" name="school_name" id="school_name"
                                            placeholder="Enter your school name"
                                            class="block w-full py-4 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:caret-black-600 focus:bg-white caret-black-600 @error('school_name') is-invalid @enderror"
                                        />
                                        @error('school_name')
                                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div>
                                    <button type="submit" class="w-full py-4 text-base font-medium text-white bg-blue-600 rounded-md transition-all duration-200 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

        <script>
            const fileInput = document.getElementById('dropzone-file');
            const imagePreview = document.getElementById('image-preview');
            const fileLabel = document.querySelector('.file-input-border');
            const uploadText = document.getElementById('upload-text');
            const uploadInfo = document.getElementById('upload-info');
            const iconUpload = document.getElementById('icon-upload');
            const fileNameDisplay = document.getElementById('file-name');
            const changeText = document.getElementById('change-text');
        
            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    const reader = new FileReader();
        
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                        fileLabel.classList.add('active'); // Add blue border
                        // Hide upload text and icon
                        uploadText.classList.add('hidden');
                        uploadInfo.classList.add('hidden');
                        iconUpload.classList.add('hidden');
        
                        // Show file name and change text
                        fileNameDisplay.textContent = file.name;
                        fileNameDisplay.classList.remove('hidden');
                        changeText.classList.remove('hidden');
                    };
        
                    reader.readAsDataURL(file);
                }
            });
        </script>
    </body>
@endsection
