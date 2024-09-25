<?php
// Allow from any origin
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Get the posted data
$postData = file_get_contents("php://input");
$data = json_decode($postData, true);

if ($data === null) {
    http_response_code(400);
    echo json_encode(["message" => "Invalid JSON"]);
} else {
    // Process the data
    $response = [
        "message" => "Data received successfully",
        "data" => $data["nama"]
    ];

    // Send the response
    http_response_code(200);
    echo json_encode($response);
}
?>