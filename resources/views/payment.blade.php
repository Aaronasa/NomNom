<x-layout>
    <x-navigation />

    <div class="bg-[#FFF9EC] min-h-screen p-6 text-[#3B2F22]">

        <!-- Header -->
        <div class="flex items-center space-x-3 mb-6">
            <a href="#" class="text-2xl">&larr;</a>
            <h1 class="text-xl font-bold">Burger Bangor, Kozko</h1>
        </div>

        <!-- Delivery Section -->
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <div class="flex items-center mb-4">
                <span class="mr-2">🚚</span>
                <p class="font-medium">Delivery <span class="text-sm text-gray-500">in 60 mins</span></p>
            </div>
            <input type="text" placeholder="📍 Enter Your Location"
                class="border px-4 py-2 rounded-full w-full mb-3" />
            <button class="bg-[#D7C5A9] text-white px-4 py-2 rounded-full mb-4">Edit Map</button>

            <div class="mb-4">
                <img src="{{ asset('images/map.png') }}" alt="Map" class="rounded-xl w-full h-64 object-cover" />
            </div>

            <div class="mb-2">
                <label class="block text-sm font-medium">Address Detail</label>
                <p class="text-sm text-gray-600">Universitas Ciputra Surabaya, Made, Surabaya, East Java, Indonesia</p>
            </div>

            <div class="mb-2">
                <label class="block text-sm font-medium">Location Detail (optional)</label>
                <input type="text" class="border px-3 py-2 rounded w-full"
                    placeholder="Flat/Unit number, Floor number" />
            </div>

            <div>
                <label class="block text-sm font-medium">Delivery Notes</label>
                <input type="text" placeholder="e.g. Please leave food at the door/gate"
                    class="border px-3 py-2 rounded w-full" />
            </div>
        </div>

        <!-- Selected Items -->
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h2 class="font-bold mb-4">Your Selected Items</h2>
            <div class="flex justify-between items-center">
                <div>
                    <p class="font-semibold">CheeseBurger</p>
                    <p class="text-sm text-gray-500">No Lettuce</p>
                    <p class="text-sm font-bold mt-1">Rp. 100.000</p>
                </div>
                <div class="flex items-center space-x-2">
                    <button class="bg-gray-200 px-2 rounded">−</button>
                    <span>1</span>
                    <button class="bg-gray-200 px-2 rounded">+</button>
                </div>
                <img src="{{ asset('images/burger.png') }}" alt="Burger" class="w-16 h-16 rounded-xl object-cover" />
            </div>
            <button class="mt-4 text-sm text-blue-600 underline">Edit</button>

            <div class="mt-6">
                <p class="text-sm text-gray-500 mb-2">Need anything else?</p>
                <button class="border px-4 py-2 rounded-full text-sm">+ Add More</button>
            </div>
        </div>

        <!-- Payment Summary -->
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h2 class="font-bold mb-4">Payment Summary</h2>
            <div class="flex justify-between text-sm mb-1">
                <span>Price</span>
                <span>Rp. 100.000</span>
            </div>
            <div class="flex justify-between text-sm mb-1">
                <span>Delivery Fee</span>
                <span>Rp. 10.000</span>
            </div>
            <div class="flex justify-between text-sm mb-3">
                <span>Admin</span>
                <span>Rp. 4.000</span>
            </div>
            <div class="flex justify-between font-bold text-lg border-t pt-3">
                <span>Total Payment</span>
                <span>Rp. 114.000</span>
            </div>
        </div>

        <!-- QR Section -->
        {{-- <div class="flex items-center justify-between bg-white px-6 py-4 shadow rounded-xl">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/qris.png') }}" alt="QRIS" class="w-16" />
                <p class="font-bold text-lg">Rp. 114.000</p>
            </div>
            <button class="bg-[#D7C5A9] text-white px-4 py-2 rounded-full">Show QR</button>
        </div>
        <div class="cart-footer">
            <form action="{{ route('cart.finish') }}" method="POST">
                @csrf
                <button type="submit" class="checkout-btn">Check-out</button>
            </form>
        </div> --}}

    </div>

    <x-footer />
</x-layout>
