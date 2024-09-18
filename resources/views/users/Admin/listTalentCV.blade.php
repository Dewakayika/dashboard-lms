@extends('Users.Admin.layouts.app')

@section('title')
    Admin Dashboard | Talent CV
@endsection

@section('content')
    <!-- Start breadcrumb -->
    <div class="container mx-auto px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Talent CV</li>
            </ol>
        </nav>
    </div>
    <!-- END breadcrumb -->

    <!-- Start content -->
    <div class="container mx-auto px-4">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-left">Talent CV</h1>
        </div>

        <!-- Flash messages for success -->
        @if (Session::has('partnerCreated'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4" role="alert">
                {{ Session::get('partnerCreated') }}
            </div>
        @endif
        @if (Session::has('CVDeleted'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4" role="alert">
                {{ Session::get('CVDeleted') }}
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
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        Phone Number
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        CV Files
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        Created At
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        Updated At
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($talentCV as $CV)
                                    <tr>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ ($talentCV->currentPage() - 1) * $talentCV->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-800 hidden">{{ $CV->id }}</td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-800">{{ $CV->name }}</td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-800">{{ $CV->email }}</td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-800">{{ $CV->phone_number }}</td>
                            
                                        <!-- Tampilkan file PDF -->
                                        <td class="p-3 whitespace-nowrap text-sm text-blue-800 underline ">    
                                            <a href="{{ asset('storage/' . $CV->cv_file) }}" target="_blank" cl>Download PDF</a>
                                        </td>
                                        
                                        {{-- <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-800">
                                            @if ($CV->cv_file)

                                                <embed src="{{ asset('storage/app/public/cv_files/' . $CV->cv_file) }}" width="150px" height="150px" type="application/pdf" />
                                            @else
                                                <span class="text-red-500">No CV Uploaded</span>
                                            @endif
                                        </td> --}}
                            
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-800">{{ $CV->created_at }}</td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-800">{{ $CV->updated_at }}</td>
                                        <td class="px-6 py-3 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="{{ route('admin#editPartner', $CV->id) }}" class="text-blue-600 hover:text-blue-800">
                                                <i class="fa-solid fa-pen-to-square text-blue-600 hover:text-blue-800"></i>
                                            </a>
                                            <a href="{{ route('admin#deleteCV', $CV->id) }}" class="btn-delete">
                                                <button type="button" class="inline-flex items-center gap-x-2 text-sm p-2">
                                                    <i class="fa-solid fa-trash text-red-600 hover:text-red-800"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div class="">
                            {{ $talentCV->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content-->
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
@endsection
