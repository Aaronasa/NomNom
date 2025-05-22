<x-layout>
    <x-navigation />

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <style>
            /* Enhanced map styling */
            #map-container {
                margin-bottom: 1.5rem;
                border-radius: 1rem;
                overflow: hidden;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }

            #map {
                height: 45vh;
                width: 100%;
                border-radius: 1rem;
            }

            @media(max-width:768px) {
                #map {
                    height: 35vh;
                }
            }

            .leaflet-container {
                border: 2px solid #D7C5A9;
                border-radius: 1rem;
            }

            .leaflet-control-zoom {
                border-radius: 0.5rem !important;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
            }

            .leaflet-popup-content {
                padding: 0.75rem;
            }

            .map-popup-title {
                font-weight: 700;
                font-size: 1rem;
                text-align: center;
                margin-bottom: 0.5rem;
                color: #3B2F22;
            }

            .map-popup-image {
                width: 180px;
                height: 120px;
                object-fit: cover;
                border-radius: 0.5rem;
                margin-bottom: 0.5rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .map-popup-description {
                font-size: 0.875rem;
                color: #555;
                line-height: 1.4;
            }
            
            /* Consistent animation transitions */
            .transition-all {
                transition-property: all;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 300ms;
            }
        </style>
    @endpush

    <div class="bg-gradient-to-b from-[#FFF9EC] to-[#F7F0E2] min-h-screen py-6 px-4 md:px-8 text-[#3B2F22]">
        <!-- Header with improved back button -->
        <div class="max-w-3xl mx-auto mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('cart.show') }}" class="flex items-center justify-center h-10 w-10 rounded-full bg-white shadow-md hover:bg-[#F7F0E2] transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <h1 class="text-2xl font-bold">Checkout & Payment</h1>
                </div>
                <!-- Progress indicator -->
                <div class="hidden md:flex items-center space-x-1">
                    <span class="h-2.5 w-2.5 rounded-full bg-[#D7C5A9]"></span>
                    <span class="h-2.5 w-2.5 rounded-full bg-[#D7C5A9]"></span>
                    <span class="h-2.5 w-2.5 rounded-full bg-[#D7C5A9] opacity-40"></span>
                </div>
            </div>
        </div>

        <div class="max-w-3xl mx-auto">
            <!-- Delivery Section -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 transform transition-all hover:shadow-xl">
                <div class="flex items-center mb-5">
                    <span class="flex items-center justify-center h-10 w-10 rounded-full bg-[#F7F0E2] mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B3A082]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </span>
                    <div>
                        <h2 class="font-bold text-lg">Delivery Details</h2>
                        <p class="text-sm text-gray-500">Tell us where to deliver your order</p>
                    </div>
                </div>

                <!-- Map Section -->
                <div id="map-container" class="mb-5">
                    <div id="map"></div>
                    <div class="flex items-center justify-center mt-2.5 text-xs text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p>Click on the map to select your exact location</p>
                    </div>
                </div>

                <!-- Location Inputs with improved styling -->
                <div class="space-y-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <input type="text" id="location-input" placeholder="Enter Your Location" 
                            class="bg-gray-50 border border-gray-300 focus:ring-2 focus:ring-[#D7C5A9] focus:border-[#D7C5A9] block w-full pl-10 pr-4 py-3 rounded-xl text-sm outline-none transition-all" />
                    </div>

                    <!-- Hidden fields for coordinates -->
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">

                    <div>
                        <label class="block text-sm font-medium mb-1.5">Location Detail</label>
                        <input type="text" class="bg-gray-50 border border-gray-300 focus:ring-2 focus:ring-[#D7C5A9] focus:border-[#D7C5A9] block w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                            placeholder="Flat/Unit number, Floor, Building name" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1.5">Delivery Notes</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <input type="text" placeholder="e.g. Please leave food at the door/gate"
                                class="bg-gray-50 border border-gray-300 focus:ring-2 focus:ring-[#D7C5A9] focus:border-[#D7C5A9] block w-full pl-10 pr-4 py-3 rounded-xl text-sm outline-none transition-all" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Selected Items with enhanced styling -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 transform transition-all hover:shadow-xl">
                <div class="flex items-center mb-5">
                    <span class="flex items-center justify-center h-10 w-10 rounded-full bg-[#F7F0E2] mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B3A082]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </span>
                    <div>
                        <h2 class="font-bold text-lg">Your Order</h2>
                        <p class="text-sm text-gray-500">Review your selected items</p>
                    </div>
                </div>

                <div class="divide-y divide-gray-100">
                    @if (!empty($cart))
                        @foreach ($cart as $item)
                            <div class="flex justify-between items-center py-4 first:pt-0 last:pb-0">
                                <div class="flex items-center space-x-4">
                                    <div class="relative">
                                        <img src="{{ asset($item['foodImage']) }}" alt="{{ $item['foodName'] }}"
                                            class="w-20 h-20 rounded-xl object-cover shadow-md" />
                                        <span class="absolute -top-2 -right-2 bg-[#D7C5A9] text-white text-xs font-bold px-2 py-1 rounded-full">
                                            {{ $item['quantity'] }}x
                                        </span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-base">{{ $item['foodName'] }}</p>
                                        <p class="text-sm font-bold text-[#B3A082] mt-1">Rp. {{ number_format($item['foodPrice'], 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">Rp. {{ number_format($item['foodPrice'] * $item['quantity'], 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="flex flex-col items-center justify-center py-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <p class="text-gray-500">Your cart is empty</p>
                        </div>
                    @endif
                </div>

                <div class="mt-5 pt-4 border-t border-gray-100">
                    <a href="{{ route('cart.show') }}" class="flex items-center justify-center text-sm text-[#B3A082] hover:text-[#8F7E61] transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Edit Cart
                    </a>
                </div>
            </div>

            <!-- Payment Summary with enhanced styling -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 transform transition-all hover:shadow-xl">
                <div class="flex items-center mb-5">
                    <span class="flex items-center justify-center h-10 w-10 rounded-full bg-[#F7F0E2] mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B3A082]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <div>
                        <h2 class="font-bold text-lg">Payment Summary</h2>
                        <p class="text-sm text-gray-500">Review all charges</p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-xl p-4 mb-4">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-medium">Rp. {{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">Delivery Fee</span>
                        <span class="font-medium">Rp. {{ number_format($deliveryFee, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm mb-3">
                        <span class="text-gray-600">Service Fee</span>
                        <span class="font-medium">Rp. {{ number_format($adminFee, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between font-bold text-lg pt-3 border-t border-gray-200">
                        <span>Total</span>
                        <span class="text-[#8F7E61]">Rp. {{ number_format($grandTotal, 0, ',', '.') }}</span>
                    </div>
                </div>

               
            </div>

            <!-- Payment Method Section with enhanced styling -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 transform transition-all hover:shadow-xl">
                <div class="flex items-center mb-5">
                    <span class="flex items-center justify-center h-10 w-10 rounded-full bg-[#F7F0E2] mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B3A082]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </span>
                    <div>
                        <h2 class="font-bold text-lg">Payment Method</h2>
                        <p class="text-sm text-gray-500">Select your preferred payment option</p>
                    </div>
                </div>

                <!-- Payment methods (new addition) -->
                <div class="space-y-3 mb-5">
                    <div class="flex items-center p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-[#D7C5A9] transition-all">
                        <input type="radio" name="payment-method" id="midtrans" class="h-4 w-4 text-[#D7C5A9] focus:ring-[#D7C5A9]" checked />
                        <label for="midtrans" class="ml-3 block text-sm font-medium">
                            Midtrans (Credit/Debit Card, Bank Transfer, E-wallet)
                        </label>
                    </div>
                    <div class="flex items-center p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-[#D7C5A9] transition-all opacity-60">
                        <input type="radio" name="payment-method" id="cod" class="h-4 w-4 text-[#D7C5A9] focus:ring-[#D7C5A9]" disabled />
                        <label for="cod" class="ml-3 block text-sm font-medium">
                            Cash on Delivery (Coming Soon)
                        </label>
                    </div>
                </div>

                <button id="pay-button" class="relative overflow-hidden checkout-btn bg-gradient-to-r from-[#D7C5A9] to-[#B3A082] text-white px-4 py-4 rounded-xl w-full font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all">
                    <div class="flex items-center justify-center">
                        <span>Complete Payment</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                </button>
                <div id="snap-container" class="mt-4"></div>
            </div>

            <!-- User assurance (new addition) -->
            <div class="flex items-center justify-center mb-8 text-xs text-gray-500 space-x-6">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-[#B3A082]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <span>Secure Payment</span>
                </div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-[#B3A082]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span>Order Protection</span>
                </div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-[#B3A082]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>24/7 Support</span>
                </div>
            </div>
        </div>
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
                                `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}&limit=1&countrycodes=id`
                                )
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

<x-footer />
