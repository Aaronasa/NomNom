<x-layout>
    <body class="bg-gray-100 font-family-karla">
        <div class="flex min-h-screen">

            <!-- Main Content - With left margin to prevent overlap -->
            <div class="flex-1 flex flex-col ml-64">
                <!-- Sticky Header with Search and Create Button -->
                <header class="bg-white shadow-md sticky top-0 z-10 px-6 py-4">
                    <div class="max-w-7xl mx-auto flex justify-between items-center">
                        <h1 class="text-2xl font-bold text-gray-800">Menu Management</h1>
                        
                        <div class="flex items-center space-x-4">
                            <!-- Search Bar -->
                            <div class="relative">
                                <input type="text" id="searchFood" placeholder="Search foods..." 
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-500 w-64">
                                <div class="absolute left-3 top-2.5 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Create Button - Scrolls to create form -->
                            <a href="#createFoodForm" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition-all transform hover:scale-105 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Create New Menu
                            </a>
                        </div>
                    </div>
                </header>

                <!-- Food List Section -->
                <section class="p-6 md:p-10">
                    <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="bg-blue-50 px-6 py-4 border-b border-blue-100 flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-700">Your Menu Items</h2>
                                <p class="text-sm text-gray-500">Manage your restaurant's available foods</p>
                            </div>
                            <div class="flex space-x-2">
                                <button id="exportBtn" class="bg-gray-100 text-gray-700 py-1 px-3 rounded-md hover:bg-gray-200 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Export
                                </button>
                                <button id="printBtn" class="bg-gray-100 text-gray-700 py-1 px-3 rounded-md hover:bg-gray-200 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                    </svg>
                                    Print
                                </button>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-50 text-gray-600 uppercase text-xs border-b">
                                        <th class="py-3 px-4 font-semibold text-left">ID</th>
                                        <th class="py-3 px-4 font-semibold text-left">Food Name</th>
                                        <th class="py-3 px-4 font-semibold text-left">Description</th>
                                        <th class="py-3 px-4 font-semibold text-left">Price</th>
                                        <th class="py-3 px-4 font-semibold text-left">Available Date</th>
                                        <th class="py-3 px-4 font-semibold text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse ($products as $product)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                            <td class="py-3 px-4 font-medium">{{ $product->foodName }}</td>
                                            <td class="py-3 px-4 text-gray-500 max-w-xs truncate">{{ $product->foodDescription }}</td>
                                            <td class="py-3 px-4 font-medium">Rp{{ number_format($product->foodPrice, 2) }}</td>
                                            <td class="py-3 px-4">
                                                @php
                                                    $menuDay = \App\Models\MenuDay::where('food_id', $product->id)->first();
                                                @endphp
                                                @if($menuDay)
                                                    <span class="px-2 py-1 bg-green-50 text-green-700 rounded-full text-xs">
                                                        {{ \Carbon\Carbon::parse($menuDay->foodDate)->format('d M Y') }}
                                                    </span>
                                                @else
                                                    <span class="px-2 py-1 bg-gray-50 text-gray-700 rounded-full text-xs">
                                                        Not Scheduled
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-3 px-4">
                                                <div class="flex justify-center gap-2">
                                                    <a href="{{ route('vendor.products.edit', $product->id) }}" 
                                                        class="bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-600 transition flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('vendor.products.destroy', $product->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                            class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 transition flex items-center"
                                                            onclick="return confirm('Are you sure you want to delete this food item?')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="py-8 text-center text-gray-500">
                                                <div class="flex flex-col items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                                    </svg>
                                                    <p class="text-lg font-medium">No foods found</p>
                                                    <p class="text-sm">Get started by creating a new menu item below</p>
                                                    <a href="#createFoodForm" class="mt-4 bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition">
                                                        Create Your First Menu
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                            <div class="text-sm text-gray-500">
                                Showing <span class="font-medium">{{ count($products) }}</span> entries
                            </div>
                            <div>
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Create Food Form Section -->
                <section id="createFoodForm" class="p-6 md:p-10 pt-0 scroll-mt-20">
                    <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="bg-green-50 px-6 py-4 border-b border-green-100">
                            <h2 class="text-lg font-semibold text-gray-700">Create New Food Item</h2>
                            <p class="text-sm text-gray-500">Add a new menu item to your restaurant</p>
                        </div>

                        <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Left Column -->
                                <div class="space-y-6">
                                    <div>
                                        <label for="foodName" class="block text-sm font-medium text-gray-700 mb-1">Food Name</label>
                                        <input type="text" name="foodName" id="foodName" value="{{ old('foodName') }}" 
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 transition-colors" required>
                                        @error('foodName')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="foodPrice" class="block text-sm font-medium text-gray-700 mb-1">Food Price</label>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Rp</span>
                                            <input type="number" name="foodPrice" id="foodPrice" step="0.01" value="{{ old('foodPrice') }}" 
                                                   class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 transition-colors" required>
                                        </div>
                                        @error('foodPrice')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="foodDate" class="block text-sm font-medium text-gray-700 mb-1">Available Date</label>
                                        <input type="date" name="foodDate" id="foodDate" value="{{ old('foodDate') }}" 
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 transition-colors">
                                        <p class="text-xs text-gray-500 mt-1">Leave empty if this item is always available</p>
                                        @error('foodDate')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="space-y-6">
                                    <div>
                                        <label for="foodDescription" class="block text-sm font-medium text-gray-700 mb-1">Food Description</label>
                                        <textarea name="foodDescription" id="foodDescription" rows="5"
                                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 transition-colors">{{ old('foodDescription') }}</textarea>
                                        @error('foodDescription')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="foodImages" class="block text-sm font-medium text-gray-700 mb-1">Food Images (Max 2)</label>
                                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-green-500 transition-colors">
                                            <input type="file" name="foodImages[]" id="foodImages" multiple class="hidden" accept="image/*" onchange="previewMultipleImages(this)">
                                            <label for="foodImages" class="cursor-pointer">
                                                <div id="previewImagesContainer" class="mx-auto w-full h-32 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <span class="mt-2 block text-sm font-medium text-green-500">Choose images or drag and drop (Max 2)</span>
                                            </label>
                                        </div>
                                        <div id="imagePreviewGallery" class="mt-2 flex flex-wrap gap-2"></div>
                                        @error('foodImages')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                        @error('foodImages.*')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <button type="submit" class="bg-green-500 text-white py-2 px-6 rounded-md hover:bg-green-600 transition-all transform hover:scale-105 focus:ring-2 focus:ring-green-300 focus:outline-none flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Create Food Item
                                </button>
                            </div>
                        </form>
                    </div>
                </section>

                <!-- Back to Top Button -->
                <button id="backToTopBtn" class="fixed bottom-8 right-8 bg-blue-500 text-white p-3 rounded-full shadow-lg hover:bg-blue-600 transition-colors opacity-0 invisible">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                    </svg>
                </button>
            </div>
        </div>

        <script>
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80, // Adjust for header height
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Back to top button
            const backToTopBtn = document.getElementById('backToTopBtn');
            
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    backToTopBtn.classList.remove('opacity-0', 'invisible');
                    backToTopBtn.classList.add('opacity-100', 'visible');
                } else {
                    backToTopBtn.classList.add('opacity-0', 'invisible');
                    backToTopBtn.classList.remove('opacity-100', 'visible');
                }
            });
            
            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Preview multiple images
            function previewMultipleImages(input) {
                const previewContainer = document.getElementById('previewImagesContainer');
                const previewGallery = document.getElementById('imagePreviewGallery');
                
                // Clear previews
                previewGallery.innerHTML = '';
                
                if (input.files && input.files.length > 0) {
                    previewContainer.innerHTML = '';
                    
                    // Limit to 2 images
                    const maxImages = Math.min(input.files.length, 2);
                    
                    for (let i = 0; i < maxImages; i++) {
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const imgContainer = document.createElement('div');
                            imgContainer.className = 'relative';
                            
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'h-20 w-20 object-cover rounded-lg';
                            
                            imgContainer.appendChild(img);
                            previewGallery.appendChild(imgContainer);
                        }
                        
                        reader.readAsDataURL(input.files[i]);
                    }
                } else {
                    previewContainer.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    `;
                }
            }
            
            // Search functionality
            const searchInput = document.getElementById('searchFood');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const foodName = row.cells[1]?.textContent.toLowerCase() || '';
                    const description = row.cells[2]?.textContent.toLowerCase() || '';
                    
                    if (foodName.includes(searchTerm) || description.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        </script>
    </body>
</x-layout>