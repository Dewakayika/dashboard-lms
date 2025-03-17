@extends('users.Admin.layouts.auth')

@section('content')

  <div class="row">

    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
      <a class="card" href="{{route('admin#timeStatistic')}}">
        <div class="card-body bg-white p-3 border-radius-xl">
          <div class="row">
            <div class="col-8">
                <div class="icon icon-shape bg-green-200 shadow opacity-95 text-center border-radius-section">
                    <i class="fa-regular fa-clock fa-lg" style="color: #1ea079;"></i>
                  </div>
              <div class="numbers mt-4">
                <h3 class="font-weight-bolder text-gray-700 mb-0">
                    {{$formatedDuration }}
                  </h3>
                <p class="text-sm mb-0 text-capitalize text-black font-weight-light">Average Project Serving Time</p>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>


    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body bg-white p-3 border-radius-xl">
            <div class="row">
              <div class="col-8">
                  <div class="icon icon-shape bg-blue-200 shadow text-center border-radius-section">
                    <i class="fa-regular fa-rectangle-list fa-lg" style="color: #2e86c1 "></i>
                    </div>
                <div class="numbers mt-4">
                  <h3 class="font-weight-bolder text-gray-700 mb-0">
                        {{$totalPanel}}
                    </h3>
                  <p class="text-sm mb-0 text-capitalize text-black font-weight-light">Total Working Panel</p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body bg-white p-3 border-radius-xl">
            <div class="row">
              <div class="col-8">
                  <div class="icon icon-shape bg-red-200 shadow text-center border-radius-section">
                    <i class="fa-regular fa-file-lines fa-lg" style="color: #e67e22;" ></i>
                  </div>
                <div class="numbers mt-4">
                      <h3 class="font-weight-bolder text-gray-700 mb-0">
                        {{$totalProjectThisYear}}
                      </h3>
                  <p class="text-sm mb-0 text-black text-capitalize font-weight-light">Total Project</p>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
  </div>

  @if (Session::has('roleCreated'))
  <div class="alert alert-warning animate-box" role="alert">
      {{ Session::get('roleCreated') }}
  </div>
  @endif @if (Session::has('roleDeleted'))
  <div class="alert alert-warning animate-box" role="alert">
      {{ Session::get('roleDeleted') }}
  </div>
  @endif @if (Session::has('userUpdated'))
  <div class="alert alert-warning animate-box" role="alert">
      {{ Session::get('userUpdated') }}
  </div>
  @endif

  <div class="row my-4">
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4" >
        <div class="card " style="padding: 20px" >
            <div class="card-header d-flex justify-content-between align-items-center">
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

            <div>
                <canvas id="myChart"></canvas>
            </div>
          </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">On Going Project</h6>
            </div>
            <div class="card-body d-flex flex-column justify-content-between">
                <ul class="list-group h-100 d-flex flex-column justify-content-between">
                    <li class="list-group-item border-0 d-flex align-items-center mb-2">
                        <div class="d-flex align-items-start flex-row gap-3 justify-content-center">
                            <div class="icon icon-shape bg-yellow-200 text-center border-radius-2xl">
                                <i class="fa-regular fa-hourglass-half" style="color: #f1c40f"></i>
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Waiting Talent</h6>
                                <p class="text-normal text-xs">Waiting Talent approved Project</p>
                            </div>
                        </div>
                        <h4 class="pe-3 ps-0 mb-0 ms-auto d-flex justify-content-center">{{$projectWaiting}}</h4>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-3 mb-2">
                        <div class="d-flex align-items-start flex-row gap-3 justify-content-center">
                            <div class="icon icon-shape bg-blue-200 text-center border-radius-2xl">
                                <i class="fa-regular fa-chess-queen" style="color: #2e86c1"></i>
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Project Assign</h6>
                                <p class="text-normal text-xs">Project Applied, still working on it</p>
                            </div>
                        </div>
                        <h4 class="pe-3 ps-0 mb-0 ms-auto d-flex justify-content-center">{{$projectAssign}}</h4>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-3 mb-2">
                        <div class="d-flex align-items-start flex-row gap-3 justify-content-center">
                            <div class="icon icon-shape bg-orange-200 text-center border-radius-2xl">
                                <i class="fa-regular fa-pen-to-square" style="color: #d35400"></i>
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Project QC</h6>
                                <p class="text-normal text-xs">Waiting QC agent check the project</p>
                            </div>
                        </div>
                        <h4 class="pe-3 ps-0 mb-0 ms-auto d-flex justify-content-center">{{$projectQC}}</h4>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-3 mb-2">
                        <div class="d-flex align-items-start flex-row gap-3 justify-content-center">
                            <div class="icon icon-shape bg-blue-200 text-center border-radius-2xl">
                                <i class="fa-regular fa-file-lines" style="color: #2e86c1"></i>
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Project Draft</h6>
                                <p class="text-normal text-xs">Project with status draft submitted</p>
                            </div>
                        </div>
                        <h4 class="pe-3 ps-0 mb-0 ms-auto d-flex justify-content-center">{{$projectDraft}}</h4>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-3 mb-2">
                        <div class="d-flex align-items-start flex-row gap-3 justify-content-center">
                            <div class="icon icon-shape bg-red-200 text-center border-radius-2xl">
                                <i class="fa-regular fa-file-excel" style="color: #c0392b"></i>
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Project Revision</h6>
                                <p class="text-normal text-xs">Revision note release by admin</p>
                            </div>
                        </div>
                        <h4 class="pe-3 ps-0 mb-0 ms-auto d-flex justify-content-center">{{$projectRevise}}</h4>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-3 mb-2">
                        <div class="d-flex align-items-start flex-row gap-3 justify-content-center">
                            <div class="icon icon-shape bg-green-200 text-center border-radius-2xl">
                                <i class="fa-regular fa-thumbs-up" style="color: #28b463"></i>
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Project Completed</h6>
                                <p class="text-normal text-xs">Number of project completed</p>
                            </div>
                        </div>
                        <h4 class="pe-3 ps-0 mb-0 ms-auto d-flex justify-content-center">{{$projectCompleted}}</h4>
                    </li>
                </ul>
            </div>
        </div>
    </div>
  </div>

  <div class="col-lg-12  col-md-6 mb-md-0 mb-4" >
    <div class="card" style="min-height: 400px;"  >
      <div class="card-header pb-0">
        <div class="row">
          <div class="w-full mx-auto  d-flex align-items-center justify-content-between">
              <h6 class="text-weight-bolder">Project Offer</h6>
              <div class="d-flex gap-2">
              <a class="badge badge-xs bg-primary text-sm font-weight-bold mb-0 text-white hover:bg-secondary" href="# " data-bs-toggle="modal" data-bs-target="#createProjectModal">
                  <i class="fa-solid fa-plus text-white"></i>
                  <span class="px-2">New Project</span>
              </a>
              <a class="badge badge-xs bg-secondary text-sm font-weight-bold mb-0 text-white hover:bg-secondary" href="# " data-bs-toggle="modal" data-bs-target="#uploadProjectModal">
                <i class="fa-solid fa-plus text-white"></i>
                  <span class="px-2">Upload CSV Project</span>
              </a>
              </div>
          </div>
        </div>
      </div>
      @if ($projectsList->isEmpty())
      <div class="text-center d-flex align-items-center justify-content-center">
          <div class="mb-3">
              <img src="{{ asset('/assets/img/ilustration/NoDocuments.svg')}}" class="h-11 w-11">
              <p class="text-xs">There's no Project Offer yet</p>
          </div>
      </div>
      @else
      <div class="card-body px-0 pb-2">
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project Type</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comic Name</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Episode Number</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Talent QC</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $projectsList as $project )
              <tr>
                <td class="align-middle text-center text-sm">
                    <span class="text-sm font-weight-bold"> {{ optional($project->projectType)->name ?? 'N/A' }} </span>
                </td>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $project->comic_name }}</h6>
                    </div>
                  </div>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-sm font-weight-bold"> {{ $project->chapter_number }} </span>
                </td>
                <td>
                  <div class="avatar-group mt-2 d-flex">
                    <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom">
                    </a>
                    <div class="d-flex flex-column justify-content-center">
                      <p class="text-sm px-1 font-weight-bold">{{ $project->talent_qc }}</p>
                    </div>
                  </div>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-warning"> {{ $project->status }}</span>
                </td>
                <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-info share-project me-2"
                          data-bs-toggle="modal"
                          data-bs-target="#shareToWhatsAppModal"
                          data-project-id="{{ $project->id }}"
                          style="cursor: pointer;">
                        Share Project
                    </span>
                    <span class="badge badge-sm bg-gradient-warning edit-project me-2"
                          data-bs-toggle="modal"
                          data-bs-target="#editProjectModal"
                          data-project-id="{{ $project->id }}"
                          data-project-name="{{ $project->comic_name }}"
                          data-project-type="{{ optional($project->projectType)->id }}"
                          data-chapter-number="{{ $project->chapter_number }}"
                          data-talent-qc="{{ $project->talent_qc }}"
                          data-file="{{ $project->file }}"
                          style="cursor: pointer;">
                        Edit
                    </span>
                    <span class="badge badge-sm bg-gradient-danger delete-project"
                          data-bs-toggle="modal"
                          data-bs-target="#deleteProjectModal"
                          data-project-id="{{ $project->id }}"
                          data-project-name="{{ $project->comic_name }}"
                          style="cursor: pointer;">
                        Delete
                    </span>
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
          @if ($projectsList->hasMorePages())
          <ul class="pagination justify-content-center">
              @if ($projectsList->onFirstPage())
                  <li class="page-item disabled px-1">
                      <span class="page-link"><i class="fa-solid fa-backward"></i></span>
                  </li>
              @else
                  <li class="page-item px-1">
                      <a class="page-link" href="{{ $projectsList->previousPageUrl() }}" aria-label="Previous"><i class="fa-solid fa-backward"></i></a>
                  </li>
              @endif

              @foreach ($projectsList->getUrlRange(1, $projectsList->lastPage()) as $page => $url)
                  <li class="page-item px-1 {{ $page == $projectsList->currentPage() ? 'active' : '' }}">
                      <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                  </li>
              @endforeach

              @if ($projectsList->hasMorePages())
                  <li class="page-item px-1">
                      <a class="page-link" href="{{ $projectsList->nextPageUrl() }}" aria-label="Next"><i class="fa-solid fa-forward"></i></a>
                  </li>
              @else
                  <li class="page-item disabled px-1">
                      <span class="page-link"><i class="fa-solid fa-forward"></i></span>
                  </li>
              @endif
          </ul>
          @else

          @endif
        </div>
      </div>
      @endif
    </div>
  </div>


  {{-- Share Project --}}
  <div class="modal fade" id="shareToWhatsAppModal" tabindex="-1" aria-labelledby="shareToWhatsAppModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content rounded-3 shadow-lg">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="shareToWhatsAppModalLabel">Share New Project Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="px-3 pt-3" style="max-height: 70vh; overflow-y: auto;">
                <p class="text-xs text-left"><strong>Subject:</strong> <span id="modal-subject"></span></p>
                <p class="text-xs text-left"><strong>Project Name:</strong> <span id="modal-comic-name"></span></p>
                <p class="text-xs text-left"><strong>Chapter Number:</strong> <span id="modal-chapter-number"></span></p>
                <p class="text-xs text-left"><strong>QC:</strong> <span id="modal-talent-qc"></span></p>
                <p class="text-xs text-left"><strong>Status:</strong> <span id="modal-status"></span></p>
                <a id="whatsappLink" href="#" target="_blank" class="btn w-100 mt-3 text-white" style="background-color: #0c9d08">
                    <i class="fa-brands fa-whatsapp px-2" style="color: #ffffff;"></i>
                    Share to WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Delete Project Modal --}}
<div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="deleteProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProjectModalLabel">Delete Project?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete project "<strong id="project-name-to-delete"></strong>"? This action cannot be undone.</p>
            </div>
            <div class="modal-footer d-flex justify-content-between border-0">
                <button type="button" class="modal-btn modal-btn-cancel" style="width: 45%;" data-bs-dismiss="modal">Cancel</button>
                <form id="delete-project-form" action="" method="POST" style="width: 45%;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="modal-btn modal-btn-continue w-100">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Edit Project Modal --}}
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="px-3 pt-3">
                <form id="edit-project-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                        <label for="edit_project_type_id" class="text-md text-dark">Project Type</label>
                        <select name="project_type_id" id="edit_project_type_id" class="form-control" required>
                            <option value="">Please select project type</option>
                            @foreach($projectTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="comic_name" class="text-md text-dark">Comic Name</label>
                        <input type="text" name="comic_name" id="edit_comic_name" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label for="edit_chapter_number" class="text-md text-dark">Chapter Number</label>
                        <input type="number" name="chapter_number" id="edit_chapter_number" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label for="edit_talent_qc" class="text-md text-dark">Select Talent QC</label>
                        <select name="talent_qc" id="edit_talent_qc" class="form-control" required>
                            <option value="">Please select Talent QC</option>
                            @foreach ($talentQc as $Qc)
                                <option value="{{ $Qc->id }}">{{ $Qc->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="edit_file" class="text-md text-dark">Link Project</label>
                        <input type="text" name="file" id="edit_file" class="form-control" required>
                    </div>

                    <div class="modal-footer d-flex justify-content-between border-0 px-0">
                        <button type="button" class="modal-btn modal-btn-cancel" style="width: 45%;" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="modal-btn modal-btn-continue" style="width: 45%;">Update Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const projects = {!! json_encode($projectsList->toArray()) !!};
        console.log('All projects:', projects); // Debug log

        document.querySelectorAll('.share-project').forEach(button => {
            button.addEventListener('click', function() {
                const projectId = this.getAttribute('data-project-id');
                console.log('Clicked project ID:', projectId); // Debug log

                const project = projects.data.find(p => p.id == projectId);
                console.log('Found project:', project); // Debug log

                if (project) {
                    // Update modal content
                    document.getElementById('modal-subject').textContent = 'New Project Posted!';
                    document.getElementById('modal-comic-name').textContent = project.comic_name;
                    document.getElementById('modal-chapter-number').textContent = project.chapter_number;
                    document.getElementById('modal-talent-qc').textContent = project.talent_qc;
                    document.getElementById('modal-status').textContent = project.status;

                    // Update WhatsApp link
                    const whatsappLink = document.getElementById('whatsappLink');
                    whatsappLink.onclick = function(e) {
                        e.preventDefault();
                        const message =
                                    `*New Project Posted!*\n` +
                                    `Project Name: ${project.comic_name}\n` +
                                    `Chapter Number: ${project.chapter_number}\n` +
                                    `QC: ${project.talent_qc}\n` +
                                    `Status: ${project.status}\n` +
                                    `\n` +
                                    `Apply Now on Our Dashboard! dashboard.padmastudio.io`;
                        const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;
                        window.open(whatsappUrl, '_blank');
                    };
                }
            });
        });

        // Edit project functionality
        document.querySelectorAll('.edit-project').forEach(button => {
            button.addEventListener('click', function() {
                const projectId = this.getAttribute('data-project-id');
                const projectName = this.getAttribute('data-project-name');
                const projectType = this.getAttribute('data-project-type');
                const chapterNumber = this.getAttribute('data-chapter-number');
                const talentQc = this.getAttribute('data-talent-qc');
                const file = this.getAttribute('data-file');

                // Update form action
                const form = document.getElementById('edit-project-form');
                form.action = `/admin/projects/${projectId}`;

                // Fill form fields
                document.getElementById('edit_project_type_id').value = projectType;
                document.getElementById('edit_comic_name').value = projectName;
                document.getElementById('edit_chapter_number').value = chapterNumber;
                document.getElementById('edit_talent_qc').value = talentQc;
                document.getElementById('edit_file').value = file;
            });
        });

        // Delete project functionality
        document.querySelectorAll('.delete-project').forEach(button => {
            button.addEventListener('click', function() {
                const projectId = this.getAttribute('data-project-id');
                const projectName = this.getAttribute('data-project-name');

                // Update the modal
                document.getElementById('project-name-to-delete').textContent = projectName;

                // Update the form action
                const form = document.getElementById('delete-project-form');
                form.action = `/admin/projects/${projectId}/delete`;
            });
        });
    });
</script>


  <div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProjectModalLabel">Create New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="px-3 pt-3">
                <form action="{{ route('projects#store') }}" method="POST" enctype="multipart/form-data" role="form text-left">
                    @csrf
                    <div class="mb-2">
                      <label for="project_type_id" class="text-md text-dark">Project Type</label>
                      <select name="project_type_id" id="project_type_id" class="form-control" required>
                          <option value="">Please select project type</option>
                          @foreach($projectTypes as $type)
                              <option value="{{ $type->id }}">{{ $type->name }}</option>
                          @endforeach
                      </select>
                      @error('project_type_id')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="mb-2">
                      <label for="comic_name" class="text-md text-dark">Comic Name</label>
                      <input type="text" name="comic_name" class="form-control" placeholder="Example Keiken Ninzu" required>
                      @error('comic_name')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="mb-2 chapter-field" >
                      <label for="chapter_number" class="text-md text-dark">Chapter Number</label>
                      <input type="number" name="chapter_number" class="form-control" placeholder="Example 17, 18, 19">
                      @error('chapter_number')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="mb-2">
                      <label for="talent_qc" class="text-md text-dark">Select Talent QC</label>
                      <select name="talent_qc" class="form-control selector" required>
                          <option value="">Please select Talent QC</option>
                          @foreach ($talentQc as $Qc)
                              <option value="{{ $Qc->id }}">{{ $Qc->name }}</option>
                          @endforeach
                      </select>
                      @error('talent_qc')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="mb-2">
                      <label for="file" class="text-md text-dark">Link Project</label>
                      <input type="text" name="file" class="form-control" placeholder="Box storage link" required>
                      @error('file')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-dark w-100 my-4">Create Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
  <!-- Modal Upload CSV -->
<div class="modal fade" id="uploadProjectModal" tabindex="-1" aria-labelledby="uploadProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
<div class="modal-content rounded-3 shadow-lg">
    <div class="modal-header border-0">
        <h5 class="modal-title" id="uploadProjectModalLabel">Upload CSV File</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body px-4 pt-4">
        <!-- Template Download Link -->
        <div class="mb-3">
            <p class="mb-2"><i class="fas fa-info-circle"></i> Download the CSV template first:</p>
            <a href="https://docs.google.com/spreadsheets/d/1Mf_TQ22XeGZWQUBzRHu8n9p6ZnJJj4p_PKKWVaZJFtY/edit?usp=sharing"
               target="_blank"
               class="btn btn-outline-primary btn-sm">
                <i class="fas fa-download"></i> Download CSV Template
            </a>
        </div>

        <!-- Form Upload CSV -->
        <form id="csvUploadForm" action="{{ route('submit.csv') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <label for="csvFileInput" class="form-label fw-bold">Choose CSV File</label>
            <input type="file" name="csv_file" class="form-control p-2 border-0 rounded-3 shadow-sm" id="csvFileInput" accept=".csv">
            <button type="submit" class="btn btn-primary w-100 mt-3">Upload CSV</button>
        </form>

        <!-- Preview Table (Muncul setelah file dipilih) -->
        <div id="previewTableOverview" class="d-none">
            <h6 class="fw-bold">Preview Data</h6>
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Project Type</th>
                        <th>Comic Name</th>
                        <th>Chapter</th>
                        <th>Talent QC</th>
                        <th>Talent</th>
                        <th>Panels</th>
                        <th>Finish Date</th>
                        <th>File</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="csvTableBody" class="table-responsive">
                    <!-- Data akan dimasukkan lewat JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Table Management Object
        const TableManager = {
            // Constants
            SELECTORS: {
                projectTypeFilter: '#projectTypeFilter',
                projectTypeSelect: '#project_type_id',
                chapterField: '.chapter-field',
                comicNameInput: '#comic_name',
                csvFileInput: '#csvFileInput',
                csvTableBody: '#csvTableBody',
                previewTable: '#previewTableOverview',
                tables: '.table'
            },

            // Initialize all table functionality
            init: function() {
                this.initProjectTypeFilter();
                this.initProjectTypeSelect();
                this.initCSVUpload();
                this.setupTableScrolling();
            },

            // Setup scrollable tables
            setupTableScrolling: function() {
                const tables = document.querySelectorAll(this.SELECTORS.tables);
                tables.forEach(table => {
                    const wrapper = table.parentElement;
                    if (!wrapper.style.maxHeight) {
                        wrapper.style.maxHeight = '400px';
                        wrapper.style.overflowY = 'auto';
                    }

                    const thead = table.querySelector('thead');
                    if (thead) {
                        thead.style.position = 'sticky';
                        thead.style.top = '0';
                        thead.style.backgroundColor = 'white';
                        thead.style.zIndex = '1';
                    }
                });
            },

            // Project Type Filter functionality
            initProjectTypeFilter: function() {
                const filterSelect = document.querySelector(this.SELECTORS.projectTypeFilter);
                if (filterSelect) {
                    filterSelect.addEventListener('change', () => this.filterTables(filterSelect.value));
                }
            },

            filterTables: function(selectedType) {
                selectedType = selectedType.toLowerCase();
                const tables = document.querySelectorAll(this.SELECTORS.tables);

                tables.forEach(table => {
                    const rows = table.querySelectorAll('tbody tr');
                    let hasVisibleRows = false;

                    rows.forEach(row => {
                        const typeCell = row.querySelector('td:first-child');
                        if (!typeCell) return;

                        const projectType = typeCell.textContent.toLowerCase();
                        const shouldShow = !selectedType || projectType.includes(selectedType);
                        row.style.display = shouldShow ? '' : 'none';
                        if (shouldShow) hasVisibleRows = true;
                    });

                    // Handle "no records" message
                    const noRecordsRow = table.querySelector('tbody tr td[colspan]')?.closest('tr');
                    if (noRecordsRow) {
                        noRecordsRow.style.display = hasVisibleRows ? 'none' : '';
                    }
                });
            },

            // Project Type Select functionality
            initProjectTypeSelect: function() {
                const projectTypeSelect = document.querySelector(this.SELECTORS.projectTypeSelect);
                const chapterField = document.querySelector(this.SELECTORS.chapterField);
                const comicNameInput = document.querySelector(this.SELECTORS.comicNameInput);

                if (projectTypeSelect && chapterField && comicNameInput) {
                    chapterField.style.display = 'none';

                    projectTypeSelect.addEventListener('change', function() {
                        const selectedType = this.options[this.selectedIndex];
                        if (selectedType.value) {
                            chapterField.style.display = 'block';
                            const isComicType = selectedType.text.toLowerCase().includes('comic') ||
                                              selectedType.text.toLowerCase().includes('webtoon');
                            comicNameInput.placeholder = isComicType ?
                                `Enter comic name (e.g. ${selectedType.text} Chapter)` :
                                'Enter project name';
                        } else {
                            chapterField.style.display = 'none';
                        }
                    });
                }
            },

            // CSV Upload functionality
            initCSVUpload: function() {
                const csvInput = document.querySelector(this.SELECTORS.csvFileInput);
                if (csvInput) {
                    csvInput.addEventListener('change', (event) => this.handleCSVUpload(event));
                }
            },

            handleCSVUpload: function(event) {
                const file = event.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = (e) => {
                    const text = e.target.result;
                    const rows = text.split('\n').map(row => row.split(',').map(cell => cell.trim()));
                    if (rows.length > 1) {
                        this.populateCSVTable(rows.slice(1)); // Skip header row
                    }
                };
                reader.readAsText(file);
            },

            populateCSVTable: function(rows) {
                const tableBody = document.querySelector(this.SELECTORS.csvTableBody);
                const previewTable = document.querySelector(this.SELECTORS.previewTable);

                if (tableBody && previewTable) {
                    tableBody.innerHTML = '';
                    rows.forEach(row => {
                        if (row.length >= 8) {
                            const [projectType, comicName, chapterNumber, talentQc, talent, panels, finishDate, file, status] = row;
                            tableBody.innerHTML += `
                                <tr>
                                    <td>${projectType || 'N/A'}</td>
                                    <td>${comicName || 'N/A'}</td>
                                    <td>${chapterNumber || 'N/A'}</td>
                                    <td>${talentQc || 'N/A'}</td>
                                    <td>${talent || 'N/A'}</td>
                                    <td>${panels || '0'}</td>
                                    <td>${finishDate || '-'}</td>
                                    <td><a href="${file || '#'}" target="_blank">${file ? 'File Link' : 'No Link'}</a></td>
                                    <td>${status || 'Done'}</td>
                                </tr>`;
                        }
                    });
                    previewTable.classList.remove('d-none');
                    this.setupTableScrolling(); // Ensure new table is scrollable
                }
            }
        };

        // Initialize all table functionality
        TableManager.init();
    });
</script>



<script>
    function confirmApply(projectId) {
        var modalId = 'confirmApplyModal-' + projectId;
        var modal = new bootstrap.Modal(document.getElementById(modalId));
        modal.show();
    }
</script>



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
                    backgroundColor: 'rgba(255, 154, 154 )',
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
                                // Use full month format for tooltip
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


    <script>
        const ctx2 = document.getElementById('radarChart').getContext('2d');

        new Chart(ctx2, {
            type: 'bar',
            indexAxis: 'y',
            data: {
                labels: ['Waiting Talent', 'Project Assign', 'Project QC', 'Project Draft', 'Project Revision', 'Project Completed'],
                datasets: [{
                    label: 'Project Status',
                    data: [{{$projectWaiting}}, {{$projectAssign}}, {{$projectQC}}, {{$projectDraft}}, {{$projectRevise}}, {{$projectCompleted}}],
                    backgroundColor: [
                        '#f1c40f',
                        '#d35400',
                        '#2e86c6',
                        '#2e86c1',
                        '#c0392b',
                        '#28b463'
                    ],
                    borderRadius: 6,
                    borderSkipped: false,
                    barPercentage: 0.7,
                    categoryPercentage: 0.8
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            stepSize: 1,
                            precision: 0,
                            font: {
                                family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif',
                                size: 12
                            }
                        }
                    },
                    y: {
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
                    legend: {
                        display: false
                    },
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
                        displayColors: true,
                        borderColor: 'rgba(0, 0, 0, 0.1)',
                        borderWidth: 1,
                        callbacks: {
                            title: function(tooltipItems) {
                                return tooltipItems[0].label;
                            },
                            label: function(context) {
                                return `Total Projects: ${context.parsed.x}`;
                            }
                        }
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
            },
            plugins: [{
                afterDraw: function(chart) {
                    var ctx = chart.ctx;
                    chart.data.datasets.forEach(function(dataset, datasetIndex) {
                        var meta = chart.getDatasetMeta(datasetIndex);
                        meta.data.forEach(function(bar, index) {
                            var data = dataset.data[index];

                            // Only draw text if the bar is wide enough
                            if (bar.width > 20) {
                                ctx.save();
                                ctx.fillStyle = 'white';
                                ctx.font = '12px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif';
                                ctx.textAlign = 'left';
                                ctx.textBaseline = 'middle';

                                // Position text inside the bar
                                var x = bar.x + 10; // 10px padding from start of bar
                                var y = bar.y;

                                // Draw text
                                ctx.fillText(data, x, y);
                                ctx.restore();
                            }
                        });
                    });
                }
            }]
        });

    </script>

@endsection


