<x-layout>
    <body class="bg-gray-100 font-family-karla flex-container">

        <!-- Sidebar -->
        <x-sidebar></x-sidebar>

        <!-- Main Content -->
        <div class="main-content bg-white shadow-lg mx-10 p-6">
            <h1 class="text-2xl font-semibold mb-6">List of Foods</h1>

            <table class="min-w-full table-auto bg-white border border-gray-300 shadow-lg rounded-lg mt-4">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left border-b">ID</th>
                        <th class="py-2 px-4 text-left border-b">Food Name</th>
                        <th class="py-2 px-4 text-left border-b">Description</th>
                        <th class="py-2 px-4 text-left border-b">Price</th>
                        <th class="py-2 px-4 text-left border-b">Restaurant</th>
                        <th class="py-2 px-4 text-left border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($foods as $food)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border-b">{{ $food->foodName }}</td>
                            <td class="py-2 px-4 border-b">{{ $food->foodDescription }}</td>
                            <td class="py-2 px-4 border-b">Rp{{ number_format($food->foodPrice, 2) }}</td>
                            <td class="py-2 px-4 border-b ">{{ $food->restaurantInFood->restaurantName }}</td>
                            <td class="py-2 px-4 border-b flex flex-col items-center gap-4">
                                <a href="{{ route('admin.foods.edit', $food->id) }}" class="bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-600 transition">Update</a>
                                <form action="{{ route('admin.foods.delete', $food->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center border-b">No foods found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Create Food Form -->
        <div id="createFoodForm" class="main-content bg-white shadow-lg mx-10 mt-0 p-6">
            <h1 class="text-2xl font-semibold mb-6">Create New Food</h1>

            <form action="{{ route('admin.foods.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="foodDate" class="block text-sm font-medium text-gray-700 mb-1">Food Date (Optional)</label>
                    <input type="date" name="foodDate" id="foodDate" value="{{ old('foodDate') }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
                    @error('foodDate')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <label for="foodName" class="block text-sm font-medium text-gray-700 mb-1">Food Name</label>
                    <input type="text" name="foodName" id="foodName" value="{{ old('foodName') }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required>
                    @error('foodName')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="foodDescription" class="block text-sm font-medium text-gray-700 mb-1">Food Description</label>
                    <textarea name="foodDescription" id="foodDescription" class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">{{ old('foodDescription') }}</textarea>
                    @error('foodDescription')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="foodPrice" class="block text-sm font-medium text-gray-700 mb-1">Food Price</label>
                    <input type="number" name="foodPrice" id="foodPrice" step="0.01" value="{{ old('foodPrice') }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required>
                    @error('foodPrice')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="foodImages" class="block text-sm font-medium text-gray-700 mb-1">Food Images (Max 2)</label>
                    <input type="file" name="foodImages[]" id="foodImages" multiple class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" accept="image/*">
                    @error('foodImages')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    @error('foodImages.*')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <label for="restaurant_id" class="block text-sm font-medium text-gray-700 mb-1">Select Restaurant</label>
                    <select name="restaurant_id" id="restaurant_id" class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="">-- Select a Restaurant --</option>
                        @foreach ($restaurants as $restaurant)
                            <option value="{{ $restaurant->id }}" {{ isset($food) && $food->restaurant_id == $restaurant->id ? 'selected' : '' }}>
                                {{ $restaurant->restaurantName }}
                            </option>
                        @endforeach
                    </select>
                    @error('restaurant_id')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                

                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition">Create Food</button>
            </form>
        </div>

    </body>
</x-layout>
