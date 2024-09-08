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
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="tool-introduction">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Tools Introduction</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="selection">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Selection</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="grouping">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Grouping</span>
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
                        </ul>
                    </div>
                </nav>
            </aside>

            <!-- Main content -->
            <main class="flex-1 p-4 md:p-8 overflow-y-auto">
                <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                    <h1 class="text-2xl font-bold mb-2">Introduction to SketchUp</h1>
                </header>
                <div class="bg-white rounded-lg shadow-md p-4">
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
                            break;
                        case 'tool-introduction':
                            videoUrl = 'https://drive.google.com/file/d/1QJ7hAgsLZl0nwqK-ZJd5N6vcEdlG7bBr/preview';
                            title = 'Tools Introduction';
                            overviewContent = `
                                <span class="overview-title">Duration: 6:45 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Understanding Tools</span>
                            `;
                            break;
                        case 'selection':
                            videoUrl = 'https://drive.google.com/file/d/19RJDeBVcMSPUdDe0FjR3QgB9FQzCWko7/preview';
                            title = 'Selection';
                            overviewContent = `
                                <span class="overview-title">Duration: 4:45 seconds | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Understanding Selection</span>
                            `;
                            break;
                        case 'grouping':
                            videoUrl = 'https://drive.google.com/file/d/1nzp-p4fElcSGHhQiRMxaa7f0jtGvT6B5/preview';
                            title = 'Grouping';
                            overviewContent = `
                                <span class="overview-title">Duration: 7:50 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Understanding Grouping</span>
                            `;
                            break;
                        case 'component':
                            videoUrl = 'https://drive.google.com/file/d/1dTXTx7eERuyhhiO_xcm5Wm0rdm-XuH1n/preview';
                            title = 'Component';
                            overviewContent = `
                                <span class="overview-title">Duration: 8:21 minute | Beginner</span>
                                <hr>
                                <span>This introductory course on SketchUp Fundamentals is designed for beginners looking to master the essential tools and techniques of 3D modeling. Throughout the course, you will explore key features and workflows that will allow you to create, manipulate, and organize 3D objects with ease. The lessons are structured to build a strong foundation in SketchUp, from understanding the interface to creating complex designs efficiently.</span>
                                <span>Skills Covered: Understanding Component</span>
                            `;
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
    </div>
    <!-- End content -->
@endsection