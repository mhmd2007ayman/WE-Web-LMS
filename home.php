<?php

if(isset($_COOKIE['profession'])){
  if($_COOKIE['profession']=='student'){
      header('Location: ./Student/home/home.php'); 
  }
  else if($_COOKIE['profession']=='teacher'){
      header('Location: ./Teacher/homeTeacher/homeTeacher.php');
  } 
  else{
      header('Location: ./Admin/homeAdmin/homeAdmin.php');        
  }
}

?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WE Web</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<style>
    <?php  include('./redundecyCode/editCarousel.css') ?>
</style>
    <!-- خلفية الجزيئات -->
    <div id="particles-js"></div>

    <!-- شريط التقدم -->
    <div class="progress-container">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <!-- الشريط العلوي -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-laptop-code text-light"></i class="text-light"> مدرسة <span class="highlight text-light">وي</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">نبذة عنا</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">الميزات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#exams">الاختبارات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Login/login.php">تسجيل الدخول</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- القسم الرئيسي -->
    <header id="home" class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">مرحبًا بكم في <span id="typed"></span></h1>
            <p class="hero-subtitle">نحو مستقبل  متطور</p>
            <a href="#about" class="btn btn-primary btn-lg">ابدأ الرحلة</a>
        </div>
    </header>

    <!-- نبذة عنا -->
    <section id="about" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">نبذة عنا</h2>
            <div class="row">
                <div class="col-md-6">
                    <img src="Image/We.jpg" alt="عن المدرسة" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <p class="lead about-text">
                        مدرسة وي للتكنولوجيا التطبيقية هي مدرسة تعليمية رائدة تهدف إلى تمكين الطلاب من خلال تقديم تدريب و دراسة سوق العمل . و دورات تدريبية متخصصة في مجالات التكنولوجيا الحديثة. نقدم بيئة تعليمية تفاعلية مع معلمين ذوي خبرة عالية.
                    </p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check-circle text-primary"></i> فصول تفاعلية مباشرة</li>
                        <li><i class="fas fa-check-circle text-primary"></i> دورات تدريبية متخصصة</li>
                        <li><i class="fas fa-check-circle text-primary"></i>تعليم عالي الجوده</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- الميزات -->
    <section id="features" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">مميزاتنا</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card feature-card">
                        <div class="card-body text-center">
                            <i class="fas fa-chalkboard-teacher fa-3x mb-3"></i>
                            <h5 class="card-title">فصول تفاعلية</h5>
                            <p class="card-text">فصول دراسية تفاعلية مع معلمين ذوي خبرة.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card">
                        <div class="card-body text-center">
                            <i class="fas fa-video fa-3x mb-3"></i>
                            <h5 class="card-title">دروس مسجلة</h5>
                            <p class="card-text">يمكنك الوصول إلى الدروس المسجلة في أي وقت.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card">
                        <div class="card-body text-center">
                            <i class="fas fa-comments fa-3x mb-3"></i>
                            <h5 class="card-title">تواصل مباشر</h5>
                            <p class="card-text">تواصل مع المعلمين بسهولة للحصول على الدعم.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- الاختبارات -->
    <section id="exams" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">الاختبارات</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="card exam-card">
                        <div class="card-body">
                            <h5 class="card-title">اختبارات تفاعلية</h5>
                            <p class="card-text">اختبارات تفاعلية مع تصحيح فوري لقياس مستوى فهمك.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card exam-card">
                        <div class="card-body">
                            <h5 class="card-title">تقارير أداء</h5>
                            <p class="card-text">احصل على تقارير مفصلة عن أدائك في الاختبارات.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- التواصل -->
    <section id="contact" class="py-5 bg-light">
    <?php  include('./redundecyCode/carsoulside2.php') ?>
    </section>

    <!-- زر العودة إلى الأعلى -->
    <button id="scrollToTopBtn" class="btn btn-primary">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- تذييل الصفحة -->
    <footer class="bg-dark text-white text-center py-3">
        <p>جميع الحقوق محفوظة &copy; <?php echo date('Y') ?> مدرسة وي للتكنولوجيا التطبيقية</p>
    </footer>

    <!-- مكتبات JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <script src="scripts.js"></script>
</body>
</html>