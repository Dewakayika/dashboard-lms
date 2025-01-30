@extends('users.Admin.layouts.dashboard-app')

@section('content')


  <div class="row my-4">
    <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h6>Withdraw Request Records</h6>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
                @if ($withdraws->isEmpty())
                <div class="text-center d-flex align-items-center justify-content-center">
                    <div class="mb-3">
                        <img src="{{ asset('/assets/img/ilustration/NoDocuments.svg')}}" class="h-11 w-11">
                        <p class="text-xs">No request records</p>
                    </div>
                </div>
                @else
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Request Date</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User Requested</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Withdraw Amount</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($withdraws as  $withdraw)
                <tr>
                    <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold">
                            {{ \Carbon\Carbon::parse($withdraw->withdraw_date)->format('d M Y') }}
                        </span>
                      </td>
                    <td class="align-middle text- text-leftsm">
                        <span class="text-xs font-weight-bold">{{$withdraw->user->name}}</span>
                      </td>

                  <td>
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Rp {{ number_format($withdraw->withdraw_amount, 0, ',', '.') }}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm text-white bg-gradient-warning" href="#" data-bs-toggle="modal" data-bs-target="#notApply">
                        <span class="px-2">{{$withdraw->status}}</span>
                    </span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <a class="badge badge-sm text-white bg-gradient-success" href="#"
                       data-bs-toggle="modal" data-bs-target="#approveModal"
                       onclick="openApprovalModal({{ $withdraw->id }}, '{{ $withdraw->bank_name }}', '{{ $withdraw->bank_account }}', '{{$withdraw->withdraw_amount}}')">
                        <span class="px-2">Approve Request</span>
                    </a>
                </td>


                </tr>

                <!-- Approve Confirmation Modal -->
                <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width: 500px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="approveModalLabel">Confirm Approval</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="text-left px-4 py-4">
                                <!-- Password Validation Form -->
                                <div id="formPassword">
                                    <form id="passwordForm">
                                        @csrf
                                        <input type="hidden" id="withdraw_id">
                                        <div class="mb-3">
                                            <p class="text-sm  mb-3">To approve this request, please enter your account password for verification."</p>
                                            <div class="text-left">
                                            <label for="auth_password" class="form-label text-left">Enter Admin Password</label>
                                            <input type="password" class="form-control"  id="auth_password" name="auth_password" required>
                                            <span id="passwordError" class="text-danger text-sm text-left d-none">Incorrect password</span>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="modal-btn modal-btn-cancel" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="modal-btn modal-btn-continue" id="validatePasswordBtn">Validate</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Bank Details Section -->
                                <div id="bankDetails" class="d-none">
                                    <div class="bank-info mb-4 text-left">
                                        <p class="mb-2 text-left">This information is for the bank account of those requesting a withdrawal.</p>
                                        <p class="mb-2 text-left"><strong>Amount Requested:</strong> <span id="withdraw_amount"></span></p>
                                        <p class="mb-2 text-left"><strong>Bank Name:</strong> <span id="bank_name"></span></p>
                                        <p class="mb-2 text-left"><strong>Bank Account:</strong> <span id="bank_account"></span></p>
                                    </div>

                                    <form id="approveForm" method="POST" action="{{ route('admin#approveWithdraw') }}">
                                        @csrf
                                        <input type="hidden" name="withdraw_id" id="approve_withdraw_id">
                                        <div class="modal-footer">
                                            <button type="button" class="modal-btn modal-btn-cancel" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="modal-btn modal-btn-continue">Approve Request</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                @endforeach

              </tbody>

              @endif
            </table>
          </div>
        </div>
      </div>
    </div>


    <div class="col-lg-6 col-md-6">
      <div class="card h-100">
        <div class="card-header pb-0">
          <h6>Withdraw History History</h6>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                @if ($withdrawsHistory->isEmpty())
                <div class="text-center d-flex align-items-center justify-content-center">
                    <div class="mb-3">
                        <img src="{{ asset('/assets/img/ilustration/NoDocuments.svg')}}" class="h-11 w-11">
                        <p class="text-xs">No withdraw history</p>
                    </div>
                </div>
                @else
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Request Date</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aproval Date</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User Requested</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Withdraw Amount</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($withdrawsHistory as  $withdraw)
                  <tr>
                      <td class="align-middle text-center text-sm">
                          <span class="text-xs font-weight-bold">
                              {{ \Carbon\Carbon::parse($withdraw->withdraw_date)->format('d M Y') }}
                          </span>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold">
                                {{ \Carbon\Carbon::parse($withdraw->update_at)->format('d M Y') }}
                            </span>
                          </td>
                      <td class="align-middle text- text-leftsm">
                          <span class="text-xs font-weight-bold">{{$withdraw->user->name}}</span>
                        </td>

                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Rp {{ number_format($withdraw->withdraw_amount, 0, ',', '.') }}</h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm text-white bg-gradient-warning" href="#" data-bs-toggle="modal" data-bs-target="#notApply">
                          <span class="px-2">{{$withdraw->status}}</span>
                      </span>
                    </td>
                  </tr>


                  @endforeach

                </tbody>
                @endif
              </table>
          </div>

      </div>
    </div>
  </div>

  <script>
    function openApprovalModal(withdrawId, bankName, bankAccount, amountRequest) {

        document.getElementById('withdraw_id').value = withdrawId;
        document.getElementById('bank_name').innerText = bankName;
        document.getElementById('bank_account').innerText = bankAccount;
        document.getElementById('withdraw_amount').innerText = amountRequest;


        // Reset form modal
        document.getElementById('auth_password').value = "";
        document.getElementById('formPassword').classList.remove("d-none");
        document.getElementById('bankDetails').classList.add("d-none");
        document.getElementById('passwordError').classList.add("d-none");
    }

    document.getElementById('validatePasswordBtn').addEventListener('click', function () {
        let password = document.getElementById('auth_password').value;
        let withdrawId = document.getElementById('withdraw_id').value;

        fetch("{{ route('admin#validatePassword') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ password: password })
        })
        .then(response => response.json())
        .then(data => {
            if (data.valid) {
                document.getElementById('bankDetails').classList.remove("d-none");
                document.getElementById('formPassword').classList.add("d-none");
                document.getElementById('approve_withdraw_id').value = withdrawId;
            } else {
                document.getElementById('passwordError').classList.remove("d-none");
            }
        });
    });
</script>



@endsection
@push('dashboard')
  <script>
    window.onload = function() {
      var ctx = document.getElementById("chart-bars").getContext("2d");

      new Chart(ctx, {
        type: "bar",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
            label: "Sales",
            tension: 0.4,
            borderWidth: 0,
            borderRadius: 4,
            borderSkipped: false,
            backgroundColor: "#fff",
            data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
            maxBarThickness: 6
          }, ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
              },
              ticks: {
                suggestedMin: 0,
                suggestedMax: 500,
                beginAtZero: true,
                padding: 15,
                font: {
                  size: 14,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
                color: "#fff"
              },
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false
              },
              ticks: {
                display: false
              },
            },
          },
        },
      });


      var ctx2 = document.getElementById("chart-line").getContext("2d");

      var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

      gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
      gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

      var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

      gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
      gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

      new Chart(ctx2, {
        type: "line",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
              label: "Mobile apps",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#cb0c9f",
              borderWidth: 3,
              backgroundColor: gradientStroke1,
              fill: true,
              data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
              maxBarThickness: 6

            },
            {
              label: "Websites",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#3A416F",
              borderWidth: 3,
              backgroundColor: gradientStroke2,
              fill: true,
              data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
              maxBarThickness: 6
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                padding: 10,
                color: '#b2b9bf',
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#b2b9bf',
                padding: 20,
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
          },
        },
      });
    }
  </script>
@endpush


