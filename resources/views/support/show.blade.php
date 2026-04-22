@extends('index')

@section('title', 'Support Ticket')
@section('page_title', 'Ticket Details')

@section('content')
<div class="page-shell form-shell">
    <section class="hero-panel">
        <div>
            <span class="eyebrow">Ticket details</span>
            <h2>Support Ticket #{{ $ticket->ticket_id }}</h2>
            <p>Review your support request, current status, and the original message you sent.</p>
        </div>
    </section>

    <section class="content-card">
        <div class="section-heading">
            <div>
                <span class="eyebrow">Ticket overview</span>
                <h3>{{ $ticket->subject }}</h3>
            </div>
            <span class="status-pill {{ $ticket->status === 'open' ? 'success' : 'warning' }}">
                {{ ucfirst($ticket->status) }}
            </span>
        </div>

        <div class="info-list mb-4">
            <div class="info-row-card">
                <span class="meta-label">Created At</span>
                <span class="meta-value">{{ $ticket->created_at->format('M d, Y H:i') }}</span>
            </div>
        </div>

        <div class="info-row-card">
            <span class="meta-label">Message</span>
            <p class="mb-0">{{ $ticket->message }}</p>
        </div>

        <div class="action-row mt-4">
            <a href="{{ route('support.index') }}" class="btn btn-outline-dark">Back to Tickets</a>
        </div>
    </section>
</div>
@endsection
