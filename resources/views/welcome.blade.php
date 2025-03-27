<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/icon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZE7DGzlIgMxiDhV7ebXmto5MEWs1IaXs&callback=onGoogleMapsReady"
        loading="async" defer></script>
</head>

<body class="bg-dark text-light d-flex flex-column min-vh-100">
    <header class="container my-4">
        @if (Route::has('login'))
            <nav class="d-flex justify-content-end gap-2">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline-light">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-secondary">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <main class="container flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-3">
                <div id="output" class="mb-4"></div>
            </div>
            <div class="col-12 col-sm-9 text-center">
                <div class="mb-2">
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col-12 col-sm-4">
                            <button id="locate-btn" class="btn btn-outline-primary w-100">📍 تحديد موقعي</button>
                        </div>
                        <div class="col-12 col-sm-4">
                            <button id="nearest-gas-btn" class="btn btn-outline-success w-100">⛽️ أقرب محطة غاز</button>
                        </div>
                        <div class="col-12 col-sm-4">
                            <button id="nearest-petrol-btn" class="btn btn-outline-warning w-100">🛢️ أقرب محطة
                                بترول</button>
                        </div>
                        <div class="col-12 col-sm-6">
                            <button id="nearest-fire-btn" class="btn btn-outline-danger w-100">🚒 أقرب مركز دفاع
                                مدني</button>
                        </div>
                        <div class="col-12 col-sm-6">
                            <a href="contact_us.html" class="btn btn-danger text-white w-100">💬 التواصل والدعم
                                الفني</a>
                        </div>
                    </div>
                </div>
                <div id="map" class="border rounded shadow" style="height: 500px; width: 100%;"></div>
            </div>
        </div>
    </main>

    <footer class="text-center py-3 mt-auto">
        <strong class="badge bg-secondary">حقوق الطبع والنشر محفوظة لدى شادي كحيل - <span>2025</span></strong>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let map;
        let userLocation = null;
        let userMarker = null;
        let markers = [];
        let directionsService, directionsRenderer;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: {
                    lat: 31.5130,
                    lng: 34.4570
                }
            });
            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);
        }

        function calculateDistance(lat1, lng1, lat2, lng2) {
            const R = 6371;
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLng = (lng2 - lng1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLng / 2) * Math.sin(dLng / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }

        function findNearestLocation(userLat, userLng, locations) {
            let nearestLocation = null;
            let shortestDistance = Infinity;
            locations.forEach(location => {
                const distance = calculateDistance(userLat, userLng, location.lat, location.lng);
                if (distance < shortestDistance) {
                    shortestDistance = distance;
                    nearestLocation = location;
                }
            });
            return {
                nearestLocation,
                shortestDistance
            };
        }

        function loadStationsAndFindNearest(type) {
            fetch("{{ route('stations') }}")
                .then(response => response.json())
                .then(data => {
                    console.log(data[type]);

                    let stations = data[type];
                    if (userLocation) {
                        const {
                            nearestLocation,
                            shortestDistance
                        } = findNearestLocation(userLocation.lat, userLocation.lng, stations);
                        if (nearestLocation) {
                            let images = [];

                            try {
                                images = JSON.parse(nearestLocation.images);
                            } catch (e) {
                                images = [];
                            }
                            if (images != null) {
                                let carouselItems = images.map((src, i) => `
                                <div class="carousel-item ${i === 0 ? 'active' : ''}">
                                    <img src="storage/${src}" class="d-block w-100" style="max-height: 250px; object-fit: cover;" alt="صورة">
                                </div>`).join('');
                                let pricesList = 'لا يوجد أسعار';
                            }else{
                                let carouselItems = '';
                            }

                            if (nearestLocation.prices && nearestLocation.prices.trim() !== '') {
                                const prices = nearestLocation.prices
                                    .split(',')
                                    .map(p => p.trim())
                                    .filter(p => p !== '');

                                if (prices.length > 0) {
                                    pricesList = prices.map(p => `<li>${p}</li>`).join('');
                                }
                            }

                            document.getElementById('output').innerHTML = `
                                <div class="card bg-light text-dark shadow">
                                    <div id="stationCarousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            ${carouselItems}
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#stationCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#stationCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">${nearestLocation.name}</h5>
                                        <p class="card-text mb-1">المسافة: <strong>${shortestDistance.toFixed(2)} كم</strong></p>
                                        <p class="card-text mb-1">العنوان: ${nearestLocation.address ?? 'غير متوفر'}</p>
                                        <p class="card-text mb-1">الوصف: ${nearestLocation.description ?? 'لا يوجد وصف'}</p>
                                        <div><strong>الأسعار:</strong><ul>${pricesList}</ul></div>
                                    </div>
                                </div>`;
                            addMarker(nearestLocation);
                            drawRoute(nearestLocation);
                        } else {
                            document.getElementById('output').innerHTML = "لا توجد مواقع قريبة.";
                        }
                    } else {
                        alert("حدد موقعك أولاً!");
                    }
                })
                .catch(error => console.error("خطأ في تحميل ملف JSON:", error));
        }

        function addMarker(location) {
            const marker = new google.maps.Marker({
                position: {
                    lat: parseFloat(location.lat),
                    lng: parseFloat(location.lng)
                },
                map: map,
                title: location.name
            });
            markers.push(marker);
        }

        function drawRoute(destination) {
            const request = {
                origin: userLocation,
                destination: {
                    lat: parseFloat(destination.lat),
                    lng: parseFloat(destination.lng)
                },
                travelMode: 'DRIVING'
            };
            directionsService.route(request, (result, status) => {
                if (status === 'OK') {
                    directionsRenderer.setDirections(result);
                } else {
                    console.error('تعذر رسم المسار:', status);
                }
            });
        }

        document.getElementById('locate-btn').addEventListener('click', () => setMyLoc());

        function setMyLoc() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    if (userMarker) userMarker.setMap(null);
                    userMarker = new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        title: "موقعك"
                    });
                    map.setCenter(userMarker.getPosition());
                    document.getElementById('output').innerHTML = "تم تحديد موقعك بنجاح!";
                });
            } else {
                alert("ميزة تحديد الموقع غير مدعومة.");
            }
        }

        function onGoogleMapsReady() {
            initMap();
            setMyLoc();
        }

        document.getElementById('nearest-gas-btn').addEventListener('click', () => loadStationsAndFindNearest(
            'gas_stations'));
        document.getElementById('nearest-petrol-btn').addEventListener('click', () => loadStationsAndFindNearest(
            'petrol_stations'));
        document.getElementById('nearest-fire-btn').addEventListener('click', () => loadStationsAndFindNearest(
            'fire_stations'));
    </script>
</body>

</html>
