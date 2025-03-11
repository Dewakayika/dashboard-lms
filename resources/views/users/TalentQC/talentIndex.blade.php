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

  </div>


  @if($projectsWithoutComplexity->isNotEmpty())
  @foreach($projectsWithoutComplexity as $project)
  @if($project->status == 'Done')
<div class="position-fixed top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.5); z-index: 1040;">
    <div class="card position-absolute blur shadow-blur" style="top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; z-index: 1050;">
        <div class="card-header border-bottom pb-0 rounded">
            <div class=" justify-content-between align-items-center text-center">
                <h5 class="mb-0">Congratulations!</h5>
                <p class="text-md mt-2">You already finish <span class="text-bold">{{ $project->comic_name }} {{ $project->chapter_number }}</span>, Let's give the review for project and your QC Agent!</p>

                <button type="button" class="btn-close" aria-label="Close"></button>
            </div>
        </div>
        <div class="card-body bg-white p-3 rounded">
            <form action="{{ route('talentqc#storeReview') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <input type="hidden" name="user_id" value="{{ $userData->id }}">
                <input type="hidden" name="comic_name" value="{{ $project->comic_name }}">


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
@endif
@endforeach
@endif


{{-- review to talent --}}
@if($projectsqcWithoutComplexity->isNotEmpty())
@foreach($projectsqcWithoutComplexity as $comic)
@if($comic->status == 'Done')
<div class="position-fixed top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.5); z-index: 1040;">
    <div class="card position-absolute blur shadow-blur" style="top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; z-index: 1050;">
        <div class="card-header border-bottom pb-0 rounded">
            <div class=" justify-content-between align-items-center text-center">
                <h5 class="mb-0">Congratulations!</h5>
                <p class="text-md mt-2">You already finish {{$comic->comic_name}} Eps {{$comic->chapter_number}}, Let's give the review for comic and your Talent!</p>
                <button type="button" class="btn-close" aria-label="Close"></button>
            </div>
        </div>
        <div class="card-body bg-white p-3 rounded">
            <form action="{{ route('talentqc#ReviewTalent') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="project_id" value="{{ $comic->id }}">
                <input type="hidden" name="user_id" value="{{ $userData->id }}">
                <input type="hidden" name="comic_name" value="{{ $comic->comic_name }}">


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
                    <label for="talent_review" class="text-md text-dark">Talent Review</label>
                    <select name="talent_review" class="form-control">
                        <option value="">Please select Qc review</option>
                        <option value="1">Needs Improvement</option>
                        <option value="2">Developing</option>
                        <option value="3">Competent</option>
                        <option value="4">Outstanding</option>
                        <option value="5">Exceptional</option>

                    </select>
                    @error('talent_review')
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


                <button type="submit" class="btn bg-gradient-dark w-100 my-4" >Submit Project Review</button>
            </form>
            <!-- Add your form or content here -->
        </div>

    </div>
</div>
@endif
@endforeach
@endif

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
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project Type</th>
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
                  <td class="align-middle text-center text-sm">
                    <span class="text-sm font-weight-bold">{{ optional($project->projectType)->name ?? 'N/A' }}</span>
                  </td>
                  <td>
                    <div class="d-flex px-2 py-1">
                      {{-- <div>
                        <img src="{{asset('/assets/img/small-logos/webtoon.png')}}" class="avatar avatar-sm me-3" alt="xd">
                      </div> --}}
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
                    @php
                        $complexity = $project->projectComplexity->first();
                        if ($complexity) {
                            $rawComplexity = $complexity->average_complexity;
                            // Custom rounding logic
                            $decimal = $rawComplexity - floor($rawComplexity);
                            $avgComplexity = $decimal <= 0.5 ? floor($rawComplexity) : ceil($rawComplexity);

                            switch($avgComplexity) {
                                case 1:
                                    $result = 'Very Easy';
                                    break;
                                case 2:
                                    $result = 'Easy';
                                    break;
                                case 3:
                                    $result = 'Medium';
                                    break;
                                case 4:
                                    $result = 'Hard';
                                    break;
                                case 5:
                                    $result = 'Very Hard';
                                    break;
                                default:
                                    $result = 'Unknown';
                            }
                            $display = $result;
                        } else {
                            $display = '-';
                        }
                    @endphp
                    <span class="text-sm font-weight-bold">{{ $display }}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-warning">{{$project->status}}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    @if ($projectOverview->isNotEmpty() && ($projectOverview->last()->status == 'Project Assign'))
                        <a class="badge badge-sm text-white bg-gradient-success" href="#" data-bs-toggle="modal" data-bs-target="#notApply">
                            <span class="px-2">Apply</span>
                        </a>
                    @else
                        <div class="bg-gradient-succes">
                            <form action="{{ route('talentqc#applyProject', $project->id) }}" method="POST" id="applyForm-{{ $project->id }}">
                                @csrf
                                <button type="button" class="badge badge-sm text-white bg-gradient-success" style="border: none" onclick="confirmApply({{ $project->id }})">Apply</button>
                            </form>
                        </div>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @if ($projects->hasMorePages())
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
            @else

            @endif
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

                <!-- Modal for confirmation -->
    <div class="modal fade" id="notApply" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 400px;">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmationModalLabel">Sorry! You canot apply this project?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Some of your project still on going, you can't apply new project. Please make sure your project draft submitted and apply this project again.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="modal-btn modal-btn-cancel" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="modal-btn modal-btn-continue" data-bs-dismiss="modal">Finish Project</button>
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
                {{-- <div class="min-height-160">
                    <canvas id="radiarChart" height="200px" width="80px"></canvas>
                </div> --}}
                <li class="list-group-item border-0 d-flex align-items-center px-3 mb-1">
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
                <li class="list-group-item border-0 d-flex align-items-center px-3 mb-1">
                    <div class="d-flex align-items-start flex-row gap-3 justify-content-center">
                        <div class="icon icon-shape bg-orange-200 text-center border-radius-2xl">
                            <i class="fa-regular fa-pen-to-square" style="color: #d35400"></i>
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Project QC</h6>
                            <p class="text-normal text-xs">Waiting QC agent check the project</p>
                        </div>
                    </div>
                    <h4 class="pe-3 ps-0 mb-0 ms-auto d-flex justify-content-center">{{$projectQc}}</h4>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-3 mb-1">
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
                <li class="list-group-item border-0 d-flex align-items-center px-3 mb-1">
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
                <li class="list-group-item border-0 d-flex align-items-center px-3 mb-1">
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
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project Type</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comic Name</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Episode Number</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Talent Qc</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($projectOverview as $projects )
                <tr>
                    <td class="align-middle text-center text-sm">
                        <span class="text-sm font-weight-bold">{{ optional($projects->projectType)->name ?? 'N/A' }}</span>
                    </td>
                  <td>
                    <div class="d-flex px-2 py-1">
                        {{-- <div>
                          <img src="{{asset('/assets/img/small-logos/webtoon.png')}}" class="avatar avatar-sm me-3" alt="xd">
                        </div> --}}
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project Type</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comic Name</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Episode Number</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Talent</th>
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
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-sm font-weight-bold">{{ optional($projectQcOverview->projectType)->name ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                {{-- <div>
                                                    <img src="{{asset('/assets/img/small-logos/webtoon.png')}}" class="avatar avatar-sm me-3" alt="xd">
                                                </div> --}}
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

