
@extends('users.TalentQC.layouts.dashboard-app')

@section('content')
  <div class="main-content position-relative bg-gray-100 ">
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
                <img src="{{ asset('storage/' . $talent->profile_photo) }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
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
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-md-8 d-flex text-center align-items-center">
                            <h6 class="mb-0 text-center">User Information</h6>
                        </div>
                        <div class="col-md-4 text-end">
                            <button id="editProfileBtn" class="btn bg-primary btn-sm text-white">Edit</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-body p-3">
                    <!-- Display Profile Information -->
                    <div id="viewProfile">
                        <div class="row">
                            <div class="col">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                        <strong class="text-dark">Full Name:</strong> &nbsp; {{$talent->full_name}}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Address:</strong> &nbsp; {{$talent->address}}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Gender:</strong> &nbsp; {{$talent->gender}}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Date of Birth:</strong> &nbsp; {{$talent->date_of_birth}}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Phone Number:</strong> &nbsp; {{$talent->phone_number}}
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Bank Name:</strong> &nbsp; {{$talent->bank_name}}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Bank Account:</strong> &nbsp; {{$talent->bank_Account}}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Swift Code:</strong> &nbsp; {{$talent->swift_code}}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">Subject TAX:</strong> &nbsp; {{$talent->subjected_tax}}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <strong class="text-dark">ID Card Number:</strong> &nbsp; {{$talent->id_card}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
            
                    <!-- Edit Profile Form (Initially Hidden) -->
                    <form id="editProfileForm" style="display: none;" method="POST" action="{{ route('talentqc#update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="d-flex justify-content-center w-100">
                                    <label for="dropzone-file" id="dropzone-label" class="d-flex flex-column align-items-center justify-content-center w-100 h-100 border border-dashed rounded cursor-pointer bg-white hover:bg-light file-input-border">
                                        <div id="upload-area" class="d-flex flex-column align-items-center justify-content-center py-5">
                                            <svg id="icon-upload" class="w-25 h-25 mb-4 text-secondary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                            <p id="upload-text" class="mb-2 text-sm text-muted"><span class="font-weight-bold">Click to upload profile picture</span></p>
                                            <p id="upload-info" class="text-xs text-muted"> PNG, JPG or GIF</p>
                                            <!-- Image preview -->
                                            <img id="image-preview" src="" alt="" class="d-none w-100 max-height-40 mt-2">
                                            <!-- Filename display -->
                                            <p id="file-name" class="d-none mt-2 text-sm text-secondary"></p>
                                            <p id="change-text" class="d-none text-sm text-primary cursor-pointer">Click to Change</p>
                                        </div>
                                        <input id="dropzone-file" type="file" name="profile_photo" class="d-none" accept="image/*" />
                                    </label>
                                    @error('profile_photo')
                                        <p class="text-danger text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name" value="{{$talent->full_name}}">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{$talent->address}}">
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="Male" {{$talent->gender == 'Male' ? 'selected' : ''}}>Male</option>
                                        <option value="Female" {{$talent->gender == 'Female' ? 'selected' : ''}}>Female</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{$talent->date_of_birth}}">
                                </div>
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{$talent->phone_number}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="bank_name" class="form-label">Bank Name</label>
                                    <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{$talent->bank_name}}">
                                </div>
                                <div class="mb-3">
                                    <label for="bank_account" class="form-label">Bank Account</label>
                                    <input type="text" class="form-control" id="bank_Account" name="bank_Account" value="{{$talent->bank_Account}}">
                                </div>
                                <div class="mb-3">
                                    <label for="swift_code" class="form-label">Swift Code</label>
                                    <input type="text" class="form-control" id="swift_code" name="swift_code" value="{{$talent->swift_code}}">
                                </div>
                                <div class="mb-3">
                                    <label for="subjected_tax" class="form-label">Subjected Tax</label>
                                    <input type="text" class="form-control" id="subjected_tax" name="subjected_tax" value="{{$talent->subjected_tax}}">
                                </div>
                                <div class="mb-3">
                                    <label for="id_card" class="form-label">ID Card</label>
                                    <input type="text" class="form-control" id="id_card" name="id_card" value="{{$talent->id_card}}">
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success btn-sm">Save</button>
                            <button type="button" id="cancelEditBtn" class="btn btn-secondary btn-sm">Cancel</button>
                        </div>
                    </form>
                    
                </div>
            </div>
            
            <script>
                const editProfileBtn = document.getElementById('editProfileBtn');
                const editProfileForm = document.getElementById('editProfileForm');
                const viewProfile = document.getElementById('viewProfile');
                const cancelEditBtn = document.getElementById('cancelEditBtn');
            
                editProfileBtn.addEventListener('click', () => {
                    viewProfile.style.display = 'none';
                    editProfileForm.style.display = 'block';
                });
            
                cancelEditBtn.addEventListener('click', () => {
                    editProfileForm.style.display = 'none';
                    viewProfile.style.display = 'block';
                });
            </script>
            
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


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
const dropzoneFile = document.getElementById('dropzone-file');
const imagePreview = document.getElementById('image-preview');
const uploadText = document.getElementById('upload-text');
const uploadInfo = document.getElementById('upload-info');
const fileNameDisplay = document.getElementById('file-name');
const changeText = document.getElementById('change-text');

dropzoneFile.addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreview.classList.remove('d-none');
            fileNameDisplay.textContent = file.name;
            fileNameDisplay.classList.remove('d-none');
            uploadText.classList.add('d-none');
            uploadInfo.classList.add('d-none');
            changeText.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }
});


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

