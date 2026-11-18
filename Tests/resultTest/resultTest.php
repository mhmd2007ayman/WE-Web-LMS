
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Advanced Quiz Platform</title>
  <?php
  include('../../redundecyCode/linkBootstrap2.php')
  ?>
  <link rel="stylesheet" href="resultTest.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>
  <div class="container">
  <?php
        session_start();
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['code'])){


           $code = $_POST['code'];
    include('../../redundecyCode/connection.php');
    $sql = 'SELECT * FROM test WHERE codeTest = ?';
    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $code);
    $stm->execute();
    $result = $stm->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC); // تحويل النتائج إلى مصفوفة
    $array = json_decode($data[0]['Test']);
    $list = json_decode(json_encode($array), true);
        $i=0;
        $d=0;
        $numberQuestions=0;
        $correctAnswerArray = [];
        $answerStudentArray=[];
        $grades = []; 
        $numberQuestions =0;
        foreach ($list as $correctAnswer) {
            $num = 'Q'.++$i;
                $Answers = $correctAnswer['correctAnswer'];
                $grade = $correctAnswer['grade'];
                $correctAnswerArray["$num"] = "$Answers";
                $grades["$num"] = "$grade";
                $numberQuestions =++$numberQuestions; 
        }
        
        for ($i=0; $i < $numberQuestions  ; $i++) { 
            $num = 'Q'.++$d;
            $Answerss = $_POST["$num"];
            $answerStudentArray["$num"] = "$Answerss";
        }


        $difference = array_diff($correctAnswerArray, $answerStudentArray);

        $differentKeys = array_keys($difference);
        
$wrong = 0;

        foreach ($differentKeys as $key) {
            if (isset($grades[$key])) {
                $wrong += $grades[$key]; 
                 
            }
        }

        $totalGrades = array_sum($grades);
        
        $gradeStudent = $totalGrades - $wrong;
$sta = '';
        if($totalGrades/2 <= $gradeStudent){

            echo "    <h1 id='quiz-title'>You succeeded</h1>
            <img src='../../Toster/icons/sucsses.svg' class='icon'> 
            <p id='quiz-description'>$totalGrades/$gradeStudent</p>";
            $sta = 'succeeded';


        }
        else {
            echo "    <h1 id='quiz-title'>You failed</h1>
            <img src='../../Toster/icons/Faild.svg' class='icon'>
            <p id='quiz-description'>$totalGrades/$gradeStudent</p>";
            $sta = 'failed';

        }

        $sql22 = 'INSERT INTO `resulttest`(`email`, `result`, `status`, `total`, `name` , `code`) VALUES (?,?,?,?,?,?)';
    $stm22 = $conn->prepare($sql22);
    $emaill = $_COOKIE['email'];
    $nameee = $_COOKIE['userName'];
    $stm22->bind_param('ssssss', $emaill , $gradeStudent , $sta , $totalGrades , $nameee , $code );
    $stm22->execute();
        exit();
    }
?>

</body>

</html>