<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التواصل والدعم الفني - GIS Navigator</title>
    <link rel="shortcut icon" href="{{ asset('assets/icon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --dark-bg: #0f0f1a;
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
                radial-gradient(at 80% 50%, rgba(118, 75, 162, 0.1) 0px, transparent 50%);
            min-height: 100vh;
            color: #fff;
        }

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
            text-decoration: none;
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

        .page-title {
            text-align: center;
            padding: 3rem 0 2rem;
        }

        .page-title h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .page-title h1 span {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-title p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 1.1rem;
        }

        .contact-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .contact-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: var(--primary-gradient);
            border-radius: 26px;
            z-index: -1;
            opacity: 0.3;
        }

        .form-label {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            color: #fff;
            padding: 0.875rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
            color: #fff;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.4);
        }

        .input-icon input,
        .input-icon textarea {
            padding-right: 3rem;
        }

        .submit-btn {
            background: var(--primary-gradient);
            border: none;
            border-radius: 50px;
            color: #fff;
            font-size: 1.1rem;
            font-weight: 600;
            padding: 1rem 3rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            width: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
            color: #fff;
        }

        .submit-btn i {
            margin-left: 0.5rem;
        }

        .alert-custom {
            background: rgba(34, 197, 94, 0.15);
            border: 1px solid rgba(34, 197, 94, 0.3);
            border-radius: 12px;
            color: #22c55e;
            padding: 1rem;
            text-align: center;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .contact-info {
            margin-top: 2rem;
        }

        .info-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .info-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-blue);
        }

        .info-card i {
            font-size: 2rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .info-card h5 {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .info-card p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            margin: 0;
        }

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
            margin: 0;
        }

        .footer-text span {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }

        @media (max-width: 768px) {
            .page-title h1 {
                font-size: 1.75rem;
            }

            .contact-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="main-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('home') }}" class="logo-text">
                    <i class="fas fa-map-marked-alt me-2"></i>GIS Navigator
                </a>
                <a href="{{ route('home') }}" class="nav-btn">
                    <i class="fas fa-home me-2"></i>الصفحة الرئيسية
                </a>
            </div>
        </div>
    </header>

    <!-- Page Title -->
    <div class="page-title">
        <div class="container">
            <h1><i class="fas fa-headset me-3"></i><span>تواصل معنا</span></h1>
            <p>نحن هنا لمساعدتك! أرسل لنا رسالتك وسنرد عليك في أقرب وقت</p>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="contact-card">
                    @if (session('message'))
                        <div class="alert-custom mb-4">
                            <i class="fas fa-check-circle me-2"></i>{{ session('message') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('messages.store') }}">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user me-2"></i>الاسم الكامل
                                </label>
                                <div class="input-icon">
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="أدخل اسمك الكامل" required>
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>البريد الإلكتروني
                                </label>
                                <div class="input-icon">
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="example@email.com" required>
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="message" class="form-label">
                                    <i class="fas fa-comment-alt me-2"></i>رسالتك
                                </label>
                                <div class="input-icon">
                                    <textarea id="message" name="message" class="form-control" rows="6"
                                        placeholder="اكتب رسالتك هنا... نحن نقدر ملاحظاتك واستفساراتك" required></textarea>
                                    <i class="fas fa-comment-alt" style="top: 1.5rem; transform: none;"></i>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="submit-btn">
                                    <i class="fas fa-paper-plane"></i>
                                    إرسال الرسالة
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Contact Info Cards -->
                <div class="contact-info">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="info-card">
                                <i class="fas fa-map-marker-alt"></i>
                                <h5>الموقع</h5>
                                <p>قطاع غزة، فلسطين</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-card">
                                <i class="fas fa-clock"></i>
                                <h5>ساعات العمل</h5>
                                <p>24/7 دعم فني متواصل</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-card">
                                <i class="fas fa-envelope"></i>
                                <h5>البريد الإلكتروني</h5>
                                <p>support@gis-navigator.ps</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container text-center">
            <p class="footer-text">
                <i class="fas fa-copyright me-1"></i>
                جميع الحقوق محفوظة لدى <span>شادي كحيل</span> - 2025
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
