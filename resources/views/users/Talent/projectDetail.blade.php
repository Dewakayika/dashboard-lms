
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
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
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
                          <td class="align-middle text-center text-sm">
                            <span class="text-sm px-1 font-weight-bold">{{$projectData->talent_qc}}</span>
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
                                <span class="badge badge-sm bg-gradient-info">{{$projectData->status}}</span>
                            @elseif ($projectData->status == 'QC First Draft' && 'QC Revise 1' && 'QC Revise 2' && 'QC Revise 3')
                                <span class="badge badge-sm .bg-gradient-attentions">{{$projectData->status}}</span>
                            @elseif ($projectData->status == 'First Draft Submitted' && 'Revise 1 Submitted' && 'Revise 2 Submitted' && 'Revise 3 Submitted')
                                <span class="badge badge-sm .bg-gradient-warning">{{$projectData->status}}</span>
                            @elseif ($projectData->status == 'Revision 1' && 'Revision 2' && 'Revision 3')
                                <span class="badge badge-sm .bg-gradient-danger">{{$projectData->status}}</span>
                            @elseif ($projectData->status == 'Done')
                                <span class="badge badge-sm .bg-gradient-success">{{$projectData->status}}</span>
                            @else
                                <span class="badge badge-sm .bg-gradient-danger">{{$projectData->status ?? 'undefine'}}</span>
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
        <div class="col-lg-4 col-md-6">
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
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                                    @if ($status->status_type_id == '1')
                                        <img src="{{ asset('/assets/img/small-logos/Assign.png')}}" alt="team1">
                                    @endif
                                </a>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">
                                    @if ($status->status_type_id == '1')
                                        Project Assign
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

