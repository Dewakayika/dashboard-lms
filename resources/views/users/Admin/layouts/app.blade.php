<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="{{ asset('css/sidebar/admin-sidebar.css') }}">
<script src="{{ asset('js/sidebar/admin-sidebar.js') }}"></script>


    
    <title>
        @yield('title')
    </title>

    <!------------CSS-------------->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('main/css/style.css')}}"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon"
        href="https://cdn.discordapp.com/attachments/1018894859832148009/1025031221799043102/meals_on_wheels.png">
    <script src="https://kit.fontawesome.com/bf49ffd5fb.js" crossorigin="anonymous"></script>

    <link rel="icon" href="{{ url('images/padma-black.png') }}" type="image/png">

</head>

<body>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    @include('sidebar.admin-sidebar')

    <div class="main-content">
        <section class="">
            <div>
                @yield('content')
            </div>
        </section>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>

</html>
