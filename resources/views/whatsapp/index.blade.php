@extends('layouts.admin')

@section('title', 'WhatsApp Automation Center')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-medium text-dark mb-1"><i class="fab fa-whatsapp text-success me-2"></i> WhatsApp Automation Center</h4>
        <p class="text-muted small mb-0">Configure your messaging gateway, view real-time logs, and monitor parent/student alerts</p>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 animate__animated animate__fadeIn">
    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 animate__animated animate__shakeX">
    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
</div>
@endif

<!-- Analytics Cards -->
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card border-0 bg-white p-4 shadow-sm h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 1px;">Total Dockets</div>
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
            </div>
            <h3 class="fw-bold text-dark mb-1">{{ $totalCount }}</h3>
            <span class="text-muted small">Dispatched logs</span>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 bg-white p-4 shadow-sm h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 1px;">Simulated</div>
                <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                    <i class="fas fa-laptop-code"></i>
                </div>
            </div>
            <h3 class="fw-bold text-success mb-1">{{ $simulatedCount }}</h3>
            <span class="text-muted small">Logged internally</span>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 bg-white p-4 shadow-sm h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 1px;">Live Sent</div>
                <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                    <i class="fas fa-paper-plane"></i>
                </div>
            </div>
            <h3 class="fw-bold text-info mb-1">{{ $sentCount }}</h3>
            <span class="text-muted small">Delivered to API</span>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 bg-white p-4 shadow-sm h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 1px;">Failed Dockets</div>
                <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
            <h3 class="fw-bold text-danger mb-1">{{ $failedCount }}</h3>
            <span class="text-muted small">Error transmissions</span>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Config Card -->
    <div class="col-lg-4">
        <div class="card border-0 bg-white shadow-sm p-4 h-100">
            <h5 class="fw-semibold text-dark mb-3"><i class="fas fa-cog text-muted me-2"></i> Gateway Configuration</h5>
            <hr class="mt-0 mb-4 text-muted opacity-25">
            
            <form action="{{ route('whatsapp.settings') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label small fw-semibold text-uppercase text-muted" style="letter-spacing: 0.5px;">Integration Mode</label>
                    <div class="d-flex flex-column gap-2 mt-1">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="mode" id="modeSim" value="simulator" {{ ($settings['mode'] ?? 'simulator') === 'simulator' ? 'checked' : '' }} onclick="toggleConfigFields(false)">
                            <label class="form-check-label text-dark fw-medium" for="modeSim">
                                Simulator / Log Mode (Default)
                            </label>
                            <span class="d-block text-muted small">No API calls. Messages are simulated and stored in the logs below.</span>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="radio" name="mode" id="modeLive" value="live" {{ ($settings['mode'] ?? 'simulator') === 'live' ? 'checked' : '' }} onclick="toggleConfigFields(true)">
                            <label class="form-check-label text-dark fw-medium" for="modeLive">
                                Live HTTP Gateway Mode
                            </label>
                            <span class="d-block text-muted small">Routes messages to custom API endpoint provider.</span>
                        </div>
                    </div>
                </div>
                
                <div id="liveFields" style="display: {{ ($settings['mode'] ?? 'simulator') === 'live' ? 'block' : 'none' }};">
                    <div class="mb-3">
                        <label for="endpoint" class="form-label small fw-semibold text-uppercase text-muted">Gateway Endpoint URL</label>
                        <input type="url" name="endpoint" id="endpoint" class="form-control" placeholder="https://api.gateway.com/send" value="{{ $settings['endpoint'] ?? '' }}">
                        <span class="text-muted small fs-7">The REST API URL of your WhatsApp service.</span>
                    </div>
                    
                    <div class="mb-3">
                        <label for="auth_token" class="form-label small fw-semibold text-uppercase text-muted">Auth Bearer Token / API Key</label>
                        <input type="text" name="auth_token" id="auth_token" class="form-control" placeholder="API key or token" value="{{ $settings['auth_token'] ?? '' }}">
                    </div>
                    
                    <div class="mb-4">
                        <label for="sender_id" class="form-label small fw-semibold text-uppercase text-muted">Sender ID / Connected Phone</label>
                        <input type="text" name="sender_id" id="sender_id" class="form-control" placeholder="e.g. 919999999999" value="{{ $settings['sender_id'] ?? '' }}">
                    </div>
                </div>
                
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-modern shadow-sm">
                        <i class="fas fa-save me-2"></i> Save Configuration
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Logs Card -->
    <div class="col-lg-8">
        <div class="card border-0 bg-white shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-semibold text-dark mb-0"><i class="fas fa-list text-muted me-2"></i> Message Transmissions</h5>
                @if(count($logs) > 0)
                <form action="{{ route('whatsapp.clear') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear all WhatsApp log files? This action is permanent.');">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1">
                        <i class="fas fa-trash me-1"></i> Clear Logs
                    </button>
                </form>
                @endif
            </div>
            <hr class="mt-0 mb-4 text-muted opacity-25">
            
            @if(count($logs) > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="text-uppercase text-muted small" style="font-size: 0.72rem; letter-spacing: 0.5px;">
                            <th>Recipient</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Time</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                        <tr>
                            <td>
                                <div class="fw-medium text-dark">{{ $log->recipient_name }}</div>
                            </td>
                            <td>
                                <span class="font-monospace text-secondary small">{{ $log->recipient_phone }}</span>
                            </td>
                            <td>
                                @if($log->message_type === 'fee_reminder')
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning-subtle">Fee Due</span>
                                @elseif($log->message_type === 'attendance_alert')
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle">Absent</span>
                                @elseif($log->message_type === 'exam_notification')
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info-subtle">Exam Date</span>
                                @elseif($log->message_type === 'exam_marks')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle">Marks Out</span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary-subtle">General</span>
                                @endif
                            </td>
                            <td>
                                @if($log->status === 'simulated')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle" title="Logged internally in Simulator Mode"><i class="fas fa-laptop-code me-1"></i> Simulated</span>
                                @elseif($log->status === 'sent')
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info-subtle" title="Dispatched successfully via HTTP API"><i class="fas fa-check me-1"></i> Sent</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle" title="{{ $log->error_message }}"><i class="fas fa-times me-1"></i> Failed</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-muted small">{{ $log->created_at->diffForHumans() }}</span>
                            </td>
                            <td class="text-end">
                                <textarea id="log-body-{{ $log->id }}" style="display: none;">{{ $log->message_body }}</textarea>
                                @if($log->error_message)
                                    <textarea id="log-error-{{ $log->id }}" style="display: none;">{{ $log->error_message }}</textarea>
                                @endif
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1 view-log-btn" data-bs-toggle="modal" data-bs-target="#messageModal" data-id="{{ $log->id }}" data-name="{{ $log->recipient_name }}" data-status="{{ $log->status }}">
                                    <i class="far fa-eye"></i> View
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $logs->links() }}
            </div>
            @else
            <div class="p-5 text-center text-muted">
                <div class="d-inline-flex border border-success p-4 rounded-circle mb-3 bg-success bg-opacity-10 text-success">
                    <i class="fab fa-whatsapp fa-2x"></i>
                </div>
                <h5 class="fw-medium text-dark">No transmissions recorded</h5>
                <p class="text-muted small mb-0">Dispatched notifications will show up here in real-time.</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- View Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-semibold text-dark" id="modalTitle">Message View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3">
                <div class="p-3 rounded-3 bg-light border font-monospace text-dark text-pre-wrap mb-3" id="modalBody" style="white-space: pre-wrap; font-size: 0.88rem;"></div>
                
                <div id="errorSection" class="p-3 rounded-3 bg-danger bg-opacity-10 border border-danger-subtle d-none">
                    <div class="small fw-semibold text-danger mb-1"><i class="fas fa-exclamation-circle me-1"></i> Transmission Error Details</div>
                    <div class="text-danger small" id="modalError" style="font-size: 0.82rem;"></div>
                </div>
            </div>
            <div class="modal-footer border-top-0 pt-0">
                <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function toggleConfigFields(show) {
        const fields = document.getElementById('liveFields');
        fields.style.display = show ? 'block' : 'none';
    }

    // Listen to show.bs.modal event when the modal is about to open
    document.addEventListener('show.bs.modal', function(event) {
        if (event.target.id === 'messageModal') {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const status = button.getAttribute('data-status');
            
            const body = document.getElementById('log-body-' + id).value;
            const errorEl = document.getElementById('log-error-' + id);
            const error = errorEl ? errorEl.value : '';

            document.getElementById('modalTitle').innerText = 'WhatsApp Docket for ' + name;
            document.getElementById('modalBody').innerText = body;
            
            const errSec = document.getElementById('errorSection');
            if (status === 'failed' && error) {
                errSec.classList.remove('d-none');
                document.getElementById('modalError').innerText = error;
            } else {
                errSec.classList.add('d-none');
            }
        }
    });
</script>
@endpush
@endsection
