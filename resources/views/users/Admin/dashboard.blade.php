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
                    <span class="text-center text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($role->created_at)->translatedFormat('l, F Y') }}
                    </span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-center text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($role->updated_at)->translatedFormat('l, F Y') }}
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

@endsection
@push('dashboard')
  <script>
    window.onload = function() {
      var ctx = document.getElementById("chart-bars").getContext("2d");

      new Chart(ctx, {
        type: "bar",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
            label: "Sales",
            tension: 0.4,
            borderWidth: 0,
            borderRadius: 4,
            borderSkipped: false,
            backgroundColor: "#fff",
            data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
            maxBarThickness: 6
          }, ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
              },
              ticks: {
                suggestedMin: 0,
                suggestedMax: 500,
                beginAtZero: true,
                padding: 15,
                font: {
                  size: 14,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
                color: "#fff"
              },
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false
              },
              ticks: {
                display: false
              },
            },
          },
        },
      });


      var ctx2 = document.getElementById("chart-line").getContext("2d");

      var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

      gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
      gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

      var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

      gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
      gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

      new Chart(ctx2, {
        type: "line",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
              label: "Mobile apps",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#cb0c9f",
              borderWidth: 3,
              backgroundColor: gradientStroke1,
              fill: true,
              data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
              maxBarThickness: 6

            },
            {
              label: "Websites",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#3A416F",
              borderWidth: 3,
              backgroundColor: gradientStroke2,
              fill: true,
              data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
              maxBarThickness: 6
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                padding: 10,
                color: '#b2b9bf',
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#b2b9bf',
                padding: 20,
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
          },
        },
      });
    }
  </script>
@endpush
