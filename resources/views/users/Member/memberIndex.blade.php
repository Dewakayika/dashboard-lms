@section('title')
    Member Dashboard
@endsection

@extends('users.Member.layouts.app')

@section('content')
    @vite('resources/css/welcome.css')
    @vite('resources/css/flying.css')
    <div class="icon-bar z-50">
        <a data-bs-toggle="modal" class="cursor-pointer" data-bs-target="#feedbackModal">Feedback</a>
    </div>
    {{-- Slide Show --}}
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="bd-placeholder-img"
                    src="https://cdn.discordapp.com/attachments/1018894859832148009/1031991072139771995/banner_1.png"
                    style="width:100%">
            </div>
            <div class="carousel-item">
                <img class="bd-placeholder-img"
                    src="https://cdn.discordapp.com/attachments/1018894859832148009/1031989886795919360/banner_2.png"
                    style="width:100%">
            </div>
            <div class="carousel-item">
                <img class="bd-placeholder-img"
                    src="https://cdn.discordapp.com/attachments/1018894859832148009/1031989887102091304/banner_3.png"
                    style="width:100%">
            </div>
            <div class="carousel-item">
                <img class="bd-placeholder-img"
                    src="https://cdn.discordapp.com/attachments/1018894859832148009/1032148798832640000/banner_4.png"
                    style="width:100%">
            </div>
        </div>
    </div>

    <button class="carousel-control-prev -z-50" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next -z-50" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>
    <center>
        <!-- Three columns of text below the carousel -->
        <div class="row container">
            <div class="menuu">
                <div>
                    <a href="{{ route('member#memberFoodList') }}">
                        <div class="menu">
                            <i class="fa-solid fa-heart "></i>
                        </div>
                    </a>
                    <h2>Favorite</h2>
                </div>
                <div>
                    <a href="{{ route('member#memberFoodList') }}">
                        <div class="menu">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                    </a>
                    <h2>Bestsellers</h2>
                </div>
                <div>
                    <a href="{{ route('member#memberFoodList') }}">
                        <div class="menu">
                            <i class="fa-solid fa-bowl-food"></i>
                        </div>
                    </a>
                    <h2>Hot</h2>
                </div>
                <div>
                    <a href="{{ route('member#memberFoodList') }}">
                        <div class="menu">
                            <i class="fa-solid fa-snowflake"></i>
                        </div>
                    </a>
                    <h2>Cold</h2>
                </div>
                <div>
                    <a href="{{ route('member#memberFoodList') }}">
                        <div class="menu">
                            <i class="fa-solid fa-mug-saucer"></i>
                        </div>
                    </a>
                    <h2>Drink</h2>
                </div>
                <div>
                    <a href="{{ route('member#orderList') }}">
                        <div class="menu">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </div>
                    </a>
                    <h2>Order</h2>
                </div>
            </div>
        </div><!-- /.row -->
    </center>

    <div class="album py-5 ">
        <div class="d-flex justify-center">
            <h2 class="text-white text-5xl m-0 font-semibold">M E N U</h2>
        </div>
        <div class="container">
            @if ($dateCount >= 0.2)
                <div class="mt-0 row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 g-5">
                    @forelse ($mealData as $meal)
                        <div class="col">
                            <div class="card shadow-sm">
                                <img class="bd-placeholder-img card-img-top" width="100%" height="225"
                                    src="{{ asset('uploads/meal/' . $meal->meal_image) }}" role="img"
                                    aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                                    focusable="false" loading="lazy">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c" />

                                <div class="card-body">
                                    <h1 style="font-size: 1.5rem">{{ $meal->meal_title }} <span class="free">Free</span>
                                    </h1>
                                    <div class="flex items-center ml-2">
                                        @php $rating = number_format($meal->ratings()->avg('rating'), 1); @endphp

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
                                        <span
                                            class="mt-[2px] mx-1">{{ number_format($meal->ratings()->avg('rating'), 1) }}</span>
                                        <small class="mt-[4px]">({{ number_format($meal->ratings()->count('id')) }}
                                            Review)</small>
                                    </div>
                                    <p class="card-text">{{ $meal->meal_description }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ route('member#mealDetails', $meal->id) }}" type="button"
                                                class="btn btn-sm btn-warning">View</a>
                                        </div>
                                        <small class="text-muted">9 mins</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h2 class="w-full text-center text-2xl"> NO MEALS HAS BEEN ADDED </h2>
                    @endforelse
                </div>
            @else
                <h2 class="text-center text-2xl"> OUT OF SERVICES </h2>
            @endif
        </div>
        <div class="d-flex justify-center">
            <a href="{{ route('member#memberFoodList') }}"
                class="bg-white relative inline-flex items-center px-5 py-2 overflow-hidden text-lg font-medium text-warning border-2 border-warning rounded-full hover:text-white group hover:bg-yellow-50">
                <span
                    class="absolute left-0 block w-full h-0 transition-all bg-red-500 opacity-100 group-hover:h-full top-1/2 group-hover:top-0 duration-400 ease"></span>
                <span
                    class="absolute right-0 flex items-center justify-start w-10 h-10 duration-300 transform translate-x-full group-hover:translate-x-0 ease">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </span>
                <span class="relative">Other</span>
            </a>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade-scale" id="feedbackModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Feedback Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('member#memberFeedback') }}" method="get">
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Subject:</label>
                            <input name="feedback_subject" type="text" class="form-control" id="feedback_subject" />
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea name="feedback_message" class="form-control" id="feedback_message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Confirm</button>
                        <div class="btn btn-secondary" data-bs-dismiss="modal">Close</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            setTimeout(showSlides, 1000); // Change image every 2 seconds
        }
    </script>
@endsection
