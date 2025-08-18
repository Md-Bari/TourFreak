@extends('dashboard.dashboard') {{-- Ei line-ti khub'i guruttopurno --}}

@section('content')
{{-- Ei section-er bhetorer code-tuku main content hishebe dekhabe --}}
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center" style="padding: 1rem 1.5rem; background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
        <h4 style="margin-bottom: 0;">My Support Tickets</h4>
        <a href="{{ route('support.create') }}" class="btn btn-primary" style="background-color: #1ab394; border-color: #1ab394;">Create New Ticket</a>
    </div>
    <div class="card-body" style="padding: 1.5rem;">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Ticket ID</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Last Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->ticket_id }}</td>
                            <td>{{ $ticket->subject }}</td>
                            <td>
                                <span class="badge" style="background-color: #17a2b8; color: white;">{{ $ticket->status }}</span>
                            </td>
                            <td>{{ $ticket->updated_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('support.show', $ticket->ticket_id) }}" class="btn btn-sm btn-outline-info">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center" style="padding: 2rem;">You have not created any support tickets yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
