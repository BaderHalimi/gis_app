<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التواصل والدعم الفني</title>
    <link rel="shortcut icon" href="{{ asset('assets/icon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-light d-flex flex-column min-vh-100">

    <header class="container my-4">
        <nav class="d-flex justify-content-between align-items-center">
            <a href="index.html" class="btn btn-outline-light">الصفحة الرئيسية</a>
            <h1 class="h5 m-0 text-center flex-grow-1">
                استخدام نظم المعلومات الجغرافية في توزيع وايجاد محطات الوقود في محافظات قطاع غزة
            </h1>
        </nav>
    </header>

    <main class="container flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card bg-light text-dark shadow mb-4">
                    <div class="card-body">
                        <h2 class="card-title text-center text-dark mb-4">💬 التواصل والدعم الفني</h2>
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">الاسم</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="أدخل اسمك" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="أدخل بريدك الإلكتروني" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">الرسالة</label>
                                <textarea id="message" name="message" class="form-control" rows="6" placeholder="أدخل رسالتك" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-danger w-50">إرسال</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card bg-light text-dark shadow">
                    <div class="card-body">
                        <h3 class="text-center text-dark mb-3">📋 سجل الرسائل</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-center align-middle">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>الرسالة</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <!-- الصفوف ستضاف ديناميكياً -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <footer class="text-center py-3 mt-auto">
        <strong class="badge bg-secondary">حقوق الطبع والنشر محفوظة لدى شادي كحيل - <span>2025</span></strong>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="moh.js"></script>
</body>

</html>
