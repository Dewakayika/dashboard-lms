@extends('Users.Admin.layouts.dashboard-app')

@section('content')
    <section class="min-vh-100 mb-8">
        <div style="background-image: url('{{ asset('assets/img/home-decor-1.jpg') }}') "class="page-header justify-content-center align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg">
            <span class="mask-bg-gradient-dark">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center mx-auto">
                            <h4 class="text-white mb-2 mt-5">
                                Registration Code!
                            </h4>
                            <p class="text-lead text-white">
                                Fill in the details below to add a new registration code.
                            </p>
                        </div>
                    </div>
                </div>
            </span>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n-10">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            New Registration Code
                        </div>
                        <div class="card-body">
                            <!-- Error Handling -->
                            @if ($errors->any())
                                <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-300 rounded-md">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (Session::has('roleCreated'))
                                <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded-md">
                                    {{ Session::get('roleCreated') }}
                                </div>
                            @endif
                            <form action="{{ route('admin#storeRole') }}" method="POST" role="form text-left">
                                @csrf
                                <div class="mb-3">
                                    <input type="text"
                                            id="registration_code"
                                            name="registration_code"
                                            placeholder="Enter registration code"
                                            class="form-control"
                                            value="{{ old('registration_code') }}"
                                            required/>
                                </div>
                                <div class="mb-3">
                                    <select
                                        id="role_types"
                                        class="form-control @error('role_types') is-invalid @enderror"
                                        required
                                        name="role_types"
                                    >
                                        <option value="intern" {{ old('role_types') == 'intern' ? 'selected' : '' }}>Intern</option>
                                        <option value="talent" {{ old('role_types') == 'talent' ? 'selected' : '' }}>Talent</option>
                                        <option value="">Please Select Role</option>
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-dark w-100 my-4 mb-2">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


