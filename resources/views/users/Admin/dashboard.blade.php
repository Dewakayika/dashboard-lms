@extends('users.Admin.layouts.dashboard-app')

@section('content')



  <div class="container-fluid">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
      <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
      <div class="row gx-4">
        <div class="col-auto">
          <div class="avatar avatar-xl position-relative">
            <img src="{{asset('images/profile/admin_profile.png')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
          </div>
        </div>
        <div class="col-auto my-auto">
          <div class="h-100">
            <h5 class="mb-1">
              {{$adminData->name}}
            </h5>
            <p class="mb-0 font-weight-bold text-sm">
              {{$adminData->email}}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

    <div class="container-fluid row mt-4">
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
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
            <div class="w-full mx-auto d-flex align-items-center justify-content-between">
                <h6 class="text-weight-bolder">Registration Code</h6>
                <a class="badge badge-sm bg-primary text-sm font-weight-bold mb-0 text-white hover:bg-secondary" href="{{ route('admin#createRole') }}">
                    <i class="fa-solid fa-plus text-white"></i>
                    <span class="px-2">New Record</span>
                </a>
            </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 invisible">ID</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Register Code</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Create At</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Updated At</th>


                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($roleData as $role)
                <tr>
                  <td>
                    <p class=" px-3 text-xs font-weight-bold mb-0">{{ ($roleData->currentPage() - 1) * $roleData->perPage() + $loop->iteration }}</p>
                  </td>
                  <td class="align-middle text-center text-sm invisible">
                    <span class="text-center text-xs font-weight-bold mb-0 ">{{ $role->id }}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-center text-xs font-weight-bold mb-0">{{ $role->registration_code }}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    @if ($role->role_types == 'intern')
                        <span class="badge badge-sm bg-gradient-success">{{ $role->role_types }}</span>
                    @elseif ($role->role_types == 'talent')
                        <span class="badge badge-sm bg-gradient-info">{{ $role->role_types }}</span>
                    @elseif ($role->role_types == 'talent_qc')
                        <span class="badge badge-sm bg-gradient-warning">{{ $role->role_types }}</span>
                    @else
                        <span class="badge badge-sm bg-gradient-waring">{{ $role->role_types }}</span>
                    @endif

                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-center text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($role->created_at)->translatedFormat('l, F j Y') }}
                    </span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-center text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($role->updated_at)->translatedFormat('l, F j Y') }}
                    </span>
                  </td>
                  <td class="align-middle text-center">
                    <a href="{{ route('admin#editRole', $role->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                      Edit
                    </a>
                    <a href="{{ route('admin#deleteRole', $role->id) }}" class="text-secondary text-danger font-weight-bold text-xs px-3" data-toggle="tooltip" data-original-title="Edit user">
                        Delete
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
  </div>

  <div class="container-fluid row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="text-weight-bolder">Talent Request</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 invisible">ID</th>
                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Full Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Address</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone Number</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gender</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Of Birth</th>
                    <th th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($pendingUsers as $user)
                <tr>
                  <td>
                    <p class=" px-3 text-xs font-weight-bold mb-0">{{ ($leaderboard->currentPage() - 1) * $leaderboard->perPage() + $loop->iteration }}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-center text-xs font-weight-bold mb-0 invisible">{{ $user->id }}</span>
                  </td>
                  <td class="align-middle text-sm">
                    <span class="text-xs font-weight-bold mb-0">{{ $user->full_name }}</span>
                  </td>

                  <td class="align-middle  text-sm">
                    <span class=" text-xs font-weight-bold mb-0">{{ $user->address }}</span>
                  </td>

                  <td class="align-middle text-center text-sm">
                    <span class="text-center text-xs font-weight-bold mb-0">{{ $user->phone_number }}</span>
                  </td>

                  <td class="align-middle text-center text-sm">
                    <span class="text-center text-xs font-weight-bold mb-0">{{ $user->gender }}</span>
                  </td>

                  <td class="align-middle text-center text-sm">
                    <span class="text-center text-xs font-weight-bold mb-0">{{ $user->date_of_birth }}</span>
                  </td>

                  <td class="align-right text-right d-flex gap-2">
                    <form action="{{ route('admin.declineUser', $user->id) }}" method="POST" class="w-52">
                        @csrf
                        <button type="submit" class="btn btn-danger w-52">
                            Decline
                        </button>
                    </form>

                    <form action="{{ route('admin.approveUser', $user->id) }}" method="POST" class="w-52">
                        @csrf
                        <button type="submit" class="btn btn-success w-52">
                            Approve
                        </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Project Types Section --}}
  <div class="container-fluid py-4">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="w-full mx-auto d-flex align-items-center justify-content-between">
            <h6 class="text-weight-bolder">Project Types</h6>
            <a class="badge badge-sm bg-primary text-sm font-weight-bold mb-0 text-white hover:bg-secondary" data-bs-toggle="modal" data-bs-target="#addProjectType">
              <i class="fa-solid fa-plus text-white"></i>
              <span class="px-2">New Project Type</span>
            </a>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 invisible">ID</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Updated At</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($projectTypes as $projectType)
                <tr>
                  <td>
                    <p class="px-3 text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                  </td>
                  <td class="align-middle text-center text-sm invisible">
                    <span class="text-center text-xs font-weight-bold mb-0">{{ $projectType->id }}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-center text-xs font-weight-bold mb-0">{{ $projectType->name }}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-center text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($projectType->created_at)->translatedFormat('l, F j Y') }}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-center text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($projectType->updated_at)->translatedFormat('l, F j Y') }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <a href="#" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#editProjectType{{$projectType->id}}">
                      Edit
                    </a>
                    <a href="#" class="text-secondary text-danger font-weight-bold text-xs px-3" data-bs-toggle="modal" data-bs-target="#deleteProjectType{{$projectType->id}}">
                      Delete
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
  </div>

  <!-- Add Project Type Modal -->
  <div class="modal fade" id="addProjectType" tabindex="-1" aria-labelledby="addProjectTypeLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 400px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addProjectTypeLabel">Add Project Type</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.storeProjectType') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="name" class="form-label">Project Type Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-between border-0">
            <button type="button" class="modal-btn modal-btn-cancel" style="width: 45%;" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="modal-btn modal-btn-continue" style="width: 45%;">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Project Type Modals -->
  @foreach($projectTypes as $projectType)
  <div class="modal fade" id="editProjectType{{$projectType->id}}" tabindex="-1" aria-labelledby="editProjectTypeLabel{{$projectType->id}}" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 400px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProjectTypeLabel{{$projectType->id}}">Edit Project Type</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.updateProjectType', $projectType->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <div class="mb-3">
              <label for="name" class="form-label">Project Type Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $projectType->name }}" required>
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-between border-0">
            <button type="button" class="modal-btn modal-btn-cancel" style="width: 45%;" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="modal-btn modal-btn-continue" style="width: 45%;">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteProjectType{{$projectType->id}}" tabindex="-1" aria-labelledby="deleteProjectTypeLabel{{$projectType->id}}" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 400px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteProjectTypeLabel{{$projectType->id}}">Delete Project Type?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete project type "{{ $projectType->name }}"? This action cannot be undone.</p>
        </div>
        <div class="modal-footer d-flex justify-content-between border-0">
          <button type="button" class="modal-btn modal-btn-cancel" style="width: 45%;" data-bs-dismiss="modal">Cancel</button>
          <form action="{{ route('admin.deleteProjectType', $projectType->id) }}" method="POST" style="width: 45%;">
            @csrf
            @method('DELETE')
            <button type="submit" class="modal-btn modal-btn-continue w-100">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach




@endsection

