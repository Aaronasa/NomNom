<x-layout>
    <x-navigation />

    {{-- Add Leaflet CSS in the head section --}}
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <style>
            /* Improved map styling */
            #map-container {
                margin-bottom: 1.5rem;
                border-radius: 0.75rem;
                overflow: hidden;
                /* Ensures the map respects the border radius */
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            #map {
                height: 40vh;
                /* Reduced height for better aesthetics */
                width: 100%;
                border-radius: 0.75rem;
                margin-bottom: 1rem;
            }

            /* Make map responsive */
            @media(max-width:768px) {
                #map {
                    height: 35vh;
                    /* Even smaller for mobile */
                }
            }

            /* Add a subtle border to the map */
            .leaflet-container {
                border: 2px solid #D7C5A9;
                border-radius: 0.75rem;
            }

            /* Customize map controls */
            .leaflet-control-zoom {
                border-radius: 0.5rem !important;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
            }

            /* Style popup content */
            .leaflet-popup-content {
                padding: 0.5rem;
            }

            .map-popup-title {
                font-weight: bold;
                font-size: 0.9rem;
                text-align: center;
                margin-bottom: 8px;
                color: #3B2F22;
            }

            .map-popup-image {
                width: 150px;
                height: 100px;
                object-fit: cover;
                border-radius: 5px;
                margin-bottom: 5px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .map-popup-description {
                font-size: 0.75rem;
                color: #555;
            }
        </style>
    @endpush


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
                <p class="font-medium">Delivery <span class="text-sm text-gray-500"></span></p>
            </div>

            {{-- MAP INTEGRATION STARTS HERE --}}
            <!-- Map Section -->
            <div id="map-container" class="mb-4">
                <div id="map"></div>
                <p class="text-xs text-gray-500 text-center mt-1">Click on the map to select your location</p>
            </div>

            <!-- Location Inputs -->
            <input type="text" id="location-input" placeholder="📍 Enter Your Location"
                class="border px-4 py-2 rounded-full w-full mb-3" />

            <!-- Hidden fields for coordinates -->
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">
            {{-- MAP INTEGRATION ENDS HERE --}}

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
                            <p class="text-sm font-bold mt-1">Rp. {{ number_format($item['foodPrice'], 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span>{{ $item['quantity'] }}x</span>
                        </div>
                        <img src="{{ asset($item['foodImage']) }}" alt="{{ $item['foodName'] }}"
                            class="w-16 h-16 rounded-xl object-cover" />
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
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.clientKey') }}"></script>
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
                payButton.addEventListener('click', function() {
                    // Trigger snap popup
                    window.snap.embed('{{ $snapToken }}', {
                        embedId: 'snap-container',
                        onSuccess: function(result) {
                            /* You may add your own implementation here */
                            alert("Payment successful!");
                            console.log(result);
                            window.location.href = "{{ route('payment.finish') }}";
                        },
                        onPending: function(result) {
                            /* You may add your own implementation here */
                            alert("Waiting for your payment!");
                            console.log(result);
                        },
                        onError: function(result) {
                            /* You may add your own implementation here */
                            alert("Payment failed!");
                            console.log(result);
                        },
                        onClose: function() {
                            /* You may add your own implementation here */
                            alert('You closed the popup without finishing the payment');
                        }
                    });
                });
            });
        </script>

        <x-footer />
        @push('scripts')
            <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Initialize map with UC coordinates
                    const ucCoords = [-7.285892717077447, 112.63140678405763];
                    const map = L.map('map').setView(ucCoords, 17);
                    let marker = null;
                    let initialMarker = null;

                    // DOM elements
                    const locationInput = document.getElementById('location-input');
                    const latInput = document.getElementById('latitude');
                    const lngInput = document.getElementById('longitude');

                    // Add tile layer
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);

                    // Add initial UC marker with formatted address
                    initialMarker = L.marker(ucCoords)
                        .addTo(map)
                        .bindPopup(`
                <div class="map-popup-container">
                    <h3 class="map-popup-title">Universitas Ciputra Surabaya</h3>
                    <p class="map-popup-description popup-address">Jalan Citra Raya Niaga, RW 06, Made, Sambikerep, Surabaya, East Java, Java, 60219, Indonesia</p>
                </div>
            `)
                        .openPopup();

                    // Handle popup clicks globally
                    document.addEventListener('click', function(e) {
                        const popupAddress = e.target.closest('.popup-address');
                        if (popupAddress) {
                            locationInput.value = popupAddress.textContent;
                        }
                    });

                    // Search address functionality
                    const searchAddress = debounce(function(address) {
                        if (!address) return;

                        fetch(
                                `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}&limit=1&countrycodes=id`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.length > 0) {
                                    const result = data[0];
                                    const coords = [parseFloat(result.lat), parseFloat(result.lon)];

                                    updateMarker(coords, result.display_name);
                                    map.setView(coords, 17);
                                }
                            });
                    }, 500);

                    // Map click handler
                    map.on('click', function(e) {
                        updateMarker(e.latlng);
                        reverseGeocode(e.latlng);
                    });

                    // Input handlers
                    locationInput.addEventListener('input', function(e) {
                        searchAddress(this.value);
                    });

                    locationInput.addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') searchAddress(this.value);
                    });

                    // Helper functions
                    function updateMarker(coords, address = null) {
                        if (initialMarker) {
                            map.removeLayer(initialMarker);
                            initialMarker = null;
                        }
                        if (marker) map.removeLayer(marker);

                        marker = L.marker(coords).addTo(map);

                        if (address) {
                            marker.bindPopup(`
                    <div class="map-popup-container">
                        <div class="popup-address">${address}</div>
                    </div>
                `).openPopup();
                        }

                        latInput.value = coords.lat ?? coords[0];
                        lngInput.value = coords.lng ?? coords[1];
                    }

                    function reverseGeocode(coords) {
                        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${coords.lat}&lon=${coords.lng}`)
                            .then(response => response.json())
                            .then(data => {
                                locationInput.value = data.display_name;
                            });
                    }

                    function debounce(func, timeout = 500) {
                        let timer;
                        return (...args) => {
                            clearTimeout(timer);
                            timer = setTimeout(() => {
                                func.apply(this, args);
                            }, timeout);
                        };
                    }
                });
            </script>
        @endpush
</x-layout>
