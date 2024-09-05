@section('title')
    Admin Update Order
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
                <li class="breadcrumb-item"><a href="{{ route('admin#listOrder') }}">List
                        Order</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Order</li>
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
                        <form class="w-[600px]" action="{{ route('admin#updateOrder', $editOrder->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="order" class="col-md-4 col-form-label">Order Id</label>
                                <div class="col-md-8">
                                    <input type="text" readonly name="id" class="form-control"
                                        value="{{ old('id', $editOrder->id) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="member" class="col-md-4 col-form-label">Member Id</label>
                                <div class="col-md-8">
                                    <input type="text" name="member_id" class="form-control"
                                        value="{{ old('member_id', $editOrder->member_id) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="meal" class="col-md-4 col-form-label">Meal Id</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="meal_id"
                                        value="{{ old('meal_id', $editOrder->meal_id) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="partner" class="col-md-4 col-form-label">Partner Id</label>
                                <div class="col-md-8">
                                    <input type="text" name="partner_id" class="form-control"
                                        value="{{ old('partner_id', $editOrder->partner_id) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="volunteer" class="col-sm-4 col-form-label">Volunteer Id</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="volunteer_id"
                                        value="{{ old('volunteer_id', $editOrder->volunteer_id) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="driver" class="col-sm-4 col-form-label">Driver Id</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="driver_id"
                                        value="{{ old('driver_id', $editOrder->driver_id) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="startdelivery" class="col-sm-4 col-form-label">Start Delivery</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="start_delivery"
                                        value="{{ old('start_delivery', $editOrder->start_delivery) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="startdelivery" class="col-sm-4 col-form-label">Delivery Status</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="delivery_status"
                                        value="{{ old('delivery_status', $editOrder->delivery_status) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="startdelivery" class="col-sm-4 col-form-label">Order Status</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="order_status"
                                        value="{{ old('order_status', $editOrder->order_status) }}">
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
