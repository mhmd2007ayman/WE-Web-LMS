<?php 
$active = 'classroom';
if($_SERVER['REQUEST_METHOD']== 'POST'){
  $CodeClass = $_POST['btn'];

  include('../../redundecyCode/connection.php');
  $stm = $conn->prepare('DELETE  FROM classroom WHERE code_class=?');
  $stm->bind_param('s',$CodeClass);
  $stm->execute();

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../../redundecyCode/linkBootstrap2.php') ?>
    <link rel="stylesheet" href="http://localhost/WE_Web%20(Update)/redundecyCode/editNavAdminn.css">
    <link rel="stylesheet" href="ClassRoom.css">
    <title>ClassRoom</title>
</head>
<body>
    <?php
    include('../../redundecyCode/navbarAdmin.php')
    ?>
    <br>
    <br>
    <br>
<div class="container">
<table class="table">
  <thead class='thead'>
    <tr >
  <th scope="col">classRoomDetails</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"><button class='btn btn-primary' >Profession</button></th>
</tr>

  </thead>
        
        <thead >
          <tr class='tr'>
            <th scope="col">#</th>
            <th scope="col">name teacher</th>
            <th scope="col">class Room</th>
            <th scope="col">email</th>
            <th scope="col">code class</th>
            <th scope="col">section</th>
            <th scope="col">option</th>
          </tr>
        </thead>
        
        <tbody id="table">
            <?php
            include('../../redundecyCode/connection.php');
            $stm = $conn->prepare('SELECT * FROM classroom');
            $stm->execute();
            $result = $stm->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()){
                    $name = $row['nameTeacher'];
                    $email = $row['email'];
                    $code = $row['code_class'];
                    $section = $row['Section'];
                    $imageAcount = $row['image_Acount'];
                    $class = $row['class_Name'];
                    $imageAcount2 = substr($imageAcount,3,);
                    echo "<tr>
                    <th class='ttb'><div class='nn'>
                    <img src='../../Teacher/$imageAcount2'  id='imgAcount' style='width: 100%; height:100%'>
               </div></th>
               <th class='td'>$name</th>
               <th class='td'>$class</th>
               <th class='td'>$email</th>
               <th class='td'>$code</th>
               <th class='td'>$section</th>
               <th class='td'><form method='POST' class='w-100'><button type='submit' value ='$code' class='btn btn-danger' name='btn'>حذف الفصل</button></form></th>
               </tr>
               ";
    
                }
            }
            
    
            ?>
    
    
        </tbody>
      </table>
</div>
<?php include('../../redundecyCode/linkBootstrapJs.php') ?>
</body>
</html>