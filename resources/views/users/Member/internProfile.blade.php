@php
    use Carbon\Carbon;
@endphp
@section('title')
    Intern Profile
@endsection

@extends('users.Member.layouts.app')

@section('content')
    <style>
        .background-banner{
            background-color: #f1f1f1;
            opacity: 0.8;
            background-image: radial-gradient(#0f0f0f 0.5px, #e5e5f7 0.5px);
            background-size: 10px 10px;
        }
    </style>
    <!-- Start content -->
    <body class="bg-gray-100">
        <div class="container mx-auto p-4">
            <header class="flex justify-between items-center mb-8">
                <div class="">
                <h1 class="text-2xl font-bold">Welcome, {{ $userData->name }}!</h1>
                <p class="text-m text-gray-500 py-1">{{ Carbon::now()->toFormattedDateString() }} </p>
                </div>
            </header>
    
            <div class="bg-white shadow rounded border">
                <div class="py-16 bg-blue-500 rounded-t background-banner"></div>
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('storage/' . $internData->profile_photo) }}" alt="Profile" id="profile-picture" class="w-16 h-16 rounded-full mr-4 ring-2 ring-gray-300 p-1 dark:ring-gray-200 cursor-pointer">
                            <div>
                                <h2 class="text-xl font-semibold">{{ $userData->name }}</h2>
                                <p class="text-gray-600">{{ $userData->email }}</p>
                            </div>
                        </div>
                        
                    </div>
                    <form action="{{ route('intern#editIntern') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-2">Full Name</label>
                                <input type="text" name="name"  value="{{ old('name', $userData->name) }}" class="block w-full py-3 pl-3 pr-4 text-black placeholder-gray-600 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:bg-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-2">Email</label>
                                <input type="email" name="email"  value="{{ old('email', $userData->email) }}" class="block w-full py-3 pl-3 pr-4 text-black placeholder-gray-600 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:bg-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-2">Gender</label>
                                <select name="gender" class="block w-full py-3 pl-3 pr-4 text-black placeholder-gray-600 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:bg-white">
                                    <option value="" disabled {{ $internData->gender == '' ? 'selected' : '' }}>Select Gender</option>
                                    <option value="Male" {{ $internData->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $internData->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ $internData->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>                            
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-2">Phone Number</label>
                                <input type="text" name="phone_number" value="{{ old('phone_number', $internData->phone_number) }}" class="block w-full py-3 pl-3 pr-4 text-black placeholder-gray-600 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:bg-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-2">School</label>
                                <input type="text" name="school_name"  value="{{ old('school_name', $internData->school_name) }}" class="block w-full py-3 pl-3 pr-4 text-black placeholder-gray-600 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:bg-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 mb-2">Address</label>
                                <input type="text" name="address"  value="{{ old('address', $internData->address) }}" class="block w-full py-3 pl-3 pr-4 text-black placeholder-gray-600 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:bg-white">
                            </div>
                        </div>
                        <div class="mt-5 text-right">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded" type="submit">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal -->
            <div id="uploadModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen px-4 text-center">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>

                    <!-- Modal content -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-bold text-gray-900 text-left">New Profile Picture</h3>
                            <p class="text-sm text-gray-600 text-left mb-2">Upgrade your profile picture</p>
                            <form action="{{ route('intern#updateProfilePicture') }}" method="POST" enctype="multipart/form-data">
                                @csrf
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
                                    <input id="dropzone-file" type="file" name="profile_photo" class="hidden"  />
                                </label>
                                <div class="mt-5 text-center">
                                    <button type="button" id="cancelUpload" class="bg-red-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const profilePicture = document.getElementById('profile-picture');
            const uploadModal = document.getElementById('uploadModal');
            const cancelUpload = document.getElementById('cancelUpload');
        
            profilePicture.addEventListener('click', function() {
                uploadModal.classList.remove('hidden');
            });
        
            cancelUpload.addEventListener('click', function() {
                uploadModal.classList.add('hidden');
            });
        </script>
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
