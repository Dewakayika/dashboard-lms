@section('title')
    Volunteer Dashboard
@endsection

@extends('Users.Partner.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('volunteer#index') }}">Home</a></li>
                <li class="breadcrumb-item active">Volunteer Order</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <div class="container">
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Order Id</th>
                    <th>Order Name</th>
                    <th>Order Partner</th>
                    <th>Order Meal Name</th>
                    <th>Order Meal Type</th>
                    <th>Delivery Start</th>
                    <th>Order Status</th>
                    <th class="w-36">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orderData as $order)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->users->name }}</td>
                        <td>{{ $order->partner->partner_organization }}</td>
                        <td>{{ $order->meal->meal_title }}</td>
                        <td>{{ $order->meal->meal_type }}</td>
                        <td>{{ $order->start_delivery_time }}</td>
                        @if ($order->order_status == 'New Order')
                            <td class="text-mow-red text-base font-semibold">!{{ $order->order_status }}</td>
                        @else
                            <td>{{ $order->order_status }}</td>
                        @endif
                        @if (!$order->start_delivery_time && !$order->driver_id)
                            <td><a href="#"><button class="btn btn-outline-primary" id="safetyConfirm"
                                        data-id="{{ $order->id }}">Choose Volunteer</button></a>
                            </td>
                        @else
                            <td><a href="#"><button class="btn btn-outline-primary">Action</button></a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).on('click', '#safetyConfirm', function(e) {
            var orderId = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                html: `<input type="checkbox" id="check" class="p-3" placeholder="Username"><label for="check">Testing</label>`,
                confirmButtonText: 'Continue <i class="fa fa-arrow-right"></i>',
                focusConfirm: false,
                preConfirm: () => {
                    const check = Swal.getPopup().querySelector('#check').checked
                    if (!check) {
                        Swal.showValidationMessage(`Please Check the list`)
                    }
                    return {
                        check: check,
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'message'
                    );
                    setTimeout(function() {
                        window.location = "orderVolunteer/" + orderId + ""
                    }, 900);
                }
            })
        });
    </script>
@endsection
