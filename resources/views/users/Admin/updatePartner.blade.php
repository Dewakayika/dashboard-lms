@section('title')
    Admin Update Partner
@endsection

@extends('Users.Admin.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Admin
                        Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin#listPartner') }}">List
                        Partner</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Partner</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div id="fh5co-blog-section" class="fh5co-section-gray">

        <div class="container">
            <div class="row row-bottom-padded-md ">
                <div class="flex w-full p-4 justify-center items-center">
                    <div class="bg-white shadow-md p-7 rounded" id="form">
                        <form class="w-[500px]" action="{{ route('admin#updatePartner', $editPartner->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label">Partner Id</label>
                                <div class="col-md-8">
                                    <input type="text" name="id" readonly
                                        value="{{ old('id', $editPartner->id) }}"
                                        class="form-control" required="true">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label">Partner Organization</label>
                                <div class="col-md-8">
                                    <input type="text" name="partner_organization"
                                        value="{{ old('partner_organization', $editPartner->partner_organization) }}"
                                        class="form-control" required="true">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="timeline" class="col-md-4 col-form-label">Partnership Timeline</label>
                                <div class="col-sm-8">
                                    <input type="text" name="partnership_timeline"
                                        value="{{ old('partnership_timeline', $editPartner->partnership_timeline) }}"
                                        class="form-control" required="true">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-outline-primary" style="float: right;">Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content-->
@endsection
