@extends('index')

@section('content')
<section class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset($room->image) }}" class="img-fluid mb-3" alt="{{ $room->title }}">
            <h3>{{ $room->title }}</h3>
            <p><strong>Price:</strong> ${{ $room->price }}</p>
            <p>{{ $room->description }}</p>
            <p><strong>Amenities:</strong></p>
            <ul>
                <li>✔ Non Smoking Room</li>
                <li>✔ Electric Kettle</li>
                <li>✔ Hot Water</li>
                <li>✔ Toiletries</li>
            </ul>
        </div>
        <div class="col-md-6">
            <h4>Booking Summary</h4>
            <p><strong>For 2 Adults, 1 Night</strong></p>
            <p><del>BDT 11,463</del></p>
            <h2 class="text-success">BDT 6,309</h2>
            <p>* Extra 5% discount for bKash payment</p>
            <p>Free cancellation before midnight the day before</p>
            <a href="#" class="btn btn-success">Book Now</a>
        </div>
    </div>
</section>
@endsection
