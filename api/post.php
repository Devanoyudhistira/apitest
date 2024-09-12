<?php

header("Access-Control-Allow-Origin:");
header("Content-Type:application/json");
header("Access-Control-Allow-Method:POST");
header("Access-Control-Allow-Headers:content-Type,Access-Control-Allow-Header,Authorization,X-Request-Width");

$connect = mysqli_connect("localhost","root","","devapic");

$deskripsi = $_GET["d"];

if($_SERVER["REQUEST_METHOD"] === "POST"){
$getall = mysqli_query($connect,"INSERT INTO gallery (deskripsi) VALUES ('$deskripsi');");
$data = [
    "data" => "data berhasil masuk",
    "status-code" => 200,
    "request" => $deskripsi
   ];
   echo json_encode($data);
}
else{
    $data = [
        "data" => "wrong method mas",
        "status-code" => 405
       ];
       header("HTTP/1.0 405 $data[data]");
        echo json_encode($data);
    
}