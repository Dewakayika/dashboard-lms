
@extends('users.Admin.layouts.auth')

@section('content')
  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="{{asset('images/profile/1730087881_United2.jpg')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
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
                <div class="row">
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; {{$talent->full_name ?? $talentQc->full_name}}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Address:</strong> &nbsp; {{$talent->address ?? $talentQc->address}} </li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Gender:</strong> &nbsp; {{$talent->gender ?? $talentQc->gender}} </li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Date of Birth:</strong> &nbsp; {{$talent->date_of_birth ?? $talentQc->date_of_birth}} </li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Phone Number:</strong> &nbsp; {{$talent->phone_number ?? $talentQc->phone_number}} </li>
                          </ul>
                    </div>
                    <div class="col">
                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">Bank Name:</strong> &nbsp;
                            @php
                                $bankName = $talent->bank_name ?? $talentQc->bank_name;
                                echo $bankName ? str_repeat('*', strlen($bankName)-2) . substr($bankName, -2) : '-';
                            @endphp
                        </li>

                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">Bank Account:</strong> &nbsp;
                            @php
                                $bankAccount = $talent->bank_Account ?? $talentQc->bank_Account;
                                echo $bankAccount ? substr($bankAccount, 0, 2) . str_repeat('*', strlen($bankAccount)-6) . substr($bankAccount, -4) : '-';
                            @endphp
                        </li>

                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">Swift Code:</strong> &nbsp;
                            @php
                                $swiftCode = $talent->swift_code ?? $talentQc->swift_code;
                                echo $swiftCode ? str_repeat('*', strlen($swiftCode)-4) . substr($swiftCode, -4) : '-';
                            @endphp
                        </li>

                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">Subject TAX:</strong> &nbsp;
                            @php
                                $tax = $talent->subjected_tax ?? $talentQc->subjected_tax;
                                echo $tax ? str_repeat('*', strlen($tax)-3) . substr($tax, -3) : '-';
                            @endphp
                        </li>

                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">ID Card Number:</strong> &nbsp;
                            @php
                                $idCard = $talent->id_card ?? $talentQc->id_card;
                                echo $idCard ? substr($idCard, 0, 2) . str_repeat('*', strlen($idCard)-6) . substr($idCard, -4) : '-';
                            @endphp
                        </li>

                    </div>
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
            <div class="card-header">
                <h6 class="mb-0">Statistic {{$userData->name}}'s Project by priode</h6>
            </div>
            <div class="max-height-300">
                <canvas id="myChart"></canvas>
            </div>
          </div>
    </div>
      @include('users.Admin.layouts.footer')
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
      const ctx = document.getElementById('myChart').getContext('2d');

      const months = @json($months);
      const totals = @json($totals);

      new Chart(ctx, {
          type: 'bar',
          data: {
              labels: months,
              datasets: [{
                  label: 'Total Projects',
                  data: totals,
                  borderWidth: 1,
                  backgroundColor: 'rgba(255, 99, 132, 0.2)',
                  borderColor: 'rgba(255, 99, 132, 1)',
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
  </script>
@endsection

