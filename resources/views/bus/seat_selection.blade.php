@extends('index')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">🚌 Bus Seat Booking</h2>

    <div class="seat-layout mx-auto text-center">
        <p class="fw-bold text-secondary">← Driver Side</p>

        @php $rows = range('A', 'I'); @endphp

        @foreach($rows as $row)
            <div class="d-flex justify-content-center mb-2">
                {{-- Left side --}}
                @for($i = 1; $i <= 2; $i++)
                    @php $seatNumber = $row.$i; @endphp
                    <div class="seat {{ in_array($seatNumber, $bookedSeats) ? 'booked' : 'available' }}"
                         data-seat="{{ $seatNumber }}"
                         data-start="{{ $start }}"
                         data-end="{{ $end }}"
                         data-date="{{ $date }}">
                        {{ $seatNumber }}
                    </div>
                @endfor

                <div style="width: 40px;"></div>

                {{-- Right side --}}
                @for($i = 3; $i <= 4; $i++)
                    @php $seatNumber = $row.$i; @endphp
                    <div class="seat {{ in_array($seatNumber, $bookedSeats) ? 'booked' : 'available' }}"
                         data-seat="{{ $seatNumber }}"
                         data-start="{{ $start }}"
                         data-end="{{ $end }}"
                         data-date="{{ $date }}">
                        {{ $seatNumber }}
                    </div>
                @endfor
            </div>
        @endforeach
    </div>

    <!-- Proceed Button -->
    <div class="text-center mt-4">
        <form id="paymentForm" method="POST" action="{{ route('bus.payment') }}">
            @csrf
            <input type="hidden" name="seats" id="selectedSeats">
            <input type="hidden" name="start" value="{{ $start }}">
            <input type="hidden" name="end" value="{{ $end }}">
            <input type="hidden" name="date" value="{{ $date }}">
            <button type="submit" id="payNowBtn" class="btn btn-primary btn-lg d-none">
                Proceed to Payment
            </button>
        </form>
    </div>
</div>

<style>
.seat {
    display: inline-block;
    margin: 6px;
    width: 55px;
    height: 55px;
    line-height: 55px;
    text-align: center;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
    border: 2px solid #28a745;
    background: #eaffea;
    transition: all 0.3s ease;
}
.seat.available { background: #eaffea; border-color: #28a745; }
.seat.booked { background: #bbb !important; color: white; border-color: #888; cursor: not-allowed; }
.seat.mine { background: #28a745 !important; color: white; border-color: #1e7e34; }
</style>

<script>
let selected = [];

document.querySelectorAll('.seat.available, .seat.mine').forEach(seat => {
    seat.addEventListener('click', function () {
        const seatNumber = this.dataset.seat;
        const start = this.dataset.start;
        const end = this.dataset.end;
        const date = this.dataset.date;

        fetch("{{ route('bus.toggleSeat') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ seat: seatNumber, start_location: start, end_location: end, journey_date: date })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'booked') {
                this.classList.remove('available');
                this.classList.add('mine');
                selected.push(seatNumber);
            } else if (data.status === 'unbooked') {
                this.classList.remove('mine');
                this.classList.add('available');
                selected = selected.filter(s => s !== seatNumber);
            } else if (data.status === 'taken') {
                alert('Seat already taken!');
                this.classList.add('booked');
            }

            // Update hidden input + button visibility
            document.getElementById('selectedSeats').value = selected.join(',');
            document.getElementById('payNowBtn').classList.toggle('d-none', selected.length === 0);
        });
    });
});
</script>
@endsection
