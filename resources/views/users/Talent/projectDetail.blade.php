
@extends('users.Talent.layouts.dashboard-app')

@php
    use Carbon\Carbon;
@endphp
@section('content')

  <div class="main-content position-relative bg-gray-100 ">
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
          </div>
        </div>
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

      {{-- Tabel --}}
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

        {{-- Tabel Project Records --}}
        <div class="col-lg-12 col-md-12 mb-md-0 mb-4 mt-4">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                    <div class="w-full mx-auto d-flex align-items-center justify-content-between">
                        <h6 class="text-weight-bolder">Project Records</h6>
                        <div class="gap-2">
                            {{-- <a class="badge badge-xs bg-secondary text-xs font-weight-bold mb-0 text-white hover:bg-secondary" href="#" data-bs-toggle="modal" data-bs-target="#createProjectSOPModal">
                                <span class="px-2">SOP Check</span>
                            </a> --}}
                            <a class="badge badge-xs bg-primary text-xs font-weight-bold mb-0 text-white hover:bg-secondary"
                            href="#"
                            data-bs-toggle="modal"
                            data-bs-target="#createProjectSOPModal">
                             <i class="fa-solid fa-plus text-white"></i>
                             <span class="px-2">New Records</span>
                         </a>

                         <div class="modal fade {{ $errors->any() ? 'show d-block' : '' }}" id="createProjectSOPModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true"  style="display: {{ $errors->any() ? 'block' : 'none' }};">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" @if ($checkSop == false) style="max-width: 1000px" @else style="max-width: 400px" @endif >
                                <div class="modal-content rounded-3 shadow-lg">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title" id="createProjectModalLabel">Create New Project Records</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div> <!-- Fixed: Properly closed the modal-header -->
                                    <div class="modal-body px-3 pt-3" style="max-height: 70vh; overflow-y: auto;">
                                        <form action="{{ route('talent#projectRecods') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <!-- Hidden Inputs -->
                                            <input type="hidden" name="project_id" value="{{ $projectData->id }}">
                                            <input type="hidden" name="user_id" value="{{ $userData->id }}">

                                            <!-- Google Drive Link Input -->
                                            <div class="text-left mb-4" style="text-align: start;">
                                                <label for="link_google_drive" class="text-md text-dark">Link Project</label>
                                                <input type="text" name="link_google_drive" class="form-control" placeholder="Google Drive" value="{{ old('link_google_drive') }}">
                                                @error('link_google_drive')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            @if($checkSop == true)

                                            @else
                                            <!-- SOP Checklist -->
                                            <div class="row border-top border-bottom py-2 mx-3">

                                                <div class="col-5 text-center text-uppercase text-black text-xxs font-weight-bolder ps-2 py-2 border-end">Standard</div>
                                                <div class="col-4 text-center text-uppercase text-black text-xxs font-weight-bolder py-2 border-end">Note</div>
                                                <div class="col-3 text-center text-uppercase text-black text-xxs font-weight-bolder py-2">Check List</div>
                                            </div>

                                            @foreach ($sops as $sop)
                                            <div class="row border-bottom py-2 mx-3">
                                                <div class="col-5 text-xs text-center d-flex align-items-center justify-content-center border-end text-bolder">{{ $sop->sop_formula }}</div>
                                                <div class="col-4 text-xs px-3 py-2 text-justify border-end">{{ $sop->note }}</div>
                                                <div class="col-3 d-flex align-items-center justify-content-center p-2">
                                                    <div class="form-check">
                                                        <input type="checkbox"
                                                            name="checklist[{{ $sop->id }}]"
                                                            value="1"
                                                            required
                                                            class="btn-check"
                                                            id="btn-check-{{ $sop->id }}"
                                                            autocomplete="off">
                                                        <label class="btn btn-outline-success btn-sm" for="btn-check-{{ $sop->id }}">
                                                            Not Done
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach


                                            <!-- Agree to Terms -->
                                            <div class="form-check mb-3 mt-3" style="text-align: start">
                                                <input type="checkbox" class="form-check-input" id="agreeTerms" name="agree_terms" value="1">
                                                <label class="form-check-label" for="agreeTerms">
                                                    I already follow all the standards based on
                                                    <a class="text-bolder underline" href="https://concise-scale-120.notion.site/Webtoon-Standard-Version-2-df8407ad672f4d568390011b5cfcfb37?pvs=4" target="_blank">SOP Document</a>
                                                </label>
                                                @error('agree_terms')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>


                                            @endif
                                            <!-- Submit Button -->
                                            <button type="submit" class="btn bg-gradient-dark w-100 my-4">Create Project Record</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="modal-backdrop fade show"></div>
                        @endif

                        <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                const checkboxes = document.querySelectorAll('.btn-check');

                                checkboxes.forEach(checkbox => {
                                    checkbox.addEventListener('change', function() {
                                        const label = this.nextElementSibling;
                                        if (this.checked) {
                                            label.classList.remove('btn-outline-success');
                                            label.classList.add('btn-success');
                                        } else {
                                            label.classList.add('btn-outline-success');
                                            label.classList.remove('btn-success');
                                        }
                                    });
                                });
                            });

                            document.addEventListener('DOMContentLoaded', function() {
                            const checkboxes = document.querySelectorAll('.btn-check');

                            checkboxes.forEach(checkbox => {
                                checkbox.addEventListener('change', function() {
                                    const label = this.nextElementSibling;
                                    if (this.checked) {
                                        label.classList.remove('btn-outline-success');
                                        label.classList.add('btn-success');
                                        label.textContent = 'Done ✓';
                                    } else {
                                        label.classList.add('btn-outline-success');
                                        label.classList.remove('btn-success');
                                        label.textContent = 'Not Done';
                                    }
                                });
                            });
                        });
                        </script>


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
              <div class="card-body px-0 pb-2">
                <div class="table-responsive">

                </div>
              </div>
            </div>
          </div>


          <div class="col-lg-12 col-md-12 mb-md-0 mb-4 mt-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="w-full mx-auto d-flex align-items-center justify-content-between">
                            <h6 class="text-weight-bolder">Project Revision</h6>
                            <div class="gap-2">
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
                                        <button type="button" class="btn bg-gradient-dark w-100 my-4" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach


        @if($projectData->status == 'Done' && $projectComplexity->isEmpty())
            <div class="position-fixed top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.5); z-index: 1040;">
                <div class="card position-absolute blur shadow-blur" style="top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; z-index: 1050;">
                    <div class="card-header border-bottom pb-0 rounded">
                        <div class=" justify-content-between align-items-center text-center">
                            <h5 class="mb-0">Congratulations!</h5>
                            <p class="text-md mt-2">You already finish this project, Let's give the review for project and your QC Agent!</p>
                            <button type="button" class="btn-close" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="card-body bg-white p-3 rounded">
                        <form action="{{ route('talent#storeReview') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $projectData->id }}">
                            <input type="hidden" name="user_id" value="{{ $userData->id }}">

                            <div class="text-left mb-4" style="text-align: start;">
                                <label for="number_of_panel" class="text-md text-dark">Number of Final Panel</label>
                                <input type="text" name="number_of_panel" class="form-control" placeholder="Example 50" >
                                @error('number_of_panel')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <hr>
                            <div class="mb-2 text-left" style="text-align: start;">
                                <label for="complexity" class="text-md text-dark">Project Complexity</label>
                                <select name="complexity" class="form-control">
                                    <option value="">Please select project complexity</option>
                                    <option value="1">Very Easy</option>
                                    <option value="2">Easy</option>
                                    <option value="3">Medium</option>
                                    <option value="4">Hard</option>
                                    <option value="5">Very Hard</option>

                                </select>
                                @error('complexity')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <hr>
                            <div class="mb-2 text-left" style="text-align: start;">
                                <label for="qc_reviews" class="text-md text-dark">QC Review</label>
                                <select name="qc_reviews" class="form-control">
                                    <option value="">Please select Qc review</option>
                                    <option value="1">Needs Improvement</option>
                                    <option value="2">Developing</option>
                                    <option value="3">Competent</option>
                                    <option value="4">Outstanding</option>
                                    <option value="5">Exceptional</option>

                                </select>
                                @error('complexity')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="text-left mb-4" style="text-align: start;">
                                <label for="message" class="text-md text-dark">Message for QC</label>
                                <textarea type="text" name="message" class="form-control" placeholder="Your message"></textarea>
                                @error('message')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn bg-gradient-dark w-100 my-4">Submit Project Review</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <!-- Your content when project complexity exists -->
        @endif




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

