<x-layout>
    <x-sidebar></x-sidebar>

    <div class="main-content p-6 bg-white mx-10 shadow-lg">
        <h1 class="text-2xl font-semibold mb-6">Edit Order Detail</h1>

       

        <form action="{{ route('vendor.orders.updateDetail', $orderDetail->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Order ID</label>
                <input type="text" value="{{ $orderDetail->orderInOrderDetail->id ?? 'N/A' }}"
                    class="bg-gray-200 w-full p-2 rounded" readonly>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">User</label>
                <input type="text" value="{{ $orderDetail->orderInOrderDetail->user->username ?? 'N/A' }}"
                    class="bg-gray-200 w-full p-2 rounded" readonly>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" value="{{ old('price', $orderDetail->price) }}"
                    class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Unit</label>
                <input type="number" name="unit" value="{{ old('unit', $orderDetail->unit) }}"
                    class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Delivery Status</label>
                <select name="delivery_status" class="w-full p-2 border rounded">
                    @foreach ($deliveryStatuses as $status)
                        <option value="{{ $status->statusName }}"
                            {{ $orderDetail->deliveryStatusInOrderDetail->statusName == $status->statusName ? 'selected' : '' }}>
                            {{ $status->statusName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Proof of Delivery</label>
                <input type="file" name="proof_image" class="w-full p-2 border rounded">
            </div>

            @php
                $proofPath = 'image/proofs/' . $orderDetail->id . '.jpg';
            @endphp
            @if (file_exists(public_path($proofPath)))
                <div class="mb-4">
                    <p class="text-sm text-gray-600">Current Proof:</p>
                    <img src="{{ asset($proofPath) }}" class="w-32 h-32 object-cover rounded">
                </div>
            @endif

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
        </form>
    </div>
</x-layout>
