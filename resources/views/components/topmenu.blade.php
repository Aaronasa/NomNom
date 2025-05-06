<div class="flex flex-col-reverse md:flex-row items-center justify-between mb-8 container mx-auto px-4 mt-10 text-center md:text-left">
    <div class="flex space-x-4 mt-4 md:mt-0">
        <button id="scrollLeft" class="scroll-btn w-10 h-10 rounded-full bg-[#F3E8CC] flex items-center justify-center text-[#553827] transition-colors outline outline-1 outline-[#3c2f27]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button id="scrollRight" class="scroll-btn w-10 h-10 rounded-full bg-[#F3E8CC] flex items-center justify-center text-[#553827] transition-colors outline outline-1 outline-[#3c2f27]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>

    <h2 class="text-3xl font-bold text-[#3c2f27] font-sans">Try Our Best-Selling Menu</h2>
</div>
<div class="bg-[#E5CBA6] py-12 px-6 font-sans">
    <div class="max-w-7xl mx-auto">
        <div id="topSellersWrapper" class="flex space-x-6 overflow-x-auto scroll-smooth no-scrollbar">
            @php
                // Get 15 unique menu items randomly
                $uniqueMenus = $topMenus->unique('foodInMenuDay.id')->shuffle()->take(15);
            @endphp
            
            @foreach ($uniqueMenus as $menu)
                @php
                    $foodImages = explode(',', $menu->foodInMenuDay->foodImage);
                    $firstImage = $foodImages[0] ?? 'default-image.jpg'; // Fallback image
                    
                    // Truncate description to exactly 20 characters
                    $shortDescription = strlen($menu->foodInMenuDay->foodDescription) > 65 
                        ? substr($menu->foodInMenuDay->foodDescription, 0, 100) . '...' 
                        : $menu->foodInMenuDay->foodDescription;
                @endphp
                <div class="min-w-[235px] w-[235px] h-[380px] bg-[#FFF8E6] rounded-[20px] flex flex-col overflow-hidden menu-item">
                    <div class="w-full h-48 overflow-hidden">
                        <img src="{{ asset($firstImage) }}" alt="{{ $menu->foodInMenuDay->foodName }}"
                             class="w-full h-48 object-cover" />
                    </div>
                    
                    <div class="flex flex-col justify-between flex-grow p-4">
                        <div class="flex-grow">
                            <h3 class="text-base font-semibold text-[#3c2f27] truncate">{{ $menu->foodInMenuDay->foodName }}</h3>
                            <p class="text-[#5d4037] text-sm h-10">{{ $shortDescription }}</p>
                        </div>
                        <div class="flex justify-between items-center mt-3">
                            <span class="text-[#3F2812] font-bold text-sm">  
                                Rp {{ number_format($menu->foodInMenuDay->foodPrice, 0, ',', '.') }}
                            </span>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="food" value="{{ json_encode([
                                    'menuDayId' => $menu->id, 
                                    'foodName' => $menu->foodInMenuDay->foodName,
                                    'foodPrice' => $menu->foodInMenuDay->foodPrice,
                                    'foodImage' => $firstImage,
                                ]) }}">
                                <button type="submit" class="bg-[#EFD9A9] text-[#5d4037] px-3 py-1 rounded-full text-sm font-semibold hover:bg-[#d4b978] transition">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scrollLeftBtn = document.getElementById('scrollLeft');
        const scrollRightBtn = document.getElementById('scrollRight');
        const menuContainer = document.getElementById('topSellersWrapper');
        
        scrollLeftBtn.addEventListener('click', function() {
            menuContainer.scrollBy({ left: -500, behavior: 'smooth' });
        });
        
        scrollRightBtn.addEventListener('click', function() {
            menuContainer.scrollBy({ left: 500, behavior: 'smooth' });
        });
    });
</script>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    

    
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