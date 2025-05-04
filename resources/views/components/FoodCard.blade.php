<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 p-6">
    @foreach ($menuday as $MenuDays)
        <div class="bg-white rounded-xl shadow-lg transform transition hover:-translate-y-2 hover:shadow-2xl flex flex-col h-full">
            <!-- Image -->
            @php
                $image = explode(',', $MenuDays->foodInMenuDay->foodImage)[0];
            @endphp
            <img src="{{ asset($image) }}" alt="{{ $MenuDays->foodInMenuDay->foodName }}" 
                class="w-full h-52 object-cover rounded-t-xl">

            <!-- Card Content -->
            <div class="p-6 flex-grow flex flex-col">
                <!-- Title and Description -->
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">
                    {{ $MenuDays->foodInMenuDay->foodName }}
                </h3>

                <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                    {{ $MenuDays->foodInMenuDay->foodDescription }}
                </p>

                <!-- Price and Restaurant Information -->
                <div class="flex flex-col text-gray-700 text-sm mb-4">
                    <span class="mb-2"><strong>Price:</strong> Rp {{ number_format($MenuDays->foodInMenuDay->foodPrice, 0, ',', '.') }}</span>
                    <span><strong>Restaurant:</strong> {{ $MenuDays->foodInMenuDay->restaurantInFood->restaurantName }}</span>
                    <p class="mt-2 text-gray-500 text-sm">
                        <strong>Available on:</strong> {{ $MenuDays->foodDate }}
                    </p>    
                </div>

                <!-- Button (Ensures it's always at the bottom) -->
                <div class=" mt-auto">
                    <a href="{{ route('food.detail', ['id' => $MenuDays->id]) }}" 
                        class="block w-full text-gray-900 py-3 px-6 rounded-lg text-center hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-600 transition duration-300 ease-in-out transform hover:scale-105 border border-gray-500">
                        See Details
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="my-4 mx-8">
    {{ $menuday->links() }}
</div>
