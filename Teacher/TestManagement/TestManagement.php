<?php 

include('../../redundecyCode/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['code'])) {
    $code = $_POST['code'];

    $query = "DELETE FROM test WHERE codeTest = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $code);

    if ($stmt->execute()) {
      echo "<script type='module'>
      import { success } from '../../Toster/toster.js';
      success('تم   الحذف  بنجاح');
  </script>";
    } else {
      echo "<script type='module'>
      import { error } from '../../Toster/toster.js';
      error(' لم يتم الحذف ');
  </script>";
    }

    $stmt->close();
    $conn->close();
}
// else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codeGo'])) {

    
// }
?>






<!-- <button  class='btn btn-primary btn-sm'  onclick={ window.location.href='../../Tests/ViewTest.php?id=<?php echo $codeTest; ?>'; }>Show</button> -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tests Table</title>
  <?php include('../../redundecyCode/linkBootstrap2.php') ?>
  <link rel="stylesheet" href="../../Toster/toster.css">
  <link href="TestManagement.css" rel="stylesheet">
</head>

<body>
<div class="notifications"></div>
  <div class="container">
    <h1>Tests Management</h1>
    <div class="table-container">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Code</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>

        <?php
        include('../../redundecyCode/connection.php');
        $email = $_COOKIE['email'];
        $sql= 'SELECT * FROM test WHERE email = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' , $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $title = $row['title'];
                $description = $row['description'];
                $codeTest = $row['codeTest'];
                $numRows = ++$i;

                echo "<tr>
                <th scope='row'>$numRows</th>
                <td>$title</td>
                <td>$description</td>
                <td>$codeTest</td>
                <td class=''>
                <div class='d-flex flex-row justify-content-center gap-2'>
                <form method='POST'  action='../../Tests/ViewTest.php'>
                <button  class='btn btn-primary btn-sm'  name ='codeGo' value='$codeTest'>Show</button>
                </form>
                <form method='POST' action='../createTest/test.php'>
                  <button name='codeGo' value='$codeTest' class='btn btn-warning btn-sm'>Update</button>
                  </form>
                  <form method='POST' onsubmit=`return confirm('Do you want to delete it?);`>
                  <button value = '$codeTest' class='btn btn-danger btn-sm' name='code'>Delete</button>
                  </form>

                  </form>
                  <form method='POST' action='../../Tests/StudentsResults/StudentResults.php'>
                  <button value = '$codeTest' class='btn btn-info btn-sm ' style='height:100%' name='code'>Students</button>
                  </form>

   
                  </div>
                </td>
              </tr>
              <tr>";

            };
        }
        ?>

          <!-- Example Row -->

        </tbody>
      </table>
    </div>
  </div>

  <?php include('../../redundecyCode/linkBootstrapJs.php') ?>
  <script type='module' src="../../Toster/toster.js" defer></script>
</body>

</html>
