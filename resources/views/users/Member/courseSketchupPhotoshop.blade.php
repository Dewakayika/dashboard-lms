@extends('users.Member.layouts.app')

@section('title')
    Course | SketcUp to Photoshop
@endsection

@section('content')
    <style type="text/css">
        #volunteer {
            max-width: 600px;
            padding: 20px;
            margin: 50px auto;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .active-menu {
            background-color: #007bff;
            color: white;
        }

        .video-overview {
            font-size: 0.875rem;
            color: #555;
            margin-top: 4px;
        }

        .video-overview .overview-title {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .video-overview span {
            display: block;
            margin-bottom: 4px;
            margin-top: 4px;
            text-align: justify;
        }
        .video-material{
            font-weight: bold;
            font-size: 0.875rem;
            color: #555;
            text-decoration: underline;
        }

        .hamburger {
            position: fixed;
            top: 90%;
            padding: 15px;
            margin-left: -15px;
            background: rgb(141, 141, 141);
            border-radius: 5px;
            color: white;
        }

        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        @media (min-width:768px){
            .hamburger{
                display: none;
            }
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                bottom: 0;
                width: 80%;
                transition: 0.3s;
                z-index: 1000;
            }

            .sidebar.open {
                left: 0;
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .hamburger {
                display: block;
                position: fixed;
                top: 10px;
                left: 10px;
                z-index: 1001;
                background: none;
                border: none;
                font-size: 30px;
                cursor: pointer;
            }
        }
    </style>

    <!-- Start content -->
    <div class="bg-gray-100">
        <!-- Hamburger menu button -->
        <button class="hamburger" onclick="toggleSidebar()"  style="            
            position: fixed;
            top: 90%;
            padding: 15px;
            margin-left: -15px;
            background: rgb(141, 141, 141);
            /* border-image: round; */
            border-radius: 5px;
            color: white;
            ">
            <i class="fa-solid fa-bars"></i>    
        </button>

        <!-- Overlay -->
        <div class="overlay" onclick="toggleSidebar()"></div>

        <div class="flex flex-col md:flex-row h-screen">
            <!-- Sidebar -->
            <aside class="sidebar w-full md:w-80 bg-white p-4 overflow-y-auto">
                <a class="flex items-center mb-6" href="{{ url('/dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="text-lg font-bold">My Dashboard</span>
                </a>
                <nav>   
                    <div class="mb-4">
                        <ul id="sidebarMenu" class="space-y-2">
                            <li>
                                <button class="dropdown-button flex items-center p-2 rounded hover:bg-gray-100 w-full" aria-expanded="false" data-target="dropdownMenu1">
                                    <span class="font-bold">1. Scene Setup in SketchUp </span>
                                    <svg class="ml-auto transition-transform transform dropdown-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul id="dropdownMenu1" class="pl-3 space-y-2 hidden gap-3 py-2"> 
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="introduction">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Introduction</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="model-overview">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Model Overview</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="layer-overview">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Layer Overview</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="scene">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Scene Setup</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="export">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Export Sketchup</span>
                                        </a>
                                    </li>      
                                </ul>
                            </li>

                            <hr>

                            <li>
                                <button class="dropdown-button flex items-center p-2 rounded hover:bg-gray-100 w-full" aria-expanded="false" data-target="dropdownMenu2">
                                    <span class="font-bold">2. Post-Processing </span>
                                    <svg class="ml-auto transition-transform transform dropdown-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul id="dropdownMenu2" class="pl-3 space-y-2 hidden gap-3 py-2"> 
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="import">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Import File Photoshop</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="layer-organization">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Photoshop Layer Organization</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="color-overlay">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Based Color Overlay</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="shadow-setting">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Shadows Setting</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="linework">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Linework Adjustments</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="entourage-adjustment">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Entourage Adjustments</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="color-texture">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Color & Texture Effects</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="color-wash">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Color Wash</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="final">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Final Adjustments</span>
                                        </a>
                                    </li>      
                                </ul>
                            </li>

                            <hr>

                            <li>
                                <button class="dropdown-button flex items-center p-2 rounded hover:bg-gray-100 w-full" aria-expanded="false" data-target="dropdownMenu3">
                                    <span class="font-bold">Asignment</span>
                                    <svg class="ml-auto transition-transform transform dropdown-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul id="dropdownMenu3" class="pl-3 space-y-2 hidden gap-3 py-2"> 
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100 gap-2" data-video="submission">
                                            <i class="fa-solid fa-file-arrow-up"></i>
                                            <span>Assignment Submission</span>
                                        </a>
                                    </li>    
                                </ul>
                            </li>

                            <hr>

                        </ul>
                    </div>
                </nav>
            </aside>

            <!-- Main content -->
            <main class="flex-1 p-4 md:p-8 overflow-y-auto">
                <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                    <h1 class="text-2xl font-bold mb-2">Sketchup to Photoshop</h1>
                </header>
                <div id="videoCourse" class="bg-white rounded-lg shadow-md p-4">
                    <div class="video-container mt-4">
                        <iframe id="video-placeholder" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <h2 id="video-title" class="text-2xl font-bold mt-2">Tittle Course</h2>
                    <div id="video-overview" class="video-overview">
                        <!-- Video Overview content will be injected here dynamically -->
                    </div>
                    <div class="video-material">
                        <a href="https://drive.google.com/file/d/1K8rjT5VtBk6rBX2IlMjw7rzy75XdkxFR/view?usp=drive_link"  target="_blank">Download Material</a>
                    </div>
                </div>

                <div id="submission" class="bg-white rounded-lg shadow-md p-4 mt-4">
                    <h3 class="text-xl font-medium text-gray-900">Assignment Submission</h3>
                    <p class="text-sm font-regular text-gray-600 mt-2 text-justify">
                        The assignment for the submission in this course is to create a scene in SketchUp and produce a final image that has been edited in Photoshop in PNG format. Use your creativity to complete this course successfully, ensuring that you watch all the videos to effectively understand the material needed for this task. Download the practice materials from the provided link and work on this assignment diligently.
                    </p>

                    <p class="text-sm font-regular text-gray-600 mt-2 text-justify">
                        Upload the SketchUp (.skp) file and the PNG image into a single zip file. Then, upload the zip file to Google Drive. Make sure to set the file's sharing settings to public access. Finally, submit the Google Drive link in the submission file to ensure it can be accessed by others.
                    </p>

                    <p class="text-sm font-regular text-gray-600 mt-2 text-justify">
                        Make sure to follow all the assignment requirements carefully. Please note that multiple submissions for the same assignment are not allowed. 
                        If you need to change any submitted information, please contact your mentor or administrator directly.
                    </p>                    
                    
                    @if (!$submissionExists)
                    <form action="{{ route('submission_course.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="course_name" value="{{ $courseName }}" class="border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border rounded-md px-2 py-2 mt-2">
                        <input type="hidden" name="chapter_name" value="{{ $chapterName }}" class="border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border rounded-md px-2 py-2 mt-2">
                    
                        <div class="flex items-center justify-center w-full mt-4">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed rounded-lg cursor-pointer bg-white hover:bg-gray-100 file-input-border">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg id="icon-upload" class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p id="upload-text" class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload assignment thumbnail</span></p>
                                    <p id="upload-info" class="text-xs text-gray-500">PNG, JPG, or GIF</p>
                                    <img id="image-preview" src="" alt="" class="hidden max-w-full max-h-40 mt-2">
                                    <p id="file-name" class="hidden mt-2 text-sm text-gray-600"></p>
                                    <p id="change-text" class="hidden text-sm text-blue-500 cursor-pointer">Click to Change</p>
                                </div>
                                <input id="dropzone-file" type="file" name="thumbnail" class="hidden" accept="image/png, image/jpeg, image/gif" required />
                            </label>
                        </div>
                        @error('thumbnail')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}" class="border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border rounded-md">
                    
                        <div class="mb-4">
                            <label for="submission_file" class="text-base font-medium text-gray-900">Submission File</label>
                            <input type="text" name="submission_file" class="mt-2 block w-full py-2 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:caret-black-600 focus:bg-white">
                        </div>
                    
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded fw-bold">Submit</button>
                    </form>

                    @else
                        <!-- Display alternative message if submission already exists -->
                        <div class=" text-center text-gray-600 mt-6">
                            <div class="flex justify-center items-center">
                                <img class=" h-56" src="{{ url('images/ilustration/success.png') }}" alt="success-icons">
                            </div>
                            <p class="text-m italic">Your submission for <span class="font-semibold">{{ $courseName }}</span> has already been submitted.</p>
                            <p class="text-sm italic">If you need to make changes, check on <a class="underline" href="{{route('intern#internProfile')}}">submission history</a></p>
                        </div>
                    @endif                     
                </div>
            </main>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const videoLinks = document.querySelectorAll('.video-link');
                const videoPlaceholder = document.getElementById('video-placeholder');
                const videoTitle = document.getElementById('video-title');
                const videoOverview = document.getElementById('video-overview');

                // Automatically select the first video when the page loads
                const firstVideoLink = videoLinks[0];
                firstVideoLink.classList.add('active-menu');
                updateVideo(firstVideoLink.getAttribute('data-video'));

                videoLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const videoId = this.getAttribute('data-video');
                        updateVideo(videoId);

                        // Remove active class from all links
                        videoLinks.forEach(l => l.classList.remove('active-menu'));
                        // Add active class to clicked link
                        this.classList.add('active-menu');

                        // Close sidebar on mobile after clicking a link
                        if (window.innerWidth <= 768) {
                            toggleSidebar();
                        }
                    });
                });

                function updateVideo(videoId) {
                    let videoUrl, title, overviewContent;
                    switch(videoId) {
                        case 'introduction':
                            videoUrl = 'https://drive.google.com/file/d/1_ylxPkmPfVnDl4qX3ErhvjUR2Cq_8Yu3/preview';
                            title = 'Introduction';
                            overviewContent = `
                                <span class="overview-title">Duration: 1:17 minute | Beginner</span>
                                <hr>
                                <span>This specialized course focuses on mastering the seamless workflow between SketchUp and Photoshop to create high-quality, detailed webtoon backgrounds. You'll learn how to export 3D models from SketchUp with optimal settings and refine them in Photoshop using powerful tools like adjustment layers</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        case 'model-overview':
                            videoUrl = 'https://drive.google.com/file/d/1LfKd9EnpXt-N9plgjiM-vX-sHi8pmUST/preview';
                            title = 'Model Overview';
                            overviewContent = `
                                <span class="overview-title">Duration: 1:09 minute | Beginner</span>
                                <hr>
                                <span>This specialized course focuses on mastering the seamless workflow between SketchUp and Photoshop to create high-quality, detailed webtoon backgrounds. You'll learn how to export 3D models from SketchUp with optimal settings and refine them in Photoshop using powerful tools like adjustment layers</span>
                                <span>Skills Covered: Understanding Tools</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        case 'layer-overview':
                            videoUrl = 'https://drive.google.com/file/d/1RDHIY6fv7Ppf578dpnVxSYTmuUHC5Q67/preview';
                            title = 'Layer Overview';
                            overviewContent = `
                                <span class="overview-title">Duration: 1:09 minute | Beginner</span>
                                <hr>
                                <span>This specialized course focuses on mastering the seamless workflow between SketchUp and Photoshop to create high-quality, detailed webtoon backgrounds. You'll learn how to export 3D models from SketchUp with optimal settings and refine them in Photoshop using powerful tools like adjustment layers</span>
                                <span>Skills Covered: Understanding Tools</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        case 'scene':
                            videoUrl = 'https://drive.google.com/file/d/11dOc7D5BP02XjoX0vu1fMS2VdIh_4PyP/preview';
                            title = 'Scene Setup';
                            overviewContent = `
                                <span class="overview-title">Duration: 6:33 seconds | Beginner</span>
                                <hr>
                                <span>This specialized course focuses on mastering the seamless workflow between SketchUp and Photoshop to create high-quality, detailed webtoon backgrounds. You'll learn how to export 3D models from SketchUp with optimal settings and refine them in Photoshop using powerful tools like adjustment layers</span>
                                <span>Skills Covered: Understanding Selection</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        case 'export':
                            videoUrl = 'https://drive.google.com/file/d/1cQXrnlUVEwIuCcbQeZnjCnpIGBFirRop/preview';
                            title = 'Export SkecthUp';
                            overviewContent = `
                                <span class="overview-title">Duration: 1:28 minute | Beginner</span>
                                <hr>
                                <span>This specialized course focuses on mastering the seamless workflow between SketchUp and Photoshop to create high-quality, detailed webtoon backgrounds. You'll learn how to export 3D models from SketchUp with optimal settings and refine them in Photoshop using powerful tools like adjustment layers</span>
                                <span>Skills Covered: Understanding Grouping</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        case 'import':
                            videoUrl = 'https://drive.google.com/file/d/1WUE7cDTfOxDx3MoFW-5ZGqIR4erPLZq5/preview';
                            title = 'Import File Photoshop';
                            overviewContent = `
                                <span class="overview-title">Duration: 0:36 minute | Beginner</span>
                                <hr>
                                <span>This specialized course focuses on mastering the seamless workflow between SketchUp and Photoshop to create high-quality, detailed webtoon backgrounds. You'll learn how to export 3D models from SketchUp with optimal settings and refine them in Photoshop using powerful tools like adjustment layers</span>
                                <span>Skills Covered: Understanding Component</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        case 'layer-organization':
                            videoUrl = 'https://drive.google.com/file/d/1FeefgzGXnoUmekHH6LUG3kXVANH4tTmK/preview';
                            title = 'Photoshop Layer Organization';
                            overviewContent = `
                                <span class="overview-title">Duration: 8:21 minute | Beginner</span>
                                <hr>
                                <span>This specialized course focuses on mastering the seamless workflow between SketchUp and Photoshop to create high-quality, detailed webtoon backgrounds. You'll learn how to export 3D models from SketchUp with optimal settings and refine them in Photoshop using powerful tools like adjustment layers</span>
                                <span>Skills Covered: Understanding Component</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                        break;
                        case 'color-overlay':
                            videoUrl = 'https://drive.google.com/file/d/1TR_wN8mKSWzA2m4SJJ9XNOK9694ysNXa/preview';
                            title = 'Base Color Overlay';
                            overviewContent = `
                                <span class="overview-title">Duration: 4:16 minute | Beginner</span>
                                <hr>
                                <span>This specialized course focuses on mastering the seamless workflow between SketchUp and Photoshop to create high-quality, detailed webtoon backgrounds. You'll learn how to export 3D models from SketchUp with optimal settings and refine them in Photoshop using powerful tools like adjustment layers</span>
                                <span>Skills Covered: Understanding Component</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                        break;
                        case 'shadow-setting':
                            videoUrl = 'https://drive.google.com/file/d/1wOsZd3iGNib6ugvWSrbY0rE7xtZ3RVV8/preview';
                            title = 'Shadow Seting';
                            overviewContent = `
                                <span class="overview-title">Duration: 5:21 minute | Beginner</span>
                                <hr>
                                <span>This specialized course focuses on mastering the seamless workflow between SketchUp and Photoshop to create high-quality, detailed webtoon backgrounds. You'll learn how to export 3D models from SketchUp with optimal settings and refine them in Photoshop using powerful tools like adjustment layers</span>
                                <span>Skills Covered: Understanding Component</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                        break;
                        case 'entourage-adjustment':
                            videoUrl = 'https://drive.google.com/file/d/1hktGzp8oFypGbBiGtEhw0UKymcxgb9L1/preview';
                            title = 'Entourage Adjustments';
                            overviewContent = `
                                <span class="overview-title">Duration: 3:57 minute | Beginner</span>
                                <hr>
                                <span>This specialized course focuses on mastering the seamless workflow between SketchUp and Photoshop to create high-quality, detailed webtoon backgrounds. You'll learn how to export 3D models from SketchUp with optimal settings and refine them in Photoshop using powerful tools like adjustment layers</span>
                                <span>Skills Covered: Understanding Component</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                        break;
                        case 'linework':
                            videoUrl = 'https://drive.google.com/file/d/1GJYYaDskc6zYQBTIxjexsbJhc6VHUsH0/preview';
                            title = 'Linework Adjustment';
                            overviewContent = `
                                <span class="overview-title">Duration: 3:02 minute | Beginner</span>
                                <hr>
                                <span>This specialized course focuses on mastering the seamless workflow between SketchUp and Photoshop to create high-quality, detailed webtoon backgrounds. You'll learn how to export 3D models from SketchUp with optimal settings and refine them in Photoshop using powerful tools like adjustment layers</span>
                                <span>Skills Covered: Understanding Component</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                        break;
                        case 'color-texture':
                            videoUrl = 'https://drive.google.com/file/d/1lNj8Y8-1wp9gh-XNMiozc20Cl_yCGaya/preview';
                            title = 'Color & Texture Effects';
                            overviewContent = `
                                <span class="overview-title">Duration: 1:11 minute | Beginner</span>
                                <hr>
                                <span>This specialized course focuses on mastering the seamless workflow between SketchUp and Photoshop to create high-quality, detailed webtoon backgrounds. You'll learn how to export 3D models from SketchUp with optimal settings and refine them in Photoshop using powerful tools like adjustment layers</span>
                                <span>Skills Covered: Understanding Component</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                        break;
                        case 'color-wash':
                            videoUrl = 'https://drive.google.com/file/d/1fYpMnESKCLJax79H-FOblTzOdjKTyJSU/preview';
                            title = 'Color Wash';
                            overviewContent = `
                                <span class="overview-title">Duration: 1:22 minute | Beginner</span>
                                <hr>
                                <span>This specialized course focuses on mastering the seamless workflow between SketchUp and Photoshop to create high-quality, detailed webtoon backgrounds. You'll learn how to export 3D models from SketchUp with optimal settings and refine them in Photoshop using powerful tools like adjustment layers</span>
                                <span>Skills Covered: Understanding Component</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                        break;
                        case 'final':
                            videoUrl = 'https://drive.google.com/file/d/1FjKs9D-VE08JgJY3Cog91_z-z-Z7pIG_/preview';
                            title = 'Final Adjustment';
                            overviewContent = `
                                <span class="overview-title">Duration: 2:41 minute | Beginner</span>
                                <hr>
                                <span>This specialized course focuses on mastering the seamless workflow between SketchUp and Photoshop to create high-quality, detailed webtoon backgrounds. You'll learn how to export 3D models from SketchUp with optimal settings and refine them in Photoshop using powerful tools like adjustment layers</span>
                                <span>Skills Covered: Understanding Component</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                        break;
                        case 'submission':
                            videoUrl = 'https://drive.google.com/file/d/1dTXTx7eERuyhhiO_xcm5Wm0rdm-XuH1n/preview';
                            title = 'Submission';
                            overviewContent = `
                                <span class="overview-title">Duration: 0:54 minute | Beginner</span>
                                <hr>
                                <span>We're so excited to have you here with us. In this wonderful space, we'll dive deep into the world of webtoon backgrounds and explore what it takes to become a skilled webtoon background designer. Whether you're just starting out or looking to hone your craft, there's a place for you here. Let's learn, create, and grow together!</span>
                            `;
                            document.getElementById('videoCourse').style.display = 'none';
                            document.getElementById('submission').style.display = 'block';
                            break;
                    }

                    videoTitle.textContent = title;
                    videoPlaceholder.src = videoUrl;
                    videoOverview.innerHTML = overviewContent;
                }
            });

            // Function to toggle sidebar
            function toggleSidebar() {
                const sidebar = document.querySelector('.sidebar');
                const overlay = document.querySelector('.overlay');
                sidebar.classList.toggle('open');
                if (sidebar.classList.contains('open')) {
                    overlay.style.display = 'block';
                } else {
                    overlay.style.display = 'none';
                }
            }
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const sidebarMenu = document.getElementById('sidebarMenu');

                sidebarMenu.addEventListener('click', function (event) {
                    // Check if the clicked element has the class 'dropdown-button'
                    if (event.target.closest('.dropdown-button')) {
                        const button = event.target.closest('.dropdown-button');
                        const targetMenuId = button.getAttribute('data-target');
                        const targetMenu = document.getElementById(targetMenuId);
                        const icon = button.querySelector('.dropdown-icon');

                        // Toggle dropdown menu visibility
                        if (targetMenu) {
                            targetMenu.classList.toggle('hidden');
                            icon.classList.toggle('rotate-180');
                        }
                    }
                });
            });
        </script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById('dropzone-file');
    const imagePreview = document.getElementById('image-preview');
    const fileLabel = document.querySelector('.file-input-border');
    const uploadText = document.getElementById('upload-text');
    const uploadInfo = document.getElementById('upload-info');
    const iconUpload = document.getElementById('icon-upload');
    const fileNameDisplay = document.getElementById('file-name');
    const changeText = document.getElementById('change-text');

    // Add event listener for file input change
    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const reader = new FileReader();

            // Display preview on image load
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
                fileLabel.classList.add('border-blue-500'); // Add blue border on active
                fileLabel.classList.add('bg-gray-50'); // Light background for preview

                // Hide upload text, icon, and info
                uploadText.classList.add('hidden');
                uploadInfo.classList.add('hidden');
                iconUpload.classList.add('hidden');

                // Show file name and "Change" option
                fileNameDisplay.textContent = file.name;
                fileNameDisplay.classList.remove('hidden');
                changeText.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    // Event listener for change button to reset the input
    changeText.addEventListener('click', function() {
        fileInput.value = ''; // Clear file input
        imagePreview.classList.add('hidden'); // Hide preview
        fileLabel.classList.remove('border-blue-500'); // Remove blue border
        fileLabel.classList.remove('bg-gray-50'); // Reset background

        // Show upload text, icon, and info
        uploadText.classList.remove('hidden');
        uploadInfo.classList.remove('hidden');
        iconUpload.classList.remove('hidden');

        // Hide file name and "Change" option
        fileNameDisplay.classList.add('hidden');
        changeText.classList.add('hidden');
    });
});

</script>
        
    </div>
    <!-- End content -->
@endsection