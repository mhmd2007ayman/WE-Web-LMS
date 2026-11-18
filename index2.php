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
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles.css" />
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <title>welcome</title>
  </head>
  <body>
    <nav>
      <div class="nav__logo"><a href="">WE WEB</a></div>
      <ul class="nav__links">
        <li class="link"><a href="./Login/login.php" class="nav__btn">Register</a></li>
      </ul>
    </nav>
    <section class="container">

      <div class="image__container d-none d-sm-block">
        <img src="assets/header-2.png" class="img2" alt="header" />

      </div> 

      <div class="content__container">
        <h1 style="direction: rtl;">
          مدرسة<br />
          <span class="heading__1"> وي للتكنلوجيا التطبيقيه</span><br />
          <span class="heading__2">بالمنيا الجديده</span>
        </h1>

          <p class="ul textb textsize" style="direction: rtl;">
             يحصل خريجو مدارس وي بعد <span class="bg-warning text-dark rounded">ثلاث سنوات </span class="bg-warning text-dark rounded">علي شهادة الدبلوم الفني في تخصصات  <span class="bg-warning text-dark rounded">اتصالات,تطوير المواقع و البرمجيات وشبكات</span> و اللتي تؤهلهم للالتحاق بالكليات التكنولوجية و معاهد وكليات التعليم الصناعي و كليات الهندسة بعداجتياز<span class="bg-warning text-dark rounded">المعادلة</span>
           

        </p>

      </div>

    </section>


    <br>

    <section class="container">

      <div class="image__container d-none d-sm-block">
        <img src="assets/header-1.png" alt="header" />
      </div> 

      <div class="content__container">
        <h1 style="direction: rtl;">
          مصاريف<br />
          <span class="heading__1">مدرسة وي للتكنلوجيا التطبيقية</span><br />
        </h1>

        <ul class="ul" style="direction: rtl;">
          <li class="textsize">السنة الأولي :-<span class="bg-warning text-dark rounded"> 6000 جنيه مصري</span></li>
          <li class="textsize">السنة الثانية :-<span class="bg-warning text-dark rounded"> 7000 جنيه مصري</span></li>
          <li class="textsize">السنة الثالثة :-<span class="bg-warning text-dark rounded"> 8000 جنيه مصري</span></li>

      </ul>
      </div>

    </section>


    <br>


    <section class="container">

      <div class="image__container d-none d-sm-block">
        <img src="assets/header-3.png" style="top: -9%;" alt="header" />
      </div> 

      <div class="content__container">
        <h1 style="direction: rtl;">
          متطلبات<br />
          <span class="heading__1">مدرسة وي للتكنلوجيا التطبيقية</span><br />
        </h1>

        <ul class="ul" style="direction: rtl;">
          <li class="textsize">أن يكون الطالب مصري الجنسية</li>
          <li class="textsize">أن لا يتعدي عمره الثمانية عشر من عمره</li>
          <li class="textsize">ألا يزيد سن الطالب عن 18 عاما </li>
          <li class="textsize">أن يجتاز الطالب اختبارات القبول اللتي تحددها المدرسة</li>
          <li class="textsize">أن يكون لائقا طبيا</li>
      </ul>
      </div>

    </section>


    <section class="container">

      <div class="image__container d-none d-sm-block">
        <img src="assets/header-3.png" style="top: -9%;" alt="header" />
      </div> 

      <div class="content__container">
        <h1 style="direction: rtl;">
          لتسجيل<br />
          <span class="heading__1">الدخول</span><br />
        </h1>

        <a href="./Login/login.php" class="btn btn-info">Register</a>
      </div>

    </section>
  </body>
</html>
