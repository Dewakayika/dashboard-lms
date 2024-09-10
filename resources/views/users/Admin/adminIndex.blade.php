@vite('resources/css/users/admin/admin-index.css')

@section('title')
    Admin Dashboard
@endsection

@extends('Users.Admin.layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<body > <header>
    <div class="title">
        Admin Dashboard
    </div>
</header>

<div
    class="grid lg:grid-cols-4 md:grid-cols-2 gap-3 w-full max-w-6xl mt-4 mb-4">
    <!-- Tile 1 -->
    <a
        href="{{ route('admin#listUser') }}"
        class="flex items-center p-2 bg-gray-100 rounded">
        <div
            class="flex flex-shrink-0 items-center justify-center bg-green-200 h-16 w-16 rounded">
            <i class="fa-solid fa-users"></i>
        </div>
        <div class="flex-grow flex flex-col ml-4">
            <h2 class="text-2xl font-bold">{{ $userData }}</h2>
            <div class="flex items-center justify-between">
                <span class="text-gray-500 text-sm">Users Registered</span>
            </div>
        </div>
    </a>

    <!-- Tile 2 -->
    <a
        href="{{ route('admin#listTalent') }}"
        class="flex items-center p-2 bg-gray-100 rounded">
        <div
            class="flex flex-shrink-0 items-center justify-center bg-yellow-200 h-16 w-16 rounded">
            <i class="fa-solid fa-user"></i>
        </div>
        <div class="flex-grow flex flex-col ml-4">
            <h2 class="text-2xl font-bold">{{ $talentData }}</h2>
            <div class="flex items-center justify-between">
                <span class="text-gray-500 text-sm">Talent Users</span>
            </div>
        </div>
    </a>

    <!-- Tile 3 -->
    <a
        href="{{ route('admin#listIntern') }}"
        class="flex items-center p-2 bg-gray-100 rounded">
        <div
            class="flex flex-shrink-0 items-center justify-center bg-blue-200 h-16 w-16 rounded">
            <i class="fa-solid fa-user"></i>
        </div>
        <div class="flex-grow flex flex-col ml-4">
            <h2 class="text-2xl font-bold">{{ $internData }}</h2>
            <div class="flex items-center justify-between">
                <span class="text-gray-500 text-sm">Intern Users</span>
            </div>
        </div>
    </a>

    <!-- Tile 4 -->
    <a href="" class="flex items-center p-2 bg-gray-100 rounded">
        <div
            class="flex flex-shrink-0 items-center justify-center bg-purple-200 h-16 w-16 rounded">
            <i class="fa-solid fa-key"></i>
        </div>
        <div class="flex-grow flex flex-col ml-4">
            <h2 class="text-2xl font-bold">{{  $countRole }}</h2>
            <div class="flex items-center justify-between">
                <span class="text-gray-500 text-sm">Register Code</span>
            </div>
        </div>
    </a>

</div>

{{-- <div class="main-container">
            <div class="row">
                <div class="card-content">
                    <a href="{{ route('admin#listUser') }}">
                        <div class="card">
                            <div class="card-title">Users Registered</div>
                            <div class="card-body">
                                <h2>{{ $userData }}</h2>
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
                            </div>
                        </div>
                    </a>
                </div>

                <div class="card-content">
                    <a href="{{ route('admin#listIntern') }}">
                        <div class="card">
                            <div class="card-title">Intern Role</div>
                            <div class="card-body">
                                <h2>{{ $internData }}</h2>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="card-content">
                    <a href="">
                        <div class="card last">
                            <div class="card-title">Register Code</div>
                            <div class="card-body">
                                <h2>{{ $countRole }}</h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div> --}}

<!-- Start content -->


<div class="container">
    <div class="mb-4 w-full mx-auto  sm:flex sm:items-center sm:justify-between ">
        <h1 class="text-xl font-bold text-left mt-3">
            Registration Code
        </h1>
        <a
            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
            href="{{ route('admin#createRole') }}">
            <i class="fa-solid fa-plus text-white"></i>
            New Record
        </a>
    </div>
    @if (Session::has('roleCreated'))
    <div class="alert alert-warning animate-box" role="alert">
        {{ Session::get('roleCreated') }}
    </div>
    @endif @if (Session::has('roleDeleted'))
    <div class="alert alert-warning animate-box" role="alert">
        {{ Session::get('roleDeleted') }}
    </div>
    @endif @if (Session::has('userUpdated'))
    <div class="alert alert-warning animate-box" role="alert">
        {{ Session::get('userUpdated') }}
    </div>
    @endif

    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="border rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-start text-xs font-bold text-gray-500 uppercase">No.</th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-start text-xs font-bold text-gray-500 uppercase hidden">Role ID</th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-start text-xs font-bold text-gray-500 uppercase">Registration Code</th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-start text-xs font-bold text-gray-500 uppercase">Role Type</th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-start text-xs font-bold text-gray-500 uppercase">Created Date</th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-start text-xs font-bold text-gray-500 uppercase">Updated Date</th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($roleData as $role)
                            <tr>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-800">{{ ($roleData->currentPage() - 1) * $roleData->perPage() + $loop->iteration }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-800 hidden">{{ $role->id }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-800">{{ $role->registration_code }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-800">{{ $role->role_types }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-800">{{ $role->created_at }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-800">{{ $role->updated_at }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-center text-sm font-medium ">
                                    <a href="{{ route('admin#editRole', $role->id) }}">
                                        <button
                                            type="button"
                                            class="inline-flex items-center gap-x-2 text-sm font-semibold p-2">
                                            <i class="fa-solid fa-pen-to-square text-blue-600 hover:text-blue-800"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('admin#deleteRole', $role->id) }}" class="btn-delete">
                                        <button type="button" class="inline-flex items-center gap-x-2 text-sm p-2">
                                            <i class="fa-solid fa-trash text-red-600 hover:text-red-800"></i>
                                        </button>
                                    </a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $roleData->links() }}
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document
            .querySelectorAll('.btn-delete')
            .forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();

                    const url = this.getAttribute('href');

                    Swal
                        .fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel'
                        })
                        .then((result) => {
                            if (result.isConfirmed) {
                                // Redirect to the URL
                                window.location.href = url;
                            }
                        });
                });
            });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

@endsection