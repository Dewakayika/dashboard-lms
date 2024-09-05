@section('title')
    Admin Update Donation
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
                <li class="breadcrumb-item"><a href="{{ route('admin#listDonation') }}">List
                        Donation</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Donation</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div id="fh5co-blog-section" class="fh5co-section-gray">

        <div class="container">
            <div class="row row-bottom-padded-md ">
                <div class="flex w-full p-4 justify-center items-center">
                    <div class="bg-white p-7 shadow-md rounded" id="form">
                        <form class="w-[450px]" action="{{ route('admin#updateDonation', $editDonation->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="col-md-4 col-form-label">Donation Amount</label>
                                <input type="text" name="amount"
                                    value="{{ old('amount', $editDonation->amount) }}" class="form-control" required="true">
                            </div>

                            <div class="mb-3">
                                <label for="timeline" class="col-form-label">Donation Description</label>
                                <textarea type="text" name="description" value="{{ old('description', $editDonation->description) }}"
                                    class="form-control" required="true">{{ old('description', $editDonation->description) }}</textarea>
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
