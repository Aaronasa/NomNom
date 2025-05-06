<x-layout>

    <body class="bg-gray-100 font-family-karla">
        <div class="flex min-h-screen">
            <!-- Fixed Sidebar -->


            <!-- Main Content - With left margin to prevent overlap -->
            <div class="flex-1 flex flex-col ml-64">
                <!-- Sticky Header with Search and Create Button -->
                <header class="bg-white shadow-md sticky top-0 z-10 px-6 py-4">
                    <div class="max-w-7xl mx-auto flex justify-between items-center">
                        <h1 class="text-2xl font-bold text-gray-800">Order Management</h1>

                        <div class="flex items-center space-x-4">
                            <!-- Search Bar -->
                            <div class="relative">
                                <input type="text" id="searchOrder" placeholder="Search orders..."
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-500 w-64">
                                <div class="absolute left-3 top-2.5 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                            <!-- Filter by Payment Status -->
                            <select id="paymentFilter"
                                class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-300 focus:border-blue-500">
                                <option value="all">All</option>
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                                <option value="unknown">Unknown</option>
                            </select>

                            <!-- Create Button - Scrolls to create form -->

                        </div>
                    </div>
                </header>

                <!-- Order List Section -->
                <section class="p-6 md:p-10">
                    <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="bg-blue-50 px-6 py-4 border-b border-blue-100 flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-700">List of Order Details</h2>
                                <p class="text-sm text-gray-500">Manage customer orders and delivery statuses</p>
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
                                        <th class="py-3 px-4 font-semibold text-left">Order ID</th>
                                        <th class="py-3 px-4 font-semibold text-left">Payment Status</th>
                                        <th class="py-3 px-4 font-semibold text-left">Price</th>
                                        <th class="py-3 px-4 font-semibold text-left">Unit</th>
                                        <th class="py-3 px-4 font-semibold text-left">Delivery Status</th>
                                        <th class="py-3 px-4 font-semibold text-left">User</th>
                                        <th class="py-3 px-4 font-semibold text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse ($orderDetails as $orderDetail)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="py-3 px-4">{{ $orderDetail->id }}</td>
                                            <td class="py-3 px-4 font-medium">{{ $orderDetail->orderInOrderDetail->id }}
                                            </td>
                                            <td class="py-3 px-4">
                                                @if ($orderDetail->orderInOrderDetail->paymentStatus == 1)
                                                    <span
                                                        class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                                        IS PAID
                                                    </span>
                                                @elseif($orderDetail->orderInOrderDetail->paymentStatus == 0)
                                                    <span
                                                        class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">
                                                        WAITING PAID
                                                    </span>
                                                @else
                                                    <span
                                                        class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">
                                                        Unknown
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-3 px-4 font-medium">
                                                Rp{{ number_format($orderDetail->price, 2) }}</td>
                                            <td class="py-3 px-4">{{ $orderDetail->unit }}</td>
                                            <td class="py-3 px-4">
                                                <span class="px-2 py-1 bg-blue-50 text-blue-700 rounded-full text-xs">
                                                    {{ $orderDetail->deliveryStatusInOrderDetail->statusName ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4">
                                                {{ $orderDetail->orderInOrderDetail->user->username ?? 'N/A' }}</td>
                                            <td class="py-3 px-4">
                                                <div class="flex justify-center gap-2">
                                                    <a href="{{ route('admin.orderDetails.edit', $orderDetail->id) }}"
                                                        class="bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-600 transition flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.orderDetails.delete', $orderDetail->id) }}"
                                                        method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 transition flex items-center"
                                                            onclick="return confirm('Are you sure you want to delete this order?')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="py-8 text-center text-gray-500">
                                                <div class="flex flex-col items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-16 w-16 text-gray-300 mb-2" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                    <p class="text-lg font-medium">No orders found</p>
                                                    <p class="text-sm">Get started by creating a new order below</p>
                                                    <a href="#createOrderForm"
                                                        class="mt-4 bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition">
                                                        Create Your First Order
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination section -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                            <div class="text-sm text-gray-500">
                                Showing <span class="font-medium">{{ count($orderDetails) }}</span> entries
                            </div>
                            <div>
                                <!-- Pagination placeholder -->
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>

        <script>
            const searchInput = document.getElementById('searchOrder');
            const paymentFilter = document.getElementById('paymentFilter');

            function filterOrders() {
                const searchTerm = searchInput.value.toLowerCase();
                const paymentValue = paymentFilter.value;

                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const orderId = row.cells[1]?.textContent.toLowerCase() || '';
                    const status = row.cells[2]?.textContent.trim().toLowerCase() || '';
                    const user = row.cells[6]?.textContent.toLowerCase() || '';

                    let isVisible = (orderId.includes(searchTerm) || status.includes(searchTerm) || user.includes(
                        searchTerm));

                    if (paymentValue === 'paid' && !status.includes('is paid')) {
                        isVisible = false;
                    } else if (paymentValue === 'unpaid' && !status.includes('waiting paid')) {
                        isVisible = false;
                    } else if (paymentValue === 'unknown' && !status.includes('unknown')) {
                        isVisible = false;
                    }

                    row.style.display = isVisible ? '' : 'none';
                });
            }


            searchInput.addEventListener('input', filterOrders);
            paymentFilter.addEventListener('change', filterOrders);

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
        </script>
    </body>
</x-layout>