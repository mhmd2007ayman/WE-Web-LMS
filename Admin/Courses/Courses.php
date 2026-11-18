<?php
$active = 'Courses';
include('../../redundecyCode/connection.php');

if (isset($_POST['upload'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $NameTeacher = $_POST['NameTeacher'];
    $description = $_POST['description'];
    
    // إنشاء مجلد باسم الدورة
    $dir = $title . "_" . time();
    $uploadDir = "../../uploadsCourse/$dir";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // ✔️ رفع صورة الغلاف
    $imagePath = "";
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . basename($_FILES['image']['name']);
        $imagePath = $uploadDir . "/" . $imageName;
        $imageType = $_FILES['image']['type'];
        $imageSize = $_FILES['image']['size'];

        // التحقق من نوع وحجم الصورة
        $allowedImageTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        if (in_array($imageType, $allowedImageTypes) && $imageSize < 300 * 1024 * 1024) { // الحد الأقصى 300MB
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                echo "<script type='module'>
                import { success } from '../../Toster/toster.js';
                success('تم رفع الصورة بنجاح');
                </script>";
            } else {
                echo "<script type='module'>
                import { error } from '../../Toster/toster.js';
                error('فشل في رفع الصورة');
                </script>";
                $imagePath = "";
            }
        } else {
            echo "<script type='module'>
            import { warning } from '../../Toster/toster.js';
            warning('الصورة كبيرة جدًا أو نوعها غير مدعوم');
            </script>";
            $imagePath = "";
        }
    }

    // ✔️ رفع الفيديوهات
    if (!empty($_FILES['videos']['name'][0])) {
        $total = 0;
        $videos = [];  // مصفوفة لتخزين بيانات الفيديوهات
        foreach ($_FILES['videos']['tmp_name'] as $key => $tmp_name) {
            $fileName = $_FILES['videos']['name'][$key];
            $fileTmp = $_FILES['videos']['tmp_name'][$key];
            $fileSize = $_FILES['videos']['size'][$key];
            $fileType = $_FILES['videos']['type'][$key];

            // التحقق من نوع وحجم الفيديو
            $allowedVideoTypes = ['video/mp4', 'video/avi', 'video/mov', 'video/mkv'];
            if (!in_array($fileType, $allowedVideoTypes)) {
                echo "<script type='module'>
                import { warning } from '../../Toster/toster.js';
                warning('أحد الفيديوهات ليست بصيغة الفيديو المدعومة');
                </script>";
                continue;
            }
            if ($fileSize > 400 * 1024 * 1024) { // الحد الأقصى 400MB
                echo "<script type='module'>
                import { warning } from '../../Toster/toster.js';
                warning('الفيديو كبير جدًا');
                </script>";
                continue;
            }
            require_once '../../vendor/autoload.php';
            $getID3 = new getID3;
            $filePath = $uploadDir . "/" . time() . "_" . basename($fileName);
            $course_id = $title . '_' . time();

            if (move_uploaded_file($fileTmp, $filePath)) {
                    // الحصول على مدة الفيديو باستخدام ffprobe
                    $videoInfo = $getID3->analyze($filePath);
                $duration = isset($videoInfo['playtime_seconds']) ? $videoInfo['playtime_seconds'] : 'Unknown';
                $minutes = floor($duration / 60); 
               $seconds = round($duration % 60); 

                    // تنسيق المدة كـ "دقائق:ثواني"
                   $formattedDuration = sprintf("%02d:%02d", $minutes, $seconds);

                    
                    // إضافة الفيديو إلى المصفوفة
                    $video = [
                        'path' => $filePath,
                        'id' => $key + 1,  // زيادة الـ id بشكل صحيح باستخدام المفتاح من المصفوفة
                        'title' => $fileName,
                        'duration' => $formattedDuration,
                    ];
                    $videos[] = $video;
                   $total += $duration;
            }
        }

        // تحويل المصفوفة إلى JSON
    }
    $encode = json_encode($videos,true);

    $total_minutes = floor($total / 60); 
    $total_seconds = round($total % 60); 
    $totalformattedDuration = sprintf("%02d:%02d", $total_minutes, $total_seconds);

    $stmt = $conn->prepare("INSERT INTO courses (title, description, Price, image , course_id ,Files , duration ,NameTeacher) VALUES (?, ?, ?, ?,?,?,?,?)");
    $stmt->bind_param("ssssssss", $title, $description, $price, $imagePath, $course_id, $encode ,$totalformattedDuration , $NameTeacher);

    if ($stmt->execute()) {
        echo "<script type='module'>
                import { success } from '../../Toster/toster.js';
                success('تم رفع الدورة التدريبية بنجاح');
            </script>";
    } else {
        echo "<script type='module'>
                import { error } from '../../Toster/toster.js';
                error('خطأ في رفع الدورة التدريبية');
            </script>";
    }
    $stmt->close();

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include('../../redundecyCode/linkBootstrap2.php') ?>
<link rel="stylesheet" href="http://localhost/WE_Web%20(Update)/redundecyCode/editNavAdminn.css">
<link rel="stylesheet" href="../../Toster/toster.css">
<link rel="stylesheet" href="Courses.css">
<title>رفع الدورة التدريبية</title>
</head>
<body>

<?php include('../../redundecyCode/navbarAdmin.php') ?> 
<br>
<br>
<br>
<br>

<div class="notifications"></div>
<div class='container'>
    <h2 class='d-flex justify-content-center '>💻 رفع الدورة التدريبية</h2>
    <form action="" method="POST" enctype="multipart/form-data" class='d-flex flex-column justify-content-center p-5 gap-3'>
        <div class='d-flex gap-1 justify-content-end'><span>-: 📚</span><label for="title">إسم الدورة التدريبية</label></div>
        <input type="text" class='inputText' name='title' required oninput="changeTextDirection()">
        
        <div class='d-flex gap-1 justify-content-end'><span>-: 🌐</span><label for="description">وصف الدورة التدريبية</label></div>
        <input type="text" class='inputText' name='description' required oninput="changeTextDirection()">

        <div class='d-flex gap-1 justify-content-end'><span>-: 🎓</span><label for="NameTeacher">معلم الدورة التدريبية</label></div>
        <input type="text" class='inputText' name='NameTeacher' required oninput="changeTextDirection()">

        <div class='d-flex gap-1 justify-content-end'><span>-: 💵</span><label for="price">سعر الدورة التدريبية</label></div>
        <input type="number" name='price' required>

        <div class='d-flex gap-1 justify-content-end'><span>-: 🎨</span><label for="image">صورة الغلاف</label></div>        
        <input type="file" name='image' class="form-control" accept="image/*">

        <div class='d-flex gap-1 justify-content-end'><span>-: 🎥</span><label for="image">رفع الفيديوهات</label></div>                
        <input type="file" name="videos[]" class="form-control" multiple accept="video/*">
        
        <button class='btn btn-primary' type='submit' name="upload"> رفع الدورة</button>
    </form>
</div>
<?php include('../../redundecyCode/linkBootstrapJs.php') ?>
<script src='Courses.js'></script>
<script type='module' src="../../Toster/toster.js" defer></script>
</body>
</html>

