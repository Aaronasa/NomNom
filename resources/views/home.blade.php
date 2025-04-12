<x-layout>
    <x-navigation />

    <!-- Google Fonts Import -->
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
    <div class="bg-[#FFF8E6]">
        <section class="relative bg-[#E5CBA6] overflow-hidden font-[Inika] min-h-145">
            <!-- Middle wave using SVG -->
            <div class="absolute top-0 left-0 w-full mt-8" style="height: 600px;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 600" preserveAspectRatio="none"
                    class="w-full h-auto">
                    <path fill="#F3E8CC" fill-opacity="1"
                        d="M0,300L48,285.5C96,271,192,242,288,233.3C384,224,480,240,576,265.7C672,291,768,326,864,353.2C960,380,1056,392,1152,368.2C1248,344,1344,271,1392,248.2L1440,225L1440,600L1392,600C1344,600,1248,600,1152,600C1056,600,960,600,864,600C768,600,672,600,576,600C480,600,384,600,288,600C192,600,96,600,48,600L0,600Z">
                    </path>
                </svg>
            </div>
            <div class="relative z-10 max-w-7xl mx-auto px-6 py-10 flex flex-col md:flex-row items-start">
                <div class="md:w-1/2 text-left flex flex-col justify-start">
                    <div>
                        <h1 class="text-6xl font-bold text-[#3F2812] ">Discovering Caterings Made Easier!</h1>
                        <p class="text-3x1 mt-4 font-bold text-[#824C0F]">
                            Find new and tasty food all around you with ease! With NomNom, you can connect with your
                            favourite
                            dishes; no matter where or when you are.
                        </p>
                    </div>
                    <button
                        class="bg-[#EFD9A9] shadow-[0_2px_0px_rgba(0,0,0,0.2)] w-[350px] h-[60px] text-xl rounded-xl ml-28 mt-26 font-bold text-[#4A2200] hover:scale-105 transition self-start font-[Instrument Sans]">
                        Start your Culinary Discovery!
                    </button>

                </div>

                <div class="relative md:w-1/2 flex justify-center items-center mt-10 md:mt-0">
                    <img src="{{ asset('images/CircleHome.png') }}" alt="Background Circle"
                        class="w-[480px] h-[480px] rounded-full">

                    <img src="{{ asset('images/HomeFood.png') }}" alt="Delicious Food"
                        class="absolute w-[460px] h-[460px] rounded-full object-cover z-10">
                </div>

            </div>

        </section>
        <div class="flex items-center justify-between mb-8 container mx-auto px-4 mt-10">
            <div class="flex space-x-4">
                <button id="scrollLeft"
                    class="scroll-btn w-10 h-10 rounded-full bg-[#F3E8CC] flex items-center justify-center text-[#553827] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
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
    </div>
    <div class="bg-[#F3E8CC] py-16">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-[#3c2f27] font-[inika]">
                    Here’s what our Customers Says!
                </h2>
            </div>
        </div>

        <!-- Swiper Container -->
        <div class="swiper mySwiper bg-[#FFF5DA]">
            <div class="swiper-wrapper">
                @foreach ([
        ['name' => 'Sam Portman', 'title' => '“Saved my wedding!”', 'text' => 'Our original caterer cancelled last minute, and this website came through hard. Within 48 hours, we had a new full-service catering plan. Guests still talk about the truffle sliders. Literal lifesaver.', 'img' => '1'],
        ['name' => 'John Smith', 'title' => '“Game-changer for events!”', 'text' => 'I used this app to cater my daughter’s graduation party and everything was flawless. The app was super easy to navigate, and I loved being able to customize the menu down to the last canapé. Highly recommend for stress-free hosting!', 'img' => '2'],
        ['name' => 'Jane Mary', 'title' => '“Office lunch hero!”', 'text' => 'Our team started using this catering website for weekly lunches and now everyone looks forward to Wednesdays. Deliveries are on time, food is always fresh, and the variety is insane. Even our picky vegan loved it.', 'img' => '3'],
        ['name' => 'Ken Kurt', 'title' => '“Great app, but a few bugs”', 'text' => 'I love the concept and the food is fantastic, but the website crashed twice while I was placing a large order. Please fix the glitch and I’ll bump this to 5 stars!', 'img' => '4'],
        ['name' => 'Nina T', 'title' => '“Quick, easy, tasty!”', 'text' => 'Seriously love how simple this was to use. Delivered hot and fast. 10/10 would order again.', 'img' => '5'],
        ['name' => 'Alex D', 'title' => '“Perfect for events”', 'text' => 'Used this for my office seminar. Everything arrived on time and was nicely packed. Everyone was impressed.', 'img' => '6'],
    ] as $item)
                    <div class="swiper-slide !w-[260px]"> <!-- Lebar agak diperbesar -->
                        <div
                            class="bg-[#FFF5DA] rounded-[30px] p-6 flex flex-col items-center text-center justify-between h-full  min-h-[460px]">
                            <div>
                                <h4 class="text-xl font-bold font-[Instrument Sans] text-[#3c2f27] mb-4">
                                    {{ $item['title'] }}</h4>
                                <p class="text-[#5d4037] font-[Instrument Sans] text-sm leading-relaxed">
                                    {{ $item['text'] }}</p>
                            </div>
                            <div class="mt-6 flex flex-col items-center">
                                <img src="{{ asset('images/user-' . $item['img'] . '.png') }}" alt="{{ $item['name'] }}"
                                    class="w-16 h-16 rounded-full border-2 border-white shadow mb-2">
                                <span class="font-bold font-[Instrument Sans] text-[#3c2f27]">{{ $item['name'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </dic>
        <x-footer />
</x-layout>
<script>
    const swiper = new Swiper(".mySwiper", {
        slidesPerView: "auto",
        spaceBetween: 30,
        loop: true,
        speed: 30000,
        autoplay: {
            delay: 0,
            disableOnInteraction: false,
        },
        allowTouchMove: false,
        freeMode: {
            enabled: true,
            momentum: false,
        },
    });

    const wrapper = document.getElementById('topSellersWrapper');
    const btnLeft = document.getElementById('scrollLeft');
    const btnRight = document.getElementById('scrollRight');

    const updateButtons = () => {
        const scrollLeft = wrapper.scrollLeft;
        const maxScrollLeft = wrapper.scrollWidth - wrapper.clientWidth;

        // Update left button
        if (scrollLeft > 10) {
            btnLeft.classList.add('bg-[#BC7D36]');
            btnLeft.classList.remove('bg-[#F3E8CC]');
        } else {
            btnLeft.classList.remove('bg-[#BC7D36]');
            btnLeft.classList.add('bg-[#F3E8CC]');
        }

        // Update right button
        if (scrollLeft < maxScrollLeft - 10) {
            btnRight.classList.add('bg-[#BC7D36]');
            btnRight.classList.remove('bg-[#F3E8CC]');
        } else {
            btnRight.classList.remove('bg-[#BC7D36]');
            btnRight.classList.add('bg-[#F3E8CC]');
        }
    };

    // Event listeners
    btnLeft.addEventListener('click', () => {
        wrapper.scrollBy({
            left: -300,
            behavior: 'smooth'
        });
    });

    btnRight.addEventListener('click', () => {
        wrapper.scrollBy({
            left: 300,
            behavior: 'smooth'
        });
    });

    wrapper.addEventListener('scroll', updateButtons);
    window.addEventListener('load', updateButtons);
</script>


<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
