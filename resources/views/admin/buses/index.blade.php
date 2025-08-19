@extends('admin.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">🚌 Manage Buses</h2>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Add Bus Form --}}
    <div class="card p-4 mb-4 shadow-sm">
        <h4 class="mb-3">➕ Add New Bus</h4>
        <form action="{{ route('admin.buses.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Bus Name</label>
                <input type="text" name="bus_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Start Location</label>
                <input type="text" name="start_location" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Destination</label>
                <input type="text" name="end_location" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Start Time</label>
                <input type="datetime-local" name="start_time" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Save Bus</button>
        </form>
    </div>

    {{-- Bus List --}}
    <div class="card p-4 shadow-sm">
        <h4 class="mb-3">📋 Bus List</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Bus Name</th>
                    <th>Start Location</th>
                    <th>Destination</th>
                    <th>Start Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($buses as $bus)
                    <tr>
                        <td>{{ $bus->bus_name }}</td>
                        <td>{{ $bus->start_location }}</td>
                        <td>{{ $bus->end_location }}</td>
                        <td>{{ \Carbon\Carbon::parse($bus->start_time)->format('d M Y, h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No buses added yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
