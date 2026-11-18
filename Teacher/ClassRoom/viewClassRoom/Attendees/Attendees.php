<?php
            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['codee']) && isset($_POST['em'])){
                include('../../../../redundecyCode/connection.php');
                $code = $_POST['codee'];
                $em = $_POST['em'];
                $a = json_encode($code);
                $z =substr($a,2,-1);
                $stmt = $conn->prepare("DELETE  FROM `studentclassroom` WHERE code_class= ? AND email=? ");
                $stmt->bind_param("ss", $z , $em);
                $stmt->execute();
                // $stmt->close();
                // $conn->close();
                header('Attendees.php');
                // exit();
            } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='Attendees.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../../../bootstrap/css/bootstrap.min.css">
    <title>Attendees</title>
</head>
<body>

    <div class='container w-70 mt-5'>
        <div>
        <p class='d-flex justify-content-end'>المعلم</p>
            <hr>
        </div>

        <div class='d-flex flex-column'>
            <?php
            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['codee'])){
                include('../../../../redundecyCode/connection.php');
                $code = $_POST['codee'];
                $a = json_encode($code);
                $z =substr($a,2,-1);
                $stmt = $conn->prepare("SELECT * FROM `classroom` WHERE code_class= ?");
                $stmt->bind_param("s", $z);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $email = $row['email'];
                        $name = $row['nameTeacher'];
                        $image_Acount = $row['image_Acount'];

                        $stat = $row['sending'];

             if($stat == 'yes'){
                 $s1 = 'active';
                 $s2 = 'unactive';

             }
             else{
                 $s2 = 'active';
                 $s3 = 'unactive';
             }                        

                        $im =substr($image_Acount,2,);
                    }
                    echo "
                    
                    <div class='d-flex justify-content-end mt-2  mb-2'>
                    <div class='column' style='direction: rtl;'>
                        <h6 class='nameAcount' style=' margin-top: 2px; margin-bottom: 0.3px;'>$email</h6>
                        <span class='time' >$name</span>
                    </div>
                    <img src='../../../../Teacher/$im' class='imgAcount'>
                </div>

  
                    ";

                }
                else{
                    echo '<p>NOT YET </P>';
                }


            } 
            ?>
        </div>

        <div>
        <p class='d-flex justify-content-end'>الطلاب</p>
            <hr>
        </div>

        <div>
        <?php
            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['codee'])){
                include('../../../../redundecyCode/connection.php');
                $code = $_POST['codee'];
                $a = json_encode($code);
                $z =substr($a,2,-1);
                $stmt = $conn->prepare("SELECT * FROM `studentclassroom` WHERE code_class= ?");
                $stmt->bind_param("s", $z);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $email = $row['email'];
                        $name = $row['name'];
                        $image_Acount = $row['image'];
                        $im =substr($image_Acount,2,);
                        echo "<div class='d-flex justify-content-between'>
                    <form  action='' method='POST' class='d-flex align-items-center'>
                    <input type='hidden' value='$code' name='codee'>
                    <button class='btn btn-danger' type='submit' value='$email' name='em'>إخراجه</button>
                    </form>
                    <div class='d-flex justify-content-end mt-2  mb-2'>
                    <div class='column' style='direction: rtl;'>
                    <h6 class='nameAcount' style=' margin-top: 2px; margin-bottom: 0.3px;'>$email</h6>
                    <span class='time' >$name</span>
                    </div>
                    <img src='../../../../Student/$im' class='imgAcount'>
                    </div>
                    </div>
                    " ;
                }

                    
                }
                else{
                    echo '<p>NOT YET </P>';
                }

                // $stmt->close();
                // $conn->close();
                // header("Location: Attendees.php");
            } 
            ?>
        </div>


    </div>
</body>
</html>