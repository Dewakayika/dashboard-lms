@extends('users.Admin.layouts.auth')

@section('content')

  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body bg-primary p-3 border-radius-xl">
          <div class="row">
            <div class="col-8">
                <div class="icon icon-shape bg-white shadow text-center border-radius-section">
                    <i class="fa-solid fa-award fa-xl" style="color: #ed3237;"></i>
                </div>
              <div class="numbers mt-4">
                    <h5 class="font-weight-bolder text-white mb-0">
                    {{ $userData }}
                    </h5>
                <p class="text-sm mb-0 text-white text-capitalize font-weight-light">Community Member</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body bg-secondary p-3 border-radius-xl">
          <div class="row">
            <div class="col-8">
                <div class="icon icon-shape bg-white shadow text-center border-radius-section">
                    <i class="fa-solid fa-user-group fa-xl" style="color: #27272a;"></i>
                  </div>
              <div class="numbers mt-4">
                <h5 class="font-weight-bolder text-white mb-0">
                    {{ $talentData }}
                  </h5>
                <p class="text-sm mb-0 text-capitalize text-white font-weight-light">Talent User</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body bg-secondary p-3 border-radius-xl">
            <div class="row">
              <div class="col-8">
                  <div class="icon icon-shape bg-white shadow text-center border-radius-section">
                      <i class="fa-solid fa-user-group fa-xl" style="color: #27272a;"></i>
                    </div>
                <div class="numbers mt-4">
                  <h5 class="font-weight-bolder text-white mb-0">
                    {{ $internData }}

                    </h5>
                  <p class="text-sm mb-0 text-capitalize text-white font-weight-light">QC Talent</p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body bg-secondary p-3 border-radius-xl">
            <div class="row">
              <div class="col-8">
                  <div class="icon icon-shape bg-white shadow text-center border-radius-section">
                      <i class="fa-solid fa-user-group fa-xl" style="color: #27272a;"></i>
                    </div>
                <div class="numbers mt-4">
                  <h5 class="font-weight-bolder text-white mb-0">
                    {{ $internData }}
                    </h5>
                  <p class="text-sm mb-0 text-capitalize text-white font-weight-light">Intern User</p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="row mt-4">
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

  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="text-weight-bolder">Leaderboard</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 invisible">ID</th>
                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Submissions</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Vote</th>
                    <th th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($leaderboard as $user)
                <tr>
                  <td>
                    <p class=" px-3 text-xs font-weight-bold mb-0">{{ ($leaderboard->currentPage() - 1) * $leaderboard->perPage() + $loop->iteration }}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-center text-xs font-weight-bold mb-0 invisible">{{ $user->id }}</span>
                  </td>
                  <td class="align-middle text-sm">
                    <span class="text-xs font-weight-bold mb-0">{{ $user->name }}</span>
                  </td>

                  <td class="align-middle  text-sm">
                    <span class=" text-xs font-weight-bold mb-0">{{ $user->email }}</span>
                  </td>

                  <td class="align-middle text-center text-sm">
                    <span class="text-center text-xs font-weight-bold mb-0">{{ $user->total_submissions }}</span>
                  </td>

                  <td class="align-middle text-center text-sm">
                    <span class="text-center text-xs font-weight-bold mb-0">{{ $user->total_votes }}</span>
                  </td>

                  <td class="align-middle text-center text-sm">
                    @if ($user->total_submissions == 8)
                        <span class="badge badge-sm bg-gradient-success">Completed</span>
                    @else
                        <span class="badge badge-sm bg-gradient-warning">Incompleted</span>
                    @endif

                  </td>
                  <td class="align-middle text-center">
                    <a href="{{ route('admin.user.submissions', ['id' => Crypt::encrypt($user->id)]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                      Detail
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

