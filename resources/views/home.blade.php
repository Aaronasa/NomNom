<x-layout>
    <x-navigation />
    <div class="bg-[#FFF8E6]">
        <section class="relative bg-[#E5CBA6] overflow-hidden font-[Inika] min-h-145">
            <div class="absolute top-20 sm:top-0 left-0 w-full mt-8 h-[500px] sm:h-[600px]">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 600" preserveAspectRatio="none"
                    class="w-full h-full drop-shadow-[0_-6px_4px_rgba(0,0,0,0.1)]">
                    <path fill="#F3E8CC"     fill-opacity="1"
                        d="M0,300L48,285.5C96,271,192,242,288,233.3C384,224,480,240,576,265.7C672,291,768,326,864,353.2C960,380,1056,392,1152,368.2C1248,344,1344,271,1392,248.2L1440,225L1440,600L1392,600C1344,600,1248,600,1152,600C1056,600,960,600,864,600C768,600,672,600,576,600C480,600,384,600,288,600C192,600,96,600,48,600L0,600Z">
                    </path>
                </svg>
            </div>

            <div
                class="relative z-10 max-w-7xl mx-auto px-6 py-10 flex flex-col md:flex-row items-start md:items-start text-center md:text-left">
                <div class="md:w-1/2 text-center md:text-left flex flex-col justify-start items-center md:items-start">
                    <div>
                        <h1 class="text-4xl md:text-6xl font-bold text-[#3F2812]">Freshly Made for Your Everyday Meal

                        </h1>
                        <p class=" md:text-3x1 mt-5 font-bold text-[#824C0F]">
                            Enjoy new and delicious food all around you with ease! With NomNom, you can connect
                            with your favorite food wherever and whenever you are.
                        </p>
                    </div>

                    <a href="/menu"
                        class="bg-[#EFD9A9] shadow-[0_5px_0px_rgba(0,0,0,0.1)] w-[240px] h-[60px] text-xl rounded-xl mt-10 md:mt-30 md:ml-30 font-bold text-[#4A2200] hover:scale-105 transition font-[Instrument Sans] self-center md:self-start flex items-center justify-center">
                        Explore Our Menu
                    </a>



                </div>
                <div class="relative md:w-1/2 flex justify-center items-center mt-10 md:mt-0">
                    <img src="{{ asset('image/CircleHome.png') }}" alt="Background Circle"
                        class="w-[180px] h-[180px] md:w-[480px] md:h-[480px] rounded-full">
                    <img src="{{ asset('image/HomeFood.png') }}" alt="Delicious Food"
                        class="w-[160px] h-[160px] absolute md:w-[460px] md:h-[460px] rounded-full object-cover z-10 animate-spin"
                        style="animation-duration: 100s;">
                </div>
            </div>
        </section>

        <x-topmenu />
    </div>
    <x-customerReviews />
    <x-footer />
</x-layout>
