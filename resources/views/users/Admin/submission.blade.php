<link rel="stylesheet" href="{{ asset('css/admin-index.css') }}">

@section('title')
    Submissions
@endsection

@extends('Users.Admin.layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<body>
    <div class="container mx-auto px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Home</a></li>
                <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-xs" aria-current="page">List submissions</li>
            </ol>
        </nav>
    </div>

    <header>
        <div class="title">
            {{$user->name}}'s Submissions
        </div>
    </header>


    <div class="container grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 sm:grid-cols-2 gap-3 mb-4 mt-2">
        @foreach($user->submissions as $users)
            <div class="relative flex flex-col bg-white shadow-sm border border-slate-200 rounded-lg w-auto">
                <a href="{{ asset($users->submission_file) }}" target="_blank">
                    <div class="relative h-56 m-2.5 overflow-hidden text-white rounded-md group">
                        <img src="{{asset($users->thumbnail)}}" alt="card-image" class="transition-transform duration-300 transform group-hover:scale-110" />
                    </div>
                </a>

                <div class="flex px-4 mb-4">
                    <div class="w-full">
                        <h6 class="mb-0 text-slate-800 text-xl font-semibold">
                            {{$users->user->name}}
                        </h6>
                        <div class="flex items-center">
                            <div class="text-sm">
                                <a href="#" class="text-gray-600 font-regular leading-none hover:text-indigo-600">{{$users->chapter_name}} | {{$users->course_name}} </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="absolute flex justify-center  items-center gap-2 bg-green-500 px-3 py-1 rounded text-white right-4 top-4">
                    <i class="fa-solid fa-medal"></i>
                    <p class="font-semibold">
                        @php
                        // Hitung total vote dari votes yang terhubung dengan submission ini
                        $totalVotes = $users->votes->sum('total_vote_value');
                    @endphp
                    {{ $totalVotes }}
                    </p>
                </div>

            </div>
        @endforeach
    </div>



</body>
@endsection
