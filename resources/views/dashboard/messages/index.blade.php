@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Messages</h4>
                </div>
                <div class="card-body p-0">
                    <div class="row g-0">
                        <!-- Left panel - Message list -->
                        <div class="col-md-4 border-end">
                            <div class="messages-search p-3 border-bottom">
                                <input type="text" class="form-control" placeholder="Search messages..." id="messageSearch">
                            </div>
                            <div class="messages-list" style="height: calc(100vh - 250px); overflow-y: auto;">
                                @foreach($messages->unique('sender_id') as $message)
                                    <div class="message-item p-3 border-bottom user-select-none @if(!$message->read_at) bg-light @endif"
                                         data-user-id="{{ $message->sender_id }}"
                                         role="button">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="{{ $message->sender->avatar ?? asset('images/default-avatar.png') }}"
                                                     class="rounded-circle"
                                                     width="45"
                                                     height="45"
                                                     alt="{{ $message->sender->name }}">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">{{ $message->sender->name }}</h6>
                                                <p class="mb-1 text-truncate" style="max-width: 200px;">
                                                    {{ $message->message }}
                                                </p>
                                                <small class="text-muted">
                                                    {{ $message->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Right panel - Chat conversation -->
                        <div class="col-md-8">
                            <div id="conversationContainer" class="d-flex flex-column" style="height: calc(100vh - 250px);">
                                <!-- Initial state -->
                                <div class="h-100 d-flex align-items-center justify-content-center" id="initialState">
                                    <p class="text-muted">Select a conversation to start messaging</p>
                                </div>

                                <!-- Chat interface (hidden initially) -->
                                <div class="d-none h-100 d-flex flex-column" id="chatInterface">
                                    <!-- Chat header -->
                                    <div class="p-3 border-bottom">
                                        <h6 class="mb-0" id="chatUserName"></h6>
                                    </div>

                                    <!-- Messages container -->
                                    <div class="flex-grow-1 p-3" id="messagesContainer" style="overflow-y: auto;">
                                        <!-- Messages will be loaded here -->
                                    </div>

                                    <!-- Message input -->
                                    <div class="p-3 border-top">
                                        <form id="messageForm" class="d-flex">
                                            <input type="hidden" id="receiverId" name="receiver_id" value="">
                                            <input type="text" 
                                                   class="form-control me-2" 
                                                   id="messageInput" 
                                                   name="message" 
                                                   placeholder="Type your message...">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const messageItems = document.querySelectorAll('.message-item');
    const chatInterface = document.getElementById('chatInterface');
    const initialState = document.getElementById('initialState');
    const messagesContainer = document.getElementById('messagesContainer');
    const chatUserName = document.getElementById('chatUserName');
    const messageForm = document.getElementById('messageForm');
    const messageInput = document.getElementById('messageInput');
    const receiverIdInput = document.getElementById('receiverId');
    const messageSearch = document.getElementById('messageSearch');

    // Search functionality
    messageSearch.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        messageItems.forEach(item => {
            const userName = item.querySelector('h6').textContent.toLowerCase();
            const messageText = item.querySelector('p').textContent.toLowerCase();
            const isVisible = userName.includes(searchTerm) || messageText.includes(searchTerm);
            item.style.display = isVisible ? 'block' : 'none';
        });
    });

    // Click handler for message items
    messageItems.forEach(item => {
        item.addEventListener('click', function() {
            const userId = this.dataset.userId;
            const userName = this.querySelector('h6').textContent;
            
            // Update UI
            messageItems.forEach(i => i.classList.remove('active', 'bg-primary', 'text-white'));
            this.classList.add('active', 'bg-primary', 'text-white');
            chatInterface.classList.remove('d-none');
            initialState.classList.add('d-none');
            chatUserName.textContent = userName;
            receiverIdInput.value = userId;

            // Load conversation
            loadConversation(userId);
        });
    });

    // Load conversation
    function loadConversation(userId) {
        fetch(`/messages/${userId}`)
            .then(response => response.json())
            .then(messages => {
                messagesContainer.innerHTML = '';
                messages.forEach(message => {
                    const isCurrentUser = message.sender_id == {{ auth()->id() }};
                    const messageHtml = `
                        <div class="message ${isCurrentUser ? 'text-end' : ''}">
                            <div class="message-content d-inline-block p-2 mb-2 rounded ${isCurrentUser ? 'bg-primary text-white' : 'bg-light'}">
                                ${message.message}
                            </div>
                        </div>
                    `;
                    messagesContainer.insertAdjacentHTML('beforeend', messageHtml);
                });
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            });
    }

    // Send message
    messageForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        fetch('/messages', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(Object.fromEntries(formData))
        })
        .then(response => response.json())
        .then(message => {
            // Add message to conversation
            const messageHtml = `
                <div class="message text-end">
                    <div class="message-content d-inline-block p-2 mb-2 rounded bg-primary text-white">
                        ${message.message}
                    </div>
                </div>
            `;
            messagesContainer.insertAdjacentHTML('beforeend', messageHtml);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
            
            // Clear input
            messageInput.value = '';
        });
    });
});
</script>
@endpush

@push('styles')
<style>
.message-item {
    transition: all 0.3s ease;
}

.message-item:hover {
    background-color: rgba(0, 0, 0, 0.05);
    cursor: pointer;
}

.message-item.active {
    background-color: var(--bs-primary) !important;
    color: white;
}

.message-content {
    max-width: 75%;
}

.messages-list::-webkit-scrollbar,
#messagesContainer::-webkit-scrollbar {
    width: 6px;
}

.messages-list::-webkit-scrollbar-thumb,
#messagesContainer::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.2);
    border-radius: 3px;
}

.messages-list::-webkit-scrollbar-track,
#messagesContainer::-webkit-scrollbar-track {
    background-color: rgba(0, 0, 0, 0.05);
}
</style>
@endpush
