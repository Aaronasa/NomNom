<x-layout>
    <div class="w-full min-h-screen bg-[#FFF8E6] font-[Instrument Sans]">
        <!-- Vendor Dashboard Header -->
        <div class="bg-white shadow-md">
            <div class="container mx-auto px-4 py-6">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-[#553827]">Vendor Dashboard</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">{{ Auth::user()->username }}</span>
                        <a href="{{ route('logout') }}" class="bg-[#cfad7d] text-white px-4 py-2 rounded hover:bg-[#E5CBA6] transition">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Stats Cards -->
                <div class="bg-white p-6 rounded-lg shadow border border-[#E2CEB1]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm uppercase font-bold">Total Products</p>
                            <h2 class="text-3xl font-bold text-[#553827]">{{ $totalProducts ?? 0 }}</h2>
                        </div>
                        <div class="bg-[#FFF8E6] p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#cfad7d]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0v10a2 2 0 01-2 2H4a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4l2-2h4a2 2 0 012 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow border border-[#E2CEB1]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm uppercase font-bold">Total Orders</p>
                            <h2 class="text-3xl font-bold text-[#553827]">{{ $totalOrders ?? 0 }}</h2>
                        </div>
                        <div class="bg-[#FFF8E6] p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#cfad7d]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow border border-[#E2CEB1]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm uppercase font-bold">Total Revenue</p>
                            <h2 class="text-3xl font-bold text-[#553827]">Rp. {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</h2>
                        </div>
                        <div class="bg-[#FFF8E6] p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#cfad7d]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8">
                <h2 class="text-xl font-bold text-[#553827] mb-4">Quick Actions</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('vendor.products.create') ?? '#' }}" class="bg-white p-4 rounded-lg shadow border border-[#E2CEB1] hover:bg-[#FFF8E6] transition text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-[#cfad7d] mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span class="text-[#553827] font-medium">Add New Product</span>
                    </a>

                    <a href="{{ route('vendor.products.index') ?? '#' }}" class="bg-white p-4 rounded-lg shadow border border-[#E2CEB1] hover:bg-[#FFF8E6] transition text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-[#cfad7d] mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        <span class="text-[#553827] font-medium">Manage Products</span>
                    </a>

                    <a href="{{ route('vendor.orders.index') ?? '#' }}" class="bg-white p-4 rounded-lg shadow border border-[#E2CEB1] hover:bg-[#FFF8E6] transition text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-[#cfad7d] mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span class="text-[#553827] font-medium">View Orders</span>
                    </a>

                    <a href="{{ route('vendor.profile') ?? '#' }}" class="bg-white p-4 rounded-lg shadow border border-[#E2CEB1] hover:bg-[#FFF8E6] transition text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-[#cfad7d] mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-[#553827] font-medium">Vendor Profile</span>
                    </a>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="mt-8">
                <h2 class="text-xl font-bold text-[#553827] mb-4">Recent Orders</h2>
                <div class="bg-white rounded-lg shadow overflow-hidden border border-[#E2CEB1]">
                    <table class="min-w-full divide-y divide-[#E2CEB1]">
                        <thead class="bg-[#FFF8E6]">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#553827] uppercase tracking-wider">Order ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#553827] uppercase tracking-wider">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#553827] uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#553827] uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#553827] uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#553827] uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if(isset($recentOrders) && count($recentOrders) > 0)
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->user->username }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp. {{ number_format($order->total, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $order->status == 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('vendor.orders.show', $order->id) ?? '#' }}" class="text-[#cfad7d] hover:text-[#E5CBA6]">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No orders found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                @if(isset($recentOrders) && count($recentOrders) > 0)
                    <div class="mt-4 text-right">
                        <a href="{{ route('vendor.orders.index') ?? '#' }}" class="text-[#cfad7d] hover:underline">View all orders →</a>
                    </div>
                @endif
            </div>

            <!-- Your Products -->
            <div class="mt-8">
                <h2 class="text-xl font-bold text-[#553827] mb-4">Your Products</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @if(isset($foods) && count($foods) > 0)
                        @foreach($foods as $product)
                            <div class="bg-white rounded-lg shadow overflow-hidden border border-[#E2CEB1]">
                                <div class="h-48 bg-gray-200">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-[#553827] mb-1">{{ $product->name }}</h3>
                                    <p class="text-sm text-gray-600 mb-2">{{ Str::limit($product->description, 60) }}</p>
                                    <p class="font-bold text-[#553827]">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                                    <div class="mt-4 flex justify-between">
                                        <a href="{{ route('vendor.products.edit', $product->id) ?? '#' }}" class="text-[#cfad7d] hover:underline">Edit</a>
                                        <form action="{{ route('vendor.products.destroy', $product->id) ?? '#' }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-4 bg-white p-8 rounded-lg shadow border border-[#E2CEB1] text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0v10a2 2 0 01-2 2H4a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4l2-2h4a2 2 0 012 2z" />
                            </svg>
                            <p class="text-gray-600 mb-4">You haven't added any products yet.</p>
                            <a href="{{ route('vendor.products.create') ?? '#' }}" class="bg-[#cfad7d] text-white px-4 py-2 rounded hover:bg-[#E5CBA6] transition">Add Your First Product</a>
                        </div>
                    @endif
                </div>
                @if(isset($products) && count($products) > 0)
                    <div class="mt-4 text-right">
                        <a href="{{ route('vendor.products.index') ?? '#' }}" class="text-[#cfad7d] hover:underline">Manage all products →</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
