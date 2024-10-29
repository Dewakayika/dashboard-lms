@extends('users.Member.layouts.app')

@section('title')
    Course | Introduction SketchUp
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
                                    <span class="font-bold">1. Quick Start</span>
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
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="navigating">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Learning Navigating</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="pillars">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Copying Pillars</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="component">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Component</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="inferences">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Building the Platform Using Inferences</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="array">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Array the Bars</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="arc-circle">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Arcs and Circles</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="create-steps">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Creating the Steps</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="building-slide">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Building the Slide</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="final">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Final Applying Color</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <hr>

                            <li>
                                <button class="dropdown-button flex items-center p-2 rounded hover:bg-gray-100 w-full" aria-expanded="false" data-target="dropdownMenu2">
                                    <span class="font-bold">2. Core Concept</span>
                                    <svg class="ml-auto transition-transform transform dropdown-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul id="dropdownMenu2" class="pl-3 space-y-2 hidden gap-3 py-2">                                        
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="edges-surface">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Edges and Surfaces</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="Inferences">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Inferences</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="inference-challenge">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Inference Challenge</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="blue-axis">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Blue Axis</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <hr>

                            <li>
                                <button class="dropdown-button flex items-center p-2 rounded hover:bg-gray-100 w-full" aria-expanded="false" data-target="dropdownMenu3">
                                    <span class="font-bold">3. Push Pull</span>
                                    <svg class="ml-auto transition-transform transform dropdown-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul id="dropdownMenu3" class="pl-3 space-y-2 hidden gap-3 py-2">                                        
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="push-pull">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Push and Pull</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <hr>

                            <li>
                                <button class="dropdown-button flex items-center p-2 rounded hover:bg-gray-100 w-full" aria-expanded="false" data-target="dropdownMenu4">
                                    <span class="font-bold">4. Accuracy</span>
                                    <svg class="ml-auto transition-transform transform dropdown-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul id="dropdownMenu4" class="pl-3 space-y-2 hidden gap-3 py-2">                                        
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="accuracy">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Accuracy in SketchUp</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="tape-measure">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Tape Measure Tool</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <hr>

                            <li>
                                <button class="dropdown-button flex items-center p-2 rounded hover:bg-gray-100 w-full" aria-expanded="false" data-target="dropdownMenu5">
                                    <span class="font-bold">5. Drawing Tools</span>
                                    <svg class="ml-auto transition-transform transform dropdown-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul id="dropdownMenu5" class="pl-3 space-y-2 hidden gap-3 py-2">                                        
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="drawing-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Circle</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="drawing-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Arcs</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="drawing-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Rectangles</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="drawing-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Freehand</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="drawing-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Offset</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="drawing-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Eraser</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <hr>

                            <li>
                                <button class="dropdown-button flex items-center p-2 rounded hover:bg-gray-100 w-full" aria-expanded="false" data-target="dropdownMenu6">
                                    <span class="font-bold">6. Selections</span>
                                    <svg class="ml-auto transition-transform transform dropdown-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul id="dropdownMenu6" class="pl-3 space-y-2 hidden gap-3 py-2">                                        
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="selections">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Selection Methods</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <hr>

                            <li>
                                <button class="dropdown-button flex items-center p-2 rounded hover:bg-gray-100 w-full" aria-expanded="false" data-target="dropdownMenu7">
                                    <span class="font-bold">7. Grouping</span>
                                    <svg class="ml-auto transition-transform transform dropdown-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul id="dropdownMenu7" class="pl-3 space-y-2 hidden gap-3 py-2">                                        
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="grouping">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Grouping</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <hr>

                            
                            <li>
                                <button class="dropdown-button flex items-center p-2 rounded hover:bg-gray-100 w-full" aria-expanded="false" data-target="dropdownMenu8">
                                    <span class="font-bold">8. Component</span>
                                    <svg class="ml-auto transition-transform transform dropdown-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul id="dropdownMenu8" class="pl-3 space-y-2 hidden gap-3 py-2">                                        
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="component">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Component</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <hr>
                     
                            <li>
                                <button class="dropdown-button flex items-center p-2 rounded hover:bg-gray-100 w-full" aria-expanded="false" data-target="dropdownMenu9">
                                    <span class="font-bold">9. Tags or Layers</span>
                                    <svg class="ml-auto transition-transform transform dropdown-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul id="dropdownMenu9" class="pl-3 space-y-2 hidden gap-3 py-2">                                        
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="tag-layers">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Tags or Layers</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <hr>

                            <li>
                                <button class="dropdown-button flex items-center p-2 rounded hover:bg-gray-100 w-full" aria-expanded="false" data-target="dropdownMenu10">
                                    <span class="font-bold">10. The Versatile Move Tool</span>
                                    <svg class="ml-auto transition-transform transform dropdown-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul id="dropdownMenu10" class="pl-3 space-y-2 hidden gap-3 py-2">                                        
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="move-tool-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Move Tool</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="move-tool-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Manipulate Geometri</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="move-tool-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>What is Auto-fold?</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="move-tool-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Copy and Array using Move</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <hr>

                            <li>
                                <button class="dropdown-button flex items-center p-2 rounded hover:bg-gray-100 w-full" aria-expanded="false" data-target="dropdownMenu11">
                                    <span class="font-bold">11. Follow Me</span>
                                    <svg class="ml-auto transition-transform transform dropdown-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul id="dropdownMenu11" class="pl-3 space-y-2 hidden gap-3 py-2">                                        
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="follow-me-tool-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Follow Me Tool</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="follow-me-tool-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Follow Me as a Lathe</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="follow-me-tool-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Follow Me: Practise Exercises</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <hr>

                            <li>
                                <button class="dropdown-button flex items-center p-2 rounded hover:bg-gray-100 w-full" aria-expanded="false" data-target="dropdownMenu12">
                                    <span class="font-bold">12. Inference Locking</span>
                                    <svg class="ml-auto transition-transform transform dropdown-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul id="dropdownMenu12" class="pl-3 space-y-2 hidden gap-3 py-2">                                        
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="inference-locking-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Inference Locking Basics</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="inference-locking-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Inference Locking: Practice</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <hr>

                            <li>
                                <button class="dropdown-button flex items-center p-2 rounded hover:bg-gray-100 w-full" aria-expanded="false" data-target="dropdownMenu13">
                                    <span class="font-bold">13. Assignment</span>
                                    <svg class="ml-auto transition-transform transform dropdown-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul id="dropdownMenu13" class="pl-3 space-y-2 hidden gap-3 py-2">                                        
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100 gap-2" data-video="submission">
                                            <i class="fa-solid fa-file-arrow-up"></i>
                                            <span>Assignment Submission</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </aside>

            <!-- Main content -->
            <main class="flex-1 p-4 md:p-8 overflow-y-auto">
                <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                    <h1 class="text-2xl font-bold mb-2">Introduction to SketchUp</h1>
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
                        <a href="https://drive.google.com/file/d/14nEkkR9AuvofG-8LLttTWkcIXNJlA2-4/view?usp=sharing"  target="_blank">Download Material</a>
                    </div>
                </div>
                
                <div id="submission" class="bg-white rounded-lg shadow-md p-4 mt-4">
                <h3 class="text-xl font-medium text-gray-900">Assignment Submission</h3>
                <p class="text-sm font-regular text-gray-600 mt-2 text-justify">In this assignment there are 2 assignments, namely quiz via quizizz and also by submitting a summary of notes from learning this course. For Quizz, join the class first then start quizz independently. Use the following Code  <span class="font-bold">D167361</span> to be able to join the class. or via the class link below.</p>
                <p class="font-bold">Assignment 1</p>
                    <p class="text-sm font-regular text-gray-600 mt-2 text-justify">For Quizz, join the class first then start quizz independently. Use the following Code  <span class="font-bold">D167361</span> to be able to join the class. or via the class link below.</p>
                    <a href="https://quizizz.com/join?class=D167361" class="text-sm font-regular text-gray-600 mt-2 text-justify underline ">Join Class to take quizz</a>
                    <br>
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
                            videoUrl = 'https://drive.google.com/file/d/1oOKyeJcrM229N9XHbl-DcKX7tTl5Dw25/preview';
                            title = 'Introduction';
                            overviewContent = `
                                <span class="overview-title">Duration: 1:22 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        case 'navigating':
                            videoUrl = 'https://drive.google.com/file/d/1QJ7hAgsLZl0nwqK-ZJd5N6vcEdlG7bBr/preview';
                            title = 'Learning Navigating';
                            overviewContent = `
                                <span class="overview-title">Duration: 6:45 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Quick Start Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        case 'pillars':
                            videoUrl = 'https://drive.google.com/file/d/1OaosBCPI5E6VZQXHtI83JJcHNCBR1JoG/preview';
                            title = 'Copying Pillars';
                            overviewContent = `
                                <span class="overview-title">Duration: 4:45 seconds | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Quick Start Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        case 'component':
                            videoUrl = 'https://drive.google.com/file/d/1sXeqUR64YRl2Dl49CEMaXRKUK3rEsq4G/preview';
                            title = 'Component Bases';
                            overviewContent = `
                                <span class="overview-title">Duration: 7:50 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Quick Start Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        case 'inferences':
                            videoUrl = 'https://drive.google.com/file/d/1P-jyD4hB4tnwlZ_zClQw2LOllky72nMS/preview';
                            title = 'Component';
                            overviewContent = `
                                <span class="overview-title">Duration: 8:21 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Quick Start Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                        break;
                            case 'arc-circle':
                            videoUrl = 'https://drive.google.com/file/d/1vYweuFN517EEnOFP3NvFEw48Zjl9fwGm/preview';
                            title = 'Arc and Circle';
                            overviewContent = `
                                <span class="overview-title">Duration: 8:21 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Quick Start Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        case 'array':
                            videoUrl = 'https://drive.google.com/file/d/1FhGQeJx795ENJev9we_Q9QMVgitM2Kmy/preview';
                            title = 'Array the Bars';
                            overviewContent = `
                                <span class="overview-title">Duration: 8:21 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Quick Start Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        case 'creating-steps':
                            videoUrl = 'https://drive.google.com/file/d/1u5haEHi8e_4iSrtM-phMXAK6AvApYJMH/preview';
                            title = 'Create the Steps';
                            overviewContent = `
                                <span class="overview-title">Duration: 8:21 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Quick Start Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        case 'building-slide':
                            videoUrl = 'https://drive.google.com/file/d/1OIsiaoG0muV4k-KsySGqu_EeHw1zd9tr/preview';
                            title = 'Building the Steps';
                            overviewContent = `
                                <span class="overview-title">Duration: 8:21 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Quick Start Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        case 'final':
                            videoUrl = 'https://drive.google.com/file/d/1ckX1tosuaAPksCcMqF9JNwGPrYB62Ipk/preview';
                            title = 'Final Applying Color';
                            overviewContent = `
                                <span class="overview-title">Duration: 8:21 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Quick Start Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        
                        // ================================================================================================================================

                        case 'edges-surface':
                            videoUrl = 'https://drive.google.com/file/d/19szkQcR3-FonJv5wCgVHYhTUMbP_mm_v/preview';
                            title = 'Edges and Surfaces';
                            overviewContent = `
                                <span class="overview-title">Duration: 8:21 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        case 'Inferences':
                            videoUrl = 'https://drive.google.com/file/d/1zMKsvixzjrfE-Mk2PVF28-7oyr6V3MdC/preview';
                            title = 'Inferences';
                            overviewContent = `
                                <span class="overview-title">Duration: 8:21 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        case 'inference-challenge':
                            videoUrl = 'https://drive.google.com/file/d/1ElltS22RohMbJX0TB81pXi1sjUPaJ-2q/preview';
                            title = 'Inferences Challenge';
                            overviewContent = `
                                <span class="overview-title">Duration: 8:21 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        case 'blue-axis':
                            videoUrl = 'https://drive.google.com/file/d/1dwgpinNLh_7yXHIgqkEuTkyhFRvHR1xS/preview';
                            title = 'Inferences Challenge';
                            overviewContent = `
                                <span class="overview-title">Duration: 8:21 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        // ====================================================================================================================================================================

                        case 'push-pull':
                            videoUrl = 'https://drive.google.com/file/d/1IQ8Y9WGuf-Vq-U9KFwkmxwi6TzybYae-/preview';
                            title = 'Push and Pull';
                            overviewContent = `
                                <span class="overview-title">Duration: 8:21 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        // ================================================================================================================================================================================

                        case 'accuracy':
                            videoUrl = 'https://drive.google.com/file/d/1oYGQmvcq-nR7ma0CgJY4U6yC-Ce5BK6h/preview';
                            title = 'Accuracy in Sketchup';
                            overviewContent = `
                                <span class="overview-title">Duration: 8:21 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'tape-measure':
                            videoUrl = 'https://drive.google.com/file/d/1tg8yy5fm8QLtNAuMK5JljmRo8713dVrk/preview';
                            title = 'Tape Measure Tool';
                            overviewContent = `
                                <span class="overview-title">Duration: 8:21 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        
                        // ======================================================================================================================================================================

                        case 'drawing-1':
                            videoUrl = 'https://drive.google.com/file/d/1HCgdvup1nfN78X6kZHXih4qnc5Wen4Fn/preview';
                            title = 'Circles';
                            overviewContent = `
                                <span class="overview-title">Duration: 3 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'drawing-2':
                            videoUrl = 'https://drive.google.com/file/d/1ia5gCjaG9TeaT5wNBgSjFo_NTOkBCeoI/preview';
                            title = 'Arcs';
                            overviewContent = `
                                <span class="overview-title">Duration: 4 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'drawing-3':
                            videoUrl = 'https://drive.google.com/file/d/1vHeKjCnk9HfAkvazyM5l0tRr24sqF5eO/preview';
                            title = 'Rectangles';
                            overviewContent = `
                                <span class="overview-title">Duration: 2 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        
                        case 'drawing-4':
                            videoUrl = 'https://drive.google.com/file/d/1D3Yp1nIlpZJxslrxgorv0xIXOiY-XpQx/preview';
                            title = 'Freehand';
                            overviewContent = `
                                <span class="overview-title">Duration: 1 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'drawing-5':
                            videoUrl = 'https://drive.google.com/file/d/1PVmUKh5QKeIAOwdz8eAQCoGYNN45xdu7/preview';
                            title = 'Offset';
                            overviewContent = `
                                <span class="overview-title">Duration: 2 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        
                        case 'drawing-6':
                            videoUrl = 'https://drive.google.com/file/d/1HeastCBcKRE5CEGeZv-oFVAgjjN4lCLN/preview';
                            title = 'Eraser';
                            overviewContent = `
                                <span class="overview-title">Duration: 2 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;


                        // =====================================================================================================================================================================

                        case 'selections':
                            videoUrl = 'https://drive.google.com/file/d/11SBGzTyBL5WGVzJQJz6C5UvP-QEKJLb8/preview';
                            title = 'Selections Methods';
                            overviewContent = `
                                <span class="overview-title">Duration: 5 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        // ======================================================================================================================================================================

                        case 'grouping':
                            videoUrl = 'https://drive.google.com/file/d/1RFAl5qSyZTnoPH3_X-3iKpFqb__z-6Hr/preview';
                            title = 'Grouping';
                            overviewContent = `
                                <span class="overview-title">Duration: 5 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        // ===================================================================================================================================================================

                        case 'component':
                            videoUrl = 'https://drive.google.com/file/d/13JjpqzaNzjPP02gAUFAPUWwvlcKm8ytF/preview';
                            title = 'Component';
                            overviewContent = `
                                <span class="overview-title">Duration: 5 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        // =================================================================================================================================================================

                        case 'tag-layer':
                            videoUrl = 'https://drive.google.com/file/d/1tAgROb-uJ3wn1cfiKDSq3qel7XwIJrYU/preview';
                            title = 'Tag or Layers';
                            overviewContent = `
                                <span class="overview-title">Duration: 5 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        // ===============================================================================================================================================================================

                        case 'move-tool-1':
                            videoUrl = 'https://drive.google.com/file/d/1HlGfjzGVbrIdoGkBlbkkwblUYzgLDHfr/preview';
                            title = 'Move Tool';
                            overviewContent = `
                                <span class="overview-title">Duration: 5 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'move-tool-2':
                            videoUrl = 'https://drive.google.com/file/d/1g5ETYX4Bf9qLA3Hh8ZzjDD2fERhpxaqp/preview';
                            title = 'Manipulate Geometri';
                            overviewContent = `
                                <span class="overview-title">Duration: 5 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'move-tool-3':
                            videoUrl = 'https://drive.google.com/file/d/1jkArViZkbCUaMTIA6j84_rOgTLS5wvjC/preview';
                            title = 'What is Auto-fold?';
                            overviewContent = `
                                <span class="overview-title">Duration: 5 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;
                        
                        case 'move-tool-4':
                            videoUrl = 'https://drive.google.com/file/d/1YMntqoG_W3ZVk2ADWUgD8s8gk8jS2WKQ/preview';
                            title = 'Copy and Array using Move';
                            overviewContent = `
                                <span class="overview-title">Duration: 5 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        // =================================================================================================================================================

                        case 'follow-me-tool-1':
                            videoUrl = 'https://drive.google.com/file/d/1j-vj4NJv5Pv2TmwChmiQOmKPR0S2diAA/preview';
                            title = 'Follow Me Tool';
                            overviewContent = `
                                <span class="overview-title">Duration: 5 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'follow-me-tool-2':
                            videoUrl = 'https://drive.google.com/file/d/1KlFXUoqMWrgalf7atUP09sMit_jW0VWV/preview';
                            title = 'Follow Me as a Lathe';
                            overviewContent = `
                                <span class="overview-title">Duration: 5 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'follow-me-tool-3':
                            videoUrl = 'https://drive.google.com/file/d/16LBoGLvUSyfanxLRFslYX59V3CcatUcH/preview';
                            title = 'Follow Me: Practise Exercises';
                            overviewContent = `
                                <span class="overview-title">Duration: 5 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        // ====================================================================================================================================================================

                        case 'inference-locking-1':
                            videoUrl = 'https://drive.google.com/file/d/1VUlpgvmv7GghJk6qrvbq09EjWj44bxBm/preview';
                            title = 'Inference Locking Basics';
                            overviewContent = `
                                <span class="overview-title">Duration: 5 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        case 'inference-locking-2':
                            videoUrl = 'https://drive.google.com/file/d/18bDbYPsTM_6e6eUvBvAL_f_S2K1FzPTm/preview';
                            title = 'Inference Locking: Practice';
                            overviewContent = `
                                <span class="overview-title">Duration: 5 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Sketchup Fundamentals</span>
                            `;
                            document.getElementById('submission').style.display = 'none';
                            break;

                        // ====================================================================================================================================================================

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

        changeText.addEventListener('click', function() {
            fileInput.value = ''; // Clear the file input
            imagePreview.classList.add('hidden');
            fileLabel.classList.remove('active'); // Remove blue border
            // Show upload text and icon
            uploadText.classList.remove('hidden');
            uploadInfo.classList.remove('hidden');
            iconUpload.classList.remove('hidden');
            fileNameDisplay.classList.add('hidden');
            changeText.classList.add('hidden');
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