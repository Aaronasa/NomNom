<x-layout>
    <body class="bg-gray-100 font-family-karla">
        <div class="flex min-h-screen">
            <!-- Fixed Sidebar -->
            <aside class="w-64 bg-white shadow-lg fixed inset-y-0 left-0 z-20 overflow-y-auto">
                <x-sidebar></x-sidebar>
            </aside>

            <!-- Main Content - With left margin to prevent overlap -->
            <div class="flex-1 flex flex-col ml-64">
                <!-- Sticky Header with Search and Create Button -->
                <header class="bg-white shadow-md sticky top-0 z-10 px-6 py-4">
                    <div class="max-w-7xl mx-auto flex justify-between items-center">
                        <h1 class="text-2xl font-bold text-gray-800">Restaurant Management</h1>
                        
                        <div class="flex items-center space-x-4">
                            <!-- Search Bar -->
                            <div class="relative">
                                <input type="text" id="searchRestaurant" placeholder="Search restaurants..." 
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-500 w-64">
                                <div class="absolute left-3 top-2.5 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Create Button - Scrolls to create form -->
                            <a href="#createRestaurantForm" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition-all transform hover:scale-105 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Create New Restaurant
                            </a>
                        </div>
                    </div>
                </header>

                <!-- Restaurant List Section -->
                <section class="p-6 md:p-10">
                    <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="bg-blue-50 px-6 py-4 border-b border-blue-100 flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-700">List of Restaurants</h2>
                                <p class="text-sm text-gray-500">Manage your restaurant partners</p>
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
                                        <th class="py-3 px-4 font-semibold text-left">Restaurant Name</th>
                                        <th class="py-3 px-4 font-semibold text-left">Address</th>
                                        <th class="py-3 px-4 font-semibold text-left">Phone</th>
                                        <th class="py-3 px-4 font-semibold text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse ($restaurants as $restaurant)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                            <td class="py-3 px-4 font-medium">{{ $restaurant->restaurantName }}</td>
                                            <td class="py-3 px-4 text-gray-500">{{ $restaurant->restaurantAddress }}</td>
                                            <td class="py-3 px-4">{{ $restaurant->restaurantPhone }}</td>
                                            <td class="py-3 px-4">
                                                <div class="flex justify-center gap-2">
                                                    <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" 
                                                        class="bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-600 transition flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('admin.restaurants.delete', $restaurant->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                            class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 transition flex items-center"
                                                            onclick="return confirm('Are you sure you want to delete this restaurant?')">
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
                                            <td colspan="5" class="py-8 text-center text-gray-500">
                                                <div class="flex flex-col items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                    </svg>
                                                    <p class="text-lg font-medium">No restaurants found</p>
                                                    <p class="text-sm">Get started by creating a new restaurant below</p>
                                                    <a href="#createRestaurantForm" class="mt-4 bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition">
                                                        Create Your First Restaurant
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination or show entries selector -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                            <div class="text-sm text-gray-500">
                                Showing <span class="font-medium">{{ count($restaurants) }}</span> entries
                            </div>
                            <!-- Pagination placeholder -->
                            <div>
                                <!-- You can add pagination here -->
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Create Restaurant Form Section -->
                <section id="createRestaurantForm" class="p-6 md:p-10 pt-0 scroll-mt-20">
                    <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="bg-green-50 px-6 py-4 border-b border-green-100">
                            <h2 class="text-lg font-semibold text-gray-700">Create New Restaurant</h2>
                            <p class="text-sm text-gray-500">Add a new restaurant partner to your platform</p>
                        </div>

                        <form action="{{ route('admin.restaurants.store') }}" method="POST" class="p-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Left Column -->
                                <div class="space-y-6">
                                    <div>
                                        <label for="restaurantName" class="block text-sm font-medium text-gray-700 mb-1">Restaurant Name</label>
                                        <input type="text" name="restaurantName" id="restaurantName" value="{{ old('restaurantName') }}" 
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 transition-colors" required>
                                        @error('restaurantName')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="restaurantAddress" class="block text-sm font-medium text-gray-700 mb-1">Restaurant Address</label>
                                        <textarea name="restaurantAddress" id="restaurantAddress" rows="3"
                                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 transition-colors">{{ old('restaurantAddress') }}</textarea>
                                        @error('restaurantAddress')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="space-y-6">
                                    <div>
                                        <label for="restaurantPhone" class="block text-sm font-medium text-gray-700 mb-1">Restaurant Phone</label>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">+</span>
                                            <input type="text" name="restaurantPhone" id="restaurantPhone" value="{{ old('restaurantPhone') }}" 
                                                   class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 transition-colors" required>
                                        </div>
                                        @error('restaurantPhone')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Optional additional fields could be added here -->
                                    <div>
                                        <label for="restaurantEmail" class="block text-sm font-medium text-gray-700 mb-1">Restaurant Email (Optional)</label>
                                        <input type="email" name="restaurantEmail" id="restaurantEmail" value="{{ old('restaurantEmail') }}" 
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 transition-colors">
                                        @error('restaurantEmail')
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
                                    Create Restaurant
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
            
            // Search functionality
            const searchInput = document.getElementById('searchRestaurant');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const restaurantName = row.cells[1]?.textContent.toLowerCase() || '';
                    const address = row.cells[2]?.textContent.toLowerCase() || '';
                    const phone = row.cells[3]?.textContent.toLowerCase() || '';
                    
                    if (restaurantName.includes(searchTerm) || address.includes(searchTerm) || phone.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Print functionality
            document.getElementById('printBtn').addEventListener('click', function() {
                window.print();
            });

            // Export functionality (basic example - would typically connect to backend)
            document.getElementById('exportBtn').addEventListener('click', function() {
                alert('Export functionality would be implemented here.');
                // In a real implementation, this would trigger a download of CSV/Excel file
            });
        </script>
    </body>
</x-layout>