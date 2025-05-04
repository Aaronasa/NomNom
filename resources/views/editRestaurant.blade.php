<x-layout>
    <body class="bg-gray-100 font-family-karla flex-container">

        <!-- Sidebar -->
        <x-sidebar></x-sidebar>

        <!-- Konten Utama -->
        <div class="main-content bg-white shadow-lg mx-10 p-6">
            <h1 class="text-2xl font-semibold mb-6">Edit Restaurant</h1>

            <form action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="POST" class="bg-white p-6 shadow-lg rounded-lg">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="restaurantName" class="block text-sm font-medium text-gray-700">Restaurant Name</label>
                    <input type="text" name="restaurantName" id="restaurantName" value="{{ old('restaurantName', $restaurant->restaurantName) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    @error('restaurantName')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="restaurantAddress" class="block text-sm font-medium text-gray-700">Restaurant Address</label>
                    <input type="text" name="restaurantAddress" id="restaurantAddress" value="{{ old('restaurantAddress', $restaurant->restaurantAddress) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    @error('restaurantAddress')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="restaurantPhone" class="block text-sm font-medium text-gray-700">Restaurant Phone</label>
                    <input type="text" name="restaurantPhone" id="restaurantPhone" value="{{ old('restaurantPhone', $restaurant->restaurantPhone) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    @error('restaurantPhone')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Update Restaurant</button>
            </form>
        </div>

    </body>
</x-layout>
