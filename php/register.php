<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
require 'vendor/autoload.php'; // Include Composer's autoloader

use MongoDB\Client;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // Connect to MongoDB
    $mongoClient = new Client("mongodb://localhost:27017");
    $database = $mongoClient->selectDatabase("LandT");
    $collection = $database->selectCollection("userdetails");

    // Check if user with the same email already exists
    $existingUser = $collection->findOne(['email' => $email]);
    if ($existingUser) {
        // Handle the case where the email is already registered
        echo 0;
        exit();
    }

    // Insert user data into MongoDB
    $userData = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        
    ];
    $insertResult = $collection->insertOne($userData);
    echo 1;
}

?>
