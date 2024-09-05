@section('title')
    Register
@endsection

@extends('layouts.app')

@section('content')
@vite('resources/css/flying.css')
    <!-- <style type="text/css">
        #form {
            max-width: 500px;
            padding: 20px;
            margin: 50px auto;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.1);

        }

        /* coba coba */
        body {
            background: #ecf0f3;
        }

        .wrapper {
            max-width: 500px;
            min-height: 500px;
            margin: 80px auto;
            padding: 40px 30px 30px 30px;
            background-color: #ecf0f3;
            border-radius: 15px;
            box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
        }

        .logo {
            width: 80px;
            margin: auto;
        }

        .logo img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            /* border-radius: 55%; */
            /* box-shadow: 0px 0px 3px #5f5f5f,
                                        0px 0px 0px 5px #ecf0f3,
                                        8px 8px 15px #a7aaa7,
                                        -8px -8px 15px #fff; */
        }

        .wrapper .name {
            font-weight: 600;
            font-size: 1.4rem;
            letter-spacing: 1.3px;
            padding-left: 10px;
            color: #555;
        }

        .wrapper .form-field input {
            width: 100%;
            display: block;
            border: none;
            outline: none;
            background: none;
            font-size: 1.2rem;
            color: #666;
            padding: 10px 15px 10px 10px;
            /* border: 1px solid red; */
        }

        .wrapper .form-field {
            padding-left: 10px;
            margin-bottom: 20px;
            border-radius: 20px;
            box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
        }

        .wrapper .form-field .fas {
            color: #555;
        }

        .wrapper .btn {
            box-shadow: none;
            width: 50%;
            height: 40px;
            color: #fff;
            /* border-radius: 25px; */
            box-shadow: 3px 3px 3px #b1b1b1,
                -3px -3px 3px #fff;
            letter-spacing: 1.3px;
        }

        .wrapper .btn:hover {
            background-color: yellow;
        }


        .wrapper a {
            text-decoration: none;
            font-size: 0.8rem;
            color: #03A9F4;
        }

        .wrapper a:hover {
            color: #039BE5;
        }

        @media(max-width: 380px) {
            .wrapper {
                margin: 30px 20px;
                padding: 40px 15px 15px 15px;
            }

        }
    </style> -->

    <body>
        <div class="container-fluid mt-8 mb-8">
            <!-- <div class="logo">
                <img src="https://www.linkpicture.com/q/meals_on_wheels.png" alt="">
            </div> -->
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="https://bit.ly/3tHrxKW" class="img-fluid flying"
                alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <div class="mt-5 mb-8">
                <h1 class="h3 mb-3 font-bold">Sign Up</h1>
            <div>
            <x-jet-validation-errors class="mb-4 text-mow-red" />
            <form class="row mb-8" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-10 row mb-3">
                    <input type="text" placeholder="Name" name="name" class="form-control" required="true">
                </div>

                <div class="col-md-10 row mb-3">
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-4 pt-0">Gender</legend>
                        <div class="col-sm-8">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                    value="0" required="">
                                <label class="form-check-label" for="inlineRadio1" name="gender">Male</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                    value="1" required="">
                                <label class="form-check-label" for="inlineRadio2" name="gender">Female</label>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="col-md-10 row mb-3">
                    <input type="email" placeholder="Email" class="form-control" name="email" required="true">
                </div>

                <div class="col-md-10 row mb-3">
                    <input type="password" placeholder="Password" class="form-control" name="password" required="true">
                </div>

                <div class="col-md-10 row mb-3">
                    <input type="tel" placeholder="Phone Number" class="form-control" maxlength="11" required="true"
                        name="phone">
                </div>

                <div class="hidden">
                    <input type="text" name="lat">
                </div>

                <div class="hidden">
                    <input type="text" name="long">
                </div>

                <div class="form-field d-flex align-items-center">
                    <input class="" required="true" name="address" placeholder="Address" />
                </div>

                <div class="col-md-11 row mb-3">
                    <div class="row mb-3">
                        <!-- <label for="role" class=" col-form-label">Role</label> -->
                        <div class="col-sm-12" style="padding-left: 0 ;">
                            <select class="form-select role" name="role" required>
                                <option value="">Please Select Role</option>
                                <option value="intern">Intern</option>
                                <option value="talent">Tallent</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class=" d-flex align-items-center">
                    <!-- intern box -->
                    <div class="intern box">
                        <div class="row mb-3">
                            <label for="job" class="col-sm-4 col-form-label">Job</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control intern" name="job">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <!-- talent box -->
                    <div class="talent box">
                        <div class="row mb-3">
                            <label for="talent" class="col-sm-4 col-form-label">School</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control talent" name="school">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="talent" class="col-sm-4 col-form-label">Date of Birth</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control talent" name="date_of_birth">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="talent" class="col-sm-4 col-form-label">Bank Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control talent" name="bank_name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="talent" class="col-sm-4 col-form-label">Bank Account</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control talent" name="bank_account">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="d-flex align-items-start" style="padding-left: 0;">
                    <button
                    type="submit"
                    class="rounded-md px-3.5 py-2 m-1 overflow-hidden relative group cursor-pointer border-2 font-medium border-blue-600 text-blue-600 text-white">
                    <span
                        class="absolute w-64 h-0 transition-all duration-300 origin-center rotate-45 -translate-x-20 bg-blue-600 top-1/2 group-hover:h-64 group-hover:-translate-y-32 ease"></span>
                    <span
                        class="relative text-blue-600 transition duration-300 group-hover:text-white ease">Register</span>
                    </button>

                    <button
                    type="reset"
                    class="rounded-md px-3.5 py-2 m-1 overflow-hidden relative group cursor-pointer border-2 font-medium border-red-600 text-red-600 text-white">
                    <span
                        class="absolute w-64 h-0 transition-all duration-300 origin-center rotate-45 -translate-x-20 bg-red-600 top-1/2 group-hover:h-64 group-hover:-translate-y-32 ease"></span>
                    <span
                        class="relative text-red-600 transition duration-300 group-hover:text-white ease">Clear</span>
                    </button>

                </div>
                
            </form>
                </div>
           
            </div>
            
        </div>



    </body>
    <script>
        $(document).ready(function() {
            $('.role').change(function() {
                $(this).find("option:selected").each(function() {
                    var optionValue = $(this).attr("value");
                    if (optionValue) {
                        $(".box").not("." + optionValue).hide().find(".form-control").prop(
                            "required",
                            false);
                        $("." + optionValue).show('.form-control' && '.form-radio').find(
                            ".form-control" && '.form-radio').prop("required", true);
                    } else {
                        $(".box").hide();
                    }
                });
            }).change();

            getLocation();
        });
        
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            $("[name='lat']").val(position.coords.latitude);
            $("[name='long']").val(position.coords.longitude);
        }
    </script>
@endsection
