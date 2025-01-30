@extends('users.Admin.layouts.dashboard-app')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="w-full mx-auto  d-flex align-items-center justify-content-between">
                        <h6 class="text-weight-bolder">Project Overview</h6>
                        <a class="badge badge-xs bg-primary text-sm font-weight-bold mb-0 text-white hover:bg-secondary" href="# " data-bs-toggle="modal" data-bs-target="#createProjectModal">
                            <i class="fa-solid fa-plus text-white"></i>
                            <span class="px-2">New Project</span>
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comic Name</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Episode Number</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Talent</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Panel</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Assign Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($projectOverview->where('status', '!=', 'Done')->isEmpty())
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
                                @foreach ($projectOverview->sortByDesc('created_at') as $project)
                                    @if ($project->status != 'Done')
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
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-sm px-1 font-weight-bold">{{$project->talent ?? 'Still Waiting'}}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-sm px-1 font-weight-bold">{{$project->number_of_panel}}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-sm px-1 font-weight-bold">{{ \Carbon\Carbon::parse($project->created_at)->translatedFormat('D, M Y | H:i A ') }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($project->status == 'Waiting Talent')
                                                    <span class="badge badge-sm bg-gradient-warning">{{$project->status}}</span>
                                                @elseif ($project->status == 'Project Assign')
                                                    <span class="badge badge-sm bg-gradient-info">{{$project->status}}</span>
                                                @elseif (in_array($project->status, ['QC First Draft', 'QC Revise 1', 'QC Revise 2', 'QC Revise 3']))
                                                    <span class="badge badge-sm bg-gradient-warning">{{$project->status}}</span>
                                                @elseif (in_array($project->status, ['First Draft Submitted', 'Revise 1 Submitted', 'Revise 2 Submitted', 'Revise 3 Submitted']))
                                                    <span class="badge badge-sm bg-gradient-success">{{$project->status}}</span>
                                                @elseif (in_array($project->status, ['Revision 1', 'Revision 2', 'Revision 3']))
                                                    <span class="badge badge-sm bg-gradient-danger">{{$project->status}}</span>
                                                @elseif ($project->status == 'Done')
                                                    <span class="badge badge-sm bg-gradient-success">{{$project->status}}</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-danger">{{$project->status ?? 'undefined'}}</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                @if ($project->status != 'Waiting Talent')
                                                    <a href="{{ route('admin#projectDetail', $project->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View Details">
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
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Completed Projects</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comic Name</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Episode Number</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Talent</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Panel</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Assign Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Finish Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($projectOverview->where('status', 'Done')->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div>
                                                <img src="{{ asset('/assets/img/ilustration/NoConnection.svg')}}" class="h-auto w-11" style="width: 110px; height: auto;">
                                                <p class="text-xs">There are no completed projects</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @else
                                @foreach ($projectOverview as $project)
                                    @if ($project->status == 'Done')
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
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-sm px-1 font-weight-bold">{{$project->talent ?? 'Still Waiting'}}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-sm px-1 font-weight-bold">{{$project->number_of_panel}}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-sm px-1 font-weight-bold">{{ \Carbon\Carbon::parse($project->created_at)->translatedFormat('D, M Y | H:i A ') }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-sm px-1 font-weight-bold">{{ $project->finish_date ? \Carbon\Carbon::parse($project->finish_date)->translatedFormat('D, M Y | H:i A') : '-' }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-success">{{$project->status}}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('admin#projectDetail', $project->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View Details">
                                                        Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


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

        </div>
    </div>
</main>

@endsection
