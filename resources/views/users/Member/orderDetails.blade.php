@section('title')
    Member Dashboard
@endsection

@extends('users.Member.layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('member#orderSave', $mealData->id) }}" method="POST">
            @csrf
            <div class="d-flex justify-content-center row ">

                <div class="col-md-9 ">
                    <div class="row bg-white border rounded shadow-lg bg-white rounded">
                        <h1 class="h4 fw-bold mb-3 text-center mt-3">Order Details</h1>
                        <div class="col-md-3 mt-3 mb-4 ml-4 "><img
                                class="img-fluid img-responsive rounded product-image shadow-lg border"
                                src="{{ asset('uploads/meal/' . $mealData->meal_image) }}"></div>
                        <div class="col-md-8 mt-3 mb-4">
                            <label class="font-bold col-sm-3 control-label">Meal Order </label>
                            <input class="border-0 mt-2" style="border-0 h1" type="text" name="deliver_meal_title"
                                value=" : {{ $mealData->meal_title }}" id="" readonly>

                            <br>

                            <label class="font-bold col-sm-3 control-label">Meal Type </label>
                            <input class="border-0 mt-2" type="text" name="deliver_meal_type"
                                value=" : {{ $mealData->meal_type }}" id="" readonly>


                            <br>
                            <label class="font-bold col-sm-3 control-label">Restaurant </label>
                            <input class="border-0 mt-2 mb-2" type="text" name="partner_restaurant_name"
                                value=" : {{ $partnerData->partner_organization }}">

                            <br>
                            <label class="font-bold ">Meal Description </label>
                            <textarea class="textarea col-md-12 text-justify" rows="5" `name="meal_description" id=""
                                value="{{ $mealData->meal_description }}" readonly>{{ $mealData->meal_description }}</textarea>
                        </div>

                        <div class="col-md-12 ">
                            <hr>
                            <h1 class="h5 fw-bold mb-3 ml-5 mt-2">Deliver to </h1>
                            <div class="mb-1 spec-1 ml-9 ">
                                <div>
                                    <label class="font-bold col-sm-2 control-label">Orderer </label>
                                    <input type="text" name="member_name"
                                        value=" : {{ $memberData->member_caregiver_name }}" id="" readonly>
                                </div>
                                <div>
                                    <label class="font-bold col-sm-2 control-label">Member Email </label>
                                    <input type="text" name="member_email" value=" : {{ $userData->email }}"
                                        id="" readonly>
                                </div>
                                <div>
                                    <label class="font-bold col-sm-2 control-label">Address </label>
                                    <input class="w-25" type="text" name="member_address"
                                        value=" : {{ $userData->address }}" id="" readonly>
                                </div>

                                <div>
                                    <label class="font-bold col-sm-2 control-label">Phone Number </label>
                                    <input type="text" name="member_phone" value=" : {{ $userData->phone }}"
                                        id="" readonly>
                                </div>
                                <div class="hidden">
                                    <label class="font-bold col-sm-2 control-label">Distance</label>
                                    <input type="text" name="distance" value="{{ $distanceData }}">
                                </div>
                            </div>
                            <div class="float-right flex flex-col align-items-center align-content-center col-md-3 border-left mt-1 mb-4 ">
                                <span class="text-mow-red">(Your location is {{ $distanceData }} KM)</span>
                                <button class="btn btn-warning btn-lg px-4 me-md-2" type="submit">Send Now</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
