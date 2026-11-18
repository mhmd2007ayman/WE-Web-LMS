<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $oldPassword = $_POST['oldPassword'];
    $newEmail = $_POST['newEmail'];
    $newName = $_POST['newName'];
    $newPassword = $_POST['newPassword'];
    $prof = 'Admin';
    if(empty($newName)){
        echo "<script type='module'>
        import { warning } from '../../Toster/toster.js';
        warning('لا تترك خانة الاسم جديد فارغه');
        </script>";
    }
    else if(empty($newEmail)){
        echo "<script type='module'>
        import { warning } from '../../Toster/toster.js';
        warning('لا تترك خانة البريد  جديد فارغه');
        </script>";

    }
    else if(empty($newPassword)){
        echo "<script type='module'>
        import { warning } from '../../Toster/toster.js';
        warning('لا تترك خانة كلمة السر جديد فارغه');
        </script>";

    }

    else if(empty($oldPassword)){
        echo "<script type='module'>
        import { warning } from '../../Toster/toster.js';
        warning('لا تترك خانة الاسم القديمه فارغه');
        </script>";

    }
    else{
        include('../../redundecyCode/connection.php');
        $stmt = $conn->prepare("SELECT * FROM users WHERE  Profession = ? AND password_user=? ");
        $stmt->bind_param("ss",$prof ,$oldPassword );
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            echo "<script type='module'>
            import { error } from '../../Toster/toster.js';
            error('كلمة السر القديمه خاطئه');
            </script>";
        }
        else{
            $stmt = $conn->prepare("UPDATE users SET password_user=?,user_name=? , email=? WHERE  Profession = ? AND password_user=? ");
            $stmt->bind_param("sssss",$newPassword, $newName, $newEmail,$prof ,$oldPassword );
            if($stmt->execute()){
                echo "<script type='module'>
                import { success } from '../../Toster/toster.js';
                success('تم تغير الحساب نجاح');
            </script>";
            $stmt->close();
            $conn->close();
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
    <link rel="stylesheet" href="http://localhost/WE_Web%20(Update)/redundecyCode/editNavAdminn.css">
    <link rel="stylesheet" href="../../Toster/toster.css">
    <link rel="stylesheet" href="setting.css">
    <title>setting</title>
</head>
<body>
<div class="notifications"></div>
<?php
    include('../../redundecyCode/navbarAdmin.php')
    ?>
    <br>
    <br>
    <br>
    <br>
<div class=' d-flex flex-column justify-content-center m-auto bg-light p-5 bb div'>
<div class="nnn AdminP">
                <img src="../../Image/user.png" alt="" id="imgAcount" style="width: 100%; height:100%">
           </div>
           <form action="" class=' d-flex flex-column gap-3 m-auto' method='POST'>
           <input type="text" placeholder='new name' name='newName'>
           <input type="email" placeholder='new email' name='newEmail'>
           <input type="password" placeholder='old password' name='oldPassword'>
           <input type="password" placeholder='new password'name='newPassword'>
           <button class='btn btn-info' type='submit'>تغير الحساب</button>
           </form>
           
</div>


<?php include('../../redundecyCode/linkBootstrapJs.php') ?>

<script type='module' src="../../Toster/toster.js" defer></script>
</body>
</html>