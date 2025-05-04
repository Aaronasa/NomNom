<x-layout>
    <body class="bg-gray-100 font-family-karla flex-container">

        <!-- Sidebar -->
        <x-sidebar></x-sidebar>

        <!-- Konten Utama -->
        <div class="main-content bg-white shadow-lg mx-10 p-6">
            <h1 class="text-2xl font-semibold mb-6">List of Restaurants</h1>
        

            <table class="min-w-full table-auto bg-white border border-gray-300 shadow-lg rounded-lg mt-4">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left border-b">ID</th>
                        <th class="py-2 px-4 text-left border-b">Restaurant Name</th>
                        <th class="py-2 px-4 text-left border-b">Address</th>
                        <th class="py-2 px-4 text-left border-b">Phone</th>
                        <th class="py-2 px-4 text-left border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($restaurants as $restaurant)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border-b">{{ $restaurant->restaurantName }}</td>
                            <td class="py-2 px-4 border-b">{{ $restaurant->restaurantAddress }}</td>
                            <td class="py-2 px-4 border-b">{{ $restaurant->restaurantPhone }}</td>
                            <td class="py-2 px-4 border-b flex flex-col items-center space-y-2">
                                <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-600 transition">Update</a>
                                <form action="{{ route('admin.restaurants.delete', $restaurant->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center border-b">No restaurants found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Form Pembuatan Restoran -->
        <div id="createRestaurantForm" class="main-content bg-white shadow-lg mx-10 mt-0 p-6">
            <h1 class="text-2xl font-semibold mb-6">Create New Restaurant</h1>

            <form action="{{ route('admin.restaurants.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="restaurantName" class="block text-sm font-medium text-gray-700 mb-1">Restaurant Name</label>
                    <input type="text" name="restaurantName" id="restaurantName" value="{{ old('restaurantName') }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required>
                    @error('restaurantName')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="restaurantAddress" class="block text-sm font-medium text-gray-700 mb-1">Restaurant Address</label>
                    <input type="text" name="restaurantAddress" id="restaurantAddress" value="{{ old('restaurantAddress') }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required>
                    @error('restaurantAddress')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="restaurantPhone" class="block text-sm font-medium text-gray-700 mb-1">Restaurant Phone</label>
                    <input type="text" name="restaurantPhone" id="restaurantPhone" value="{{ old('restaurantPhone') }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required>
                    @error('restaurantPhone')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition">Create Restaurant</button>
            </form>
        </div>

    </body>
</x-layout>