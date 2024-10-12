@extends('users.Member.layouts.app')

@section('title')
    Course | Basic Webtoon
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
                        <ul class="space-y-2">
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
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="whatstoryboard">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>What's Storyboard</span>
                                </a>
                            </li>

                            <hr>

                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="understanding-aspec-ratio">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Understanding Aspect Ratio</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="rule-of-third">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>What is the rule of thirds?</span>
                                </a>
                            </li>

                            <hr>

                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="intro-shots">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Intro to Shots in Comic</span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="wide-shot">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Wide Shot</span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="full-shot">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Full Shot</span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="medium-shot">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Medium Shot</span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="medium-up">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Close Up</span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="extreme-close-up">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Extreme Close Up</span>
                                </a>
                            </li>

                            <hr>

                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="intro-camera-comic">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Intro camera in comics</span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="panning">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Panning</span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="zooming">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Zooming</span>
                                </a>
                            </li>

                            <hr>
                            
                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="char-place">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Character Placement</span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="conversation">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Cpnversation</span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="movement">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Movement</span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="action">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Action</span>
                                </a>
                            </li>


                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="conclution">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Conclutions Camera Shots and Movements</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100 gap-2" data-video="submission">
                                    <i class="fa-solid fa-file-arrow-up"></i>
                                    <span>Assignment Submission</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </aside>

            <!-- Main content -->
            <main class="flex-1 p-4 md:p-8 overflow-y-auto">
                <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                    <h1 class="text-2xl font-bold mb-2">Comic and Webtoon Introduction</h1>
                </header>
                <div  id="videoCourse" class="bg-white rounded-lg shadow-md p-4">
                    <div class="video-container mt-4">
                        <iframe id="video-placeholder" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <h2 id="video-title" class="text-2xl font-bold mt-2">Tittle Course</h2>
                    <div id="video-overview" class="video-overview">
                        <!-- Video Overview content will be injected here dynamically -->
                    </div>
                    <div class="video-material">
                        <a href="https://drive.google.com/drive/folders/1XTYMZqVjHHGQRm6jW61EiW8crtd9qJJU?usp=drive_link"  target="_blank">Download Material</a>
                    </div>
                </div>

                <div id="submission" class="bg-white rounded-lg shadow-md p-4 mt-4">
                    <h3 class="text-xl font-medium text-gray-900">Assignment</h3>
                    <p class="text-sm font-regular text-gray-600 mt-2 text-justify">In this assignment there are 2 assignments, namely quiz via quizizz and also by submitting a summary of notes from learning this course.</p>

                    <p class="font-bold mt-2">Assignment 1</p>
                        <p class="text-sm font-regular text-gray-600 mt-2 text-justify"> For Quizz, join the class first then start quizz independently. Use the following Code  <span class="font-bold">D167361</span> to be able to join the class. or via the class link below. 
                            <a href="https://quizizz.com/join?class=D167361" class="text-sm font-regular text-gray-600 mt-2 text-justify underline ">Join Class to take quizz</a>
                        </p>
                 

                    <p class="font-bold mt-2">Assignment 2</p>
                        <p class="text-sm font-regular text-gray-600 mt-2 text-justify">
                            For the summary assignment, please ensure that you watch the entire video to fully understand the content. The summary should follow the format outlined below:
                        </p>
                        <ul  class="list-disc list-inside text-base text-gray-800 space-y-2">
                            <li class="text-sm font-regular text-gray-600 mt-2 text-justify">What is Storyboarding</li>
                            <li class="text-sm font-regular text-gray-600 mt-2 text-justify">Aspect Ratio</li>
                            <li class="text-sm font-regular text-gray-600 mt-2 text-justify">Shots</li>
                            <li class="text-sm font-regular text-gray-600 mt-2 text-justify">Camera Movements</li>
                            <li class="text-sm font-regular text-gray-600 mt-2 text-justify">Conclusion</li>
                        </ul>
                        <p class="text-sm font-regular text-gray-600 mt-2 text-justify">
                            Create your summary in a Word document and submit it in PDF format uploaded to Google Drive. Make sure the Google Drive link is set to public so that it can be accessed.
                        </p>

                        <br>
                    
                    <p class="text-sm font-regular text-gray-600 mt-2 text-justify">
                        Make sure to follow all the assignment requirements carefully. Please note that multiple submissions for the same assignment are not allowed. 
                        If you need to change any submitted information, please contact your mentor or administrator directly.
                    </p>                   

                    
                    <form action="{{ route('submission_course.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="course_name" value="{{$courseName}}" id="submission_file" class="border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm hidden-sm border rounded-md px-2 py-2 mt-2"> 
                        <input type="hidden" name="chapter_name" value="{{$chapterName}}" id="submission_file" class="border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border rounded-md px-2 py-2 mt-2">
                    
                        <div class="mb-4">
                            <input type="hidden" name="user_id" id="user_id" class="border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border rounded-md">
                        </div>
                    
                        <div class="mb-4">
                            <label for="submission_file" class="text-base font-medium text-gray-900">Submission File (Link)</label>
                            <input type="text" name="submission_file" id="submission_file" class=" mt-2 block w-full py-2 pl-3 pr-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md bg-gray-50 focus:outline-none focus:caret-black-600 focus:bg-white caret-black-600">
                        </div>
                    
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded fw-bold">Submit</button>
                    </form>                   
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
                            videoUrl = 'https://drive.google.com/file/d/1IjacTcsDBe0FFm1MdVoWifG5jIwEdWV8/preview';
                            title = 'Introduction';
                            overviewContent = `
                                <span class="overview-title">Duration: 0:54 minute | Beginner</span>
                                <hr>
                                <span>Before you can start drawing your comic, you need to know the basics of shot composition and camera angles, and why they're crucial to successfully telling your story on the page. Ben talks about the rule of thirds, wide shots, full shots, medium shots, close-ups, and more. He also demonstrates the importance of following the action in the same direction throughout any given scene. Storyboarding may not always be associated with comics, but the same rules apply. Knowing and understanding these concepts can strengthen your work.</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'whatstoryboard':
                            videoUrl = 'https://drive.google.com/file/d/1s0c5Tu9oMiFMoHhiRCO3_uPbMUE1YKs6/preview';
                            title = 'What`s Storyboarding?';
                            overviewContent = `
                                <span class="overview-title">Duration: 1:49 minute | Beginner</span>
                                <hr>
                                <span>A storyboard is a visual representation of a film, animation, or comic book's sequence of events. It consists of a series of sketches or illustrations that depict the flow of action, camera angles, and pacing of the story. The purpose of a storyboard is to provide a visual guide that outlines how a story will unfold, scene by scene.</span>
                                <span>Skills Covered: storyboarding</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'understanding-aspec-ratio':
                            videoUrl = 'https://drive.google.com/file/d/1fjOQz3uXeiLl3hJe2hM14KjtEKykxsi6/preview';
                            title = 'Understanding Aspec Ratio';
                            overviewContent = `
                                <span class="overview-title">Duration: 52 seconds | Beginner</span>
                                <hr>
                                <span>When it comes to conveying a story visually to readers, comic book artists can learn a lot from examining how shots are filmed in movies and television. Although comic book panels aren't always a standard rectangular frame, you can still leverage the same storyboarding concepts, rules, and methods used in film to make your comics stronger and more digestible. In this course, join comic creator Ben Bishop as he explains how to use storyboard film techniques to understand shot composition, consistency, and movement within a frame, and apply those techniques as you build your comic book panels.</span>
                                <span>The Rule of Thirds is a fundamental principle of composition that divides an image into nine equal parts using two equally spaced horizontal lines and two equally spaced vertical lines. By placing key elements along these lines or at their intersections, you create a more balanced, engaging, and visually appealing composition.</span>
                                <span>Skills Covered: Understanding Aspect Ratio</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'rule-of-third':
                            videoUrl = 'https://drive.google.com/file/d/1qw3SP4BuV7Wr8eeNl81Kohd6_i3YPqbf/preview';
                            title = 'What is the rule of thirds?';
                            overviewContent = `
                                <span class="overview-title">Duration: 5:24 minute | Beginner</span>
                                <hr>
                                <span>When it comes to conveying a story visually to readers, comic book artists can learn a lot from examining how shots are filmed in movies and television. Although comic book panels aren't always a standard rectangular frame, you can still leverage the same storyboarding concepts, rules, and methods used in film to make your comics stronger and more digestible. In this course, join comic creator Ben Bishop as he explains how to use storyboard film techniques to understand shot composition, consistency, and movement within a frame, and apply those techniques as you build your comic book panels.</span>
                                <span>Skills Covered: Rule of third</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        
                        case 'intro-shots':
                            videoUrl = 'https://drive.google.com/file/d/15ABpmEj9jGGSEPkqCPOAs6byuAeHtQCG/preview';
                            title = 'Intro to Shots in Comic';
                            overviewContent = `
                                <span class="overview-title">Duration: 37 seconds | Beginner</span>
                                <hr>
                                <span>When it comes to conveying a story visually to readers, comic book artists can learn a lot from examining how shots are filmed in movies and television. Although comic book panels aren't always a standard rectangular frame, you can still leverage the same storyboarding concepts, rules, and methods used in film to make your comics stronger and more digestible. In this course, join comic creator Ben Bishop as he explains how to use storyboard film techniques to understand shot composition, consistency, and movement within a frame, and apply those techniques as you build your comic book panels.</span>
                                <span>Skills Covered: Shots in comic</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        
                        case 'wide-shot':
                            videoUrl = 'https://drive.google.com/file/d/1nJl8YEfWFqTmZMtBRpXSwowf9QYQvdDN/preview';
                            title = 'Wide Shot';
                            overviewContent = `
                                <span class="overview-title">Duration: 2:20 minute | Beginner</span>
                                <hr>
                                <span>When it comes to conveying a story visually to readers, comic book artists can learn a lot from examining how shots are filmed in movies and television. Although comic book panels aren't always a standard rectangular frame, you can still leverage the same storyboarding concepts, rules, and methods used in film to make your comics stronger and more digestible. In this course, join comic creator Ben Bishop as he explains how to use storyboard film techniques to understand shot composition, consistency, and movement within a frame, and apply those techniques as you build your comic book panels.</span>
                                <span>Skills Covered: Camera Shots, Wide Shot, Medium Shot, CloseUp Shot.</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'full-shot':
                            videoUrl = 'https://drive.google.com/file/d/1loAsRpriaIyXrPu7oSjAN5i05ykP7fFs/preview';
                            title = 'Full Shot';
                            overviewContent = `
                                <span class="overview-title">Duration: 1m 19s | Beginner</span>
                                <hr>
                                <span>When it comes to conveying a story visually to readers, comic book artists can learn a lot from examining how shots are filmed in movies and television. Although comic book panels aren't always a standard rectangular frame, you can still leverage the same storyboarding concepts, rules, and methods used in film to make your comics stronger and more digestible. In this course, join comic creator Ben Bishop as he explains how to use storyboard film techniques to understand shot composition, consistency, and movement within a frame, and apply those techniques as you build your comic book panels.</span>
                                <span>Skills Covered: Camera Shots, Wide Shot, Medium Shot, CloseUp Shot.</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'medium-shot':
                            videoUrl = 'https://drive.google.com/file/d/1sZN7zNtOvkneUg-AtHkqHwlC-_tsuTiJ/preview';
                            title = 'Medium Shot';
                            overviewContent = `
                                <span class="overview-title">Duration: 55s | Beginner</span>
                                <hr>
                                <span>When it comes to conveying a story visually to readers, comic book artists can learn a lot from examining how shots are filmed in movies and television. Although comic book panels aren't always a standard rectangular frame, you can still leverage the same storyboarding concepts, rules, and methods used in film to make your comics stronger and more digestible. In this course, join comic creator Ben Bishop as he explains how to use storyboard film techniques to understand shot composition, consistency, and movement within a frame, and apply those techniques as you build your comic book panels.</span>
                                <span>Skills Covered: Camera Shots, Wide Shot, Medium Shot, CloseUp Shot.</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'close-up':
                            videoUrl = 'https://drive.google.com/file/d/1_TivvCwxoaGDMNeltU4f3tP5xfIYj-eJ/preview';
                            title = 'Close Up Shot';
                            overviewContent = `
                                <span class="overview-title">Duration: 51s| Beginner</span>
                                <hr>
                                <span>When it comes to conveying a story visually to readers, comic book artists can learn a lot from examining how shots are filmed in movies and television. Although comic book panels aren't always a standard rectangular frame, you can still leverage the same storyboarding concepts, rules, and methods used in film to make your comics stronger and more digestible. In this course, join comic creator Ben Bishop as he explains how to use storyboard film techniques to understand shot composition, consistency, and movement within a frame, and apply those techniques as you build your comic book panels.</span>
                                <span>Skills Covered: Camera Shots, Wide Shot, Medium Shot, CloseUp Shot.</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'extreme-close-up':
                            videoUrl = 'https://drive.google.com/file/d/1s-br7smGQo-YAcKYJItXUDMeSvcupXMZ/preview';
                            title = 'Extreme Close Up Shot';
                            overviewContent = `
                                <span class="overview-title">Duration: 1m 36s | Beginner</span>
                                <hr>
                                <span>When it comes to conveying a story visually to readers, comic book artists can learn a lot from examining how shots are filmed in movies and television. Although comic book panels aren't always a standard rectangular frame, you can still leverage the same storyboarding concepts, rules, and methods used in film to make your comics stronger and more digestible. In this course, join comic creator Ben Bishop as he explains how to use storyboard film techniques to understand shot composition, consistency, and movement within a frame, and apply those techniques as you build your comic book panels.</span>
                                <span>Skills Covered: Camera Shots, Wide Shot, Medium Shot, CloseUp Shot.</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'intro-camera-comic':
                            videoUrl = 'https://drive.google.com/file/d/1WVdwMMDMB_5QbgC16I8BtQWdpfLAAicp/preview';
                            title = 'Introduction Camera in Comics';
                            overviewContent = `
                                <span class="overview-title">Duration: 31s | Beginner</span>
                                <hr>
                                <span>When it comes to conveying a story visually to readers, comic book artists can learn a lot from examining how shots are filmed in movies and television. Although comic book panels aren't always a standard rectangular frame, you can still leverage the same storyboarding concepts, rules, and methods used in film to make your comics stronger and more digestible. In this course, join comic creator Ben Bishop as he explains how to use storyboard film techniques to understand shot composition, consistency, and movement within a frame, and apply those techniques as you build your comic book panels.</span>
                                <span>Skills Covered: Zooming, Panning webtoon panel</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'zooming':
                            videoUrl = 'https://drive.google.com/file/d/177tKByK_rWV57BftLNPBsaZpB7YjjWvv/preview';
                            title = 'Zooming';
                            overviewContent = `
                                <span class="overview-title">Duration: 2m 9s | Beginner</span>
                                <hr>
                                <span>When it comes to conveying a story visually to readers, comic book artists can learn a lot from examining how shots are filmed in movies and television. Although comic book panels aren't always a standard rectangular frame, you can still leverage the same storyboarding concepts, rules, and methods used in film to make your comics stronger and more digestible. In this course, join comic creator Ben Bishop as he explains how to use storyboard film techniques to understand shot composition, consistency, and movement within a frame, and apply those techniques as you build your comic book panels.</span>
                                <span>Skills Covered: Zooming, Panning webtoon panel</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'panning':
                            videoUrl = 'https://drive.google.com/file/d/1NC-7rq2BvIlwwPEgwURex61RZeIeoShR/preview';
                            title = 'Panning';
                            overviewContent = `
                                <span class="overview-title">Duration: 2m 17s | Beginner</span>
                                <hr>
                                <span>When it comes to conveying a story visually to readers, comic book artists can learn a lot from examining how shots are filmed in movies and television. Although comic book panels aren't always a standard rectangular frame, you can still leverage the same storyboarding concepts, rules, and methods used in film to make your comics stronger and more digestible. In this course, join comic creator Ben Bishop as he explains how to use storyboard film techniques to understand shot composition, consistency, and movement within a frame, and apply those techniques as you build your comic book panels.</span>
                                <span>Skills Covered: Zooming, Panning webtoon panel</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'char-place':
                            videoUrl = 'https://drive.google.com/file/d/1KCidILwo2ZzbGDtFkaXA1Nbl-8bXgAvE/preview';
                            title = 'Character Placement';
                            overviewContent = `
                                <span class="overview-title">Duration: 30s | Beginner</span>
                                <hr>
                                <span>When it comes to conveying a story visually to readers, comic book artists can learn a lot from examining how shots are filmed in movies and television. Although comic book panels aren't always a standard rectangular frame, you can still leverage the same storyboarding concepts, rules, and methods used in film to make your comics stronger and more digestible. In this course, join comic creator Ben Bishop as he explains how to use storyboard film techniques to understand shot composition, consistency, and movement within a frame, and apply those techniques as you build your comic book panels.</span>
                                <span>Skills Covered: Conversations, movements, action in comic</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'conversation':
                            videoUrl = 'https://drive.google.com/file/d/1KjrX4rvEwBW9kclBEGWy1vAfSwWgXhKr/preview';
                            title = 'Conversation';
                            overviewContent = `
                                <span class="overview-title">Duration: 2m 3s | Beginner</span>
                                <hr>
                                <span>When it comes to conveying a story visually to readers, comic book artists can learn a lot from examining how shots are filmed in movies and television. Although comic book panels aren't always a standard rectangular frame, you can still leverage the same storyboarding concepts, rules, and methods used in film to make your comics stronger and more digestible. In this course, join comic creator Ben Bishop as he explains how to use storyboard film techniques to understand shot composition, consistency, and movement within a frame, and apply those techniques as you build your comic book panels.</span>
                                <span>Skills Covered: Conversations, movements, action in comic</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'movement':
                            videoUrl = 'https://drive.google.com/file/d/1BnO2BQhs4OoKILkGrWmr2y7IupGCc5Er/preview';
                            title = 'Movement';
                            overviewContent = `
                                <span class="overview-title">Duration: 2m 22s | Beginner</span>
                                <hr>
                                <span>When it comes to conveying a story visually to readers, comic book artists can learn a lot from examining how shots are filmed in movies and television. Although comic book panels aren't always a standard rectangular frame, you can still leverage the same storyboarding concepts, rules, and methods used in film to make your comics stronger and more digestible. In this course, join comic creator Ben Bishop as he explains how to use storyboard film techniques to understand shot composition, consistency, and movement within a frame, and apply those techniques as you build your comic book panels.</span>
                                <span>Skills Covered: Conversations, movements, action in comic</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'action':
                            videoUrl = 'https://drive.google.com/file/d/1k-jJA7ra5dVw_Lgx7Uw_k_DUxUJkomIj/preview';
                            title = 'Action';
                            overviewContent = `
                                <span class="overview-title">Duration: 1m 16s | Beginner</span>
                                <hr>
                                <span>When it comes to conveying a story visually to readers, comic book artists can learn a lot from examining how shots are filmed in movies and television. Although comic book panels aren't always a standard rectangular frame, you can still leverage the same storyboarding concepts, rules, and methods used in film to make your comics stronger and more digestible. In this course, join comic creator Ben Bishop as he explains how to use storyboard film techniques to understand shot composition, consistency, and movement within a frame, and apply those techniques as you build your comic book panels.</span>
                                <span>Skills Covered: Conversations, movements, action in comic</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'conclution':
                            videoUrl = 'https://drive.google.com/file/d/1f_eJgLGlK-8gIq2RwHbTNKSOl5ZkYAA2/preview';
                            title = 'Conclution: Camera Shots and Movement';
                            overviewContent = `
                                <span class="overview-title">Duration: 1m 7s | Beginner</span>
                                <hr>
                                <span>When it comes to conveying a story visually to readers, comic book artists can learn a lot from examining how shots are filmed in movies and television. Although comic book panels aren't always a standard rectangular frame, you can still leverage the same storyboarding concepts, rules, and methods used in film to make your comics stronger and more digestible. In this course, join comic creator Ben Bishop as he explains how to use storyboard film techniques to understand shot composition, consistency, and movement within a frame, and apply those techniques as you build your comic book panels.</span>
                                <span>Skills Covered: Conversations, movements, action in comic</span>
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
    document.getElementById('dropzone-file').addEventListener('change', function(event) {
        const fileInput = event.target;
        const file = fileInput.files[0];
        const fileNameElement = document.getElementById('file-name');
        
        // Validasi file kosong
        if (!file) {
            fileNameElement.textContent = "No file selected.";
            fileNameElement.classList.add('text-red-500');
            return;
        }
        
        // Validasi tipe file
        const allowedExtensions = /(\.pdf|\.doc|\.docx)$/i;
        if (!allowedExtensions.exec(file.name)) {
            fileNameElement.textContent = "Invalid file type. Only PDF, DOC, and DOCX are allowed.";
            fileNameElement.classList.add('text-red-500');
            fileInput.value = ''; // Reset file input
            return;
        }
        
        // Validasi ukuran file (maksimal 2MB)
        const maxSizeInBytes = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSizeInBytes) {
            fileNameElement.textContent = "File size exceeds 2MB limit.";
            fileNameElement.classList.add('text-red-500');
            fileInput.value = ''; // Reset file input
            return;
        }
        
        // Tampilkan nama file jika valid
        fileNameElement.textContent = `Selected file: ${file.name}`;
        fileNameElement.classList.remove('text-red-500');
        fileNameElement.classList.add('text-green-500');
    });
    </script>
    
    </div>
    <!-- End content -->
@endsection