<div class="flex items-center justify-between mb-8 container mx-auto px-4 mt-10">
    <div class="flex space-x-4">
        <button id="scrollLeft"
            class="scroll-btn w-10 h-10 rounded-full bg-[#F3E8CC] flex items-center justify-center text-[#553827] transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button id="scrollRight"
            class="scroll-btn w-10 h-10 rounded-full bg-[#F3E8CC] flex items-center justify-center text-[#553827] transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
    <h2 class="text-3xl font-bold text-[#3c2f27] font-[Inika]">Here's What our Top Sellers Are!</h2>
</div>
<div class="bg-[#E5CBA6] min-h-130 py-12 px-6">
    <div class="max-w-7xl mx-auto">
        <div id="topSellersWrapper" class="flex space-x-6 overflow-x-auto scroll-smooth no-scrollbar">
            @foreach (range(1, 4) as $i)
                <div
                    class="min-w-[280px] flex-shrink-0 bg-[#FFF8E6] rounded-[30px] shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
                    <img src="{{ asset('images/HomeFood.png') }}" alt="Food Item"
                        class="w-full h-auto object-cover rounded-t-[30px]">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-[#3c2f27]">Delicious Dish {{ $i }}</h3>
                        <p class="text-[#5d4037] text-sm mb-3">Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-[#3F2812] font-bold text-lg">
                                Rp. {{ number_format([132000, 69000, 49000, 5000][$i - 1], 0, ',', '.') }},00
                            </span>
                            <button
                                class="bg-[#EFD9A9] text-[#5d4037] px-4 py-1 rounded-full text-sm font-semibold shadow-md hover:bg-[#d4b978] transition">
                                Order Now!
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
