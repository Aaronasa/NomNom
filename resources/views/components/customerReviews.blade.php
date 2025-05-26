{{-- resources/views/components/customerReviews.blade.php --}}

@props(['reviews'])

<div class="bg-[#F3E8CC] py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-10 sm:mb-12">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#3c2f27] font-[inika] text-center sm:text-left">
                What People Are Saying About NomNom
            </h2>
        </div>
    </div>

    <div class="swiper mySwiper bg-[#FFF5DA] px-4 sm:px-6 lg:px-8">
        <div class="swiper-wrapper">
            @foreach($reviews as $review)
                <div class="swiper-slide !w-[85%] sm:!w-[300px]">
                    <div class="p-6 flex flex-col items-center text-center justify-between h-full min-h-[420px]">
                        <div>
                            <!-- Star Rating Display -->
                            <div class="flex justify-center mb-3">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @endif
                                @endfor
                                <span class="ml-2 text-sm text-[#5d4037] font-medium">({{ $review->rating }}/5)</span>
                            </div>
                            
                            <!-- Food Name as Title -->
                            <h4 class="text-lg sm:text-xl font-bold font-[Instrument Sans] text-[#3c2f27] mb-4">
                                "{{ $review->orderDetail->menuDayInOrderDetail->foodInMenuDay->foodName ?? 'Delicious Food' }}"
                            </h4>
                            
                            <!-- Review Comment -->
                            <p class="text-[#5d4037] font-[Instrument Sans] text-sm sm:text-base leading-relaxed">
                                {{ Str::limit($review->comment, 120) ?? 'Great food and service!' }}
                            </p>
                        </div>
                        
                        <div class="mt-6 flex flex-col items-center">
                            <!-- User Profile Picture -->
                            <img src="{{ $review->user->profile_picture ?? asset('image/PP.png') }}" 
                                 alt="{{ $review->user->username }}"
                                 class="w-14 h-14 sm:w-16 sm:h-16 rounded-full border-2 border-[#C8BEB0] shadow mb-2 object-cover">
                            
                            <!-- Username -->
                            <span class="font-bold font-[Instrument Sans] text-[#3c2f27] text-sm sm:text-base">
                                {{ $review->user->username }}
                            </span>
                            
                            <!-- Review Date -->
                            <span class="text-xs text-[#8d6e63] mt-1">
                                {{ $review->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
        },
    });
});
</script>
