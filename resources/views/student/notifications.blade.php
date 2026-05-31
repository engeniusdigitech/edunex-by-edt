@extends('student.layouts.app')

@section('title', 'Notifications')

@push('styles')
<style>
    .notif-card {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 16px;
        transition: all 0.2s;
        display: flex;
        gap: 16px;
        align-items: flex-start;
    }
    .notif-card.unread {
        background: #F0F9FF;
        border-color: #BAE6FD;
    }
    .notif-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    .notif-content {
        flex: 1;
    }
    .notif-title {
        font-weight: 600;
        color: #0F172A;
        margin-bottom: 4px;
    }
    .notif-message {
        font-size: 0.9rem;
        color: #475569;
        margin-bottom: 8px;
        line-height: 1.5;
    }
    .notif-time {
        font-size: 0.75rem;
        color: #94A3B8;
        display: flex;
        align-items: center;
        gap: 6px;
    }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-medium mb-1">Notifications</h4>
        <p class="text-muted small mb-0">Stay updated with your latest alerts</p>
    </div>
</div>

<div class="notifications-list">
    @forelse($student->notifications as $notification)
        @php
            $color = $notification->data['color'] ?? 'primary';
            if ($color === 'danger') $color = 'danger';
            elseif ($color === 'warning') $color = 'warning';
            elseif ($color === 'success') $color = 'success';
            elseif ($color === 'info') $color = 'info';
            else $color = 'primary';
        @endphp
        <div class="notif-card {{ is_null($notification->read_at) ? 'unread' : '' }}">
            <div class="notif-icon text-{{ $color }} bg-{{ $color }} bg-opacity-10">
                <i class="fas {{ $notification->data['icon'] ?? 'fa-bell' }}"></i>
            </div>
            <div class="notif-content">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="notif-title">{{ $notification->data['title'] ?? 'Notification' }}</div>
                    @if(is_null($notification->read_at))
                        <span class="badge bg-primary rounded-pill" style="font-size: 0.65rem;">New</span>
                    @endif
                </div>
                <div class="notif-message">{{ $notification->data['message'] ?? '' }}</div>
                <div class="notif-time">
                    <i class="far fa-clock"></i> {{ $notification->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-5">
            <i class="far fa-bell-slash fa-3x text-muted mb-3 opacity-50"></i>
            <h5 class="fw-medium text-muted">No Notifications</h5>
            <p class="text-muted small">You're all caught up!</p>
        </div>
    @endforelse
</div>

@if($student->unreadNotifications->count() > 0)
    <script>
        // Auto-mark notifications as read when visiting this page
        document.addEventListener('DOMContentLoaded', function() {
            @foreach($student->unreadNotifications as $notif)
                fetch('{{ route('student.notifications.read', $notif->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
            @endforeach
        });
    </script>
@endif
@endsection
