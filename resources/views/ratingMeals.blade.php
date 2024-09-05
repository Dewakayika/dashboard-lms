@section('title')
    Meals Details
@endsection

@extends('users.Member.layouts.app')

@section('content')
    <style type="text/css">
        .hide {
            display: none;
        }

        .clear {
            float: none;
            clear: both;
        }

        .rating {
            width: 140px;
            unicode-bidi: bidi-override;
            direction: rtl;
        }

        .rating>label {
            float: right;
            display: inline;
            padding: 0;
            margin: 0;
            font-size: 2rem;
            position: relative;
            width: 1.1em;
            cursor: pointer;
            color: #000;
        }

        .rating>label:hover,
        .rating>label:hover~label,
        .rating>input.radio-btn:checked~label {
            color: transparent;
        }

        .rating>label:hover:before,
        .rating>label:hover~label:before,
        .rating>input.radio-btn:checked~label:before,
        .rating>input.radio-btn:checked~label:before {
            content: "\2605";
            position: absolute;
            left: 4;
            color: #FFD700;
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
                        <span>{{ $mealData->meal_type }}</span>
                    </h1>

                    <p class="lead blockquote-footer">Posted By <cite
                            title="Source Title">{{ $partnerData->partner_organization }}</cite></p>
                    <p class="lead text-justify mb-4">{{ $mealData->meal_description }}</p>
                    <p class="lead text-justify">Rate This Meal:</p>
                    <form class="-mt-3" action="{{ route('member#saveRating', $mealData->id) }}" method="POST">
                        @csrf
                        <div class="rating flex items-start justify-start">
                            <input id="star5" name="rating" type="radio" value="5" class="radio-btn hide" />
                            <label for="star5">☆</label>
                            <input id="star4" name="rating" type="radio" value="4" class="radio-btn hide" />
                            <label for="star4">☆</label>
                            <input id="star3" name="rating" type="radio" value="3" class="radio-btn hide" />
                            <label for="star3">☆</label>
                            <input id="star2" name="rating" type="radio" value="2" class="radio-btn hide" />
                            <label for="star2">☆</label>
                            <input id="star1" name="rating" type="radio" value="1" class="radio-btn hide" />
                            <label for="star1">☆</label>
                            <div class="clear"></div>
                            <input type="hidden" name="order_id" value="{{ $orderData->id }}">
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <button type="submit" class="btn btn-warning btn-lg px-4 me-md-2">Rate This</button>
                            <button type="button" class="btn btn-outline-success btn-lg px-4"><i class="fa fa-bookmark-o"
                                    aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(':radio').change(function() {
            console.log('New star rating: ' + this.value);
        });
    </script>
@endsection
