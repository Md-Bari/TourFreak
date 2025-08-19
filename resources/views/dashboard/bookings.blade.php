@extends('index')

@section('content')
<div class="main-content" style="margin-left:200px; margin-top:60px; padding:20px; max-width:1000px;">

    {{-- Page Title --}}
    <h2 class="mb-4" style="font-size:28px; font-weight:700; color:#222; text-align:center;">
        📑 My Bookings
    </h2>

    {{-- ✅ Tour Bookings --}}
    <h3 style="margin-bottom:20px; font-size:22px; font-weight:700; color:#007bff;">🌍 Tour Packages</h3>

    @forelse($orders as $order)
        <div style="background:#fff; padding:25px; border-radius:16px; box-shadow:0 6px 16px rgba(0,0,0,0.08); margin-bottom:30px;">

            {{-- Title + Status --}}
            <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap;">
                <h3 style="color:#007bff; font-size:20px; font-weight:700;">
                    {{ $order->package->title ?? 'Unknown Package' }}
                </h3>
                <span style="padding:8px 16px; border-radius:20px; font-weight:600;
                    background: {{ $order->status == 'Paid' ? '#d4edda' : '#f8d7da' }};
                    color: {{ $order->status == 'Paid' ? '#155724' : '#721c24' }};">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            {{-- Info --}}
            <p style="margin:8px 0;"><strong>💰 Amount:</strong> {{ number_format($order->amount, 2) }} {{ $order->currency }}</p>
            <p style="margin:8px 0;"><strong>📅 Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>

            {{-- Cancel Button --}}
            @if($order->status != 'Paid')
                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="cancel-form">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                            class="cancel-btn"
                            data-type="order"
                            style="background:#dc3545; color:#fff; font-weight:600; border:none; padding:10px 18px; border-radius:8px; cursor:pointer;">
                        ❌ Cancel Booking
                    </button>
                </form>
            @endif
        </div>
    @empty
        <div style="padding:20px; background:#f8d7da; color:#721c24; border-radius:10px; text-align:center; font-size:16px;">
            No tour bookings found.
        </div>
    @endforelse


    {{-- ✅ Bus Ticket Bookings --}}
    <h3 style="margin:40px 0 20px; font-size:22px; font-weight:700; color:#007bff;">🚌 Bus Tickets</h3>

    @forelse($busBookings as $bus)
        <div style="background:#fff; padding:25px; border-radius:16px; box-shadow:0 6px 16px rgba(0,0,0,0.08); margin-bottom:30px;">

            {{-- Title --}}
            <h3 style="color:#28a745; font-size:20px; font-weight:700; margin-bottom:10px;">
                {{ $bus->start_location }} → {{ $bus->end_location }}
            </h3>

            {{-- Info --}}
            <p><strong>📅 Journey Date:</strong> {{ $bus->journey_date }}</p>
            <p><strong>⏰ Time:</strong> {{ $bus->journey_time }}</p>
            <p><strong>💺 Seat:</strong> {{ $bus->seat_number }}</p>
            <p><strong>Status:</strong>
                <span style="padding:4px 10px; border-radius:10px; font-weight:600;
                    background: {{ $bus->status == 'booked' ? '#d4edda' : '#f8d7da' }};
                    color: {{ $bus->status == 'booked' ? '#155724' : '#721c24' }};">
                    {{ ucfirst($bus->status) }}
                </span>
            </p>

            {{-- Cancel Button (only if not paid) --}}
            @if($bus->status != 'paid')
                <form action="{{ route('bus.cancel', $bus->id) }}" method="POST" class="cancel-form">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                            class="cancel-btn"
                            data-type="bus"
                            style="background:#dc3545; color:#fff; font-weight:600; border:none; padding:10px 18px; border-radius:8px; cursor:pointer;">
                        ❌ Cancel Ticket
                    </button>
                </form>
            @endif
        </div>
    @empty
        <div style="padding:20px; background:#f8d7da; color:#721c24; border-radius:10px; text-align:center; font-size:16px;">
            No bus tickets found.
        </div>
    @endforelse

</div>

{{-- ================= SweetAlert2 ================= --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Confirmation before cancellation
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

    // Show success or error messages (from session)
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
