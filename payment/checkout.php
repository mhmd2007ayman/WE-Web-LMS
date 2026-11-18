<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Egyprice =(int) $_POST["price"];
    $Course = $_POST["title"];
    $priceEgy = $Egyprice  *100;
    $nameCourse = $Course;
    require __DIR__ . "../../vendor/autoload.php";
    
    $stripe_secret_key = "sk_test_yourKey";
    
    \Stripe\Stripe::setApiKey($stripe_secret_key);
    
    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => "http://localhost/WE_Web%20(Update)/Student/Courses/playlist/playlist.php?title=$nameCourse",
        "cancel_url" =>  "http://localhost/WE_Web%20(Update)/Student/Courses/Courses.php",
        "locale" => "auto",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "egp",
                    "unit_amount" => $priceEgy,
                    "product_data" => [
                        "name" => "$Course"
                    ]
                ]
            ]     
        ]
    ]);
    
    http_response_code(303);
    header("Location: " . $checkout_session->url);
}