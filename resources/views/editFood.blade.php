<x-layout>
    <body class="bg-gray-100 font-family-karla flex-container">

        <!-- Sidebar -->
        <x-sidebar></x-sidebar>

        <!-- Main Content -->
        <div class="main-content bg-white shadow-lg mx-10 p-6">
            <h1 class="text-2xl font-semibold mb-6">Edit Food</h1>

            <form action="{{ route('admin.foods.update', $food->id) }}" method="POST" class="bg-white p-6 shadow-lg rounded-lg" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="foodName" class="block text-sm font-medium text-gray-700">Food Name</label>
                    <input type="text" name="foodName" id="foodName" value="{{ old('foodName', $food->foodName) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    @error('foodName')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="foodDescription" class="block text-sm font-medium text-gray-700">Food Description</label>
                    <textarea name="foodDescription" id="foodDescription" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">{{ old('foodDescription', $food->foodDescription) }}</textarea>
                    @error('foodDescription')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="foodPrice" class="block text-sm font-medium text-gray-700">Food Price</label>
                    <input type="number" name="foodPrice" id="foodPrice" step="0.01" value="{{ old('foodPrice', $food->foodPrice) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    @error('foodPrice')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="currentImages" class="block text-sm font-medium text-gray-700">Current Images</label>
                    <div class="flex space-x-4 mt-2">
                        @foreach (explode(',', $food->foodImage) as $image)
                            <img src="{{ asset($image) }}" alt="Food Image" class="w-20 h-20 object-cover">
                        @endforeach
                    </div>
                </div>

                <div class="mb-4">
                    <label for="foodImage1" class="block text-sm font-medium text-gray-700">Update First Image (Optional)</label>
                    <input type="file" name="foodImage1" id="foodImage1" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" accept="image/*">
                    @error('foodImage1')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="foodImage2" class="block text-sm font-medium text-gray-700">Update Second Image (Optional)</label>
                    <input type="file" name="foodImage2" id="foodImage2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" accept="image/*">
                    @error('foodImage2')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="restaurant_id" class="block text-sm font-medium text-gray-700">Select Restaurant</label>
                    <select name="restaurant_id" id="restaurant_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="">-- Select a Restaurant --</option>
                        @foreach ($restaurants as $restaurant)
                            <option value="{{ $restaurant->id }}" {{ old('restaurant_id', $food->restaurant_id) == $restaurant->id ? 'selected' : '' }}>
                                {{ $restaurant->restaurantName }}
                            </option>
                        @endforeach
                    </select>
                    @error('restaurant_id')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Update Food</button>
            </form>
        </div>

    </body>
</x-layout>
