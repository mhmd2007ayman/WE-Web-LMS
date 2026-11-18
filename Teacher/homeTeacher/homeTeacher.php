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

        $sql2 = "UPDATE classroom SET image_Acount = ? WHERE email = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("ss", $image, $email);
        $stmt2->execute();

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
    <?php include('../../redundecyCode/linkBootstrap2.php')  ?>
    <link rel="stylesheet" href="../../redundecyCode/editCarousel.css">
    <link rel="stylesheet" href="homeTeacherr.css">
    <title>Home Teacher</title>
</head>
<body>
<?php   include('../../redundecyCode/navbarTeacher.php') ?>



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
    }   else {
            echo $img; // إذا كانت هناك صورة، عرضها
    }

                
?>" alt="" id="imgAcount" style="width: 100%;">
</div>

        
</div>


    <div class="  container-fluid   mt-4" >
        <div class="  row  row-col-sm-2 gap-2  mt-2  justify-content-around ">
            <div class="present card bg-dark col-sm-6 col-md-4 ">
                <img class="card-img top img" src="../../Image/teach.jpg">
                <div class="card-body">
                    <h2 class="card-title text-warning">الاختبارات</h2>
                    <p class="card-text text-light">صناعة الاختبارات</p>
                    <a href="../welcomecreateTest/welcome.php" class="btn btn-danger">رؤية المزيد</a>
                </div>
    
            </div>
    

    
            <div class="present bg-dark col-sm-12 col-md-4 ">
                <img src="../../Image/logo-WE-Web.png" class="card-img top img2" style="height: 10em">
                <div class="card-body">
                    <h2 class="card-title text-warning nnde">الفصول و الدروس</h2>
                    <p class="card-text text-light">ارسال الطلاب للواجبات الدراسيه </p>
                    <a href="../ClassRoom/ClassRoom.php" class="btn btn-danger">رؤية المزيد</a>
                </div>
    
                
            </div>
    
    
    
    
        </div>
    </div>

<?php  include('../../redundecyCode/carsoulside.php')  ?>

<!---->

    </div>
    </div>
    <?php include('../../redundecyCode/footer.php') ?>    
    <?php include('../../redundecyCode/linkBootstrapJs.php') ?>
    <script src="homeTeacher.js"></script>
</body>
</html>