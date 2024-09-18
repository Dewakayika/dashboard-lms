<!DOCTYPE html>
<html>
<head>
    <title>CV Uploaded Successfully</title>
</head>
<section class="max-w-2xl px-6 py-8 mx-auto bg-white dark:bg-gray-900">
    <header>
        <a href="#">
            <img class="w-auto h-7 sm:h-8" src="https://merakiui.com/images/full-logo.svg" alt="">
        </a>
    </header>

    <main class="mt-8">
        <h2 class="text-gray-700 dark:text-gray-200">Hi {{$name}},</h2>

        <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
            Thank you for submiting your CV. Our Team review it. Will be back as soon as possible!
        </p>
        
        <p class="mt-8 text-gray-600 dark:text-gray-300">
            Thanks, <br>
            Padma Studio
        </p>
    </main>
    
</section>
{{-- <body>
    <h1>Hi, {{ $name }}</h1>
    <p>Thank you for submitting your CV. We have successfully received your CV.</p>
    <p>We will review it and contact you soon.</p>
    <p>Best regards,</p>
    <p>{{ config('app.name') }}</p>
</body> --}}
</html>


