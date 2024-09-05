@section('title')
    Member Dashboard
@endsection

@extends('users.Member.layouts.app')

@section('content')
    <form action="{{ route('member#memberFoodList') }}" method="get">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative" style="margin: 0.75% 20%">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="search" id="default-search"
                class="block w-full py-3 pl-11 text-sm border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-mow-shine-yellow dark:focus:border-mow-shine-yellow"
                placeholder="Search Menu" name="search">
            <button type="submit"
                class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-mow-shine-yellow-800 focus:ring-4 focus:outline-none focus:ring-mow-shine-yellow-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-mow-shine-yellow dark:hover:bg-mow-shine-yellow-800 dark:focus:ring-mow-shine-yellow-600">Search</button>
        </div>
    </form>


    <h1 style="margin: 1% 0 0 20%; content-visibility: auto;" class="text-4xl font-medium" loading="lazy">MENU</h1>
    <p style="margin: 0 0 1% 20%">All of Menu is been here</p>
    <div class="justify-center align-center">
        @forelse ($mealData as $meal)
            <div class="d-flex drop-shadow-lg bg-white rounded-lg h-44" style="margin: 0.75% 20%">
                <div class="h-full min-w-fit ">
                    <img class="h-full min-w-fit rounded-l-lg" src="{{ asset('uploads/meal/' . $meal->meal_image) }}" alt="">
                </div>
                <div class="card-body">
                    <h1 style="font-size: 1.5rem"> {{ $meal->meal_title }}
                        <span
                            class="@if ($meal->meal_type == 'Cold') free @else text-base text-white px-2 py-[5px] bg-mow-red rounded-br-[10px] rounded-tl-[10px] @endif">{{ $meal->meal_type }}</span>
                    </h1>
                    <div class="flex items-center ml-2">
                        @php $rating = number_format($meal->ratings()->avg('rating'), 1); @endphp

                        @foreach (range(1, 5) as $i)
                            <span class="fa-stack" style="width:1em">
                                <i class="far fa-star fa-stack-1x text-yellow-400"></i>

                                @if ($rating > 0)
                                    @if ($rating > 0.5)
                                        <i class="fas fa-star fa-stack-0.5x text-yellow-400"></i>
                                    @else
                                        <i class="fas fa-star-half fa-stack-0.5x text-yellow-400"></i>
                                    @endif
                                @endif
                                @php $rating--; @endphp
                            </span>
                        @endforeach
                        <span class="mt-[2px] mx-1">{{ number_format($meal->ratings()->avg('rating'), 1) }}</span>
                        <small class="mt-[4px]">({{ number_format($meal->ratings()->count('id')) }}
                            Review)</small>
                    </div>
                    <p class="card-text">{{ $meal->meal_description }}</p>
                </div>
                <div class="btn-group" style="margin: 2%">
                    <a href="{{ route('member#mealDetails', $meal->id) }}" type="button" class="btn btn-sm btn-warning h-8">View</a>
                </div>
            </div>
        @empty
        <div class="py-8 text-xl text-mow-red">
            <center>
                <h2>No Meals</h2>
            </center>
        </div>
        @endforelse
    </div>

    <!-- Makanan Kosong
                        <h2 class="w-full text-center text-2xl"> NO MEALS HAS BEEN ADDED </h2> -->
@endsection


