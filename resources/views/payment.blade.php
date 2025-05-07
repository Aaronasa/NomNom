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

        <!-- QR Section -->
        <div class="flex items-center justify-between bg-white px-6 py-4 shadow rounded-xl mb-6">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('image/QRDANA.jpg') }}" alt="QRIS" class="w-16" />
                <p class="font-bold text-lg">Rp. {{ number_format($grandTotal, 0, ',', '.') }}</p>
            </div>
            <button class="bg-[#D7C5A9] text-white px-4 py-2 rounded-full" id="show-qr-btn">Show QR</button>
        </div>
        
        <!-- Payment Button -->
        {{-- <div class="cart-footer">
            <form action="{{ route('payment.process') }}" method="POST">
                @csrf
                <button type="submit" class="checkout-btn bg-[#D7C5A9] text-white px-4 py-3 rounded-xl w-full font-bold">
                    Complete Payment
                </button>
            </form>
        </div> --}}

    </div>

    <!-- QR Modal (Hidden by default) -->
    <div id="qr-modal" class="fixed mt-20 inset-0 flex items-center justify-center hidden" style="background-color: rgba(229, 231, 235, 0.5);">
        <div class="bg-white p-6 rounded-xl max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-lg">Scan QR Code to Pay</h3>
                <button id="close-qr-modal" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <div class="flex justify-center mb-4">
                <!-- Placeholder QR Code - in a real app, this would be generated -->
                <div class="flex justify-center my-4">
                    <img src="{{ asset('image/QRDANA.jpg') }}" alt="QR BCA" class="w-64 h-64 object-contain rounded-lg shadow" />
                </div>
            </div>
            <p class="text-center font-bold mb-2">Rp. {{ number_format($grandTotal, 0, ',', '.') }}</p>
            <p class="text-center text-sm text-gray-500 mb-4">Scan with your preferred payment app</p>
            <div class="cart-footer">
                <form action="{{ route('payment.process') }}" method="POST">
                    @csrf
                    <button type="submit" class="checkout-btn bg-[#D7C5A9] text-white px-4 py-3 rounded-xl w-full font-bold">
                        Complete Payment
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showQrBtn = document.getElementById('show-qr-btn');
            const qrModal = document.getElementById('qr-modal');
            const closeQrModal = document.getElementById('close-qr-modal');
            const paymentDone = document.getElementById('payment-done');
            
            showQrBtn.addEventListener('click', function() {
                qrModal.classList.remove('hidden');
            });
            
            closeQrModal.addEventListener('click', function() {
                qrModal.classList.add('hidden');
            });
            
            paymentDone.addEventListener('click', function() {
                // Submit the payment form
                document.querySelector('form[action="{{ route('payment.process') }}"]').submit();
            });
        });
    </script>

    <x-footer />
</x-layout>