<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <!-- تضمين مكتبة Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZE7DGzlIgMxiDhV7ebXmto5MEWs1IaXs&callback=onGoogleMapsReady" async
        defer></script>
</head>

<body style="direction: rtl;">
    <header>
        <h1 id="main-title"
            title="هذا المشروع أعد لتغطية
         الجزء العملي استكمالا لمتطلبات الحصول على درجة
         الدكتوراة في الجغرافيا (نظم المعلومات الجغرافية)">
            إستخدام نظم المعلومات

            الجغرافية (GIS) في توزيع محطات الوقود في محافظات قطاع غزة</h1>
    </header>
    <div id="sidebar">
        <button id="locate-btn"><b>تحديد موقعي</b></button>
        <button id="nearest-gas-btn"><b>تحديد أقرب محطة غاز</b></button>
        <button id="nearest-petrol-btn"><b>تحديد أقرب محطة بترول</b></button>
        <button id="nearest-fire-btn"><b>تحديد أقرب مركز دفاع مدني</b></button>
        <a id="contact-link" href="contact_us.html"><b>التواصل والدعم الفني</b></a>
    </div>
    <div id="content">
        <h2>النتيجة:</h2>
        <p id="output">حدد موقعك أولاً ثم اختر نوع المحطة.</p>

        <div id="map" style="height: 500px; width: 100%;"></div>
    </div>
    <script src="script.js"></script>
</body>
<footer><b>حقوق الطبع والنشر محفوظة لدى شادي كحيل _<b>2025</b></footer>

</html>
