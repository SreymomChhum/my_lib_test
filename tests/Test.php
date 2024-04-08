<?php

use PHPUnit\Framework\TestCase;
use Sreymom\MyLib\Message;

require_once __DIR__ . '/../src/run.php';


class MessageTest extends TestCase
{
    public Message $message;

    protected function setUp(): void
    {
        $privateKey = "your_private_key";
        $secretKey = "your_secret_key";
        $baseUrl = "https://cloudapi.plasgate.com/rest";
        $this->message = new Message($privateKey, $secretKey, $baseUrl);
    }

    // Test validateLength method
    public function testValidateLength(): void
    {
        $result = $this->message->validateLength("SMS Info", 11, "BAD REQUEST sender must be only 11 character");
        $this->assertTrue($result);
    }

    // Test validateType method
    public function testValidateType(): void
    {
        $result = $this->message->validateType("SMS Info", "string", "BAD REQUEST sender must be string");
        $this->assertTrue($result);
    }

    // Test validatePhoneNumbers method
    public function testValidatePhoneNumbers(): void
    {
        $validPayload = ["85512345678", "855977804485"];
        // $validPayload = "85512345678";
        $result = $this->message->validatePhoneNumbers($validPayload);
        $this->assertTrue($result);
    }


    // Test create method of MessageAdapter class
    public function testCreateSuccess(): void
    {
        // Set up the payload and to address
        $payload = [
            'sender' => 'SMS Info',
            'content' => "Hello from sreymom plasgate"
        ];
        $to = "855977804485";
        // $to = ['85512345678', '855977804485'];

        // Call the create method
        $result = $this->message->create($to, $payload);

        // Assert that the result is not empty (indicating successful execution)
        $this->assertNotNull($result, "Expected a non-empty result from create method");
        // public function testCreateSuccess(): void
        // {
        //     // Set up the payload and to address
        //     $payload = [
        //         'sender' => 'SMS Info',
        //         'content' => "Hello from sreymom plasgate"
        //     ];
        //     $to = "855977804485";
    
        //     // Call the create method
        //     $result = $this->message->create($to, $payload);
    
        //     echo($result);
        //     // **Assert successful creation with specific methods**
        //     // $this->assertTrue($result, "Expected successful creation from create method");
    
        //     // **OR** (if success property doesn't exist)
    
        //     // Assert returned object has expected properties
        //     // $this->assertObjectHasAttribute('id', $result);
        //     // Add assertions for other expected properties
        // }
    }

}












  











// use PHPUnit\Framework\TestCase;
// use Sreymom\MyLib\Message;

// require_once __DIR__ . '/../src/run.php';

// class ValidateTypeTest extends TestCase
// {

//     public function testIncorrectType()
//     {
//         $message = new Message('privateKey', 'secretKey', 'baseUrl');

//         // Test string value with expected type 'integer', should throw exception
//         $this->expectExceptionMessage('Error message');
//         $message->validateType('string', 'string', 'Error message');
//     }
// }











// use PHPUnit\Framework\TestCase;

// require_once __DIR__ . '/../src/run.php'; 

// class ValidateTypeTest extends TestCase
// {
//     // Test that the function correctly validates the type
//     public function testCorrectType()
//     {
//         $value = 10;
//         $expectedType = 'integer';
//         $errorMessage = 'Value must be an integer';

//         $this->assertTrue(validateType($value, $expectedType, $errorMessage));
//     }

//     // Test that the function throws an exception for incorrect type
//     public function testIncorrectType()
//     {
//         $value = 'string';
//         $expectedType = 'integer';
//         $errorMessage = 'Value must be an integer';

//         $this->expectException(ValidationException::class);
//         $this->expectExceptionMessage($errorMessage);

//         validateType($value, $expectedType, $errorMessage);
//     }

//     // Additional test cases can be added for different types and error messages
// }












// class MessageTest extends TestCase
// {
//     public function testCreateWithSingleRecipient()
//     {
//         $privateKey = "tyuiiiiiiiiiiiiiiiiii";
//         $secretKey = "ghjklkjhghjkl";
//         $baseUrl = "url";
//         // Arrange
//         $to = 'recipient@example.com';
//         $payload = ['key' => 'value']; // Example payload

//         // Act
//         $message = new \Sreymom\MyLib\Message($privateKey, $secretKey, $baseUrl);
//         // $message = new Message(); // Assuming Message class is in global namespace
//         $result = $message->create($to, $payload);

//         // Assert
//         $this->assertNotNull($result);
//         // Add more assertions based on the expected behavior of the create method
//     }
// }