@extends('dashboard.dashboard') {{-- সঠিক Master Layout File --}}

@section('content')
<div class="main-content">
    <div class="card">
        <div class="card-header">
            <h5>Subject: {{ $ticket->subject }}</h5>
            <small>Ticket ID: {{ $ticket->ticket_id }} | Status: <span class="badge" style="background-color: #17a2b8; color: white;">{{ $ticket->status }}</span></small>
        </div>
        <div class="card-body">
            <!-- Original Message -->
            <div style="padding: 15px; border-radius: 10px; background-color: #e1f5fe; margin-bottom: 15px; text-align: left;">
                <p><strong>{{ $ticket->user->name }}</strong> <small class="text-muted">{{ $ticket->created_at->format('d M Y, h:i A') }}</small></p>
                <p style="margin: 0;">{{ $ticket->message }}</p>
            </div>
            
            {{-- ভবিষ্যতে এখানে রিপ্লাই দেখানো হবে --}}

        </div>
    </div>
</div>
@endsection