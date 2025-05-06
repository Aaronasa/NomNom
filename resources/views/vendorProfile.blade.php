<x-layout>
    <div class="min-h-screen font-[Instrument Sans] bg-[#FFF8E6] py-12">
        <div class="container mx-auto px-4">
            <div class="flex justify-center flex-col md:flex-row gap-6">
                <!-- User Profile Card -->
                <div class="w-full max-w-2xl">
                    <!-- Profile Card -->
                    <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
                        <!-- Header -->
                        <div class="bg-[#E5CBA6] px-6 py-8 text-white">
                            <div class="flex items-center justify-between">
                                <h1 class="text-2xl font-bold">User Profile</h1>
                                <div class="h-14 w-14 rounded-full bg-white/20 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Form Content -->
                        <div class="px-6 py-8">
                            <form action="{{ url('/profile/update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="space-y-6">
                                    <!-- Username -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="username">
                                            Username
                                        </label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <input type="text" name="username" id="username" 
                                                placeholder="Your Username" 
                                                value="{{ old('username', $user->username) }}" 
                                                required 
                                                class="pl-10 pr-3 py-3 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-900">
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">
                                            Email
                                        </label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                                </svg>
                                            </div>
                                            <input type="email" name="email" id="email" 
                                                placeholder="Your Email" 
                                                value="{{ old('email', $user->email) }}" 
                                                required 
                                                class="pl-10 pr-3 py-3 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-900">
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="phone">
                                            Phone Number
                                        </label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                                </svg>
                                            </div>
                                            <input type="tel" name="phone" id="phone" 
                                                placeholder="Your Phone Number" 
                                                value="{{ old('phone', $user->phone) }}" 
                                                class="pl-10 pr-3 py-3 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-900">
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="address">
                                            Address
                                        </label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <textarea name="address" id="address" 
                                                placeholder="Your Address" 
                                                rows="3"
                                                class="pl-10 pr-3 py-3 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-900">{{ old('address', $user->address) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="mt-8">
                                    <button type="submit" 
                                            class="w-full bg-[#E5CBA6] text-white font-medium py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E5CBA6]">
                                        Update Profile
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Restaurant Profile Card -->
                <div class="w-full max-w-2xl">
                    <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
                        <!-- Header -->
                        <div class="bg-[#E5CBA6] px-6 py-8 text-white">
                            <div class="flex items-center justify-between">
                                <h1 class="text-2xl font-bold">Restaurant Details</h1>
                                <div class="h-14 w-14 rounded-full bg-white/20 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Form Content -->
                        <div class="px-6 py-8">
                            <form action="{{ route('vendor.profile.update') }}" method="POST">
                                @csrf
                                
                                <div class="space-y-6">
                                    <!-- Restaurant Name -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="restaurantName">
                                            Restaurant Name
                                        </label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M6 3a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm0 3a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm0 3a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm0 3a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <input type="text" name="restaurantName" id="restaurantName" 
                                                placeholder="Restaurant Name" 
                                                value="{{ old('restaurantName', $restaurant->restaurantName ?? '') }}" 
                                                required 
                                                class="pl-10 pr-3 py-3 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-900">
                                        </div>
                                    </div>

                                    <!-- Restaurant Phone -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="restaurantPhone">
                                            Restaurant Phone
                                        </label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                                </svg>
                                            </div>
                                            <input type="tel" name="restaurantPhone" id="restaurantPhone" 
                                                placeholder="Restaurant Phone Number" 
                                                value="{{ old('restaurantPhone', $restaurant->restaurantPhone ?? '') }}" 
                                                required
                                                class="pl-10 pr-3 py-3 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-900">
                                        </div>
                                    </div>

                                    <!-- Restaurant Address -->
                                    <div>
                                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="restaurantAddress">
                                            Restaurant Address
                                        </label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <textarea name="restaurantAddress" id="restaurantAddress" 
                                                placeholder="Restaurant Address" 
                                                rows="3"
                                                required
                                                class="pl-10 pr-3 py-3 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-900">{{ old('restaurantAddress', $restaurant->restaurantAddress ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="mt-8">
                                    <button type="submit" 
                                            class="w-full bg-[#E5CBA6] text-white font-medium py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E5CBA6]">
                                        Update Restaurant
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Link -->
            <div class="mt-6 text-center">
                <a href="{{ route('VendorDashboard') }}" class="inline-flex items-center text-[#E5CBA6] hover:text-[#d7bb93] font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to Dashboard
                </a>
            </div>

            <!-- Additional Information -->
            <div class="mt-6 text-center text-gray-400 text-sm">
                <p>Last updated: {{ date('F j, Y') }}</p>
            </div>
        </div>
    </div>
</x-layout>