<x-layout>

    <body class="bg-amber-50 min-h-screen font-sans" style="background-color: #ffefd0;">

        <div class="container mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6 border border-amber-200">
                <!-- Product Display -->
                <h4 class="text-xl font-semibold mb-4 text-amber-800 border-b border-amber-200 pb-2">Write a Review</h4>
                <div class="bg-white rounded-lg p-6 mb-6">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-1/3 mb-4 md:mb-0">
                            @if (isset($food->foodImage))
                                @php
                                    $foodImage = explode(',', $food->foodImage)[0] ?? null;
                                @endphp
                                @if ($foodImage)
                                    <img src="{{ asset($foodImage) }}" alt="{{ $food->foodName }}"
                                        class="rounded w-full h-auto object-cover">
                                @else
                                    <img src="/api/placeholder/400/320" alt="No Image Available"
                                        class="rounded w-full h-auto object-cover">
                                @endif
                            @else
                                <img src="/api/placeholder/400/320" alt="No Image Available"
                                    class="rounded w-full h-auto object-cover">
                            @endif
                        </div>
                        <div class="md:w-2/3 md:pl-6">
                            <h2 class="text-2xl font-bold mb-2 text-amber-900">{{ $food->foodName ?? 'Product Name' }}
                            </h2>
                            <p class="text-amber-700 mb-4">{{ $food->foodDescription ?? 'Product Description' }}</p>
                            <div class="text-2xl font-bold text-amber-600 mb-4">Rp.
                                {{ number_format($orderDetail->price, 0, ',', '.') }}</div>
                            <div class="text-amber-600 bg-amber-50 p-3 rounded-md inline-block"
                                style="background-color: #fff6e0;">
                                <p>Quantity: {{ $orderDetail->unit }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Write a Review Section -->
                <div class="mb-6 pb-6 border-b border-amber-200">
                    <form action="{{ route('reviews.store', $orderDetail->id) }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-amber-800 mb-2 font-medium">Your Rating</label>
                            <div class="star-rating flex text-3xl text-amber-200">
                                <input type="radio" id="star5" name="rating" value="1" class="hidden"
                                    required />
                                <label for="star5" class="fas fa-star cursor-pointer px-1"></label>
                                <input type="radio" id="star4" name="rating" value="2" class="hidden" />
                                <label for="star4" class="fas fa-star cursor-pointer px-1"></label>
                                <input type="radio" id="star3" name="rating" value="3" class="hidden" />
                                <label for="star3" class="fas fa-star cursor-pointer px-1"></label>
                                <input type="radio" id="star2" name="rating" value="4" class="hidden" />
                                <label for="star2" class="fas fa-star cursor-pointer px-1"></label>
                                <input type="radio" id="star1" name="rating" value="5" class="hidden" />
                                <label for="star1" class="fas fa-star cursor-pointer px-1"></label>
                            </div>
                            @error('rating')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="comment" class="block text-amber-800 mb-2 font-medium">Your Review</label>
                            <textarea id="comment" name="comment" rows="5"
                                class="w-full px-4 py-3 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400 bg-amber-50"
                                style="background-color: #fff9e6;" placeholder="Tell us what you liked or disliked about this product" required></textarea>
                            @error('comment')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit"
                                class="bg-amber-600 text-white px-6 py-2 rounded-lg hover:bg-amber-700 transition shadow-sm font-medium">
                                Submit Review
                            </button>

                            <a href="{{ route('reviews.index') }}"
                                class="bg-white text-amber-700 border border-amber-300 px-6 py-2 rounded-lg hover:bg-amber-50 transition shadow-sm font-medium">
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
                        starLabels.forEach(s => s.classList.remove('text-amber-500'));

                        // Highlight selected stars
                        for (let i = 0; i <= index; i++) {
                            starLabels[i].classList.add('text-amber-500');
                        }

                        console.log(`Selected rating: ${this.value}`);
                    });
                });

                // Visual hover effect
                starLabels.forEach((star, index) => {
                    star.addEventListener('mouseenter', function() {
                        // Highlight hovered star and all before it
                        for (let i = 0; i <= index; i++) {
                            starLabels[i].classList.add('text-amber-400');
                        }
                    });

                    star.addEventListener('mouseleave', function() {
                        // On mouse leave, remove hover highlight
                        starLabels.forEach(s => s.classList.remove('text-amber-400'));

                        // Reapply selected rating highlight if any
                        const selectedRating = document.querySelector('.star-rating input:checked');
                        if (selectedRating) {
                            const selectedIndex = Array.from(stars).indexOf(selectedRating);
                            for (let i = 0; i <= selectedIndex; i++) {
                                starLabels[i].classList.add('text-amber-500');
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</x-layout>
