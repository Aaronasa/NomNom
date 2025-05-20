<x-layout>
    <body class="bg-gray-100 font-family-karla flex-container">

        <!-- Sidebar -->
        <x-sidebar></x-sidebar>

        <!-- Main Content -->
        <div class="main-content bg-white shadow-lg mx-10 p-6">
            <h1 class="text-2xl font-semibold mb-6">Edit Order Detail</h1>

            <form action="{{ route('admin.orderDetails.update', $orderDetail->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Order ID (Read-only) -->
                <div class="mb-4">
                    <label for="order_id" class="block text-sm font-medium text-gray-700">Order ID</label>
                    <input type="text" name="order_id" id="order_id" value="{{ $orderDetail->orderInOrderDetail->id }}" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-200" readonly>
                </div>

                <!-- Payment Status (Boolean) -->
                <div class="mb-4">
                    <label for="payment_status" class="block text-sm font-medium text-gray-700">Payment Status</label>
                    <input type="checkbox" name="payment_status" id="payment_status" value="1" 
                        {{ old('payment_status', $orderDetail->orderInOrderDetail->paymentStatus) ? 'checked' : '' }} 
                        class="mt-1">
                    <span class="text-gray-600 ml-2">Paid</span>
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="text" name="price" id="price" value="{{ old('price', $orderDetail->price) }}" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Unit -->
                <div class="mb-4">
                    <label for="unit" class="block text-sm font-medium text-gray-700">Unit</label>
                    <input type="number" name="unit" id="unit" value="{{ old('unit', $orderDetail->unit) }}" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Delivery Status -->
                <div class="mb-4">
                    <label for="delivery_status" class="block text-sm font-medium text-gray-700">Delivery Status</label>
                    <select name="delivery_status" id="delivery_status" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="Waiting for delivery" {{ old('delivery_status', $orderDetail->deliveryStatusInOrderDetail->statusName) == 'Waiting for delivery' ? 'selected' : '' }}>
                            Waiting for delivery
                        </option>
                        <option value="On the delivery way" {{ old('delivery_status', $orderDetail->deliveryStatusInOrderDetail->statusName) == 'On the delivery way' ? 'selected' : '' }}>
                            On the delivery way
                        </option>
                        <option value="already received" {{ old('delivery_status', $orderDetail->deliveryStatusInOrderDetail->statusName) == 'already received' ? 'selected' : '' }}>
                            Already received
                        </option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Proof of Delivery (optional)</label>
                    <button type="button"
                        class="mt-2 bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">
                        Upload Image
                    </button>
                </div>

                <!-- User (Read-only) -->
                <div class="mb-4">
                    <label for="user" class="block text-sm font-medium text-gray-700">User</label>
                    <input type="text" name="user" id="user" value="{{ $orderDetail->orderInOrderDetail->user->username ?? 'N/A' }}" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-200" readonly>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                    Save Changes
                </button>
            </form>

        </div>

    </body>
</x-layout>
