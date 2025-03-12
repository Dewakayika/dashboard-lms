@extends('users.Admin.layouts.dashboard-app')

@section('content')

    <style>

    </style>
    <div class="col-12 mx-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Home</a></li>
                <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-xs" aria-current="page">List User</li>
            </ol>
        </nav>
    </div>


    <div class="row">
        <div class="col-6 h-100">
            <div class="card mb-4 mx-0">
                <div class="card-header pb-0">
                    <h6 class="mb-0">Talent Data</h6>
                </div>



                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-xs">No.</th>
                                    <th class="text-xs text-center">Username</th>
                                    <th class="text-xs text-center">Email</th>
                                    <th class="text-xs text-center">Role</th>
                                    <th class="text-xs text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs">
                            @php $no = 1; @endphp
                            @foreach ($userData as $user)
                            @if ($user->role == 'talent')
                                <tr>
                                    <td class="ps-4">{{ $no }}</td>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-gradient-warning text-white">Talent</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin#profileDetailUser', $user->id) }}"
                                            class="badge bg-gradient-info text-white">
                                             Details
                                         </a>

                                         <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}"
                                            class="badge bg-gradient-danger text-white">
                                             Delete
                                         </a>
                                    </td>
                                </tr>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog" style="max-width: 400px;">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete  <span class="text-bold">{{ $user->name }}</span>? This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="modal-btn modal-btn-cancel text-center" data-bs-dismiss="modal">Cancel</button>
                                                <a href="{{ route('admin#deleteUser', $user->id) }}" class="modal-btn modal-btn-continue text-center text-decoration-none">
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @php $no++; @endphp
                            @endif
                        @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 h-100">
            <div class="card mb-4 mx-0">
                <div class="card-header pb-0">
                    <h6 class="mb-0">Talent QC Data</h6>
                </div>



                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-xs">No.</th>
                                    <th class="text-xs text-center">Username</th>
                                    <th class="text-xs text-center">Email</th>
                                    <th class="text-xs text-center">Role</th>
                                    <th class="text-xs text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs">
                            @php $no = 1; @endphp
                                @foreach ($userData as $user)
                                    @if ($user->role == 'talent_qc')
                                        <tr>
                                            <td class="ps-4">{{ $no }}</td>
                                            <td class="text-center">{{ $user->name }}</td>
                                            <td class="text-center">{{ $user->email }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-gradient-success text-white">Talent QC</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin#profileDetailUser', $user->id) }}"
                                                    class="badge bg-gradient-info text-white">
                                                     Details
                                                 </a>

                                                 <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}"
                                                    class="badge bg-gradient-danger text-white">
                                                     Delete
                                                 </a>
                                            </td>
                                        </tr>
                                        @php $no++; @endphp

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog" style="max-width: 400px;">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete  <span class="text-bold">{{ $user->name }}</span>? This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="modal-btn modal-btn-cancel text-center" data-bs-dismiss="modal">Cancel</button>
                                                <a href="{{ route('admin#deleteUser', $user->id) }}" class="modal-btn modal-btn-continue text-center text-decoration-none">
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    @endif

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>




@endsection
