<?php 
$NullCard = true ;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $code = $_POST['code'];
    include('../../redundecyCode/connection.php');
    $stm = $conn->prepare('SELECT * FROM classroom  WHERE code_class = ?');
    $stm->bind_param('s',$code);
    $stm->execute();
    $result = $stm->get_result();
    if ($result->num_rows > 0) {
$email = $_COOKIE['email'];
        include('../../redundecyCode/connection.php');
        $stm = $conn->prepare('SELECT * FROM studentclassroom WHERE email=? AND code_class =?');
        $stm->bind_param('ss',$email,$code);
        $stm->execute();
        $result = $stm->get_result();
        if ($result->num_rows == 0) {
            include('../../redundecyCode/connection.php');
            $image = $_COOKIE['image'];
            $name = $_COOKIE['userName'];
        $stm = $conn->prepare('INSERT INTO  studentclassroom (email , code_class, image , name)  VALUES(?,?,?,?) ');
        $stm->bind_param('ssss',$email,$code , $image , $name );
        $stm->execute();
        }
    }

}
?>











<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<?php  include('../../redundecyCode/linkBootstrap2.php')  ?>
    <link rel="stylesheet" href="classRoom.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الفصول و الدروس</title>
</head>
<body>
    <div class="AddClass  mt-5 " id="ADDclass">
        <img src="../../Image/logo-WE-Web.png" class="m-auto d-flex justify-content-center">
         <div class="d-flex row col-12 gap-3 justify-content-center Btn"> 
            <button class=" btn text-primary  btn-light btnn" data-bs-toggle="modal" data-bs-target="#modal2">الانضمام إلي صف</button>
         </div> 
    </div>

    <div class="container row   justify-content-evenly   gap-4 for" id="clas1" >

    <?php
    include('../../redundecyCode/connection.php');
    $emailAcount = $_COOKIE['email'];
    $stmt = $conn->prepare("SELECT code_class FROM studentclassroom WHERE email=?");
    $stmt->bind_param("s", $emailAcount);
    $stmt->execute();
    $result = $stmt->get_result(); 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $codeClass = $row['code_class'];
            include('../../redundecyCode/connection.php');
            $stmt2 = $conn->prepare("SELECT nameTeacher , image_Acount , class_Name ,Section, code_class  FROM classroom WHERE code_class = ?");
            $stmt2->bind_param("s", $codeClass);
            $stmt2->execute();
            $result2 = $stmt2->get_result(); 
            if($result2->num_rows >0){
                while ($roww = $result2->fetch_assoc()) {
                    $name1 = $roww['nameTeacher'];
                    $name2 = $roww['class_Name'];
                    $Section2 = $roww['Section'];
                    $code = $roww['code_class'];
                    $imageAcount2 = $roww['image_Acount'];
                    $imageAcount3 = substr($imageAcount2,2,); 
                    echo  "<div class='cardClass d-flex flex-column justify-content-around col-4'>
                    <div class='header d-flex flex-row gap-2'>
                        <p class='Name m-auto'>$name1</p>
                        <div class='nn m-auto'>
                            <img src='../../Teacher/$imageAcount3' alt='' id='imgAcount' style='width: 100%;'>
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
                    <form method='POST' action='../../Teacher/ClassRoom/viewClassRoom/view.php' class='d-flex justify-content-center w-100'>
                    <input type='hidden' name='id' value=' $code'>
                    <button class='btn btn-danger m-auto' type='submit'>دخول الفصل</button>
                </form>
                    </div>
                </div>";
                }
                
            }
        }
        $NullCard = false ;
    }
    ?>

    </div>




    <button class="btn btn-dark text-primary rounded-circle btnAdd ms-2 mb-2 mt-2 " data-bs-toggle="modal" data-bs-target="#modal">+</button>
    <div class="row " id="freediv">
    </div> 


<section>
    <div class="modal fade" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" id="closeNow2"></button>
                </div>
                <div class="modal-body">
                  <button class=" btn bt text-primary  btn-light btnn" data-bs-toggle="modal" data-bs-target="#modal2" onclick="closeD()">الانضمام إلي صف</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="modal2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" id="closeNow"></button>
                </div>
                <div class="modal-body row d-flex justify-content-center modall">
                  <form action="" method="post" id="form">
                    <div class="d-flex flex-column gap-2 ">
                      <label for="code" class="text-warning"  style="direction: rtl;" >كود الفصل</label>
                      <input type="text" name="code" class="INP" id="code">
                      <button class="btn btn-danger" type="submit">الانضمام</button>
                    </div>

                  </form>


                </div>
            </div>
        </div>
    </div>


</section>
    <?php include('../../redundecyCode/linkBootstrapJs.php') ?>
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