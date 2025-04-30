<x-layout>
    <x-navigation />

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <section class="bg-[#FFF8E6] py-12 min-h-screen ">
        <div class="container mx-auto px-4 max-w-6xl font-[Instrument Sans]">

            <!-- Date Filter -->
            <div class="mb-10">
                <h2 class="text-3xl font-semibold text-[#7A6247] mb-6">Menu</h2>
                <form class="flex flex-col sm:flex-row items-center gap-4">
                    <div>
                        <label for="selected_date" class="block text-lg text-[#7A6247] mb-1">Select Date:</label>
                        <input type="date" id="selected_date" name="selected_date"
                            class="border border-[#E2CEB1] bg-white rounded-lg p-3 shadow-sm outline-none focus:ring-2 focus:ring-[#E2CEB1]">
                    </div>
                    <button type="submit"
                        class="px-6 py-3 mt-6 sm:mt-9 bg-[#D9C4A5] text-white font-medium text-base rounded-lg hover:bg-[#C2AC8A] transition">
                        Show Menu
                    </button>
                </form>
            </div>

            <!-- Menu Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @for ($i = 0; $i < 4; $i++)
                    <div class="bg-[#FFF8E6] border border-[#E2CEB1] rounded-xl shadow-md flex p-4 gap-4 items-center"
                        style="box-shadow: 0 4px 2px rgba(0, 0, 0, 0.1), 4px 4px 6px rgba(0, 0, 0, 0.2), -4px 4px 6px rgba(0, 0, 0, 0.2), 0 -1px 2px rgba(0, 0, 0, 0.1);">
                        <!-- Image -->
                        <div class="w-36 h-36 flex-shrink-0 rounded-lg overflow-hidden">
                            <img src="{{ asset('images/nasigoreng.jpeg') }}" alt="Food"
                                class="w-full h-full object-cover" />
                        </div>

                        <!-- Content -->
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <h3 class="text-xl font-bold text-[#4A3B2A]">Nasi Goreng Wakidi</h3>
                                <div class="flex items-center gap-1 text-[#D9B25F] text-sm font-medium">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.122-6.545L.488 6.91l6.564-.955L10 0l2.948 5.955 6.564.955-4.756 4.635 1.122 6.545z" />
                                    </svg>
                                    4.5
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 mt-2 line-clamp-3">
                                Nasi Goreng Paling Gcaor
                            </p>
                            <div class="mt-3 flex justify-between items-center">
                                <div class="mt-3 text-[#4A3B2A] font-medium">Rp. 100.0000</div>

                                <!-- Add to Cart -->
                                <!-- Add to Cart Button -->
                                <!-- Add to Cart Button (HTML) -->
                                <!-- Cart Item Example in Blade View -->
                                <button class="addToCartButton" data-item-id="1" data-item-name="Nasi Goreng Wakidi"
                                    data-item-price="100000" data-item-image="{{ asset('images/nasigoreng.jpeg') }}"
                                    class="mt-3 w-30 bg-[#E5CBA6] text-white text-sm font-medium py-2 rounded-lg flex items-center justify-center gap-2">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>
    <x-footer />
</x-layout>
