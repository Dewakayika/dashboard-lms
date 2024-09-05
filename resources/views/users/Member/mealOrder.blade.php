@section('title')
    Order Status
@endsection

@extends('Users.Member.layouts.app')

@section('content')
    <!-- Start breadcrumb -->


    <!-- END breadcrumb -->
    <div class="container">
        <h1 class="h3 fw-bold lh-1 mt-5 text-center">Order History</h1>
        @forelse ($orderData as $order)
            <div class="container">
                <div class="d-flex justify-content-center mt-4">
                    <div class="col-md-10">
                        <div class="row bg-white border rounded shadow-sm" style="margin: 0">
                            <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image"
                                    src="{{ asset('uploads/meal/' . $order->meal->meal_image) }}"></div>
                            <div class="col-md-9 mt-1">
                                <h1 class="h3 fw-bold lh-1 mb-3 mt-3 col-lg-6">{{ $order->meal->meal_title }}
                                    &nbsp;<span
                                        class="@if ($order->meal->meal_type == 'Cold') free @else text-base text-white px-2 py-[5px] bg-mow-red rounded-br-[10px] rounded-tl-[10px] @endif">{{ $order->meal->meal_type }}</span>
                                </h1>
                                <p class="lead blockquote-footer mt-1">Restaurant Partner By <cite
                                        title="Source Title">{{ $order->partner->partner_organization }}</cite></p>

                                <div class="mt-1 mb-1 spec-1">
                                    <p>This Meal order By <i>{{ $order->member->users->name }}</i></p>
                                </div>
                                <p class="text-justify">{{ $order->meal->meal_description }}</p>

                                <div class="float-right lign-items-center align-content-center  border-left">
                                    <div class="d-flex flex-column mb-[6px]">
                                        @if ($order->delivery_status == 'Received' &&
                                            $ratingData->where('meal_id', 'like', $order->meal_id)->pluck('meal_id')->isNotEmpty())
                                            <a href="#">
                                                <button class="btn btn-warning" type="button">
                                                    Has been Rating
                                                </button>
                                            </a>
                                        @elseif($order->delivery_status == 'Received')
                                            <a href="{{ route('member#ratingMeals', $order->id) }}">
                                                <button class="btn btn-warning" type="button">
                                                    {{ $order->delivery_status }}
                                                </button>
                                            </a>
                                        @else
                                            <button class="btn btn-warning" type="button" disabled>
                                                @if ($order->delivery_status == null)
                                                    <i class="fa-regular fa-clock"></i> &nbsp;Waiting for deliver
                                                @else
                                                    {{ $order->delivery_status }}
                                                @endif
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-8 text-xl text-mow-red">
                <center>
                    <h2>Not Order Yet</h2>
                </center>
            </div>
        @endforelse
        <div class="container my-14 -mr-[102px]">
            {{ $orderData->links() }}
        </div>
    </div>
@endsection
