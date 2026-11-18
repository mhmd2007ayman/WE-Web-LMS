<?php
$s1= '';
$s2= '';
     if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['statues']) && isset($_POST['codeQ'])){
                include('../../../../redundecyCode/connection.php');
                $statues = $_POST['statues'];
                $codeed = $_POST['codeQ'];
                $a = json_encode($codeed);
                $z =substr($a,2,-1);
                $stmt = $conn->prepare("UPDATE  `classroom` SET sending= ?  WHERE code_class=? ");
                $stmt->bind_param("ss", $statues , $z);
                $stmt->execute();

                $code = $_POST['codeQ'];
                $a = json_encode($code);
                $z =substr($a,2,-1);
                $stmt2 = $conn->prepare("SELECT * FROM `classroom` WHERE code_class= ?");
                $stmt2->bind_param("s", $z);
                $stmt2->execute();
                $result = $stmt2->get_result();
            
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $stat = $row['sending'];
                        if($stat == 'yes'){
                            $s1 = 'active';
                            $s2 = 'unactive';
            
                        }
                        else{
                            $s2 = 'active';
                            $s3 = 'unactive';
                        }
                        
                        
            
                    }}                             
            }
            else if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['codee'])){
                include('../../../../redundecyCode/connection.php');
                $code = $_POST['codee'];
                $a = json_encode($code);
                $z =substr($a,2,-1);
                $stmt2 = $conn->prepare("SELECT * FROM `classroom` WHERE code_class= ?");
                $stmt2->bind_param("s", $z);
                $stmt2->execute();
                $result = $stmt2->get_result();
            
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $stat = $row['sending'];
                        if($stat == 'yes'){
                            $s1 = 'active';
                            $s2 = 'unactive';
            
                        }
                        else{
                            $s2 = 'active';
                            $s3 = 'unactive';
                        }
                        
                        
            
                    }}
                }

            
            
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting</title>
    <link href='Setting.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../../../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <!-- <?php
echo $ccd;
if($ccd == 'D#rZ1'){
    echo 'true';
}
else{
    echo 'false';
}
    ?> -->
<div class='container w-70 mt-5 ff p-3'>
        <p class='m-auto' style='direction:rtl; font-size:25px;'>السماح للاخرين بإرسال الملفات و المحتوي معك</p>
        <hr>
        <div class='mt-2 '>
            <p style='direction:rtl;'>السماح:-</p>
            <form action="" method='POST'  >
            <div class='d-flex justify-content-between'>
                <div class='d-flex gap-1'>
                    <label for="yes">نعم</label>
                    <input type="radio" value='yes' class='yes' name='statues' id='<?php echo $s1; ?>' >
                </div>
                
                <div class='d-flex gap-1'>
                    <label for="no">لا</label>
                    <input type="radio" value='no' class='no' name='statues' id='<?php echo $s2; ?>' >
                </div>
                <input type="hidden" value='<?php echo $code ?>' name='codeQ'>
            </div>
            <div class='d-flex justify-content-end'>

                <button class='btn btn-danger d-flex' type='submit'  id='save'>حفظ</button>
            </div>
        </form>
        </div>
    </div>
</body>
<script src='Setting.js'></script>
</html>