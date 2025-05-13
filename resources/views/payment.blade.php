```blade
<x-layout>
    <x-navigation />

    <div class="bg-[#FFF9EC] min-h-screen p-6 text-[#3B2F22]">

        <!-- Header -->
        <div class="flex items-center space-x-3 mb-6">
            <a href="{{ route('cart.show') }}" class="text-3xl">&larr;</a>
            <h1 class="text-xl font-bold">Checkout & Payment</h1>
        </div>
        
        <!-- Delivery Section -->
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <div class="flex items-center mb-4">
                <span class="mr-2">🚚</span>
                <p class="font-medium">Delivery <span class="text-sm text-gray-500">in 60 mins</span></p>
            </div>
            <input type="text" placeholder="📍 Enter Your Location"
                class="border px-4 py-2 rounded-full w-full mb-3" />
            <button class="bg-[#D7C5A9] text-white px-4 py-2 rounded-full mb-4">Edit Map</button>

            <div class="mb-4">
                <img src="{{ asset('image/Map.png') }}" alt="Map" class="rounded-xl w-full h-64 object-cover" />
            </div>

            <div class="mb-2">
                <label class="block text-sm font-medium">Address Detail</label>
                <p class="text-sm text-gray-600">Universitas Ciputra Surabaya, Made, Surabaya, East Java, Indonesia</p>
            </div>

            <div class="mb-2">
                <label class="block text-sm font-medium">Location Detail (optional)</label>
                <input type="text" class="border px-3 py-2 rounded w-full"
                    placeholder="Flat/Unit number, Floor number" />
            </div>

            <div>
                <label class="block text-sm font-medium">Delivery Notes</label>
                <input type="text" placeholder="e.g. Please leave food at the door/gate"
                    class="border px-3 py-2 rounded w-full" />
            </div>
        </div>

        <!-- Selected Items -->
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h2 class="font-bold mb-4">Your Selected Items</h2>
            
            @if (!empty($cart))
                @foreach ($cart as $item)
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <p class="font-semibold">{{ $item['foodName'] }}</p>
                        <p class="text-sm font-bold mt-1">Rp. {{ number_format($item['foodPrice'], 0, ',', '.') }}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span>{{ $item['quantity'] }}x</span>
                    </div>
                    <img src="{{ asset($item['foodImage']) }}" alt="{{ $item['foodName'] }}" class="w-16 h-16 rounded-xl object-cover" />
                </div>
                @endforeach
            @else
                <p>No items in cart</p>
            @endif
            
            <a href="{{ route('cart.show') }}" class="mt-4 text-sm text-blue-600 underline">Edit Cart</a>
        </div>

        <!-- Payment Summary -->
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h2 class="font-bold mb-4">Payment Summary</h2>
            <div class="flex justify-between text-sm mb-1">
                <span>Price</span>
                <span>Rp. {{ number_format($totalPrice, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm mb-1">
                <span>Delivery Fee</span>
                <span>Rp. {{ number_format($deliveryFee, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm mb-3">
                <span>Admin</span>
                <span>Rp. {{ number_format($adminFee, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between font-bold text-lg border-t pt-3">
                <span>Total Payment</span>
                <span>Rp. {{ number_format($grandTotal, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Midtrans Payment Button -->
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h2 class="font-bold mb-4">Payment Method</h2>
            <button id="pay-button" class="checkout-btn bg-[#D7C5A9] text-white px-4 py-3 rounded-xl w-full font-bold">
                Complete Payment
            </button>
            <div id="snap-container" class="mt-4"></div>
        </div>

    <!-- Midtrans Script -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Original QR Modal code
            const showQrBtn = document.getElementById('show-qr-btn');
            const qrModal = document.getElementById('qr-modal');
            const closeQrModal = document.getElementById('close-qr-modal');
            
            if (showQrBtn) {
                showQrBtn.addEventListener('click', function() {
                    qrModal.classList.remove('hidden');
                });
            }
            
            if (closeQrModal) {
                closeQrModal.addEventListener('click', function() {
                    qrModal.classList.add('hidden');
                });
            }
            
            // Midtrans integration
            const payButton = document.getElementById('pay-button');
            payButton.addEventListener('click', function () {
                // Trigger snap popup
                window.snap.embed('{{ $snapToken }}', {
                    embedId: 'snap-container',
                    onSuccess: function (result) {
                        /* You may add your own implementation here */
                        alert("Payment successful!");
                        console.log(result);
                        window.location.href = "{{ route('payment.finish') }}";
                    },
                    onPending: function (result) {
                        /* You may add your own implementation here */
                        alert("Waiting for your payment!");
                        console.log(result);
                    },
                    onError: function (result) {
                        /* You may add your own implementation here */
                        alert("Payment failed!");
                        console.log(result);
                    },
                    onClose: function () {
                        /* You may add your own implementation here */
                        alert('You closed the popup without finishing the payment');
                    }
                });
            });
        });
    </script>

    <x-footer />
</x-layout>
```