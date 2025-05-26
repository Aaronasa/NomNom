<x-layout>
    <x-navigation />
    <div class="min-h-screen bg-[#FFF8E6] flex flex-col md:flex-row font-sans">
        <!-- Carousel Section -->
        <div class="relative h-[40vh] bg-gray-100 overflow-hidden md:h-screen md:w-[55%]">
            <div class="relative overflow-hidden w-full h-full">
                @php
                    $images = explode(',', $menuDay->foodInMenuDay->foodImage);
                @endphp

                <!-- Loop through all images -->
                @foreach ($images as $index => $image)
                    <input class="carousel-open absolute opacity-0 invisible" type="radio"
                        id="carousel-{{ $index + 1 }}" name="carousel" aria-hidden="true"
                        {{ $index === 0 ? 'checked="checked"' : '' }}>
                    <div
                        class="carousel-item absolute opacity-0 w-full h-full transition-opacity duration-500 ease-out {{ $index === 0 ? '!opacity-100' : '' }}">
                        <img src="{{ asset($image) }}" alt="Food image {{ $index + 1 }}"
                            class="w-full h-full object-cover object-center">
                    </div>
                @endforeach

                <!-- Carousel Controls -->
                @foreach ($images as $index => $image)
                    @if ($index > 0)
                        <label for="carousel-{{ $index }}"
                            class="control-{{ $index + 1 }} absolute top-1/2 left-4 -translate-y-1/2 z-20 cursor-pointer w-20 h-20 bg-opacity-70 rounded-full flex items-center justify-center text-6xl font-bold text-black hover:bg-opacity-90 transition-all duration-300 {{ $index === 0 ? '' : 'hidden' }}">
                            <span>‹</span>
                        </label>
                    @endif

                    @if ($index < count($images) - 1)
                        <label for="carousel-{{ $index + 2 }}"
                            class="control-{{ $index + 1 }} absolute top-1/2 right-4 -translate-y-1/2 z-20 cursor-pointer w-20 h-20  bg-opacity-70 rounded-full flex items-center justify-center text-6xl font-bold text-black hover:bg-opacity-90 transition-all duration-300 {{ $index === 0 ? '' : 'hidden' }}">
                            <span>›</span>
                        </label>
                    @endif
                @endforeach

                <!-- Carousel Indicators -->
                <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2 z-10">
                    @foreach ($images as $index => $image)
                        <label for="carousel-{{ $index + 1 }}"
                            class="w-2 h-2 rounded-full bg-white bg-opacity-50 cursor-pointer hover:bg-opacity-100 transition-all duration-300 {{ $index === 0 ? '!bg-opacity-100' : '' }}"></label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Food Info Section -->
        <div class="p-8 md:p-12 md:w-[45%] md:overflow-y-auto">
            <div class="mb-3">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    {{ $menuDay->foodInMenuDay->foodName }}
                </h1>
                <p class="text-gray-500">
                    {{ $menuDay->foodInMenuDay->restaurantInFood->restaurantName }}
                </p>
            </div>
            <div class="flex items-center mb-4">
                @if ($averageRating > 0)
                    <span class="flex items-center">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= $averageRating ? 'text-yellow-400' : 'text-gray-300' }} fill-current"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                            </svg>
                        @endfor
                    </span>
                    <span class="ml-2 text-sm text-gray-700 font-medium">{{ $averageRating }}</span>
                    <span class="ml-2 text-sm text-gray-600 font-medium">({{ $reviewCount }}
                        {{ $reviewCount == 1 ? 'review' : 'reviews' }})</span>
                @else
                    <span class="flex items-center">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 20 20">
                                <path
                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                            </svg>
                        @endfor
                    </span>
                    <span class="ml-2 text-sm text-gray-500">No reviews yet</span>
                @endif
            </div>

            <div class="flex justify-between items-center mb-6">
                <div class="text-2xl font-bold text-gray-800">
                    Rp {{ number_format($menuDay->foodInMenuDay->foodPrice, 0, ',', '.') }}
                </div>
                <div
                    class="inline-block px-2 py-1 rounded-full text-xs font-medium {{ \Carbon\Carbon::parse($menuDay->foodDate)->isToday() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ \Carbon\Carbon::parse($menuDay->foodDate)->isToday() ? 'Available Today' : 'Available on ' . \Carbon\Carbon::parse($menuDay->foodDate)->format('d M Y') }}
                </div>
            </div>

            <div class="mb-8 text-gray-700 leading-relaxed">
                {{ $menuDay->foodInMenuDay->foodDescription }}
            </div>

            <div class="flex flex-col gap-2 mb-6">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Preparation time: 20-30 minutes</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    <span> Delivery in 30–60 minutes.</span>
                </div>
            </div>

            <div class="flex flex-col gap-4">
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="food"
                        value="{{ json_encode([
                            'menuDayId' => $menuDay->id,
                            'foodName' => $menuDay->foodInMenuDay->foodName,
                            'foodPrice' => $menuDay->foodInMenuDay->foodPrice,
                            'foodImage' => $menuDay->foodInMenuDay->foodImage,
                        ]) }}">
                    <input type="hidden" name="quantity" id="quantity-input" value="1">
                    <button type="submit"
                        class="w-full flex justify-center items-center bg-[#E5CBA6] hover:bg-[#d6b88d] text-white font-medium py-3 px-4 rounded-lg transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        Add to cart
                    </button>
                </form>
                <a href="/home"
                    class="w-full flex justify-center items-center bg-white hover:bg-gray-100 text-gray-600 font-medium py-3 px-4 border border-gray-300 rounded-lg transition-all duration-300 text-center">
                    Back to menu
                </a>
            </div>
        </div>
    </div>

    <script>
        // Carousel functionality
        document.addEventListener('DOMContentLoaded', function() {
            const carouselInputs = document.querySelectorAll('.carousel-open');
            const carouselItems = document.querySelectorAll('.carousel-item');
            const indicators = document.querySelectorAll('[for^="carousel-"]');
            const controls = document.querySelectorAll('[class*="control-"]');

            carouselInputs.forEach((input, index) => {
                input.addEventListener('change', function() {
                    // Hide all items
                    carouselItems.forEach(item => {
                        item.classList.remove('!opacity-100');
                    });

                    // Show current item
                    carouselItems[index].classList.add('!opacity-100');

                    // Update indicators
                    indicators.forEach(indicator => {
                        if (indicator.getAttribute('for') !== `carousel-${index + 1}`) {
                            indicator.classList.remove('!bg-opacity-100');
                        } else {
                            indicator.classList.add('!bg-opacity-100');
                        }
                    });

                    // Update controls visibility
                    controls.forEach(control => {
                        control.classList.add('hidden');
                    });

                    const currentControls = document.querySelectorAll(`.control-${index + 1}`);
                    currentControls.forEach(control => {
                        control.classList.remove('hidden');
                    });
                });
            });

            // Function to handle quantity changes
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

            // Add event listeners for quantity buttons if they exist
            const incrementBtn = document.getElementById('increment');
            const decrementBtn = document.getElementById('decrement');

            if (incrementBtn) {
                incrementBtn.addEventListener('click', incrementQuantity);
            }

            if (decrementBtn) {
                decrementBtn.addEventListener('click', decrementQuantity);
            }
        });
    </script>

    <x-footer></x-footer>
</x-layout>
