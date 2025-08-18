@extends('index')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="main-content" style="margin-left:220px; margin-top:70px; padding:20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Support Ticket #{{ $ticket->ticket_id }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="ticket-info mb-4">
                            <h5 class="ticket-subject">{{ $ticket->subject }}</h5>
                            <span class="badge bg-{{ $ticket->status === 'open' ? 'success' : 'secondary' }}">
                                {{ ucfirst($ticket->status) }}
                            </span>
                            <p class="text-muted mt-2">
                                Created: {{ $ticket->created_at->format('M d, Y H:i') }}
                            </p>
                        </div>

                        <div class="ticket-message">
                            <h6>Message:</h6>
                            <p>{{ $ticket->message }}</p>
                        </div>

                        <hr>

                        <div class="text-end">
                            <a href="{{ route('support.index') }}" class="btn btn-secondary">Back to Tickets</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
