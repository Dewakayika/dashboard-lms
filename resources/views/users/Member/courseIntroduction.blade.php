@extends('users.Member.layouts.app')

@section('title')
    Course | Introduction
@endsection

@section('content')
    <style type="text/css">
        /* Styles remain unchanged */
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
        .video-material {
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

    <div class="bg-gray-100">
        <button class="hamburger" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i>    
        </button>
        <div class="overlay" onclick="toggleSidebar()"></div>
        <div class="flex flex-col md:flex-row h-screen">
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
                        </ul>
                    </div>
                </nav>
            </aside>

            <main class="flex-1 p-4 md:p-8 overflow-y-auto">
                <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                    <h1 class="text-2xl font-bold mb-2">Course Introduction</h1>
                </header>
                <div class="bg-white rounded-lg shadow-md p-4">
                    <div class="video-container mt-4" id="video">
                        <iframe id="video-placeholder" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <h2 id="video-title" class="text-2xl font-bold mt-2">Title Course</h2>
                    <div id="video-overview" class="video-overview"></div>
                    <div class="video-material">
                        <a href="https://drive.google.com/file/d/14DZZ4fEjw78oXb46vBb5TdCUHQ9K5Uww/view?usp=drive_link" target="_blank">Download Material</a>
                    </div>
                    <button id="finish-button" class="btn btn-primary" disabled>Finish Course</button>
                </div>
                
            </main>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const videoLinks = document.querySelectorAll('.video-link');
                const videoPlaceholder = document.getElementById('video-placeholder');
                const videoTitle = document.getElementById('video-title');
                const videoOverview = document.getElementById('video-overview');
                let watchedTime = 0; // Timer for watched time

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
                                <span>We're so excited to have you here with us. In this wonderful space, we'll dive deep into the world of webtoon backgrounds and explore what it takes to become a skilled webtoon background designer. Whether you're just starting out or looking to hone your craft, there's a place for you here. Let's learn, create, and grow together!</span>
                            `;
                            break;
                    }

                    videoTitle.textContent = title;
                    videoPlaceholder.src = videoUrl;
                    videoOverview.innerHTML = overviewContent;

                    // Reset watched time
                    watchedTime = 0;
                    document.getElementById('finish-button').disabled = true; // Disable button initially

                    // Start a timer
                    const timerInterval = setInterval(() => {
                        watchedTime++;
                        if (watchedTime >= 60) { // 60 seconds = 1 minute
                            document.getElementById('finish-button').disabled = false; // Enable the finish button
                            clearInterval(timerInterval); // Stop the timer
                        }
                    }, 1000); // Check every second
                }
            });

            // Function to toggle sidebar
            function toggleSidebar() {
                const sidebar = document.querySelector('.sidebar');
                const overlay = document.querySelector('.overlay');
                sidebar.classList.toggle('open');
                if (overlay) {
                    overlay.style.display = sidebar.classList.contains('open') ? 'block' : 'none';
                }
            }

            document.getElementById('finish-button').addEventListener('click', () => {
                fetch('{{ route('update.progress') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        user_id: {{ auth()->id() }},
                        progress: 'done',
                        watched_time: watchedTime
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Tampilkan status baru di card course atau berikan notifikasi
                    console.log(data);
                });
            });
        </script>
    </div>
@endsection
