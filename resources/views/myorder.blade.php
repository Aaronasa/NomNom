<x-layout>
    <x-navigation />
    <section class="bg-[#FFF8E6] min-h-screen">
        <div class="container mx-auto py-8 px-4 font-[Instrument Sans]">
            <h1 class="text-3xl font-bold mb-6 text-[#8C7451]">My Orders</h1>

            @php
                $dummyOrders = [
                    [
                        'is_paid' => true,
                        'items' => [
                            ['name' => 'Nasi Goreng', 'quantity' => 2, 'price' => 20000],
                            ['name' => 'Es Teh Manis', 'quantity' => 1, 'price' => 5000],
                        ],
                        'delivery_status' => 'On Delivery',
                        'order_date' => '2025-04-13 15:00:00',
                        'total_price' => 45000,
                    ],
                    [
                        'is_paid' => false,
                        'items' => [
                            ['name' => 'Mie Ayam', 'quantity' => 1, 'price' => 15000],
                            ['name' => 'Jus Alpukat', 'quantity' => 1, 'price' => 10000],
                        ],
                        'delivery_status' => 'Pending',
                        'order_date' => '2025-04-12 11:30:00',
                        'total_price' => 25000,
                    ],
                ];
            @endphp


            @if (empty($dummyOrders))
                <div class="text-center py-8">
                    <p class="text-[#8C7451] text-lg">You don't have any orders yet.</p>
                    <a href="#" class="text-blue-600 hover:underline">Browse Menu</a>
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($dummyOrders as $order)
                    <div class="bg-[#FFF8E6] rounded-2xl p-6 mb-6" style="box-shadow: 0px 5px 9px rgba(0, 0, 0, 0.15), 0px -2px 4px rgba(0, 0, 0, 0.1), -2px 0px 4px rgba(0, 0, 0, 0.1), 2px 0px 4px rgba(0, 0, 0, 0.1);">
                        <div class="flex justify-between items-center border-b-4 pb-4 mb-4 border-[#E5DFCF]">
                                <span
                                    class="inline-flex items-center px-4 py-1 rounded-full text-sm font-medium 
                                {{ $order['is_paid'] ? 'bg-[#B9E5B5] text-[#17780A]' : 'bg-[#F5C8C8] text-[#9D0000]' }}">
                                    {{ $order['is_paid'] ? 'Paid' : 'Unpaid' }}
                                </span>
                            </div>

                            <!-- Order Items -->
                            <div class="mb-4">
                                <h3 class="text-md font-semibold mb-2 text-[#9D7B54]">Order Items:</h3>
                                <div class="space-y-2">
                                    @foreach ($order['items'] as $item)
                                        <div class="flex justify-between items-center bg-[#F4ECD8] p-3 rounded-lg">
                                            <span class="text-[#3F2812]">{{ $item['name'] }}</span>
                                            <div class="flex items-center gap-4">
                                                <span class="text-[#3F2812]">x{{ $item['quantity'] }}</span>
                                                <span class="text-[#3F2812]">
                                                    Rp
                                                    {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-[#5E4C2F]">
                                <div>
                                    <p class="text-sm text-[#3F2812B5]">Delivery Status</p>
                                    <p class="font-medium text-[#3F2812]">{{ $order['delivery_status'] }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-[#3F2812B5]">Order Date</p>
                                    <p class="font-medium text-[#3F2812]">
                                        {{ \Carbon\Carbon::parse($order['order_date'])->format('d M Y H:i') }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-[#3F2812B5]">Total Items</p>
                                    <p class="font-medium text-[#3F2812]">{{ collect($order['items'])->sum('quantity') }} units</p>
                                </div>

                                <div>
                                    <p class="text-sm text-[#3F2812B5]">Total Price</p>
                                    <p class="font-medium text-[#3F2812] ">Rp {{ number_format($order['total_price'], 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

</x-layout>
