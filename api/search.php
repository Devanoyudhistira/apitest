<?php
header("Access-Control-Allow-Origin:");
header("Content-Type:application/json");
header("Access-Control-Allow-Method:GET");
header("Access-Control-Allow-Headers:content-Type,Access-Control-Allow-Header,Authorization,X-Request-Width");

$connect = mysqli_connect("localhost","root","","devapic");

$search = $_GET["s"];

if($_SERVER["REQUEST_METHOD"] === "GET"){
    $get = mysqli_query($connect,"SELECT * FROM gallery WHERE deskripsi LIKE '$search%' ;");
    $result = mysqli_fetch_assoc($get);
    if(!is_null($result)){
    $data = [
        "data" => $result,
        "statuscode" => 200,
        "massage" => "data berhasil didapat"
       ];
       header("HTTP/1.0 $data[statuscode] $data[massage]");
       echo json_encode($data);}
    else{
        $data = [
            "data" => $result,
            "statuscode" => 404,
            "massage" => "data not found"
           ];
           header("HTTP/1.0 $data[statuscode] $data[massage]");
           echo json_encode($data);}
    }
    else{
        $data = [
            "data" => "wrong method mas",
            "status-code" => 405
           ];
           header("HTTP/1.0 405 $data[data]");
            echo json_encode($data);
    }


