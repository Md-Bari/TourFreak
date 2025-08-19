@extends('index')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">🚌 Available Buses</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($buses->isEmpty())
        <div class="alert alert-warning">❌ No buses available for this route.</div>
    @else
        <div class="row">
            @foreach($buses as $bus)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $bus->bus_name }}</h5>
                            <p class="card-text">
                                <strong>From:</strong> {{ $bus->start_location }} <br>
                                <strong>To:</strong> {{ $bus->end_location }} <br>
                                <strong>Departure:</strong> {{ $bus->start_time }} <br>
                            </p>
                            <form action="{{ route('bus.seatSelection') }}" method="GET">
                                <input type="hidden" name="start" value="{{ $bus->start_location }}">
                                <input type="hidden" name="end" value="{{ $bus->end_location }}">
                                <input type="hidden" name="date" value="{{ $date }}">
                                <button type="submit" class="btn btn-primary w-100">Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
