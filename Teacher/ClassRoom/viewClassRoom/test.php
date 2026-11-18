<?php
$arrayy2 =[["time"=>"01:10 PM","name"=>"MohameddfggAyman","comment"=>"hello","image"=>"..\/Uploud_image\/hjdshfj@gmail.com_ImageAcount.png"]];
$arrayy =["time"=>"01:10 PM","name"=>"MohamedAyman","comment"=>"hello","image"=>"..\/Uploud_image\/hjdshfj@gmail.com_ImageAcount.png"];
$arrayy2[] = $arrayy;
// if($arrayy[2] !== '['){
//     $array6= substr($arrayy,'0',strlen($arrayy)+1);
//     echo "<br/> <h2>$array6</h2> <br/>";
//     $array7 = [$array6];

//     echo "<br/> <h2>$array7</h2> <br/>";

// }
// else{
//     $array6= substr($arrayy,'1','-1');
// }
print_r($arrayy2);
foreach( $arrayy2 as $value){
    $x =  $value['name'];
    echo "<br/> <h2>$x</h2> <br/>";
}

// for ($i=0; $i <$array6; $i++) { 
//         $x =  $array6[$i];
//    print_r($x);
//    echo "<br/> <h2>$x</h2> <br/>";
    
// }