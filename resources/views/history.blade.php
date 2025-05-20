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
                            @if ($order->paymentStatus == 'Paid')
                                <div class="bg-green-200 text-green-800 rounded-full px-4 py-1 text-sm font-medium">
                                    Paid
                                </div>
                            @elseif ($order->paymentStatus == 'Unpaid')
                                <div class="bg-red-200 text-red-800 rounded-full px-4 py-1 text-sm font-medium">
                                    Unpaid
                                </div>
                            @elseif ($order->paymentStatus == 'Pending')
                                <div class="bg-yellow-200 text-yellow-800 rounded-full px-4 py-1 text-sm font-medium">
                                    Pending
                                </div>
                            @elseif ($order->paymentStatus == 'Canceled')
                                <div class="bg-gray-200 text-gray-800 rounded-full px-4 py-1 text-sm font-medium">
                                    Canceled
                                </div>
                            @elseif ($order->paymentStatus == 'Expired')
                                <div class="bg-gray-200 text-gray-800 rounded-full px-4 py-1 text-sm font-medium">
                                    Expired
                                </div>
                            @elseif ($order->paymentStatus == 'Denied')
                                <div class="bg-red-200 text-red-800 rounded-full px-4 py-1 text-sm font-medium">
                                    Denied
                                </div>
                            @else
                                <div class="bg-gray-200 text-gray-800 rounded-full px-4 py-1 text-sm font-medium">
                                    {{ $order->paymentStatus }}
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
                                    $food = $menuDay ? $menuDay->foodInMenuDay : null;
                                    $foodName = $food ? $food->foodName : 'Unknown';
                                    $foodImage = $food ? explode(',', $food->foodImage)[0] ?? null : null;
                                @endphp
                                <div class="bg-[#F4ECD8] shadow-lg mt-5 p-3 mb-2 flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        @if ($foodImage)
                                            <img src="{{ asset($foodImage) }}" alt="{{ $foodName }}"
                                                class="w-16 h-16 object-cover rounded">
                                        @else
                                            <div
                                                class="w-16 h-16 flex items-center justify-center bg-gray-100 text-gray-500">
                                                No Image</div>
                                        @endif
                                        <span class="font-medium text-gray-800">{{ $foodName }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-600">{{ $item->unit }}x</span>
                                        <span class="text-gray-800">Rp.
                                            {{ number_format($item->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                               @php
                                    $filename = $item->id . '.jpg';
                                    $proofPath = public_path('image/proofs/' . $filename);
                                @endphp

                                @if (file_exists($proofPath))
                                    <img src="{{ asset('image/proofs/' . $filename) }}" />
                                @else
                                    <p>No proof uploaded yet.</p>
                                @endif

                            @endforeach

                            <!-- Order Details -->
                            <div class="flex justify-between mt-4">
                                <div>
                                    <p class="text-gray-600 text-sm">Delivery Status :</p>
                                    <p class="font-medium">
                                        @php
                                            $deliveryStatus =
                                                $order->orderDetailInOrder->first() &&
                                                $order->orderDetailInOrder->first()->deliveryStatus_id
                                                    ? ($order->orderDetailInOrder->first()->deliveryStatus_id == 1
                                                        ? 'On Process'
                                                        : 'Delivered')
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

                        </div>
                    </div>
                @endforeach

                @if (count($orders) == 0)
                    <div class="text-center py-8">
                        <p class="text-[#7A6247]">You have no order history.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <x-footer></x-footer>
</x-layout>
