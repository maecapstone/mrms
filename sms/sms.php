<?php
    // // Required if your environment does not handle autoloading
    // // require __DIR__ . '/vendor/autoload.php';
    // require __DIR__ . '/assets/sms/vendor/autoload.php';

    // // Your Account SID and Auth Token from console.twilio.com
    // $sid = "AC84d3242561e54934e007380ff6b3ae19";
    // $token = "e59ef314d4cd8e901afc852b8cb49c79";
    // $client = new Twilio\Rest\Client($sid, $token);

    // // Use the Client to make requests to the Twilio REST API
    // $message = $client->messages->create(
    //     // The number you'd like to send the message to
    //     '+639077318831',
    //     [
    //         // A Twilio phone number you purchased at https://console.twilio.com
    //         'from' => '+12179925262',
    //         // The body of the text message you'd like to send
    //         'body' => "Hello from Barangay Mojon, we have ayuda"
    //     ]
    // );

    // if($message){
    //     echo "message sent";
    // }
    // else{
    //     echo "message not sent";
    // }

    require __DIR__ . '/assets/sms/vendor/autoload.php';

    try{

    $basic  = new \Vonage\Client\Credentials\Basic("33308996", "ee5SbtSKyByHethU");
    $client = new \Vonage\Client($basic);


    $response = $client->sms()->send(
        // new \Vonage\SMS\Message\SMS("639077318831", "BRAND_NAME", 'A text message sent using the Nexmo SMS API')
        new \Vonage\SMS\Message\SMS("639705119223", "BRAND_NAME", 'A text message sent using the Nexmo SMS API')
    );
    
    $message = $response->current();
    
    if ($message->getStatus() == 0) {
        echo "The message was sent successfully\n";
    } else {
        echo "The message failed with status: " . $message->getStatus() . "\n";
    }

}
catch(Exception $e){
    echo "connection error";
}






?>