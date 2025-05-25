<x-layout>
    <x-navigation />

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .menu-item {
            box-shadow: 0 4px 2px rgba(0, 0, 0, 0.1), 
                        4px 4px 6px rgba(0, 0, 0, 0.2), 
                        -4px 4px 6px rgba(0, 0, 0, 0.2), 
                        0 -1px 2px rgba(0, 0, 0, 0.1);
        }

        .star-filled {
            color: #D9B25F;
        }
        
        .star-empty {
            color: #E5E5E5;
        }
    </style>

    <section class="bg-[#FFF8E6] py-12 min-h-screen">
        <div class="container mx-auto px-4 max-w-6xl font-[Instrument Sans]">
            <!-- Date Filter -->
            <div class="mb-10">
                <h2 class="text-3xl font-semibold text-[#7A6247] mb-6">Menu</h2>
                <form id="filterForm" method="GET" action="{{ route('order.view') }}" class="flex flex-col sm:flex-row items-center gap-4">
                    <div>
                        <label for="date" class="block text-lg text-[#7A6247] mb-1">Select Date:</label>
                        <input type="date" id="date" name="date" value="{{ request('date', now()->format('Y-m-d')) }}"
                            class="border border-[#E2CEB1] bg-white rounded-lg p-3 shadow-sm outline-none focus:ring-2 focus:ring-[#E2CEB1]"
                            onchange="document.getElementById('filterForm').submit();">
                    </div>
                    <button type="submit"
                        class="px-6 py-3 mt-6 sm:mt-9 bg-[#D9C4A5] text-white font-medium text-base rounded-lg hover:bg-[#C2AC8A] transition">
                        Show Menu
                    </button>
                </form>
            </div>

            <!-- Menu Grid -->
            @if($MenuDays->isEmpty())
                <p class="text-center text-gray-600 text-lg">No food available for the selected date.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach ($MenuDays as $menuDay)
                        @php
                            $foodImages = explode(',', $menuDay->foodInMenuDay->foodImage);
                            $firstImage = $foodImages[0];
                            $rating = $menuDayRatings[$menuDay->id] ?? ['average' => 0, 'count' => 0];
                            $averageRating = $rating['average'];
                            $reviewCount = $rating['count'];
                        @endphp
                        <a href="{{ route('food.detail', $menuDay->id) }}" >
                        <div class="bg-[#FFF8E6] border border-[#E2CEB1] rounded-xl menu-item flex p-4 gap-4 items-center">
                            <!-- Image -->
                            <div class="w-36 h-36 flex-shrink-0 rounded-lg overflow-hidden">
                                <img src="{{ asset($firstImage) }}" alt="{{ $menuDay->foodInMenuDay->foodName }}"
                                    class="w-full h-full object-cover" />
                            </div>

                            <!-- Content -->
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-xl font-bold text-[#4A3B2A]">{{ $menuDay->foodInMenuDay->foodName }}</h3>
                                    <div class="flex items-center gap-1 text-sm font-medium">
                                        @if($averageRating > 0)
                                            <!-- Display stars based on rating -->
                                            <div class="flex">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $averageRating ? 'star-filled' : 'star-empty' }}" 
                                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M10 15l-5.878 3.09 1.122-6.545L.488 6.91l6.564-.955L10 0l2.948 5.955 6.564.955-4.756 4.635 1.122 6.545z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                            <span class="text-[#D9B25F] ml-1">{{ $averageRating }}</span>
                                            <span class="text-gray-500 text-xs">({{ $reviewCount }})</span>
                                        @else
                                            <!-- No reviews yet -->
                                            <div class="flex">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 star-empty" xmlns="http://www.w3.org/2000/svg" 
                                                         viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M10 15l-5.878 3.09 1.122-6.545L.488 6.91l6.564-.955L10 0l2.948 5.955 6.564.955-4.756 4.635 1.122 6.545z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                            <span class="text-gray-400 ml-1 text-xs">No reviews</span>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mt-2 line-clamp-3">
                                    {{ $menuDay->foodInMenuDay->restaurantInFood->restaurantName }}
                                </p>
                                <div class="mt-3 flex justify-between items-center">
                                    <div class="mt-3 text-[#4A3B2A] font-medium">Rp {{ number_format($menuDay->foodInMenuDay->foodPrice, 0, ',', '.') }}</div>

                                    <!-- Add to Cart -->
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="food" value="{{ json_encode([
                                            'menuDayId' => $menuDay->id, 
                                            'foodName' => $menuDay->foodInMenuDay->foodName,
                                            'foodPrice' => $menuDay->foodInMenuDay->foodPrice,
                                            'foodImage' => $firstImage,
                                        ]) }}">
                                        <button type="submit"
                                            class="mt-3 w-30 bg-[#E5CBA6] text-white text-sm font-medium py-2 px-4 rounded-lg flex items-center justify-center gap-2 hover:bg-[#D9C4A5] transition">
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    
    <x-footer />
</x-layout>