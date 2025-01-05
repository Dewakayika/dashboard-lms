@extends('users.Admin.layouts.dashboard-app')

@section('content')

<body> 
    <div class="col-12 mx-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Home</a></li>
                <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-xs" aria-current="page">List submissions</li>
            </ol>
        </nav>
    </div>

    <div class="col-12 mt-4">
        <div class="card mb-4">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-1 px-3">{{$user->name}}'s Submissions</h6>
            </div>
            <div class="card-body p-3 d-flex flex-wrap justify-content-start">
                @foreach($user->submissions as $users)
                <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                    <div class="card card-blog card-plain d-flex justify-content-between px-3 pb-5" style="height: 100%; ">
                        <div class="position-relative">
                            <a class="d-block shadow-xl border-radius-xl" href="{{ asset($users->submission_file) }}">
                                <img src="{{asset($users->thumbnail)}}" alt="card-image" class="img-fluid shadow border-radius-xl transition-transform duration-300 transform group-hover:scale-110" style="width: 100%; height: 200px; object-fit: cover;" />
                            </a>
                            <p class="text-gradient text-dark mb-2 text-sm pt-3">{{ \Carbon\Carbon::parse($users->submission_date)->translatedFormat('l, F Y') }}</p>
                            <a href="#" class="d-block">
                                <h6>{{$users->chapter_name}} | {{$users->course_name}}</h6>
                            </a>
                        </div>
                        <div class="px-1 p pt-3">
                           
                            <div class="mt-4 d-flex align-items-center justify-content-between">
                                <a href="{{ asset($users->submission_file) }}" class="btn btn-outline-primary btn-sm mb-0">View Project</a>
                                <div class="d-flex justify-center align-items-center gap-2 px-2 py-1 bg-secondary rounded text-white">
                                    <i class="fa-solid fa-medal mb-0"></i>
                                    <p class="font-semibold text-center mb-0">                    
                                        @php
                                        $totalVotes = $users->votes->sum('total_vote_value');
                                    @endphp
                                    {{ $totalVotes }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- <div class="container grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 sm:grid-cols-2 gap-3 mb-4 mt-2">
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
    </div> -->



</body>
@endsection
