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

        <form method="GET" action="{{ route('admin#talentCVList') }}">
            <label for="status">Filter by Status:</label>
            <select name="status" id="status" onchange="this.form.submit()">
                <option value="">All</option>
                <option value="" {{ request('status') == '' ? 'selected' : '' }}>Pending</option>
                <option value="approve" {{ request('status') == 'approve' ? 'selected' : '' }}>Approved</option>
                <option value="decline" {{ request('status') == 'decline' ? 'selected' : '' }}>Declined</option>
            </select>
        </form>
        

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
                                        Status
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
                                            <a href="{{ asset('laravel/storage/app/public/' . $CV->cv_file) }}" target="_blank" cl>Download PDF</a>
                                        </td>
                            
                                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-800">
                                            @if($CV->status=='approve')

                                                <span class="text-green-500 p-2 bg-green-100 text-xs "style="border-radius: 50px">{{ $CV->status }}</span>

                                            @elseif($CV->status=='decline')
                                                <span class="text-red-500 p-2 bg-red-100 text-xs "style="border-radius: 50px">{{ $CV->status }}</span>

                                            @else
                                                <span class="text-blue-500 p-2 bg-blue-100 text-xs "style="border-radius: 50px">Pending</span>

                                            @endif

                                        </td>

                                        <td class="px-6 py-3 whitespace-nowrap text-center text-sm font-medium">
                                            <form action="{{ route('cv#decline', $CV->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Decline</button>
                                            </form>

                                            <form action="{{ route('approveCV', $CV->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <label for="registration_code">Select Registration Code:</label>
                                                <select class="text-black" name="registration_code" required>
                                                    <option value="">-- Select Code --</option>
                                                    @foreach ($registrationCodes as $code)
                                                        <option class="text-black" value="{{ $code->registration_code  }}">{{ $code->registration_code  }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </form>
                                            
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
