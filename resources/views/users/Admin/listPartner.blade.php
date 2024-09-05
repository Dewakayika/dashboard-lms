@section('title')
    List Partner Admin
@endsection

@extends('Users.Admin.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Partner</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div class="container">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-center">
                Partner List
            </h1>
        </div>
        @if (Session::has('partnerCreated'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('partnerCreated') }}
            </div>
        @endif
        @if (Session::has('partnerDeleted'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('partnerDeleted') }}
            </div>
        @endif
        @if (Session::has('partnerUpdated'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('partnerUpdated') }}
            </div>
        @endif
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Partner Id</th>
                    <th>User Id</th>
                    <th>Partner Organization</th>
                    <th>Partner Timeline</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($partnerData as $partner)
                    <tr>
                        <td>{{ ($partnerData->currentPage() - 1) * $partnerData->perPage() + $loop->iteration }}</td>
                        <td>{{ $partner->id }}</td>
                        <td>{{ $partner->user_id }}</td>
                        <td>{{ $partner->partner_organization }}</td>
                        <td>{{ $partner->partnership_timeline }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin#editPartner', $partner->id)}}">
                                <button type="button"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    id="details">
                                    Edit</button>
                            </a>
                            <a href="{{ route('admin#deletePartner', $partner->user_id) }}">
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
        {{ $partnerData->links() }}
    </div>

    <!-- End content-->
@endsection
