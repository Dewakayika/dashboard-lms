@extends('Users.Admin.layouts.app')

@section('title')
    List User Admin
@endsection

@section('content')
    <!-- Start breadcrumb -->
    <div class="container mx-auto px-4">
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
    <div class="container mx-auto px-4 ">
        <div class="mt-3 mt-4">
            <h1 class="text-xl font-bold text-start">User List</h1>
        </div>

        <!-- Flash messages for success -->
        @if (Session::has('userCreated'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4" role="alert">
                {{ Session::get('userCreated') }}
            </div>
        @endif
        @if (Session::has('userDeleted'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4" role="alert">
                {{ Session::get('userDeleted') }}
            </div>
        @endif
        @if (Session::has('userUpdated'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4" role="alert">
                {{ Session::get('userUpdated') }}
            </div>
        @endif

        <!-- Table with updated style -->
        <div class="flex flex-col">
            <div class="-mx-4 overflow-x-auto">
                <div class="inline-block min-w-full py-2 align-middle">
                    <div class="overflow-hidden border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        No.
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        User ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        User Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        User Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        User Phone
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        User Address
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        User Role
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($userData as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ ($userData->currentPage() - 1) * $userData->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $user->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $user->phone }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $user->address }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $user->role }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="{{ route('admin#editUser', $user->id) }}" class="text-blue-600 hover:text-blue-800">
                                                <i class="fa-solid fa-pen-to-square text-blue-600 hover:text-blue-800"></i>
                                            </a>
                                            <a href="{{ route('admin#deleteUser', $user->id) }}" class="text-red-600 hover:text-red-800 ml-4">
                                                <i class="fa-solid fa-trash text-red-600 hover:text-red-800"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div class="">
                            {{ $userData->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content-->
@endsection
