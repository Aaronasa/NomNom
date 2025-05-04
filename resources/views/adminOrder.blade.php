<x-layout>

    <body class="bg-gray-100 font-family-karla flex-container">

        <!-- Sidebar -->
        <x-sidebar></x-sidebar>

        <div class="main-content bg-white shadow-lg mx-10 p-6">
            <h1 class="text-2xl font-semibold mb-6">List of Order Details</h1>

            <table class="min-w-full table-auto bg-white border border-gray-300 shadow-lg rounded-lg mt-4">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left border-b">ID</th>
                        <th class="py-2 px-4 text-left border-b">Order Id</th>
                        <th class="py-2 px-4 text-left border-b">Payment Status</th>
                        <th class="py-2 px-4 text-left border-b">Price</th>
                        <th class="py-2 px-4 text-left border-b">Unit</th>
                        <th class="py-2 px-4 text-left border-b">Delivery Status</th>
                        <th class="py-2 px-4 text-left border-b">User</th>
                        <th class="py-2 px-4 text-left border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orderDetails as $orderDetail)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">{{ $orderDetail->id }}</td>
                            <td class="py-2 px-4 border-b">
                                {{ $orderDetail->orderInOrderDetail->id }}
                            </td>
                            <td class="py-2 px-4 border-b">
                                @if ($orderDetail->orderInOrderDetail->paymentStatus == 1)
                                    <span class="text-green-600 font-bold">IS PAID</span>
                                @elseif($orderDetail->orderInOrderDetail->paymentStatus == 0)
                                    <span class="text-red-600 font-bold">WAITING PAID</span>
                                @else
                                    Unknown
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b">Rp{{ number_format($orderDetail->price, 2) }}</td>
                            <td class="py-2 px-4 border-b">{{ $orderDetail->unit }}</td>
                            <td class="py-2 px-4 border-b">
                                {{ $orderDetail->deliveryStatusInOrderDetail->statusName ?? 'N/A' }}
                            </td>
                            <td class="py-2 px-4 border-b">
                                {{ $orderDetail->orderInOrderDetail->user->username ?? 'N/A' }}
                            </td>
                            <td class="py-2 px-4 border-b flex flex-col items-center gap-4">
                                <a href="{{ route('admin.orderDetails.edit', $orderDetail->id) }}"
                                    class="bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-600 transition">
                                    Update
                                </a>
                                <form action="{{ route('admin.orderDetails.delete', $orderDetail->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-4 text-center border-b">No order details found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </body>
</x-layout>
