@extends('layouts.admin')

@section('title', 'Class Chatroom')

@section('content')
<div class="row g-4 h-100" style="min-height: calc(100vh - 120px);">
    <!-- Batches List (Sidebar) -->
    <div class="col-md-4 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <h6 class="fw-bold text-dark mb-0">Your Batches</h6>
                <p class="text-muted small mb-0">Select a class to start chatting</p>
            </div>
            <div class="card-body p-3 overflow-y-auto" style="max-height: 480px;">
                @if($batches->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-layer-group fa-2x text-muted opacity-30 mb-2"></i>
                        <p class="text-muted small mb-0">No active batches assigned.</p>
                    </div>
                @else
                    <div class="list-group list-group-flush">
                        @foreach($batches as $batch)
                            <a href="{{ route('class-chat.index', ['batch_id' => $batch->id]) }}" 
                               class="list-group-item list-group-item-action border-0 rounded-3 mb-2 p-3 d-flex align-items-center justify-content-between {{ $selectedBatch && $selectedBatch->id === $batch->id ? 'bg-primary text-white active' : '' }}"
                               style="transition: all 0.2s;">
                                <div class="min-w-0">
                                    <div class="fw-semibold text-truncate">{{ $batch->name }}</div>
                                    <div class="small {{ $selectedBatch && $selectedBatch->id === $batch->id ? 'text-white-50' : 'text-muted' }}">{{ $batch->schedule_time ?? 'No Schedule' }}</div>
                                </div>
                                @if($selectedBatch && $selectedBatch->id === $batch->id)
                                    <i class="fas fa-chevron-right text-white"></i>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Chat window -->
    <div class="col-md-8 col-lg-9">
        @if($selectedBatch)
            <div class="card border-0 shadow-sm h-100 d-flex flex-column" style="border-radius: 16px; min-height: 500px;">
                <!-- Chat Header -->
                <div class="card-header bg-white border-bottom-0 py-3 px-4 d-flex align-items-center justify-content-between" style="border-top-left-radius: 16px; border-top-right-radius: 16px;">
                    <div>
                        <h6 class="fw-bold text-dark mb-0">{{ $selectedBatch->name }}</h6>
                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1" style="font-size:0.75rem;">
                            <span class="d-inline-block rounded-circle bg-success me-1.5" style="width: 6px; height: 6px;"></span>Class Chat Active
                        </span>
                    </div>
                    <div class="text-muted small">
                        Teacher: <span class="fw-medium text-dark">{{ $selectedBatch->classTeacher->name ?? 'None' }}</span>
                    </div>
                </div>

                <!-- Messages Feed -->
                <div class="card-body p-4 bg-light flex-grow-1 overflow-y-auto" id="chatWindow" style="max-height: 400px; min-height: 350px;">
                    <div class="d-flex align-items-center justify-content-center h-100" id="chatLoading">
                        <div class="spinner-border text-primary spinner-border-sm me-2" role="status"></div>
                        <span class="text-muted small">Loading chat history...</span>
                    </div>
                    <div id="messagesContainer" class="d-flex flex-column gap-3 d-none">
                        <!-- Messages render here -->
                    </div>
                </div>

                <!-- Chat Input Form -->
                <div class="card-footer bg-white border-top-0 p-3" style="border-bottom-left-radius: 16px; border-bottom-right-radius: 16px;">
                    <form id="sendMessageForm" class="d-flex gap-2">
                        @csrf
                        <input type="text" id="messageInput" class="form-control rounded-pill border-light-subtle px-4 py-2.5 shadow-none" placeholder="Type your message here..." required autocomplete="off">
                        <button type="submit" class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; flex-shrink:0;">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="card border-0 shadow-sm h-100 d-flex align-items-center justify-content-center text-center p-5" style="border-radius: 16px; min-height: 500px;">
                <div>
                    <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 72px; height: 72px;">
                        <i class="fas fa-comments fa-2x"></i>
                    </div>
                    <h5 class="fw-bold text-dark">No Class Selected</h5>
                    <p class="text-muted mx-auto" style="max-width: 320px;">Please select one of your assigned batches from the left sidebar to access the chatroom.</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
@if($selectedBatch)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const batchId = "{{ $selectedBatch->id }}";
        const fetchUrl = "{{ route('class-chat.messages', $selectedBatch->id) }}";
        const sendUrl = "{{ route('class-chat.send', $selectedBatch->id) }}";
        
        const chatWindow = document.getElementById('chatWindow');
        const chatLoading = document.getElementById('chatLoading');
        const messagesContainer = document.getElementById('messagesContainer');
        const sendForm = document.getElementById('sendMessageForm');
        const messageInput = document.getElementById('messageInput');

        let lastMessageCount = 0;

        function loadMessages(isFirstLoad = false) {
            fetch(fetchUrl)
                .then(response => response.json())
                .then(data => {
                    if (isFirstLoad) {
                        chatLoading.classList.add('d-none');
                        messagesContainer.classList.remove('d-none');
                    }

                    if (data.messages && data.messages.length !== lastMessageCount) {
                        renderMessages(data.messages);
                        lastMessageCount = data.messages.length;
                        scrollToBottom();
                    }
                })
                .catch(err => console.error("Error loading chat messages:", err));
        }

        function renderMessages(messages) {
            messagesContainer.innerHTML = '';
            if (messages.length === 0) {
                messagesContainer.innerHTML = `
                    <div class="text-center py-5 text-muted small">
                        <i class="fas fa-comment-dots fa-2x mb-2 opacity-30"></i>
                        <div>No messages yet. Start the conversation!</div>
                    </div>
                `;
                return;
            }

            messages.forEach(msg => {
                const isMe = msg.is_me;
                const bubbleBg = isMe ? 'bg-primary text-white' : 'bg-white text-dark shadow-sm border border-light-subtle';
                const alignmentClass = isMe ? 'align-self-end text-end' : 'align-self-start';
                const flexLayout = isMe ? 'flex-row-reverse' : 'flex-row';
                const avatarMargin = isMe ? 'ms-2' : 'me-2';

                const avatar = msg.sender_avatar 
                    ? `<img src="${msg.sender_avatar}" alt="${msg.sender_name}" class="rounded-circle border border-white" style="width: 30px; height: 30px; object-fit: cover;">`
                    : `<div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 0.7rem;">${msg.sender_name.substring(0,2).toUpperCase()}</div>`;

                const msgHtml = `
                    <div class="d-flex ${flexLayout} ${alignmentClass} max-w-75">
                        <div class="flex-shrink-0 mt-1 ${avatarMargin}">
                            ${avatar}
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-1.5 mb-1 justify-content-start ${isMe ? 'flex-row-reverse' : 'flex-row'}">
                                <span class="fw-semibold text-dark" style="font-size: 0.75rem;">${msg.sender_name}</span>
                                <span class="badge ${isMe ? 'bg-primary-subtle text-primary' : 'bg-secondary-subtle text-muted'}" style="font-size: 0.6rem;">${msg.sender_role}</span>
                            </div>
                            <div class="p-3 rounded-4 ${bubbleBg} text-start d-inline-block" style="font-size: 0.9rem; max-width: 100%; word-break: break-word;">
                                ${msg.message}
                            </div>
                            <div class="text-muted mt-1" style="font-size: 0.65rem;">${msg.time}</div>
                        </div>
                    </div>
                `;
                messagesContainer.innerHTML += msgHtml;
            });
        }

        function scrollToBottom() {
            chatWindow.scrollTop = chatWindow.scrollHeight;
        }

        sendForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const text = messageInput.value.trim();
            if (!text) return;

            messageInput.disabled = true;

            fetch(sendUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({ message: text })
            })
            .then(res => res.json())
            .then(data => {
                messageInput.disabled = false;
                if (data.success) {
                    messageInput.value = '';
                    loadMessages();
                }
            })
            .catch(err => {
                messageInput.disabled = false;
                console.error("Error sending message:", err);
            });
        });

        // Initialize & Poll every 4 seconds
        loadMessages(true);
        setInterval(loadMessages, 4000);
    });
</script>
@endif
@endpush
