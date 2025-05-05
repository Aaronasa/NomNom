
<style>


    #menu-toggle:checked+#menu {
        display: block;
    }

    .hover\:grow {
        transition: all 0.3s;
        transform: scale(1);
    }

    .hover\:grow:hover {
        transform: scale(1.02);
    }

    .carousel-open:checked+.carousel-item {
        position: static;
        opacity: 100;
    }

    .carousel-item {
        -webkit-transition: opacity 0.6s ease-out;
        transition: opacity 0.6s ease-out;
    }

    #carousel-1:checked~.control-1,
    #carousel-2:checked~.control-2,
    #carousel-3:checked~.control-3 {
        display: block;
    }

    .carousel-indicators {
        list-style: none;
        margin: 0;
        padding: 0;
        position: absolute;
        bottom: 2%;
        left: 0;
        right: 0;
        text-align: center;
        z-index: 10;
    }

    #carousel-1:checked~.control-1~.carousel-indicators li:nth-child(1) .carousel-bullet,
    #carousel-2:checked~.control-2~.carousel-indicators li:nth-child(2) .carousel-bullet{
        color: #ffffff;
    }
</style>

<x-layout>
    <x-navigation/>
    <div class="w-full min-h-screen bg-[#FFF8E6] flex font-[Instrument Sans]">
        <!-- Carousel Section (Left Side) -->
        <div class="carousel relative container mx-auto bg-gray-800" style="max-width:1600px;">
            <div class="carousel-inner relative overflow-hidden w-full">
                @php
                    $images = explode(',', $menuDay->foodInMenuDay->foodImage); 
                @endphp

                <!-- Loop through all images -->
                @foreach ($images as $index => $image)
                    <input class="carousel-open" type="radio" id="carousel-{{ $index + 1 }}" name="carousel"
                        aria-hidden="true" hidden="true" {{ $index === 0 ? 'checked="checked"' : '' }}>
                    <div class="carousel-item absolute opacity-0" style="height:100vh;">
                        <div class="block h-120 w-150 mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-center"
                            style="background-image: url('{{ asset($image) }}'); background-size: cover; background-position: center;">
                        </div>
                    </div>
                @endforeach

                <!-- Carousel Controls -->
                @foreach ($images as $index => $image)
                    <label for="carousel-{{ $index }}" class="prev control-{{ $index + 1 }} w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer text-5xl font-bold text-black-500 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
                    
                    <label for="carousel-{{ $index + 1 }}" class="next control-{{ $index + 1 }} w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer text-5xl font-bold text-black-500 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>
                @endforeach

            </div>
        </div>

        <!-- Text Section (Right Side) -->
        <div class="w-1/2 p-8">
            <h2 class="text-4xl font-semibold text-gray-800 mb-6">
                {{ $menuDay->foodInMenuDay->foodName }}
            </h2>

            <p class="text-gray-700 text-lg mb-6">
                {{ $menuDay->foodInMenuDay->foodDescription }}
            </p>

            <div class="flex flex-col text-gray-800 text-lg mb-6">
                <span><strong>Price:</strong> Rp {{ number_format($menuDay->foodInMenuDay->foodPrice, 0, ',', '.') }}</span>
                <span><strong>Restaurant:</strong> {{ $menuDay->foodInMenuDay->restaurantInFood->restaurantName }}</span>
            </div>

            <p class="text-gray-500 text-lg mb-6">
                <strong>Available on:</strong> {{ $menuDay->foodDate }}
            </p>

            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="food" value="{{ json_encode([
                    'menuDayId' => $menuDay->id, 
                    'foodName' => $menuDay->foodInMenuDay->foodName,
                    'foodPrice' => $menuDay->foodInMenuDay->foodPrice,
                    'foodImage' => $menuDay->foodInMenuDay->foodImage,
                ]) }}">
                <button type="submit" class="mt-6 w-full bg-[#E5CBA6] text-white py-3 px-6 rounded-lg hover:bg-[#d6b88d] focus:outline-none focus:ring-2 focus:ring-gray-600">
                    Add to cart
                </button>
            </form>

            <a href="/home" class="mt-6 block w-full bg-white text-black py-3 px-6 rounded-lg text-center hover:bg-[#d6b88d] ">
                Back
            </a>

        </div>
    </div>
    <x-footer></x-footer>
</x-layout>


