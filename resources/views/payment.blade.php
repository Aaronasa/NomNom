<x-layout>
    <x-navigation />

    <style>
        .payment-container {
            background-color: #FFF8E6;
            min-height: 100vh;
            padding: 2rem 0;
            font-family: 'Inter', sans-serif;
        }
        .payment-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .back-button {
            color: #3c2f27;
            text-decoration: none;
            display: flex;
            align-items: center;
            margin-right: 1rem;
        }
        .restaurant-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #3c2f27;
        }
        .payment-card {
            background-color: #FFFFFF;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 1.5rem;
            margin-bottom: 1rem;
        }
        .delivery-section {
            margin-bottom: 1.5rem;
        }
        .delivery-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .delivery-time {
            font-size: 0.875rem;
            color: #7A6247;
            margin-bottom: 1rem;
        }
        .address-input {
            display: flex;
            align-items: center;
            border: 1px solid #E5CBA6;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            width: 100%;
        }
        .address-icon {
            color: #E74C3C;
            margin-right: 0.5rem;
        }
        .map-container {
            height: 180px;
            border-radius: 0.5rem;
            overflow: hidden;
            margin-bottom: 1rem;
        }
        .edit-map-btn {
            background-color: #E5CBA6;
            color: #3c2f27;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            float: right;
            font-size: 0.875rem;
        }
        .address-details {
            display: flex;
            margin-top: 1rem;
        }
        .address-column {
            flex: 1;
        }
        .address-title {
            font-weight: 600;
            color: #3c2f27;
            margin-bottom: 0.5rem;
        }
        .address-value {
            font-size: 0.875rem;
            color: #7A6247;
        }
        .notes-input {
            width: 100%;
            border: 1px solid #E5CBA6;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            margin-top: 0.5rem;
            font-size: 0.875rem;
        }
        .item-card {
            margin-top: 1rem;
            padding: 1rem;
        }
        .item-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        .item-icon {
            width: 24px;
            height: 24px;
            margin-right: 0.5rem;
        }
        .item-title {
            font-weight: 600;
            color: #3c2f27;
        }
        .item-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        .item-image {
            width: 80px;
            height: 80px;
            border-radius: 0.25rem;
            overflow: hidden;
            background-color: #f0f0f0;
        }
        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .item-details {
            flex-grow: 1;
            padding: 0 1rem;
        }
        .item-name {
            font-weight: 500;
            color: #3c2f27;
        }
        .item-price {
            font-size: 0.875rem;
            color: #7A6247;
        }
        .item-quantity {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .quantity-btn {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #F4ECD8;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            color: #7A6247;
        }
        .add-more-btn {
            border: 1px dashed #E5CBA6;
            color: #7A6247;
            background-color: transparent;
            border-radius: 0.5rem;
            padding: 0.5rem;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        .payment-summary {
            margin-top: 1rem;
        }
        .summary-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        .summary-icon {
            width: 24px;
            height: 24px;
            margin-right: 0.5rem;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        .summary-label {
            color: #7A6247;
        }
        .summary-value {
            font-weight: 500;
            color: #3c2f27;
        }
        .summary-total {
            border-top: 1px solid #E5CBA6;
            margin-top: 0.5rem;
            padding-top: 0.5rem;
        }
        .qr-container {
            display: none;
            background-color: rgba(0,0,0,0.7);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        .qr-modal {
            background-color: #FFF8E6;
            border-radius: 0.75rem;
            padding: 2rem;
            width: 90%;
            max-width: 400px;
            text-align: center;
        }
        .qr-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #3c2f27;
            margin-bottom: 1.5rem;
        }
        .qr-image {
            width: 200px;
            height: 200px;
            margin: 0 auto 1.5rem;
        }
        .qr-total {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        .qr-total-label {
            font-weight: 500;
            color: #3c2f27;
        }
        .qr-total-value {
            font-weight: 600;
            color: #3c2f27;
        }
        .save-qr-btn {
            background-color: #E5CBA6;
            color: #3c2f27;
            border: none;
            padding: 0.75rem;
            border-radius: 0.5rem;
            font-weight: 500;
            width: 100%;
            cursor: pointer;
        }
        .checkout-btn {
            background-color: #E5CBA6;
            color: #3c2f27;
            border: none;
            padding: 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            margin: 0 auto;
            max-width: 600px;
            z-index: 100;
        }
        .bottom-padding {
            height: 80px;
        }
        .logo-branding {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
        }
        .logo {
            font-weight: 800;
            font-size: 1.5rem;
            color: #3c2f27;
        }
        
        @media (min-width: 768px) {
            .checkout-btn {
                position: static;
                margin-top: 1rem;
            }
            .bottom-padding {
                height: 0;
            }
        }
    </style>

    <section class="payment-container">
        <div class="container mx-auto px-4 max-w-2xl">
            <div class="payment-header">
                <a href="{{ route('cart.index') }}" class="back-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h1 class="restaurant-name">{{ $restaurantName ?? 'Burger Bangor, Kozko' }}</h1>
            </div>

            <div class="payment-card">
                <div class="delivery-section">
                    <div class="delivery-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="3" width="15" height="13" rx="2" ry="2"></rect>
                            <circle cx="16" cy="16" r="6"></circle>
                            <path d="M16 12v4"></path>
                            <path d="M18 14h-4"></path>
                        </svg>
                        Delivery
                    </div>
                    <div class="delivery-time">Delivery in 60 mins</div>
                    
                    <div class="address-input">
                        <span class="address-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" color="#E74C3C">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </span>
                        <input type="text" placeholder="Enter Your Location" class="flex-grow border-0 focus:outline-none bg-transparent">
                    </div>

                    <div class="map-container">
                        <img src="{{ asset('images/map.png') }}" alt="Map" style="width: 100%; height: 100%; object-fit: cover;" id="map-image">
                    </div>
                    
                    <button class="edit-map-btn">Edit Map</button>
                    
                    <div class="address-details">
                        <div class="address-column">
                            <div class="address-title">Address Detail</div>
                            <div class="address-value">
                                Universitas Ciputra Surabaya<br>
                                Made, Sambikerep, East Java, Indonesia
                            </div>
                        </div>
                        <div class="address-column">
                            <div class="address-title">Location Detail (optional)</div>
                            <input type="text" placeholder="Flat/unit number, Floor number" class="notes-input">
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <div class="address-title">Delivery Notes</div>
                        <input type="text" placeholder="e.g. Please leave food at the doorstep" class="notes-input">
                    </div>
                </div>
            </div>

            <div class="payment-card item-card">
                <div class="item-header">
                    <span class="item-icon">📋</span>
                    <span class="item-title">Your Selected Items</span>
                </div>
                
                @foreach ($cart as $item)
                <div class="item-row">
                    <div class="item-image">
                        <img src="{{ asset($item['foodImage']) }}" alt="{{ $item['foodName'] }}">
                    </div>
                    <div class="item-details">
                        <div class="item-name">{{ $item['foodName'] }}</div>
                        <div class="item-price">Rp. {{ number_format($item['foodPrice'], 0, ',', '.') }}</div>
                    </div>
                    <div class="item-quantity">
                        <span>{{ $item['quantity'] }}x</span>
                    </div>
                </div>
                @endforeach
                
                <button class="add-more-btn">
                    <span>+</span>
                    <span>Add More</span>
                </button>
            </div>

            <div class="payment-card payment-summary">
                <div class="summary-header">
                    <span class="summary-icon">💵</span>
                    <span class="item-title">Payment Summary</span>
                </div>
                
                <div class="summary-row">
                    <span class="summary-label">Price</span>
                    <span class="summary-value">Rp. {{ number_format($subTotal, 0, ',', '.') }}</span>
                </div>
                
                <div class="summary-row">
                    <span class="summary-label">Delivery Fee</span>
                    <span class="summary-value">Rp. {{ number_format($deliveryFee, 0, ',', '.') }}</span>
                </div>
                
                <div class="summary-row">
                    <span class="summary-label">Admin</span>
                    <span class="summary-value">Rp. {{ number_format($adminFee, 0, ',', '.') }}</span>
                </div>
                
                <div class="summary-row summary-total">
                    <span class="summary-label">Total Payment</span>
                    <span class="summary-value">Rp. {{ number_format($totalPrice, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="logo-branding">
                <div class="logo">QRIS</div>
                <div class="total-price">Rp. {{ number_format($totalPrice, 0, ',', '.') }}</div>
            </div>

            <button class="checkout-btn" id="show-qr-btn">
                <span>Show QR</span>
                <span>OK</span>
            </button>
            
            <div class="bottom-padding"></div>
        </div>
    </section>

    <!-- QR Code Modal -->
    <div class="qr-container" id="qr-modal">
        <div class="qr-modal">
            <h2 class="qr-title">Pembayaran QR Code</h2>
            <div class="qr-image">
                <img src="{{ asset('images/qr-code.png') }}" alt="QR Code" id="qr-code-image">
            </div>
            <div class="qr-total">
                <span class="qr-total-label">Total</span>
                <span class="qr-total-value">Rp. {{ number_format($totalPrice, 0, ',', '.') }}</span>
            </div>
            <form action="{{ route('payment.process') }}" method="POST">
                @csrf
                <input type="hidden" name="order_id" value="{{ $orderId }}">
                <button type="submit" class="save-qr-btn">Save QR Code</button>
            </form>
        </div>
    </div>

    <script>
        // QR Code Modal Functions
        const showQrBtn = document.getElementById('show-qr-btn');
        const qrModal = document.getElementById('qr-modal');
        
        if (showQrBtn && qrModal) {
            showQrBtn.addEventListener('click', function() {
                qrModal.style.display = 'flex';
                
                // Generate QR code dynamically
                const qrCodeImage = document.getElementById('qr-code-image');
                if (qrCodeImage) {
                    // In a real implementation, you would generate a QR code
                    // For demo purposes, we're using a placeholder
                    // qrCodeImage.src = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ $paymentUrl }}";
                }
            });
            
            // Close modal when clicking outside
            qrModal.addEventListener('click', function(e) {
                if (e.target === qrModal) {
                    qrModal.style.display = 'none';
                }
            });
        }
        
        // Map placeholder
        const mapImage = document.getElementById('map-image');
        if (!mapImage.src) {
            mapImage.src = "https://maps.googleapis.com/maps/api/staticmap?center=Universitas+Ciputra+Surabaya&zoom=15&size=600x300&maptype=roadmap&markers=color:red%7C-7.2880168,112.6399508&key=YOUR_API_KEY";
        }
    </script>

    <x-footer />
</x-layout>