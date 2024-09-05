@section('title')
    Volunteer Order
@endsection

@extends('Users.Partner.layouts.app')

@section('content')
    <!-- Start content -->
    <div class="container">

        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Campaign Id</th>
                                <th>Volunteer Id</th>
                                <th>Volunteer Documents</th>
                                <th>Volunteer Advantages</th>
                                <th>Action</th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($volunteerData as $volunteer)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $volunteer->campaign_id }}</td>
                                    <td>{{ $volunteer->volunteer_id }}</td>
                                    <td>{{ $volunteer->documents }}</td>
                                    <td>{{ $volunteer->advantages }}</td>
                                    <td>{{ $orderCount->where('volunteer_id', $volunteer->volunteer_id)->count('delivery_status') }}/1
                                        <form action="{{ route('partner#saveOrderVolunteer', $volunteer->volunteer_id) }}" method="GET">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $orderData->id }}">
                                            <button type="submit" class="btn btn-outline-primary" id="edit">
                                                Choose</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content -->
@endsection
