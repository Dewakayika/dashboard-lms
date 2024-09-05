@section('title')
    Volunteer Dashboard
@endsection

@extends('Users.Volunteer.layouts.app')

@section('content')
    <!-- Start breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('volunteer#index') }}">Home</a></li>
                <li class="breadcrumb-item active">Volunteer Dashboard</li>
            </ol>
        </nav>
    </div>

    <!-- END breadcrumb -->

    <div class="container">
        <div class="mt-0 mb-3 gap-4 row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 g-5">

                @forelse ($campaignData as $campaign)
                <div class="card">
                    <img src="{{ asset('uploads/campaign/' . $campaign->campaign_image) }}" class="img-thumbnail" 
                    alt="Images">
                    <div class="card-body">
                        <h1 style="font-size: 1.5rem">{{$campaign->campaign_title}}</h1>
                        <p class="card-text">{{$campaign->campaign_location}}</p>
                        <p class="text-muted">{{$campaign->campaign_description}}</p>
                        @if ($validateCampaign->where('campaign_id', $campaign->id)->isEmpty())
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#campaignModal"
                            data-bs-whatever="{{ $campaign->id }}">Accept</button>
                    @else
                        <span x-jet:loading x-jet:target="Campaign">Accepted</span>
                    @endif
                    </div>
                </div>
                @empty
                <div class="w-screen py-8 text-xl text-mow-red">
                    <h2 class="text-center text-2xl"> NO CAMPAIGN HAS BEEN ADDED </h2>
                </div>
                @endforelse
        </div>
    </div>
    
    <div class="modal fade" id="campaignModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Campaign</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('volunteer#volunteerConfirmCamp') }}" method="get">
                        <div class="">
                            <input type="hidden" class="form-control" name="campaign_id" id="campaign_id">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Document:</label>
                            <input name="documents" type="file" class="form-control" required id="campaign_document" />
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Advantages:</label>
                            <textarea name="advantages" class="form-control" required id="campaign_advantage"></textarea>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Confirm</button>
                        <div class="btn btn-secondary" data-bs-dismiss="modal">Close</div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <script>
        const campaignModal = document.getElementById('campaignModal')
        const form = document.getElementById('formCampaign')
        campaignModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget
            const campaginId = button.getAttribute('data-bs-whatever')
            const modalCampaignId = campaignModal.querySelector('.modal-body #campaign_id')
            const modalCampaignDocument = campaignModal.querySelector('.modal-body #campaign_document')
            const modalCampaignAdvantage = campaignModal.querySelector('.modal-body #campaign_advantage')

            modalCampaignId.value = campaginId
            modalCampaignAdvantage.value = ''
            modalCampaignDocument.value = ''
        })
    </script>
@endsection
