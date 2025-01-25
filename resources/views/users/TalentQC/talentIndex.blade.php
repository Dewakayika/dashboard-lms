@extends('users.TalentQC.layouts.dashboard-app')

@section('content')

<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body bg-white bg-primary p-3 border-radius-xl">
          <div class="row">
            <div class="col-8">
                <div class="icon icon-shape bg-red-200 shadow opacity-95 text-center border-radius-section">
                    <i class="fa-regular fa-file fa-lg" style="color: #e64322;" ></i>
                  </div>
              <div class="numbers mt-4">
                    <h3 class="font-weight-bolder text-gray-900 mb-0">
                    {{$onGoingProject}}
                    </h3>
                <p class="text-sm mb-0 text-black text-capitalize font-weight-light">On Going Project</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body bg-white bg-secondary p-3 border-radius-xl">
            <div class="row">
              <div class="col-8">
                <div class="icon icon-shape bg-yellow-200 shadow opacity-95 text-center border-radius-section">
                    <i class="fa-regular fa-pen-to-square" style="color: #bca91d; "></i>
                  </div>
                <div class="numbers mt-4">
                  <h3 class="font-weight-bolder text-gray-900 mb-0">
                      {{$projectQc}}
                    </h3>
                  <p class="text-sm mb-0 text-capitalize text-black font-weight-light">Project Qc</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body bg-white bg-secondary p-3 border-radius-xl">
          <div class="row">
            <div class="col-8">
                <div class="icon icon-shape bg-blue-200 shadow opacity-95 text-center border-radius-section">
                    <i class="fa-regular fa-rectangle-list fa-lg" style="color: #2e86c1 "></i>
                  </div>
              <div class="numbers mt-4">
                <h3 class="font-weight-bolder text-gray-900 mb-0">
                    {{$projectThisMonth}}
                  </h3>
                <p class="text-sm mb-0 text-capitalize text-black font-weight-light">Project This Month</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body bg-white bg-secondary p-3 border-radius-xl">
            <div class="row">
              <div class="col-8">
                <div class="icon icon-shape bg-green-200 shadow opacity-95 text-center border-radius-section">
                    <i class="fa-regular fa-file-lines" style="color: #1ea079;"></i>
                  </div>
                <div class="numbers mt-4">
                  <h3 class="font-weight-bolder text-gray-900 mb-0">
                      {{$AllProject}}
                    </h3>
                  <p class="text-sm mb-0 text-capitalize text-black font-weight-light">Total Project</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    {{-- <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body bg-white p-0 border-radius-xl">
                @if ($projectLogs->isempty())
                    <div class="text-center d-flex align-items-center justify-content-center">
                        <div class="">
                            <img src="{{ asset('/assets/img/ilustration/NoConnection.svg')}}" class="h-auto w-11" style="width: 110px; height: auto;">
                            <p class="text-xs">There's no timestamp tracked</p>
                        </div>
                    </div>
                @else
                <div>
                    <!-- Carousel for countdown -->
                    <div id="countdownCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($projectLogs as $key => $log)
                                <div class="carousel-item @if ($key === 0) active @endif">
                                    <div>
                                        <h6 class="text-uppercase text-sm font-weight-bolder text-black text-left">COUNTDOWN</h6>
                                        <p class="text-sm font-weight-normal text-gray-700">Submission for <span class="text-bolder"> {{ $log->project->comic_name ?? 'Unknown Project' }} Chapter {{$log->project->chapter_number}}</span></p>
                                    </div>
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
                        </div>

                        <!-- Dot Indicators for Carousel -->
                        <div class="carousel-indicators ">
                            @foreach ($projectLogs as $key => $log)
                                <button type="button" data-bs-target="#countdownCarousel" data-bs-slide-to="{{ $key }}" class="@if ($key === 0) active @endif" style="background-color: red;"></button>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div> --}}
  </div>


  <div class="row my-4">
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
      <div class="card h-100" >
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h6>Project Offer</h6>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive">
            @if ($projects->isEmpty())
                <div class="text-center d-flex align-items-center justify-content-center">
                    <div class="mb-3">
                        <img src="{{ asset('/assets/img/ilustration/NoDocuments.svg')}}" class="h-11 w-11">
                        <p class="text-xs">There's no Project Offer yet</p>
                    </div>
                </div>
            @else


            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comic Name</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Episode Number</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Talent QC</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project Complexity</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($projects as $project )
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{asset('/assets/img/small-logos/webtoon.png')}}" class="avatar avatar-sm me-3" alt="xd">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{$project->comic_name}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-sm font-weight-bold">{{$project->chapter_number}}</span>
                  </td>
                  <td>
                    <div class="avatar-group mt-2 d-flex">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-sm px-1 font-weight-bold">{{$project->talent_qc}}</p>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-sm text-center font-weight-bold"> - </span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-warning">{{$project->status}}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <div class="bg-gradient-succes">
                      <form action="{{ route('talentqc#applyProject', $project->id) }}" method="POST" id="applyForm-{{ $project->id }}">
                        @csrf
                        <button type="button" class="badge badge-sm text-white bg-gradient-success" style="border: none" onclick="confirmApply({{ $project->id }})">Apply</button>
                      </form>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <ul class="pagination justify-content-center">
                @if ($projects->onFirstPage())
                    <li class="page-item disabled px-1">
                        <span class="page-link"><i class="fa-solid fa-backward"></i></span>
                    </li>
                @else
                    <li class="page-item px-1">
                        <a class="page-link" href="{{ $projects->previousPageUrl() }}" aria-label="Previous"><i class="fa-solid fa-backward"></i></a>
                    </li>
                @endif

                @foreach ($projects->getUrlRange(1, $projects->lastPage()) as $page => $url)
                    <li class="page-item px-1 {{ $page == $projects->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($projects->hasMorePages())
                    <li class="page-item px-1">
                        <a class="page-link" href="{{ $projects->nextPageUrl() }}" aria-label="Next"><i class="fa-solid fa-forward"></i></a>
                    </li>
                @else
                    <li class="page-item disabled px-1">
                        <span class="page-link"><i class="fa-solid fa-forward"></i></span>
                    </li>
                @endif
            </ul>
            @endif
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for confirmation -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 400px">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmationModalLabel">Apply Project?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>By confirming, you'll be assigned this project. You are responsible for completing and submitting it on time, following all provided guidelines and rules.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="modal-btn modal-btn-cancel" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="modal-btn modal-btn-continue" id="confirmApplyBtn">Continue</button>
            </div>
          </div>
        </div>
      </div>
    <div class="col-lg-4 col-md-6">
        <div class="card h-100">

            <div class="card-header pb-0">
                <h6>Project On Going</h6>
            </div>

            <div class="card-body">
                <div class="min-height-160">
                    <canvas id="radiarChart" height="200px" width="80px"></canvas>
                </div>
                {{-- <div id="projectCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($groupedProjectStatuses as $projectId => $statuses)
                            <div class="carousel-item @if ($loop->first) active @endif">
                                <div class="card-header pb-0">
                                    <h6>Project Status</h6>
                                    <p class="text-sm">
                                        {{ $statuses->first()->project->comic_name ?? 'Unknown Project' }} <span class="font-weight-bold">{{ $statuses->first()->project->chapter_number ?? 'Unknown Project' }}</span>
                                    </p>
                                </div>
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
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#projectCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#projectCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div> --}}
            </div>

        </div>
    </div>
  </div>


  <div class="row">
    <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
      <div class="card mb-4 h-100">
        <div class="card-header pb-0">
          <h6>Projects Overview</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            @if ($projectOverview->isEmpty())
            <div class="text-center d-flex align-items-center justify-content-center">
                <div class="mb-3">
                    <img src="{{ asset('/assets/img/ilustration/NoDocuments.svg')}}" class="h-11 w-11">
                    <p class="text-xs">There's no Project Offer yet</p>
                </div>
            </div>
            @else
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comic Name</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Episode Number</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Talent Qc</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Panel</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($projectOverview as $projects )
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                        <div>
                          <img src="{{asset('/assets/img/small-logos/webtoon.png')}}" class="avatar avatar-sm me-3" alt="xd">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{$projects->comic_name}}</h6>
                        </div>
                      </div>
                  </td>
                  <td class="align-middle text-center text-sm" >
                    <span class="text-sm font-weight-bold">{{$projects->chapter_number}}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-sm px-1 font-weight-bold">{{$projects->talent_qc}}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-sm px-1 font-weight-bold">{{$projects->number_of_panel}}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    @if ($projects->status == 'Waiting Talent')
                        <span class="badge badge-sm bg-gradient-warning">{{$projects->status}}</span>
                    @elseif ($projects->status == 'Project Assign')
                        <span class="badge badge-sm bg-gradient-info">{{$projects->status}}</span>
                    @elseif (in_array($projects->status, ['QC First Draft', 'QC Revise 1', 'QC Revise 2', 'QC Revise 3']))
                        <span class="badge badge-sm bg-gradient-warning">{{$projects->status}}</span>
                    @elseif (in_array($projects->status, ['First Draft Submitted', 'Revise 1 Submitted', 'Revise 2 Submitted', 'Revise 3 Submitted']))
                        <span class="badge badge-sm bg-gradient-success">{{$projects->status}}</span>
                    @elseif (in_array($projects->status, ['Revision 1', 'Revision 2', 'Revision 3']))
                        <span class="badge badge-sm bg-gradient-danger">{{$projects->status}}</span>
                    @elseif ($projects->status == 'Done')
                        <span class="badge badge-sm bg-gradient-success">{{$projects->status}}</span>
                    @else
                        <span class="badge badge-sm bg-gradient-danger">{{$projects->status ?? 'undefined'}}</span>
                    @endif
                  </td>
                  <td class="align-middle">
                    <a href="{{ route('talentqc#ownprojectDetail', $projects->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View Details">
                        Detail
                    </a>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
            @endif
          </div>

        </div>
      </div>
    </div>

    <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
        <div class="card mb-4 h-100">
            <div class="card-header pb-0">
                <h6>Projects QC Overview</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    @if ($projectQcOverview->isEmpty())
                    <div class="text-center d-flex align-items-center justify-content-center">
                        <div class="mb-3">
                            <img src="{{ asset('/assets/img/ilustration/NoDocuments.svg')}}" class="h-11 w-11">
                            <p class="text-xs">There's no Project Need to Qc yet</p>
                        </div>
                    </div>
                @else
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comic Name</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Episode Number</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Talent</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Panel</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($projectQcOverview->where('status', '!=', 'Done')->isEmpty())
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
                            @foreach ($projectQcOverview->sortByDesc('created_at') as $projectQcOverview)
                                @if ($projectQcOverview->status != 'Done')
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{asset('/assets/img/small-logos/webtoon.png')}}" class="avatar avatar-sm me-3" alt="xd">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$projectQcOverview->comic_name}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-sm font-weight-bold">{{$projectQcOverview->chapter_number}}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-sm px-1 font-weight-bold">{{$projectQcOverview->talent ?? 'Still Waiting'}}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-sm px-1 font-weight-bold">{{$projectQcOverview->number_of_panel}}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($projectQcOverview->status == 'Waiting Talent')
                                                <span class="badge badge-sm bg-gradient-warning">{{$projectQcOverview->status}}</span>
                                            @elseif ($projectQcOverview->status == 'Project Assign')
                                                <span class="badge badge-sm bg-gradient-info">{{$projectQcOverview->status}}</span>
                                            @elseif (in_array($projectQcOverview->status, ['QC First Draft', 'QC Revise 1', 'QC Revise 2', 'QC Revise 3']))
                                                <span class="badge badge-sm bg-gradient-warning">{{$projectQcOverview->status}}</span>
                                            @elseif (in_array($projectQcOverview->status, ['First Draft Submitted', 'Revise 1 Submitted', 'Revise 2 Submitted', 'Revise 3 Submitted']))
                                                <span class="badge badge-sm bg-gradient-success">{{$projectQcOverview->status}}</span>
                                            @elseif (in_array($projectQcOverview->status, ['Revision 1', 'Revision 2', 'Revision 3']))
                                                <span class="badge badge-sm bg-gradient-danger">{{$projectQcOverview->status}}</span>
                                            @elseif ($projectQcOverview->status == 'Done')
                                                <span class="badge badge-sm bg-gradient-success">{{$projectQcOverview->status}}</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-danger">{{$projectQcOverview->status ?? 'undefined'}}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @if ($projectQcOverview->status != 'Waiting Talent')
                                                <a href="{{ route('talentqc#projectDetail', $projectQcOverview->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View Details">
                                                    Detail
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>

    </div>
  </div>
@endsection
@push('dashboard')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            @foreach ($projectLogs as $log)
                startCountdown("{{ $log->id }}", "{{ $log->timestamp }}");
            @endforeach

            function startCountdown(id, timestamp) {
                const countdownElem = document.getElementById(`countdown-${id}`);
                const endTime = new Date(new Date(timestamp).getTime() + 30 * 60 * 60 * 1000); // Tambah 30 jam

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

    <script>
    function confirmApply(projectId) {
      // Set the form action dynamically
      document.getElementById('confirmApplyBtn').onclick = function() {
        document.getElementById('applyForm-' + projectId).submit();
      };
      // Show the confirmation modal
      var myModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
      myModal.show();
    }
  </script>

<script>
    const ctx2 = document.getElementById('radiarChart').getContext('2d');

    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Project Assign', 'Project QC', 'Project Draft', 'Project Revision', 'Project Completed'],
            datasets: [{
                label: 'Project Status',
                data: [{{$projectAssign}}, {{$projectQc}}, {{$projectDraft}}, {{$projectRevise}}, {{$projectCompleted}}],
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
            responsive: true,
            maintainAspectRatio: true,
            aspectRatio: 1.4,  // Adjusted for better fit with bottom legend
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                },
                legend: {
                    position: 'bottom', // Changed from 'right' to 'bottom'
                    labels: {
                        boxWidth: 12,
                        padding: 10,
                        usePointStyle: false, // Makes legend items circular
                        pointStyle: 'circle'
                    },
                    align: 'center', // Centers the legend items
                    maxWidth: 400 // Controls the maximum width of the legend
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 20 // Added more bottom padding for legend
                }
            },
            cutout: '50%'
        }
    });
</script>
@endpush

