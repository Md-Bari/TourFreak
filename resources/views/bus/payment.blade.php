@extends('index')
@section('content')
<div class="container mt-5 text-center">
    <h2>💳 Bus Payment</h2>
    <p><b>Seats:</b> {{ implode(', ', $seats) }}</p>
    <p><b>Total Price:</b> ₹{{ $totalPrice }}</p>

    <button class="btn btn-success" onclick="showTicket()">Pay Now</button>

    <!-- Ticket Modal -->
    <div class="modal fade" id="ticketModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content p-4">
                <h4>🎟 Your Ticket</h4>
                <p><b>Seats:</b> {{ implode(', ', $seats) }}</p>
                <p><b>Amount Paid:</b> ₹{{ $totalPrice }}</p>
                <button class="btn btn-primary" onclick="downloadTicket()">Download Ticket</button>
            </div>
        </div>
    </div>
</div>

<script>
function showTicket() {
    var myModal = new bootstrap.Modal(document.getElementById('ticketModal'));
    myModal.show();
}

function downloadTicket() {
    let element = document.createElement('a');
    let ticketText = "Bus Ticket\nSeats: {{ implode(', ', $seats) }}\nAmount Paid: ₹{{ $totalPrice }}";
    let file = new Blob([ticketText], {type: 'text/plain'});
    element.href = URL.createObjectURL(file);
    element.download = "ticket.txt";
    element.click();
    window.location.href = "/";
}
</script>
@endsection
