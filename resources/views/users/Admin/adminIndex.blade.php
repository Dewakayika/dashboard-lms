@vite('resources/css/users/admin/admin-index.css')

@section('title')
    Admin Dashboard
@endsection

@extends('Users.Admin.layouts.app')

@section('content')
    <body>
        <header>
            <div class="title">
                Admin Dashboard
            </div>
        </header>

        <div class="main-container">
            <div class="row">
                <div class="card-content">
                    <a href="{{ route('admin#listUser') }}">
                        <div class="card">
                            <div class="card-title">Users Registered</div>
                            <div class="card-body">
                                <h2>{{ $userData }}</h2>
                                <p>Compare to last month</p>
                            </div>
                        </div>
                    </a>
                </div>
     
                <div class="card-content">
                    <a href="{{ route('admin#listTalent') }}">
                        <div class="card">
                            <div class="card-title">Talent Role</div>
                            <div class="card-body">
                                <h2>{{ $talentData }}</h2>
                                <p>Compare to last month</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="card-content">
                    <a href="{{ route('admin#listIntern') }}">
                        <div class="card last">
                            <div class="card-title">Intern Role</div>
                            <div class="card-body">
                                <h2>{{ $internData }}</h2>
                                <p>Compare to last month</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </body>

    <!-- <style>
        .card-body {
            background-color: white;
        }
    </style> -->
    <!-- Start content -->
    <!-- <div >
        <div class="container pb-10">
            <h2 class="text-3xl pt-10 font-medium mb-10 text-mow-red">Admin Dashboard</h2>
            <div class="container w-full flex justify-center">
                <div class="grid grid-cols-1 gap-5 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3">
                    <a href="{{ route('admin#listUser') }}" class="text-slate-800 group rounded-sm"
                        style="max-width: 20rem;">
                        <div class="card-body group-hover:bg-mow-shine-yellow  group-hover:text-white  shadow-md rounded">
                            <h5 class="card-title font-semibold">Users Registered</h5>
                            <div class="d-flex align-items-center mb-2 mt-4">
                                <h2 class="mb-0 display-5">
                                    <i class="text-mow-shine-yellow group-hover:text-white fa-solid fa-users"></i>
                                </h2>
                                <div class="ms-auto">
                                    <h2 class="mb-0 display-6">
                                        <span class="fw-normal">{{ $userData }}</span>
                                        <span class="fw-normal">Users</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin#listIntern') }}" class="text-slate-800 group rounded-sm"
                        style="max-width: 20rem;">
                        <div class="card-body group-hover:text-white hover:bg-mow-shine-yellow shadow-md rounded">
                            <h5 class="card-title font-semibold">Members Role</h5>
                            <div class="d-flex align-items-center mb-2 mt-4">
                                <h2 class="mb-0 display-5">
                                    <i class="text-mow-shine-yellow group-hover:text-white fa-solid fa-users"></i>
                                </h2>
                                <div class="ms-auto">
                                    <h2 class="mb-0 display-6">
                                        <span class="fw-normal">{{ $internData }}</span>
                                        <span class="fw-normal">Users</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin#listTalent') }}" class="text-slate-800 group rounded-sm"
                        style="max-width: 20rem;">
                        <div class="card-body group-hover:text-white hover:bg-mow-shine-yellow shadow-md rounded">
                            <h5 class="card-title font-semibold">Partner Role</h5>
                            <div class="d-flex align-items-center mb-2 mt-4">
                                <h2 class="mb-0 display-5">
                                    <i class="text-mow-shine-yellow group-hover:text-white fa-solid fa-users"></i>
                                </h2>
                                <div class="ms-auto">
                                    <h2 class="mb-0 display-6">
                                        <span class="fw-normal">{{ $talentData }}</span>
                                        <span class="fw-normal">Users</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                    
                </div>
            </div>
        </div>
    </div> -->
@endsection
