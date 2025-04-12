<!DOCTYPE html>
<html lang= "en">

<head>
    {{-- <title>{{ $layoutTitle }}</title> --}}
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    <link rel="stylesheet" href="{{ asset('mydesign/mystyle.css') }}">
</head>

<body>
    <div>
        <main>
            {{ $slot }}
        </main>
    </div>

</body>
<script src="{{ asset('mydesign/mystyle.css') }}"></script>

</html>
