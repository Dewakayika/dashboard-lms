@section('title')
    Donation
@endsection

@extends('layouts.app')

@section('content')
    <section class="h-100 h-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <div class="card-body p-4 p-md-5">
                            <h1 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2 fs-1 text-center">Donor Info</h1>

                            <form class="px-md-2" action="{{ route('donor#Payment') }}" method="get">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Name" name="name_donate" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Email" name="email_donate" required>
                                </div>
                                <div class="mb-3">
                                    <h3>Gender: </h3>
                                    <div class="form-check form-check-inline mb-0 me-4">
                                        <input class="form-check-input" type="radio" id="maleGender" value="Male"
                                            name="gender_donate" required/>
                                        <label class="form-check-label" for="maleGender">Male</label>
                                    </div>

                                    <div class="form-check form-check-inline mb-0 me-4">
                                        <input class="form-check-input" type="radio" id="femaleGender" value="Female"
                                            name="gender_donate" required/>
                                        <label class="form-check-label" for="femaleGender">Female</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Address" name="address_donate" required>
                                </div>
                                <div class="mb-3">
                                    <input type="number" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Mobile phone" name="phone_donate" required>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-outline-warning" value="Submit">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $("select")
                .change(function() {
                    $(this)
                        .find("option:selected")
                        .each(function() {
                            var optionValue = $(this).attr("value");
                            if (optionValue) {
                                $(".box")
                                    .not("." + optionValue)
                                    .hide();
                                $("." + optionValue).show();
                            } else {
                                $(".box").hide();
                            }
                        });
                })
                .change();
        });
    </script>
@endsection
