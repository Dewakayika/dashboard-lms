@section('title')
    Admin Update Feedback
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
                <li class="breadcrumb-item active" aria-current="page">Update Feedback</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div id="fh5co-blog-section" class="fh5co-section-gray">
        <div class="container">
            <div class="row row-bottom-padded-md ">
                <div class="container">
                    <div class="row">
                        <form class="flex flex-col items-center justify-center"
                            action="{{ route('admin#updateFeedback', $editFeedback->id) }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="col-lg-6 animate-box my-2">
                                <h1 class="animate-box text-3xl font-bold text-center">
                                    Update Feedback
                                </h1>
                            </div>
                            <div class="col-lg-6" style="padding-left: 60px">
                                <div class="row">
                                    @csrf
                                    <div>
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Feedback Id</label>
                                            <input type="text" class="form-control" readonly name="id"
                                                value="{{ old('id', $editFeedback->id) }}">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group animate-box">
                                            <label for="basic-url">User Id</label>
                                            <input type="text" class="form-control" readonly name="user_id"
                                                value="{{ old('user_id', $editFeedback->user_id) }}">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Feedback Subject</label>
                                            <input type="text" class="form-control" name="feedback_subject"
                                                value="{{ old('feedback_subject', $editFeedback->feedback_subject) }}">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Feedback Message</label>
                                            <textarea class="form-control" id="" cols="30" rows="7"
                                                name="feedback_message" value="{{ old('feedback_message', $editFeedback->feedback_message) }}">{{ old('feedback_message', $editFeedback->feedback_message) }}</textarea>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mt-4 form-group animate-box">
                                            <input type="submit" value="Update"
                                                class="bg-blue-500 py-2 px-3 rounded-md text-white text-lg hover:bg-blue-700">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content-->
@endsection
