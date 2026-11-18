<?php
if(isset($_COOKIE['profession'])){
    if($_COOKIE['profession']=='student'){
        header('Location: ../Student/home/home.php'); 
    }
    else if($_COOKIE['profession']=='teacher'){
        header('Location: ../Teacher/homeTeacher/homeTeacher.php');
    } 
    else{
        header('Location: ../Admin/homeAdmin/homeAdmin.php');        
    }
}


include('../redundecyCode/connection.php');
//Arabic Validation 
function containsArabic($string) {
    if (preg_match('/[\x{0600}-\x{06FF}]/u', $string)) {
        return true; 
    }
    return false; 
}
        $is_valid = true;
        $message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])){
        $name =$_POST['name'];
        $email =$_POST['email'];
        $password =$_POST['password'];
        $selected_option = '';
        
        if (empty($name)) {
            $is_valid = false;
            $message = "The Name is empty";
        }
        else if (ctype_lower($name[0])) {
            $is_valid = false;
            $message = "The first letter must be capital";
        }
        else if (ctype_space($name)) {
            $is_valid = false;
            $message = "must name dont have any space";
        }
        else if (!ctype_alpha($name)) {
            $is_valid = false;
            $message = "must name dont have any Numbers or speacial charecter";
        }
        else if (strlen($name)<12) {
            $is_valid = false;
            $message = "the name must include 12 character";
        }
        else if (strlen($name)>16) {
            $is_valid = false;
            $message = "the max  character in name  is  16 character only";
        }
        else if (containsArabic($name)) {
            $is_valid = false;
            $message = "must name dont have any Arabic";
        }
        else if (empty($email)) {
            $is_valid = false;
            $message = "The email is empty";
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $is_valid = false;
            $message = "The email is wrong";
        }
        else if (empty($password)){
            $is_valid = false;
            $message = "The password is empty";
        }
        else if (ctype_space($password)) {
            $is_valid = false;
            $message = "must password dont have any space";
        }
        else if (containsArabic($password)) {
            $is_valid = false;
            $message = "must password dont have any Arabic";
        }
        else if (strlen($password)<6) {
            $is_valid = false;
            $message = "the password  must lenght 6";
        }
        else if(!preg_match('/[A-Z]/',$password)){
            $is_valid = false;
            $message = "the password must include small and captle character";
        }
        else if(!preg_match('/[a-z]/',$password)){
            $is_valid = false;
            $message = "the password must include small and captle character";
        }
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            $is_valid = false;
            $message = "must password have speacial character";
        }
        else if (isset($_POST['option'])) {
            $selected_option = $_POST['option'];
        } else {
            $is_valid = false;
            $message = "you must choose Student or Teacher ";
        }
        $stmt = $conn->prepare("SELECT * FROM users WHERE email =?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $is_valid = false;
            $message = "the email aleardy exists";
        }
        if($is_valid==TRUE){
            $image_account='../../Image/user.png';
            $stmt = $conn->prepare("INSERT INTO users (user_name, email, password_user, image_Acount, Profession) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $name, $email, $password, $image_account, $selected_option);
        
            if ($stmt->execute()) {
                if($selected_option=='student'){
                    header('Location: ../Student/home/home.php'); 
                    $expire_time = time() + (7 * 24 * 60 * 60); 
                    setcookie("userName", $_POST['name'], $expire_time, "/");
                    setcookie("email", $_POST['email'], $expire_time, "/");
                    setcookie("profession",$selected_option, $expire_time, "/");
                    setcookie("image", '../Uploud_image/user.png' ,$expire_time, "/");
                    
                    
                }
            
                else{
                    header('Location: ../Teacher/homeTeacher/homeTeacher.php');
                    $expire_time = time() + (7 * 24 * 60 * 60); 
                    setcookie("userName", $_POST['name'], $expire_time, "/");
                    setcookie("email", $_POST['email'], $expire_time, "/");
                    setcookie("profession",$selected_option, $expire_time, "/");
                    setcookie("image", '../Uploud_image/user.png' ,$expire_time, "/");
                }
                
            } else {
                
            }
        }

    }
    else if(isset($_POST['emailLogin']) && isset($_POST['passwordLogin'])){
        $email =$_POST['emailLogin'];
        $password =$_POST['passwordLogin'];
        if(empty($email)){
            $is_valid = false;
            $message = "The email is empty";
        }
        else if(empty($password)){
            $is_valid = false;
            $message = "The password is empty";
        }
        else{
        include('../redundecyCode/connection.php');
        $stmt2 = $conn->prepare("SELECT * FROM users WHERE email =? AND password_user =?");
        $email =$_POST['emailLogin'];
        $password =$_POST['passwordLogin'];
        $stmt2->bind_param("ss", $email ,$password);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        if($result2->num_rows == 0){
            $is_valid = false;
            $message = "the email or password is wrong";
        }
        else{
            while ($row = $result2->fetch_assoc()) {
                $email = $row['email'];
                $name = $row['user_name'];
                $image_Acount = $row['image_Account'];
                $Profession = $row['Profession'];

                if($Profession=='student'){
                    header('Location: ../Student/home/home.php'); 
                    $expire_time = time() + (7 * 24 * 60 * 60); 
                    setcookie("userName", $name, $expire_time, "/");
                    setcookie("email", $email, $expire_time, "/");
                    setcookie("profession",$Profession, $expire_time, "/");
                    setcookie("image", '../Uploud_image/user.png' ,$expire_time, "/");
                    
                    
                }
            
                else if($Profession=='teacher'){
                    header('Location: ../Teacher/homeTeacher/homeTeacher.php');
                    $expire_time = time() + (7 * 24 * 60 * 60); 
                    setcookie("userName", $name, $expire_time, "/");
                    setcookie("email", $email, $expire_time, "/");
                    setcookie("profession",$Profession, $expire_time, "/");
                    setcookie("image", '../Uploud_image/user.png' ,$expire_time, "/");
                }
                else{

                    header('Location: ../Admin/homeAdmin/homeAdmin.php');
                    $expire_time = time() + (7 * 24 * 60 * 60); 
                    setcookie("userName", $name, $expire_time, "/");
                    setcookie("email", $email, $expire_time, "/");
                    setcookie("profession",$Profession, $expire_time, "/");
                    setcookie("image", '../Uploud_image/user.png' ,$expire_time, "/");

                }



        }}
    }
        
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <?php include('../redundecyCode/linkBootstrap.php') ?>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="justify-content-around m-auto row">
            <div class="d-flex col-md-3 col-xs-12 col-sm-12 m-auto  justify-items-center">
                <img src="../Image/logo-WE-Web.png" class="m-auto" style="width: 20rem;" >
            </div>
            <div class="login row   col-md-8 col-xs-12 col-sm-12 ">
                <div class="tran-log" id="logi">
                    <form class="tran-log2" method="post" width="100%" height="100%" id="userForm2">
                        <p class="title col-12">Login</p>
                    <div class="col-12">
                        <input type="email" class="userName" placeholder="email" id="Namelogin" name='emailLogin'> 
                        <i class='bx bxs-user' id="us"></i>
                    </div>
                    <div class="col-12">
                        <input type="password" class="email" placeholder="password" id="pass" name='passwordLogin'>
                        <i class='bx bxs-lock-alt' id="fff"></i>
            
                    </div>
                    <br>
                <button type="submit" class="sumb col-12" id="log">Login</button>
                <div class="reg">
                    <span style="color: white;"></span>Dont have account?</span>
                    <span class="dd" onclick="regs()">Register</span>
                </div>
            </form>
                </div>

                <div class="tran-sign " id="regi">
                    <form class="tran-log2" method="POST" action="" width="100%" height="100%" id="userForm" >
                        <div class="col-12">
                            <p class="title">Register</p>
                            <i class='bx bxs-left-arrow-alt' id="left" onclick="loggn()"></i>
                        </div>
                        <div class="col-12">
                            <label for="name" class='lab'></label>
                            <input  type="text" class="userName-sign" placeholder="userName" id="name" name="name"> 
                            <i class='bx bxs-user' id="uss"></i>
                        </div>
                        <div class="col-12">
                            <label for="email" class='lab'></label>
                            <input   type="email" class="em-sign" placeholder="Email"  id="email" name="email"> 
                            <i class='bx bxs-envelope' id="ccc"></i>
                        </div>
                        <div class="col-12">
                            <label for="password" class='lab'></label>
                            <input   type="password" class="email-sign" placeholder="New password" id="password" name="password">
                            <i class='bx bxs-lock-alt' id="ddda" ></i>
                        </div>
            
        
                            <div class="row vvd col-12">
                                <div class="col-12">
                                    <label class="l">Profision:-</label>
                                </div>
                                <div class="d-flex flex-row col-6" style="display: inline;">
                                    <input type="radio" id="techer" name="option" value="teacher"   >
                                    <label for="techer" class="l">Teacher</label>
                                </div>
                                <div class="d-flex flex-row col-6" style="display: inline;" >
                                    <input type="radio" id="student" name="option" value="student" >
                                    <label for="student" class="l" style="margin-right: 38%;">Student</label>
                            
                                </div>
                            </div>
                    <button  class="sumb-sign" id="clicksumbit">sign up</button>
                    </form>
        
                    </div>
            </div>
        </div>
    
    </div>
    <div id="errr">
 
    <?php  if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$is_valid): ?>
        <div class='text-dark border-danger err'><p class='error'><?php echo $message ?></p></div>
    <?php endif; ?>

        </div>
<script src="login.js"></script>
</body>
</html>