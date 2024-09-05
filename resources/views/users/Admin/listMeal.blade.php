@section('title')
    List Meal Admin
@endsection

@extends('Users.Admin.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Meal</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div class="mb-4 container">
        <div class="card-body">
            <div class="table-responsive">
                <div class="mb-4">
                    {{-- Adding Categroy Session Checking  --}}
                    @if (Session::has('mealCreated'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                            {{ Session::get('mealCreated') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    {{-- End of Session Checking --}}

                    {{-- Updating Categroy Session Checking  --}}
                    @if (Session::has('updateData'))
                        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                            {{ Session::get('updateData') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    {{-- End of Session Checking --}}

                    {{-- Deleting Categroy Session Checking  --}}
                    @if (Session::has('mealDeleted'))
                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                            {{ Session::get('mealDeleted') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    {{-- End of Session Checking --}}
                </div>
                <div class="flex items-center justify-center  bg-white">
                    <div class="col-span-12">
                        <div class="overflow-auto lg:overflow-visible">
                            <table class="table text-gray-400 border-separate space-y-6 text-sm table-bordered">
                                <thead class="bg-warning text-white">
                                    <tr>
                                        <th class="p-3">No</th>
                                        <th class="p-3 text-left">Meal Name</th>
                                        <th class="p-3 text-left">Meal Type</th>
                                        <th class="p-3 text-left">Meal Image</th>

                                        <th class="p-3 text-left">Meal Description</th>
                                        <th class="p-3 text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mealData as $meal)
                                        <tr class="bg-blue-50 lg:text-black">
                                            <td class="p-3 font-medium capitalize">{{ $meal->id }}</td>
                                            <td class="p-3">{{ $meal->meal_title }}</td>
                                            <td class="p-3">{{ $meal->meal_type }}</td>

                                            <td class="p-3">
                                                <img src="{{ asset('uploads/meal/' . $meal->meal_image) }}"
                                                    class="img-thumbnail" width="150px" height="150px" alt="Images">
                                            </td>
                                            <td class="p-3">{{ $meal->meal_description }}</td>
                                            <td class="p-3 flex">

                                                <!-- EDIT -->
                                                <a href="{{ route('admin#editMeal', $meal->id) }}">
                                                    <button id="edit" type="button">
                                                        <svg class="fill-current text-blue-300 w-5 h-5"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path
                                                                d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                                            <path
                                                                d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                                        </svg>
                                                    </button>

                                                </a>

                                                <!-- DELETE -->
                                                <a href="{{ route('admin#deleteMeal', $meal->id) }}">
                                                    <button id="edit" type="button">
                                                        <svg class="fill-current text-red-300 w-5 h-5"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path fillRule="evenodd"
                                                                d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                                                                clipRule="evenodd" />
                                                        </svg>
                                                    </button>

                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                                {{ $mealData->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End content-->
@endsection
