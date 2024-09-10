@extends('Users.Admin.layouts.app')

@section('title')
    List Partner Admin
@endsection

@section('content')
    <!-- Start breadcrumb -->
    <div class="container mx-auto px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Partner</li>
            </ol>
        </nav>
    </div>
    <!-- END breadcrumb -->

    <!-- Start content -->
    <div class="container mx-auto px-4">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-center">Talent List</h1>
        </div>

        <!-- Flash messages for success -->
        @if (Session::has('partnerCreated'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4" role="alert">
                {{ Session::get('partnerCreated') }}
            </div>
        @endif
        @if (Session::has('partnerDeleted'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4" role="alert">
                {{ Session::get('partnerDeleted') }}
            </div>
        @endif
        @if (Session::has('partnerUpdated'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4" role="alert">
                {{ Session::get('partnerUpdated') }}
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
                                        Partner ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        User ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        Talent School
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        Date of Birth
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        Bank Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        Bank Account
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($talentData as $talent)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ ($talentData->currentPage() - 1) * $talentData->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $talent->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $talent->user_id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $talent->school }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $talent->date_of_birth }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $talent->bank_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $talent->bank_account }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="{{ route('admin#editPartner', $talent->id) }}" class="text-blue-600 hover:text-blue-800">
                                                <i class="fa-solid fa-pen-to-square  text-blue-600 hover:text-blue-800"></i>
                                            </a>
                                            <a href="{{ route('admin#deletePartner', $talent->user_id) }}" class="text-red-600 hover:text-red-800 ml-4">
                                                <i class="fa-solid fa-trash  text-red-600 hover:text-red-800"></i> 
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div class="">
                            {{ $talentData->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content-->
@endsection
