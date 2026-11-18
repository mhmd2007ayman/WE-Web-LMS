<?php
include('../../redundecyCode/connection.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['del'])) {
  $code = $_POST['del'];

  $query = "DELETE FROM users WHERE email = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $code);

  if ($stmt->execute()) {
    echo "<script type='module'>
    import { success } from '../../Toster/toster.js';
    success('تم   الحذف  بنجاح');
</script>";
  } else {
    echo "<script type='module'>
    import { error } from '../../Toster/toster.js';
    error(' لم يتم الحذف ');
</script>";
  }

  $stmt->close();
  $conn->close();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../../redundecyCode/linkBootstrap2.php') ?>
    <link rel="stylesheet" href="http://localhost/WE_Web%20(Update)/redundecyCode/editNavAdminn.css">
    <link rel="stylesheet" href="userAdmin.css">
    <title>Users</title>
</head>
<body>
    <?php
    $active = 'users';
    include('../../redundecyCode/navbarAdmin.php')
    ?>
    <br>
    <br>
    <br>
<div class="container">
<table class="table">
  <thead class='thead'>
    <tr >
  <th scope="col">usersDetails</th>
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
            <th scope="col">userName</th>
            <th scope="col">email</th>
            <th scope="col">password</th>
            <th scope="col">Profession</th>
            <th scope="col">option</th>
          </tr>
        </thead>
        
        <tbody id="table">
            <?php
            include('../../redundecyCode/connection.php');
            $stm = $conn->prepare('SELECT * FROM users WHERE  Profession =? OR Profession = ?');
            $teacher = 'teacher';
            $student = 'student';
            $stm->bind_param('ss', $teacher,$student);
            $stm->execute();
            $result = $stm->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()){
                    $name = $row['user_name'];
                    $email = $row['email'];
                    $profession = $row['Profession'];
                    $password = $row['password_user'];
                    $imageAcount = $row['image_Acount'];
                    $imageAcount2 = substr($imageAcount,3,);
                    $Up= strtoupper($profession[0]);
                    $to = substr($profession,1,);
                    $Profession = $Up . $to;
                    echo "<tr>
                    <th class='ttb'><div class='nn'>
                    <img src='../../$Profession/$imageAcount2'  id='imgAcount' style='width: 100%; height:100%'>
               </div></th>
               <th class='td'>$name</th>
               <th class='td'>$email</th>
               <th class='td'>$password</th>
               <th class='td'>$profession</th>
               <th class='td'><form  method='POST' >   <button class='btn btn-danger' name='del' value='$email' >حذف المستخدم</button></form></th>
               </tr>
               ";
    
                }
            }
            
    
            ?>
    
    
        </tbody>
      </table>
</div>
<?php include('../../redundecyCode/linkBootstrapJs.php') ?>
<script type='module' src="../../Toster/toster.js" defer></script>
</body>
</html>