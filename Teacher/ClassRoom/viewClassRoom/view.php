<?php
if($_COOKIE['profession'] == 'teacher'){
    $profession = 'Teacher';

}
else{
    $profession = 'Student';
}
$sendingNow= '';
?>
<?php
session_start();
$codeeMo = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $_SESSION['id'] = $_POST['id'];
       $x = $_POST['id'];
       $codeeMo = $x;
           header("Location: view.php");
           exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ide']) && isset($_POST['time']) && isset($_POST['content']) && isset($_SESSION['id'])) {
    $time = $_POST['time'];
    $content =$_POST['content'];
    $code = $_SESSION['id'];
    $codecode = $_POST['ide'];
    include('../../../redundecyCode/connection.php');
    $stmt = $conn->prepare('SELECT * FROM inside_class WHERE  time=? AND content=? AND code_class=?');
    $stmt->bind_param("sss",$time,$content,$code);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows ==1){
        while ($row = $result->fetch_assoc()) {
            $comments = $row['comments'];
            $comm = json_decode($comments , true);
            $comm2 = json_decode(json_encode($comments) , true);

            function removeArrayById(&$array, $id) {
                foreach ($array as $key => $value) {
                    if ($value['id'] == $id) {
                        unset($array[$key]);  
                        break;  
                    }
                }
            }
            

            removeArrayById($comm, $codecode);
            

            $new =   json_encode($comm , true);
            $stmt = $conn->prepare('UPDATE inside_class SET comments=? WHERE  time=? AND content=? AND code_class=?');
            $stmt->bind_param("ssss",$new,$time,$content,$code);
            $stmt->execute();
            header("Location: view.php");
            exit();




            // foreach ($comm as $id) {
            //     if($id == $codecode){
              
            //     }
            // }
            
            
            
        };
    }


       exit();
}
?>




<?php
include('../../../redundecyCode/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    if (isset($_POST['message'])) {
        $message = $_POST['message'];
        $italic = $_POST['content'];
        $bold = $_POST['content2'];
        $under = $_POST['content3'];
        $style = "font-style:" . $italic . ";" . "font-weight:" . $bold . ";" . "text-decoration:" . $under . ";";
        $date = date('h:i A');
        $image_Acount = $_COOKIE['image'];
        $comment = 'Null';
        $idd = $_SESSION['id'];
        $nameAcount = $_COOKIE['userName'];
        $image_Acountt = substr($image_Acount, 3,);
        if($profession == 'Teacher'){
            $image_Acounttt = "../../Teacher/$image_Acountt";
        }
        else{
            $image_Acounttt= "../../Student/$image_Acountt";
        }
        $emailAcountt = $_COOKIE['email'];
        $stmt = $conn->prepare("INSERT INTO inside_class (code_class, time, comments, image_account, content, style, name_Acount, email, Files) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt) {

            if (isset($_FILES['file']) && !empty($_FILES['file']['name'][0])) {
                $files = [];  
                $videos = [];
                $ide = $_SESSION['id'];
                $time = date('y-m-d h-i-s A');
                $uploadDir = "../uploadFiles/$ide/$time/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
                    $fileName = $_FILES['file']['name'][$key];
                    $fileTmp = $_FILES['file']['tmp_name'][$key];
                    $fileSize = $_FILES['file']['size'][$key];
                    $fileType = $_FILES['file']['type'][$key];

                    if ($fileSize > 400 * 1024 * 1024) { // Max size 400MB
                        echo "<script type='module'>
                        import { warning } from '../../../Toster/toster.js';
                        warning('الملف كبير جدًا');
                        </script>";
                        continue;
                    }

                    $filePath = $uploadDir . "/" . time() . "_" . basename($fileName);

                    if (move_uploaded_file($fileTmp, $filePath)) {

                        $files[] = [
                            'path' => $filePath,
                            'id' => $key + 1,
                            'title' => $fileName,
                        ];
                    }
                }


                $encodedFiles = json_encode($files, true); 

                $stmt->bind_param("sssssssss", $idd, $date, $comment, $image_Acounttt, $message, $style, $nameAcount, $emailAcountt, $encodedFiles);

                if ($stmt->execute()) {
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                }
            } else {
                 $n= NULL;
                $stmt->bind_param("sssssssss", $idd, $date, $comment, $image_Acounttt, $message, $style, $nameAcount, $emailAcountt, $n);

                if ($stmt->execute()) {
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                }
            }
        }
    }
}




if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Test'])) {
    if (isset($_POST['message'])) {
        $message = $_POST['message'];

         $style = "font-style:" . "normal" . ";" . "font-weight:" . "500" . ";" . "text-decoration:" . "none" . ";";
        $date = date('h:i A');
        $image_Acount = $_COOKIE['image'];
        $comment = 'Null';
        $idd = $_SESSION['id'];
        $codeTest = $_POST['Test'];
        $nameAcount = $_COOKIE['userName'];
        $image_Acountt = substr($image_Acount, 3,);
        if($profession == 'Teacher'){
            $image_Acounttt = "../../Teacher/$image_Acountt";
        }
        else{
            $image_Acounttt= "../../Student/$image_Acountt";
        }
        $emailAcountt = $_COOKIE['email'];
        $stmt = $conn->prepare("INSERT INTO inside_class (code_class, time, comments, image_account, content, style, name_Acount, email, Files , test) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)");

        if ($stmt) {

                 $ned=  $codeTest;
                 $n = Null ;
                $stmt->bind_param("ssssssssss", $idd, $date, $comment, $image_Acounttt, $message, $style, $nameAcount, $emailAcountt, $n ,$ned);

                if ($stmt->execute()) {
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                }
            }
        }
    }



else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['CommentSend'])){
    $comment = $_POST['sendComment'];
    $idComment = $_POST['idComment'];
    $idd2 = $_SESSION['id']; 
    include('../../../redundecyCode/connection.php');
    $stmt2 = $conn->prepare("SELECT comments FROM inside_class WHERE id = ? AND code_class=?");
    $stmt2->bind_param("ss", $idComment,$idd2);
    $stmt2->execute();
    $stmt2->bind_result($comments);
    $stmt2->fetch();
    if(is_null($comments)==false && $comments !== 'Null'){
        $array5 = json_decode($comments);
        $arrayThen = json_decode(json_encode($array5), true);
    
        $time2 = date('h:i A');
        $timea = date('h:i:s');
        $timee = date('y-m-d'); 
        $idCom = $_COOKIE['email'] . $timee . $timea ; 
        $commentNow = [
            'id' => $idCom,
            'time' => $time2,
            'name' => $_COOKIE['userName'],
            'comment'=> $comment,
            'image' => $_COOKIE['image'],
            'email' => $_COOKIE['email'],
            'profession'=> $profession
         ] ;
         $arrayThen[] = $commentNow;
         $commmx = json_encode($arrayThen);
          
    $idComment = $_POST['idComment'];
    $idd2 = $_SESSION['id']; 
    include('../../../redundecyCode/connection.php');
         $stmt4 = $conn->prepare("UPDATE inside_class SET comments = ? WHERE id = ? AND code_class=?");
         $stmt4->bind_param("sss",$commmx , $idComment , $idd2);
             if ($stmt4->execute()) {
                 header("Location: " . $_SERVER['PHP_SELF']);
                 exit();
             }
    }
    else{
        include('../../../redundecyCode/connection.php');
        $idComment = $_POST['idComment'];
        $idd2 = $_SESSION['id']; 
        $time2 = date('h:i A');
        $timea = date('h:i:s');
        $timee = date('y-m-d'); 
        $idCom2 = $_COOKIE['email'] . $timee . $timea ;
        $commentNow = [[
            'id' => $idCom2,
            'time' => $time2,
            'name' => $_COOKIE['userName'],
            'comment'=> $comment,
            'image' => $_COOKIE['image'],
            'email' => $_COOKIE['email'],
            'profession'=> $profession
        ]] ;
        $comm = json_encode($commentNow);
         $stmt5 = $conn->prepare("UPDATE inside_class SET comments = ? WHERE id = ? AND code_class=? ");
         $stmt5->bind_param("sss", $comm , $idComment , $idd2);
             if ($stmt5->execute()) {
                 header("Location: " . $_SERVER['PHP_SELF']);
                 exit();
             }

    }


}
else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ide'])){
    $id = $_POST['ide']; 
    include('../../../redundecyCode/connection.php');
    $stmt3 = $conn->prepare("SELECT Files FROM inside_class WHERE id = ? ");
    $stmt3->bind_param("s",$id);
    $stmt3->execute();
    $result = $stmt3->get_result();
    $row = $result->fetch_assoc();
    $f = Null ;
    if($row['Files'] !== NULL){
        $array = json_decode($row['Files']  , true);
        $f = $array[0]['path'];
    };





    function deleteFolderAndContents($folderPath) {
        // Check if the folder exists
        if (!is_dir($folderPath)) {
            return;
        }
    
        // Get all files and directories in the folder
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($folderPath, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );
    
        // Loop through the folder contents and delete them
        foreach ($files as $fileinfo) {
            $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
            $todo($fileinfo->getRealPath());  // Delete the file or directory
        }
    
        // Finally, remove the empty folder
        rmdir($folderPath);
    
        // echo "Folder and its contents have been deleted.";
    }
    
    // Example usage
    if($f !== Null ){
        $dir = dirname($f);
        deleteFolderAndContents($dir);

    }

    $stmt2 = $conn->prepare("DELETE  FROM inside_class WHERE id = ? ");

    $stmt2->bind_param("s",$id);
    $stmt2->execute();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../../../redundecyCode/linkBootstrap3.php') ?>
    <link rel="stylesheet" href="viewClassroomw.css">
    <title>Document</title>
</head>
<body class="x">

<?php
if($_COOKIE['profession'] == 'teacher'){
    include('../../../redundecyCode/navbarTeacher2.php') ;


} 
else{
    include('../../../redundecyCode/navbarStudent2.php') ; 
}
?>

<?php 

include('../../../redundecyCode/connection.php');
$emailAcount = $_COOKIE['email'];
$idd2 = $_SESSION['id'];
$a = json_encode($idd2);
$z =substr($a,2,-1);
$stmt2 = $conn->prepare("SELECT nameTeacher , image_Acount , class_Name ,sending FROM classroom WHERE code_class = ?");
$stmt2->bind_param("s", $z);
$stmt2->execute();
$result2 = $stmt2->get_result();

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {  
        $name1 = $row['nameTeacher'];
        $name2 = $row['class_Name'];
        $imageAcount2 = $row['image_Acount'];
        $sending = $row['sending'];
        $sendingNow = $sending; 
        $stmt3 = $conn->prepare("SELECT * FROM studentclassroom WHERE code_class = ?");
        $stmt3->bind_param("s", $z);
        $stmt3->execute();
        $result3 = $stmt3->get_result();
        $num = $result3->num_rows;

        $de ="";

        if($_COOKIE['profession'] == 'teacher'){
            $de = "
            <div class='d-flex it'>
            <div class=' header2 d-flex'>
            <p class='Name mt-2'>$z</p>
            <p class='Name mt-2'>-:كود الفصل</p>
            </div>
            </div>

            <div class='d-flex it'>
            <div class=' header2 d-flex'>
            <form action='./Attendees/Attendees.php' method='POST'>
            <li class='nav-item d-flex align-items-center'><button  class='Name d-flex  ' style='border:none; background-color:transparent;' type='submit' name='codee' value=' $z'>الحاضرين</button></li>
            </form>
            </div>
            </div> 

            <div class='d-flex it'>
            <div class=' header2 d-flex'>
            <form action='./Setting/Setting.php' method='POST'>
            <li class='nav-item d-flex align-items-center'><button  class='Name d-flex  ' style='border:none; background-color:transparent;' type='submit' name='codee' value=value=' $z'>إعدادات الفصل</button></li>
            </form>                
            </div>
            </div> 



" ;
        };
        echo "<div class='background row' id='background'>
        
        <div class='d-flex flex-column yy col-6 d-block .d-md-none'>
            <div class='header d-flex flex-row gap-2 justify-content-end p-2 '>
                <p class='Name mt-2'>$name1</p>
                <div class='nn'>
                    <img src='../$imageAcount2' alt='' id='imgAcount' style='width: 100%;'>
                </div>
            </div>
            <div class=' d-flex flex-row  gap-2 justify-content-between p-2'>          

                <div class='d-flex it'>
                <div class=' header2 d-flex'>
                <p class='Name mt-2'>$num</p>
                <p class='Name mt-2'>-:عدد الطلاب</p>
                </div>
                </div>




                $de
                <div class='d-flex it'>
                <div class=' header2 d-flex'>
                <p class='Name mt-2'>$name2</p>
                <p class='Name mt-2'>-:إسم الفصل</p>
                </div>
                </div>  
            </div>



        </div>
        </div>";   
    }
} else {
    echo  'this is =>' .  $vv;
}

?>

<?php
if($_COOKIE['profession'] == 'teacher'){
    $imge= '../'.$_COOKIE['image'];
    echo "<div class='advertisement d-flex flex-row gap-2 justify-content-between mt-3' data-bs-toggle='modal' data-bs-target='#modalPoster'>
    <button data-bs-toggle='modal' data-bs-target='#modal2' class='btn btn-danger m-2'>نشر الاختبار  </button>
    <div class='d-flex flex-row'>
    <p class='fer'> نشر للفصل</p>
    <div class='nn '>
        <img src='$imge'  id='imgAcount' style='width: 100%;'>
    </div>
    </div>
</div>";
}
else{
    if($sendingNow == 'yes'){
        $img= '../'.$_COOKIE['image'];
        $im =substr($img,2,);
        echo "<div class='advertisement d-flex flex-row gap-2 justify-content-end mt-3' data-bs-toggle='modal' data-bs-target='#modalPoster'>
        <p class='fer'>نشر للفصل</p>
        <div class='nn'>
            <img src='../../../Student/$im'  id='imgAcount' style='width: 100%;'>
        </div>
    </div>";
    }
}
?>


<div class="chat mt-2" id="chat">
<?php

include('../../../redundecyCode/connection.php');
$idd = $_SESSION['id']; 

// استعلام لجلب البيانات من داخل الفصل بناءً على الكود
$stmt = $conn->prepare("SELECT time, Files ,comments, image_account, content, style, name_Acount , id , email , test FROM inside_class WHERE code_class = ?");
$stmt->bind_param("s", $idd);
$stmt->execute();
$result = $stmt->get_result(); // الحصول على النتيجة من الاستعلام
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['name_Acount'];
        $time = $row['time'];
        $image_AcountUser = $row['image_account']; 
        $content = $row['content'];
        $style = $row['style'];
        $id = $row['id'];
        $emaild = $row['email'];
        $commentShow = json_decode($row['comments']);
        $array = json_decode(json_encode($commentShow), true);
        $file = $row['Files'];
        $test = $row['test'];
        $files = '';
        if($file !== NULL){
        $file = json_decode($row['Files'] , true);
        foreach ($file as $fl) {
            // الوصول إلى المفاتيح مع الحروف الكبيرة
            $idfile = $fl['id'];
            $titlefile = $fl['title'];
            $pathfile = $fl['path'];  // استخدام 'path' بدلاً من 'Path'

            $extension = pathinfo($pathfile, PATHINFO_EXTENSION);
          

            $typeFile= '';
              switch (strtolower($extension)) {
                    case 'pdf':
                        $typeFile= "../../../logos/pdf.png";
                        break;
                    case 'doc':
                    case 'docx':
                        $typeFile= "../../../logos/word.png";
                        break;
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                        $typeFile= "<img src='$files' alt='Image' style='max-width:100%; height:auto;'>";
                        break;
                    case 'zip':
                        $typeFile= "../../../logos/zip.png";
                        break ;
                    default:
                    $typeFile= 'Unknown file type (by extension). Checking MIME type...';
                        break;
                };

                
            

            // عرض الفيديو
            $files  .= "<div class='d-flex flex-row  mord' id='mord'>
            <div class='d-flex justify-content-between w-100'>
            <form method='POST'  class='d-flex justify-content-center  ' action='viewFile/viewFile.php'>
            <button type='submit' class='nameAndType ffgds' name='path' value='$pathfile'>$titlefile</button>
            </form>
            <div  class='img  '><img src='$typeFile' class='img2' id='img2'></div>
            </div>
            </div>";
        }

        

        }
        if($test  !== NULL ){
            $files  .= "<div class='d-flex flex-row  mord' id='mord'>
            <div class='d-flex justify-content-between w-100'>

            <form method='POST'  action='../../../Tests/ViewTest.php'>
                 <button  class='btn btn-primary btn-sm'  name ='codeGo' value='$test' style='font-size: 21px;'>دخول الامتحان</button>
            </form>
            

            <div  class='img  '><img src='hh' class='img2' id='img2'></div>
            </div>
            </div>";

        }
        $commentss='null';
        $D='';
        $E = '';

        $V='';
        $B = '';
        if($commentShow !== Null){
            $commentss='';
        foreach ($array as $value) {
            $idcD= $value['id'];
            $emailxx= $value['email'];
            if($emailxx == $_COOKIE['email']){
                    $V = "<p class='delEdd show'>:</p>";
                    $B = "<div class='lis w-xs-50' id='listA'>
                    <!--<button class='btn btn-light text-dark a'>تعديل</button>--!>
                    <form method='POST'>
                    <input value='$time' name='time' hidden>
                    <input value='$content' name='content' hidden>
                <button class='btn btn-danger text-light' value='$idcD' type='submit' name='ide'>حذف</button>
                </form>
                <button class='btn btn-primary z'>الغاء</button>
                </div>";
    }
    #خلي بالك احذف else لو حساب طال لو هتعمل نسخ
    else{
        if($_COOKIE['profession'] == 'teacher'){
            $V = "<p class='delEdd show'>:</p>";
                $B = "<div class='lis w-xs-50' id='listA'>
                <!--<button class='btn btn-light text-dark a'>تعديل</button>--!>
                <form method='POST'>
                <input value='$time' name='time' hidden>
                <input value='$content' name='content' hidden>
            <button class='btn btn-danger text-light' value='$idcD' type='submit' name='ide'>حذف تعليق المستخدم</button>
            </form>
            <button class='btn btn-warning'>حظر الإرسال</button>
            <button class='btn btn-primary z'>الغاء</button>
            </div>";

        }
        else{
            $V = '';
            $B = '';
        }
        
    }
                    $comentxx  =$value['comment'];
                    $namexx= $value['name'];
                    $timexx= $value['time'];

                    $imagexx= $value['image'];
                    $pro= $value['profession'];
                    $imagexx = substr($imagexx,3,);
                    $commentss .= "<div class='card' id='cardpro'>
                    <div class='card-header d-flex flex-row justify-content-between'>
                        <div class='s' id='first'>
                            $V  
                            $B
                        </div>
                    
                        <div class='d-flex' >
                            <div class='d-flex flex-column'>
                                <span class='nameAcount'>$namexx</span>
                                <span class='time' style='direction:rtl;'>$timexx</span>
                            </div>
                            <img src='../../../$pro/$imagexx'  alt='' class='imgAcount'>
                        </div>
                    
                    </div>
                    <div class='card-body' id='carddff'>
                        <div class='card-dailog'>
                            <p style='width:100%' id='prog'>$comentxx</p>
                        </div>
                    </div>
                    </div>";}
                    
        }



        if($emaild == $_COOKIE['email']){
            $D = "<p class='delEdd show'>:</p>";
            $E = "<div class='lis w-xs-50' id='listA'>
            <!--<button class='btn btn-light text-dark a'>تعديل</button>--!>
            <form method='POST'>
        <button class='btn btn-danger text-light' value='$id' type='submit' name='ide'>حذف</button>
        </form>
        <button class='btn btn-primary z'>الغاء</button>
        </div>";
    }
    #خلي بالك احذف else لو حساب طال لو هتعمل نسخ
    else{
        if($_COOKIE['profession'] == 'teacher'){
            $D = "<p class='delEdd show'>:</p>";
                $E = "<div class='lis w-xs-50' id='listA'>
                <!--<button class='btn btn-light text-dark a'>تعديل</button>--!>
                <form method='POST'>
            <button class='btn btn-danger text-light' value='$id' type='submit' name='ide'>حذف تعليق المستخدم</button>
            </form>
            <button class='btn btn-warning'>حظر الإرسال</button>
            <button class='btn btn-primary z'>الغاء</button>
            </div>";

        }
        
    }


        echo "<div class='card' id='cardpro'>
        <div class='card-header h'>
            <div class='d-flex'>
                <div class='column' style='direction: rtl;'>
                    <h6 class='nameAcount' style='    margin-top: 2px; margin-bottom: 0.3px;'>$name</h6>
                    <span class='time' >$time</span>
                </div>
                <img src='../$image_AcountUser' class='imgAcount'>
            </div>
            <div class='s' id='first'>
            $D
            $E
            </div>
        </div>
        <div class='card-body b' id='carddff'>
            <div class='card-dailog d'>
                <textarea name='' id='prog' style='border: none;width: 100%; height:100%; resize: none; background-color:transparent; $style' disabled>$content</textarea>
                <div style='width: 100%;' id='parent'class='d-flex flex-column gap-2' >$files</div>
            </div>
        </div>
        <div class='card-footer fd' id='gg'>
            <p class='text-dark nnv' id='nnf'>إضافة تعليق</p>
            <div class='comments card' id='comments'>
                <div class='card-header d-flex flex-row justify-content-between head'>
                    <button type='button' class='btn-close' aria-label='Close'></button>
                    <p>التعليقات</p>
                </div>
                <div class='card-body body2 d-flex flex-column gap-2 overflow-auto'>$commentss</div>
                <form method='POST'>
                <div class='card-footer d-flex flex-row justify-content-between foo'>
                <input type='text' class='text' id='text'  name='sendComment' placeholder='ارسل تعليق'  >
                <input type='text' hidden name='idComment' value='$id'> 
                <button class='btn-send' type='submit' name='CommentSend'><div id='se11111'><img src='../../../logos/paper-plane.png' class='clic sendd'></div></button>
                
                
                
                </div>
                </form>
            </div>
        </div>
        </div>";

    }
} else {
     //صورة رائعه تعبر عن ان الشئ  عرض رسالة في حالة عدم وجود بيانات
}

?>
</div>


<div class="modal fade" id="modalPoster">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between flex-row-reverse">
                <h4 class='text-dark'>نشر للفصل</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" id='btn-close'></button>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" >
                <div class="modal-body row d-flex justify-content-end modall">
                    <textarea id="textEdit" name='message' placeholder="الموضوع"></textarea>
                    <input id="content" name='content' value='normal' hidden>
                    <input id="content2" name='content2' value='normal' hidden>
                    <input id="content3" name='content3' value='none' hidden>
                    <div class="div d-flex flex-row gap-2">
                        <img src="../../../logos/italic.png" class="edit" id="italic">
                        <img src="../../../logos/bold-text.png" class="edit" id="bold">
                        <img src="../../../logos/text.png" class="edit" id="under">
                    </div>
                    <hr>
                    <div class="file d-flex flex-row gap-2">
                         <img src="../../../logos/upload.png" class="edit" id="uplod"> 
                        <input type="file" class="form-control" multiple name="file[]" id="up" hidden >
                    </div>
                    <hr>
                    <div id="files" class='d-flex flex-column gap-2 p-3'></div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-success m-auto w-50" type="submit" name="submit" value="نشر">
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modal2">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="modal-body row d-flex justify-content-end modall gap-2 p-4">

                        <input name='Test' class='p-3' style='direction:rtl; border:1px solid black; border-radius:10px' placeholder="كود الإختبار" >
                        <textarea id="textEdit" name='message' placeholder="الموضوع" class='p-2 '></textarea>

                            <button type="submit" class="btn btn-success w-100 mt-3">نشر الإختبار</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php include('../../../redundecyCode/linkBootstrapJs2.php') ?>
<script src="viewNewm.js"></script>
</body>
</html>

