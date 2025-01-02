@extends('users.Admin.layouts.dashboard-app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Home</a></li>
            <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
            <li class="breadcrumb-item active text-xs" aria-current="page">Create Project</li>
        </ol>
    </nav>

  <section class="mb-8">
    <div class="page-header align-items-start min-vh-25 pt-5 pb-11 m-3 border-radius-md" style="background-image: url('{{asset('/assets/img/webtoon.png')}}');">
      <span class="mask bg-gradient-dark opacity-6"></span>
    </div>

    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
          <div class="col-xl-6 col-lg-8 col-md-10 mx-auto">
            <div class="card z-index-0">
              <div class="card-header text-center">
                <h5 class="text-weight-bolder">Create Project</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('projects#store') }}" method="POST" enctype="multipart/form-data" role="form text-left">
                  @csrf
                  <div class="mb-2">
                    <label for="comic_name" class="text-md text-dark">Comic Name</label>
                    <input type="text" name="comic_name" class="form-control" placeholder="Example Keiken Ninzu">
                    @error('comic_name')
                      <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="mb-2">
                    <label for="chapter_number" class="text-md text-dark">Chapter Number</label>
                    <input type="number" name="chapter_number" class="form-control" placeholder="Example 17, 18, 19">
                    @error('chapter_number')
                      <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="mb-2">
                    <label for="talent_qc" class="text-md text-dark">Select Talent QC</label>
                    <select  name="talent_qc" class="form-control selector" placeholder="Select Talent QC" >
                        <option value="" class="form-control">Pelase select Talent Qc</option>
                        @foreach ($talentQc as $Qc)
                            <option class="text-black" value="{{ $Qc->id }}">{{ $Qc->name }}</option>
                        @endforeach
                    </select>
                    @error('talent_qc')
                      <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="mb-2">
                    <label for="number_of_panel" class="text-md text-dark">Total Number of Panel</label>
                    <input type="number" name="number_of_panel" class="form-control" placeholder="Example 50">
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
      </div>
  </section>

@endsection

