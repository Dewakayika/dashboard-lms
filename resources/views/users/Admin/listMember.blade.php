@section('title')
    List Member Admin
@endsection

@extends('Users.Admin.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Member</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <!-- Start content -->
    <div class="container">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-center">
                Member List
            </h1>
        </div>
        @if (Session::has('memberCreated'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('memberCreated') }}
            </div>
        @endif
        @if (Session::has('memberDeleted'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('memberDeleted') }}
            </div>
        @endif
        @if (Session::has('memberUpdated'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('memberUpdated') }}
            </div>
        @endif
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Member Id</th>
                    <th>User Id</th>
                    <th>Member Caregiver Name</th>
                    <th>Member Caregiver Relation</th>
                    <th>Member Caregiver Number</th>
                    <th>Member Medical Conditions</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($memberData as $member)
                    <tr>
                        <td>{{ ($memberData->currentPage() - 1) * $memberData->perPage() + $loop->iteration }}</td>
                        <td>{{ $member->id }}</td>
                        <td>{{ $member->user_id }}</td>
                        <td>{{ $member->member_caregiver_name }}</td>
                        <td>{{ $member->member_caregiver_relation }}</td>
                        <td>{{ $member->member_caregiver_number }}</td>
                        <td>{{ $member->member_medical_condition }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin#editMember', $member->id) }}">
                                <button type="button"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    id="details">
                                    Edit</button>
                            </a>
                            <a href="{{ route('admin#deleteMember', $member->user_id) }}">
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
        {{ $memberData->links() }}

    </div>

    <!-- End content-->
@endsection
