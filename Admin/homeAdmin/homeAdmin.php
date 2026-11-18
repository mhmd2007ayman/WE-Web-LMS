
<?php 
        $is_valid = true;
        $message = '';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = $_POST['date'];
    $dateend = $_POST['dateend'];
    if(empty($title)){
        // $is_valid = false;
        // $message = "The title is empty";

        echo "<script type='module'>
        import { error } from '../../Toster/toster.js';
        error(' The title is empty');
    </script>";
    }
    else if(empty($content)){
        // $is_valid = false;
        // $message = "The content is empty";

        echo "<script type='module'>
        import { error } from '../../Toster/toster.js';
        error(' The content is empty');
    </script>";
    }
    else if(empty($date)){
        // $is_valid = false;
        // $message = "The date  is empty";

        echo "<script type='module'>
        import { error } from '../../Toster/toster.js';
        error(' The date  is empty');
    </script>";

    }

    else if(empty($dateend)){
        // $is_valid = false;
        // $message = "The End of date is empty";

        echo "<script type='module'>
        import { error } from '../../Toster/toster.js';
        error(' The End of date is empty');
    </script>";

    }
    else if(strtotime($date)<time()){
        // $is_valid = false;
        // $message = "The start date of the news must be today or in the future";

        echo "<script type='module'>
        import { error } from '../../Toster/toster.js';
        error(' The start date of the news must be today or in the future');
    </script>";
    }
    else if(strtotime($date)>=strtotime($dateend)){
        // $is_valid = false;
        // $message = "The end date of the news must be  in the future";

        echo "<script type='module'>
        import { error } from '../../Toster/toster.js';
        error(' The end date of the news must be  in the future');
    </script>";
    }
    else if($is_valid==TRUE){
        include('../../redundecyCode/connection.php');
        $stmt = $conn->prepare("INSERT INTO news (title, content, Publish, created_at, expires_at) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $content, $date, date('m-d-y'), $dateend);
    
        if ($stmt->execute()) {

            echo "<script type='module'>
            import { success } from '../../Toster/toster.js';
            success('done');
        </script>";
//
            }
    }
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../../Toster/toster.css">  -->
    <?php include('../../redundecyCode/linkBootstrap2.php') ?>
    <link rel="stylesheet" href="../../redundecyCode/editNavAdminn.css">
    <link rel="stylesheet" href="homeAdmin.css"> 
    <title>Admin Acount</title>
</head>
<body>
<style>
       .notifications{
        position: fixed;
        top: 30px;
        right: 20px;
        z-index: 2;
    }
    .toast{
        position: relative;
        padding: 10px;
        color: #fff;
        margin-bottom: 10px;
        width: 400px;
        display: grid;
        grid-template-columns: 70px 1fr 70px;
        border-radius: 5px;
        --color: #0abf30;
        background-image: 
            linear-gradient(
                to right, #0abf3055, #22242f 30%
            ); 
        animation: show 0.3s ease 1 forwards  
    }
    .toast i{
        color: var(--color);
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: x-large;
    }
    .toast .title{
        font-size: x-large;
        font-weight: bold;
    }
    .toast span, .toast i:nth-child(3){
        color: #fff;
        opacity: 0.6;
    }
    @keyframes show{
        0%{
            transform: translateX(100%);
        }
        40%{
            transform: translateX(-5%);
        }
        80%{
            transform: translateX(0%);
        }
        100%{
            transform: translateX(-10%);
        }
    }
    .toast::before{
        position: absolute;
        bottom: 0;
        left: 0;
        background-color: var(--color);
        width: 100%;
        height: 3px;
        content: '';
        box-shadow: 0 0 10px var(--color);
        animation: timeOut 5s linear 1 forwards
    }
    @keyframes timeOut{
        to{
            width: 0;
        }
    }
    .toast.error{
        --color: #f24d4c;
        background-image: 
            linear-gradient(
                to right, #f24d4c55, #22242F 30%
            );
    }
    .toast.warning{
        --color: #e9bd0c;
        background-image: 
            linear-gradient(
                to right, #e9bd0c55, #22242F 30%
            );
    }
    .toast.info{
        --color: #3498db;
        background-image: 
            linear-gradient(
                to right, #3498db55, #22242F 30%
            );
    }
    
    
    .toast:not(.showing):not(.show) {
        opacity: 1 !important; 
    }
    .close{
        width: 35%;
        margin: auto;
        cursor: pointer;
    }
    .iconStyle{
        padding: 0px;
        margin: auto 7px;
        margin-right: 14px !important;
    }
</style>
     <?php $active = 'home';
      include('../../redundecyCode/navbarAdmin.php')
        ?> 
      <div class="container2">
        <h1>نشر خبر للمدرسه</h1>
        <form id="newsForm" method="post">
            <div class="form-group">
                <label for="title" style="direction: rtl;" for='title'>العنوان</label>
                <input type="text" id="title" name="title" required style="direction: rtl;">
            </div>
            <div class="form-group2">
                <label for="content" style="direction: rtl;" for='content'>محتوى الخبر</label>
                <textarea id="content" name="content" rows="5" required style="direction: rtl;"></textarea>
            </div>
            <div class="form-group2">
                <label for="date" style="direction: rtl;" for='date'>تاريخ البدء (الرحله مثلا)</label>
                <input type="date" id="date" name="date" required>
            </div>


            <div class="form-group2">
              <label for="date" style="direction: rtl;" for='dateend'>تاريخ نهايه الخبر</label>
              <input type="date" id="dateend" name="dateend" required>
          </div>
            <button type="submit" class="button2">نشر الخبر</button>
        </form>
        <div id="message"></div>
    </div>  

    <div style='width:100% ; display:flex ; justify-content:center; margin-top:3px' >
<div  style='width: 57%;justify-content: center;display: flex;justify-content: center;'>
 
 <?php  if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$is_valid): ?>
     <div class='text-dark border-danger err' style='background-color: #ff4d4db8;border: dashed 2px;width: 212%;border-radius: 25px;'><p class='error' style='padding-top: 13px;font-size: 18px;padding-left: 10px;display: flex;justify-content: center;'><?php echo $message ?></p></div>
 <?php endif; ?>

     </div>
</div>

   <?php include('../../redundecyCode/linkBootstrapJs.php') ?>
   <!-- <script src="jss.js"></script> -->
</body>
</html>