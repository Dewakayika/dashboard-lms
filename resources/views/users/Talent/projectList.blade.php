@extends('users.Talent.layouts.dashboard-app')

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
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Talent Qc</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Panel</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Assign Date</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Finish Date</th>
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
                        <span class="text-sm px-1 font-weight-bold">{{ \Carbon\Carbon::parse($projects->created_at)->translatedFormat('D, M Y | H:i A ') }}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-sm px-1 font-weight-bold">{{ $projects->finish_date ? \Carbon\Carbon::parse($projects->finish_date)->translatedFormat('D, M Y | H:i A') : '-' }}
                        </span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        @if ($projects->status == 'Project Assign')
                            <span class="badge badge-sm bg-gradient-info">{{$projects->status}}</span>
                        @elseif ($projects->status == 'QC First Draft' && 'QC Revise 1' && 'QC Revise 2' && 'QC Revise 3')
                            <span class="badge badge-sm .bg-gradient-attentions">{{$projects->status}}</span>
                        @elseif ($projects->status == 'First Draft Submitted' && 'Revise 1 Submitted' && 'Revise 2 Submitted' && 'Revise 3 Submitted')
                            <span class="badge badge-sm .bg-gradient-warning">{{$projects->status}}</span>
                        @elseif ($projects->status == 'Revision 1' && 'Revision 2' && 'Revision 3')
                            <span class="badge badge-sm .bg-gradient-danger">{{$projects->status}}</span>
                        @elseif ($projects->status == 'Done')
                            <span class="badge badge-sm .bg-gradient-success">{{$projects->status}}</span>
                        @else
                            <span class="badge badge-sm .bg-gradient-danger">{{$projects->status ?? 'undefine'}}</span>
                        @endif
                      </td>
                      <td class="align-middle">
                        <a href="{{ route('talent#projectDetail', ['id' => encrypt($projects->id)]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View Details">
                            Detail
                        </a>
                      </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </main>

  @endsection
