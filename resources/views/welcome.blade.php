<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/icon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZE7DGzlIgMxiDhV7ebXmto5MEWs1IaXs&callback=onGoogleMapsReady"
        loading="async" defer></script>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --dark-bg: #0f0f1a;
            --card-bg: rgba(255, 255, 255, 0.05);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --accent-blue: #667eea;
            --accent-purple: #764ba2;
        }

        * {
            font-family: 'Tajawal', sans-serif;
        }

        body {
            background: var(--dark-bg);
            background-image:
                radial-gradient(at 40% 20%, rgba(102, 126, 234, 0.15) 0px, transparent 50%),
                radial-gradient(at 80% 0%, rgba(118, 75, 162, 0.15) 0px, transparent 50%),
                radial-gradient(at 0% 50%, rgba(102, 126, 234, 0.1) 0px, transparent 50%),
                radial-gradient(at 80% 50%, rgba(118, 75, 162, 0.1) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(102, 126, 234, 0.1) 0px, transparent 50%);
            min-height: 100vh;
            color: #fff;
        }

        /* Header Styles */
        .main-header {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo-text {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            font-size: 1.5rem;
        }

        .nav-btn {
            background: var(--glass-bg);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .nav-btn:hover {
            background: var(--primary-gradient);
            border-color: transparent;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        /* Hero Section */
        .hero-section {
            padding: 3rem 0;
            text-align: center;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .hero-title span {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .action-btn {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #fff;
            padding: 1rem 2rem;
            border-radius: 16px;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--primary-gradient);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .action-btn:hover {
            transform: translateY(-5px) scale(1.02);
            border-color: transparent;
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
        }

        .action-btn:hover::before {
            opacity: 1;
        }

        .action-btn i {
            font-size: 1.3rem;
        }

        .action-btn.locate { --btn-color: #3b82f6; }
        .action-btn.gas { --btn-color: #22c55e; }
        .action-btn.petrol { --btn-color: #f59e0b; }
        .action-btn.fire { --btn-color: #ef4444; }
        .action-btn.contact { --btn-color: #8b5cf6; }

        .action-btn.locate:hover::before { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); }
        .action-btn.gas:hover::before { background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%); }
        .action-btn.petrol:hover::before { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
        .action-btn.fire:hover::before { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }
        .action-btn.contact:hover::before { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); }

        /* Map Container */
        .map-container {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .map-container::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: var(--primary-gradient);
            border-radius: 26px;
            z-index: -1;
            opacity: 0.5;
        }

        #map {
            height: 550px;
            width: 100%;
            border-radius: 24px;
        }

        /* Smooth transitions for columns */
        #map-col, #results-col {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #results-col {
            animation: slideInRight 0.4s ease;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Output Card */
        .output-section {
            position: relative;
        }

        #output {
            min-height: 100px;
        }

        #output:empty::before {
            content: 'حدد موقعك ثم اختر نوع المحطة لعرض النتائج';
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.95rem;
        }

        .result-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            overflow: hidden;
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .result-card .card-body {
            padding: 1.5rem;
        }

        .result-card .card-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #fff;
        }

        .result-card .info-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
        }

        .result-card .info-item:last-child {
            border-bottom: none;
        }

        .result-card .info-item i {
            width: 24px;
            color: var(--accent-blue);
        }

        .result-card .price-tag {
            background: var(--primary-gradient);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            margin: 0.25rem;
            display: inline-block;
        }

        /* Status Messages */
        .status-message {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            animation: pulse 2s infinite;
        }

        .status-message.success {
            border-color: rgba(34, 197, 94, 0.3);
            background: rgba(34, 197, 94, 0.1);
        }

        .status-message i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        /* Footer */
        .main-footer {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1.5rem 0;
            margin-top: 3rem;
        }

        .footer-text {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        .footer-text span {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 1.75rem;
            }

            .action-btn {
                padding: 0.875rem 1.5rem;
                font-size: 0.9rem;
                width: 100%;
                justify-content: center;
            }

            #map {
                height: 400px;
            }
        }

        /* Loading Animation */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Carousel Improvements */
        .carousel-item img {
            border-radius: 16px 16px 0 0;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="main-header" hidden>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo-text">
                    <i class="fas fa-map-marked-alt me-2"></i>GIS Navigator
                </div>
                @if (Route::has('login'))
                    <nav class="d-flex gap-2">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="nav-btn">
                                <i class="fas fa-tachometer-alt me-2"></i>لوحة التحكم
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="nav-btn">
                                <i class="fas fa-sign-in-alt me-2"></i>تسجيل الدخول
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="nav-btn">
                                    <i class="fas fa-user-plus me-2"></i>إنشاء حساب
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">
                نظام <span>المعلومات الجغرافية</span><br>
                لتوزيع محطات الوقود والخدمات
            </h1>
            <p class="hero-subtitle">
                اكتشف أقرب محطات الوقود والغاز ومراكز الدفاع المدني من موقعك الحالي بدقة عالية
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container">
        <div class="row g-4" id="main-row">
            <!-- Map & Controls -->
            <div class="col-12" id="map-col">
                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button id="locate-btn" class="action-btn locate">
                        <i class="fas fa-crosshairs"></i>
                        تحديد موقعي
                    </button>
                    <button id="nearest-gas-btn" class="action-btn gas">
                        <i class="fas fa-fire-flame-simple"></i>
                        أقرب محطة غاز
                    </button>
                    <button id="nearest-petrol-btn" class="action-btn petrol">
                        <i class="fas fa-gas-pump"></i>
                        أقرب محطة بترول
                    </button>
                    <button id="nearest-fire-btn" class="action-btn fire">
                        <i class="fas fa-fire-extinguisher"></i>
                        أقرب دفاع مدني
                    </button>
                    <a href="{{ route('contact') }}" class="btn action-btn contact">
                        <i class="fas fa-headset"></i>
                        الدعم الفني
                    </a>
                </div>

                <!-- Map -->
                <div class="map-container">
                    <div id="map"></div>
                </div>
            </div>

            <!-- Results Panel (Hidden by default) -->
            <div class="col-lg-4 d-none" id="results-col">
                <div class="output-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0" style="color: rgba(255,255,255,0.7);">
                            <i class="fas fa-info-circle me-2"></i>نتيجة البحث
                        </h5>
                        <button class="btn btn-sm btn-outline-light" id="close-results" title="إغلاق">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div id="output"></div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container text-center">
            <p class="footer-text mb-0">
                <i class="fas fa-copyright me-1"></i>
                جميع الحقوق محفوظة لدى <span>شادي كحيل</span> - 2025
            </p>
        </div>
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
                            let carouselItems = '';
                            if (images != null) {
                                carouselItems = images.map((src, i) => `
                                <div class="carousel-item ${i === 0 ? 'active' : ''}">
                                    <img src="storage/${src}" class="d-block w-100" style="max-height: 250px; object-fit: cover;" alt="صورة">
                                </div>`).join('');
                            }
                            let pricesList = 'لا يوجد أسعار';

                            if (nearestLocation.prices) {
                                let prices = nearestLocation.prices;
                                // إذا كان string، حاول تحويله لـ JSON
                                if (typeof prices === 'string') {
                                    try {
                                        prices = JSON.parse(prices);
                                    } catch (e) {
                                        prices = null;
                                    }
                                }
                                // إذا كان object، اعرض المفاتيح والقيم
                                if (prices && typeof prices === 'object') {
                                    const priceItems = Object.entries(prices).map(([key, value]) => `<li>${key}: ${value}</li>`);
                                    if (priceItems.length > 0) {
                                        pricesList = priceItems.join('');
                                    }
                                }
                            }

                            document.getElementById('output').innerHTML = `
                                <div class="result-card">
                                    ${carouselItems ? `
                                    <div id="stationCarousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            ${carouselItems}
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#stationCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#stationCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        </button>
                                    </div>` : ''}
                                    <div class="card-body">
                                        <h5 class="card-title">${nearestLocation.name}</h5>
                                        <div class="info-item">
                                            <i class="fas fa-route"></i>
                                            <span>المسافة: <strong>${shortestDistance.toFixed(2)} كم</strong></span>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>${nearestLocation.address ?? 'العنوان غير متوفر'}</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-info-circle"></i>
                                            <span>${nearestLocation.description ?? 'لا يوجد وصف'}</span>
                                        </div>
                                        ${pricesList !== 'لا يوجد أسعار' ? `
                                        <div class="info-item" style="flex-wrap: wrap;">
                                            <i class="fas fa-tags"></i>
                                            <span>الأسعار:</span>
                                            <div class="w-100 mt-2">${pricesList.split('</li>').filter(p => p).map(p => `<span class="price-tag">${p.replace('<li>', '')}</span>`).join('')}</div>
                                        </div>` : ''}
                                    </div>
                                </div>`;
                            showResultsPanel();
                            addMarker(nearestLocation);
                            drawRoute(nearestLocation);
                        } else {
                            document.getElementById('output').innerHTML = `
                                <div class="status-message">
                                    <i class="fas fa-search text-warning"></i>
                                    <p class="mb-0">لا توجد مواقع قريبة</p>
                                </div>`;
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
                    document.getElementById('output').innerHTML = `
                        <div class="status-message success">
                            <i class="fas fa-check-circle text-success"></i>
                            <p class="mb-0">تم تحديد موقعك بنجاح!</p>
                        </div>`;
                });
            } else {
                alert("ميزة تحديد الموقع غير مدعومة.");
            }
        }

        function onGoogleMapsReady() {
            initMap();
            setMyLoc();
        }

        // دالة لإظهار لوحة النتائج
        function showResultsPanel() {
            const mapCol = document.getElementById('map-col');
            const resultsCol = document.getElementById('results-col');

            mapCol.classList.remove('col-12');
            mapCol.classList.add('col-lg-8');
            resultsCol.classList.remove('d-none');

            // إعادة رسم الخريطة بعد تغيير الحجم
            setTimeout(() => {
                google.maps.event.trigger(map, 'resize');
            }, 300);
        }

        // دالة لإخفاء لوحة النتائج
        function hideResultsPanel() {
            const mapCol = document.getElementById('map-col');
            const resultsCol = document.getElementById('results-col');

            mapCol.classList.remove('col-lg-8');
            mapCol.classList.add('col-12');
            resultsCol.classList.add('d-none');

            // مسح المسار والماركرز
            directionsRenderer.setDirections({routes: []});
            markers.forEach(m => m.setMap(null));
            markers = [];

            // إعادة رسم الخريطة
            setTimeout(() => {
                google.maps.event.trigger(map, 'resize');
                if (userLocation) {
                    map.setCenter(userLocation);
                }
            }, 300);
        }

        // زر إغلاق النتائج
        document.getElementById('close-results').addEventListener('click', hideResultsPanel);

        document.getElementById('nearest-gas-btn').addEventListener('click', () => loadStationsAndFindNearest(
            'gas_stations'));
        document.getElementById('nearest-petrol-btn').addEventListener('click', () => loadStationsAndFindNearest(
            'petrol_stations'));
        document.getElementById('nearest-fire-btn').addEventListener('click', () => loadStationsAndFindNearest(
            'fire_stations'));
    </script>
</body>

</html>
