<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->LandT->userdetails;

$name = $_POST['username'];

$search = array(
    "userid" => $name,
);

$fetch = $collection->findOne($search);

if ($fetch) {
    echo json_encode(["status" => 1]);
} else {
    // Assuming you want to insert the user with the specified "userid"
    $insertData = array(
        "userid" => $name,
        // Add other fields as needed
    );

    $insertResult = $collection->insertOne($insertData);

    if ($insertResult->getInsertedCount() > 0) {
        echo json_encode(["status" => 1]);
    } else {
        echo json_encode(["status" => 0, "error" => "Failed to insert"]);
    }
}
?>
