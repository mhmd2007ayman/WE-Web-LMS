<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>playlist</title>
    <link rel="stylesheet" href="playlist.css">
    <!-- <?php include('../../../redundecyCode/linkBootstrap3.php') ?> -->
</head>

<body>
    <main class="container">
        <section class="main-video">
            <video src="" controls autoplay   id='vid'></video>
            <h3 class="title" id='tit'></h3>
        </section>
        <?php

include('../../../redundecyCode/connection.php');
if (isset($_GET['title'])) {
    $title = $_GET['title'];
    $sql = 'SELECT * FROM courses WHERE title = ?';
    $courses = $conn->prepare($sql);
    $courses->bind_param('s', $title);
    $courses->execute();
    
    $result = $courses->get_result();  
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $title = $row['title'];
            $File = $row['Files'];
            $duration = $row['duration'];
    
            // طباعة محتوى الحقل Files للتحقق من البيانات المخزنة
    
            // فك الشيفرة من JSON إلى مصفوفة
            $file2 = json_decode($File , true);
            $file3 = json_decode(json_encode($file2), true);
            // التحقق مما إذا كانت عملية فك الشيفرة ناجحة
            if (is_array($file2)) {
                $len = count($file2);  // عدد الفيديوهات
                echo "
                <section class='video-playlist'>
                <h3 class='title'>$title</h3>
                <p>$len lessons &nbsp; . &nbsp; $duration</p>
                <div class='videos'>
                ";
    
                // عرض مقاطع الفيديو
                foreach ($file2 as $video) {
                    // الوصول إلى المفاتيح مع الحروف الكبيرة
                    $idVideo = $video['id'];
                    $titleVideo = $video['title'];
                    $durationVideo = $video['duration'];
                    $pathVideo = $video['path'];  // استخدام 'path' بدلاً من 'Path'
                    $num = '0'.$idVideo;
                    if($idVideo >9){
                        $num = $idVideo;
                    }
    
                    // عرض الفيديو
                    echo "<div class='video' data-id='$idVideo'>
                        <img src='images/play.svg'>
                        <p>$num</p>
                        <h3 class='title'>$titleVideo</h3>
                        <p class='time'>$durationVideo</p>
                    </div>";
                }
                echo '</div></section>';
            } else {
                echo "<p>Error decoding JSON data.</p>";  // إذا كانت البيانات غير صحيحة
            }
        }
    }
} else {
    echo "<h2>لم يتم العثور على الدورة!</h2>";
}
 


?>
    </main>
    <?php
    $dd=json_encode($file2);
    $first= $file2[0]['path'];
    $first2= $file2[0]['title'];
    echo "<script>
    let data = $dd ;
    let tit =document.getElementById('tit')
    let vid =document.getElementById('vid')
    vid.src = `../$first`   ;
    tit.innerHTML= `Lesson 1 :-  $first2`;
    const main_video = document.querySelector('.main-video video');
const main_video_title = document.querySelector('.main-video .title');
const video_playlist = document.querySelector('.video-playlist .videos');

let videos = document.querySelectorAll('.video');
videos[0].classList.add('active');
videos[0].querySelector('img').src = 'images/pause.svg';

videos.forEach(selected_video => {
    selected_video.onclick = () => {

        for (all_videos of videos) {
            all_videos.classList.remove('active');
            all_videos.querySelector('img').src = 'images/play.svg';

        }

        selected_video.classList.add('active');
        selected_video.querySelector('img').src = 'images/pause.svg';

        let match_video = data.find(video => video.id == selected_video.dataset.id);
        let id =selected_video.dataset.id
        main_video.src = '../' + match_video.path;
        main_video_title.innerHTML ='Lesson ' + id + ' :-' + match_video.title;
    }
});
    </script>" 
    ?>
    <!-- <script src="playlist.js"></script> -->
</body>

</html>
