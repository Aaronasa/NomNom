<body class="bg-white text-gray-600 work-sans leading-normal text-base tracking-normal">
    <nav class="sticky top-0 bg-[#ffefd0] z-50 shadow-lg">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-23 items-center justify-between">
                <!-- Mobile menu button -->
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden z-50">
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                        id="mobile-menu-button">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center pl-14 sm:pl-0">
                    <img class="h-12 sm:h-14 w-auto" src="image/LogoDEI.png" alt="Logo">
                </div>


                <!-- Desktop Menu -->
                <div class="hidden sm:flex sm:flex-1 items-center ml-10">
                    <div class="flex space-x-4">
                        <a href="/home"
                            class="rounded-md px-4 py-2 text-base font-medium text-black hover:text-[#552e13]">Home</a>
                        <a href="/order"
                            class="rounded-md px-4 py-2 text-base font-medium text-black hover:text-[#552e13]">Menu</a>
                        <a href="/reviews"
                            class="rounded-md px-4 py-2 text-base font-medium text-black hover:text-[#552e13]">Reviews</a>
                        <a href="/history"
                            class="rounded-md px-4 py-2 text-base font-medium text-black hover:text-[#552e13]">My
                            Order</a>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <button type="button" id="user-menu-button" class="relative flex px-4 text-sm text-black"
                        onclick="window.location.href='/cart';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="#000000">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </button>
                    <!-- Dropdown Trigger -->
                    <div class="relative ml-2">
                        <button type="button" onclick="toggleDropdown()" id="profile-menu-button"
                            class="text-base font-medium text-gray-800 hover:text-[#A07658] focus:outline-none">
                            <span>Hello, </span>
                            <span class="text-[#A07658]">{{ Auth::user()->username }}</span>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="profile-dropdown"
                            class="hidden absolute right-0 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 z-50"
                            role="menu" aria-orientation="vertical" aria-labelledby="profile-menu-button">
                            <a href="/detail" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your
                                Profile</a>

                            <form action="{{ route('logout') }}" method="POST"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                @csrf
                                <button type="submit" class="w-full text-left">Sign out</button>
                            </form>

                            <form action="{{ route('account.delete') }}" method="POST"
                                class="block px-4 py-2 text-sm text-red-700 hover:bg-red-100">
                                @csrf
                                <button type="submit" class="w-full text-left">Delete Account</button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="sm:hidden hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pt-2 pb-3 bg-[#ffefd0] text-black">
                <a href="/home" class="block rounded-md px-3 py-2 text-base font-medium hover:text-[#A07658]">Home</a>
                <a href="/order" class="block rounded-md px-3 py-2 text-base font-medium hover:text-[#A07658]">Menu</a>
                <a href="/reviews"
                    class="block rounded-md px-3 py-2 text-base font-medium hover:text-[#A07658]">Reviews</a>
                <a href="/history"
                    class="block rounded-md px-3 py-2 text-base font-medium hover:text-[#A07658]">My Order</a>
            </div>
        </div>
    </nav>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        function toggleDropdown() {
            const dropdown = document.getElementById("profile-dropdown");
            dropdown.classList.toggle("hidden");
        }

        // Close the dropdown if user clicks outside
        window.addEventListener('click', function(e) {
            const button = document.getElementById("profile-menu-button");
            const dropdown = document.getElementById("profile-dropdown");
            if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add("hidden");
            }
        });
    </script>
</body>
