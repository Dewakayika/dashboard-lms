@extends('layouts.app')

@section('title') Additional Info @endsection

@section('content')
<body>
    <section class="bg-white">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <!-- Left Image Section -->
            <div class="relative flex items-start px-4 pb-10 pt-6 sm:pb-16 md:justify-left lg:pb-24 bg-gray-50 sm:px-6 lg:px-8 hidden lg:block absolute inset-0">
                <div class="absolute inset-0">
                    <img class="object-cover h-full " src="{{ url('images/additional.jpg') }}" alt="" />
                </div>
                <div class="absolute">
                    <img style="width: 30px" src="{{ url('images/padma.jpg') }}" alt="">
                </div>
            </div>

            <!-- Form Section -->
            <div class="flex items-center justify-center min-h-screen px-4 py-10 bg-white sm:px-6 lg:px-8 sm:py-16 lg:py-24">
                <div class="xl:w-full xl:max-w-sm 2xl:max-w-md xl:mx-auto">
                    <h3 class="text-3xl font-bold leading-tight text-black sm:text-3xl">Talent QC Additional Info</h3>

                    <form action="{{ route('talentqc#submitData') }}" method="POST" class="mt-8 space-y-5" enctype="multipart/form-data">
                        @csrf

                        <!-- Profile Photo Input -->
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" id="dropzone-label" class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed rounded-lg cursor-pointer bg-white hover:bg-gray-100 file-input-border">
                                <div id="upload-area" class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg id="icon-upload" class="w-8 h-4 mb-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
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
                                <input id="dropzone-file" type="file" name="profile_photo" class="hidden" accept="image/*" />
                            </label>
                            @error('profile_photo')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Full Name -->
                        <div>
                            <label for="full_name" class="text-base font-medium text-gray-900">Full Name</label>
                            <input type="text" name="full_name" id="full_name" placeholder="Enter your full name" class="block w-full py-4 pl-4 pr-4 text-black placeholder-gray-500 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:bg-white" required>
                            @error('full_name')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="text-base font-medium text-gray-900">Address</label>
                            <input type="text" name="address" id="address" placeholder="Enter your address" class="block w-full py-4 pl-4 pr-4 text-black placeholder-gray-500 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:bg-white" required>
                            @error('address')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="school" class="text-base font-medium text-gray-900">Phone Number</label>
                            <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                <input type="number" name="phone_number" id="phone_number" placeholder="Enter your phone number" class="block w-full py-4 pl-4 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:bg-white" >
                            </div>
                            @error('phone_number')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="gender" class="text-base font-medium text-gray-900">Gender</label>
                            <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                <select name="gender" id="gender" class="block w-full py-4 pl-4 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:bg-white" >
                                    <option value="" disabled selected>Select your gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            @error('gender')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date of Birth -->
                        <div>
                            <label for="date_of_birth" class="text-base font-medium text-gray-900">Date of Birth</label>
                            <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                <input type="date" name="date_of_birth" id="date_of_birth"  class="block w-full py-4 pl-4 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:bg-white" >
                            </div>
                            @error('date_of_birth')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Date of Birth -->
                        <div>
                            <label for="date_of_birth" class="text-base font-medium text-gray-900">ID Card</label>
                            <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                <input type="number" name="id_card" id="id_card" placeholder="NIK Number" class="block w-full py-4 pl-4 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:bg-white" >
                            </div>
                            @error('id_card')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bank Name -->
                        <div>
                            <label for="bank_name" class="text-base font-medium text-gray-900">Bank Name</label>
                            <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                <input type="text" name="bank_name" id="bank_name" placeholder="Enter your bank name" class="block w-full py-4 pl-4 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:bg-white" >
                            </div>
                            @error('bank_name')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bank Account -->
                        <div>
                            <label for="bank_Account" class="text-base font-medium text-gray-900">Bank Account</label>
                            <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                <input type="text" name="bank_Account" id="bank_Account" placeholder="Enter your bank account number" class="block w-full py-4 pl-4 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:bg-white" >
                            </div>
                            @error('bank_Account')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bank Account -->
                        <div>
                            <label for="bank_account" class="text-base font-medium text-gray-900">Swift Code</label>
                            <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                <input type="text" name="swift_code" id="swift_code" placeholder="Enter your bank account number" class="block w-full py-4 pl-4 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:bg-white" >
                            </div>
                            @error('swift_code')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="bank_account" class="text-base font-medium text-gray-900">Subject Tax (Optional)</label>
                            <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                <input type="text" name="subjected_tax" id="subjected_tax" placeholder="Enter your bank account number" class="block w-full py-4 pl-4 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline focus:bg-white">
                            </div>
                            @error('subjected_tax')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" style="background-color: #2e2e2e" class="inline-flex items-center justify-center w-full px-4 py-4 text-base font-semibold text-white transition-all duration-200 border border-transparent rounded-md  focus:outline hover:opacity-80 focus:opacity-80">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        const dropzoneFile = document.getElementById('dropzone-file');
        const imagePreview = document.getElementById('image-preview');
        const uploadText = document.getElementById('upload-text');
        const uploadInfo = document.getElementById('upload-info');
        const fileNameDisplay = document.getElementById('file-name');
        const changeText = document.getElementById('change-text');

        dropzoneFile.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    fileNameDisplay.textContent = file.name;
                    fileNameDisplay.classList.remove('hidden');
                    uploadText.classList.add('hidden');
                    uploadInfo.classList.add('hidden');
                    changeText.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
@endsection
