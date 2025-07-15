@extends('users.Talent.layouts.dashboard-app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Project Tracing</h3>
    <div class="card mb-4">
        <div class="card-body text-center">
            <h1 id="timer" class="display-3 mb-3">00:00:00</h1>
            <div id="status" class="mb-3 text-secondary">Status: <span id="workStatus">Not Started</span></div>
            <div class="btn-group mb-2" role="group">
                <button id="startBtn" class="btn btn-success">Start Work</button>
                <button id="pauseBtn" class="btn btn-warning" style="display:none;">Pause</button>
                <button id="resumeBtn" class="btn btn-primary" style="display:none;">Resume</button>
                <button id="restBtn" class="btn btn-info" style="display:none;">Get Rest</button>
                <button id="endBtn" class="btn btn-danger" style="display:none;">End Work</button>
            </div>
        </div>
    </div>

    <!-- Pause Reason Modal -->
    <div class="modal fade" id="pauseReasonModal" tabindex="-1" aria-labelledby="pauseReasonModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="pauseReasonModalLabel">Pause Reason</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <textarea id="pauseReasonInput" class="form-control" rows="3" placeholder="Enter reason for pausing..."></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="submitPauseReason">Submit</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Calendar Section -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Tracing Calendar</h5>
            <div id="calendar" class="mb-3"></div>
            <div id="daySummary" style="display:none;"></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Timer logic
let timerInterval;
let elapsed = 0;
let status = 'not_started';

function updateTimerDisplay() {
    const hours = String(Math.floor(elapsed / 3600)).padStart(2, '0');
    const minutes = String(Math.floor((elapsed % 3600) / 60)).padStart(2, '0');
    const seconds = String(elapsed % 60).padStart(2, '0');
    document.getElementById('timer').textContent = `${hours}:${minutes}:${seconds}`;
}

function setStatus(newStatus) {
    status = newStatus;
    document.getElementById('workStatus').textContent =
        newStatus.charAt(0).toUpperCase() + newStatus.slice(1).replace('_', ' ');
    // Button visibility
    document.getElementById('startBtn').style.display = (status === 'not_started') ? '' : 'none';
    document.getElementById('pauseBtn').style.display = (status === 'working') ? '' : 'none';
    document.getElementById('resumeBtn').style.display = (status === 'paused') ? '' : 'none';
    document.getElementById('restBtn').style.display = (status === 'working') ? '' : 'none';
    document.getElementById('endBtn').style.display = (status === 'working' || status === 'paused' || status === 'resting') ? '' : 'none';
}

function startTimer() {
    timerInterval = setInterval(() => {
        elapsed++;
        updateTimerDisplay();
    }, 1000);
}
function stopTimer() {
    clearInterval(timerInterval);
}

document.getElementById('startBtn').onclick = function() {
    setStatus('working');
    startTimer();
};
document.getElementById('pauseBtn').onclick = function() {
    stopTimer();
    // Show modal
    var pauseModal = new bootstrap.Modal(document.getElementById('pauseReasonModal'));
    pauseModal.show();
};
document.getElementById('resumeBtn').onclick = function() {
    setStatus('working');
    startTimer();
};
document.getElementById('restBtn').onclick = function() {
    setStatus('resting');
    stopTimer();
};
document.getElementById('endBtn').onclick = function() {
    setStatus('ended');
    stopTimer();
};
document.getElementById('submitPauseReason').onclick = function() {
    const reason = document.getElementById('pauseReasonInput').value.trim();
    if (reason.length === 0) {
        alert('Please enter a reason.');
        return;
    }
    setStatus('paused');
    document.getElementById('pauseReasonInput').value = '';
    var pauseModal = bootstrap.Modal.getInstance(document.getElementById('pauseReasonModal'));
    pauseModal.hide();
};

// Calendar mockup (replace with real calendar library if needed)
const calendar = document.getElementById('calendar');
const today = new Date();
const daysInMonth = new Date(today.getFullYear(), today.getMonth()+1, 0).getDate();
let calendarHtml = '<table class="table table-bordered"><tr>';
for (let d = 1; d <= daysInMonth; d++) {
    if ((d-1) % 7 === 0 && d !== 1) calendarHtml += '</tr><tr>';
    // Mock: highlight today and a few random days
    let highlight = (d === today.getDate()) ? 'bg-success text-white' : ((d % 5 === 0) ? 'bg-info text-white' : '');
    calendarHtml += `<td class='${highlight}' style='cursor:pointer' onclick='showDaySummary(${d})'>${d}</td>`;
}
calendarHtml += '</tr></table>';
calendar.innerHTML = calendarHtml;

window.showDaySummary = function(day) {
    // Mock summary
    const summary = `<div class='alert alert-info'>Summary for ${today.getFullYear()}-${String(today.getMonth()+1).padStart(2,'0')}-${String(day).padStart(2,'0')}:<br>Worked: 3h 20m<br>Paused: 2x<br>Rest: 1x</div>`;
    document.getElementById('daySummary').innerHTML = summary;
    document.getElementById('daySummary').style.display = '';
};

setStatus('not_started');
updateTimerDisplay();
</script>
@endpush
@endsection
