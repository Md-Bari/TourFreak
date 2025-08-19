@extends('index')
@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">🚌 Search Bus</h2>

    <form method="POST" action="{{ route('bus.searchResults') }}">
        @csrf
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" name="start_location" class="form-control" placeholder="Start Location" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="end_location" class="form-control" placeholder="Destination" required>
            </div>
            <div class="col-md-4">
                <input type="date" name="journey_date" class="form-control" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Search Bus</button>
    </form>
</div>
@endsection
