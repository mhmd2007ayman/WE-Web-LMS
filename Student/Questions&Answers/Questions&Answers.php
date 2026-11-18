<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../../redundecyCode/linkBootstrap2.php')  ?>
    <link rel="stylesheet" href="Questions&Answers.css">
    <link rel="import" href="/qs.html">
    <title>سؤال و جواب</title>
</head>
<body>
<?php  include('../../redundecyCode/navbarStudent.php') ?>
    <h2 class="bg-dark h2  mt-2 d-flex justify-content-center "><p class="text-warning p">سؤال و جواب</p></h2>
    <div class="row container mt-2  gap-2" id="divQ" >
         <div class="add bg-success d-flex divCard justify-content-center divv col-1"data-bs-toggle="modal" data-bs-target="#modal"  >
            <p class="text-primary ">+</p>
        </div>
    </div>
    <div class="divqq row container gap-2 d-flex justify-content-center m-auto mt-4 border-warning" id="divQQ"></div>


    </div>
    <div class="modal fade" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="">بطاقة المذاكرة</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="input" placeholder="اضافة العنوان" id="inp" onclick="again()">
                    <label for="" class="lead text-warning">المادة أو المنهج</label>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" id="doneAdd"  type="button">تم</button>
                </div>
                
            </div>
        </div>
        <div id="moro"></div>
    </div>


    <div class="modal fade" id="modalQ">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header " >
                    <h5 class="">بطاقة المذاكرة</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label for="" class="lead text-warning col-12 "> السؤال</label>
                    <input type="text" class="input col-12" placeholder="اضافة السؤال" id="inp2" maxlength="38">

                    <label for="" class="lead text-warning col-12"> الجواب</label>
                    <input type="text" class="input col-12" placeholder="اضافة الجواب" id="inp3">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" id="doneAdd2">تم</button>
                </div>
            </div>
        </div>
    </div>

    <?php include('../../redundecyCode/linkBootstrapJs.php') ?> 
    <script src="Questions&Answers.js"></script>
</body>
</html>