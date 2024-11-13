@extends('users.Member.layouts.app')

@section('title')
    Course | Snaptoon Realistic Rendering
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
                                    <span class="font-bold">Snaptoon</span>
                                    <svg class="ml-auto transition-transform transform dropdown-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul id="dropdownMenu1" class="pl-3 space-y-2 hidden gap-3 py-2">                                        
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="introduction">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132    A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Introduction</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="instalasi">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Instalasi</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="tool-menu">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Tool and Menus</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="video-link flex items-center p-2 rounded hover:bg-gray-100" data-video="practice-export">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Practice Scene & Export</span>
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
                    <h1 class="text-2xl font-bold mb-2">Snaptoon Realistic Rendering</h1>
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
                        <a href="https://drive.google.com/drive/folders/124foGSRdiN26waWn5479tFk_kyJV0imX?usp=drive_link"  target="_blank">Download Material</a>
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
                            videoUrl = 'https://drive.google.com/file/d/16oh3gEkdWu0Y8_jAMdqYs0UAAg_LneO8/preview';
                            title = 'Introduction';
                            overviewContent = `
                                <span class="overview-title">Duration: 1:22 minute | Beginner</span>
                                <hr>
                                <span>Snaptoon is 3D Rendering tools to create realistic rendering image for webtoon background. We'll discus more about how to use snaptoon until rendering some realistic image scene for webtoon.</span>
                            `;
                            
                            break;
                        case 'instalasi':
                            videoUrl = 'https://drive.google.com/file/d/1BwW2W93hsrdBwOUiasy650WKvNHDsQmO/preview';
                            title = 'Instalation';
                            overviewContent = `
                                <span class="overview-title">Duration: 5:43 minute | Beginner</span>
                                <hr>
                                <span>Snaptoon is 3D Rendering tools to create realistic rendering image for webtoon background. We'll discus more about how to use snaptoon until rendering some realistic image scene for webtoon.</span>
                            `;
                            
                            break;
                        case 'tool-menu':
                            videoUrl = 'https://drive.google.com/file/d/1ikqoVAT6lFYMTwKebhaDhH13gkDDVRpZ/preview';
                            title = 'Tool & Menu';
                            overviewContent = `
                                <span class="overview-title">Duration: 9:15 seconds | Beginner</span>
                                <hr>
                                <span>Snaptoon is 3D Rendering tools to create realistic rendering image for webtoon background. We'll discus more about how to use snaptoon until rendering some realistic image scene for webtoon.</span>
                            `;
                            
                            break;
                        case 'practice-export':
                            videoUrl = 'https://drive.google.com/file/d/1jag4HtT26dPYWWXQ8soWCJS2aKwgeoa_/preview';
                            title = 'Practice Scene & Export';
                            overviewContent = `
                                <span class="overview-title">Duration: 29 minute | Beginner</span>
                                <hr>
                                <span>Snaptoon is 3D Rendering tools to create realistic rendering image for webtoon background. We'll discus more about how to use snaptoon until rendering some realistic image scene for webtoon.</span>
                            `;
                            
                            break;
                        
                        // ====================================================================================================================================================================

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