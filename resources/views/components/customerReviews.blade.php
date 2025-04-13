<div class="bg-[#F3E8CC] py-16">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-[#3c2f27] font-[inika]">
                Here’s what our Customers Says!
            </h2>
        </div>
    </div>
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
                <div class="swiper-slide !w-[260px]">
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
</div>
