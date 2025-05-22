<x-layout>
    {{-- <x-navnavigation/> --}}

    <body class="bg-gray-100 min-h-screen font-sans">

        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <!-- Product Display -->
                <h4 class="text-lg font-semibold mb-4">Write a Review</h4>
                <div class="bg-white rounded-lgp-6 mb-6">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-1/3 mb-4 md:mb-0">
                            @if(isset($food->foodImage))
                                @php
                                    $foodImage = explode(',', $food->foodImage)[0] ?? null;
                                @endphp
                                @if($foodImage)
                                    <img src="{{ asset($foodImage) }}" alt="{{ $food->foodName }}" class="rounded w-full h-auto object-cover">
                                @else
                                    <img src="/api/placeholder/400/320" alt="No Image Available" class="rounded w-full h-auto object-cover">
                                @endif
                            @else
                                <img src="/api/placeholder/400/320" alt="No Image Available" class="rounded w-full h-auto object-cover">
                            @endif
                        </div>
                        <div class="md:w-2/3 md:pl-6">
                            <h2 class="text-2xl font-bold mb-2">{{ $food->foodName ?? 'Product Name' }}</h2>
                            <p class="text-gray-700 mb-4">{{ $food->foodDescription ?? 'Product Description' }}</p>
                            <div class="text-2xl font-bold text-blue-600 mb-4">Rp. {{ number_format($orderDetail->price, 0, ',', '.') }}</div>
                            <div class="text-gray-600">
                                <p>Quantity: {{ $orderDetail->unit }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Write a Review Section -->
                <div class="mb-6 pb-6 border-b">
                    <form action="{{ route('reviews.store', $orderDetail->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Your Rating</label>
                            <div class="star-rating flex text-3xl text-gray-300">
                                <input type="radio" id="star5" name="rating" value="5" required />
                                <label for="star5" class="fas fa-star cursor-pointer"></label>
                                <input type="radio" id="star4" name="rating" value="4" />
                                <label for="star4" class="fas fa-star cursor-pointer"></label>
                                <input type="radio" id="star3" name="rating" value="3" />
                                <label for="star3" class="fas fa-star cursor-pointer"></label>
                                <input type="radio" id="star2" name="rating" value="2" />
                                <label for="star2" class="fas fa-star cursor-pointer"></label>
                                <input type="radio" id="star1" name="rating" value="1" />
                                <label for="star1" class="fas fa-star cursor-pointer"></label>
                            </div>
                            @error('rating')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="review" class="block text-gray-700 mb-2">Your Review</label>
                            <textarea id="review" name="review" rows="5"
                                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Tell us what you liked or disliked about this product" required></textarea>
                            @error('review')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                                Submit Review
                            </button>
                            
                            <a href="{{ route('reviews.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400 transition">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            // Enhance star rating UI
            document.addEventListener('DOMContentLoaded', function() {
                const stars = document.querySelectorAll('.star-rating input');
                const starLabels = document.querySelectorAll('.star-rating label');
                
                // Update star visual on selection
                stars.forEach((star, index) => {
                    star.addEventListener('change', function() {
                        // Reset all stars
                        starLabels.forEach(s => s.classList.remove('text-yellow-400'));
                        
                        // Highlight selected stars
                        for(let i = 0; i <= index; i++) {
                            starLabels[i].classList.add('text-yellow-400');
                        }
                        
                        console.log(`Selected rating: ${this.value}`);
                    });
                });
                
                // Visual hover effect
                starLabels.forEach((star, index) => {
                    star.addEventListener('mouseenter', function() {
                        // Highlight hovered star and all before it
                        for(let i = 0; i <= index; i++) {
                            starLabels[i].classList.add('text-yellow-300');
                        }
                    });
                    
                    star.addEventListener('mouseleave', function() {
                        // On mouse leave, remove hover highlight
                        starLabels.forEach(s => s.classList.remove('text-yellow-300'));
                    });
                });
            });
        </script>
    </body>
</x-layout>