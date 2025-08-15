@extends('index') {{-- or your layout file --}}
@push('style')
    <link rel="stylesheet" href="{{ asset('css/user_package.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush
@section('content')
    <h2>Tour Packages - Class: {{ ucfirst($class) }}</h2>
    <div class="Upper-package">
        <h1> Packages You Search For</h1>
    </div>


    <section class="tour-packages">
        @forelse($packages as $package)
            <div class="package">
                <img src="{{ asset('assets/images/' . $package->image) }}" alt="{{ $package->title }}" width="300">
                <h2>{{ $package->title }}</h2>
                <p class="features">Features: <span>{{ $package->features }}</span></p>
                <p class="description">{{ $package->description }}</p>
                <p class="price">Price Per Person: Starting Price <br><span>${{ number_format($package->price, 2) }}</span></p>
                <button onclick="openPopup(
                                                    '{{ addslashes($package->title) }}',
                                                    '{{ addslashes($package->description) }}',
                                                    '{{ number_format($package->price, 2) }}',
                                                    '{{ asset(str_replace('\\', '/', ('assets/images/' . $package->image))) }}',
                                                    '{{ $package->duration_day }}',
                                                    '{{ $package->duration_night }}',
                                                    '{{ $package->id }}'
                                                )">
                    Tour Details ➤
                </button>
            </div>
        @empty
            <p>No packages found in this class.</p>
        @endforelse
    </section>
    <div id="tourPopup" class="popup-overlay">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">×</span>
            <img id="popupImage" src="" alt="Tour Image"
                style="width:100%;max-width:400px;min-height:220px;max-height:260px;border-radius:12px;margin-bottom:18px;object-fit:cover;" />
            <h2 id="popupTitle">Tour Title</h2>
            <p id="popupDuration" style="font-weight:600;color:#0d6efd;margin-bottom:10px;"></p>
            <p id="popupDetails">Package details will appear here.</p>
            <a href="#" id="popupOrderBtn" class="btn btn-success">Order Now</a>
        </div>
    </div>
    <script>
        let packagePrice = 0;
        let packageId = 0;

        function openPopup(title, description, price, imageUrl, durationDay, durationNight, id) {
            document.getElementById('popupTitle').textContent = title;
            document.getElementById('popupDetails').textContent = description;
            document.getElementById('popupImage').src = imageUrl;
            document.getElementById('popupDuration').textContent = `${durationDay} Day(s), ${durationNight} Night(s)`;

            // Set price and ID
            packagePrice = parseFloat(price);
            packageId = id;

            // Insert quantity input and total price dynamically if not present
            if (!document.getElementById('travelerQuantity')) {
                const qtyInput = document.createElement('input');
                qtyInput.type = 'number';
                qtyInput.id = 'travelerQuantity';
                qtyInput.min = 1;
                qtyInput.value = 1;
                qtyInput.addEventListener('input', updateTotalPrice);
                document.getElementById('popupDetails').insertAdjacentHTML('afterend', '<div>Quantity: </div>');
                document.getElementById('popupDetails').insertAdjacentElement('afterend', qtyInput);

                const total = document.createElement('div');
                total.innerHTML = `Total Price: $<span id="totalPrice">${packagePrice.toFixed(2)}</span>`;
                document.getElementById('travelerQuantity').insertAdjacentElement('afterend', total);
            }

            updateTotalPrice();

            // Show popup
            document.getElementById('tourPopup').style.display = 'flex';
            document.getElementById('popupOrderBtn').href = `/order/${id}?quantity=1`;
        }

        function updateTotalPrice() {
            const qty = parseInt(document.getElementById('travelerQuantity').value) || 1;
            const total = (packagePrice * qty).toFixed(2);
            document.getElementById('totalPrice').textContent = total;

            document.getElementById('popupOrderBtn').href = `/order/${packageId}?quantity=${qty}`;
        }

        function closePopup() {
            document.getElementById('tourPopup').style.display = 'none';
        }
    </script>
@endsection
