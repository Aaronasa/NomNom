<x-layout>
    <x-navigation />

    <style>
        .cart-container {
            background-color: #FFF8E6;
            min-height: 100vh;
            padding: 2rem 0;
            font-family: 'Inter', sans-serif;
        }

        .cart-header {
            color: #3c2f27;
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
        }

        .back-link {
            color: #7A6247;
            text-decoration: none;
            display: block;
            margin-bottom: 3rem;
            font-weight: 500;
            text-align: center;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .cart-item {
            background-color: #FFF8E6;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #f0e6d2;
        }

        .cart-item-image {
            width: 148px;
            height: 148px;
            border-radius: 0.25rem;
            overflow: hidden;
            background-color: #e0e0e0;
        }

        .cart-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cart-item-details {
            flex: 1;
            padding: 0 1.5rem;
        }

        .cart-item-header {
            display: flex;
            flex-direction: column;
            margin-bottom: 0.5rem;
        }

        .item-restaurant {
            font-size: 1.25rem;
            font-weight: 700;
            color: #3c2f27;
            margin-bottom: 0.25rem;
        }

        .item-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: #3c2f27;
            margin-bottom: 0.5rem;
        }

        .item-note {
            color: #7A6247;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .remove-link {
            color: #7A6247;
            text-decoration: none;
            font-size: 0.875rem;
            display: block;
            margin-top: 0.5rem;
        }

        .remove-link:hover {
            text-decoration: underline;
        }

        .cart-item-price {
            width: 120px;
            text-align: right;
            font-weight: 600;
            color: #3c2f27;
            font-size: 1rem;
        }

        .cart-item-quantity {
            width: 140px;
            text-align: center;
        }

        .cart-item-total {
            width: 120px;
            text-align: right;
            font-weight: 600;
            color: #3c2f27;
            font-size: 1rem;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid #e0e0e0;
            border-radius: 0.25rem;
            padding: 0.25rem;
            width: 100px;
            margin: 0 auto;
        }

        .quantity-btn {
            background-color: transparent;
            color: #7A6247;
            border: none;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .quantity-btn:hover {
            background-color: #f5f5f5;
            border-radius: 0.25rem;
        }

        .quantity-value {
            flex: 1;
            text-align: center;
            font-weight: 600;
            color: #3c2f27;
        }

        .cart-footer {
            margin-top: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .subtotal-container {
            flex: 1;
            text-align: right;
            padding-right: 1rem;
        }

        .subtotal-label {
            font-size: 1.25rem;
            font-weight: 600;
            color: #3c2f27;
            margin-bottom: 0.5rem;
        }

        .subtotal-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #3c2f27;
        }

        .checkout-btn {
            background-color: #E5CBA6;
            color: #3c2f27;
            border: none;
            padding: 1rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 1.125rem;
            cursor: pointer;
            transition: background-color 0.2s;
            width: 200px;
        }

        .checkout-btn:hover {
            background-color: #d4b78f;
        }

        .tax-note {
            color: #7A6247;
            font-size: 0.875rem;
            text-align: right;
            margin-top: 0.5rem;
        }

        .cart-header-row {
            display: flex;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            color: #3c2f27;
            font-weight: 600;
        }

        .cart-header-item {
            flex: 1;
        }

        .cart-header-price,
        .cart-header-quantity,
        .cart-header-total {
            width: 120px;
            text-align: center;
        }

        .cart-header-total {
            text-align: right;
        }

        @media (max-width: 768px) {
            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .cart-item-image {
                width: 100%;
                height: 200px;
                margin-bottom: 1rem;
            }

            .cart-item-details {
                width: 100%;
                padding: 0;
                margin-bottom: 1rem;
            }

            .cart-header-row {
                display: none;
            }

            .cart-item-price,
            .cart-item-quantity,
            .cart-item-total {
                width: 100%;
                text-align: left;
                margin-top: 0.5rem;
            }

            .quantity-control {
                margin: 0;
            }

            .cart-footer {
                flex-direction: column;
            }

            .subtotal-container {
                width: 100%;
                padding-right: 0;
                margin-bottom: 1rem;
            }

            .checkout-btn {
                width: 100%;
            }
        }
    </style>

    <section class="cart-container">
        <div class="container mx-auto px-4 max-w-4xl">
            <h1 class="cart-header">Your Cart</h1>
            <a href="{{ route('order.view') }}" class="back-link">Back to shopping</a>

            @if (count($cart) > 0)
                <div class="cart-header-row">
                    <div class="cart-header-item">{{ $cart[0]['restaurantName'] ?? 'Your Order' }}</div>
                    <div class="cart-header-price">Price</div>
                    <div class="cart-header-quantity">Quantity</div>
                    <div class="cart-header-total">Total</div>
                </div>

                @foreach ($cart as $item)
                    <div class="cart-item">
                        <div class="cart-item-image">
                            <img src="{{ asset($item['foodImage']) }}" alt="{{ $item['foodName'] }}" />
                        </div>
                        <div class="cart-item-details">
                            <div class="cart-item-header">
                                <h3 class="item-name">{{ $item['foodName'] }}</h3>

                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="menuDayId" value="{{ $item['menuDayId'] }}">
                                    <button type="submit" class="remove-link">Remove</button>
                                </form>
                            </div>
                        </div>
                        <div class="cart-item-price">
                            Rp. {{ number_format($item['foodPrice'], 0, ',', '.') }}
                        </div>
                        <div class="cart-item-quantity">
                            <div class="quantity-control">
                                <button class="quantity-btn"
                                    onclick="updateQuantity('{{ $item['menuDayId'] }}', -1)">−</button>
                                <span class="quantity-value"
                                    id="quantity-{{ $item['menuDayId'] }}">{{ $item['quantity'] }}</span>
                                <button class="quantity-btn"
                                    onclick="updateQuantity('{{ $item['menuDayId'] }}', 1)">+</button>
                            </div>
                        </div>
                        <div class="cart-item-total" id="total-{{ $item['menuDayId'] }}">
                            Rp. {{ number_format($item['foodPrice'] * $item['quantity'], 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach

                <div class="cart-footer">
                    <div class="subtotal-container">
                        <div class="subtotal-label">Sub-total</div>
                        <div class="subtotal-value" id="subtotal">Rp. {{ number_format($totalPrice, 0, ',', '.') }}
                        </div>
                        <p class="tax-note">Tax and shipping cost will be calculated later</p>
                    </div>
                    <form action="{{ route('cart.finish') }}" method="POST">
                        @csrf
                        <button type="submit" class="checkout-btn">Check-out</button>
                    </form>
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-[#7A6247]">Your cart is empty.</p>
                </div>
            @endif
        </div>
    </section>

    <script>
        function updateQuantity(menuDayId, change) {
            const quantityElement = document.getElementById(`quantity-${menuDayId}`);
            const currentQuantity = parseInt(quantityElement.textContent);
            const newQuantity = currentQuantity + change;

            if (newQuantity < 1) return;

            fetch('{{ route('cart.update') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        menuDayId: menuDayId,
                        quantity: newQuantity
                    })
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Update quantity display
                        quantityElement.textContent = newQuantity;

                        // Update item total - format as integer
                        const totalElement = document.getElementById(`total-${menuDayId}`);
                        totalElement.textContent = `Rp. ${formatNumber(parseInt(data.itemTotal))}`;

                        // Update subtotal - format as integer
                        document.getElementById('subtotal').textContent =
                        `Rp. ${formatNumber(parseInt(data.subtotal))}`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to update quantity. Please try again.');
                });
        }

        function formatNumber(number) {
            // Ensure number is an integer and format with thousands separator
            return Math.round(number).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>

    <x-footer />
</x-layout>
