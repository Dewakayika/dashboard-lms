@section('title')
    List User Admin
@endsection

@extends('Users.Admin.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">List User</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div class="container">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-center">
                User List
            </h1>
        </div>
        @if (Session::has('userCreated'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('userCreated') }}
            </div>
        @endif
        @if (Session::has('userDeleted'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('userDeleted') }}
            </div>
        @endif
        @if (Session::has('userUpdated'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('userUpdated') }}
            </div>
        @endif
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>User Id</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>User Phone</th>
                    <th>User Address</th>
                    <th>User Role</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($userData as $user)
                    <tr>
                        <td>{{ ($userData->currentPage() - 1) * $userData->perPage() + $loop->iteration }}</td>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->role }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin#editUser', $user->id) }}">
                                <button type="button"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    id="details">
                                    Edit</button>
                            </a>
                            <a href="{{ route('admin#deleteUser', $user->id) }}">
                                <button type="button"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                    id="details">
                                    Delete</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $userData->links() }}
    </div>

    <!-- End content-->
@endsection
