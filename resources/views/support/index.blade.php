@extends('index')

@section('title', 'Support')
@section('page_title', 'Support Tickets')

@section('content')
<div class="page-shell">
    <section class="hero-panel">
        <div>
            <span class="eyebrow">Help center</span>
            <h2>Support tickets</h2>
            <p>Track your questions, check ticket status, and keep support communication organized in one place.</p>
        </div>
        <div class="hero-actions">
            <a href="{{ route('support.create') }}" class="btn btn-dark">Create Ticket</a>
        </div>
    </section>

    <section class="content-card">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(count($tickets) > 0)
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Last Update</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td>#{{ $ticket->id }}</td>
                                <td>{{ $ticket->subject }}</td>
                                <td>
                                    <span class="status-pill {{ $ticket->status === 'open' ? 'success' : 'warning' }}">
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                </td>
                                <td>{{ $ticket->created_at->format('M d, Y') }}</td>
                                <td>{{ $ticket->updated_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('support.show', $ticket->id) }}" class="btn btn-sm btn-outline-dark">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $tickets->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-headset"></i>
                <h5>No support tickets found</h5>
                <p class="muted-text mb-0">Create a ticket whenever you need help.</p>
            </div>
        @endif
    </section>
</div>
@endsection
