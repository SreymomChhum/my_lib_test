<?php

namespace Sreymom\MyLib;

class ValidationException extends \Exception
{
}

class Client
{
    public $messages;

    public function __construct($privateKey, $secretKey)
    {
        $this->messages = new Message($privateKey, $secretKey, 'https://cloudapi.plasgate.com/rest');
    }
}

class Message
{
    private $privateKey;
    private $secretKey;
    private $baseUrl;

    public function __construct($privateKey, $secretKey, $baseUrl)
    {
        $this->privateKey = $privateKey;
        $this->secretKey = $secretKey;
        $this->baseUrl = $baseUrl;
    }

    function create($to, $payload)
    {
        $this->validatePayload($to, $payload);
        $url = is_array($to) ? $this->baseUrl . '/batch-send' : $this->baseUrl . '/send';
        $url = $url . "?private_key=$this->privateKey";

        $normalizedPayload = $this->normalizePayload($to, $payload);

        return $this->sendPostRequest($url, $normalizedPayload);
    }

    function sendPostRequest($url, $payload)

    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Secret: ' . $this->secretKey,
            'Content-Type: application/json'
        ));

        curl_setopt($ch, CURLOPT_VERBOSE, true);

        $response = curl_exec($ch);
        echo "Respone:".$response;
    }

    function validatePayload($to, $payload)
    {
        $this->validateType($payload['sender'], 'string', "BAD REQUEST sender must be string.");
        $this->validateType($payload['content'], 'string', "BAD REQUEST content must be string");
        $this->validateLength($payload['sender'], 11, "BAD REQUEST sender must be only 11 character.");
        $this->validateLength($payload['content'], 160, "BAD REQUEST content available only 153 to 160 character.");
        $this->validatePhoneNumbers($to);
    }

    function validateType($value, $expectedType, $errorMessage)
    {
        if (gettype($value) !== $expectedType) {
            throw new ValidationException($errorMessage);
        }
        return true;
    }

    function validateLength($value, $maxLength, $errorMessage)
    {
        if (strlen($value) > $maxLength) {
            throw new ValidationException($errorMessage);
        }

        return true;
    }

    function validatePhoneNumbers($to)
    {
        $errorMessage  = "Invalid phone number format, Phone number must start with '855'.";

        if (!is_string($to) && !is_array($to)) {
            throw new ValidationException("Invalid input, Phone numbers must be string or an array.");
        } else if (is_string($to)) {
            if (strpos($to, '855') !== 0) {
                throw new ValidationException($errorMessage);
            }
        } else {
            foreach ($to as $phoneNumber) {
                if (strpos($phoneNumber, '855') !== 0) {
                    throw new ValidationException($errorMessage);
                }
            }
        }

        return true;
    }

    function normalizePayload($to, $payload)
    {
        if (is_array($to)) {
            $payloadObj = array(
                'globals' => array(
                    'sender' => $payload['sender']
                ),
                'messages' => array(
                    array(
                        'to' => $to,
                        'content' => $payload['content']
                    )
                )
            );

            return json_encode($payloadObj);
        } else {


            $payloadObj = array(
                'to' => $to,
                'content' => $payload['content'],
                'sender' => $payload['sender']
            );

            return json_encode($payloadObj);
        }
    }
}

// // Example usage:
// $private_key = 'OJ1IEQ0c0AkuDjIXhsqsrf-7fKVY80L9S7o5xn_x8-sr5hLxCpy0LXbGwNbPPCN58xGzRjiKR5EYdhfgcdkVFw';
// $secret_key = '$5$rounds=535000$ybjSgyF6bWxslwYY$C2k7qye80gZ8yEOD5y858Q1YTbuhtOqAwGvYyLueBJ3';
// $client = new Client($private_key, $secret_key);

// // Use the Client to make requests to the Plasgate REST API
// $client->messages->create(
//     "855977804485",
//     // 877643567898,
//     // ["855962862015", "855977804485"],
//     [
//         'sender' => 'SMS Info',
//         'content' => "Hello from sreymom plasgate"
//     ]
// );
