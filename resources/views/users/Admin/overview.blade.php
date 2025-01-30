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
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Statistic Project {{ $selectedYear }}</h6>
                <form method="GET" action="{{ request()->url() }}">
                    <select name="year" id="year"
                            class="form-select form-select-sm ms-3"
                            onchange="this.form.submit()">
                        @foreach($availableYears as $year)
                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div>
                <canvas id="myChart"></canvas>
            </div>
          </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">On Going Project</h6>
            </div>
            <div class="card-body d-flex flex-column justify-content-between">
                <ul class="list-group h-100 d-flex flex-column justify-content-between">
                    <li class="list-group-item border-0 d-flex align-items-center mb-2">
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
                    <li class="list-group-item border-0 d-flex align-items-center px-3 mb-2">
                        <div class="d-flex align-items-start flex-row gap-3 justify-content-center">
                            <div class="icon icon-shape bg-blue-200 text-center border-radius-2xl">
                                <i class="fa-regular fa-chess-queen" style="color: #2e86c1"></i>
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Project Assign</h6>
                                <p class="text-normal text-xs">Project Applied, still working on it</p>
                            </div>
                        </div>
                        <h4 class="pe-3 ps-0 mb-0 ms-auto d-flex justify-content-center">{{$projectAssign}}</h4>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-3 mb-2">
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
                    <li class="list-group-item border-0 d-flex align-items-center px-3 mb-2">
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
                    <li class="list-group-item border-0 d-flex align-items-center px-3 mb-2">
                        <div class="d-flex align-items-start flex-row gap-3 justify-content-center">
                            <div class="icon icon-shape bg-red-200 text-center border-radius-2xl">
                                <i class="fa-regular fa-file-excel" style="color: #c0392b"></i>
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Project Revision</h6>
                                <p class="text-normal text-xs">Revision note release by admin</p>
                            </div>
                        </div>
                        <h4 class="pe-3 ps-0 mb-0 ms-auto d-flex justify-content-center">{{$projectRevise}}</h4>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-3 mb-2">
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
            </div>
        </div>
    </div>
  </div>


  <div class="col-lg-12  col-md-6 mb-md-0 mb-4" >
    <div class="card" style="min-height: 400px;"  >
      <div class="card-header pb-0">
        <div class="row">
          <div class="w-full mx-auto  d-flex align-items-center justify-content-between">
              <h6 class="text-weight-bolder">Project Offer</h6>
              <a class="badge badge-xs bg-primary text-sm font-weight-bold mb-0 text-white hover:bg-secondary" href="# " data-bs-toggle="modal" data-bs-target="#createProjectModal">
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
                  <span class="badge badge-sm bg-gradient-warning"> {{ $project->status }}</span>
                </td>
                <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-info share-project"
                          data-bs-toggle="modal"
                          data-bs-target="#shareToWhatsAppModal"
                          data-project-id="{{ $project->id }}"
                          style="cursor: pointer;">
                        Share Project
                    </span>
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


  {{-- Share Project --}}
  <div class="modal fade" id="shareToWhatsAppModal" tabindex="-1" aria-labelledby="shareToWhatsAppModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content rounded-3 shadow-lg">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="shareToWhatsAppModalLabel">Share New Project Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="px-3 pt-3" style="max-height: 70vh; overflow-y: auto;">
                <p class="text-xs text-left"><strong>Subject:</strong> <span id="modal-subject"></span></p>
                <p class="text-xs text-left"><strong>Project Name:</strong> <span id="modal-comic-name"></span></p>
                <p class="text-xs text-left"><strong>Chapter Number:</strong> <span id="modal-chapter-number"></span></p>
                <p class="text-xs text-left"><strong>QC:</strong> <span id="modal-talent-qc"></span></p>
                <p class="text-xs text-left"><strong>Status:</strong> <span id="modal-status"></span></p>
                <a id="whatsappLink" href="#" target="_blank" class="btn w-100 mt-3 text-white" style="background-color: #0c9d08">
                    <i class="fa-brands fa-whatsapp px-2" style="color: #ffffff;"></i>
                    Share to WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const projects = {!! json_encode($projectsList->toArray()) !!};
    console.log('All projects:', projects); // Debug log

    document.querySelectorAll('.share-project').forEach(button => {
        button.addEventListener('click', function() {
            const projectId = this.getAttribute('data-project-id');
            console.log('Clicked project ID:', projectId); // Debug log

            const project = projects.data.find(p => p.id == projectId);
            console.log('Found project:', project); // Debug log

            if (project) {
                // Update modal content
                document.getElementById('modal-subject').textContent = 'New Project Posted!';
                document.getElementById('modal-comic-name').textContent = project.comic_name;
                document.getElementById('modal-chapter-number').textContent = project.chapter_number;
                document.getElementById('modal-talent-qc').textContent = project.talent_qc;
                document.getElementById('modal-status').textContent = project.status;

                // Update WhatsApp link
                const whatsappLink = document.getElementById('whatsappLink');
                whatsappLink.onclick = function(e) {
                    e.preventDefault();
                    const message =
                                   `*New Project Posted!*\n` +
                                   `Project Name: ${project.comic_name}\n` +
                                  `Chapter Number: ${project.chapter_number}\n` +
                                  `QC: ${project.talent_qc}\n` +
                                  `Status: ${project.status}\n` +
                                  `\n` +
                                  `Apply Now on Our Dashboard! dashboard.padmastudio.io`;
                    const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;
                    window.open(whatsappUrl, '_blank');
                };
            }
        });
    });
});
</script>






  <div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProjectModalLabel">Create New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="px-3 pt-3">
                <form action="{{ route('projects#store') }}" method="POST" enctype="multipart/form-data" role="form text-left">
                    @csrf
                    <div class="mb-2">
                      <label for="comic_name" class="text-md text-dark">Comic Name</label>
                      <input type="text" name="comic_name" class="form-control" placeholder="Example Keiken Ninzu">
                      @error('comic_name')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="mb-2">
                      <label for="chapter_number" class="text-md text-dark">Chapter Number</label>
                      <input type="number" name="chapter_number" class="form-control" placeholder="Example 17, 18, 19">
                      @error('chapter_number')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="mb-2">
                      <label for="talent_qc" class="text-md text-dark">Select Talent QC</label>
                      <select  name="talent_qc" class="form-control selector" placeholder="Select Talent QC" >
                          <option value="" class="form-control">Pelase select Talent Qc</option>
                          @foreach ($talentQc as $Qc)
                              <option class="text-black" value="{{ $Qc->id }}">{{ $Qc->name }}</option>
                          @endforeach
                      </select>
                      @error('talent_qc')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="mb-2">
                      <label for="file" class="text-md text-dark">Link Project</label>
                      <input type="text" name="file" class="form-control" placeholder="Box storage link">
                      @error('file')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-dark w-100 my-4">Create Project</button>
                    </div>
                  </form>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmApply(projectId) {
        var modalId = 'confirmApplyModal-' + projectId;
        var modal = new bootstrap.Modal(document.getElementById(modalId));
        modal.show();
    }
</script>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');

        const months = @json($months);
        const totals = @json($totals);
        const selectedYear = @json($selectedYear);

        // Format the month labels for x-axis (short format: Jan 25, Feb 25)
        const formattedLabels = months.map(month => {
            const date = new Date(month);
            return date.toLocaleDateString('en-US', { month: 'short', year: '2-digit' });
        });

        // Format for tooltip (full format: January 2025, February 2025)
        const fullMonthLabels = months.map(month => {
            const date = new Date(month);
            return date.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
        });

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: formattedLabels,
                datasets: [{
                    label: `Total Projects (${selectedYear})`,
                    data: totals,
                    borderWidth: 0,
                    backgroundColor: 'rgba(255, 154, 154 )',
                    borderRadius: 8,
                    borderSkipped: false,
                    barPercentage: 0.7,
                    categoryPercentage: 0.8
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0,
                            font: {
                                family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif',
                                size: 12
                            }
                        },
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif',
                                size: 12
                            }
                        }
                    }
                },
                responsive: true,
                plugins: {
                    tooltip: {
                        enabled: true,
                        position: 'nearest',
                        backgroundColor: 'rgba(255, 255, 255, 0.95)',
                        titleColor: '#333',
                        titleFont: {
                            family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif',
                            size: 14,
                            weight: '600'
                        },
                        bodyColor: '#666',
                        bodyFont: {
                            family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif',
                            size: 13
                        },
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: false,
                        borderColor: 'rgba(0, 0, 0, 0.1)',
                        borderWidth: 1,
                        callbacks: {
                            title: function(tooltipItems) {
                                // Use full month format for tooltip
                                const index = tooltipItems[0].dataIndex;
                                return fullMonthLabels[index];
                            },
                            label: function(context) {
                                return `Total Projects: ${context.parsed.y}`;
                            }
                        }
                    },
                    title: {
                        display: false
                    },
                    legend: {
                        display: false
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });

    </script>


    <script>
        const ctx2 = document.getElementById('radarChart').getContext('2d');

        new Chart(ctx2, {
            type: 'bar',
            indexAxis: 'y',
            data: {
                labels: ['Waiting Talent', 'Project Assign', 'Project QC', 'Project Draft', 'Project Revision', 'Project Completed'],
                datasets: [{
                    label: 'Project Status',
                    data: [{{$projectWaiting}}, {{$projectAssign}}, {{$projectQC}}, {{$projectDraft}}, {{$projectRevise}}, {{$projectCompleted}}],
                    backgroundColor: [
                        '#f1c40f',
                        '#d35400',
                        '#2e86c6',
                        '#2e86c1',
                        '#c0392b',
                        '#28b463'
                    ],
                    borderRadius: 6,
                    borderSkipped: false,
                    barPercentage: 0.7,
                    categoryPercentage: 0.8
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            stepSize: 1,
                            precision: 0,
                            font: {
                                family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif',
                                size: 12
                            }
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif',
                                size: 12
                            }
                        }
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        position: 'nearest',
                        backgroundColor: 'rgba(255, 255, 255, 0.95)',
                        titleColor: '#333',
                        titleFont: {
                            family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif',
                            size: 14,
                            weight: '600'
                        },
                        bodyColor: '#666',
                        bodyFont: {
                            family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif',
                            size: 13
                        },
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: true,
                        borderColor: 'rgba(0, 0, 0, 0.1)',
                        borderWidth: 1,
                        callbacks: {
                            title: function(tooltipItems) {
                                return tooltipItems[0].label;
                            },
                            label: function(context) {
                                return `Total Projects: ${context.parsed.x}`;
                            }
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            },
            plugins: [{
                afterDraw: function(chart) {
                    var ctx = chart.ctx;
                    chart.data.datasets.forEach(function(dataset, datasetIndex) {
                        var meta = chart.getDatasetMeta(datasetIndex);
                        meta.data.forEach(function(bar, index) {
                            var data = dataset.data[index];

                            // Only draw text if the bar is wide enough
                            if (bar.width > 20) {
                                ctx.save();
                                ctx.fillStyle = 'white';
                                ctx.font = '12px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif';
                                ctx.textAlign = 'left';
                                ctx.textBaseline = 'middle';

                                // Position text inside the bar
                                var x = bar.x + 10; // 10px padding from start of bar
                                var y = bar.y;

                                // Draw text
                                ctx.fillText(data, x, y);
                                ctx.restore();
                            }
                        });
                    });
                }
            }]
        });

    </script>

@endsection


