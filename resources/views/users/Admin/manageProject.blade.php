@extends('users.Admin.layouts.dashboard-app')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

    {{-- Filter Data Based on Project Type   --}}
    <div class="container-fluid py-4">
        <div class="row mb-2">
            <div class="col-lg-3">
                <select id="projectTypeFilter" class="form-control">
                    <option value="">All Project Types</option>
                    @foreach ($projectTypes as $type)
                        <option value="{{ $type->name }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="w-full mx-auto  d-flex align-items-center justify-content-between">
                        <h6 class="text-weight-bolder">Project Overview</h6>
                        <a class="badge badge-xs bg-primary text-sm font-weight-bold mb-0 text-white hover:bg-secondary" href="# " data-bs-toggle="modal" data-bs-target="#createProjectModal">
                            <i class="fa-solid fa-plus text-white"></i>
                            <span class="px-2">New Project</span>
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project Type</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comic Name</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Episode Number</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Talent</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Panel</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Assign Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($projectOverview->where('status', '!=', 'Done')->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div>
                                                <img src="{{ asset('/assets/img/ilustration/NoConnection.svg')}}" class="h-auto w-11" style="width: 110px; height: auto;">
                                                <p class="text-xs">There are no ongoing projects</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @else
                                @foreach ($projectOverview->sortByDesc('created_at') as $project)
                                    @if ($project->status != 'Done')
                                        <tr>
                                            <td class="align-middle text-sm ps-4">
                                                <span class="text-sm font-weight-bold">{{ optional($project->projectType)->name ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    {{-- <div>
                                                        <img src="{{asset('/assets/img/small-logos/webtoon.png')}}" class="avatar avatar-sm me-3" alt="xd">
                                                    </div> --}}
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{$project->comic_name}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-sm font-weight-bold">{{$project->chapter_number}}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-sm px-1 font-weight-bold">{{$project->talent ?? 'Still Waiting'}}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-sm px-1 font-weight-bold">{{$project->number_of_panel}}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-sm px-1 font-weight-bold">{{ \Carbon\Carbon::parse($project->created_at)->translatedFormat('D, M Y | H:i A ') }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($project->status == 'Waiting Talent')
                                                    <span class="badge badge-sm bg-gradient-warning">{{$project->status}}</span>
                                                @elseif ($project->status == 'Project Assign')
                                                    <span class="badge badge-sm bg-gradient-info">{{$project->status}}</span>
                                                @elseif (in_array($project->status, ['QC First Draft', 'QC Revise 1', 'QC Revise 2', 'QC Revise 3']))
                                                    <span class="badge badge-sm bg-gradient-warning">{{$project->status}}</span>
                                                @elseif (in_array($project->status, ['First Draft Submitted', 'Revise 1 Submitted', 'Revise 2 Submitted', 'Revise 3 Submitted']))
                                                    <span class="badge badge-sm bg-gradient-success">{{$project->status}}</span>
                                                @elseif (in_array($project->status, ['Revision 1', 'Revision 2', 'Revision 3']))
                                                    <span class="badge badge-sm bg-gradient-danger">{{$project->status}}</span>
                                                @elseif ($project->status == 'Done')
                                                    <span class="badge badge-sm bg-gradient-success">{{$project->status}}</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-danger">{{$project->status ?? 'undefined'}}</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex gap-2">
                                                @if ($project->status != 'Waiting Talent')
                                                        <a href="{{ route('admin#projectDetail', $project->id) }}" class="badge badge-sm bg-gradient-info text-white text-xs" data-toggle="tooltip" data-original-title="View Details">
                                                        Detail
                                                        </a>
                                                    @endif
                                                    <a href="#" class="badge badge-sm bg-gradient-warning text-white text-xs" data-bs-toggle="modal" data-bs-target="#editProjectModal-{{ $project->id }}">
                                                        Edit
                                                    </a>
                                                    <a href="#" class="badge badge-sm bg-gradient-danger text-white text-xs" data-bs-toggle="modal" data-bs-target="#deleteProjectModal-{{ $project->id }}">
                                                        Delete
                                                    </a>
                                                </div>

                                                <!-- Edit Project Modal -->
                                                <div class="modal fade" id="editProjectModal-{{ $project->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Project</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="px-3 pt-3">
                                                                <form action="{{ route('admin.updateProject', $project->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="mb-2">
                                                                        <label for="project_type_id" class="text-md text-dark">Project Type</label>
                                                                        <select name="project_type_id" class="form-control">
                                                                            <option value="">Please select project type</option>
                                                                            @foreach ($projectTypes as $type)
                                                                                <option value="{{ $type->id }}" {{ $project->project_type_id == $type->id ? 'selected' : '' }}>
                                                                                    {{ $type->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-2">
                                                                        <label for="comic_name" class="text-md text-dark">Comic Name</label>
                                                                        <input type="text" name="comic_name" class="form-control" value="{{ $project->comic_name }}">
                                                                    </div>

                                                                    <div class="mb-2">
                                                                        <label for="chapter_number" class="text-md text-dark">Chapter Number</label>
                                                                        <input type="text" name="chapter_number" class="form-control" value="{{ $project->chapter_number }}">
                                                                    </div>

                                                                    <div class="mb-2">
                                                                        <label for="talent_qc" class="text-md text-dark">Select Talent QC</label>
                                                                        <select name="talent_qc" class="form-control">
                                                                            <option value="">Please select Talent QC</option>
                                                                            @foreach ($talentQc as $Qc)
                                                                                <option value="{{ $Qc->id }}" {{ $project->talent_qc == $Qc->id ? 'selected' : '' }}>
                                                                                    {{ $Qc->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>


                                                                    <div class="mb-2">
                                                                        <label for="file" class="text-md text-dark">Link Project</label>
                                                                        <input type="text" name="file" class="form-control" value="{{ $project->file }}">
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

                                                <!-- Delete Project Modal -->
                                                <div class="modal fade" id="deleteProjectModal-{{ $project->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title">Delete Project</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete project <strong>{{ $project->comic_name }}</strong>?</p>
                                                                <p class="text-danger">This action cannot be undone.</p>
                                                            </div>
                                                            <div class="modal-footer d-flex justify-content-between border-0">
                                                                <form action="{{ route('admin.deleteProject', $project->id) }}" method="POST" style="width: 100%;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="d-flex justify-content-between gap-2">
                                                                        <button type="button" class="modal-btn modal-btn-cancel" style="width: 45%;" data-bs-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="modal-btn modal-btn-continue" style="width: 45%;">Delete Project</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="w-full mx-auto  d-flex align-items-center justify-content-between">
                    <h6>Completed Projects</h6>
                    <a class="badge badge-xs bg-primary text-sm font-weight-bold mb-0 text-white hover:bg-secondary" href="# " data-bs-toggle="modal" data-bs-target="#uploadProjectModal">
                        <i class="fa-solid fa-plus text-white"></i>
                        <span class="px-2">Upload CSV Project</span>
                    </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project Type</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comic Name</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Episode Number</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Talent</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Panel</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Assign Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Finish Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($projectOverview->where('status', 'Done')->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div>
                                                <img src="{{ asset('/assets/img/ilustration/NoConnection.svg')}}" class="h-auto w-11" style="width: 110px; height: auto;">
                                                <p class="text-xs">There are no completed projects</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @else
                                @foreach ($projectOverview as $project)
                                    @if ($project->status == 'Done')
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-sm font-weight-bold">{{ optional($project->projectType)->name ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    {{-- <div>
                                                        <img src="{{asset('/assets/img/small-logos/webtoon.png')}}" class="avatar avatar-sm me-3" alt="xd">
                                                    </div> --}}
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{$project->comic_name}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-sm font-weight-bold">{{$project->chapter_number}}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-sm px-1 font-weight-bold">{{$project->talent ?? 'Still Waiting'}}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-sm px-1 font-weight-bold">{{$project->number_of_panel}}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-sm px-1 font-weight-bold">{{ \Carbon\Carbon::parse($project->created_at)->translatedFormat('D, M Y | H:i A ') }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-sm px-1 font-weight-bold">{{ $project->finish_date ? \Carbon\Carbon::parse($project->finish_date)->translatedFormat('D, M Y | H:i A') : '-' }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-success">{{$project->status}}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('admin#projectDetail', $project->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View Details">
                                                        Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


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
                                    <select name="project_type_id" id="project_type_id" class="form-control selector">
                                        <option value="">Please select project type</option>
                                        @foreach ($projectTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('project_type_id')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                  <label for="comic_name" class="text-md text-dark">Comic Name</label>
                                    <input type="text" name="comic_name" id="comic_name" class="form-control" placeholder="Enter comic name">
                                  @error('comic_name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                  @enderror
                                </div>

                                <div class="mb-2 chapter-field">
                                  <label for="chapter_number" class="text-md text-dark">Chapter Number</label>
                                    <select name="chapter_number" class="form-control selector">
                                        <option value="">Please select chapter number</option>
                                        @for ($i = 1; $i <= 100; $i++)
                                            <option value="{{ $i }}">Chapter {{ $i }}</option>
                                        @endfor
                                    </select>
                                  @error('chapter_number')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                  @enderror
                                </div>

                                <div class="mb-2">
                                  <label for="talent_qc" class="text-md text-dark">Select Talent QC</label>
                                    <select name="talent_qc" class="form-control selector">
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
                                    <label for="number_of_panel" class="text-md text-dark">Number of Panel</label>
                                    <select name="number_of_panel" class="form-control selector">
                                        <option value="">Please select number of panel</option>
                                        @for ($i = 10; $i <= 200; $i += 10)
                                            <option value="{{ $i }}">{{ $i }} Panels</option>
                                        @endfor
                                    </select>
                                    @error('number_of_panel')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                  <label for="file" class="text-md text-dark">Link Project</label>
                                  <input type="text" name="file" class="form-control" placeholder="Box storage link">
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






        </div>
    </div>
</main>



@endsection
