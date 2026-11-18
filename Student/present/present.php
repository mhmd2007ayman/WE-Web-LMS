<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // الحصول على البيانات من الفورم
    $nameStudent = $_POST['nameStudent'];
    $Date = $_POST['Date'];
    $NationalNumber = $_POST['NationalNumber'];
    $sex = $_POST['sex'];
    $where = $_POST['where'];
    $phone = $_POST['phone'];
    $NaionalParent = $_POST['NaionalParent'];
    $School = $_POST['School'];

    // التعامل مع الصور باستخدام $_FILES
    $img1 = $_FILES['file'];
    $img2 = $_FILES['file2'];
    $img3 = $_FILES['file3'];

    // تحقق من المدخلات
    if(empty($nameStudent)){
        echo "<script type='module'>import { warning } from '../../Toster/toster.js'; warning('لا تترك خانة الاسم فارغه');</script>";
    }
    else if(empty($Date)){
        echo "<script type='module'>import { warning } from '../../Toster/toster.js'; warning('لا تترك خانة الميلاد فارغه');</script>";
    }
    else if($Date > date('Y-m-d')){
        echo "<script type='module'>import { warning } from '../../Toster/toster.js'; warning('اكتب تاريخ الميلاد بشكل صحيح');</script>";
    }
    else {
        // حساب العمر من تاريخ الميلاد
        $birthDate = new DateTime($Date);
        $today = new DateTime();
        $age = $today->diff($birthDate)->y;

        if ($age < 15) {
            echo "<script type='module'>import { warning } from '../../Toster/toster.js'; warning('يجب أن يكون العمر 15 سنة أو أكثر');</script>";
        }
        else if(empty($NationalNumber)){
            echo "<script type='module'>import { warning } from '../../Toster/toster.js'; warning('لا تترك خانة الرقم القومي فارغه');</script>";
        }
        else if(strlen($NationalNumber) < 14){
            echo "<script type='module'>import { warning } from '../../Toster/toster.js'; warning('الرقم القومي يجب أن يتكون من 14 رقم');</script>";
        }
        else if(empty($where)){
            echo "<script type='module'>import { warning } from '../../Toster/toster.js'; warning('لا تترك خانة العنوان و محل الاقامه فارغه');</script>";
        }
        else if(empty($phone)){
            echo "<script type='module'>import { warning } from '../../Toster/toster.js'; warning('لا تترك خانة رقم هاتف ولي الامر فارغه');</script>";
        }
        else if(strlen($phone) != 11){
            echo "<script type='module'>import { warning } from '../../Toster/toster.js'; warning('رقم الهاتف يجب أن يتكون من 11 رقم');</script>";
        }
        else if(empty($NaionalParent)){
            echo "<script type='module'>import { warning } from '../../Toster/toster.js'; warning('لا تترك خانة الرقم القومي لولي الامر فارغه');</script>";
        }
        else if(strlen($NaionalParent) < 14){
            echo "<script type='module'>import { warning } from '../../Toster/toster.js'; warning('الرقم القومي لولي الامر يجب أن يتكون من 14 رقم');</script>";
        }
        else if(empty($School)){
            echo "<script type='module'>import { warning } from '../../Toster/toster.js'; warning('لا تترك خانة المدرسة فارغه');</script>";
        }
        else if(empty($img1) || empty($img2) || empty($img3)){
            echo "<script type='module'>import { warning } from '../../Toster/toster.js'; warning('لا تترك الصورة فارغه');</script>";
        }
        else {
            // تحقق من حجم الصور (لا يتجاوز 2MB)
            $max_size = 2 * 1024 * 1024; // 2MB
            if ($img1['size'] > $max_size || $img2['size'] > $max_size || $img3['size'] > $max_size) {
                echo "<script type='module'>import { warning } from '../../Toster/toster.js'; warning('حجم الصورة يجب أن يكون أقل من 2MB');</script>";
            } 
            // تحقق من نوع الملفات (يجب أن تكون صور PNG فقط)
            $allowed_types = ['image/png'];
            if (!in_array(mime_content_type($img1['tmp_name']), $allowed_types) || !in_array(mime_content_type($img2['tmp_name']), $allowed_types) || !in_array(mime_content_type($img3['tmp_name']), $allowed_types)) {
                echo "<script type='module'>import { warning } from '../../Toster/toster.js'; warning('الصورة يجب أن تكون من نوع PNG');</script>";
            } 
            else {
                // هنا يمكنك إضافة كود حفظ الصور في المجلد المناسب
                // مثال:
                // move_uploaded_file($img1['tmp_name'], 'path/to/your/upload/folder/' . $img1['name']);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../../redundecyCode/linkBootstrap2.php') ?>
    <link rel="stylesheet" href="present.css">
    <title>التقديم</title>
</head>
<body class="mb-5">
    
<?php include('../../redundecyCode/navbarStudent.php') ?>

<form action="" method='POST' enctype="multipart/form-data">
<div class="d-flex flex-row header3 m-auto">
    <h2 class="text-light bg-dark high mt-4 mmd "> بيانات الطالب</h2>

    <div class="d-flex flex-row header3 m-auto">
        <input type="file" name='file' id="file2" accept="image/png" hidden>
        <div class="img-area2" data-img="" id="imgg2" date-id="">
            <div class="img-areaH2" data-img="" id="img-areaH2" hidden></div>
        </div>
        <div class="d-flex flex-column col-6">
            <label for="file2" class="d-flex justify-content-center justify-content-end mt-2 mb-2 text-warning fs-5">صورة للطالب </label>
            <a class="select-image2 btn">Select Image</a>
        </div>
    </div>
</div>

<div class="d-flex row w-75 border-warning rounded m-auto mt-5 form" id="form">
    <div class="col-md-12 col-xs-12">
        <label for='nameStudent' class="col-12 m-end d-flex justify-content-end mt-2 mb-2 text-warning fs-5">اسم الطالب رباعي</label>
        <input type="text" class="col-12 d-flex justify-content-end rounded-pill texMo" id="name" name='nameStudent'>
    </div>

    <div class="col-md-6 col-xs-12">
        <label for='Date' class="col-12 m-end d-flex mt-2 mb-2 justify-content-end text-warning fs-5">تاريخ الميلاد</label>
        <input type="date" id="birthday" class="col-12" required name='Date'>
    </div>

    <div class="col-md-6 col-xs-12">
        <label for='NationalNumber' class="col-12 d-flex justify-content-end justify-content-end mt-2 mb-2 text-warning fs-5">الرقم القومي للطالب</label>
        <input type="number" maxlength="14" class="col-12 rounded-pill texMo" id="numN" name='NationalNumber'>
    </div>

    <div class="col-md-6 col-xs-12">
        <label for='sex' class="col-12 m-end d-flex mt-2 mb-2 justify-content-end text-warning fs-5">الجنس</label>
        <select name="sex" id="sel" class="col-12 d-flex justify-content-end">
            <option value="ff">حدد</option>
            <option value="male">ذكر</option>
            <option value="female">انثي</option>
        </select>
    </div>

    <div class="col-md-6 col-xs-12">
        <label for='where' class="col-12 d-flex justify-content-end justify-content-end mt-2 mb-2 text-warning fs-5">العنوان ومحل الإقامة</label>
        <input type="text" class="col-12 rounded-pill texMo" id="p" maxlength="35" name='where'>
    </div>

    <div class="col-md-12 col-xs-12">
        <label for='nameParent' class="col-12 d-flex justify-content-end justify-content-end mt-2 mb-2 text-warning fs-5">اسم ولي الامر رباعي</label>
        <input type="text" class="col-12 rounded-pill texMo" id="nameP" name='nameParent'>
    </div>

    <div class="col-md-6 col-xs-12">
        <label for='NaionalParent' class="col-12 d-flex justify-content-end justify-content-end mt-2 mb-2 text-warning fs-5">الرقم القومي لولي الامر</label>
        <input type="number" maxlength="14" class="col-12 rounded-pill texMo" id="numP" name='NaionalParent'>
    </div>

    <div class="col-md-6 col-xs-12">
        <label for='School' class="col-12 d-flex justify-content-end justify-content-end mt-2 mb-2 text-warning fs-5">المدرسة الخاصة به</label>
        <input type="text" class="col-12 rounded-pill texMo" id="school" maxlength="20" name='School'>
    </div>

    <div class="col-md-6 col-xs-12">
        <label for='phone' class="col-12 d-flex justify-content-end justify-content-end mt-2 mb-2 text-warning fs-5">رقم هاتف ولي الأمر</label>
        <input type="number" class="col-12 rounded-pill texMo" id="phone" maxlength="11" name='phone'>
    </div>

    <div class='row'>
        <div class='col-6'>
            <label for="file2" class="col-12 d-flex justify-content-center justify-content-end mt-2 mb-2 text-warning fs-5">صورة شهادة الميلاد</label>
            <div class="container">
                <input type="file" id="file" name='file2' accept="image/png" hidden>
                <div class="img-area" data-img="" id="imgg1">
                    <h3>Upload Image</h3>
                    <p>Image size must be less than <span>2MB</span></p>
                    <div class="img-areaH" id="img-areaH" hidden></div>
                </div>
                <a class="select-image btn">Select Image</a>
            </div>
        </div>

        <div class='col-6'>
            <label for="file3" class="col-12 d-flex justify-content-center justify-content-end mt-2 mb-2 text-warning fs-5">صورة من بطاقة ولي الامر</label>
            <div class="container">
                <input type="file" name='file3' id="file3" accept="image/png" hidden>
                <div class="img-area3" data-img="" id="imgg3">
                    <h3>Upload Image</h3>
                    <p>Image size must be less than <span>2MB</span></p>
                    <div class="img-areaH3" id="img-areaH3" hidden></div>
                </div>
                <a class="select-image3 btn">Select Image</a>
            </div>
        </div>
    </div>

    <div class="d-flex flex-row-reverse col-12 justify-content-between">
        <button type="submit" class="Next btn btn-danger text-light rounded border-danger mt-2 d-flex justify-content-center col-2" id="Next1">تم</button>
        <p class="text-danger" style="font-size: x-large;" id="prob"></p>
    </div>
</div>

<script src='pre.js'></script>
<?php include('../../redundecyCode/linkBootstrapJs.php') ?>
</body>
</html>
