@extends('index')
@push('style')
<link rel="stylesheet" href="css/style.css">
@endpush
@section('content')
<section class="hero">
      <div>
        <img src="" alt="Hero image">
      </div>
    </section>


    <div class="booking-box">
      <h2>Tour Plan</h2>
      <form class="booking-form" action="{{ route('booking.store') }}" method="POST">
        @csrf
        <input type="date" name="check_in" required />
        <input type="date" name="check_out" required />

        <select name="adults" required>
          <option value="1">One Adult</option>
          <option value="2">Two Adults</option>
          <option value="3">Three Adults</option>
        </select>

        <select name="children" required>
          <option value="1">One Child</option>
          <option value="2">Two Children</option>
          <option value="3">Three Children</option>
        </select>

        <button type="submit">Submit</button>
      </form>

    </div>
  </div>
@endsection