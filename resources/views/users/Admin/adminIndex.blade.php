@section('title')
    Admin Dashboard
@endsection

@extends('Users.Admin.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->
    <style>
        .card-body {
            background-color: white;
        }
    </style>
    <!-- Start content -->
    <div class="bg-slate-50">
        <div class="container pb-10">
            <h2 class="text-3xl pt-10 font-medium mb-10 text-mow-red">Admin Dashboard</h2>
            <div class="container w-full flex justify-center">
                <div class="grid grid-cols-1 gap-5 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3">
                    <a href="{{ route('admin#listUser') }}" class="text-slate-800 group rounded-sm"
                        style="max-width: 20rem;">
                        <div class="card-body group-hover:bg-mow-shine-yellow  group-hover:text-white  shadow-md rounded">
                            <h5 class="card-title font-semibold">Users Registered</h5>
                            <div class="d-flex align-items-center mb-2 mt-4">
                                <h2 class="mb-0 display-5">
                                    <i class="text-mow-shine-yellow group-hover:text-white fa-solid fa-users"></i>
                                </h2>
                                <div class="ms-auto">
                                    <h2 class="mb-0 display-6">
                                        <span class="fw-normal">{{ $userData }}</span>
                                        <span class="fw-normal">Users</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin#listMeal') }}" class="text-slate-800 group rounded-sm"
                        style="max-width: 20rem;">
                        <div class="card-body group-hover:text-white hover:bg-mow-shine-yellow shadow-md rounded">
                            <h5 class="card-title font-semibold">Product Menu</h5>
                            <div class="d-flex align-items-center mb-2 mt-4">
                                <h2 class="mb-0 display-5">
                                    <i class="text-mow-shine-yellow group-hover:text-white fa-solid fa-burger"></i>
                                </h2>
                                <div class="ms-auto">
                                    <h2 class="mb-0 display-6">
                                        <span class="fw-normal">{{ $mealData }}</span>
                                        <span class="fw-normal">Menus</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin#listMember') }}" class="text-slate-800 group rounded-sm"
                        style="max-width: 20rem;">
                        <div class="card-body group-hover:text-white hover:bg-mow-shine-yellow shadow-md rounded">
                            <h5 class="card-title font-semibold">Members Role</h5>
                            <div class="d-flex align-items-center mb-2 mt-4">
                                <h2 class="mb-0 display-5">
                                    <i class="text-mow-shine-yellow group-hover:text-white fa-solid fa-users"></i>
                                </h2>
                                <div class="ms-auto">
                                    <h2 class="mb-0 display-6">
                                        <span class="fw-normal">{{ $memberData }}</span>
                                        <span class="fw-normal">Users</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin#listPartner') }}" class="text-slate-800 group rounded-sm"
                        style="max-width: 20rem;">
                        <div class="card-body group-hover:text-white hover:bg-mow-shine-yellow shadow-md rounded">
                            <h5 class="card-title font-semibold">Partner Role</h5>
                            <div class="d-flex align-items-center mb-2 mt-4">
                                <h2 class="mb-0 display-5">
                                    <i class="text-mow-shine-yellow group-hover:text-white fa-solid fa-users"></i>
                                </h2>
                                <div class="ms-auto">
                                    <h2 class="mb-0 display-6">
                                        <span class="fw-normal">{{ $partnerData }}</span>
                                        <span class="fw-normal">Users</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin#listVolunteer') }}" class="text-slate-800 group rounded-sm"
                        style="max-width: 20rem;">
                        <div class="card-body group-hover:text-white hover:bg-mow-shine-yellow shadow-md rounded">
                            <h5 class="card-title font-semibold">Volunteer Role</h5>
                            <div class="d-flex align-items-center mb-2 mt-4">
                                <h2 class="mb-0 display-5">
                                    <i class="text-mow-shine-yellow group-hover:text-white fa-solid fa-users"></i>
                                </h2>
                                <div class="ms-auto">
                                    <h2 class="mb-0 display-6">
                                        <span class="fw-normal">{{ $volunteerData }}</span>
                                        <span class="fw-normal">Users</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin#listDriver') }}" class="text-slate-800 group rounded-sm"
                        style="max-width: 20rem;">
                        <div class="card-body group-hover:text-white hover:bg-mow-shine-yellow shadow-md rounded">
                            <h5 class="card-title font-semibold">Driver Role</h5>
                            <div class="d-flex align-items-center mb-2 mt-4">
                                <h2 class="mb-0 display-5">
                                    <i class="text-mow-shine-yellow group-hover:text-white fa-solid fa-users"></i>
                                </h2>
                                <div class="ms-auto">
                                    <h2 class="mb-0 display-6">
                                        <span class="fw-normal">{{ $driverData }}</span>
                                        <span class="fw-normal">Users</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin#listOrder') }}" class="text-slate-800 group rounded-sm"
                        style="max-width: 20rem;">
                        <div class="card-body group-hover:text-white hover:bg-mow-shine-yellow shadow-md rounded">
                            <h5 class="card-title font-semibold">Total Orders</h5>
                            <div class="d-flex align-items-center mb-2 mt-4">
                                <h2 class="mb-0 display-5">
                                    <i
                                        class="text-mow-shine-yellow group-hover:text-white fa-sharp fa-solid fa-bag-shopping"></i>
                                </h2>
                                <div class="ms-auto">
                                    <h2 class="mb-0 display-6">
                                        <span class="fw-normal">{{ $orderData }}</span>
                                        <span class="fw-normal">Orders</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin#listCampaign') }}" class="text-slate-800 group rounded-sm"
                        style="max-width: 20rem;">
                        <div class="card-body group-hover:text-white hover:bg-mow-shine-yellow shadow-md rounded">
                            <h5 class="card-title font-semibold">Total Campaigns</h5>
                            <div class="d-flex align-items-center mb-2 mt-4">
                                <h2 class="mb-0 display-5">
                                    <i class="text-mow-shine-yellow group-hover:text-white fa-solid fa-bullhorn"></i>
                                </h2>
                                <div class="ms-auto">
                                    <h2 class="mb-0 display-6">
                                        <span class="fw-normal">{{ $campaignData }}</span>
                                        <span class="fw-normal">Campaigns</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin#listDonation') }}" class="text-slate-800 group rounded-sm"
                        style="max-width: 20rem;">
                        <div class="card-body group-hover:text-white hover:bg-mow-shine-yellow shadow-md rounded">
                            <h5 class="card-title font-semibold">Donor Income</h5>
                            <div class="d-flex align-items-center mb-2 mt-4">
                                <h2 class="mb-0 display-5">
                                    <i class="text-mow-shine-yellow group-hover:text-white fa-solid fa-dollar-sign"></i>
                                </h2>
                                <div class="ms-auto">
                                    <h2 class="mb-0 display-6">
                                        <span class="fw-normal">{{ $priceData }}</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container flex w-full justify-center mt-9">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-0">Feedback History</h5>
                </div>
                <div class="table-responsive pb-10">
                    <table class="table no-wrap user-table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="border-0 fs-4 font-weight-medium ps-4">
                                    #
                                </th>
                                <th scope="col" class="border-0 fs-4 font-weight-medium">
                                    Name
                                </th>
                                <th scope="col" class="border-0 fs-4 font-weight-medium">
                                    Email
                                </th>
                                <th scope="col" class="border-0 fs-4 font-weight-medium">
                                    Subject
                                </th>
                                <th scope="col" class="border-0 fs-4 font-weight-medium">
                                    Message
                                </th>
                                <th scope="col" class="border-0 fs-4 font-weight-medium">
                                    Manage
                                </th>
                            </tr>
                        </thead>
                        @forelse ($feedbackData as $feedback)
                            <tbody>
                                <tr>
                                    <td class="ps-4">
                                        <span>{{ $feedback->id }}</span>
                                    </td>
                                    <td>
                                        <h5 class="font-weight-medium mb-0">
                                            {{ $feedback->users->name }}
                                        </h5>
                                    </td>
                                    <td>
                                        <span>{{ $feedback->users->email }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $feedback->feedback_subject }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $feedback->feedback_message }}</span>
                                    </td>
                                    <td class=" text-xl">
                                        <div class="flex justify-center gap-4">
                                            <a href="{{route('admin#editFeedback', $feedback->id)}}" class="text-sky-500 hover:text-sky-700 edit"><i class="fa fa-pencil"></i></a>
                                            <a href="{{route('admin#deleteFeedback', $feedback->id)}}" class="text-red-500 hover:text-red-700 delete"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @empty
                        @endforelse
                    </table>
                    {{ $feedbackData->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
