<?php


header("Access-Control-Allow-Origin");
header("Content-Type:application/json");
header("Access-Control-Allow-Method:delete");
header("Access-Control-Allow-Headers:content-Type,Access-Control-Allow-Header,Authorization,X-Request-Width");

$connect = mysqli_connect("localhost", "root", "", "devapic");

$deskripsi = $_GET["id"];

$getall = mysqli_query($connect, "DELETE FROM gallery WHERE imageid = $deskripsi");

 $errormassage = mysqli_affected_rows($connect);

if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    if($errormassage > 0){
  $data = [
    "status-code" => 200,
    "massage" =>  "data berhasil dihapus",
    "result" =>  $errormassage,
  ];

  header("HTTP/1.0 200 $data[massage]");
  echo json_encode($data);}
  else{ $data = [
    "status-code" => 404,
    "massage" =>  "data gagal dihapus",
    "result" =>  $errormassage,
  ];

  header("HTTP/1.0 404 $data[massage]"); 
  echo json_encode($data);}
} else {
  $datagagal = [
    "data" => "sir method is not allowed",
    "status-code" => 405
  ];
  header("HTTP/1.0 500 Internal Server Error");
  echo json_encode($datagagal);
}


