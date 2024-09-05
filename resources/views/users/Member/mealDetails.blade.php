@section('title')
    Meals Details
@endsection

@extends('users.Member.layouts.app')

@section('content')
    <style type="text/css">
        #volunteer {
            max-width: 600px;
            padding: 20px;
            margin: 50px auto;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
    </style>
    <!-- Start content -->
    <div class="meals">
        <div class="container col-xxl-8 ">
            <div class="row flex-lg-row align-items-center">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="{{ asset('uploads/meal/' . $mealData->meal_image) }}" class="d-block mx-lg-auto"
                        alt="Bootstrap Themes" width="auto" height="50">
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-3">{{ $mealData->meal_title }}
                        <span class="@if ($mealData->meal_type == 'Cold') free @else text-base text-white px-2 py-[5px] bg-mow-red rounded-br-[10px] rounded-tl-[10px] @endif">{{ $mealData->meal_type }}</span>
                    </h1>

                    <p class="lead blockquote-footer">Posted By <cite
                            title="Source Title">{{ $partnerData->partner_organization }}</cite></p>
                    <div class="flex items-center h-11">
                        @php $rating = number_format($mealData->ratings()->avg('rating'), 1); @endphp

                        @foreach (range(1, 5) as $i)
                            <span class="fa-stack" style="width:1em">
                                <i class="far fa-star fa-stack-1x"></i>

                                @if ($rating > 0)
                                    @if ($rating > 0.5)
                                        <i class="fas fa-star fa-stack-0.5x"></i>
                                    @else
                                        <i class="fas fa-star-half fa-stack-0.5x"></i>
                                    @endif
                                @endif
                                @php $rating--; @endphp
                            </span>
                        @endforeach
                        <span class="mt-[2px] mx-1">{{ number_format($mealData->ratings()->avg('rating'), 1) }}</span>
                        <small class="mt-[4px]">({{ number_format($mealData->ratings()->count('id')) }}
                            Review)</small>
                    </div>
                    <p class="lead text-justify mb-4">{{ $mealData->meal_description }}</p>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="{{ route('member#orderDetails', $mealData->id) }}"><button type="button"
                                class="btn btn-warning btn-lg px-4 me-md-2">Order Now</button></a>
                        <button type="button" class="btn btn-outline-success btn-lg px-4"><i class="fa fa-bookmark-o"
                                aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
