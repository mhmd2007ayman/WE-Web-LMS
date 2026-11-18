<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive PDF Viewer</title>
    <!-- Link to Bootstrap CSS -->
   <?php include('../../../../redundecyCode/linkBootstrap.php') ?>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="embed-responsive embed-responsive-16by9">
            <?php
            $files = '';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $file = $_POST['path'];  // يجب التأكد من إرسال الملف عبر POST
                $files = '../' . $file;
            } else {
                // قم بتحديد مسار ثابت للاختبار
                $files = '../../uploadFiles/BV.+_/25-02-12 10-15-56 AM/r1739351756_laravel.docx';
            }

            // التحقق من امتداد الملف
            $extension = pathinfo($files, PATHINFO_EXTENSION);

            if ($extension) {
                switch (strtolower($extension)) {
                    case 'pdf':
                        echo "<embed src='$files' type='application/pdf' width='100%' height='600px' id='file'>";
                        break;
                    case 'doc':
                    case 'docx':
                        echo "<iframe src='$files' width='100%' height='600px' id='file'></iframe>";
                        break;
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                        echo "<img src='$files' alt='Image' style='max-width:100%; height:auto;' id='file'>";
                        break;
                    default:
                        echo 'Unknown file type (by extension). Checking MIME type...';
                        break;
                }
                header('./view.php');
            } else {
                echo 'No extension found. Checking MIME type...';
            }
            ?>
            </div>
        </div>
    </div>
</div>
<?php 

// echo "
// <script>
// //   document.getElementById('fileInput').addEventListener('change', function(event) {document.getElementById('fileInput').addEventListener('change', function(event) {,hfhgfgsdfgdfdgfdhjhgfdfgdfg
    
//     const file = $files.files[0];
    
//     if (file) {
//       const fileExtension = $extension

//       // Example of handling based on file extension
//       if (fileExtension === 'txt') {
//         readTextFile(file);
//       } else if (fileExtension === 'json') {
//         readJsonFile(file);
//       } else if (fileExtension === 'pdf') {
//         readPdfFile(file);
//         readImageFile(file);
//       } else {
//         alert('Unsupported file type!');
//       }
//     }
  

//   function readTextFile(file) {
//     const reader = new FileReader();
//     reader.onload = function(event) {
//       const iframe = document.getElementById('file');
//       iframe.srcdoc = `<pre>${event.target.result}</pre>`;  // Display text content in iframe
//     };
//     reader.readAsText(file);
//   }

//   function readJsonFile(file) {
//     const reader = new FileReader();
//     reader.onload = function(event) {
//       try {
//         const jsonContent = JSON.parse(event.target.result);
//         const iframe = document.getElementById('file');
//         iframe.srcdoc = `<pre>${JSON.stringify(jsonContent, null, 2)}</pre>`;  // Display formatted JSON
//       } catch (e) {
//         alert('Invalid JSON file.');
//       }
//     };
//     reader.readAsText(file);
//   }

//   function readPdfFile(file) {
//     const reader = new FileReader();
//     reader.onload = function(event) {
//       const iframe = document.getElementById('file');
//       iframe.src = event.target.result;  // Display PDF inside iframe
//     };
//     reader.readAsDataURL(file);
//   }

//   function readImageFile(file) {
//     const reader = new FileReader();
//     reader.onload = function(event) {
//       const iframe = document.getElementById('file');
//       iframe.src = event.target.result;  // Display image inside iframe
//     };
//     reader.readAsDataURL(file);
//   }
// </script>


// ";


?>
<!-- Link to Bootstrap JS (optional) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

</body>
</html>
