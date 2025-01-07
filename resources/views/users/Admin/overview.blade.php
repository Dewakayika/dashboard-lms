@extends('users.Admin.layouts.auth')

@section('content')

  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body bg-primary p-3 border-radius-xl">
            <div class="row">
              <div class="col-8">
                  <div class="icon icon-shape bg-white shadow text-center border-radius-section">
                      <i class="fa-solid fa-repeat fa-xl" style="color: #ed3237;"></i>
                  </div>
                <div class="numbers mt-4">
                      <h5 class="font-weight-bolder text-white mb-0">
                      1
                      </h5>
                  <p class="text-sm mb-0 text-white text-capitalize font-weight-light">On Going Project</p>
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
                    {{ $averageDuration }}
                    </h5>
                  <p class="text-sm mb-0 text-capitalize text-white font-weight-light">Average Project Durations</p>
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

                    </h5>
                  <p class="text-sm mb-0 text-capitalize text-white font-weight-light">Intern User</p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>

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

  <div class="row my-4">
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="w-full mx-auto d-flex align-items-center justify-content-between">
                <h6 class="text-weight-bolder">Project Offer</h6>
                <a class="badge badge-xs bg-primary text-sm font-weight-bold mb-0 text-white hover:bg-secondary" href="{{ route('admin#createNewProject') }}">
                    <i class="fa-solid fa-plus text-white"></i>
                    <span class="px-2">New Project</span>
                </a>
            </div>
          </div>
        </div>
        @if ($projectsList->isEmpty())
        <div class="text-center d-flex align-items-center justify-content-center">
            <div class="mb-3">
                <img src="{{ asset('/assets/img/ilustration/NoDocuments.svg')}}" class="h-11 w-11">
                <p class="text-xs">There's no Project Offer yet</p>
            </div>
        </div>
        @else
        <div class="card-body px-0 pb-2">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comic Name</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Episode Number</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Talent QC</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Panel</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ( $projectsList as $project )
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{ asset('/assets/img/small-logos/webtoon.png')}}" class="avatar avatar-sm me-3" alt="xd">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $project->comic_name }}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-sm font-weight-bold"> {{ $project->chapter_number }} </span>
                  </td>
                  <td>
                    <div class="avatar-group mt-2 d-flex">
                      <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom">
                      </a>
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-sm px-1 font-weight-bold">{{ $project->talent_qc }}</p>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-sm text-center font-weight-bold"> {{ $project->number_of_panel }}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-warning"> {{ $project->status }}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-info"> Detail </span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <ul class="pagination justify-content-center">
                @if ($projectsList->onFirstPage())
                    <li class="page-item disabled px-1">
                        <span class="page-link"><i class="fa-solid fa-backward"></i></span>
                    </li>
                @else
                    <li class="page-item px-1">
                        <a class="page-link" href="{{ $projectsList->previousPageUrl() }}" aria-label="Previous"><i class="fa-solid fa-backward"></i></a>
                    </li>
                @endif

                @foreach ($projectsList->getUrlRange(1, $projectsList->lastPage()) as $page => $url)
                    <li class="page-item px-1 {{ $page == $projectsList->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($projectsList->hasMorePages())
                    <li class="page-item px-1">
                        <a class="page-link" href="{{ $projectsList->nextPageUrl() }}" aria-label="Next"><i class="fa-solid fa-forward"></i></a>
                    </li>
                @else
                    <li class="page-item disabled px-1">
                        <span class="page-link"><i class="fa-solid fa-forward"></i></span>
                    </li>
                @endif
            </ul>
          </div>
        </div>
        @endif
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Leaderboard</h6>
            </div>
            <div class="card-body p-3">
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="avatar me-3">
                            <img src="{{ asset('/assets/img/marie.jpg') }}" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Sophie B.</h6>
                            <p class="mb-0 text-xs">Hi! I need more information..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="avatar me-3">
                            <img src="{{ asset('/assets/img/marie.jpg') }}" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Anne Marie</h6>
                            <p class="mb-0 text-xs">Awesome work, can you..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                    </li>
                </ul>
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

