<nav class=" mt-1 navbar navbar-dark  fixed-top nnb">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header bgg">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">WE-Web</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class='d-flex justify-content-center bgg'>
                <div class="d-flex flex-column-reverse im ">
                <div class='d-flex w-100 mt-1'>
            <a class='w-100 btnn' href='http://localhost/WE_Web%20(Update)/Admin/homeAdmin/homeAdmin.php'><img src="../../imageAdmin/notification.png" style='width: 26%; justify-content: center; display: flex; margin:auto'></a>
            <a class='w-100 btnn' href='http://localhost/WE_Web%20(Update)/Admin/setting/setting.php'><img src="../../imageAdmin/cogwheel.png" style='width: 26%; justify-content: center; display: flex;margin:auto'></a>
           </div>
           <?php
           include('../../redundecyCode/connection.php');
           $stm = $conn->prepare('SELECT user_name , email , image_Acount FROM users WHERE  Profession =?');
           $Admin = 'Admin';
           $stm->bind_param('s', $Admin);
           $stm->execute();
           $result = $stm->get_result();
           if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()){
                   $name = $row['user_name'];
                   $email = $row['email'];
                   $image_Acount = $row['image_Acount'];
                   echo "
                   <p style='font-size:11px' class='AdminP D'>$email</p>
            <p class='AdminP'>$name</p>
            <div class='nn AdminP'>
                <img src='$image_Acount'  id='imgAcount' style='width: 100%; height:100%'>
           </div>
                   ";
                  }}
           ?>
                  

          </div>
</div>
            <div class="offcanvas-body">

              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item d-flex flex-row gap-2 <?php if($active == 'users'){echo 'activee';} ?> p-1">
                    <img src="../../imageAdmin/user (1).png"  style="width: 40px;">
                  <a class="nav-link text-dark " aria-current="page" href="http://localhost/WE_Web%20(Update)/Admin/users/userAdmin.php" style="font-weight: bold;">users</a>
                </li>
                <li class="nav-item d-flex flex-row p-1 gap-3 <?php if($active == 'news'){echo 'activee';} ?>" style="margin-left: -1px; ">
                    <img src="../../imageAdmin/megaphone.png" alt="" style="    width: 26%; margin-left: 0px;">
                  <a class="nav-link text-dark" href="http://localhost/WE_Web%20(Update)/Admin/News/News.php" style="    font-weight: bold; margin-left: -3px; font-size: 15px;" >news</a>
                </li>

                <li class="nav-item d-flex flex-row p-1 gap-3 <?php if($active == 'classroom'){echo 'activee';} ?>" style="margin-left: -1px;">
                  <img src="../../imageAdmin/lecture.png" alt="" style="width: 46px;margin-left: 0px;">
                <a class="nav-link text-dark" href="http://localhost/WE_Web%20(Update)/Admin/ClassRoom/ClassRoom.php" style="    font-weight: bold; margin-left: -3px; font-size: 15px;display: flex;align-items: center;" >classRoom</a>
              </li>

              <!-- <li class="nav-item d-flex flex-row <?php if($active == 'student'){echo 'activee';} ?>" style="margin-left: -1px;">
                <img src="../../imageAdmin/graduated.png" alt="" style="width: 54px;margin-left: 0px;">
              <a class="nav-link text-dark" href="/offer2" style="font-weight: bold; margin-left: -3px; font-size: 15px; display:flex ; align-items:center" >student</a>
            </li> -->
            <li class="nav-item d-flex flex-row gap-3 <?php if($active == 'Courses'){echo 'activee';} ?>" style="margin-left: 4px;">
                <img src="../../imageAdmin/online-learning.png" alt="" style="    width: 45px; margin-left: 0px;">
              <a class="nav-link text-dark" href="http://localhost/WE_Web%20(Update)/Admin/Courses/Courses.php" style="font-weight: bold;margin-left: -3px;font-size: 15px;align-items: center;display: flex;" >Courses</a>
            </li>

               
              </ul>

            </div>
          </div>
        </div>
      </nav>

