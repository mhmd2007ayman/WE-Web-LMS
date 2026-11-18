<?php
$script = 'no';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // استلام بيانات JSON من الطلب
    // $input = json_decode(file_get_contents('php://input'), true);

    if (isset($_POST['codeGo'])) {
        $quiz_code = $_POST['codeGo'];

   include('../../redundecyCode/connection.php');
   $sql = 'SELECT * FROM test WHERE codeTest = ?';
$stm = $conn->prepare($sql);
$stm->bind_param('s', $quiz_code);
$stm->execute();
$result = $stm->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);

        $questions = $data[0]['Test'];
        $titleUpdate = $data[0]['title'];
        $descriptionUpdate = $data[0]['description'];
        $script = 'yes';

        $uploudButton = '<button type="submit" id="update" class="btn btn-save mt-4">Update</button>';

        // $jsonQuestions = json_encode($questions, JSON_UNESCAPED_UNICODE);

        // echo $array;
    } else {
        echo json_encode(['error' => 'Quiz code is missing.']);
    }
}
?>

<?php  if(isset($_POST['codeGo'])){echo "<input id='codecode' type='hidden' value='$quiz_code' ";}; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../../redundecyCode/linkBootstrap2.php'); ?>
    <link rel='stylesheet' href='../../Toster/toster.css'>
    <link rel='stylesheet' href='test.css'>
    <!-- <link rel='stylesheet' href='../../toastr-2.1.1/build/toastr.min.css'> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <title>Create Quiz</title>
</head>
<body>
<div class="notifications"></div>
<div class="container">
    <!-- Quiz Builder -->
    <div class="quiz-builder">
        <h2>
            <?php if(isset($_POST['codeGo'])){echo 'Update Your Interactive Test';}else{echo 'Create Your Interactive Test';} ?>
            
        </h2>
        <form id="<?php if(isset($_POST['codeGo'])){echo 'Update';}else{echo 'quiz-form';} ?>" method="POST">
            <!-- Quiz Title -->
            <div class="mb-3">
                <label for="quiz-title" class="form-label">Test Title</label>
                <input type="text" id="quiz-title" name="quiz_title" class="form-control" placeholder="Enter quiz title..." required <?php if(isset($titleUpdate)){echo "value='$titleUpdate' ";}?>>
            </div>

            <!-- Quiz Description -->
            <div class="mb-3">
                <label for="quiz-description" class="form-label">Test Description</label>
                <textarea id="quiz-description" name="quiz_description" class="form-control" placeholder="Enter quiz description..." required ><?php if(isset($descriptionUpdate)){echo $descriptionUpdate ;}?></textarea>
            </div>

            <!-- Questions -->
            <div id="questions-container"></div>

            <!-- Add Question Button -->
            <button type="button" class="btn add-question-btn" id="add-question-btn">+ Add Question</button>

            <!-- Save Quiz Button -->
            <?php
            if(isset($uploudButton)){
                echo $uploudButton;
            }
            else{
                echo '<button type="submit" class="btn btn-save mt-4">Save Quiz</button>';

            } 
            ?>
            
        </form>
    </div>
</div>

<!-- <script src='../../toastr-2.1.1/build/toastr.min.js'></script> -->
<?php 
if ($script == 'yes') {
    // تحويل مصفوفة PHP إلى JSON صالح
    $jsonQuestions = json_encode($questions, JSON_UNESCAPED_UNICODE);

    echo "<script type='module'  defer>
        window.questions = $jsonQuestions;
         // اختبار البيانات في المتصفح
    </script>";

    echo "<script type='module' src='update.js' defer>
</script>";
}
else{
    echo "<script type='module' src='test.js' defer></script>";
}
?>
<script src="Sortable-master/Sortable.min.js"></script>





   <!-- <script src='update.js'>
  // إرسال بيانات الأسئلة من PHP إلى JavaScript (في الملف الخارجي)
  const questions = $questions;
  // نقوم بتخزين البيانات في window لتكون متاحة في الملف الخارجي
  window.questions = questions;
</script>` -->


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
</body>
</html>



