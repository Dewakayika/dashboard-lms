@extends('Users.Admin.layouts.dashboard-app')

@section('content')
    
    <div class="col-12 mx-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Home</a></li>
                <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-xs" aria-current="page">List Talent CV</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-0">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <h6 class="mb-0">Talent CV Data</h6>
                        <form method="GET" action="{{ route('admin#talentCVList') }}">
                            <select name="status" id="status" onchange="this.form.submit()" class="form-select form-select-sm w-auto">
                                <option value="">All</option>
                                <option value="In Review" {{ request('status') == 'In Review' ? 'selected' : '' }}>In Review</option>
                                <option value="Interview Process" {{ request('status') == 'Interview Process' ? 'selected' : '' }}>Interview Process</option>
                                <option value="approve" {{ request('status') == 'approve' ? 'selected' : '' }}>Approved</option>
                                <option value="decline" {{ request('status') == 'decline' ? 'selected' : '' }}>Declined</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-xs">No.</th>
                                    <th class="text-center text-xs">Name</th>
                                    <th class="text-center text-xs">Email</th>
                                    <th class="text-center text-xs">Phone Number</th>
                                    <th class="text-center text-xs">CV Files</th>
                                    <th class="text-center text-xs">Status</th>
                                    <th class="text-center text-xs">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs">
                                @foreach ($talentCV as $CV)
                                <tr>
                                    <td class="ps-4">{{ ($talentCV->currentPage() - 1) * $talentCV->perPage() + $loop->iteration }}</td>
                                    <td class="">{{ $CV->name }}</td>
                                    <td class="">{{ $CV->email }}</td>
                                    <td class="text-center">{{ $CV->phone_number }}</td>
                                    <td class="text-center"><a href="{{ asset('storage/' . $CV->cv_file) }}" target="_blank">Download PDF</a></td>
                                    <td class="text-center">
                                        @if($CV->status == 'approve')
                                            <span class="badge bg-success">{{ $CV->status }}</span>
                                        @elseif($CV->status == 'decline')
                                            <span class="badge bg-danger">{{ $CV->status }}</span>
                                        @elseif($CV->status == 'Interview Process')
                                            <span class="badge bg-warning">{{ $CV->status }}</span>
                                        @elseif($CV->status == 'In Review')
                                            <span class="badge bg-primary">{{ $CV->status }}</span>
                                        @else
                                            <span class="badge bg-secondary">Pending</span>
                                        @endif
                                    </td>
                                    <td class="text-center pt-4">
                                        @if($CV->status == 'In Review')
                                            <button type="button" class="btn btn-primary btn-xs text-xs" onclick="openInvitationModal('{{ route('booking.submit', $CV->id) }}', '{{ $CV->email }}')">Schedule Meeting</button>
                                        @elseif($CV->status == 'Interview Process')
                                            <button class="btn btn-danger btn-xs text-xs" onclick="openDeclineModal('declineModal', '{{ route('cv#decline', $CV->id) }}')">Decline</button>
                                            <button class="btn btn-success btn-xs text-xs" onclick="openApproveModal('{{ route('approveCV', $CV->id) }}')">Approve</button>
                                        @else
                                            <a href="{{ route('admin#deleteCV', $CV->id) }}" class="btn btn-danger btn-xs text-xs btn-delete">Delete</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $talentCV->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="invitationModal" tabindex="-1" aria-labelledby="invitationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow-lg">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="invitationModalLabel">Schedule Meeting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-sm text-gray-600">Schedule a meeting for your talent, add the meeting name mentioning the talent's name, for example, 'Interview Kayika,' along with the day and date.</p>
                    <form id="invitationForm" action="" method="POST">
                        @csrf
                        <input type="hidden" name="selected_emails[]" id="emailInput">

                        <div class="mb-3">
                            <label for="name" class="form-label text-sm">Meeting Name</label>
                            <input type="text" name="name" required class="form-control" placeholder="Enter meeting name">
                        </div>

                        <div class="mb-3">
                            <label for="meeting_date" class="form-label text-sm">Meeting Date</label>
                            <input type="date" name="meeting_date" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="meeting_time" class="form-label text-sm">Meeting Time</label>
                            <input type="time" name="meeting_time" required class="form-control">
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Send Invitation</button>
                        </div>
                    </form>
                </div>      
            </div>
        </div>
    </div>

    <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow-lg">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="approveModalLabel">Select Registration Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-sm text-gray-600">Select the registration code that will be used by users to register their data on the Padma portal.</p>
                    <form id="approveForm" action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <select name="registration_code" required class="form-select">
                                <option value="">Select Code</option>
                                @foreach ($registrationCodes as $code)
                                    <option value="{{ $code->registration_code }}">{{ $code->registration_code }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Approve</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow-lg">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="declineModalLabel">Are you sure to Decline CV?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-sm text-gray-600">Declining a CV will send a notification email to the CV sender, and this action cannot be undone.</p>
                    <form id="declineForm" action="" method="POST">
                        @csrf
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Continue Decline</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function openInvitationModal(actionUrl, email) {
            // Set the action URL for the form
            document.getElementById('invitationForm').action = actionUrl;
            // Set the email in the hidden input
            document.getElementById('emailInput').value = email;

            // Show the modal using Bootstrap's modal API
            var myModal = new bootstrap.Modal(document.getElementById('invitationModal'));
            myModal.show();
        }

        function openApproveModal(actionUrl) {
            document.getElementById('approveForm').action = actionUrl;
            var myModal = new bootstrap.Modal(document.getElementById('approveModal'));
            myModal.show();
        }

        function openDeclineModal(actionUrl) {
            document.getElementById('declineForm').action = actionUrl;
            var myModal = new bootstrap.Modal(document.getElementById('declineModal'));
            myModal.show();
        }

        function closeModal(modalId) {
            var modalElement = document.getElementById(modalId);
            var modal = bootstrap.Modal.getInstance(modalElement);
            modal.hide();
        }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const url = this.getAttribute('href');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    });
    </script>

    <!-- <div id="approveModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-4 w-full max-w-sm">
            <div class="mb-4 w-auto">
                <h3 class="text-m font-bold mb-2">Select Registration Code</h3>
                <p class="text-xs text-gray-700">Select the registration code that will be used by users to register their data on the Padma portal.</p>
            </div>

            <form id="approveForm" action="" method="POST">
                @csrf
                <div>
                    <select name="registration_code" required class="border py-2 px-2 rounded bg-gray-100 text-xs w-full">
                        <option value="" class="border py-2 px-2 rounded bg-gray-100 text-xs w-full">Select Code</option>
                        @foreach ($registrationCodes as $code)
                            <option class="text-black" value="{{ $code->registration_code }}">{{ $code->registration_code }}</option>
                        @endforeach
                    </select>

                    <div class="flex gap-2 w-full mt-4">
                        <hr>
                        <button type="button" class="text-white p-2 bg-red-500 text-xs rounded hover:bg-red-600 w-full" onclick="closeModal('approveModal')">Cancel</button>
                        <button type="submit" class="text-white p-2 bg-green-500 text-xs rounded hover:bg-green-600 w-full">Approve</button>
                    </div>
                </div>
            </form>
        </div>
    </div> -->


    <!-- <div id="declineModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-4 w-full max-w-sm">
            <div class="mb-4 w-auto">
                <h3 class="text-m font-bold mb-2 text-center">Are you sure to Decline CV?</h3>
                <p class="text-xs text-gray-700 text-center">Declining a CV will send a notification email to the CV sender, and this action cannot be undone.</p>
            </div>

            <form id="declineForm" action="" method="POST">
                @csrf
                <div class="flex gap-2 w-full mt-4">
                    <hr>
                    <button type="button" class="text-white p-2 bg-red-500 text-xs rounded hover:bg-red-600 w-full" onclick="closeModal('declineModal')">Cancel</button>
                    <button type="submit" class="text-white p-2 bg-green-500 text-xs rounded hover:bg-green-600 w-full">Continue Decline</button>
                </div>
            </form>
        </div>
    </div> -->


    <!-- <div id="invitationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 d-flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-sm">
            <div class="mb-4 w-auto">
                <h3 class="text-m font-bold mb-2 justify-center">Meeting Invitation</h3>
                <p class="text-xs text-gray-600">Schedule a meeting for your talent, add the meeting name mentioning the talent's name, for example, 'Interview Kayika,' along with the day and date.</p>
            </div>

            <form id="invitationForm" action="" method="POST">
                @csrf
                <input type="hidden" name="selected_emails[]" id="emailInput">

                <div class="space-y-1 mb-3">
                    <label for="name" class="block text-xs font-medium text-gray-900">Meeting Name</label>
                    <input type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 text-sm" placeholder="Enter meeting name">
                </div>

                <div class="space-y-1 mb-3">
                    <label for="meeting_date" class="block text-xs font-medium text-gray-900">Meeting Date</label>
                    <input type="date" name="meeting_date" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 text-sm">
                </div>

                <div class="space-y-1 mb-3">
                    <label for="meeting_time" class="block text-xs font-medium text-gray-900">Meeting Time</label>
                    <input type="time" name="meeting_time" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 text-sm">
                </div>

                <div class="flex gap-2 w-full mt-4">
                    <button type="button" class="text-white p-2 bg-red-500 text-xs rounded hover:bg-red-600 w-full" onclick="closeModal('invitationModal')">Cancel</button>
                    <button type="submit" class="text-white p-2 bg-green-500 text-xs rounded hover:bg-green-600 w-full">Send Invitation</button>
                </div>
            </form>
        </div>
    </div> -->


<!-- <script>
    // Open Modal Function
    function openModal(modalId, actionUrl = '', email = '') {
        if (actionUrl) {
            document.getElementById(`${modalId}Form`).action = actionUrl;
        }
        if (email) {
            document.getElementById('emailInput').value = email;
        }
        document.getElementById(modalId).classList.remove('hidden'); // Show the modal
    }

    // Close Modal Function
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden'); // Hide the modal
    }

    // Open specific modals with their respective URLs and emails
    function openApproveModal(actionUrl) {
        openModal('approveModal', actionUrl);
    }

    function openDeclineModal(actionUrl) {
        openModal('declineModal', actionUrl);
    }

    function openInvitationModal(actionUrl, email) {
        openModal('invitationModal', actionUrl, email);
    }
</script> -->
<!-- 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const url = this.getAttribute('href');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    });
</script> -->
@endsection