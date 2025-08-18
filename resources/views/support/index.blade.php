@extends('index')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="main-content" style="margin-left:220px; margin-top:70px; padding:20px;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Support Tickets</h4>
                        <a href="{{ route('support.create') }}" class="btn btn-primary">Create New Ticket</a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(count($tickets) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
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
                                                    <span class="badge bg-{{ $ticket->status === 'open' ? 'success' : 'secondary' }}">
                                                        {{ ucfirst($ticket->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $ticket->created_at->format('M d, Y') }}</td>
                                                <td>{{ $ticket->updated_at->format('M d, Y') }}</td>
                                                <td>
                                                    <a href="{{ route('support.show', $ticket->id) }}" class="btn btn-sm btn-info">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $tickets->links() }}
                        @else
                            <p class="text-center">No support tickets found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
