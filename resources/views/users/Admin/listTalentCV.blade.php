@extends('Users.Admin.layouts.app')

@section('title')
    Admin Dashboard | Talent CV
@endsection

@section('content')
    <!-- Start breadcrumb -->
    <div class="container mx-auto px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Home</a></li>
                <li class="breadcrumb-item text-xs"><a href="{{ route('admin#index') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-xs" aria-current="page">List Talent CV</li>
            </ol>
        </nav>
    </div>
    <!-- END breadcrumb -->

    <!-- Start content -->
    <div class="container mx-auto px-4">

        <div class="mb-2 w-full mx-auto  sm:flex sm:items-center sm:justify-between ">
            <h1 class="text-xl font-bold text-left mt-3">
               Talent CV Data
            </h1>
            <form method="GET" action="{{ route('admin#talentCVList') }}">
                <select name="status" id="status" onchange="this.form.submit()" class="border py-2 px-2 rounded bg-gray-100 text-xs" >
                    <option value="" class="text-xs">All</option>
                    <option value="In Review" {{ request('status') == 'In Review' ? 'selected' : '' }} class="text-xs">In Review</option>
                    <option value="Interview Process" {{ request('status') == 'Interview Process' ? 'selected' : '' }} class="text-xs">Interview Process</option>
                    <option value="approve" {{ request('status') == 'approve' ? 'selected' : '' }} class="text-xs">Approved</option>
                    <option value="decline" {{ request('status') == 'decline' ? 'selected' : '' }} class="text-xs">Declined</option>
                </select>
            </form>
        </div>

        <!-- Flash messages for success -->
        @if (Session::has('successCV'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-xs" role="alert">
                {{ Session::get('successCV') }}
            </div>
        @endif
        @if (Session::has('CVDeleted'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4 text-xs" role="alert">
                {{ Session::get('CVDeleted') }}
            </div>
        @endif
        @if (Session::has('errorCV'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-xs" role="alert">
                {{ Session::get('errorCV') }}
            </div>
        @endif


        <!-- Table with updated style -->
        <div class="flex flex-col">
            <div class="-mx-4 overflow-x-auto">
                <div class="inline-block min-w-full py-2 align-middle">
                    <div class="overflow-hidden border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-2 text-center text-xs font-semibold text-gray-500 uppercase">
                                        No.
                                    </th>
                                    <th scope="col" class="px-6 py-2 text-center text-xs font-semibold text-gray-500 uppercase">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-2 text-center text-xs font-semibold text-gray-500 uppercase">
                                        Email
                                    </th>
                                    <th scope="col" class="py-2 text-center text-xs font-semibold text-gray-500 uppercase">
                                        Phone Number
                                    </th>
                                    <th scope="col" class="py-2 text-center text-xs font-semibold text-gray-500 uppercase">
                                        CV Files
                                    </th>
                                    <th scope="col" class="px-6 py-2 text-center text-xs font-semibold text-gray-500 uppercase">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-2 text-center text-xs font-semibold text-gray-500 uppercase">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($talentCV as $CV)
                                    <tr>
                                        <td class="px-6 py-2 whitespace-nowrap text-xs font-medium text-gray-800">
                                            {{ ($talentCV->currentPage() - 1) * $talentCV->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-2  whitespace-nowrap text-xs text-gray-800 hidden">{{ $CV->id }}</td>
                                        <td class="px-6 py-2  whitespace-nowrap text-xs text-gray-800">{{ $CV->name }}</td>
                                        <td class="px-6 py-2  whitespace-nowrap text-xs text-gray-800">{{ $CV->email }}</td>
                                        <td class="px-6 py-2  whitespace-nowrap text-xs text-gray-800">{{ $CV->phone_number }}</td>

                                        <!-- Tampilkan file PDF -->
                                        <td class="p-2 whitespace-nowrap text-xs text-blue-800 underline ">
                                            <a href="{{ asset('laravel/storage/app/public/' . $CV->cv_file) }}" target="_blank" cl>Download PDF</a>
                                        </td>

                                        <td class="px-6 py-2 whitespace-nowrap text-xs text-gray-800">
                                            @if($CV->status=='approve')
                                                <span class="text-green-500 p-2 bg-green-100 text-xs rounded" >{{ $CV->status }}</span>
                                            @elseif($CV->status=='decline')
                                                <span class="text-red-500 p-2 bg-red-100 text-xs rounded" >{{ $CV->status }}</span>
                                            @elseif($CV->status=='Interview Process')
                                                <span class="text-yellow-500 p-2 bg-yellow-100 text-xs rounded" >{{ $CV->status }}</span>
                                            @elseif($CV->status=='In Review')
                                                <span class="text-blue-500 p-2 bg-blue-100 text-xs rounded" >{{ $CV->status }}</span>
                                            @else
                                                <span class="text-blue-500 p-2 bg-blue-100 text-xs rounded" >Pending</span>
                                            @endif
                                        </td>

                                        <td class=" flex gap-2 px-6 py-2 whitespace-nowrap text-center text-sm font-medium">

                                            @if($CV->status=='In Review')
                                                <button type="button" class="text-white p-2 bg-blue-500 text-xs rounded hover:bg-blue-600" onclick="openInvitationModal('{{ route('booking.submit', $CV->id) }}', '{{ $CV->email }}')">Schedule Meeting</button>
                                            @elseif($CV->status=='Interview Process')

                                            <button type="button" class="text-white p-2 bg-red-500 text-xs rounded hover:bg-red-600" onclick="openDeclineModal('{{ route('cv#decline', $CV->id) }}')">Decline</button>



                                                <button type="button" class="text-white p-2 bg-green-500 text-xs rounded hover:bg-green-600" onclick="openApproveModal('{{ route('approveCV', $CV->id) }}')">Approve</button>
                                            @else
                                                <a href="{{ route('admin#deleteCV', $CV->id) }}" class="btn-delete">
                                                    <button type="button" class="text-white p-2 bg-red-500 text-xs rounded hover:bg-red-600">
                                                        Delete
                                                    </button>
                                                </a>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div class="">
                            {{ $talentCV->links() }}
                        </div>

                    </div>

                    <!-- Approve Modal -->
                    <div id="approveModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white rounded-lg p-4 w-full max-w-sm">
                            <div class="mb-4 w-auto">
                                <h3 class="text-m font-bold mb-2">Select Registration Code</h3>
                                <p class="text-xs text-gray-700">Select the registration code that will be used by users to register their data on the Padma portal.</p>
                            </div>


                            <form id="approveForm" action="" method="POST">
                                @csrf
                                <div>
                                    <select  name="registration_code" required class="border py-2 px-2 rounded bg-gray-100 text-xs w-full">
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
                    </div>

                    <div id="declineModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
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
                    </div>

                    <!-- Send Invitation Modal -->
                    <div id="invitationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
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
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- End content-->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document
                .querySelectorAll('.btn-delete')
                .forEach(button => {
                    button.addEventListener('click', function (event) {
                        event.preventDefault();

                        const url = this.getAttribute('href');

                        Swal
                            .fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!',
                                cancelButtonText: 'Cancel'
                            })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect to the URL
                                    window.location.href = url;
                                }
                            });
                    });
                });
        });
    </script>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>

    <script>
        function openApproveModal(actionUrl) {
            document.getElementById('approveForm').action = actionUrl; // Set the action URL for the form
            document.getElementById('approveModal').classList.remove('hidden'); // Show the modal
        }

        function openDeclineModal(actionUrl) {
            document.getElementById('declineForm').action = actionUrl; // Set the action URL for the form
            document.getElementById('declineModal').classList.remove('hidden'); // Show the modal
        }

        function openInvitationModal(actionUrl, email) {
            document.getElementById('invitationForm').action = actionUrl; // Set the action URL for the form
            document.getElementById('emailInput').value = email; // Set the email in the hidden input
            document.getElementById('invitationModal').classList.remove('hidden'); // Show the modal
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden'); // Hide the modal
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
