<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Method:POST");
header("Access-Control-Allow-Headers:content-Type,Access-Control-Allow-Header,Authorization,X-Request-Width");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $uploadDir = '../image/';
        $uploadPath = $uploadDir . basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            header("HTTP/1.0 200 file upload success");
            echo json_encode([
                'success' => true,
                'value' => $_FILES,
                'message' => 'File uploaded successfully'
            ]);
        } 
    } else {
        header("HTTP/1.0 413 file upload failed");
        echo json_encode(['success' => false, 'message' => 'No file received']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}