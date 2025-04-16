<div class="flex flex-col-reverse md:flex-row items-center justify-between mb-8 container mx-auto px-4 mt-10 text-center md:text-left">
    <div class="flex space-x-4 mt-4 md:mt-0">
        <button id="scrollLeft"
            class="scroll-btn w-10 h-10 rounded-full bg-[#F3E8CC] flex items-center justify-center text-[#553827] transition-colors outline outline-1 outline-[#3c2f27]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button id="scrollRight"
            class="scroll-btn w-10 h-10 rounded-full bg-[#F3E8CC] flex items-center justify-center text-[#553827] transition-colors outline outline-1 outline-[#3c2f27]">
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
            @foreach (range(1, 10) as $i)
            <div class="min-w-[235px] h-[410px] bg-[#FFF8E6] rounded-[30px] shadow-md hover:shadow-xl flex flex-col overflow-hidden">
                <img src="{{ asset('images/HomeFood.png') }}" alt="Food Item"
                class="w-full h-60 object-contain rounded-t-[30px]" />
            
                <div class="flex flex-col justify-between flex-grow p-4">
                    <div class="flex-grow">
                        <h3 class="text-base font-semibold text-[#3c2f27]">Delicious Dish {{ $i }}</h3>
                        <p class="text-[#5d4037] text-sm">Lorem ipsum dolor sit amet.</p>
                    </div>
                    <div class="flex justify-between items-center mt-3">
                        <span class="text-[#3F2812] font-bold text-sm font-[Instrument Sans]">  
                            Rp. {{ number_format([132000, 69000, 49000, 5000, 49000, 5000, 49000, 5000, 49000, 5000][$i - 1], 0, ',', '.') }},00
                        </span>
                        <button
                            class="bg-[#EFD9A9] text-[#5d4037] px-3 py-1 rounded-full text-sm font-semibold hover:bg-[#d4b978] transition">
                            Order Now!
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>