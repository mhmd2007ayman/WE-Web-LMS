<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include('../../redundecyCode/linkBootstrap2.php') ?>
<link rel="stylesheet" href='../../Student/present/present.css'>
    <link rel="stylesheet" href="blogTeacher.css">
    <!-- <link rel="stylesheet" href="/style2e.css"> -->
    <title>تقديم بيانات</title>
</head>
<body>
  <?php  include('../../redundecyCode/navbarTeacher.php') ?>  
    <div class="d-flex flex-row header3 m-auto">
        <h2 class="text-light  bg-dark high mt-4 mmd "> بيانات المعلم</h2>
    
        <div class="d-flex flex-row   header3 m-auto">
            <input type="file" id="file2" accept="image/png" hidden>
           <div class="img-area2" data-img="" id="imgg2" date-id="">
               <div class="img-areaH2"data-img="" id="img-areaH2" hidden></div>
           </div>
           <div class="d-flex flex-column col-6 ">
            <label for="" class=" d-flex justify-content-center justify-content-end mt-2 mb-2  text-warning fs-5">صورة للمعلم </label>
            <button class="select-image2" id="ff">Select Image</button>
           </div>
    
    
         </div>
    
    
    
    </div>
<form  method="post"  id="form">
    <div class="d-flex row w-75 border-warning rounded m-auto mt-5 form">
            <div class="col-md-12 col-xs-12">
                <label for="nameT" class="col-12 m-end  d-flex justify-content-end mt-2 mb-2  text-warning fs-5">اسم المعلم رباعي</label>
            <input type="text" name="nameT" class="col-12  d-flex justify-content-end rounded-pill texMo"  id="name">
            </div>
            <div class="col-md-6 col-xs-12">
                
            <label for="date" class="col-12 m-end  d-flex mt-2 mb-2 justify-content-end text-warning fs-5">تاريخ الميلاد</label>
            <input type="date" class="col-12"  name="date" id="date">
            </div>



            <div class="col-md-6 col-xs-12">
                <label for="H" class="col-12 d-flex justify-content-end justify-content-end mt-2 mb-2  text-warning fs-5">الرقم القومي للمعلم</label>
                <input type="number" maxlength="14"   class="col-12 rounded-pill texMo"  id="numN" name="H">
            </div>

            <div class="col-md-6  col-xs-12 ">
                <label for="type" class="col-12 m-end  d-flex mt-2 mb-2 justify-content-end text-warning fs-5">الجنس</label>
                <select name="type" id="sel" class="col-12 d-flex justify-content-end" >
                    <option value="ff">حدد</option>
                    <option value="male">ذكر</option>
                    <option value="female">انثي</option>
                </select>
            </div>



            <div class="col-md-6 col-xs-12">
                <label for="plate" class="col-12  d-flex justify-content-end justify-content-end mt-2 mb-2  text-warning fs-5">العنوان ومحل الإقامة</label>
                <input type="text" class="col-12 rounded-pill texMo" id="p" maxlength="35" name="plate">
            </div>

<!--     
             <div class="col-md-12 col-xs-12">
                <label  class="col-12  d-flex justify-content-end justify-content-end mt-2 mb-2  text-warning fs-5">اسم ولي الامر رباعي</label>
                <input type="text" class="col-12 rounded-pill texMo" id="nameP">
            </div> -->

              <div class="col-md-6 col-xs-12">
                <label for="number" class="col-12  d-flex justify-content-end justify-content-end mt-2 mb-2  text-warning fs-5">رقم المحمول</label>
                <input type="number" name='number' maxlength="11"  class="col-12 rounded-pill texMo" id="numP">
            </div> 

            <!-- <div class="col-md-6 col-xs-12">
                <label for="" class="col-12  d-flex justify-content-end justify-content-end mt-2 mb-2  text-warning fs-5">المنطقة التعليمية الخاصة به</label>
                <input type="text" class="col-12 rounded-pill texMo" id="c" maxlength="20">
            </div>
            <div class="col-md-6 col-xs-12">
                <label for="" class="col-12  d-flex justify-content-end justify-content-end mt-2 mb-2  text-warning fs-5">المدرسة الخاصة به</label>
                <input type="text" class="col-12 rounded-pill texMo" id="school" maxlength="20">
            </div> -->




            <div class="col-md-6 col-xs-12">
                <label for="cv" class="col-12  d-flex justify-content-end justify-content-end mt-2 mb-2  text-warning fs-5">السيرة الذاتيه</label>
                <input type="file" class="col-12 rounded-pill texMo mmf" id="cv2"  name="cv"   >
                <div class="img-area3" data-img="" id="imgg3" date-id="" hidden>
                    <div class="img-areaH3"data-img="" id="img-areaH3" hidden></div>
                </div>
                <button class="btn col-12 rounded-pill texMo btn-primary" id="cv1">رفع ملف</button>
            </div>
            <div class="col-12 d-flex flex-row justify-content-between mN">
                <div class="col-9 " id="er"><p class='ert' id='p2'></p></div>
                <button class="btn btn-danger col-3" type="submit">تقديم</button>
            </div>


</div>
</form>

<?php  include('../../redundecyCode/linkBootstrapJs.php') ?>
<script src="js.js"></script>
</body>

</html>