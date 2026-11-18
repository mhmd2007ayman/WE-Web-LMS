<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "../Uploud_image/";
    $file_extension = pathinfo($_FILES["uploadfile"]["name"], PATHINFO_EXTENSION); 
    $file_name = $_COOKIE['email'] . "_" . "ImageAcount" . "." . $file_extension; 

    $target_file = $target_dir . $file_name; 
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);  
    }
    $existing_files = glob($target_dir . $_COOKIE['email']. "_" . "ImageAcount" . '.*');  
    if ($existing_files) {
        foreach ($existing_files as $existing_file) {
            unlink($existing_file);  
        }
    }

    // محاولة نقل الملف إلى المسار الجديد
    if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_file)) {
        include('../../redundecyCode/connection.php');
        $email = $_COOKIE['email']; 
        $image = $target_file; 

        $sql = "UPDATE users SET image_Acount = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $image, $email);
        $expire_time = time() + (7 * 24 * 60 * 60); 
        setcookie("image",$image,$expire_time, "/");
        $stmt->execute();
        $stmt->close();
        $conn->close();
    } else {
        echo "Error uploading file. Error code: " . $_FILES["uploadfile"]["error"];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='home.css'>
    <?php include('../../redundecyCode/linkBootstrap2.php') ?>
    <title>Student Page</title>
</head>
<body class='x'>
    <?php  include('../../redundecyCode/navbarStudent.php') ?>

    <div class="rounded bg-dark d-flex mt-4 ms-2 Mh flex-row justify-content-end">
    <p id="NameAcount" style=" color: white;font-size: 25px;margin: 9px ;"><?php echo $_COOKIE['userName']?></p>
    <p style=" color: white;font-size: 25px;margin: 9px ;" class="ms-2">مرحبا</p>
    <form action="" method='POST' enctype="multipart/form-data">
      <label for="file" hidden>File name:</label>
      <input type="file" name="uploadfile" hidden id="bmb">
      <input type="submit" name="submit" value="Upload" id='vve' hidden>
    </form>

         <div class="nn">
             <img src="<?php 
                     include('../../redundecyCode/connection.php');
             $email = $_COOKIE['email']; 
             $sql = "SELECT image_Acount FROM users WHERE email = ?";

             $stmt = $conn->prepare($sql);
             $stmt->bind_param("s", $email);
             $stmt->execute();
             
             // تخزين النتيجة
             $stmt->bind_result($img);

             $stmt->fetch();

// التحقق إذا كانت الصورة NULL
if ($img === NULL) {
    echo "../../Image/user.png"; // إذا كانت قيمة img NULL
} else {
    echo $img; // إذا كانت هناك صورة، عرضها
}

              
             ?>" alt="" id="imgAcount" style="width: 100%;">
        </div>

       
    </div>
    <h2 class="  text-light  bg-dark high mt-4 mb-4  rounded d-flex m-auto justify-content-center w-50 ">أخبار المدرسه</h2>  


    <div class="carousel slide mt-1 border-warning" id="c2" style="padding: 9px;">
    <div class="carousel-inner" id="car">
        <?php
            include('../../redundecyCode/connection.php');
            $sql = "SELECT title, content, publish, created_at, expires_at FROM news";
            $result = $conn->query($sql);
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $conn->close();

            // التكرار على البيانات لإظهار كل شريحة
            foreach ($data as $index => $newsItem) {
                // إذا كانت هذه هي أول شريحة، نضيف الكلاس 'active'
                $itemClass = ($index === 0) ? 'carousel-item active' : 'carousel-item';
                
                // تنسيق التاريخ باستخدام PHP (إزالة الوقت)
                $createdAt = date('Y-m-d', strtotime($newsItem['created_at']));
                $publish = date('Y-m-d', strtotime($newsItem['publish']));
        ?>
                <div class="<?= $itemClass ?>">
                    <div class="news-item">
                        <h2><?= htmlspecialchars($newsItem['title']) ?></h2>
                        <p><?= htmlspecialchars($newsItem['content']) ?></p>
                        <div class="date d-flex flex-direction-row gap-2">
                            <p class="date">تاريخ البدء :-</p>
                            <p class="date"><?= $createdAt ?></p>
                        </div>
                        <div class="date d-flex flex-direction-row gap-2">
                            <p class="date">تاريخ النشر :-</p>
                            <p class="date"><?= $publish ?></p>
                        </div>
                    </div>
                </div>
        <?php
            }
        ?>
    </div>
    <!-- عناصر التنقل بين الشرائح -->
    <button class="carousel-control-prev" type="button" data-bs-target="#c2" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">السابق</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#c2" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">التالي</span>
    </button>
</div>


    <div class="  container-fluid   mt-4" >
         <div class="  row  row-col-sm-2 gap-2  mt-2  justify-content-around ">
            <!-- <div class="present card bg-dark col-sm-6 col-md-4 ">
                <img class="card-img top img" src="../../Image/school.svg">
                <div class="card-body">
                    <h2 class="card-title text-warning direct">التقديم</h2>
                    <p class="card-text text-light direct2">مدرسة وي المنيا توجد في المنيا الجديده .وهناك شروط للتقديم في المدرسة </p>
                    <a href="../present/present.php" class="btn btn-danger">رؤية المزيد</a>
                </div>
    
            </div> -->
    
            <div class="present bg-dark col-sm-6 col-md-4 ">
                <img src="../../Image/Courses.svg" class="card-img top img">
                <div class="card-body">
                    <h2 class="card-title text-warning direct">الدورات التدربيه</h2>
                    <p class="card-text text-light direct2">هناك العديد من الدورات التدريبية لتنمية التخصص</p>
                    <a href="../Courses/Courses.php" class="btn btn-danger">رؤية المزيد</a>
                </div>
    
            </div>
    
            <div class="present bg-dark col-sm-12 col-md-4 ">
                <img src="../../Image/logo-WE-Web.png" class="card-img top img imd " style="height: 10em">
                <div class="card-body">
                    <h2 class="card-title text-warning direct">الفصول و الدروس</h2>
                    <p class="card-text text-light direct2">فصولك و دروسك ماذا ارسل المدرسين</p>
                    <a href="../ClassRoom/classRoom.php" class="btn btn-danger">رؤية المزيد</a>
                </div>
    
                
            </div>
    
    
    
    
        </div>


    
<?php  include('../../redundecyCode/carsoulside.php') ?>
<?php include('../../redundecyCode/footer.php') ?>
<?php include('../../redundecyCode/linkBootstrapJs.php') ?>

<script src='home.js'></script>
    </body>
</html>