<!DOCTYPE html>
<html lang= "en">

<head>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet"
        href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('styles')

</head>

<body>
    <div>
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('scripts')

</body>
<script src="{{ asset('mydesign/mystyle.css') }}"></script>
<script>
    const swiper = new Swiper(".mySwiper", {
        slidesPerView: "auto",
        spaceBetween: 30,
        loop: true,
        speed: 10000,
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

    html,
    body {
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* Internet Explorer 10+ */
    }

    html::-webkit-scrollbar,
    body::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari, Opera */
    }
</style>

</html>
