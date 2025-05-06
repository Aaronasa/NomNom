<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Google Map Besar & Bisa Geser</title>
    <style>
        #map {
            width: 100%;
            height: 600px; /* ukuran besar */
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
</head>
<body>

<h1>Google Map dengan Lihat Sekitar</h1>
<div id="map"></div>

<script>
    function initMap() {
        const center = { lat: -7.28552330764733, lng: 112.63171798067408 };

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: center,
            draggable: true, // biar bisa digeser
        });

        const marker = new google.maps.Marker({
            position: center,
            map: map,
        });

        // Tempatkan PlacesService untuk lihat sekitar
        const service = new google.maps.places.PlacesService(map);

        const request = {
            location: center,
            radius: '500', // 500 meter radius
            type: ['restaurant', 'store', 'cafe'] // jenis tempat yang mau ditampilkan
        };

        service.nearbySearch(request, (results, status) => {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                for (let i = 0; i < results.length; i++) {
                    const place = results[i];
                    new google.maps.Marker({
                        position: place.geometry.location,
                        map: map,
                        title: place.name
                    });
                }
            }
        });
    }

    window.onload = initMap;
</script>

</body>
</html>
