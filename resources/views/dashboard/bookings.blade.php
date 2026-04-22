@extends('index')

@section('title', 'My Bookings')
@section('page_title', 'My Bookings')

@section('content')
<div class="page-shell">
    <section class="hero-panel">
        <div>
            <span class="eyebrow">Travel history</span>
            <h2>Manage your bookings</h2>
            <p>Review tour and transport reservations, check statuses, and cancel pending items when needed.</p>
        </div>
    </section>

    <section class="content-card">
        <div class="section-heading">
            <div>
                <span class="eyebrow">Tour packages</span>
                <h3>Booked Tours</h3>
            </div>
        </div>

        @forelse($orders as $order)
            <article class="booking-card">
                <div class="booking-card-header">
                    <div>
                        <h5 class="mb-1">{{ $order->package->title ?? 'Unknown Package' }}</h5>
                        <p class="muted-text mb-0">Booked on {{ $order->created_at->format('d M, Y') }}</p>
                    </div>
                    <span class="status-pill {{ strtolower($order->status) === 'paid' ? 'success' : 'warning' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="booking-meta">
                    <span>Amount: {{ number_format($order->amount, 2) }} {{ $order->currency }}</span>
                    <span>{{ $order->transaction_id }}</span>
                </div>

                @if($order->status != 'Paid')
                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="cancel-form mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-outline-danger cancel-btn" data-type="order">
                            Cancel Booking
                        </button>
                    </form>
                @endif
            </article>
        @empty
            <div class="empty-state">
                <i class="fas fa-suitcase"></i>
                <h5>No tour bookings found</h5>
                <p class="muted-text mb-0">Your booked packages will appear here.</p>
            </div>
        @endforelse
    </section>

    <section class="content-card">
        <div class="section-heading">
            <div>
                <span class="eyebrow">Bus trips</span>
                <h3>Booked Tickets</h3>
            </div>
        </div>

        @forelse($busBookings as $bus)
            <article class="booking-card">
                <div class="booking-card-header">
                    <div>
                        <h5 class="mb-1">{{ $bus->start_location }} to {{ $bus->end_location }}</h5>
                        <p class="muted-text mb-0">{{ $bus->journey_date }} at {{ $bus->journey_time }}</p>
                    </div>
                    <span class="status-pill {{ strtolower($bus->status) === 'booked' || strtolower($bus->status) === 'paid' ? 'success' : 'warning' }}">
                        {{ ucfirst($bus->status) }}
                    </span>
                </div>

                <div class="booking-meta">
                    <span>Seat: {{ $bus->seat_number }}</span>
                    <span>User ID: {{ $bus->user_id }}</span>
                </div>

                @if($bus->status != 'paid')
                    <form action="{{ route('bus.cancel', $bus->id) }}" method="POST" class="cancel-form mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-outline-danger cancel-btn" data-type="bus">
                            Cancel Ticket
                        </button>
                    </form>
                @endif
            </article>
        @empty
            <div class="empty-state">
                <i class="fas fa-bus"></i>
                <h5>No bus tickets found</h5>
                <p class="muted-text mb-0">Your bus reservations will appear here.</p>
            </div>
        @endforelse
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".cancel-btn").forEach(button => {
        button.addEventListener("click", function () {
            let form = this.closest("form");
            let type = this.dataset.type === "order" ? "booking" : "bus ticket";

            Swal.fire({
                title: "Are you sure?",
                text: `This will cancel your ${type}.`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Yes, cancel it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    @if(session('success'))
        Swal.fire({
            icon: "success",
            title: "Success!",
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: "error",
            title: "Oops!",
            text: "{{ session('error') }}",
            timer: 2000,
            showConfirmButton: false
        });
    @endif
});
</script>
@endsection
