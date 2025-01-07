@extends('users.Admin.layouts.dashboard-app')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Projects Overview</h6>
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

        </div>
    </div>
</main>

@endsection
