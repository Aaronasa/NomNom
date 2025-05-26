<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Food Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<x-layout>

    <body class="bg-gray-100">
        <div class="flex min-h-screen">
            <!-- Fixed Sidebar -->
            <aside class="w-64 bg-white shadow-lg fixed inset-y-0 left-0 z-20 overflow-y-auto">
                <div class="h-full flex flex-col bg-gray-800 text-white">
                    <!-- Logo -->
                    <div class="p-4 border-b border-gray-700 flex items-center justify-center gradient-bg">
                        <h1 class="text-xl font-bold">Vendor Dashboard</h1>
                    </div>

                    <!-- Navigation -->
                    <nav class="flex-1 overflow-y-auto py-4">
                        <ul class="space-y-1">
                            <li>
                                <a href="#"
                                    class="flex items-center px-4 py-3 hover:bg-gray-700 rounded-lg mx-2 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center px-4 py-3 bg-blue-600 rounded-lg mx-2 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Menu Items
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center px-4 py-3 hover:bg-gray-700 rounded-lg mx-2 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    Orders
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center px-4 py-3 hover:bg-gray-700 rounded-lg mx-2 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    Restaurant
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center px-4 py-3 hover:bg-gray-700 rounded-lg mx-2 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profile
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <!-- User Profile -->
                    <div class="p-4 border-t border-gray-700">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold">
                                V
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium">Vendor User</p>
                                <p class="text-xs text-gray-400">vendor@example.com</p>
                            </div>
                        </div>
                        <a href="#"
                            class="mt-4 flex items-center text-sm text-gray-400 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </a>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col ml-64">
                <!-- Header -->
                <header class="bg-white shadow-md sticky top-0 z-10 px-6 py-4">
                    <div class="max-w-7xl mx-auto flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Menu Management</h1>
                            <p class="text-sm text-gray-600" id="restaurantName">Demo Restaurant</p>
                        </div>

                        <div class="flex items-center space-x-4">
                            <!-- Search Bar -->
                            <div class="relative">
                                <input type="text" id="searchFood" placeholder="Search menu items..."
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-500 w-64">
                                <div class="absolute left-3 top-2.5 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Create Button -->
                            <a href="#createFoodForm"
                                class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition-all transform hover:scale-105 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add New Item
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
                                <p class="text-sm text-gray-500">Manage your restaurant's menu</p>
                            </div>
                            <div class="flex space-x-2">
                                <button id="exportBtn"
                                    class="bg-gray-100 text-gray-700 py-1 px-3 rounded-md hover:bg-gray-200 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Export
                                </button>
                                <button id="printBtn"
                                    class="bg-gray-100 text-gray-700 py-1 px-3 rounded-md hover:bg-gray-200 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
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
                                        <th class="py-3 px-4 font-semibold text-left">Image</th>
                                        <th class="py-3 px-4 font-semibold text-left">Food Name</th>
                                        <th class="py-3 px-4 font-semibold text-left">Description</th>
                                        <th class="py-3 px-4 font-semibold text-left">Price</th>
                                        <th class="py-3 px-4 font-semibold text-left">Menu Date</th>
                                        <th class="py-3 px-4 font-semibold text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100" id="foodTableBody">
                                    <!-- Dynamic content populated by JavaScript -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Footer -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                            <div class="text-sm text-gray-500">
                                Showing <span class="font-medium" id="entriesCount">0</span> entries
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Create Food Form Section -->
                <section id="createFoodForm" class="p-6 md:p-10 pt-0 scroll-mt-20">
                    <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="bg-green-50 px-6 py-4 border-b border-green-100">
                            <h2 class="text-lg font-semibold text-gray-700">Add New Menu Item</h2>
                            <p class="text-sm text-gray-500">Create a new item for your restaurant menu</p>
                        </div>

                        <form id="foodForm" class="p-6" enctype="multipart/form-data">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Left Column -->
                                <div class="space-y-6">
                                    <div>
                                        <label for="foodName"
                                            class="block text-sm font-medium text-gray-700 mb-1">Food
                                            Name *</label>
                                        <input type="text" name="foodName" id="foodName" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 transition-colors">
                                        <div class="text-red-500 text-sm mt-1 hidden" id="foodNameError"></div>
                                    </div>

                                    <div>
                                        <label for="foodPrice"
                                            class="block text-sm font-medium text-gray-700 mb-1">Food
                                            Price *</label>
                                        <div class="relative">
                                            <span
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Rp</span>
                                            <input type="number" name="foodPrice" id="foodPrice" step="0.01"
                                                min="0" required
                                                class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 transition-colors">
                                        </div>
                                        <div class="text-red-500 text-sm mt-1 hidden" id="foodPriceError"></div>
                                    </div>

                                    <div>
                                        <label for="foodDate"
                                            class="block text-sm font-medium text-gray-700 mb-1">Menu
                                            Date (Optional)</label>
                                        <input type="date" name="foodDate" id="foodDate"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 transition-colors">
                                        <p class="text-xs text-gray-500 mt-1">Leave empty for permanent menu item</p>
                                        <div class="text-red-500 text-sm mt-1 hidden" id="foodDateError"></div>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="space-y-6">
                                    <div>
                                        <label for="foodDescription"
                                            class="block text-sm font-medium text-gray-700 mb-1">Food
                                            Description</label>
                                        <textarea name="foodDescription" id="foodDescription" rows="5"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 transition-colors"
                                            placeholder="Describe your food item..."></textarea>
                                        <div class="text-red-500 text-sm mt-1 hidden" id="foodDescriptionError"></div>
                                    </div>

                                    <div>
                                        <label for="foodImages"
                                            class="block text-sm font-medium text-gray-700 mb-1">Food
                                            Images (Max 2)</label>
                                        <div
                                            class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-green-500 transition-colors">
                                            <input type="file" name="foodImages[]" id="foodImages" multiple
                                                class="hidden" accept="image/*">
                                            <label for="foodImages" class="cursor-pointer">
                                                <div id="previewImagesContainer"
                                                    class="mx-auto w-full h-32 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-12 w-12 text-gray-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <span class="mt-2 block text-sm font-medium text-green-500">Choose
                                                    images
                                                    or drag and drop (Max 2)</span>
                                            </label>
                                        </div>
                                        <div id="imagePreviewGallery" class="mt-2 flex flex-wrap gap-2"></div>
                                        <div class="text-red-500 text-sm mt-1 hidden" id="foodImagesError"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end space-x-3">
                                <button type="button" onclick="resetForm()"
                                    class="bg-gray-500 text-white py-2 px-6 rounded-md hover:bg-gray-600 transition-colors">
                                    Reset Form
                                </button>
                                <button type="submit"
                                    class="bg-green-500 text-white py-2 px-6 rounded-md hover:bg-green-600 transition-all transform hover:scale-105 focus:ring-2 focus:ring-green-300 focus:outline-none flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    <span id="submitButtonText">Add Menu Item</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </section>

                <!-- Edit Modal -->
                <div id="editModal"
                    class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                    <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Edit Menu Item</h3>
                            <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form id="editFoodForm">
                            <input type="hidden" id="editFoodId">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="editFoodName"
                                        class="block text-sm font-medium text-gray-700 mb-1">Food
                                        Name *</label>
                                    <input type="text" id="editFoodName" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="editFoodPrice"
                                        class="block text-sm font-medium text-gray-700 mb-1">Price
                                        *</label>
                                    <div class="relative">
                                        <span
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Rp</span>
                                        <input type="number" id="editFoodPrice" step="0.01" min="0"
                                            required
                                            class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 focus:border-blue-500">
                                    </div>
                                </div>
                                <div>
                                    <label for="editFoodDate"
                                        class="block text-sm font-medium text-gray-700 mb-1">Menu
                                        Date</label>
                                    <input type="date" id="editFoodDate"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="editFoodDescription"
                                        class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea id="editFoodDescription" rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 focus:border-blue-500"></textarea>
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end space-x-3">
                                <button type="button" onclick="closeEditModal()"
                                    class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600 transition-colors">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors">
                                    Update Item
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                <div id="deleteModal"
                    class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                    <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
                        <div class="flex items-center mb-4">
                            <div
                                class="flex-shrink-0 w-10 h-10 mx-auto bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                    width="24" height="24" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Delete Menu Item</h3>
                            <p class="text-sm text-gray-500 mb-6">Are you sure you want to delete this menu item? This
                                action cannot be undone.</p>
                        </div>
                        <div class="flex justify-center space-x-3">
                            <button onclick="closeDeleteModal()"
                                class="bg-gray-300 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-400 transition-colors">
                                Cancel
                            </button>
                            <button onclick="confirmDelete()"
                                class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 transition-colors">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Success Toast -->
                <div id="successToast"
                    class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform z-50">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span id="toastMessage">Success!</span>
                    </div>
                </div>

                <!-- Error Toast -->
                <div id="errorToast"
                    class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform z-50">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span id="errorMessage">Error!</span>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Sample data - In real implementation, this would come from server
            let menuItems = [{
                    id: 1,
                    name: 'Margherita Pizza',
                    description: 'Classic pizza with tomato sauce, mozzarella, and fresh basil',
                    price: 85000,
                    image: 'https://via.placeholder.com/50x50/4F46E5/ffffff?text=🍕',
                    menuDate: '2024-12-25'
                },
                {
                    id: 2,
                    name: 'Classic Burger',
                    description: 'Juicy beef patty with lettuce, tomato, and cheese',
                    price: 65000,
                    image: 'https://via.placeholder.com/50x50/10B981/ffffff?text=🍔',
                    menuDate: null
                },
                {
                    id: 3,
                    name: 'Chicken Satay',
                    description: 'Grilled chicken skewers with peanut sauce',
                    price: 45000,
                    image: 'https://via.placeholder.com/50x50/F59E0B/ffffff?text=🍢',
                    menuDate: '2024-12-26'
                }
            ];

            let currentEditId = null;
            let currentDeleteId = null;

            // Initialize the application
            document.addEventListener('DOMContentLoaded', function() {
                renderMenuItems();
                setupEventListeners();
                setMinDate();
            });

            // Set minimum date to today
            function setMinDate() {
                const today = new Date().toISOString().split('T')[0];
                document.getElementById('foodDate').min = today;
                document.getElementById('editFoodDate').min = today;
            }

            // Setup event listeners
            function setupEventListeners() {
                // Form submission
                document.getElementById('foodForm').addEventListener('submit', handleFormSubmit);

                // Edit form submission
                document.getElementById('editFoodForm').addEventListener('submit', handleEditSubmit);

                // Search functionality
                document.getElementById('searchFood').addEventListener('input', handleSearch);

                // File input change
                document.getElementById('foodImages').addEventListener('change', handleFileSelect);

                // Export and print buttons
                document.getElementById('exportBtn').addEventListener('click', exportData);
                document.getElementById('printBtn').addEventListener('click', printData);

                // Modal close on backdrop click
                document.getElementById('editModal').addEventListener('click', function(e) {
                    if (e.target === this) closeEditModal();
                });

                document.getElementById('deleteModal').addEventListener('click', function(e) {
                    if (e.target === this) closeDeleteModal();
                });
            }

            // Handle form submission
            function handleFormSubmit(e) {
                e.preventDefault();

                if (!validateForm()) {
                    return;
                }

                const formData = new FormData(e.target);
                const menuItem = {
                    id: Date.now(), // Simple ID generation
                    name: formData.get('foodName'),
                    description: formData.get('foodDescription') || '',
                    price: parseFloat(formData.get('foodPrice')),
                    menuDate: formData.get('foodDate') || null,
                    image: 'https://via.placeholder.com/50x50/4F46E5/ffffff?text=🍽️' // Default image
                };

                // Handle image upload (in real app, this would upload to server)
                const images = formData.getAll('foodImages[]');
                if (images.length > 0 && images[0].size > 0) {
                    // For demo purposes, we'll use a placeholder
                    menuItem.image = 'https://via.placeholder.com/50x50/10B981/ffffff?text=📷';
                }

                menuItems.push(menuItem);
                renderMenuItems();
                resetForm();
                showSuccessToast('Menu item added successfully!');

                // Scroll to top of the table
                document.querySelector('#foodTableBody').scrollIntoView({
                    behavior: 'smooth'
                });
            }

            // Handle edit form submission
            function handleEditSubmit(e) {
                e.preventDefault();

                const itemIndex = menuItems.findIndex(item => item.id === currentEditId);
                if (itemIndex === -1) return;

                menuItems[itemIndex] = {
                    ...menuItems[itemIndex],
                    name: document.getElementById('editFoodName').value,
                    description: document.getElementById('editFoodDescription').value,
                    price: parseFloat(document.getElementById('editFoodPrice').value),
                    menuDate: document.getElementById('editFoodDate').value || null
                };

                renderMenuItems();
                closeEditModal();
                showSuccessToast('Menu item updated successfully!');
            }

            // Validate form
            function validateForm() {
                let isValid = true;

                // Clear previous errors
                clearErrors();

                // Validate food name
                const foodName = document.getElementById('foodName').value.trim();
                if (!foodName) {
                    showError('foodNameError', 'Food name is required');
                    isValid = false;
                }

                // Validate price
                const foodPrice = parseFloat(document.getElementById('foodPrice').value);
                if (!foodPrice || foodPrice <= 0) {
                    showError('foodPriceError', 'Please enter a valid price');
                    isValid = false;
                }

                // Validate date (if provided)
                const foodDate = document.getElementById('foodDate').value;
                if (foodDate) {
                    const selectedDate = new Date(foodDate);
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);

                    if (selectedDate < today) {
                        showError('foodDateError', 'Menu date cannot be in the past');
                        isValid = false;
                    }
                }

                // Validate images
                const images = document.getElementById('foodImages').files;
                if (images.length > 2) {
                    showError('foodImagesError', 'Maximum 2 images allowed');
                    isValid = false;
                }

                for (let i = 0; i < images.length; i++) {
                    if (images[i].size > 2 * 1024 * 1024) { // 2MB limit
                        showError('foodImagesError', 'Image size should not exceed 2MB');
                        isValid = false;
                        break;
                    }
                }

                return isValid;
            }

            // Show error message
            function showError(elementId, message) {
                const errorElement = document.getElementById(elementId);
                errorElement.textContent = message;
                errorElement.classList.remove('hidden');
            }

            // Clear all error messages
            function clearErrors() {
                const errorElements = document.querySelectorAll('[id$="Error"]');
                errorElements.forEach(element => {
                    element.classList.add('hidden');
                    element.textContent = '';
                });
            }

            // Handle file selection
            function handleFileSelect(e) {
                const files = Array.from(e.target.files);
                const previewContainer = document.getElementById('imagePreviewGallery');

                // Clear previous previews
                previewContainer.innerHTML = '';

                if (files.length > 2) {
                    showError('foodImagesError', 'Maximum 2 images allowed');
                    e.target.value = '';
                    return;
                }

                files.forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const previewDiv = document.createElement('div');
                            previewDiv.className = 'relative';
                            previewDiv.innerHTML = `
                            <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-20 h-20 object-cover rounded-lg border border-gray-300">
                            <button type="button" onclick="removeImage(${index})" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                ×
                            </button>
                        `;
                            previewContainer.appendChild(previewDiv);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Remove image from preview
            function removeImage(index) {
                const fileInput = document.getElementById('foodImages');
                const dt = new DataTransfer();
                const files = Array.from(fileInput.files);

                files.forEach((file, i) => {
                    if (i !== index) {
                        dt.items.add(file);
                    }
                });

                fileInput.files = dt.files;
                handleFileSelect({
                    target: fileInput
                });
            }

            // Handle search
            function handleSearch(e) {
                const searchTerm = e.target.value.toLowerCase();
                const filteredItems = menuItems.filter(item =>
                    item.name.toLowerCase().includes(searchTerm) ||
                    item.description.toLowerCase().includes(searchTerm)
                );
                renderMenuItems(filteredItems);
            }

            // Render menu items in table
            function renderMenuItems(items = menuItems) {
                const tbody = document.getElementById('foodTableBody');
                const entriesCount = document.getElementById('entriesCount');

                entriesCount.textContent = items.length;

                if (items.length === 0) {
                    tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <p class="text-lg font-medium">No menu items found</p>
                                <p class="text-sm">Add your first menu item to get started</p>
                            </div>
                        </td>
                    </tr>
                `;
                    return;
                }

                tbody.innerHTML = items.map(item => `
                <tr class="hover:bg-gray-50 transition-colors animate-fade-in">
                    <td class="py-3 px-4 text-sm font-medium text-gray-900">#${item.id}</td>
                    <td class="py-3 px-4">
                        <img src="${item.image}" alt="${item.name}" class="w-12 h-12 object-cover rounded-lg border border-gray-200">
                    </td>
                    <td class="py-3 px-4">
                        <div class="font-medium text-gray-900">${item.name}</div>
                    </td>
                    <td class="py-3 px-4 text-sm text-gray-600 max-w-xs">
                        <div class="truncate" title="${item.description}">
                            ${item.description || 'No description'}
                        </div>
                    </td>
                    <td class="py-3 px-4 text-sm font-medium text-green-600">
                        Rp ${item.price.toLocaleString('id-ID')}
                    </td>
                    <td class="py-3 px-4 text-sm text-gray-600">
                        ${item.menuDate ? formatDate(item.menuDate) : 
                          '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Permanent</span>'}
                    </td>
                    <td class="py-3 px-4 text-center">
                        <div class="flex justify-center space-x-2">
                            <button onclick="editItem(${item.id})" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition-colors" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button onclick="deleteItem(${item.id})" class="bg-red-500 text-white p-2 rounded-md hover:bg-red-600 transition-colors" title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
            }

            // Format date for display
            function formatDate(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
            }

            // Edit item
            function editItem(id) {
                const item = menuItems.find(item => item.id === id);
                if (!item) return;

                currentEditId = id;

                // Populate edit form
                document.getElementById('editFoodId').value = item.id;
                document.getElementById('editFoodName').value = item.name;
                document.getElementById('editFoodDescription').value = item.description;
                document.getElementById('editFoodPrice').value = item.price;
                document.getElementById('editFoodDate').value = item.menuDate || '';

                // Show modal
                document.getElementById('editModal').classList.remove('hidden');
                document.getElementById('editModal').classList.add('flex');
            }

            // Close edit modal
            function closeEditModal() {
                document.getElementById('editModal').classList.add('hidden');
                document.getElementById('editModal').classList.remove('flex');
                currentEditId = null;
            }

            // Delete item
            function deleteItem(id) {
                currentDeleteId = id;
                document.getElementById('deleteModal').classList.remove('hidden');
                document.getElementById('deleteModal').classList.add('flex');
            }

            // Confirm delete
            function confirmDelete() {
                if (currentDeleteId) {
                    menuItems = menuItems.filter(item => item.id !== currentDeleteId);
                    renderMenuItems();
                    showSuccessToast('Menu item deleted successfully!');
                }
                closeDeleteModal();
            }

            // Close delete modal
            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden');
                document.getElementById('deleteModal').classList.remove('flex');
                currentDeleteId = null;
            }

            // Reset form
            function resetForm() {
                document.getElementById('foodForm').reset();
                document.getElementById('imagePreviewGallery').innerHTML = '';
                clearErrors();
            }

            // Show success toast
            function showSuccessToast(message) {
                const toast = document.getElementById('successToast');
                const messageSpan = document.getElementById('toastMessage');

                messageSpan.textContent = message;
                toast.classList.remove('translate-x-full');

                setTimeout(() => {
                    toast.classList.add('translate-x-full');
                }, 3000);
            }

            // Show error toast
            function showErrorToast(message) {
                const toast = document.getElementById('errorToast');
                const messageSpan = document.getElementById('errorMessage');

                messageSpan.textContent = message;
                toast.classList.remove('translate-x-full');

                setTimeout(() => {
                    toast.classList.add('translate-x-full');
                }, 3000);
            }

            // Export data to CSV
            function exportData() {
                const csvContent = [
                    ['ID', 'Name', 'Description', 'Price', 'Menu Date'],
                    ...menuItems.map(item => [
                        item.id,
                        item.name,
                        item.description,
                        item.price,
                        item.menuDate || 'Permanent'
                    ])
                ].map(row => row.map(field => `"${field}"`).join(',')).join('\n');

                const blob = new Blob([csvContent], {
                    type: 'text/csv'
                });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `menu-items-${new Date().toISOString().split('T')[0]}.csv`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);

                showSuccessToast('Data exported successfully!');
            }

            // Print data
            function printData() {
                const printWindow = window.open('', '_blank');
                const printContent = `
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Menu Items Report</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; font-weight: bold; }
                        .header { text-align: center; margin-bottom: 20px; }
                        .date { color: #666; font-size: 14px; }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <h1>Menu Items Report</h1>
                        <p class="date">Generated on: ${new Date().toLocaleDateString('id-ID')}</p>
                        <p>Total Items: ${menuItems.length}</p>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price (Rp)</th>
                                <th>Menu Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${menuItems.map(item => `
                                                <tr>
                                                    <td>#${item.id}</td>
                                                    <td>${item.name}</td>
                                                    <td>${item.description || 'No description'}</td>
                                                    <td>${item.price.toLocaleString('id-ID')}</td>
                                                    <td>${item.menuDate ? formatDate(item.menuDate) : 'Permanent'}</td>
                                                </tr>
                                            `).join('')}
                        </tbody>
                    </table>
                </body>
                </html>
            `;

                printWindow.document.write(printContent);
                printWindow.document.close();
                printWindow.print();
            }

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Ctrl/Cmd + N for new item
                if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                    e.preventDefault();
                    document.getElementById('createFoodForm').scrollIntoView({
                        behavior: 'smooth'
                    });
                    document.getElementById('foodName').focus();
                }

                // ESC to close modals
                if (e.key === 'Escape') {
                    closeEditModal();
                    closeDeleteModal();
                }
            });
        </script>
    </body>
</x-layout>
