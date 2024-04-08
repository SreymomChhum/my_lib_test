<?php
// Required if your environment does not handle autoloading
require __DIR__ . '/vendor/autoload.php';

// Your Account private_key and secret_key from console.Plasgate.com
$private_key = "ACXXXXXX";
$secret_key = "YYYYYY";
// $client = new Plasgate\Rest\Client($private_key, $secret_key);

// Use the Client to make requests to the Plasgate REST API
$client->messages->create(
    '+15558675309',
    [
        'sender' => 'SMS Info',
        'content' => "Welcome to Plasgate SMS gateways"
    ]
);