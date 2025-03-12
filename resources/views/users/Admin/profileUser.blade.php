
@extends('users.Admin.layouts.auth')

@section('content')


<div class="col-12 mx-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Home</a></li>
            <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
            <li class="breadcrumb-item active text-xs" aria-current="page">{{$userData->name}}'s Profile</li>
        </ol>
    </nav>
</div>


  <div class="main-content position-relative bg-gray-100 ">
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
                <img src="{{ asset('storage/' . ($userData->talent->profile_photo ?? $userData->talentQc->profile_photo ?? 'default.png')) }}"
                alt="profile_image"
                class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{$userData->name}}
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                {{$userData->email}}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="container-fluid py-4">
      <div class="row">

        <div class="col-8 col-md-8 mb-md-0 mb-4">
            <div class="card h-100">
              <div class="card-header pb-0 ">
                <div class="row">
                  <div class="col-md-8 d-flex text-center align-items-center">
                    <h6 class="mb-0 text-center">User Information</h6>
                  </div>
                </div>
              </div>
              <hr class="">
              <div class="card-body p-3">
                <div id="viewProfile">
                    @if($talent)
                        <h5 class="text-dark">Talent Profile</h5>
                        <div class="row">
                            <div class="col">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                        <strong class="text-dark">Full Name:</strong> &nbsp; {{$talent->full_name ?? '-'}}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Address:</strong> &nbsp; {{$talent->address ?? '-'}}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Gender:</strong> &nbsp; {{$talent->gender ?? '-'}}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Date of Birth:</strong> &nbsp; {{$talent->date_of_birth ?? '-'}}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Phone Number:</strong> &nbsp; {{$talent->phone_number ?? '-'}}
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Bank Name:</strong> &nbsp; {{ Str::mask($talent->bank_name, '*', 0, strlen($talent->bank_name) ) }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Bank Account:</strong> &nbsp; {{ Str::mask($talent->bank_Account, '*', 0 ) }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Swift Code:</strong> &nbsp; {{ Str::mask($talent->swift_code, '*', 0 ) }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Subject TAX:</strong> &nbsp; {{ Str::mask($talent->subjected_tax, '*', 0 ) }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">ID Card Number:</strong> &nbsp; {{ Str::mask($talent->id_card, '*', 0 ) }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if($talentQc)
                        <h5 class="text-dark mt-4">Talent QC Profile</h5>
                        <div class="row">
                            <div class="col">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                        <strong class="text-dark">Full Name:</strong> &nbsp; {{$talentQc->full_name ?? '-'}}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Address:</strong> &nbsp; {{$talentQc->address ?? '-'}}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Gender:</strong> &nbsp; {{$talentQc->gender ?? '-'}}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Date of Birth:</strong> &nbsp; {{$talentQc->date_of_birth ?? '-'}}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Phone Number:</strong> &nbsp; {{$talentQc->phone_number ?? '-'}}
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Bank Name:</strong> &nbsp; {{ Str::mask($talentQc->bank_name, '*', 0, strlen($talentQc->bank_name) ) }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Bank Account:</strong> &nbsp; {{ Str::mask($talentQc->bank_Account, '*', 0 ) }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Swift Code:</strong> &nbsp; {{ Str::mask($talentQc->swift_code, '*', 0 ) }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Subject TAX:</strong> &nbsp; {{ Str::mask($talentQc->subjected_tax, '*', 0 ) }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">ID Card Number:</strong> &nbsp; {{ Str::mask($talentQc->id_card, '*', 0 ) }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            </div>
          </div>

        <div class="col-12 col-xl-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Project Overview</h6>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
                @foreach ($projectOverview as $project )


                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="avatar me-3">
                    <img src="{{asset('assets/img/small-logos/webtoon.png')}}" alt="kal" class="border-radius-lg shadow">
                  </div>
                  <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{$project->comic_name}} Eps {{$project->chapter_number}}</h6>
                    <p class="mb-0 text-xs"> Number of Panel {{$project->number_of_panel}} </p>
                  </div>

                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>



      </div>
      <div class="col-lg-12 col-md-12 mb-md-0 mb-4 my-4" >
        <div class="card " style="padding: 20px" >
            <div class="card-header d-flex">
            <h6 class="mb-0">Statistic Project {{ $selectedYear }}</h6>
            <form method="GET" action="{{ request()->url() }}">
                <select name="year" id="year"
                        class="form-select form-select-sm ms-3"
                        onchange="this.form.submit()">
                    @foreach($availableYears as $year)
                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </form>
            </div>
            <div class="max-h-80" width="100%">
                <canvas id="myChart" width="100%" height="20px"></canvas>
            </div>
          </div>
    </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
 const ctx = document.getElementById('myChart').getContext('2d');

const months = @json($months);
const totals = @json($totals);
const selectedYear = @json($selectedYear);

// Format the month labels for x-axis (short format: Jan 25, Feb 25)
const formattedLabels = months.map(month => {
    const date = new Date(month);
    return date.toLocaleDateString('en-US', { month: 'short', year: '2-digit' });
});

// Format for tooltip (full format: January 2025, February 2025)
const fullMonthLabels = months.map(month => {
    const date = new Date(month);
    return date.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
});

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: formattedLabels,
        datasets: [{
            label: `Total Projects (${selectedYear})`,
            data: totals,
            borderWidth: 0,
            backgroundColor: 'rgba(255, 154, 154)',
            borderRadius: 8,
            borderSkipped: false,
            barPercentage: 0.7,
            categoryPercentage: 0.8
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                    precision: 0,
                    font: {
                        family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif',
                        size: 12
                    }
                },
                grid: {
                    display: true,
                    color: 'rgba(0, 0, 0, 0.05)',
                    drawBorder: false
                }
            },
            x: {
                grid: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    font: {
                        family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif',
                        size: 12
                    }
                }
            }
        },
        responsive: true,
        plugins: {
            tooltip: {
                enabled: true,
                position: 'nearest',
                backgroundColor: 'rgba(255, 255, 255, 0.95)',
                titleColor: '#333',
                titleFont: {
                    family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif',
                    size: 14,
                    weight: '600'
                },
                bodyColor: '#666',
                bodyFont: {
                    family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif',
                    size: 13
                },
                padding: 12,
                cornerRadius: 12,
                displayColors: false,
                borderColor: 'rgba(0, 0, 0, 0.1)',
                borderWidth: 1,
                callbacks: {
                    title: function(tooltipItems) {
                        const index = tooltipItems[0].dataIndex;
                        return fullMonthLabels[index];
                    },
                    label: function(context) {
                        return `Total Projects: ${context.parsed.y}`;
                    }
                }
            },
            title: {
                display: false
            },
            legend: {
                display: false
            }
        },
        animation: {
            duration: 1000,
            easing: 'easeInOutQuart'
        },
        interaction: {
            intersect: false,
            mode: 'index'
        }
    }
});
  </script>
@endsection

