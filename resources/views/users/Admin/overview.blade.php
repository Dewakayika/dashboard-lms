@extends('users.Admin.layouts.auth')

@section('content')

  <div class="row">

    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
      <a class="card" href="{{route('admin#timeStatistic')}}">
        <div class="card-body bg-white p-3 border-radius-xl">
          <div class="row">
            <div class="col-8">
                <div class="icon icon-shape bg-green-200 shadow opacity-95 text-center border-radius-section">
                    <i class="fa-regular fa-clock fa-lg" style="color: #1ea079;"></i>
                  </div>
              <div class="numbers mt-4">
                <h3 class="font-weight-bolder text-gray-700 mb-0">
                    {{ gmdate('H:i:s', $averageDuration) }}
                  </h3>
                <p class="text-sm mb-0 text-capitalize text-black font-weight-light">Average Project Serving Time</p>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>


    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body bg-white p-3 border-radius-xl">
            <div class="row">
              <div class="col-8">
                  <div class="icon icon-shape bg-blue-200 shadow text-center border-radius-section">
                    <i class="fa-regular fa-rectangle-list fa-lg" style="color: #2e86c1 "></i>
                    </div>
                <div class="numbers mt-4">
                  <h3 class="font-weight-bolder text-gray-700 mb-0">
                        {{$totalPanel}}
                    </h3>
                  <p class="text-sm mb-0 text-capitalize text-black font-weight-light">Total Working Panel</p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body bg-white p-3 border-radius-xl">
            <div class="row">
              <div class="col-8">
                  <div class="icon icon-shape bg-red-200 shadow text-center border-radius-section">
                    <i class="fa-regular fa-file-lines fa-lg" style="color: #e67e22;" ></i>
                  </div>
                <div class="numbers mt-4">
                      <h3 class="font-weight-bolder text-gray-700 mb-0">
                        {{$totalProjectThisYear}}
                      </h3>
                  <p class="text-sm mb-0 text-black text-capitalize font-weight-light">Total Project</p>
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
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4" >
        <div class="card " style="padding: 20px" >
            <div class="card-header">
                <h6 class="mb-0">Statistic Project by Priode</h6>
            </div>
            <div class="h-auto">
                <canvas id="myChart"></canvas>
            </div>
          </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">On Going Project</h6>
            </div>
            <div class="p-3 min-height-160">
                <canvas  id="radarChart" ></canvas>
            </div>
            {{-- <div class="card-body p-3 justify-content-between">
                <ul class=" justify-content-between">
                    <li class="list-group-item border-0 d-flex  align-items-center px-3 mb-2 ">
                        <div class="d-flex align-items-start flex-row gap-3 justify-content-center">
                            <div class="icon icon-shape bg-yellow-200 text-center border-radius-2xl">
                                <i class="fa-regular fa-hourglass-half" style="color: #f1c40f"></i>
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Waiting Talent</h6>
                                <p class="text-normal text-xs">Waiting Talent approved Project</p>
                            </div>
                        </div>
                        <h4 class="pe-3 ps-0 mb-0 ms-auto d-flex justify-content-center">{{$projectWaiting}}</h4>
                    </li>
                    <li class="list-group-item   border-0 d-flex  align-items-center px-3 mb-2 gap-3">
                        <div class="d-flex align-items-start flex-row gap-3 justify-content-center">
                            <div class="icon icon-shape bg-orange-200 text-center border-radius-2xl">
                                <i class="fa-regular fa-pen-to-square" style="color: #d35400"></i>
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Project QC</h6>
                                <p class="text-normal text-xs">Waiting QC agent check the project</p>
                            </div>
                        </div>
                        <h4 class="pe-3 ps-0 mb-0 ms-auto d-flex justify-content-center">{{$projectQC}}</h4>
                    </li>
                    <li class="list-group-item   border-0 d-flex  align-items-center px-3 mb-2 gap-3">
                        <div class="d-flex align-items-start flex-row gap-3 justify-content-center">
                            <div class="icon icon-shape bg-blue-200 text-center border-radius-2xl">
                                <i class="fa-regular fa-file-lines" style="color: #2e86c1"></i>
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Project Draft</h6>
                                <p class="text-normal text-xs">Project with status draft submitted</p>
                            </div>
                        </div>
                        <h4 class="pe-3 ps-0 mb-0 ms-auto d-flex justify-content-center">{{$projectDraft}}</h4>
                    </li>
                    <li class="list-group-item   border-0 d-flex  align-items-center px-3 mb-2 gap-3">
                        <div class="d-flex align-items-start flex-row gap-3 justify-content-center">
                            <div class="icon icon-shape bg-red-200 text-center border-radius-2xl">
                                <i class="fa-regular fa-file-excel" style=" color: #c0392b"></i>
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Project Revision</h6>
                                <p class="text-normal text-xs">Revision note release by admin</p>
                            </div>
                        </div>
                        <h4 class="pe-3 ps-0 mb-0 ms-auto d-flex justify-content-center">{{$projectRevise}}</h4>
                    </li>
                    <li class="list-group-item   border-0 d-flex  align-items-center px-3 mb-2 gap-3">
                        <div class="d-flex align-items-start flex-row gap-3 justify-content-center">
                            <div class="icon icon-shape bg-green-200 text-center border-radius-2xl">
                                <i class="fa-regular fa-thumbs-up" style="color: #28b463"></i>
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Project Completed</h6>
                                <p class="text-normal text-xs">Number of project completed</p>
                            </div>
                        </div>
                        <h4 class="pe-3 ps-0 mb-0 ms-auto d-flex justify-content-center">{{$projectCompleted}}</h4>
                    </li>

                </ul>
            </div> --}}
        </div>
    </div>

  </div>

  <div class="col-lg-12  col-md-6 mb-md-0 mb-4" >
    <div class="card" style="min-height: 400px;"  >
      <div class="card-header pb-0">
        <div class="row">
          <div class="w-full mx-auto  d-flex align-items-center justify-content-between">
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
          @if ($projectsList->hasMorePages())
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
          @else

          @endif
        </div>
      </div>
      @endif
    </div>
  </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');

        const months = @json($months);
        const totals = @json($totals);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Total Projects',
                    data: totals,
                    borderWidth: 1,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


    <script>
        const ctx2 = document.getElementById('radarChart').getContext('2d');

        new Chart(ctx2, {
            type: 'doughnut',
            data: {
            labels: ['Waiting Talent', 'Project QC', 'Project Draft', 'Project Revision', 'Project Completed'],
            datasets: [{
                label: 'Project Status',
                data: [{{$projectWaiting}}, {{$projectQC}}, {{$projectDraft}}, {{$projectRevise}}, {{$projectCompleted}}],
                backgroundColor: [
                '#f1c40f',
                '#d35400',
                '#2e86c1',
                '#c0392b',
                '#28b463'
                ],
                hoverOffset: 4
            }]
            },
            options: {
            plugins: {
                tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                    return tooltipItem.label + ': ' + tooltipItem.raw;
                    }
                }
                }
            }
            }
        });
    </script>

@endsection


