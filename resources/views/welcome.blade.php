<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/icon.png') }}" type="image/x-icon">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Maps API -->
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
                <p id="output" class="mb-4">حدد موقعك أولاً ثم اختر نوع المحطة.</p>
            </div>
            <div class="col-12 col-sm-9 text-center">
                <div class="mb-2">
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col-12 col-sm-4">
                            <button id="locate-btn" class="btn btn-outline-primary w-100">📍 تحديد موقعي</button>
                        </div>
                        <div class="col-12 col-sm-4">
                            <button id="nearest-gas-btn" class="btn btn-outline-success w-100">⛽️ أقرب محطة
                                غاز</button>
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

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let map;
        let userLocation = null;
        let userMarker = null;
        let markers = [];
        let directionsService, directionsRenderer;

        // تحميل الخريطة
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

        // حساب المسافة بين نقطتين
        function calculateDistance(lat1, lng1, lat2, lng2) {
            const R = 6371; // نصف قطر الأرض
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLng = (lng2 - lng1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLng / 2) * Math.sin(dLng / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;

        }

        // البحث عن أقرب موقع
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


        // تحميل المحطات والبحث عن الأقرب
        function loadStationsAndFindNearest(type) {
            fetch("{{ route('stations') }}")
                .then(response => response.json())
                .then(data => {
                    let stations = data[type];
                    if (userLocation) {
                        const {
                            nearestLocation,
                            shortestDistance
                        } = findNearestLocation(userLocation.lat, userLocation.lng, stations);
                        if (nearestLocation) {
                            document.getElementById('output').innerHTML =
                                `أقرب ${type}: ${nearestLocation.name}<br>المسافة: ${shortestDistance.toFixed(2)} كم`;
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

        // إضافة علامة على الخريطة
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

        // رسم المسار على الخريطة
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

        // تحديد الموقع
        document.getElementById('locate-btn').addEventListener('click', () => {
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
        });

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
            initMap(); // ضروري أولًا
            setMyLoc(); // ثم تحديد الموقع بعد ما الخريطة تكون جاهزة
            // alert('hi');
        }
        // ربط الأزرار بالوظائف
        document.getElementById('nearest-gas-btn').addEventListener('click', () => loadStationsAndFindNearest(
            'gas_stations'));
        document.getElementById('nearest-petrol-btn').addEventListener('click', () => loadStationsAndFindNearest(
            'petrol_stations'));
        document.getElementById('nearest-fire-btn').addEventListener('click', () => loadStationsAndFindNearest(
            'fire_stations'));
    </script>
</body>

</html>
