@extends('users.Admin.layouts.auth')

@section('content')

<nav aria-label="container-fluid breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Home</a></li>
        <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active text-xs" aria-current="page">Time Statistic</li>
    </ol>
</nav>

  <div class="row my-4">
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4" >
        <div class="card " style="padding: 20px" >
            <div class="card-header">
                <h6 class="mb-0">Talent Average Working Duration</h6>
            </div>
            <div class="h-auto">
                <canvas id="myChart"></canvas>
            </div>
          </div>

          <div class="card my-4" style="min-height: 400px;"  >
            <div class="card-header pb-0">
              <div class="row">
                <div class="w-full mx-auto  d-flex align-items-center justify-content-between">
                    <h6 class="text-weight-bolder">Talent Project Counting</h6>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Talent Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Panel</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Total Project</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($userProjects as $project)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $project->talent}}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-sm font-weight-bold"> {{ $project->total_panels ?? 0 }} </span>
                      </td>
                      <td class="align-middle text-center text-sm">
                          <span class="text-sm font-weight-bold"> {{ $project->total_projects ?? 0 }} </span>
                        </td>
      
                      <td class="align-middle text-center text-sm">
                        <a class="badge badge-sm bg-gradient-info" href="{{ route('admin#profileDetailUser', $project->user_id) }}"> Detail </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            
          </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Leaderboard</h6>
            </div>

            <div class="card-body justify-content-between">
                @foreach($result as $index => $talent)
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex  align-items-center  mb-2 ">
                        <div class="d-flex align-items-start flex-row gap-3 justify-content-center">
                            <div class="icon icon-shape bg-yellow-200 text-center border-radius-2xl">
                                <i class="fa-solid fa-trophy" style="color: #f1c40f"></i>
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $talent['talent_name'] }}</h6>
                                <p class="text-normal text-xs">{{ $talent['email'] }}</p>
                            </div>
                        </div>
                        <h4 class="pe-3 ps-0 mb-0 ms-auto d-flex justify-content-center">{{ $talent['formatted_average_duration'] }}</h4>
                    </li>
                </ul>
                @endforeach
            </div>
        </div>
    </div>

  </div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const talentNames = @json($talentNames);
        const totalDurations = @json($totalDurations);
        const averageDurations = @json($averageDurations);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: talentNames,
                datasets: [
                    {
                        label: 'Average Duration (Hours)',
                        data: averageDurations,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Duration (Hours)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Talent Name'
                        }
                    }
                }
            }
        });
    </script>



@endsection


