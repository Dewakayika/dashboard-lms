@extends('users.Member.layouts.app')

@section('title')
    Meals Details
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
            margin-top: 16px;
        }

        .video-overview .overview-title {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .video-overview span {
            display: block;
            margin-bottom: 4px;
        }
    </style>

    <!-- Start content -->
    <div class="bg-gray-100">
        <div class="flex flex-col md:flex-row h-screen">
            <!-- Sidebar -->
            <aside class="w-full md:w-80 bg-white p-4 overflow-y-auto">
                <a class="flex items-center mb-6" href="{{ url('/dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span  class="text-lg font-bold">My Dashboard</span>
                </a>
                <nav>
                    <div class="mb-4">
                        <ul class="space-y-2">
                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="whatstoryboard">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>What's Storyboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="understanding-aspec-ratio">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Understanding Aspec Ratio</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="rule-of-third">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>What's Rule of Thirds?</span>
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
                <div class="bg-white rounded-lg shadow-md p-4">
                    <h2 id="video-title" class="text-xl font-semibold mb-2">Mengatur Material, Lighting, dan Rendering pada Software Blender</h2>
                    <div class="mt-4">
                        <video id="video-placeholder" class="w-full h-80 md:h-96 object-cover rounded" controls>
                            <source src="" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div id="video-overview" class="video-overview">
                        <!-- Video Overview content will be injected here dynamically -->
                    </div>
                </div>
            </main>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const videoLinks = document.querySelectorAll('.video-link');
                const videoPlaceholder = document.getElementById('video-placeholder');
                const videoSource = videoPlaceholder.querySelector('source');
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
                    });
                });

                function updateVideo(videoId) {
                    let videoUrl, title, overviewContent;
                    switch(videoId) {
                        case 'whatstoryboard':
                            videoUrl = 'https://www.linkedin.com/dms/prv/vid/v2/C4E0DAQEgKs4B6W73Xg/learning-original-video-vbr-720/learning-original-video-vbr-720/0/1598519178252?ea=93946321&ua=219764162&e=1725680792&v=beta&t=xKOpFTWRdV6PCvRz4G4e1qoUPPWTf2xYZyjN2Im472o';
                            title = 'What`s Storyboarding?';
                            overviewContent = `
                                <span class="overview-title">Duration: 1:49 minute</span>
                                <span>Level: Beginner</span>
                                <span>Overview: A storyboard is a visual representation of a film, animation, or comic book's sequence of events. It consists of a series of sketches or illustrations that depict the flow of action, camera angles, and pacing of the story. The purpose of a storyboard is to provide a visual guide that outlines how a story will unfold, scene by scene.</span>
                                <span>Skills Covered: storyboarding</span>
                            `;
                            break;
                        case 'understanding-aspec-ratio':
                            videoUrl = 'https://www.linkedin.com/dms/prv/vid/v2/C4E0DAQHmyGfxjEvcBA/learning-original-video-vbr-720/learning-original-video-vbr-720/0/1598519339628?ea=93946321&ua=219764162&e=1725680897&v=beta&t=oIGeWazfW1HkJrOXmg-CuwVoSXm8SOHp9i9JnsaH_xs';
                            title = 'Understanding Aspec Ratio';
                            overviewContent = `
                                <span class="overview-title">Duration: 56 seconds</span>
                                <span>Level: Beginner</span>
                                <span>Overview: When it comes to conveying a story visually to readers, comic book artists can learn a lot from examining how shots are filmed in movies and television. Although comic book panels aren't always a standard rectangular frame, you can still leverage the same storyboarding concepts, rules, and methods used in film to make your comics stronger and more digestible. In this course, join comic creator Ben Bishop as he explains how to use storyboard film techniques to understand shot composition, consistency, and movement within a frame, and apply those techniques as you build your comic book panels.</span>
                                <span>Skills Covered: Understanding Aspec Ratio</span>
                                
                            `;
                            break;
                        case 'rule-of-third':
                            videoUrl = 'https://www.linkedin.com/dms/prv/vid/v2/C4E0DAQHYpWezoZfT2w/learning-original-video-vbr-720/learning-original-video-vbr-720/0/1598519111694?ea=93946321&ua=219764162&e=1725680912&v=beta&t=ESRSLlla6uUPvcM-4FQt_mw1DlLP_Qs1YRV3gO97jA8';
                            title = 'What`s Rule of Third?';
                            overviewContent = `
                                <span class="overview-title">Duration: 5:24 minute</span>
                                <span>Level: Beginner</span>
                                <span>Overview: The Rule of Thirds is a fundamental principle of composition that divides an image into nine equal parts using two equally spaced horizontal lines and two equally spaced vertical lines. By placing key elements along these lines or at their intersections, you create a more balanced, engaging, and visually appealing composition.</span>
                                <span>Skills Covered: Rule of Third, Camera</span>
                                
                            `;
                            break;
                    }

                    videoTitle.textContent = title;
                    videoSource.src = videoUrl;
                    videoPlaceholder.load(); // Reload the video
                    videoOverview.innerHTML = overviewContent;
                }
            });
        </script>
    </div>
    <!-- End content -->
@endsection
