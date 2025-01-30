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
    <div class="col-lg-6 col-md-6 mb-md-0 mb-4" >
        <div class="card h-100vh" style="padding: 20px" >
            <div class="card-header">
                <h6 class="mb-0">Talent Average Working Duration</h6>
            </div>
            <div style="width: 100%; overflow-x: auto; white-space: nowrap;">
                <canvas id="talentChart" width="800" height="400"></canvas>
            </div>
        </div>

    </div>
    <div class="col-lg-6 col-md-6">
        <div class="card" style="padding: 20px">
            <div class="card-header">
                <h6 class="mb-0">QC Average Working Duration</h6>
            </div>
            <div style="width: 100%; overflow-x: auto; white-space: nowrap;">
                <canvas id="qcChart" width="800" height="400"></canvas>
            </div>
        </div>
    </div>
  </div>

  <div class="col-lg-12 col-md-6">
    <div class="card my-4">
        <div class="card-header pb-0 p-3">
            <h6 class="mb-0">Leaderboard</h6>
        </div>

        <div class="card-body justify-content-between">
            @foreach($result as $index => $talent)
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex align-items-center mb-2">
                        <div class="d-flex align-items-start flex-row gap-3 justify-content-center">
                            <div class="icon icon-shape bg-yellow-200 text-center border-radius-2xl">
                                <i class="fa-solid fa-trophy" style="color: #f1c40f"></i>
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $talent['talent_name'] ?? 'Unknown' }}</h6>
                                <p class="text-normal text-xs">{{ $talent['email'] ?? 'No Email' }}</p>
                            </div>
                        </div>
                        <h4 class="pe-3 ps-0 mb-0 ms-auto d-flex justify-content-center">
                            {{ $talent['formatted_average_duration'] ?? '0 hours' }}
                        </h4>
                    </li>
                </ul>
            @endforeach
        </div>
    </div>
  </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('talentChart').getContext('2d');

        const talentNames = @json($talentNames);
        const averageProjectDurations = @json($averageProjectDurations);

        // Format for tooltip (full format)
        const fullTalentNames = talentNames.map(name => name);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: talentNames,
                datasets: [{
                    label: 'Rata-rata Waktu Pengerjaan (jam)',
                    data: averageProjectDurations,
                    borderWidth: 0,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
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
                                return fullTalentNames[index];
                            },
                            label: function(context) {
                                return `Rata-rata Waktu: ${context.parsed.y} jam`;
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

    <script>
        var ctx2 = document.getElementById('qcChart').getContext('2d');

        const qcNames = @json($qcNames);
        const averageQCDurations = @json($averageQCDurations);

        // Format for tooltip (full format)
        const fullQcNames = qcNames.map(name => name);

        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: qcNames,
                datasets: [{
                    label: 'Rata-rata Waktu QC (jam)',
                    data: averageQCDurations,
                    borderWidth: 0,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderRadius: 8,
                    borderSkipped: false,
                    barPercentage: 1,
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
                                return fullQcNames[index];
                            },
                            label: function(context) {
                                return `Rata-rata Waktu: ${context.parsed.y} jam`;
                            }
                        }
                    },
                    title: {
                        display: true
                    },
                    legend: {
                        display: true
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


