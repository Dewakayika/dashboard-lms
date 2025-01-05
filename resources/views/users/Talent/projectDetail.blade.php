
@extends('users.Talent.layouts.dashboard-app')

@section('content')

  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <div class="container-fluid">
        <nav aria-label="container-fluid breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-xs"><a href="{{ route('talent#index') }}">Home</a></li>
                <li class="breadcrumb-item text-xs"><a href="{{ route('talent#projectOverview') }}">Project Overview</a></li>
                <li class="breadcrumb-item active text-xs" aria-current="page">Project {{$projectData->comic_name}} Eps.{{$projectData->chapter_number}}</li>
            </ol>
        </nav>
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('{{asset('/assets/img/webtoon.png')}}'); background-position-y: 50%;">
        <span class="mask bg-secondary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="{{asset('/assets/img/small-logos/webtoon.png')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{$projectData->comic_name}}
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                Episode {{$projectData->chapter_number}}
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">

                <li class="nav-item">
                    @foreach ($projectLogs as $log)
                    <div class="carousel-item @if ($loop->first) active @endif">
                        <div class="d-flex justify-content-center align-items-center ">
                            <!-- Countdown timer -->
                            <div id="countdown-{{ $log->id }}" class="d-flex justify-content-center align-items-center">
                                <div class="text-center me-4">
                                    <h4 id="days-{{ $log->id }}" class="font-weight-bold mb-0">00</h4>
                                    <span class="text-xs text-gray-500">DAY</span>
                                </div>
                                <div class="text-center mx-2">
                                    <h4 id="hours-{{ $log->id }}" class="font-weight-bold mb-0">00</h4>
                                    <span class="text-xs text-gray-500">HOUR</span>
                                </div>
                                <div class="text-center mx-2">
                                    <h4 id="minutes-{{ $log->id }}" class="font-weight-bold mb-0">00</h4>
                                    <span class="text-xs text-gray-500">MIN</span>
                                </div>
                                <div class="text-center ms-2">
                                    <h4 id="seconds-{{ $log->id }}" class="font-weight-bold mb-0">00</h4>
                                    <span class="text-xs text-gray-500">SEC</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      {{-- Tabel --}}
      <div class="row my-4">
        <div class="col w-full mb-4">
        {{-- Tabel Project Information --}}
        <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Projects Information</h6>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Talent QC</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Assign Date</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Finish Date</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Panel</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                          <td class="align-middle  text-sm">
                            <span class="text-sm px-3 font-weight-bold">{{$projectData->talent_qc}}</span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-sm px-1 font-weight-bold">{{ \Carbon\Carbon::parse($projectData->created_at)->translatedFormat('D, M Y') }}</span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-sm px-1 font-weight-bold">{{ $projectData->finish_date ? \Carbon\Carbon::parse($projectData->finish_date)->translatedFormat('D, M Y ') : '-' }}
                            </span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-sm px-1 font-weight-bold">{{$projectData->number_of_panel}}</span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            @if ($projectData->status == 'Project Assign')
                                <span class="badge badge-sm bg-gradient-info">{{ $projectData->status }}</span>
                            @elseif (in_array($projectData->status, ['QC First Draft', 'QC Revise 1', 'QC Revise 2', 'QC Revise 3']))
                                <span class="badge badge-sm bg-gradient-warning">{{ $projectData->status }}</span>
                            @elseif (in_array($projectData->status, ['First Draft Submitted', 'Revise 1 Submitted', 'Revise 2 Submitted', 'Revise 3 Submitted']))
                                <span class="badge badge-sm bg-gradient-warning">{{ $projectData->status }}</span>
                            @elseif (in_array($projectData->status, ['Revision 1', 'Revision 2', 'Revision 3']))
                                <span class="badge badge-sm bg-gradient-danger">{{ $projectData->status }}</span>
                            @elseif ($projectData->status == 'Done')
                                <span class="badge badge-sm bg-gradient-success">{{ $projectData->status }}</span>
                            @else
                                <span class="badge badge-sm bg-gradient-danger">{{ $projectData->status ?? 'Undefined' }}</span>
                            @endif
                          </td>
                          <td class="align-middle text-center text-sm">
                            <a href="{{$projectData->file}}" class="badge badge-sm bg-gradient-info font-weight-bold mb-0 text-white hover:bg-secondary" target="_blank" style="border: none; text-decoration: none;">Download File</a>
                          </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        {{-- Tabel Project Records --}}
        <div class="col-lg-12 col-md-12 mb-md-0 mb-4 mt-4">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                    <div class="w-full mx-auto d-flex align-items-center justify-content-between">
                        <h6 class="text-weight-bolder">Project Records</h6>
                        <a class="badge badge-xs bg-primary text-sm font-weight-bold mb-0 text-white hover:bg-secondary" href="#" data-bs-toggle="modal" data-bs-target="#createProjectModal">
                            <i class="fa-solid fa-plus text-white"></i>
                            <span class="px-2">New Records</span>
                        </a>
                    </div>
                </div>
              </div>

              <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project Stage</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Panel</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if ($projectRecords->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div>
                                        <img src="{{ asset('/assets/img/ilustration/NoConnection.svg')}}" class="h-auto w-11" style="width: 110px; height: auto;">
                                        <p class="text-xs">There are no ongoing projects</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @else
                    @foreach ( $projectRecords as $records )
                    <tr>
                        <td class="align-middle text-sm">
                            <span class="text-sm px-3 font-weight-bold">{{$records->project_stage}}</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="text-sm px-1 font-weight-bold">{{ \Carbon\Carbon::parse($records->created_at)->translatedFormat('D, M Y') }}</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="text-sm px-1 font-weight-bold">{{$records->number_of_panel}}</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="{{$records->link_google_drive}}" class="badge badge-sm bg-gradient-info font-weight-bold mb-0 text-white hover:bg-secondary" target="_blank" style="border: none; text-decoration: none;">Project File</a>
                        </td>
                    </tr>
                    @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="table-responsive">

                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Modal New Records --}}
        <div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProjectModalLabel">Create New Project Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="px-3 pt-3">
                        <form action="{{ route('talent#projectRecods') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $projectData->id }}">
                            <input type="hidden" name="user_id" value="{{ $userData->id }}">

                            <div class="mb-2">
                                <label for="project_stage" class="text-md text-dark">Project Stage</label>
                                <select name="project_stage" class="form-control">
                                    <option value="">Please select Project Stage</option>
                                    <option value="First Draft">First Draft</option>
                                    <option value="Revise 1">Revise 1</option>
                                    <option value="Revise 2">Revise 2</option>
                                    <option value="Revise 3">Revise 3</option>
                                </select>
                                @error('project_stage') <p class="text-danger text-xs mt-2">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-2">
                                <label for="number_of_panel" class="text-md text-dark">Total Number Of Panel</label>
                                <input type="number" name="number_of_panel" class="form-control" placeholder="Example 50">
                                @error('number_of_panel') <p class="text-danger text-xs mt-2">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-2">
                                <label for="link_google_drive" class="text-md text-dark">Link Project</label>
                                <input type="text" name="link_google_drive" class="form-control" placeholder="Google Drive">
                                @error('link_google_drive') <p class="text-danger text-xs mt-2">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="agreeTerms" name="agree_terms" value="1">
                                <label class="form-check-label" for="agreeTerms">I Already follows all the standard based on  <a class="text-bolder underline" href="https://concise-scale-120.notion.site/Webtoon-Standard-Version-2-df8407ad672f4d568390011b5cfcfb37?pvs=4" target="_blank">SOP Document</a></label>
                                @error('agree_terms')
                                  <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn bg-gradient-dark w-100 my-4">Create Project Record</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-4 col-md-12">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Project Status</h6>
              <p class="text-sm">
                {{$projectData->comic_name}}
                {{$projectData->chapter_number}}
              </p>
            </div>
            <div class="card-body p-3">
                <div class="timeline timeline-one-side">
                    @foreach ($statuses as $status)
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Status">
                                    @if ($status->status_type_id == '1')
                                        <img src="{{ asset('/assets/img/small-logos/Assign.png')}}" alt="assign">
                                    @elseif ($status->status_type_id == '2')
                                        <img src="{{ asset('/assets/img/small-logos/QC.png')}}" alt="team1">
                                    @elseif ($status->status_type_id == '3')
                                        <img src="{{ asset('/assets/img/small-logos/Draft.png')}}" alt="team1">
                                    @elseif ($status->status_type_id == '4')
                                        <img src="{{ asset('/assets/img/small-logos/Revisi.png')}}" alt="team1">
                                    @elseif ($status->status_type_id == '5')
                                        <img src="{{ asset('/assets/img/small-logos/QC.png')}}" alt="team1">
                                    @elseif ($status->status_type_id == '6')
                                        <img src="{{ asset('/assets/img/small-logos/Draft.png')}}" alt="team1">
                                    @elseif ($status->status_type_id == '7')
                                        <img src="{{ asset('/assets/img/small-logos/Revisi.png')}}" alt="team1">
                                    @elseif ($status->status_type_id == '8')
                                        <img src="{{ asset('/assets/img/small-logos/QC.png')}}" alt="team1">
                                    @elseif ($status->status_type_id == '9')
                                        <img src="{{ asset('/assets/img/small-logos/Draft.png')}}" alt="team1">
                                    @elseif ($status->status_type_id == '10')
                                        <img src="{{ asset('/assets/img/small-logos/Revisi.png')}}" alt="team1">
                                    @elseif ($status->status_type_id == '11')
                                        <img src="{{ asset('/assets/img/small-logos/QC.png')}}" alt="team1">
                                    @elseif ($status->status_type_id == '12')
                                        <img src="{{ asset('/assets/img/small-logos/Draft.png')}}" alt="team1">
                                    @elseif ($status->status_type_id == '13')
                                        <img src="{{ asset('/assets/img/small-logos/Done.png')}}" alt="team1">
                                    @endif
                                </a>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">
                                    @if ($status->status_type_id == '1')
                                       Project Asign
                                    @elseif ($status->status_type_id == '2')
                                    QC First Draft
                                    @elseif ($status->status_type_id == '3')
                                    First Draft Submitted
                                    @elseif ($status->status_type_id == '4')
                                    Revision 1
                                    @elseif ($status->status_type_id == '5')
                                    QC Revise 1
                                    @elseif ($status->status_type_id == '6')
                                        Revise 1 Submitted
                                    @elseif ($status->status_type_id == '7')
                                        Revision 2
                                    @elseif ($status->status_type_id == '8')
                                        QC Revise 2
                                    @elseif ($status->status_type_id == '9')
                                        Revise 2 Submitted
                                    @elseif ($status->status_type_id == '10')
                                        Revision 3
                                    @elseif ($status->status_type_id == '11')
                                        QC Revise 3
                                    @elseif ($status->status_type_id == '12')
                                        Revise 3 Submitted
                                    @elseif ($status->status_type_id == '13')
                                        Done
                                    @endif
                                </h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0 text-uppercase">{{ \Carbon\Carbon::parse($status->created_at)->translatedFormat('D, M Y | H:i A') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script>
    document.addEventListener("DOMContentLoaded", function () {
        @foreach ($projectLogs as $log)
            startCountdown("{{ $log->id }}", "{{ $log->timestamp }}");
        @endforeach

        function startCountdown(id, timestamp) {
            const countdownElem = document.getElementById(`countdown-${id}`);
            const endTime = new Date(new Date(timestamp).getTime() + 30 * 60 * 60 * 1000); // Tambah 30 jam untuk deadline

            const daysElem = document.getElementById(`days-${id}`);
            const hoursElem = document.getElementById(`hours-${id}`);
            const minutesElem = document.getElementById(`minutes-${id}`);
            const secondsElem = document.getElementById(`seconds-${id}`);

            function updateCountdown() {
                const now = new Date();
                const remainingTime = endTime - now;

                if (remainingTime <= 0) {
                    clearInterval(interval);
                    countdownElem.innerHTML = "<p>Countdown complete!</p>";
                    return;
                }

                const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
                const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

                daysElem.textContent = String(days).padStart(2, "0");
                hoursElem.textContent = String(hours).padStart(2, "0");
                minutesElem.textContent = String(minutes).padStart(2, "0");
                secondsElem.textContent = String(seconds).padStart(2, "0");
            }

            const interval = setInterval(updateCountdown, 1000);
            updateCountdown();
        }
    });
</script>
@endsection

