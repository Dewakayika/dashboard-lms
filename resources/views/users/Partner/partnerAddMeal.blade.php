@section('title')
    Partner Create Meal
@endsection

@extends('Users.Partner.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('partner#index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('partner#index') }}">Partner Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Drivers</li>
            </ol>
        </nav>
    </div>
    <style>
        .file-upload-input {
            position: absolute;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            outline: none;
            opacity: 0;
            cursor: pointer;
        }

        .image-title-wrap {
            padding: 0 15px 15px 15px;
            color: #222;
        }

        .drag-text {
            text-align: center;
        }
    </style>


    <!-- END breadcrumb -->

    <!-- Start content -->
    <div id="fh5co-blog-section" class="fh5co-section-gray" style="height: 1100px">

        <div class="container h-screen">
            <div class="row row-bottom-padded-md ">
                <div class="container">
                    <div class="row">
                        <form class="flex flex-col items-center justify-center" action="{{ route('partner#saveMeal') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-6 animate-box my-2">
                                <h1 class="animate-box text-3xl font-bold text-center">
                                    Add Your Own Meals
                                </h1>
                            </div>
                            <div class="col-lg-6" style="padding-left: 60px">
                                <div class="row">
                                    <div>
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Menu Title</label>
                                            <input type="text" class="form-control"
                                                placeholder="Put your menu title here" name="meal_title" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group animate-box">
                                            <label for="basic-url">Menu Image</label>
                                            <div class="file-upload">
                                                <div
                                                    class="image-upload-wrap relative w-72 cursor-pointer z-50 border-mow-shine-yellow border-4 rounded border-dashed hover:bg-mow-shine-yellow hover:border-white">
                                                    <input class="file-upload-input -z-[1]" id="file-uploads"
                                                        name="meal_image" type='file' onchange="readURL(this);"
                                                        accept="image/*" />
                                                    <div class="drag-text">
                                                        <h3 id="file-upload-filename">Drag and drop a file or select add
                                                            Image</h3>
                                                    </div>
                                                </div>
                                                <div class="file-upload-content hidden w-72">
                                                    <img class="file-upload-image rounded pb-3" src="#"
                                                        alt="your image" />
                                                    <div class="image-title-wrap">
                                                        <button type="button" onclick="removeUpload()"
                                                            class="btn btn-outline-danger">Remove <span
                                                                class="image-title">Uploaded
                                                                Image</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="form-group animate-box">
                                                <label for="basic-url">Menu Description</label>
                                                <textarea class="form-control" id="" cols="30" rows="7" placeholder="Put your menu description here"
                                                    name="meal_description" required></textarea>
                                            </div>
                                        </div>
                                        <div>
                                            <input type="hidden" class="form-control"
                                                placeholder="Put your partner name here" name="partner"
                                                value="{{ $partnerData->id }}" required>
                                        </div>
                                        <div>
                                            <div class="form-group animate-box">
                                                <label for="basic-url">Menu Type</label>
                                                <select name="meal_type" class="form-control" required>
                                                    <option value="" disabled selected hidden>Please Select One Below
                                                    </option>
                                                    <option>Hot</option>
                                                    <option>Cold</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mt-10 border p-3 rounded-md">
                                            <h3 class="text-2xl">Menu Safety</h3>
                                            <input type="checkbox" id="text" name="text" value="text" required>
                                            <label for="text">No MSG</label><br>
                                            <input type="checkbox" id="text" name="text" value="text" required>
                                            <label for="text">No Artificial Preservative</label><br>
                                            <input type="checkbox" id="text" name="text" value="text" required>
                                            <label for="no_msg">No Artificial Sweeteners</label><br>
                                            <input type="checkbox" id="text" name="text" value="text" required>
                                            <label for="no_msg">No Artificial Coloring</label>
                                        </div>
                                        <div>
                                            <div class="mt-4 form-group animate-box">
                                                <input type="submit" value="Create"
                                                    class="bg-yellow-400 py-2 px-3 rounded-md text-white text-lg hover:bg-yellow-500">
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
    <script>
        const inputImg = document.querySelector(".image-upload-wrap");
        const inputEl = document.querySelector("input[type=file]");

        inputImg.addEventListener("click", () => {
            inputEl.click();
        })

        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.image-upload-wrap').hide();

                    $('.file-upload-image').attr('src', e.target.result);
                    $('.file-upload-content').show();

                    $('.image-title').html(input.files[0].name);
                };

                reader.readAsDataURL(input.files[0]);

            } else {
                removeUpload();
            }
        }

        function removeUpload() {
            $('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
        }
        $('.image-upload-wrap').bind('dragover', function() {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function() {
            $('.image-upload-wrap').removeClass('image-dropping');
        });
    </script>
    <!-- End content-->
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
@endsection
