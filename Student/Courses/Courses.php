<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('../../redundecyCode/linkBootstrap2.php') ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<!-- Template Stylesheet -->
<link href="Courses.css" rel="stylesheet">

</head>
<body>

<?php
    include('../../redundecyCode/navbarStudent.php') ;  
?>
<div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
            </div>
            <div class="row g-4 justify-content-center">


                <?php
                include('../../redundecyCode/connection.php');
                $sql = 'SELECT * FROM courses';
                $courses = $conn->prepare($sql);
                $courses->execute();
                $result = $courses->get_result();  
                if($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                    $image = $row['Image'];
                    $title = $row['title'];
                    $price = $row['Price'];
                    $duration = $row['duration'];
                    $Name = $row['NameTeacher'];

                    echo "<div class='col-lg-4 col-md-6 wow fadeInUp' data-wow-delay='0.1s'>
                    <div class='course-item bg-light'>
                        <div class='position-relative overflow-hidden'>
                            <img class='img-fluid' src='$image' >
                            <div class='w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4'>
                                 <form method='POST' action='../../payment/checkout.php'> 
                                 <input value='$price' name='price' hidden>
                                 <input value='$title' name='title' hidden>
                                <button  class='flex-shrink-0 btn btn-sm btn-primary px-3 btn' >الالتحاق بالدورة</button>
                                </form>
                            </div>
                        </div>
                        <div class='text-center d-flex flex-column gap-1 p-4 pb-0'>
                        <h5 class='mb-4'>$title</h5>
                        
                            <h3 class='mb-0 d-flex  justify-content-center flex-row-reverse mb-3'><span>$price</span> <span>جنيه</span> </h3>

                        </div>
                        <div class='d-flex border-top'>
                            <small class='flex-fill text-center border-end py-2'><i class='fa fa-user-tie text-primary me-2'></i>$Name</small>
                            <small class='flex-fill text-center border-end py-2'><i class='fa fa-clock text-primary me-2'></i>$duration</small>
                            <small class='flex-fill text-center py-2'><i class='fa fa-user text-primary me-2'></i>30 Students</small>
                        </div>
                    </div>
                </div>";
                }
            }
                ?>
                <!-- <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/course-2.jpg" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                                <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a>
                            </div>
                        </div>
                        <div class="text-center p-4 pb-0">
                            <h3 class="mb-0">$149.00</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small>(123)</small>
                            </div>
                            <h5 class="mb-4">Web Design & Development Course for Beginners</h5>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>John Doe</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>1.49 Hrs</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>30 Students</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/course-3.jpg" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                                <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a>
                            </div>
                        </div>
                        <div class="text-center p-4 pb-0">
                            <h3 class="mb-0">$149.00</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small>(123)</small>
                            </div>
                            <h5 class="mb-4">Web Design & Development Course for Beginners</h5>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>John Doe</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>1.49 Hrs</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>30 Students</small>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</body>
</html>