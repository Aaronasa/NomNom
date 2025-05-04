<x-layout>
    <x-navigation />

    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold mb-4 text-white">Order Details</h1>

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('order.history') }}" class="px-4 py-2 bg-gray-600 text-white font-semibold rounded hover:bg-gray-700">
                Back
            </a>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold">Order ID: {{ $order->id }}</h2>
            <p class="text-sm text-gray-600">Ordered on: {{ $order->orderDate->format('d M Y') }}</p>
            <p class="text-sm text-gray-600">Total Price: Rp {{ number_format($order->totalPrice, 2) }}</p>
            <p class="text-sm text-gray-600">
                Payment Status:
                @if ($order->paymentStatus == 1)
                    <span class="text-green-600 font-bold">IS PAID</span>
                @elseif ($order->paymentStatus == 0)
                    <span class="text-red-600 font-bold">WAITING PAID</span>
                @else
                    <span class="text-gray-600">Unknown</span>
                @endif
            </p>

            <h3 class="text-lg font-semibold mt-4">Order Details</h3>
            <ul class="mt-4 space-y-2">
                @foreach ($order->orderDetailInOrder as $detail)
                    <li class="text-sm text-gray-700 bg-white p-3 rounded shadow">
                        <p><strong>Food Name:</strong> {{ $detail->menuDayInOrderDetail->foodInMenuDay->foodName }}</p>
                        <p><strong>Food Date:</strong> {{ \Carbon\Carbon::parse($detail->menuDayInOrderDetail->foodDate)->format('d M Y') }}</p>
                        <p><strong>Price:</strong> Rp {{ number_format($detail->price, 2) }}</p>
                        <p><strong>Unit:</strong> {{ $detail->unit }}</p>
                        <p><strong>Delivery Status:</strong>
                            @if ($detail->deliveryStatus_id == 1)
                                Waiting for delivery
                            @elseif ($detail->deliveryStatus_id == 2)
                                On the delivery way
                            @elseif ($detail->deliveryStatus_id == 3)
                                Already received
                            @else
                                Unknown
                            @endif
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <x-footer></x-footer>
</x-layout>
