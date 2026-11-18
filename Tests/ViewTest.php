<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Advanced Quiz Platform</title>
  <?php
  include('../redundecyCode/linkBootstrap.php')
  ?>
  <link rel="stylesheet" href="ViewTest.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>
  <div class="container">
    <?php
    session_start();
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['codeGo'])) {
        $_SESSION['codeGo'] = $_POST['codeGo'];
           $x = $_POST['codeGo'];
           header("Location: ViewTest.php");
           exit();
    }
    $code = $_SESSION['codeGo'];
    include('../redundecyCode/connection.php');
$sql = 'SELECT * FROM test WHERE codeTest = ?';
$stm = $conn->prepare($sql);
$stm->bind_param('s', $code);
$stm->execute();
$result = $stm->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC); // تحويل النتائج إلى مصفوفة
$array = json_decode($data[0]['Test']);
$list = json_decode(json_encode($array), true);

    $i=0;
    $numberQuestions=0;
    $correctAnswerArray = [];
    foreach ($list as $correctAnswer) {
            $num = 'Q'.++$i;
            $numberQuestions =++$numberQuestions; 
            // $Answers = $correctAnswer['correctAnswer'];
            // $correctAnswerArray["$num"] = "$Answers";
    }
 $title = $data[0]['title'];
 $description = $data[0]['description'];

    ?>
    <h1 id="quiz-title"><?php echo $title ; ?></h1>
    <p id="quiz-description"><?php echo $description ; ?></p>
<div class='d-flex gap-2 qs'><?php echo '<span id="quiz-description"> Number of questions:- </span>' . "<span class='spand'>$numberQuestions </span>" ?></div>
    <form id="quiz-form" method='POST' action='resultTest/resultTest.php'>
<?php
    $numQuestion=0;
    $sumGrades= 0;
    foreach ($list as $correctAnswer) {
      $grade = $correctAnswer['grade'];
            $num = 'Q'.++$numQuestion;
            $sumGrades = $sumGrades+$grade;
            if($correctAnswer['type'] == 'multiple-choice'){
                $title = $correctAnswer['title'];
                $grade = $correctAnswer['grade'];
                $part1 = "
                <div class='question'>
                <div class='d-flex align-items-center justify-content-space-between'>
                  <label for='$num'>$title</label>
                  <div class='grade'>$grade</div>
                </div>
                <hr>
                ";
                $options = $correctAnswer['options'];
                $choices = '';
                
                $ii=0;
                foreach ($options as $opt){
                    $op  =  $num .'-' .++$ii;
                    $question ="
                    <div class='form-check'>
                      <input class='form-check-input' type='radio' name='$num' id='$op' value='$opt'>
                      <label class='form-check-label' for='$op'>
                      $opt
                      </label>
                    </div>
                    ";
                    $choices = $choices.$question;
                }
                $Answer = $part1 .$choices . '</div>'  ;
                echo $Answer;
            }
            else if($correctAnswer['type'] =='short-answer'){
                $title = $correctAnswer['title'];
                $grade = $correctAnswer['grade'];
                $question = "
                <div class='question'>
                <div class='d-flex align-items-center justify-content-space-between'>
                  <label for='$num'>$title</label>
                <div class='grade'>$grade</div>
                </div>
                <hr>
                <input type='text' name='$num' class='form-control mt-2' placeholder='Your answer...' required>
              </div>
                ";
                echo $question;
            }
            else{
                $title = $correctAnswer['title'];
                $grade = $correctAnswer['grade'];
                $question = "<div class='question'>
                <div class='d-flex align-items-center justify-content-space-between'>
                  <label for='$num'>$title </label>
                <div class='grade'>$grade</div>
                </div>
                <hr>
                <div class='justify-content-center d-flex w-100' >
                  <textarea name='$num' id='' cols='160' rows='10' placeholder='Your answer...' style=' border-radius: 15px;'></textarea>
                </div>
                
              </div>";
              echo $question;
            }
    }
    
?>
      <input  value='<?php echo $sumGrades ?>' type="hidden">
      <button type="submit" class="btn mt-4"  name='code' value='<?php echo $code ?>'>Submit Answers</button>
    </form>
  </div>
</body>

</html>