@extends('student.layouts.app')

@section('title', 'Class Chatroom')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card border-0 shadow-sm d-flex flex-column" style="border-radius: 20px; min-height: 520px; background: #fff;">
            <!-- Header -->
            <div class="card-header bg-white border-bottom-0 py-3 px-4 d-flex align-items-center justify-content-between" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                <div>
                    <h5 class="fw-bold text-dark mb-0"><i class="fas fa-comments text-primary me-2"></i>{{ $batch->name }} Chatroom</h5>
                    <span class="badge bg-primary-subtle text-primary border-0 rounded-pill px-2.5 py-1" style="font-size:0.75rem; font-weight: 500; margin-top: 4px;">
                        <span class="d-inline-block rounded-circle bg-primary me-1.5 animate-pulse" style="width: 6px; height: 6px;"></span>Class Connect
                    </span>
                </div>
                <div class="text-muted small">
                    Class Teacher: <span class="fw-bold text-dark">{{ $batch->classTeacher->name ?? 'None' }}</span>
                </div>
            </div>

            <!-- Messages Box -->
            <div class="card-body p-4 bg-light flex-grow-1 overflow-y-auto" id="chatWindow" style="max-height: 380px; min-height: 350px;">
                <div class="d-flex align-items-center justify-content-center h-100" id="chatLoading">
                    <div class="spinner-border text-primary spinner-border-sm me-2" role="status"></div>
                    <span class="text-muted small">Connecting to classroom chat...</span>
                </div>
                <div id="messagesContainer" class="d-flex flex-column gap-3 d-none">
                    <!-- Messages render here -->
                </div>
            </div>

            <!-- Footer Message Input -->
            <div class="card-footer bg-white border-top-0 p-3" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
                <form id="sendMessageForm" class="d-flex gap-2">
                    @csrf
                    <input type="text" id="messageInput" class="form-control rounded-pill border-light-subtle px-4 py-2.5 shadow-none" placeholder="Ask a question or say hello..." required autocomplete="off">
                    <button type="submit" class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; flex-shrink:0; background: #2563EB; border:none;">
                        <i class="fas fa-paper-plane text-white"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.4; }
}
.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fetchUrl = "{{ route('student.class-chat.messages') }}";
        const sendUrl = "{{ route('student.class-chat.send') }}";
        
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
                        <i class="fas fa-comment-dots fa-2x mb-2 opacity-30 text-primary"></i>
                        <div>No messages yet. Start the classroom discussion!</div>
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

                const roleBadge = isMe ? '' : `<span class="badge ${msg.sender_role === 'Student' ? 'bg-secondary-subtle text-muted' : 'bg-danger-subtle text-danger'}" style="font-size: 0.6rem;">${msg.sender_role}</span>`;

                const msgHtml = `
                    <div class="d-flex ${flexLayout} ${alignmentClass} max-w-75">
                        <div class="flex-shrink-0 mt-1 ${avatarMargin}">
                            ${avatar}
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-1.5 mb-1 justify-content-start ${isMe ? 'flex-row-reverse' : 'flex-row'}">
                                <span class="fw-semibold text-dark" style="font-size: 0.75rem;">${msg.sender_name}</span>
                                ${roleBadge}
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
