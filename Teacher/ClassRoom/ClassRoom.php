<?php
$is_valid = true; // تعريف المتغيرات خارج شرط الـ POST

$NullCard = true ;
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_COOKIE['email']; 
    $name = $_POST['nameTeacher'];
    $className = $_POST['className'];
    $Section = $_POST['Section'];
    $imageAcount = $_COOKIE['image'];

    // فحص المدخلات
    if (empty($className)) {
        $is_valid = false;
        $message = 'إسم الفصل فارغ';
    } else if (empty($Section)) {
        $is_valid = false;
        $message = 'إسم القسم فارغ';
    } else if (empty($name)) {
        $is_valid = false;
        $message = 'إسم المعلم فارغ';
    }

    // إذا كانت المدخلات صحيحة
    if ($is_valid == true) {

        function generateRandomCode($length = 6) {
            $numbers = '0123456789';
            $alphabets = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $specialCharacters = '!@#$%^&*()_+-=[]{}|;:,.<>?';
            $allCharacters = $numbers . $alphabets . $specialCharacters;

            $code = '';
            while (strlen($code) < $length) {
                $randomCharacter = $allCharacters[random_int(0, strlen($allCharacters) - 1)];
                $code .= $randomCharacter;
            }

            return $code;
        }


        $generatedCode = generateRandomCode(6);

        include('../../redundecyCode/connection.php');
        // HTML الخاص بـ card
        $card = "<div class='cardClass d-flex flex-column justify-content-around col-4'>
            <div class='header d-flex flex-row gap-2'>
                <p class='Name m-auto'>$name</p>
                <div class='nn m-auto'>
                    <img src='$imageAcount' alt='' id='imgAcount' style='width: 100%;'>
                </div>
            </div>
            <div class='center d-flex flex-column '>
                <div class='gap-2 text'>
                    <span>إسم الفصل</span>
                    <span>:-$className</span>
                </div>
                <div class='gap-2 text'>
                    <span>القسم</span>
                    <span>:-$Section</span>
                </div>
            </div>
            <div class='footer container d-flex flex-row'>
            <form method='POST' action='./viewClassRoom/view.php'>
            <input type='hidden' name='id' value=' $generatedCode'>
            <button class='btn btn-danger m-auto' type='submit'>دخول الفصل</button>
        </form>
            </div>
        </div>";


        $classHello = "<div class='background row' id='background'>
            <p class='col-6 cha' data-bs-toggle='modal' data-bs-target='#modal2'>:</p>
            <div class='d-flex flex-column col-6 d-block .d-md-none'>
                <div class='header d-flex flex-row gap-2 justify-content-end p-2 '>
                    <p class='Name mt-2'>$name</p>
                    <div class='nn'>
                        <img src='$imageAcount' alt='' id='imgAcount' style='width: 100%;'>
                    </div>
                </div>
                <div class='header2 d-flex flex-row gap-2 justify-content-end p-2'>
                    <p class='Name mt-2'>اسم الفصل:-</p>
                    <p class='Name mt-2'>$className</p>
                </div>
            </div>
        </div>";

        
        

        $stmt = $conn->prepare("INSERT INTO classroom (email, code_class , class_Name , Section , nameTeacher , image_Acount) VALUES (?, ?, ?, ?,?,?)");
        $stmt->bind_param("ssssss", $email, $generatedCode , $className , $Section, $name , $imageAcount); 
        $stmt->execute();
        $stmt->close();


        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include('../../redundecyCode/linkBootstrap2.php'); ?>
    <link rel="stylesheet" href="classRoom.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الفصول و الدروس</title>
</head>
<body>
    <div class="AddClass mt-5" id="ADDclass">
        <img src="../../Image/logo-WE-Web.png" class="m-auto d-flex justify-content-center">
        <div class="d-flex row col-12 gap-3 justify-content-center Btn"> 
            <button class="btn btn-primary text-light rounded btnn" data-bs-toggle="modal" data-bs-target="#modal2">إنشاء الصف</button>
        </div> 
    </div>

    <div class="container row justify-content-evenly gap-4 for" id="clas1">
    <?php
    include('../../redundecyCode/connection.php');
    $emailAcount = $_COOKIE['email'];
    // تعديل الاستعلام ليعرض جميع البطاقات المرتبطة بالبريد الإلكتروني
    $stmt = $conn->prepare("SELECT nameTeacher , image_Acount , class_Name ,Section, code_class  FROM classroom WHERE email = ?");
    $stmt->bind_param("s", $emailAcount);
    $stmt->execute();
    $result = $stmt->get_result();
    // if ($stmt->num_rows > 0) {
    //     $stmt->bind_result($card);
    //     // عرض جميع البطاقات
    //     $cards = '';
    //     while ($stmt->fetch()) {
    //         $cards .= $card;
    //     }
    //     echo "<script>
    //     const clas1 = document.getElementById('clas1');
    //     const AddClass = document.getElementById('ADDclass');
    //     AddClass.style.display= 'none';
    //     clas1.style.display = 'flex';
    //     clas1.innerHTML += `$cards `;
    //     </script>";
    // } else {
    //     echo "<script>
    //             document.getElementById('freediv').style.display = 'none'; 
    //             document.getElementById('ADDclass').style.display = 'block'; 
    //           </script>";
    // }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name1 = $row['nameTeacher'];
            $name2 = $row['class_Name'];
            $Section2 = $row['Section'];

            $code = $row['code_class'];

            $imageAcount2 = $row['image_Acount'];

            echo  "<div class='cardClass d-flex flex-column justify-content-around col-4'>
            <div class='header d-flex flex-row gap-2'>
                <p class='Name m-auto'>$name1</p>
                <div class='nn m-auto'>
                    <img src='$imageAcount2' alt='' id='imgAcount' style='width: 100%;'>
                </div>
            </div>
            <div class='center d-flex flex-column '>
                <div class='gap-2 text'>
                
                    <span>إسم الفصل</span>
                    <span>:-$name2</span>
                </div>
                <div class='gap-2 text'>
                    <span>القسم</span>
                    <span>:-$Section2</span>
                </div>
            </div>
            <div class='footer container d-flex flex-row'>
            <form method='POST' action='./viewClassRoom/view.php' class='d-flex justify-content-center w-100'>
            <input type='hidden' name='id' value=' $code'>
            <button class='btn btn-danger m-auto' type='submit'>دخول الفصل</button>
        </form>
            </div>
        </div>";
        }
        $NullCard = false ;

    }
    ?>


        <?php
        // عرض الرسائل في حالة وجود خطأ
        if (!$is_valid && !empty($message)) {
            echo "<div class='alert alert-danger'>$message</div>";
        }
        ?>
    </div>

    <button class="btn btn-dark text-primary rounded-circle btnAdd ms-2 mb-2 mt-2" data-bs-toggle="modal" data-bs-target="#modal">+</button>
    <div class="row" id="freediv"></div>

    <section>
        <div class="modal fade" id="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <button class="btn text-primary btn-light btnn w-100" data-bs-toggle="modal" data-bs-target="#modal2">إنشاء الصف</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal2">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body row d-flex justify-content-end modall">
                        <form action="" method="POST">
                            <label class="col-12 d-flex justify-content-end" for="className">اسم الفصل</label>
                            <input type="text" class="col-12 d-flex justify-content-end rounded-pill m-auto" id="className" name="className" value="">
                            
                            <label class="col-12 d-flex justify-content-end" for="Section">القسم أو المادة</label>
                            <input type="text" class="col-12 d-flex justify-content-end rounded-pill m-auto" id="Section" name="Section" value="">
                            
                            <label class="col-12 d-flex justify-content-end" for="nameTeacher">إسم المعلم</label>
                            <input type="text" class="col-12 d-flex justify-content-end rounded-pill m-auto" id="nameTeacher" name="nameTeacher" value="">

                            <button type="submit" class="btn btn-success w-100 mt-3">إنشاء الصف</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php 
include('../../redundecyCode/linkBootstrapJs.php');

if ($NullCard ==false) {
    echo "<script>
const clas1 = document.getElementById('clas1');
const AddClass = document.getElementById('ADDclass');
AddClass.style.display= 'none';
clas1.style.display = 'flex';
</script>";
}
else{

    echo "<script>
    document.getElementById('freediv').style.display = 'none'; 
    document.getElementById('ADDclass').style.display = 'block'; 
  </script>";

}


?>


</body>
</html>
