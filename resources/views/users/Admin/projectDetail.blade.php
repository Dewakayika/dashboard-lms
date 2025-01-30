
@extends('users.Admin.layouts.dashboard-app')

@php
    use Carbon\Carbon;
@endphp

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
        {{-- div card--}}

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
                    @if (in_array($projectLogs->last()->status, ['First Draft Submitted', 'Revise 1 Submitted', 'Revise 2 Submitted', 'Revise 3 Submitted']))
                    <span class="nav-link mb-0 px-0 py-1 active" id="overview-tab" data-bs-toggle="pill" href="#overview" role="tab" aria-controls="overview" aria-selected="true">
                        @php
                            $lastLog = $projectLogs->last();
                            $previousLog = $projectLogs->count() > 1 ? $projectLogs->get($projectLogs->count() - 2) : null;
                            $timeDifference = $previousLog ? Carbon::parse($lastLog->timestamp)->diffForHumans(Carbon::parse($previousLog->timestamp), true) : 'N/A';
                        @endphp
                        <span class="text-xs">{{$projectData->status}} in <span class="text-bolder"> {{ $timeDifference }}</span></span>
                        {{-- Button Success --}}
                    </span>
                        <form id="projectDoneForm" action="{{ route('admin#storeProjectDone', $projectData->id ) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="button" class="badge badge-sm bg-gradient-success font-weight-bold mb-0 text-white hover:bg-secondary" style="border: none; text-decoration: none;" onclick="showConfirmationModal()">PROJECT DONE</button>
                        </form>


                    @elseif ($projectLogs->last()->status == 'Done')
                        <p class="nav-link mb-0 px-0 py-1 active">
                            This Project Already <span class="text-bolder">Done</span>
                        </p>
                     @else
                    <li class="nav-item">
                        @php $log = $projectLogs->last(); @endphp
                        <div class="carousel-item active">
                            <div class="d-flex justify-content-center align-items-center">
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
                    @endif
                    </li>
                </ul>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                @if ($projectLogs->isNotEmpty())
                    @php $log = $projectLogs->last(); @endphp
                    startTimer("{{ $log->id }}", "{{ $log->timestamp }}", "{{ $log->status }}");
                @endif

                function startTimer(id, timestamp, status) {
                    const timerElem = document.getElementById(`countdown-${id}`);
                    const daysElem = document.getElementById(`days-${id}`);
                    const hoursElem = document.getElementById(`hours-${id}`);
                    const minutesElem = document.getElementById(`minutes-${id}`);
                    const secondsElem = document.getElementById(`seconds-${id}`);

                    const startStatuses = ["Project Assign", "QC First Draft", "Revise 1", "QC Revise 1",  "Revise 2", "QC Revise 2","Revise 3", "QC Revise 3"];
                    const endStatuses = ["First Draft Submitted", "Revise 1 Submitted", "Revise 2 Submitted", "Revise 3 Submitted"];


                    if (startStatuses.includes(status)) {
                        // Stopwatch mode
                        const startTime = new Date(timestamp);

                        function updateStopwatch() {
                            const now = new Date();
                            const elapsedTime = now - startTime;

                            const days = Math.floor(elapsedTime / (1000 * 60 * 60 * 24));
                            const hours = Math.floor((elapsedTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);

                            daysElem.textContent = String(days).padStart(2, "0");
                            hoursElem.textContent = String(hours).padStart(2, "0");
                            minutesElem.textContent = String(minutes).padStart(2, "0");
                            secondsElem.textContent = String(seconds).padStart(2, "0");

                            // Change color if elapsed time exceeds 30 hours
                            if (elapsedTime > 30 * 60 * 60 * 1000) {
                                timerElem.style.color = "red";
                            }
                        }

                        const interval = setInterval(updateStopwatch, 1000);
                        updateStopwatch();

                    } else if (endStatuses.includes(status)) {
                        // If status is a submission status, show completion message
                        timerElem.innerHTML = `<p>Draft Submitted</p>`;
                    }else {
                        // For any other status
                        timerElem.innerHTML = `<p>Waiting to Apply</p>`;
                    }
                }
            });
            </script>

          </div>
        </div>
      </div>


                            <!-- Modal for confirmation -->
                            <div class="modal fade" id="makeItDone" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog" style="max-width: 400px;">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="confirmationModalLabel">Finish this Project?</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <p>By confirming, you'll be change the project status as <span class="text-bold">DONE</span> This action canot be undo, make sure your action</p>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="modal-btn modal-btn-cancel" data-bs-dismiss="modal">Cancel</button>
                                      <button type="button" class="modal-btn modal-btn-continue" onclick="submitProjectDoneForm()">Make it Done</button>
                                    </div>
                                  </div>
                                </div>
                              </div>

                        <script>
                            function showConfirmationModal() {
                                var modal = new bootstrap.Modal(document.getElementById('makeItDone'));
                                modal.show();
                            }

                            function submitProjectDoneForm() {
                                document.getElementById('projectDoneForm').submit();
                            }
                        </script>


    <div class="row my-4">
        <div class="col w-full mb-4">
            {{-- Tabel Project Information --}}

            <div class="col-12 col-md-12 mb-md-0 mb-4">
                <div class="card h-100">
                  <div class="card-header pb-0 ">
                    <div class="row">
                      <div class="col-md-8 d-flex text-center align-items-center">
                        <h6 class="mb-0 text-center">Project Information</h6>
                      </div>
                    </div>
                  </div>
                  <hr class="">
                  <div class="card-body p-3">
                    <div class="row">
                        <div class="col">
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Project Name:</strong> &nbsp; {{$projectData->comic_name}}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">QC Talent:</strong> &nbsp; {{$projectData->talent_qc}}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Project Assign:</strong> &nbsp; {{ \Carbon\Carbon::parse($projectData->created_at)->translatedFormat('D, M Y') }}</li>
                              </ul>
                        </div>
                        <div class="col">
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Last Update:</strong> &nbsp; {{ \Carbon\Carbon::parse($projectData->update_at)->translatedFormat('D, M Y') }}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Project Finish Date:</strong> &nbsp; {{ $projectData->finish_date ? \Carbon\Carbon::parse($projectData->finish_date)->translatedFormat('D, M Y') : 'Not finish yet' }}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Project File:</strong> &nbsp; <a href="{{$projectData->file}}" class="text-primary" target="_blank" style="text-decoration: underline;">Download File</a></li>
                        </div>
                    </div>

                  </div>
                </div>
              </div>

            {{-- Combined Project Records and QC Records Table --}}
            <div class="col-lg-12 col-md-12 mb-md-0 mb-4 mt-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="w-full mx-auto d-flex align-items-center justify-content-between">
                                <h6 class="text-weight-bolder">Project Records</h6>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project Stage</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Updated Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Panel</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project File</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Qc Message</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($projectRecords->isEmpty() && $qcRecords->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div>
                                                        <img src="{{ asset('/assets/img/ilustration/NoConnection.svg')}}" class="h-auto w-11" style="width: 110px; height: auto;">
                                                        <p class="text-xs">There are no records</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($projectRecords->merge($qcRecords)->sortBy('created_at') as $record)
                                            <tr>
                                                <td class="align-middle text-sm">
                                                    <span class="text-sm px-3 font-weight-bold">{{ $record->project_stage ?? $record->qc_stage }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-sm px-1 font-weight-bold">{{ \Carbon\Carbon::parse($record->created_at)->translatedFormat('D, M Y') }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-sm px-1 font-weight-bold">{{ $record->number_of_panel ?? '-'}}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if ($record->link_google_drive == null)
                                                        <span class="text-sm px-1 font-weight-bold">-</span>
                                                    @else
                                                        <a href="{{ $record->link_google_drive }}" class="badge badge-sm bg-gradient-info font-weight-bold mb-0 text-white hover:bg-secondary" target="_blank" style="border: none; text-decoration: none;">Project File</a>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if ($record->qc_message == null)
                                                        <span class="text-sm px-1 font-weight-bold">-</span>
                                                    @else
                                                        <button type="button" class="badge badge-sm bg-gradient-success font-weight-bold mb-0 text-white hover:bg-secondary" data-bs-toggle="modal" data-bs-target="#qcMessageModal-{{ $record->id }}" style="border: none; text-decoration: none;">Open QC Message</button>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if (in_array($record->project_stage, ['First Draft', 'Revise 1', 'Revise 2', 'Revise 3']))
                                                        <a href="{{ $record->link_google_drive }}" class="badge badge-sm bg-gradient-warning font-weight-bold mb-0 text-white hover:bg-secondary" target="_blank" style="border: none; text-decoration: none;">Review Project</a>
                                                    @elseif (in_array($record->project_stage, ['First Draft Submitted', 'Revise 1 Submitted', 'Revis 2 Submitted', 'Revise 3 Submitted']))
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#shareToWhatsAppModal" class="badge badge-sm bg-gradient-info font-weight-bold mb-0 text-white hover:bg-secondary" target="_blank" style="border: none; text-decoration: none;">Share Project</a>
                                                    @else
                                                        <a class="badge badge-sm bg-gradient-danger font-weight-bold mb-0 text-white hover:bg-secondaryy" href="#" data-bs-toggle="modal" data-bs-target="#createProjectModal">
                                                            <span class="px-2">Make it done</span>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        {{-- Modal New Records --}}
        <div class="modal fade" id="projectReviseModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProjectModalLabel">Project Revise</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="px-3 pt-3">
                        <form action="{{ route('admin#storeProjectRevise') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $projectData->id }}">
                            <input type="hidden" name="user_id" value="{{ $adminData->id }}">

                            {{-- <div class="mb-2">
                                <label for="revise_stage" class="text-md text-dark">Revise Stage</label>
                                <select name="revise_stage" class="form-control">
                                    <option value="">Please select Project revise stage</option>
                                    <option value="Revise 1">Revise 1</option>
                                    <option value="Revise 2">Revise 2</option>
                                    <option value="Revise 3">Revise 3</option>
                                </select>
                                @error('revise_stage') <p class="text-danger text-xs mt-2">{{ $message }}</p> @enderror
                            </div> --}}
                            {{-- <div class="mb-2">
                                <label for="number_of_panel" class="text-md text-dark">Total Number Of Panel</label>
                                <input type="number" name="number_of_panel" class="form-control" placeholder="Example 50">
                                @error('number_of_panel') <p class="text-danger text-xs mt-2">{{ $message }}</p> @enderror
                            </div> --}}
                            <div class="mb-3 text-left">
                                <label for="revise_message" class="form-label">Revise Message</label>
                                <textarea class="form-control" id="revise_message" name="revise_message" rows="4" required placeholder="Type Revise Message"></textarea>
                                <small class="form-text text-muted">Use commas to separate list items.</small>
                            </div>
                            <button type="submit" class="btn bg-gradient-dark w-100 my-4">Submit Revise</button>
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

        {{-- Modal Share to WhatsApp --}}
        <div class="modal fade" id="shareToWhatsAppModal" tabindex="-1" aria-labelledby="shareToWhatsAppModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
            <div class="modal-content rounded-3 shadow-lg">
                <div class="modal-header border-0">
                <h5 class="modal-title" id="shareToWhatsAppModalLabel">Share Project to WhatsApp</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="px-3 pt-3" style="max-height: 70vh; overflow-y: auto;">
                    <p class="text-xs text-left"><strong>Project Name:</strong> {{$projectData->comic_name}}</p>
                    <p class="text-xs text-left"><strong>Talent:</strong> {{$projectData->talent}}</p>
                    <p class="text-xs text-left"><strong>QC:</strong> {{ auth()->user()->name}}</p>
                    <p class="text-xs text-left"><strong>Status:</strong> {{ $projectData->status}}</p>
                    <p class="text-xs text-left"><strong>Project Link:</strong> <a href="{{$projectRecords->last()->link_google_drive ?? 'not found'}}" class="text-primary" target="_blank" style="text-decoration: underline;">Link Project</a></p>
                    <a id="whatsappLink" href="#" target="_blank" class="btn btn-success w-100 mt-3">
                        <i class="fa-brands fa-whatsapp px-2" style="color: #ffffff;"></i>
                        Share to WhatsApp
                    </a>
                </div>
            </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const whatsappLink = document.getElementById('whatsappLink');
                whatsappLink.addEventListener("click", function (event) {
                    event.preventDefault();
                    const projectName = "{{$projectData->comic_name}}";
                    const talent = "{{$projectData->talent}}";
                    const qc = "{{ auth()->user()->name }}";
                    const status = "{{ $projectData->status }}";
                    const projectLink = "{{ $projectRecords->last()->link_google_drive ?? 'not found'}}";
                    const message = `Project Name: ${projectName}\nTalent: ${talent}\nQC: ${qc}\nStatus: ${status}\nProject Link: ${projectLink}`;
                    const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;
                    window.open(whatsappUrl, '_blank');
                });
            });
        </script>


            <div class="col-lg-12 col-md-12 mb-md-0 mb-4 mt-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="w-full mx-auto d-flex align-items-center justify-content-between">
                                <h6 class="text-weight-bolder">Project Revision</h6>
                                <div class="gap-2">
                                    <a class="badge badge-xs bg-primary text-xs font-weight-bold mb-0 text-white hover:bg-secondary" href="#" data-bs-toggle="modal" data-bs-target="#projectReviseModal">
                                        <i class="fa-solid fa-plus text-white"></i>
                                        <span class="px-2">Add Revision</span>
                                    </a>
                                </div>
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
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Tabel Content --}}
                                    @if ($reviseRecords->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div>
                                                        <img src="{{ asset('/assets/img/ilustration/NoConnection.svg')}}" class="h-auto w-11" style="width: 110px; height: auto;">
                                                        <p class="text-xs">There are no records</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($reviseRecords as $record)
                                            <tr>
                                                <td class="align-middle text-sm">
                                                    <span class="text-sm px-3 font-weight-bold">{{ $record->revise_stage }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-sm px-1 font-weight-bold">{{ \Carbon\Carbon::parse($record->created_at)->translatedFormat('D, M Y') }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-sm px-1 font-weight-bold">{{ $record->number_of_panel ?? '-'}}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <button type="button" class="badge badge-sm bg-gradient-success font-weight-bold mb-0 text-white hover:bg-secondary" data-bs-toggle="modal" data-bs-target="#qcMessageModal-{{ $record->id }}" style="border: none; text-decoration: none;">Open Message</button>
                                                </td>
                                            </tr>

                                            {{-- Modal for each record --}}
                                            <div class="modal fade" id="qcMessageModal-{{ $record->id }}" tabindex="-1" aria-labelledby="qcMessageModalLabel-{{ $record->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
                                                    <div class="modal-content rounded-3 shadow-lg">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title" id="qcMessageModalLabel-{{ $record->id }}">Share Message to WhatsApp</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="px-3 pt-3" style="max-height: 70vh; overflow-y: auto;">
                                                            <p class="text-base text-left"><strong>Project Stage:</strong> {{ $record->revise_stage }}</p>

                                                            <p class="text-base text-left"><strong>Revise Note:</strong> <br>
                                                                @foreach(explode(',', $record->revise_message) as $message)
                                                                <li class="text-base">{{ $message }}</li>
                                                                @endforeach
                                                            </p>
                                                            <a id="whatsappLink-{{ $record->id }}" href="#" target="_blank" class="btn btn-success w-100 mt-3" style="background-color: #0c9d08 ">
                                                                <i class="fa-brands fa-whatsapp px-2" style="color: #ffffff; "></i>
                                                                Share to WhatsApp
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- WhatsApp Link Script --}}
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function () {
                                                    const whatsappLink = document.getElementById('whatsappLink-{{ $record->id }}');
                                                    whatsappLink.addEventListener("click", function (event) {
                                                        event.preventDefault();
                                                        const projectName = "{{$projectData->comic_name}}";
                                                        const Chapter = "{{$projectData->chapter_number}}";
                                                        const talent = "{{$projectData->talent}}";
                                                        const status = "{{ $projectData->status }}";
                                                        const message =
                                                            `*PROJECT REVISION* \n` +
                                                            '\n' +
                                                            `Project Name: *${projectName} Eps: ${Chapter}\n*` +
                                                            `Talent: ${talent}\n` +
                                                            `Status: ${status}\n` +
                                                            '\n' +
                                                            `Revise Note: \n{{ $record->revise_message }}\n`; // Fix concatenation here

                                                        const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;
                                                        window.open(whatsappUrl, '_blank');
                                                    });
                                                });
                                            </script>


                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>



        {{-- Modal Pop Up Repeated --}}
        {{-- @foreach ($reviseRecords as $revise)
        <!-- Modal -->
        <div class="modal fade" id="qcMessageModal-{{ $revise->id }}" tabindex="-1" aria-labelledby="qcMessageModalLabel-{{ $revise->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 700px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="qcMessageModalLabel-{{ $revise->id }}">Revise Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="text-left mt-2">
                        <ul>
                            @foreach(explode(',', $revise->revise_message) as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button text-white" class="btn bg-gradient-dark w-100 my-4" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach --}}

                {{-- Modal Pop Up Repeated --}}
                @foreach ($qcRecords as $qc)
                <!-- Modal -->
                <div class="modal fade" id="qcMessageModal-{{ $qc->id }}" tabindex="-1" aria-labelledby="qcMessageModalLabel-{{ $qc->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width: 700px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="qcMessageModalLabel-{{ $qc->id }}">QC Message</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="text-left mt-2">
                                <ul>
                                    @foreach(explode(',', $qc->qc_message) as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button text-white" class="btn bg-gradient-dark w-100 my-4" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach




        {{-- Status --}}
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



@endsection

