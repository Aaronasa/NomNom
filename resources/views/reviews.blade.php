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

            @foreach ($orderDetails as $item)
                @php
                    $menuDay = $item->menuDayInOrderDetail;
                    $food = $menuDay ? $menuDay->foodInMenuDay : null;
                    $review = $item->review;
                @endphp

                <div class="bg-white rounded shadow p-4 mb-4">
                    <div class="flex items-center gap-4">
                        @if ($food && $food->foodImage)
                            @php $foodImage = explode(',', $food->foodImage)[0] ?? null; @endphp
                            <img src="{{ asset($foodImage) }}" alt="Image" class="w-16 h-16 object-cover rounded">
                        @else
                            <div class="w-16 h-16 bg-gray-200 flex items-center justify-center text-sm text-gray-500">
                                No Image
                            </div>
                        @endif

                        <div class="flex-1">
                            <h2 class="font-semibold text-lg">{{ $food->foodName ?? 'Unknown Food' }}</h2>
                            <p class="text-sm text-gray-600">
                                Price: Rp. {{ number_format($item->price, 0, ',', '.') }} |
                                Qty: {{ $item->unit }}
                            </p>

                            @if ($review)
                                <div class="flex items-center mt-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                        </svg>
                                    @endfor
                                </div>
                                <p class="text-gray-600 italic mt-1">"{{ $review->comment }}"</p>
                            @else
                                <a href="{{ route('reviews.add', $item->id) }}"
                                   class="inline-block mt-2 text-sm bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                    Add Review
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($orderDetails->isEmpty())
                <p class="text-center text-gray-500">No reviewed items found.</p>
            @endif
        </div>
    </section>

    <x-footer />
</x-layout>