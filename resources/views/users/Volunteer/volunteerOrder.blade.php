@section('title')
    Volunteer Order
@endsection

@extends('Users.Volunteer.layouts.app')

@section('content')
    <!-- <div class="container">
            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Order Id</th>
                        <th>Order Name</th>
                        <th>Order Partner</th>
                        <th>Order Meal Name</th>
                        <th>Order Meal Type</th>
                        <th>Delivery Start</th>
                        <th>Delivery Status</th>
                        <th class="w-36">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($orderData as $order)
    <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->member->users->name }}</td>
                            <td>{{ $order->partner->partner_organization }}</td>
                            <td>{{ $order->meal->meal_title }}</td>
                            <td>{{ $order->meal->meal_type }}</td>
                            <td>{{ $order->start_delivery_time }}</td>
                            <td>{{ $order->delivery_status }}</td>
                            @if (!$order->start_delivery_time && !$order->driver_id)
    <td><a href={{ route('driver#orderDriver', $order->id) }}><button class="btn btn-outline-primary"
                                            id="safetyConfirm" data-id="{{ $order->id }}">Choose Order</button></a>
                                </td>
@else
    <td>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderModal"
                                        data-bs-whatever="{{ $order->member->users->name }}" data-id="{{ $order->id }}"
                                        data>Action</button>
                                </td>
    @endif
                        </tr>
    @endforeach
                </tbody>
            </table>
        </div> -->

    <div class="container">
        <div class="mt-5">
            @forelse ($orderData as $order)
                <div
                    class="d-style btn btn-brc-tp border-2 bgc-white btn-outline-blue btn-h-outline-blue btn-a-outline-blue w-100 my-2 py-3 shadow-sm">
                    <!-- Basic Plan -->
                    <div class="row align-items-center">
                        <div class="col-12 col-md-4">
                            <h4 class="pt-3 text-170 text-600 text-primary-d1 letter-spacing">
                                Order Id
                            </h4>


                            <div class="text-secondary-d1 display-1">
                                <span class="ml-n15 align-text-bottom">{{ $order->id }}</span>
                            </div>
                        </div>

                        <ul class="list-unstyled mb-0 col-12 col-md-4 text-dark-l1 text-90 text-left my-4 my-md-0">
                            <li>
                                <i class="fa-solid fa-user text-110 mr-2 mt-1"></i>
                                <span>
                                    <span class="text-110">{{ $order->member->users->name }}</span>
                                </span>
                            </li>

                            <li class="mt-25">
                                <i class="fa-sharp fa-solid fa-handshake text-110 mr-2 mt-1"></i>
                                <span class="text-110">
                                    {{ $order->partner->partner_organization }}
                                </span>
                            </li>

                            <li class="mt-25">
                                <i class="fa-solid fa-utensils text-110 mr-2 mt-1"></i>
                                <span class="text-110">
                                    {{ $order->meal->meal_title }}
                                </span>
                            </li>
                        </ul>

                        <ul class="list-unstyled mb-0 col-12 col-md-4 text-dark-l1 text-90 text-left my-4 my-md-0">
                            <li>
                                <i class="fa-solid fa-fire text-110 mr-2 mt-1"></i>
                                <span>
                                    <span class="text-110">{{ $order->meal->meal_type }}</span>
                                </span>
                            </li>

                            <li class="mt-25">
                                <i class="fa-solid fa-hourglass-start text-110 mr-2 mt-1"></i>
                                <span class="text-110">
                                    {{ $order->start_delivery_time }}
                                </span>
                            </li>

                            <li class="mt-25">
                                <i class="fa-solid fa-circle-exclamation text-110 mr-2 mt-1"></i>
                                <span class="text-110">
                                    @if ($order->order_status == 'New Order')
                                        <span
                                            class="text-mow-red text-base font-semibold">!{{ $order->order_status }}</span>
                                    @else
                                        <span>{{ $order->order_status }}</span>
                                    @endif

                                </span>
                            </li>
                        </ul>

                        @if (!$order->start_delivery_time && !$order->driver_id)
                            <a href={{ route('driver#orderDriver', $order->id) }}><button class="btn btn-outline-primary"
                                    id="safetyConfirm" data-id="{{ $order->id }}">Choose Order</button></a>
                        @else
                            <br>
                            <button class="btn btn-outline-primary " style="width: 200px; margin-left: 500px;"
                                data-bs-toggle="modal" data-bs-target="#orderModal"
                                data-bs-whatever="{{ $order->member->users->name }}" data-id="{{ $order->id }}"
                                data>Action</button>
                        @endif

                    </div>

                </div>
            @empty
                <div class="w-screen py-40 text-xl text-mow-red">
                    <h2 class="text-center text-2xl"> NO CAMPAIGN HAS BEEN ADDED </h2>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        body {

            background-color: #e4e6e9;
            color: #41464d;
        }

        .btn:not(:disabled):not(.disabled) {
            cursor: pointer;
        }

        .btn-a-brc-tp:not(.disabled):not(:disabled).active,
        .btn-brc-tp,
        .btn-brc-tp:focus:not(:hover):not(:active):not(.active):not(.dropdown-toggle),
        .btn-h-brc-tp:hover,
        .btn.btn-f-brc-tp:focus,
        .btn.btn-h-brc-tp:hover {
            border-color: transparent;
        }

        .btn-outline-blue {
            color: #0d6ce1;
            border-color: #5a9beb;
            background-color: transparent;
        }

        .btn {
            cursor: pointer;
            position: relative;
            z-index: auto;
            border-radius: .175rem;
            transition: color .15s, background-color .15s, border-color .15s, box-shadow .15s, opacity .15s;
        }

        .border-2 {
            border-width: 2px !important;
            border-style: solid !important;
            border-color: transparent;
        }

        .bgc-white {
            background-color: #fff !important;
        }


        .text-green-d1 {
            color: #277b5d !important;
        }

        .letter-spacing {
            letter-spacing: .5px !important;
        }

        .font-bolder,
        .text-600 {
            font-weight: 600 !important;
        }

        .text-170 {
            font-size: 1.7em !important;
        }

        .text-purple-d1 {
            color: #6d62b5 !important;
        }

        .text-primary-d1 {
            color: #276ab4 !important;
        }

        .text-secondary-d1 {
            color: #5f718b !important;
        }

        .text-180 {
            font-size: 1.8em !important;
        }

        .text-150 {
            font-size: 1.5em !important;
        }

        .text-danger-m3 {
            color: #e05858 !important;
        }

        .rotate-45 {
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .position-l {
            left: 0;
        }

        .position-b,
        .position-bc,
        .position-bl,
        .position-br,
        .position-center,
        .position-l,
        .position-lc,
        .position-r,
        .position-rc,
        .position-t,
        .position-tc,
        .position-tl,
        .position-tr {
            position: absolute !important;
            display: block;
        }

        .mt-n475,
        .my-n475 {
            margin-top: -2.5rem !important;
        }

        .ml-35,
        .mx-35 {
            margin-left: 1.25rem !important;
        }

        .text-dark-l1 {
            color: #56585e !important;
        }

        .text-90 {
            font-size: .9em !important;
        }

        .text-left {
            text-align: left !important;
        }

        .mt-25,
        .my-25 {
            margin-top: .75rem !important;
        }

        .text-110 {
            font-size: 1.1em !important;
        }

        .deleted-text {
            text-decoration: line-through;
            ;
        }
    </style>

    <!-- Modal -->
    <div class="modal" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Delivery</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&#10005;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('volunteer#updateOrder') }}" method="get">
                        <div class="">
                            <input type="hidden" class="form-control" name="order_id" id="order_id">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Orderer:</label>
                            <input name="orderer_name" type="text" readonly class="form-control" id="orderer_name" />
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Delivery Status:</label>
                            <div class="mb-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 w-full justify-center gap-4">
                                <div class="col-span-1 w-full">
                                    <input type="radio" id="onDelivery" name="delivery_status" value="On delivery"
                                        class="hidden peer custom-control-input fixed-amount">
                                    <label for="onDelivery"
                                        class="inline-flex justify-between items-center px-5 py-3 w-full text-gray-500 bg-white rounded border-gray-200 cursor-pointer peer-checked:border-mow-shine-yellow border-2 border-solid peer-checked:text-mow-shine-yellow hover:text-gray-600 hover:bg-gray-100">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">On Delivery</div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-span-1 w-full">
                                    <input type="radio" id="received" name="delivery_status" value="Received"
                                        class="hidden peer custom-control-input fixed-amount">
                                    <label for="received"
                                        class="inline-flex justify-center items-center px-5 py-3 w-full text-gray-500 bg-white rounded border-gray-200 cursor-pointer peer-checked:border-mow-shine-yellow border-2 border-solid peer-checked:text-mow-shine-yellow hover:text-gray-600 hover:bg-gray-100">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">Received</div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Confirm</button>
                        <div class="btn btn-secondary" data-bs-dismiss="modal">Close</div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>



    <script>
        const orderModal = document.getElementById('orderModal')
        const form = document.getElementById('formCampaign')
        orderModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget
            const ordererName = button.getAttribute('data-bs-whatever')
            const orderId = button.getAttribute('data-id')

            const modalOrderId = orderModal.querySelector('.modal-body #order_id')
            const modalOrdererName = orderModal.querySelector('.modal-body #orderer_name')

            modalOrderId.value = orderId
            modalOrdererName.value = ordererName
        })
    </script>
@endsection
