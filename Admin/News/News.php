<?php 
$active = 'news';
if($_SERVER['REQUEST_METHOD']== 'POST'){
  $idNew = $_POST['btn'];

  include('../../redundecyCode/connection.php');
  $stm = $conn->prepare('DELETE  FROM news WHERE id=?');
  $stm->bind_param('s',$idNew);
  $stm->execute();

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../../redundecyCode/linkBootstrap2.php') ?>
    <link rel="stylesheet" href="http://localhost/WE_Web%20(Update)/redundecyCode/editNavAdminn.css">
    <link rel="stylesheet" href="News.css">
    <title>News</title>
</head>
<body>
    <?php
    include('../../redundecyCode/navbarAdmin.php')
    ?>
    <br>
    <br>
    <br>
<div class="container">
<table class="table">
  <thead class='thead'>
    <tr >
  <th scope="col">NewsDetails</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        
            <th scope="col"><button class='btn btn-primary' >Profession</button></th>
</tr>

  </thead>
        
        <thead >
          <tr class='tr'>
            <th scope="col">title</th>
            <th scope="col">content</th>
            <th scope="col">date</th>
            <th scope="col">created at</th>
            <th scope="col">expires at</th>
            <th scope="col">option</th>
          </tr>
        </thead>
        
        <tbody id="table">
            <?php
            include('../../redundecyCode/connection.php');
            $stm = $conn->prepare('SELECT * FROM news');
            $stm->execute();
            $result = $stm->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()){
                    $title = $row['title'];
                    $content = $row['content'];
                    $created_at = $row['created_at'];
                    $date = $row['Publish'];
                    $expires_at = $row['expires_at'];
                    $date = substr($date , 0,9);
                    $created_at = substr($created_at , 0,9);
                    $expires_at = substr($expires_at , 0,9);
                    $id = $row['id'];
                    echo "<tr>
               <th class='td'>$title</th>
               <th class='td'>$content</th>
               <th class='td'>$date</th>
               <th class='td'>$created_at</th>
               <th class='td'>$expires_at</th>
               <th class='td'><form method='POST' class='w-100'><button type='submit' value ='$id' class='btn btn-danger' name='btn'>حذف الخبر</button></form></th>
               </tr>
               ";
    
                }
            }
            
    
            ?>
    
    
        </tbody>
      </table>
</div>
<?php include('../../redundecyCode/linkBootstrapJs.php') ?>
</body>
</html>