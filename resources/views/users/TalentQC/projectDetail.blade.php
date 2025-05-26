@extends('users.TalentQC.layouts.dashboard-app')

@php
    use Carbon\Carbon;
@endphp

@section('content')

  <div class="main-content position-relative bg-gray-100 ">
    <div class="container-fluid">
        <nav aria-label="container-fluid breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-xs"><a href="{{ route('talentqc#index') }}">Home</a></li>
                <li class="breadcrumb-item text-xs"><a href="{{ route('talentqc#projectOverview') }}">Project Overview</a></li>
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
                    @php
                        $lastLog = $projectLogs->last();
                        $startLog = $projectLogs->where('status', 'Project Assign')->first();
                    @endphp

                @if ($projectLogs->last() && $projectLogs->last()->status == 'Done')

                <p class="nav-link mb-0 px-0 py-1 active">
                    @php
                        $totalDuration = $startLog ? Carbon::parse($lastLog->timestamp)->diffForHumans(Carbon::parse($startLog->timestamp), true) : 'N/A';
                    @endphp
                    This Project Completed in <span class="text-bolder">{{ $totalDuration }}</span>
                </p>

                @elseif($projectLogs->isEmpty())
                        <p class="nav-link mb-0 px-0 py-1 active">
                            @php
                                $totalDuration = $startLog ? Carbon::parse($lastLog->timestamp)->diffForHumans(Carbon::parse($startLog->timestamp), true) : 'N/A';
                            @endphp
                            This Project Completed in <span class="text-bolder">{{ $totalDuration }}</span>
                        </p>
                    @else
                        <li class="nav-item">
                            <div class="carousel-item active">
                                <div class="d-flex justify-content-center align-items-center">
                                    <!-- Countdown timer -->
                                    <div id="countdown-{{ $lastLog->id }}" class="d-flex justify-content-center align-items-center">
                                        <div class="text-center me-4">
                                            <h4 id="days-{{ $lastLog->id }}" class="font-weight-bold mb-0">00</h4>
                                            <span class="text-xs text-gray-500">DAY</span>
                                        </div>
                                        <div class="text-center mx-2">
                                            <h4 id="hours-{{ $lastLog->id }}" class="font-weight-bold mb-0">00</h4>
                                            <span class="text-xs text-gray-500">HOUR</span>
                                        </div>
                                        <div class="text-center mx-2">
                                            <h4 id="minutes-{{ $lastLog->id }}" class="font-weight-bold mb-0">00</h4>
                                            <span class="text-xs text-gray-500">MIN</span>
                                        </div>
                                        <div class="text-center ms-2">
                                            <h4 id="seconds-{{ $lastLog->id }}" class="font-weight-bold mb-0">00</h4>
                                            <span class="text-xs text-gray-500">SEC</span>
                                        </div>
                                    </div>
                                    @if ($startLog)
                                        <div class="ms-3">
                                            <span class="text-xs text-gray-500">Started: {{ Carbon::parse($startLog->timestamp)->format('d M Y H:i') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
          </div>
        </div>
      </div>
      <script>
        document.addEventListener("DOMContentLoaded", function () {
    @if ($projectLogs->isNotEmpty())
        @php
            $startLog = $projectLogs->where('status', 'Project Assign')->first();
            $endLog = $projectLogs->where('status', 'Done')->first();
            $currentLog = $projectLogs->last();
        @endphp
        startTimer("{{ $currentLog->id }}", "{{ $startLog ? $startLog->timestamp : '' }}", "{{ $currentLog->status }}");
    @endif

    function startTimer(id, startTimestamp, currentStatus) {
        const timerElem = document.getElementById(`countdown-${id}`);
        const daysElem = document.getElementById(`days-${id}`);
        const hoursElem = document.getElementById(`hours-${id}`);
        const minutesElem = document.getElementById(`minutes-${id}`);
        const secondsElem = document.getElementById(`seconds-${id}`);

        if (!startTimestamp) {
            timerElem.innerHTML = `<p>Project not started yet</p>`;
            return;
        }

        const startTime = new Date(startTimestamp);

        function updateTimer() {
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

            if (elapsedTime > 30 * 60 * 60 * 1000) {
                timerElem.style.color = "red";
            }
        }

        // If status is Done, stop the timer
        if (currentStatus === 'Done') {
            updateTimer(); // Show final time
            return;
        }

        // Otherwise, keep updating the timer
        const interval = setInterval(updateTimer, 1000);
        updateTimer();
    }
});

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
                                <div class="gap-2">
                                    @if(in_array($projectData->status, ['QC First Draft',  'QC Revise 1',  'QC Revise 2',  'QC Revise 3']))
                                    <a class="badge badge-xs bg-primary text-xs font-weight-bold mb-0 text-white hover:bg-secondary" href="#" data-bs-toggle="modal" data-bs-target="#createQcModal">
                                        <i class="fa-solid fa-plus text-white"></i>
                                        <span class="px-2">New QC Records</span>
                                    </a>
                                @elseif(in_array($projectData->status, ['Project Assign', 'Revise 1', 'Revise 2', 'Revise 3', 'Done']))
                                    {{-- Your code for this condition --}}
                                @endif

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
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Updated Date</th>
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
        <div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProjectModalLabel">Submit Project Draft</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="px-3 pt-3">
                        <form action="{{ route('talentqc#storeProjectLog') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $projectData->id }}">
                            <input type="hidden" name="user_id" value="{{ $userData->id }}">

                            <div class="mb-2">
                                <label for="project_stage" class="text-md text-dark">Project Draft Stage</label>
                                <select name="project_stage" class="form-control">
                                    <option value="">Please select Project Stage</option>
                                    <option value="Submit First Draft">Submit First Draft</option>
                                    <option value="Submit Revise 1">Submit Revise 1</option>
                                    <option value="Submit Revise 2">Submit Revise 2</option>
                                    <option value="Submit Revise 3">Submit Revise 3</option>
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
                            <button type="submit" class="btn bg-gradient-dark w-100 my-4">Submit Draft</button>
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
                                    {{-- Add your dynamic content here --}}
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
                @foreach ($reviseRecords as $revise)
                <!-- Modal -->
                <div class="modal fade" id="qcMessageModal-{{ $revise->id }}" tabindex="-1" aria-labelledby="qcMessageModalLabel-{{ $revise->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="qcMessageModalLabel-{{ $revise->id }}">Revise Messages</h5>
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
                                <button type="button" class="btn bg-gradient-dark w-100 my-4" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach


        {{-- Modal Pop Up Repeated --}}
        @foreach ($qcRecords as $qc)
        <!-- Modal -->
        <div class="modal fade" id="qcMessageModal-{{ $qc->id }}" tabindex="-1" aria-labelledby="qcMessageModalLabel-{{ $qc->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="qcMessageModalLabel-{{ $qc->id }}">Message From QC</h5>
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
                        <button type="button" class="btn bg-gradient-dark w-100 my-4" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


        {{-- Modal New QC --}}
        <div class="modal fade {{ $errors->any() ? 'show d-block' : '' }}" id="createQcModal" tabindex="-1" aria-labelledby="createQcModalLabel" aria-hidden="true" style="display: {{ $errors->any() ? 'block' : 'none' }};">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" @if ($checkSop == false ) style="max-width: 1000px;" @else style="max-width: 500px" @endif>
                <div class="modal-content rounded-3 shadow-lg">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" >New QC Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="text-left px-3 pt-3" style="max-height: 70vh; overflow-y: auto;">
                        <!-- QC Type Selection -->
                        <div class="mb-3 text-left">
                            <label for="qc_type_selector" class="form-label">QC Type</label>
                            <select class="form-control" id="qc_type_selector">
                                <option value="">Select QC Type</option>
                                <option value="approve">Approve</option>
                                <option value="approve">Minor Revision</option>
                                <option value="major">Major Revision</option>
                            </select>
                        </div>

                         {{-- SOP FORM --}}
                            <!-- Header Row -->
                            <div class="row border-top border-bottom py-2 mx-3" style="max-width: 1000px;">
                                <div class="col-3 text-center text-uppercase text-black text-xxs font-weight-bolder py-2 border-end">Steps</div>
                                <div class="col-4 text-center text-uppercase text-black text-xxs font-weight-bolder ps-2 py-2 border-end">Standard</div>
                                <div class="col-2 text-center text-uppercase text-black text-xxs font-weight-bolder py-2 border-end">Note</div>
                                <div class="col-3 text-center text-uppercase text-black text-xxs font-weight-bolder py-2">Check List</div>
                            </div>

                            <!-- SOP Items -->
                            @foreach ($sops as $sop)
                                <div class="row border-bottom py-2 mx-3">
                                    <div class="col-3 text-xs text-center d-flex align-items-center justify-content-center border-end">{{ $sop->steps }}</div>
                                    <div class="col-4 text-xs px-4 py-2 border-end">{{ $sop->standard }}</div>
                                    <div class="col-2 text-xs px-3 py-2 text-justify border-end">{{ $sop->note }}</div>
                                    <div class="col-3 d-flex align-items-center justify-content-center p-2">
                                        <div class="btn-group" role="group">
                                            <button type="button"
                                                    class="btn btn-outline-success btn-xs"
                                                    onclick="handleResponse('{{ $sop->id }}', true)"
                                                    id="accept-{{ $sop->id }}">
                                                <i class="fas fa-check me-1"></i> Accept
                                            </button>
                                            <button type="button"
                                                    class="btn btn-outline-danger btn-xs"
                                                    onclick="handleResponse('{{ $sop->id }}', false)"
                                                    id="reject-{{ $sop->id }}">
                                                <i class="fas fa-times me-1"></i> Reject
                                            </button>
                                        </div>
                                        <input type="hidden" name="checklist[{{ $sop->id }}]" id="checklist-{{ $sop->id }}" value="" required>
                                    </div>
                                </div>
                            @endforeach

                        <!-- Approve Form -->
                        <form id="approve_form" action="{{ route('talentqc#storeProjectLog') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                            <hr>
                            <p class="text-xs">This action will be directly upload your works and send in to client.</p>
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $projectData->id }}">
                            <input type="hidden" name="user_id" value="{{ $userData->id }}">

                            <div id="message" class="mb-3 text-left">
                                <label for="qc_message" class="form-label">Message to Talent</label>
                                <textarea class="form-control" id="qc_message" name="qc_message" rows="4" placeholder="Type QC Message"></textarea>
                                <small class="form-text text-muted">Use commas to separate list items.</small>
                            </div>


                            <div class="mb-4">
                                <label for="link_google_drive" class="text-md text-dark">Link Project</label>
                                <input type="text" name="link_google_drive" class="form-control" placeholder="Google Drive">
                                @error('link_google_drive') <p class="text-danger text-xs mt-2">{{ $message }}</p> @enderror
                            </div>

                            @if($checkSop == true)

                            @else



                            <!-- Error Message -->
                            <div class="alert alert-danger alert-dismissible fade show mt-3 text-white" role="alert" id="error-message" style="display: none;">
                                <i class="fas fa-exclamation-triangle me-2 text-white"></i>
                                You can't submit because some SOPs are rejected. Please contact your talent.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            <button type="submit" class="btn bg-gradient-dark w-100 my-4" id="submit-button" disabled>Submit Draft</button>
                        </form>

                        <!-- Major Revision Form -->
                        <div id="major_form" class="" style="display: none;">
                            <div class="modal-header border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label"><strong>Major QC Message:</strong></label>
                                <textarea
                                    class="form-control"
                                    id="majorRevisions"
                                    rows="4"
                                    placeholder="Enter revision points (one per line)"
                                ></textarea>
                                <small class="text-muted">Add each revision point on a new line</small>
                            </div>
                            <div class="px-3 pt-3 " style="max-height: 70vh; overflow-y: auto; display: none;">
                                <p class="text-xs text-left"><strong>Subject:</strong> MAJOR REVISION</p>
                                <p class="text-xs text-left"><strong>Project Name:</strong> {{$projectData->comic_name}}</p>
                                <p class="text-xs text-left"><strong>Talent:</strong> {{$projectData->talent}}</p>
                                <p class="text-xs text-left"><strong>QC:</strong> {{ auth()->user()->name}}</p>
                                <p class="text-xs text-left"><strong>Status:</strong> {{ $projectData->status}}</p>
                                <p class="text-xs text-left"><strong>Project Link:</strong> <a href="{{$projectRecords->last()->link_google_drive ?? 'not found'}}" class="text-primary" target="_blank" style="text-decoration: underline;">Link Project</a></p>

                            </div>
                            <a id="whatsappLink2" href="#" target="_blank" class="btn  w-100 mt-3 text-white" style="background-color: #0c9d08">
                                <i class="fa-brands fa-whatsapp px-2" style="color: #ffffff;"></i>
                                Contact Now!
                            </a>
                        </div>

                        <script>
                        //     document.addEventListener("DOMContentLoaded", function () {
                        //     const whatsappLink = document.getElementById('whatsappLink2');
                        //     whatsappLink.addEventListener("click", function (event) {
                        //         event.preventDefault();
                        //         const subject = "MOJOR REVISION";
                        //         const projectName = "{{$projectData->comic_name}}";
                        //         const talent = "{{$projectData->talent}}";
                        //         const qc = "{{ auth()->user()->name }}";
                        //         const status = "{{ $projectData->status }}";
                        //         const projectLink = "{{ $projectRecords->last()->link_google_drive ?? 'not found'}}";

                        //         // Get and format revision points
                        //         const revisions = document.getElementById('majorRevisions').value
                        //             .split('\n')
                        //             .filter(item => item.trim())
                        //             .map((item, index) => `${index + 1}. ${item.trim()}`)
                        //             .join('\n');

                        //         if (!revisions) {
                        //             alert('Please add at least one revision point');
                        //             return;
                        //         }

                        //         const message = `Subject: *MAJOR REVISION*\nProject Name: *${projectName}*\nTalent: *${talent}*\nQC: ${qc}\nStatus: *${status}*\nProject Link: *${projectLink}*\n\nMajor Revision Points:\n${revisions}`;
                        //         const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;
                        //         window.open(whatsappUrl, '_blank');
                        //     });
                        // });

                        </script>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="modal-backdrop fade show" style="z-index: -1"></div>
            @endif

            <script>
                document
                    .getElementById('qc_type_selector')
                    .addEventListener('change', function () {
                        // Hide all forms first
                        document
                            .querySelectorAll('#approve_form, #minor_form, #major_form')
                            .forEach(form => {
                                form.style.display = 'none';
                            });

                        // Show the selected form
                        const selectedType = this.value;
                        if (selectedType) {
                            document
                                .getElementById(`${selectedType}_form`)
                                .style
                                .display = 'block';
                        }
                    });

                document.addEventListener('DOMContentLoaded', function () {
                    const form = document.querySelector('#createQcModal form');
                    form.addEventListener('submit', function (event) {
                        const hasError = document.querySelector('.text-danger'); // Check for validation error messages
                        if (hasError) {
                            event.preventDefault(); // Prevent form submission
                        }
                    });
                });

                let hasRejected = false;
                let rejectedSops = []; // Array to store rejected SOP details

                function handleResponse(sopId, isAccepted) {
                    const acceptBtn = document.getElementById(`accept-${sopId}`);
                    const rejectBtn = document.getElementById(`reject-${sopId}`);
                    const checklistInput = document.getElementById(`checklist-${sopId}`);
                    const submitButton = document.getElementById('submit-button');
                    const errorMessage = document.getElementById('error-message');

                    // Get the SOP details
                    const stepElement = acceptBtn
                        .closest('.row')
                        .querySelector('.col-3');
                    const standardElement = acceptBtn
                        .closest('.row')
                        .querySelector('.col-4');
                    const step = stepElement
                        .textContent
                        .trim();
                    const standard = standardElement
                        .textContent
                        .trim();

                    if (isAccepted) {
                        // Handle Accept
                        acceptBtn
                            .classList
                            .remove('btn-outline-success');
                        acceptBtn
                            .classList
                            .add('btn-success');
                        rejectBtn
                            .classList
                            .remove('btn-danger');
                        rejectBtn
                            .classList
                            .add('btn-outline-danger');
                        acceptBtn.innerHTML = '<i class="fas fa-check me-1"></i> Accepted';
                        rejectBtn.innerHTML = '<i class="fas fa-times me-1"></i> Reject';
                        checklistInput.value = '1';
                        // Remove from rejected list if previously rejected
                        rejectedSops = rejectedSops.filter(item => item.id !== sopId);
                    } else {
                        // Handle Reject
                        rejectBtn
                            .classList
                            .remove('btn-outline-danger');
                        rejectBtn
                            .classList
                            .add('btn-danger');
                        acceptBtn
                            .classList
                            .remove('btn-success');
                        acceptBtn
                            .classList
                            .add('btn-outline-success');
                        rejectBtn.innerHTML = '<i class="fas fa-times me-1"></i> Rejected';
                        acceptBtn.innerHTML = '<i class="fas fa-check me-1"></i> Accept';
                        checklistInput.value = '0';
                        // Add to rejected list
                        if (!rejectedSops.some(item => item.id === sopId)) {
                            rejectedSops.push({id: sopId, step: step, standard: standard});
                        }
                    }

                    // Check if any SOP is rejected
                    const checklistInputs = document.querySelectorAll('input[name^="checklist"]');
                    hasRejected = Array
                        .from(checklistInputs)
                        .some(input => input.value === '0');

                    // Enable/disable submit button and show/hide error message
                    if (hasRejected) {
                        submitButton.disabled = true;
                        submitButton
                            .classList
                            .add('btn-secondary');
                        submitButton
                            .classList
                            .remove('bg-gradient-dark');
                        errorMessage.style.display = 'block';
                    } else {
                        submitButton.disabled = false;
                        submitButton
                            .classList
                            .remove('btn-secondary');
                        submitButton
                            .classList
                            .add('bg-gradient-dark');
                        errorMessage.style.display = 'none';
                    }
                }

                // WhatsApp sharing functionality
                document.addEventListener("DOMContentLoaded", function () {
                    const whatsappLink = document.getElementById('whatsappLink2');
                    whatsappLink.addEventListener("click", function (event) {
                        event.preventDefault();
                        const subject = "MAJOR REVISION";
                        const projectName = "{{$projectData->comic_name}}";
                        const talent = "{{$projectData->talent}}";
                        const qc = "{{ auth()->user()->name }}";
                        const status = "{{ $projectData->status }}";
                        const projectLink = "{{ $projectRecords->last()->link_google_drive ?? 'not found'}}";

                        // Get and format revision points
                        const revisions = document
                            .getElementById('majorRevisions')
                            .value
                            .split('\n')
                            .filter(item => item.trim())
                            .map((item, index) => `${index + 1}. ${item.trim()}`)
                            .join('\n');

                        // Format rejected SOPs list
                        let rejectedSopsList = '';
                        if (rejectedSops.length > 0) {
                            rejectedSopsList = "\n\nRejected Items:\n" + rejectedSops
                                .map(
                                    (item, index) => `${index + 1}. ${item.step}: ${item.standard}`
                                )
                                .join('\n');
                        }

                        // Check if either revisions or rejected SOPs exist
                        if (!revisions && rejectedSops.length === 0) {
                            alert('Please add revision points or reject some items');
                            return;
                        }

                        const message = `Subject: *MAJOR REVISION*
                Project Name: *${projectName}*
                Talent: *${talent}*
                QC: ${qc}
                Status: *${status}*
                Project Link: *${projectLink}*${rejectedSopsList}${revisions
                                    ? '\n\nMajor Revision Points:\n' + revisions
                                    : ''}`;

                        const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;
                        window.open(whatsappUrl, '_blank');
                    });
                });
            </script>


    </div>

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

