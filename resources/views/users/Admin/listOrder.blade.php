@section('title')
    List Order Admin
@endsection

@extends('Users.Admin.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Order</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div class="container">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-center">
                Order List
            </h1>
        </div>
        @if (Session::has('orderCreated'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('orderCreated') }}
            </div>
        @endif
        @if (Session::has('orderDeleted'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('orderDeleted') }}
            </div>
        @endif
        @if (Session::has('orderUpdated'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('orderUpdated') }}
            </div>
        @endif
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Order Id</th>
                    <th>Member Id</th>
                    <th>Meal Id</th>
                    <th>Partner Id</th>
                    <th>Volunteer Id</th>
                    <th>Driver Id</th>
                    <th>Start Delivery</th>
                    <th>Delivery Status</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orderData as $order)
                    <tr>
                        <td>{{ ($orderData->currentPage() - 1) * $orderData->perPage() + $loop->iteration }}</td>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->member_id }}</td>
                        <td>{{ $order->meal_id }}</td>
                        <td>{{ $order->partner_id }}</td>
                        <td>{{ $order->volunteer_id }}</td>
                        <td>{{ $order->driver_id }}</td>
                        <td>{{ $order->start_delivery_time }}</td>
                        <td>{{ $order->delivery_status }}</td>
                        <td>{{ $order->order_status }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin#editOrder', $order->id) }}">
                                <button type="button"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    id="details">
                                    Edit</button>
                            </a>
                            <a href="{{ route('admin#deleteOrder', $order->id) }}">
                                <button type="button"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                    id="details">
                                    Delete</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orderData->links() }}
    </div>

    <!-- End content-->
@endsection
