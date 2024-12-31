@extends('users.Talent.layouts.auth')

@section('content')

  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body bg-primary p-3 border-radius-xl">
          <div class="row">
            <div class="col-8">
                <div class="icon icon-shape bg-white shadow text-center border-radius-section">
                    <i class="fa-solid fa-repeat fa-xl" style="color: #ed3237;"></i>
                </div>
              <div class="numbers mt-4">
                    <h5 class="font-weight-bolder text-white mb-0">
                    1
                    </h5>
                <p class="text-sm mb-0 text-white text-capitalize font-weight-light">On Going Project</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body bg-secondary p-3 border-radius-xl">
          <div class="row">
            <div class="col-8">
                <div class="icon icon-shape bg-white shadow text-center border-radius-section">
                    <i class="fa-solid fa-receipt fa-xl" style="color: #27272a;"></i>
                  </div>
              <div class="numbers mt-4">
                <h5 class="font-weight-bolder text-white mb-0">
                    20
                  </h5>
                <p class="text-sm mb-0 text-capitalize text-white font-weight-light">Project This Month</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body bg-secondary p-3 border-radius-xl">
            <div class="row">
              <div class="col-8">
                  <div class="icon icon-shape bg-white shadow text-center border-radius-section">
                      <i class="fa-solid fa-circle-check fa-xl" style="color: #27272a;"></i>
                    </div>
                <div class="numbers mt-4">
                  <h5 class="font-weight-bolder text-white mb-0">
                      100
                    </h5>
                  <p class="text-sm mb-0 text-capitalize text-white font-weight-light">Total Project</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body bg-white p-3 border-radius-xl">
            <div class="">
              <h6 class="text-uppercase text-sm font-weight-bolder text-black text-left">COUNT DOWN</h6>
              <p class="text-sm font-weight-normal text-gray-700">Submission for [Webtoon Title]</p>
              <div class="d-flex justify-content-center align-items-center mt-3">
                <div class="text-center me-4">
                  <h4 class="font-weight-bold mb-0">00</h4>
                  <span class="text-xs text-gray-500">DAY</span>
                </div>
                <div class="text-center mx-2">
                  <h4 class="font-weight-bold mb-0">00</h4>
                  <span class="text-xs text-gray-500">HOUR</span>
                </div>
                <div class="text-center mx-2">
                  <h4 class="font-weight-bold mb-0">00</h4>
                  <span class="text-xs text-gray-500">MIN</span>
                </div>
                <div class="text-center ms-2">
                  <h4 class="font-weight-bold mb-0">00</h4>
                  <span class="text-xs text-gray-500">SEC</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  </div>


  <div class="row my-4">
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h6>Project Offer</h6>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comic Name</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Episode Number</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Talent QC</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project Complexity</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/small-logos/webtoon.png" class="avatar avatar-sm me-3" alt="xd">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Keiken Ninzu </h6>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-sm font-weight-bold"> 27 </span>
                  </td>
                  <td>
                    <div class="avatar-group mt-2 d-flex">
                      <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                        <img src="../assets/img/team-3.jpg" alt="team1">
                      </a>
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-sm px-1 font-weight-bold">Dewa Kayika</p>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-sm text-center font-weight-bold"> Medium </span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-warning"> waiting Talent </span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-success"> Apply </span>
                  </td>
                </tr>

                <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="../assets/img/small-logos/webtoon.png" class="avatar avatar-sm me-3" alt="xd">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Keiken Ninzu </h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-sm font-weight-bold"> 27 </span>
                    </td>
                    <td>
                      <div class="avatar-group mt-2 d-flex">
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                          <img src="../assets/img/team-3.jpg" alt="team1">
                        </a>
                        <div class="d-flex flex-column justify-content-center">
                          <p class="text-sm px-1 font-weight-bold">Dewa Kayika</p>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-sm text-center font-weight-bold"> Medium </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-warning"> waiting Talent </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success"> Apply </span>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="../assets/img/small-logos/webtoon.png" class="avatar avatar-sm me-3" alt="xd">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Keiken Ninzu </h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-sm font-weight-bold"> 27 </span>
                    </td>
                    <td>
                      <div class="avatar-group mt-2 d-flex">
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                          <img src="../assets/img/team-3.jpg" alt="team1">
                        </a>
                        <div class="d-flex flex-column justify-content-center">
                          <p class="text-sm px-1 font-weight-bold">Dewa Kayika</p>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-sm text-center font-weight-bold"> Medium </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-warning"> waiting Talent </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success"> Apply </span>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="../assets/img/small-logos/webtoon.png" class="avatar avatar-sm me-3" alt="xd">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Keiken Ninzu </h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-sm font-weight-bold"> 27 </span>
                    </td>
                    <td>
                      <div class="avatar-group mt-2 d-flex">
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                          <img src="../assets/img/team-3.jpg" alt="team1">
                        </a>
                        <div class="d-flex flex-column justify-content-center">
                          <p class="text-sm px-1 font-weight-bold">Dewa Kayika</p>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-sm text-center font-weight-bold"> Medium </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-warning"> waiting Talent </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success"> Apply </span>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="../assets/img/small-logos/webtoon.png" class="avatar avatar-sm me-3" alt="xd">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Keiken Ninzu </h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-sm font-weight-bold"> 27 </span>
                    </td>
                    <td>
                      <div class="avatar-group mt-2 d-flex">
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                          <img src="../assets/img/team-3.jpg" alt="team1">
                        </a>
                        <div class="d-flex flex-column justify-content-center">
                          <p class="text-sm px-1 font-weight-bold">Dewa Kayika</p>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-sm text-center font-weight-bold"> Medium </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-warning"> waiting Talent </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success"> Apply </span>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="../assets/img/small-logos/webtoon.png" class="avatar avatar-sm me-3" alt="xd">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Keiken Ninzu </h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-sm font-weight-bold"> 27 </span>
                    </td>
                    <td>
                      <div class="avatar-group mt-2 d-flex">
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                          <img src="../assets/img/team-3.jpg" alt="team1">
                        </a>
                        <div class="d-flex flex-column justify-content-center">
                          <p class="text-sm px-1 font-weight-bold">Dewa Kayika</p>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-sm text-center font-weight-bold"> Medium </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-warning"> waiting Talent </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success"> Apply </span>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="../assets/img/small-logos/webtoon.png" class="avatar avatar-sm me-3" alt="xd">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Keiken Ninzu </h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-sm font-weight-bold"> 27 </span>
                    </td>
                    <td>
                      <div class="avatar-group mt-2 d-flex">
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                          <img src="../assets/img/team-3.jpg" alt="team1">
                        </a>
                        <div class="d-flex flex-column justify-content-center">
                          <p class="text-sm px-1 font-weight-bold">Dewa Kayika</p>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-sm text-center font-weight-bold"> Medium </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-warning"> waiting Talent </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success"> Apply </span>
                    </td>
                  </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card h-100">
        <div class="card-header pb-0">
          <h6>Project Status</h6>
          <p class="text-sm">
             Keiken Ninzu <span class="font-weight-bold">27</span>
          </p>
        </div>
        <div class="card-body p-3">
          <div class="timeline timeline-one-side">
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                    <img src="../assets/img/small-logos/Assign.png" alt="team1">
                </a>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">Project Assign</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                    <img src="../assets/img/small-logos/QC.png" alt="team1">
                </a>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">QC First Draft</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                    <img src="../assets/img/small-logos/Draft.png" alt="team1">
                </a>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">First Draft Submitted</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                    <img src="../assets/img/small-logos/Revisi.png" alt="team1">
                </a>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">Revision 1 Assign</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                    <img src="../assets/img/small-logos/QC.png" alt="team1">
                </a>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">QC Second Draft</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                    <img src="../assets/img/small-logos/Draft.png" alt="team1">
                </a>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">Second Draft Submitted</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">17 DEC 4:54 AM</p>
              </div>
            </div>
            <div class="timeline-block">
                <span class="timeline-step">
                  <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                      <img src="../assets/img/small-logos/Done.png" alt="team1">
                  </a>
                </span>
                <div class="timeline-content">
                  <h6 class="text-dark text-sm font-weight-bold mb-0">Approved</h6>
                  <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">25 DEC 4:54 AM</p>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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

