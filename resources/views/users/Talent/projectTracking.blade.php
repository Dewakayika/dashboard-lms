@extends('users.Talent.layouts.dashboard-app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Project Tracing</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(isset($currentTracing) && $currentTracing)
        <div class="alert alert-info mb-3 text-white">
            <strong>Current Session:</strong><br>
            {{-- format date to dd/mm/yyyy hh:mm:ss --}}
            Started at: {{ \Carbon\Carbon::parse($currentTracing->start_time)->format('d/m/Y H:i:s') }}<br>
            Status: {{ ucfirst($currentTracing->status) }}<br>
            @if($currentTracing->pause_count > 0)
                Paused: {{ $currentTracing->pause_count }} times<br>
            @endif
            @if($currentTracing->rest_count > 0)
                Rested: {{ $currentTracing->rest_count }} times<br>
            @endif
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-body text-center">
            <h1 id="tracing-timer" class="display-3 mb-3"></h1>
            <div id="status" class="mb-3 text-secondary">Status: <span id="workStatus">{{ $currentTracing->status ?? 'not_started' }}</span></div>
            <div class="btn-group mb-2 gap-2" role="group">
                <form method="POST" action="{{ url('/talent/project-tracing/start') }}" style="display:inline;">
                    @csrf
                    <button type="submit" id="startBtn" class="btn btn-success" @if(isset($currentTracing) && in_array($currentTracing->status, ['working','paused','resting'])) style="display:none;" @endif>Start Work</button>
                </form>
                @if(isset($currentTracing) && $currentTracing->status === 'working')
                    <button type="button" class="btn btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#pauseReasonModal">Pause</button>
                    <form method="POST" action="{{ url('/talent/project-tracing/'.$currentTracing->id.'/rest') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-info rounded-pill">Get Rest</button>
                    </form>
                    <!-- End Work Button triggers modal -->
                    <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#endWorkModal">End Work</button>
                @elseif(isset($currentTracing) && $currentTracing->status === 'paused')
                    <form method="POST" action="{{ url('/talent/project-tracing/'.$currentTracing->id.'/resume') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Resume</button>
                    </form>
                    <!-- End Work Button triggers modal -->
                    <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#endWorkModal">End Work</button>
                @elseif(isset($currentTracing) && $currentTracing->status === 'resting')
                    <form method="POST" action="{{ url('/talent/project-tracing/'.$currentTracing->id.'/resume') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Resume</button>
                    </form>
                    <!-- End Work Button triggers modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#endWorkModal">End Work</button>
                @endif
            </div>
        </div>
    </div>

    <!-- Pause Reason Modal -->
    <div class="modal fade" id="pauseReasonModal" tabindex="-1" aria-labelledby="pauseReasonModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="{{ isset($currentTracing) ? url('/talent/project-tracing/'.$currentTracing->id.'/pause') : '#' }}">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="pauseReasonModalLabel">Pause Reason</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <textarea name="reason" class="form-control" rows="3" placeholder="Enter reason for pausing..." required></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- End Work Modal -->
    <div class="modal fade" id="endWorkModal" tabindex="-1" aria-labelledby="endWorkModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="{{ isset($currentTracing) ? url('/talent/project-tracing/'.$currentTracing->id.'/end') : '#' }}">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="endWorkModalLabel">Project Report</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <label for="project_report" class="form-label">What have you done?</label>
              <textarea name="project_report" id="project_report" class="form-control" rows="4" placeholder="Describe your work..." required></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger rounded-pill">End Work</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Recap Table Section -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Daily Tracing Recap</h5>
            <form method="GET" action="" class="d-flex align-items-center mb-3" style="gap: 0.75rem;">
                <div style="display: flex; gap: 0.75rem;">
                    <select name="month" id="month" class="form-select form-select-sm" style="min-width: 110px;" onchange="this.form.submit()">
                        @foreach(range(1,12) as $m)
                            <option value="{{ $m }}" {{ request('month', now()->month) == $m ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
                        @endforeach
                    </select>
                    <select name="year" id="year" class="form-select form-select-sm" style="min-width: 90px;" onchange="this.form.submit()">
                        @foreach($availableYears ?? [now()->year] as $year)
                            <option value="{{ $year }}" {{ request('year', now()->year) == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            <div class="mb-2 text-muted small">
                Showing daily recap for <strong>{{ \Carbon\Carbon::create()->month(request('month', now()->month))->format('F') }}</strong> {{ request('year', now()->year) }}
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Total Working Time</th>
                            <th>Project Report</th>
                            <th>Pause Count</th>
                            <th>Rest Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($endedRecaps as $recap)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($recap->date)->format('d/m/Y') }}</td>
                                <td>
                                    @php
                                        $h = floor($recap->total_working_time / 3600);
                                        $m = floor(($recap->total_working_time % 3600) / 60);
                                        $s = $recap->total_working_time % 60;
                                    @endphp
                                    {{ sprintf('%02d:%02d:%02d', $h, $m, $s) }}
                                </td>
                                <td>{{ $recap->project_report }}</td>
                                <td>{{ $recap->pause_count }}</td>
                                <td>{{ $recap->rest_count }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
document.addEventListener('DOMContentLoaded', function() {
    const timerElem = document.getElementById('tracing-timer');
    const tracingStatus = '{{ $currentTracing->status ?? 'not_started' }}';
    // Use backend-passed elapsedSeconds for all states
    const elapsedSeconds = {{ isset($elapsedSeconds) ? $elapsedSeconds : 0 }};
    let interval = null;

    function updateTimerDisplay(elapsed) {
        const hours = String(Math.floor(elapsed / 3600)).padStart(2, "0");
        const minutes = String(Math.floor((elapsed % 3600) / 60)).padStart(2, "0");
        const seconds = String(elapsed % 60).padStart(2, "0");
        timerElem.textContent = `${hours}:${minutes}:${seconds}`;
    }

    if (tracingStatus === 'working') {
        let elapsed = elapsedSeconds;
        updateTimerDisplay(elapsed);
        interval = setInterval(function() {
            elapsed++;
            updateTimerDisplay(elapsed);
        }, 1000);
    } else {
        updateTimerDisplay(elapsedSeconds);
    }
});
</script>

@endsection
