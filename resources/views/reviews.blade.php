<x-layout>
    <x-navigation />

    <section class="bg-[#FFF8E6] min-h-screen py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-semibold mb-6 text-[#3F2812]">My Reviews</h1>

            @if (session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Debug information (remove in production) -->
            @if(config('app.debug'))
                <div class="bg-blue-100 text-blue-700 px-4 py-2 rounded mb-4">
                    <strong>Debug Info:</strong> Found {{ $orderDetails->count() }} order details
                </div>
            @endif

            @forelse ($orderDetails as $item)
                @php
                    $menuDay = $item->menuDayInOrderDetail;
                    $food = $menuDay ? $menuDay->foodInMenuDay : null;
                    $review = $item->review;
                    $order = $item->orderInOrderDetail;
                @endphp

                <div class="bg-white rounded shadow p-4 mb-4">
                
                    <div class="flex items-center gap-4">
                        @if ($food && $food->foodImage)
                            @php 
                                $foodImages = explode(',', $food->foodImage);
                                $foodImage = trim($foodImages[0] ?? '');
                            @endphp
                            @if($foodImage)
                                <img src="{{ asset($foodImage) }}" alt="{{ $food->foodName ?? 'Food Image' }}" 
                                     class="w-16 h-16 object-cover rounded" 
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-16 h-16 bg-gray-200 flex items-center justify-center text-sm text-gray-500" style="display: none;">
                                    No Image
                                </div>
                            @else
                                <div class="w-16 h-16 bg-gray-200 flex items-center justify-center text-sm text-gray-500">
                                    No Image
                                </div>
                            @endif
                        @else
                            <div class="w-16 h-16 bg-gray-200 flex items-center justify-center text-sm text-gray-500">
                                No Image
                            </div>
                        @endif

                        <div class="flex-1">
                            <h2 class="font-semibold text-lg">
                                {{ $food->foodName ?? 'Unknown Food' }}
                            </h2>
                            <p class="text-sm text-gray-600">
                                Price: Rp. {{ number_format($item->price ?? 0, 0, ',', '.') }} |
                                Qty: {{ $item->unit ?? 0 }}
                            </p>
                            
                            <!-- Show order date -->
                            @if($order)
                                <p class="text-xs text-gray-400">
                                    Ordered: {{ $order->created_at->format('d M Y, H:i') }}
                                </p>
                            @endif

                            @if ($review)
                                <div class="flex items-center mt-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                        </svg>
                                    @endfor
                                </div>
                                <p class="text-gray-600 italic mt-1">"{{ $review->comment ?? 'No comment' }}"</p>
                            @else
                                <a href="{{ route('reviews.add', $item->id) }}"
                                   class="inline-block mt-2 text-sm bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                    Add Review
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded shadow p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No orders found</h3>
                    <p class="text-gray-500 mb-4">You haven't completed any orders yet, or your orders are still being processed.</p>
                    <a href="{{ route('home') }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                        Start Ordering
                    </a>
                </div>
            @endforelse
        </div>
    </section>

    <x-footer />
</x-layout>