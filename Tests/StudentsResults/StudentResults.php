<?php 

include('../../redundecyCode/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['code'])  && isset($_POST['ema'] ) ) {
    $code = $_POST['code'];
    $ema = $_POST['ema'];

    $query = "DELETE FROM resulttest WHERE code = ? And email=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $code , $ema);

    if ($stmt->execute()) {
        echo "تم الحذف بنجاح.";
    } else {
        echo "حدث خطأ أثناء الحذف.";
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
  <!-- Bootstrap CSS -->
<?php include('../../redundecyCode/linkBootstrap2.php') ?>
  <link href="../../Teacher/TestManagement/TestManagement.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <h1>Tests Management</h1>
    <div class="table-container">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">result</th>
            <th scope="col">total</th>
            <th scope="col">status</th>
            <th scope="col">email</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>

        <?php
        include('../../redundecyCode/connection.php');
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['code'])) { 
        $sql= 'SELECT * FROM resulttest WHERE code = ?';
        $stmt = $conn->prepare($sql);
        $cc = $_POST['code'];
        $stmt->bind_param('s' , $cc);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $name = $row['name'];
                $emai = $row['email'];
                $resultt = $row['result'];
                $total = $row['total'];
                $status = $row['status'];
                $bg = '';
                if($status == 'succeeded'){
                    $bg = 'bg-success';

                }
                else{
                    $bg = 'bg-danger' ;
                }
                $numRows = ++$i;

                echo "<tr>
                <th scope='row'>$numRows</th>
                <td>$name</td>
                <td>$resultt</td>
                <td > <p class='$bg rounded'> $status </p></td>
                <td >$total</td>
                <td >$emai</td>
                <td class=''>
                <div class='d-flex flex-row justify-content-center gap-2'>
                  <form method='POST' onsubmit=`return confirm('Do you want to delete it?);`>
                  <input name='ema'  value = '$emai' hidden>
                  <button value = '$cc' class='btn btn-danger btn-sm' name='code'>Delete</button>
                  </form>
                  </div>
                </td>
              </tr>
              <tr>";

            };
        }
    }
        ?>
          <!-- Example Row -->

        </tbody>
      </table>
    </div>
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <?php include('../../redundecyCode/linkBootstrapJs.php') ?>
</body>

</html>