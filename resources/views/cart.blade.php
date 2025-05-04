<x-layout>
    <x-navigation />

    <style>
        .cart-container {
            background-color: #FFF8E6;
            min-height: 100vh;
            padding: 2rem 0;
        }
        .cart-header {
            color: #7A6247;
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 2rem;
        }
        .back-link {
            color: #7A6247;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }
        .cart-item {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .item-name {
            font-size: 1.25rem;
            font-weight: 600;
            color: #4A3B2A;
            margin-bottom: 0.5rem;
        }
        .item-note {
            color: #7A6247;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }
        .item-price {
            font-weight: 600;
            color: #4A3B2A;
        }
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .quantity-btn {
            background-color: #E5CBA6;
            color: white;
            border: none;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .quantity-value {
            font-weight: 600;
        }
        .remove-btn {
            color: #7A6247;
            background: none;
            border: none;
            text-decoration: underline;
            cursor: pointer;
            padding: 0;
            margin-top: 1rem;
        }
        .subtotal {
            font-size: 1.25rem;
            font-weight: 600;
            color: #4A3B2A;
            margin: 2rem 0;
            text-align: right;
        }
        .checkout-btn {
            background-color: #D9C4A5;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .checkout-btn:hover {
            background-color: #C2AC8A;
        }
        .tax-note {
            color: #7A6247;
            font-size: 0.875rem;
            text-align: center;
            margin-top: 1rem;
        }
    </style>

    <section class="cart-container">
        <div class="container mx-auto px-4 max-w-4xl">
            <h1 class="cart-header">Your Cart</h1>
            <a href="{{ route('order.view') }}" class="back-link">← Back to shopping</a>

            @if (count($cart) > 0)
                @foreach ($cart as $item)
                    <div class="cart-item">
                        <h3 class="item-name">{{ $item['foodName'] }}</h3>
                        <p class="item-note">No Lettuce</p> <!-- Static note for now, can be dynamic if needed -->
                        
                        <div class="flex justify-between items-center">
                            <span class="item-price">Rp {{ number_format($item['foodPrice'], 0, ',', '.') }}</span>
                            
                            <div class="quantity-control">
                                <button class="quantity-btn">-</button>
                                <span class="quantity-value">{{ $item['quantity'] }}</span>
                                <button class="quantity-btn">+</button>
                            </div>
                            
                            <span class="item-price">Rp {{ number_format($item['foodPrice'] * $item['quantity'], 0, ',', '.') }}</span>
                        </div>
                        
                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="menuDayId" value="{{ $item['menuDayId'] }}">
                            <button type="submit" class="remove-btn">Remove</button>
                        </form>
                    </div>
                @endforeach

                <div class="subtotal">
                    Sub-total: Rp {{ number_format($totalPrice, 0, ',', '.') }}
                </div>

                <form action="{{ route('cart.finish') }}" method="POST">
                    @csrf
                    <button type="submit" class="checkout-btn">Check-out</button>
                </form>

                <p class="tax-note">Tax and shipping cost will be calculated later</p>
            @else
                <div class="text-center py-8">
                    <p class="text-[#7A6247]">Your cart is empty.</p>
                </div>
            @endif
        </div>
    </section>

    <x-footer />
</x-layout>