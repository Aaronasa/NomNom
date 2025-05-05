<x-layout>
    <x-navigation />

    <style>
        .history-container {
            background-color: #FFF8E6;
            min-height: 100vh;
            padding: 2rem 0;
        }
    </style>

    <section class="history-container">
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-2xl font-semibold mb-4 text-[#3F2812]">My Order</h1>
            
            <div class="max-w-2xl mx-auto">
                @foreach ($orders as $order)
                    <div class="mb-8">
                        <!-- Payment Status Badge -->
                        <div class="flex items-center mb-2">
                            @if ($order->paymentStatus == 1)
                                <div class="bg-green-200 text-green-800 rounded-full px-4 py-1 text-sm font-medium">
                                    Done
                                </div>
                            @elseif ($order->paymentStatus == 0)
                                <div class="bg-red-200 text-red-800 rounded-full px-4 py-1 text-sm font-medium">
                                    Unpaid
                                </div>
                            @else
                                <div class="bg-gray-200 text-gray-800 rounded-full px-4 py-1 text-sm font-medium">
                                    Unknown
                                </div>
                            @endif
                        </div>

                        <!-- Order Content -->
                        <div class="border-t border-b border-gray-300 py-4">
                            <h2 class="text-[#3F2812] text-lg mb-2">Order Items :</h2>
                            
                            <!-- Order Items - Using orderDetailInOrder relationship -->
                            @foreach ($order->orderDetailInOrder as $item)
                                @php
                                    $menuDay = App\Models\MenuDay::with('foodInMenuDay')->find($item->menuDay_id);
                                    $foodName = $menuDay ? $menuDay->foodInMenuDay->foodName : 'Unknown Item';
                                @endphp
                                <div class="bg-[#F4ECD8] shadow-lg *:rounded-md p-3 mb-2 flex justify-between items-center">
                                    <span class="font-medium text-gray-800">{{ $foodName }}</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-600">{{ $item->unit }}x</span>
                                        <span class="text-gray-800">Rp. {{ number_format($item->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            @endforeach
                            
                            <!-- Order Details -->
                            <div class="flex justify-between mt-4">
                                <div>
                                    <p class="text-gray-600 text-sm">Delivery Status :</p>
                                    <p class="font-medium">
                                        @php
                                            $deliveryStatus = ($order->orderDetailInOrder->first() && $order->orderDetailInOrder->first()->deliveryStatus_id) 
                                                ? ($order->orderDetailInOrder->first()->deliveryStatus_id == 1 ? 'On Process' : 'Delivered') 
                                                : 'On Process';
                                        @endphp
                                        {{ $deliveryStatus }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-gray-600 text-sm">Order Date :</p>
                                    <p class="font-medium">
                                        {{ \Carbon\Carbon::parse($order->orderDate)->format('d F Y H:i') }} 
                                        {{ \Carbon\Carbon::parse($order->orderDate)->format('A') }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Total Price -->
                            <div class="mt-4">
                                <p class="text-gray-600 text-sm">Total Price :</p>
                                <p class="font-medium">Rp. {{ number_format($order->totalPrice, 0, ',', '.') }}</p>
                            </div>
                            
                            <!-- View Details Button -->
                            <div class="mt-4 text-right">
                                <form action="{{ route('order.detail.page', ['order' => $order->id]) }}" method="get">
                                    <button type="submit"
                                        class="px-3 py-1 bg-green-100 hover:bg-green-200 text-sm text-green-800 font-semibold rounded">
                                        View Details
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if(count($orders) == 0)
                    <div class="text-center py-8">
                        <p class="text-[#7A6247]">You have no order history.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <x-footer></x-footer>
</x-layout>