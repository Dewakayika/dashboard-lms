@extends('users.Talent.layouts.dashboard-app')

@section('content')

  <div class="row">
    <div class="col-xl-5 mb-xl-0 mb-4">
        <div class="card bg-transparent shadow-xl">
          <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
            <span class="mask bg-gradient-dark"></span>
            <div class="card-body position-relative z-index-1 p-3">
              <i class="fas fa-wifi text-white p-2"></i>
              <div class="d-flex align-items-center">
                <h2 class="text-white mt-4 mb-5" id="amount">Rp {{ number_format($totalEwallet, 0, ',', '.') }}</h2>
                <a id="toggleAmount" style="cursor: pointer; display: flex; align-items: center; margin-left: 10px;"><i class="fa-solid fa-eye"></i></a>
              </div>
              <script>
                document.addEventListener('DOMContentLoaded', function () {
                  const amount = document.getElementById('amount');
                  const toggleAmount = document.getElementById('toggleAmount');

                  // Simpan nilai asli jumlah saldo
                  const originalAmount = 'Rp {{ number_format($totalEwallet, 0, ',', '.') }}';
                  let isHidden = false;

                  toggleAmount.addEventListener('click', function () {
                    if (isHidden) {
                      // Tampilkan jumlah saldo
                      amount.textContent = originalAmount;
                      this.innerHTML = '<i class="fa-solid fa-eye"></i>'; // Ganti ikon ke "eye"
                    } else {
                      // Sembunyikan jumlah saldo
                      amount.textContent = 'Rp .........';
                      this.innerHTML = '<i class="fa-solid fa-eye-slash"></i>'; // Ganti ikon ke "eye-slash"
                    }
                    isHidden = !isHidden; // Ubah status tersembunyi
                  });
                });
              </script>
              <div class="d-flex">
                <div class="d-flex">
                  <div class="me-4">
                    <p class="text-white text-sm opacity-8 mb-0">Personal</p>
                    <h6 class="text-white mb-0">{{$userData->name}}</h6>
                  </div>
                  <div>
                    <p class="text-white text-sm opacity-8 mb-0">Bank Information</p>
                    <h6 class="text-white mb-0">{{$talent->bank_name}} | {{$talent->bank_Account}}</h6>
                  </div>
                </div>
                <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                    <a class="badge badge-xs bg-primary text-xs font-weight-bold mb-0 text-white hover:bg-secondary" href="#" data-bs-toggle="modal" data-bs-target="#crequestModal">
                        <span class="px-2">Request Withdraw</span>
                    </a>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header mx-4 p-3 text-center">
            <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
              <i class="fas fa-landmark opacity-10"></i>
            </div>
          </div>
          <div class="card-body pt-0 p-3 text-center">
            <h6 class="text-center mb-0">Base Panel Compentation</h6>
            <span class="text-xs">Recap by this month</span>
            <hr class="horizontal dark my-3">
            <h5 class="mb-0">Rp {{ number_format($baseSalary, 0, ',', '.') }}</h5>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header mx-4 p-3 text-center">
            <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
              <i class="fas fa-landmark opacity-10"></i>
            </div>
          </div>
          <div class="card-body pt-0 p-3 text-center">
            <h6 class="text-center mb-0">Total Project</h6>
            <span class="text-xs">Recap by this month</span>
            <hr class="horizontal dark my-3">
            <h5 class="mb-0">{{$projects}}</h5>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header mx-4 p-3 text-center">
            <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
              <i class="fas fa-landmark opacity-10"></i>
            </div>
          </div>
          <div class="card-body pt-0 p-3 text-center">
            <h6 class="text-center mb-0">Total Panel</h6>
            <span class="text-xs">Recap by this month</span>
            <hr class="horizontal dark my-3">
            <h5 class="mb-0"> {{$totalPanel}}</h5>
          </div>
        </div>
    </div>
  </div>

          {{-- Modal New Records --}}
          <div class="modal fade" id="crequestModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 500px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProjectModalLabel">Confirm Your Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="px-3 pt-3">
                        <form action="{{ route('talentqc#withdrawRequest') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $userData->id }}">
                            <input type="hidden" name="total_project" value="{{$projects}}">
                            <input type="hidden" name="total_panel" value="{{$totalPanel}}">
                            <input type="hidden" name="panel_bonus" value="{{ $panelbonus }}">
                            <input type="hidden" name="perfomance_bonus" value="{{ $perfomanceBonus }}">


                            <div class="mb-2">
                                <label for="withdraw_amount" class="text-md text-dark">Withdraw Amount</label>
                                <input type="text" name="withdraw_amount" class="form-control" value="{{ $totalEwallet }}">
                                @error('withdraw_amount') <p class="text-danger text-xs mt-2">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-2">
                                <label for="bank_name" class="text-md text-dark">Bank Name</label>
                                <input type="text" name="bank_name" class="form-control" value="{{ $talent->bank_name }}">
                                @error('bank_name') <p class="text-danger text-xs mt-2">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-2">
                                <label for="bank_account" class="text-md text-dark">Bank Acoount</label>
                                <input type="text" name="bank_account" class="form-control" value="{{ $talent->bank_Account }}">
                                @error('bank_account') <p class="text-danger text-xs mt-2">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit" class="btn bg-gradient-dark w-100 my-4">Request Withdraw</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


  <div class="row my-4">
    <div class="col-lg-7 col-md-6 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h6>Withdraw Records</h6>
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
                        <p class="text-xs">No withdraw record</p>
                    </div>
                </div>
                @else
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Withdraw Amount</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date Requested</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($withdraws as  $withdraw)
                @if($withdraw->status == 'requested')
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Rp {{ number_format($withdraw->withdraw_amount, 0, ',', '.') }}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-xs font-weight-bold">{{$withdraw->withdraw_date}}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm text-white bg-gradient-warning" href="#" data-bs-toggle="modal" data-bs-target="#notApply">
                        <span class="px-2">{{$withdraw->status}}</span>
                    </span>
                  </td>

                </tr>
                @endif
                @endforeach
              </tbody>

              @endif
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-5 col-md-6">
      <div class="card h-100">
        <div class="card-header pb-0">
          <h6>Withdraw History</h6>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                @if ($withdraws->isEmpty())
                <div class="text-center d-flex align-items-center justify-content-center">
                    <div class="mb-3">
                        <img src="{{ asset('/assets/img/ilustration/NoDocuments.svg')}}" class="h-11 w-11">
                        <p class="text-xs">No ewallet history</p>
                    </div>
                </div>
                @else
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Withdraw Amount</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Approval Date</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th> --}}
                </tr>
              </thead>

              <tbody>
                @foreach ($withdraws as  $withdraw)
                @if($withdraw->status == 'approved')
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Rp {{ number_format($withdraw->withdraw_amount, 0, ',', '.') }}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-xs font-weight-bold">{{$withdraw->updated_at}}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm text-white bg-gradient-success" href="#" data-bs-toggle="modal" data-bs-target="#notApply">
                        <span class="px-2">{{$withdraw->status}}</span>
                    </span>
                  </td>
                </tr>
                @endif
                @endforeach
              </tbody>
              @endif
            </table>
          </div>

      </div>
    </div>
  </div>

@endsection


