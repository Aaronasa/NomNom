<style>
    .hover\:grow {
        transition: all 0.3s;
        transform: scale(1);
    }

    .hover\:grow:hover {
        transform: scale(1.02);
    }

    /* Improved carousel styling */
    .carousel-open:checked+.carousel-item {
        position: static;
        opacity: 100;
    }

    .carousel-item {
        transition: opacity 0.6s ease-out;
    }

    #carousel-1:checked~.control-1,
    #carousel-2:checked~.control-2,
    #carousel-3:checked~.control-3 {
        display: block;
    }

    .carousel-indicators {
        list-style: none;
        margin: 0;
        padding: 0;
        position: absolute;
        bottom: 2%;
        left: 0;
        right: 0;
        text-align: center;
        z-index: 10;
    }

    .carousel-bullet {
        width: 10px;
        height: 10px;
        display: inline-block;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        margin: 0 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .carousel-bullet.active {
        background-color: white;
    }

    /* Custom food detail page styling */
    .food-detail-container {
        background-color: #FFF8E6;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        font-family: 'Instrument Sans', sans-serif;
    }

    @media (min-width: 768px) {
        .food-detail-container {
            flex-direction: row;
        }
    }

    .food-carousel {
        position: relative;
        height: 40vh;
        background-color: #f3f4f6;
        overflow: hidden;
    }

    @media (min-width: 768px) {
        .food-carousel {
            height: 100vh;
            width: 55%;
        }
    }

    .food-info {
        padding: 2rem;
    }

    @media (min-width: 768px) {
        .food-info {
            width: 45%;
            padding: 3rem;
            overflow-y: auto;
        }
    }

    .carousel-control {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 20;
        cursor: pointer;
        width: 40px;
        height: 40px;
        background-color: rgba(255, 255, 255, 0.7);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: bold;
        color: #4B5563;
        transition: all 0.3s ease;
    }

    .carousel-control:hover {
        background-color: rgba(255, 255, 255, 0.9);
    }

    .carousel-control.prev {
        left: 1rem;
    }

    .carousel-control.next {
        right: 1rem;
    }

    .food-actions {
        margin-top: 2rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .btn-primary {
        background-color: #E5CBA6;
        color: white;
        border: none;
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #d6b88d;
    }

    .btn-secondary {
        background-color: white;
        color: #4B5563;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #f3f4f6;
    }

    .badge {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
        background-color: #FECACA;
        color: #991B1B;
    }

    .badge.available {
        background-color: #D1FAE5;
        color: #065F46;
    }

    .food-meta {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .food-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .food-meta-icon {
        width: 20px;
        height: 20px;
        color: #9CA3AF;
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .quantity-btn {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f3f4f6;
        border-radius: 50%;
        cursor: pointer;
        font-weight: bold;
    }

    .quantity-btn:hover {
        background-color: #e5e7eb;
    }

    .quantity-display {
        font-weight: 500;
        font-size: 1.125rem;
    }

    .food-description {
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .indicators {
        position: absolute;
        bottom: 1rem;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    .indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        cursor: pointer;
    }

    .indicator.active {
        background-color: white;
    }
</style>

<x-layout>
    <x-navigation />
    <div class="food-detail-container">
        <!-- Carousel Section -->
        <div class="food-carousel">
            <div class="carousel-inner relative overflow-hidden w-full h-full">
                @php
                    $images = explode(',', $menuDay->foodInMenuDay->foodImage); 
                @endphp

                <!-- Loop through all images -->
                @foreach ($images as $index => $image)
                    <input class="carousel-open" type="radio" id="carousel-{{ $index + 1 }}" name="carousel"
                        aria-hidden="true" hidden="true" {{ $index === 0 ? 'checked="checked"' : '' }}>
                    <div class="carousel-item absolute opacity-0 w-full h-full">
                        <div class="block h-full w-full bg-cover bg-center"
                            style="background-image: url('{{ asset($image) }}');">
                        </div>
                    </div>
                @endforeach

                <!-- Carousel Controls -->
                @foreach ($images as $index => $image)
                    @if ($index > 0)
                        <label for="carousel-{{ $index }}" 
                            class="carousel-control prev control-{{ $index + 1 }} hidden">
                            <span>‹</span>
                        </label>
                    @endif
                    
                    @if ($index < count($images) - 1)
                        <label for="carousel-{{ $index + 2 }}" 
                            class="carousel-control next control-{{ $index + 1 }} hidden">
                            <span>›</span>
                        </label>
                    @endif
                @endforeach

                <!-- Carousel Indicators -->
                <div class="indicators">
                    @foreach ($images as $index => $image)
                        <label for="carousel-{{ $index + 1 }}" 
                            class="indicator {{ $index === 0 ? 'active' : '' }}"></label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Food Info Section -->
        <div class="food-info">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    {{ $menuDay->foodInMenuDay->foodName }}
                </h1>
                <p class="text-gray-500">
                    {{ $menuDay->foodInMenuDay->restaurantInFood->restaurantName }}
                </p>
            </div>

            <div class="flex justify-between items-center mb-6">
                <div class="text-2xl font-bold text-gray-800">
                    Rp {{ number_format($menuDay->foodInMenuDay->foodPrice, 0, ',', '.') }}
                </div>
                <div class="badge {{ \Carbon\Carbon::parse($menuDay->foodDate)->isToday() ? 'available' : '' }}">
                    {{ \Carbon\Carbon::parse($menuDay->foodDate)->isToday() ? 'Available Today' : 'Available on ' . \Carbon\Carbon::parse($menuDay->foodDate)->format('d M Y') }}
                </div>
            </div>

            <div class="food-description text-gray-700">
                {{ $menuDay->foodInMenuDay->foodDescription }}
            </div>

            <div class="food-meta">
                <div class="food-meta-item">
                    <svg class="food-meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Preparation time: 20-30 minutes</span>
                </div>
                <div class="food-meta-item">
                    <svg class="food-meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span> Delivery in 30–60 minutes.</span>
                </div>
            </div>

            <div class="food-actions">
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="food" value="{{ json_encode([
                        'menuDayId' => $menuDay->id, 
                        'foodName' => $menuDay->foodInMenuDay->foodName,
                        'foodPrice' => $menuDay->foodInMenuDay->foodPrice,
                        'foodImage' => $menuDay->foodInMenuDay->foodImage,
                    ]) }}">
                    <input type="hidden" name="quantity" id="quantity-input" value="1">
                    <button type="submit" class="btn-primary w-full flex justify-center items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Add to cart
                    </button>
                </form>
                <a href="/home" class="btn-secondary w-full text-center">
                    Back to menu
                </a>
            </div>
        </div>
    </div>

    <script>
        function incrementQuantity() {
            const quantityDisplay = document.getElementById('quantity');
            const quantityInput = document.getElementById('quantity-input');
            const currentQuantity = parseInt(quantityDisplay.textContent);
            const newQuantity = currentQuantity + 1;
            quantityDisplay.textContent = newQuantity;
            quantityInput.value = newQuantity;
        }

        function decrementQuantity() {
            const quantityDisplay = document.getElementById('quantity');
            const quantityInput = document.getElementById('quantity-input');
            const currentQuantity = parseInt(quantityDisplay.textContent);
            if (currentQuantity > 1) {
                const newQuantity = currentQuantity - 1;
                quantityDisplay.textContent = newQuantity;
                quantityInput.value = newQuantity;
            }
        }

        // Update carousel indicators
        document.addEventListener('DOMContentLoaded', function() {
            const carouselInputs = document.querySelectorAll('.carousel-open');
            const indicators = document.querySelectorAll('.indicator');
            
            carouselInputs.forEach((input, index) => {
                input.addEventListener('change', function() {
                    indicators.forEach(indicator => indicator.classList.remove('active'));
                    indicators[index].classList.add('active');
                });
            });
        });
    </script>

    <x-footer></x-footer>
</x-layout>