@extends('Users.Admin.layouts.app')

@section('title')
    List User Admin
@endsection

@section('content')
    <!-- Start breadcrumb -->
    <div class="container mx-auto px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Home</a></li>
                <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-xs" aria-current="page">List User</li>
            </ol>
        </nav>
    </div>
    <!-- END breadcrumb -->

    <!-- Start content -->  
    <div class="container mx-auto px-4 ">
        <div class="mb-2 w-full mx-auto  sm:flex sm:items-center sm:justify-between ">
            <h1 class="text-xl font-bold text-left mt-3">
               Users Data
            </h1>

            <!-- Table with updated style -->
            <form method="GET" action="{{ route('admin#listUser') }}">
                <select name="role" id="role" onchange="this.form.submit()" class="border py-2 px-2 rounded bg-gray-100 text-xs" >
                    <option value="" class="text-xs">All</option>
                    <option value="Intern" {{ request()->input('role') == 'Intern' ? 'selected' : '' }}>Intern</option>
                    <option value="Talent" {{ request()->input('role') == 'Talent' ? 'selected' : '' }}>Talent</option>
                </select>
            </form>
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
        
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">No.</th>
                                <th class="px-24 py-3 text-left text-xs font-bold text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Code</th>


                
                                @if($role == 'Intern' || !$role)
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Phone</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Address</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Gender</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Job</th>
                                @endif
                
                                @if($role == 'Talent' || !$role)
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">School</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Bank</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Acc</th>
                                @endif

                                <th class="px-6 py-3 text-center text-xs font-bold uppercase">Action</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($userData as $user)
                                <tr>
                                    <td class="px-6 py-3 text-xs text-gray-800">
                                        {{ ($userData->currentPage() - 1) * $userData->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-2 py-3 text-xs text-gray-800">{{ $user->name }}</td>
                                    <td class="px-6 py-3 text-xs text-gray-800">{{ $user->email }}</td>
                                    <td class="px-6 py-3 text-xs text-gray-800">

                                        @if ($user->role == 'intern')
                                            <span class="text-green-500 p-2 bg-green-100 text-xs "style="border-radius: 50px">Intern</span>
                                        @elseif($user->role == 'admin')
                                            <span class="text-red-500 p-2 bg-red-100 text-xs "style="border-radius: 50px">Admin</span>
                                        @elseif($user->role == 'talent')
                                            <span class="text-blue-500 p-2 bg-blue-100 text-xs "style="border-radius: 50px">Talent</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-3 text-xs text-gray-800 font-bold">{{ $user->registration_code }}</td>


                                    @if($role == 'Intern' || !$role)
                                        <td class="px-6 py-3 text-xs text-gray-800">{{ $user->intern->phone_number ?? 'N/A' }}</td>
                                        <td class="px-6 py-3 text-xs text-gray-800">{{ $user->intern->address ?? 'N/A' }}</td>
                                        <td class="px-6 py-3 text-xs text-gray-800">{{ $user->intern->gender ?? 'N/A' }}</td>
                                        <td class="px-6 py-3 text-xs text-gray-800">{{ $user->intern->job ?? 'N/A' }}</td>
                                    @endif
                
                                    @if($role == 'Talent' || !$role)
                                        <td class="px-6 py-3 text-xs text-gray-800">{{ $user->talent->school ?? 'N/A' }}</td>
                                        <td class="px-6 py-3 text-xs text-gray-800">{{ $user->talent->bank_name ?? 'N/A' }}</td>
                                        <td class="px-6 py-3 text-xs text-gray-800">{{ $user->talent->bank_account ?? 'N/A' }}</td>
                                    @endif
                
                                    <td class="px-6 py-3 text-center text-xs">
                                        <a href="{{ route('admin#editUser', $user->id) }}" class="text-blue-600 hover:text-blue-800">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('admin#deleteUser', $user->id) }}" class="text-red-600 hover:text-red-800 ml-4">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $userData->links() }}
                    </div>

                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- End content-->
@endsection
